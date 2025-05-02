<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class StatsDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = getDatabaseConnection();
    }

    public function getAllMoney() {
        try {
            $query = "
                SELECT
                    COALESCE(SUM(CASE 
                        WHEN MONTH(created_at) = MONTH(CURRENT_DATE()) 
                        AND YEAR(created_at) = YEAR(CURRENT_DATE()) 
                    THEN amount ELSE 0 END), 0) AS currentMonth,
    
                    COALESCE(SUM(CASE 
                        WHEN MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) 
                    THEN amount ELSE 0 END), 0) AS previousMonth
                FROM payments
                WHERE status = 'succeeded'
            ";
    
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                'currentMonth' => (float) $result['currentMonth'],
                'previousMonth' => (float) $result['previousMonth']
            ];
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
        
    }
    public function getAllStats() {
        try {
            $query = "
                SELECT
                    -- Revenu du mois courant
                    COALESCE(SUM(CASE 
                        WHEN MONTH(created_at) = MONTH(CURRENT_DATE()) 
                        AND YEAR(created_at) = YEAR(CURRENT_DATE()) 
                        THEN amount ELSE 0 END), 0) AS currentMonth,
    
                    -- Revenu du mois précédent
                    COALESCE(SUM(CASE 
                        WHEN MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH) 
                        THEN amount ELSE 0 END), 0) AS previousMonth,
    
                    -- Nombre de ventes cette année
                    COUNT(CASE 
                        WHEN YEAR(created_at) = YEAR(CURRENT_DATE()) 
                        THEN 1 ELSE NULL END) AS salesCount,
    
                    -- Nombre total de clients
                    (SELECT COUNT(*) FROM clients) AS totalClients
                FROM payments
                WHERE status = 'succeeded'
            ";
    
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                'currentMonth' => (float) $result['currentMonth'],
                'previousMonth' => (float) $result['previousMonth'],
                'salesCount' => (int) $result['salesCount'],
                'totalClients' => (int) $result['totalClients']
            ];
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function getMonthlyStats($months = 7) {
        try {
            $query = "
                SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, 
                       COUNT(*) AS sales_count, 
                       SUM(amount) AS total_revenue
                FROM payments
                WHERE status = 'succeeded' 
                  AND created_at >= DATE_SUB(CURDATE(), INTERVAL :months MONTH)
                GROUP BY month
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':months', $months, PDO::PARAM_INT);
            $stmt->execute();
            $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            $queryUsers = "
            SELECT DATE_FORMAT(expiration, '%Y-%m') AS month, 
                   COUNT(*) AS customer_count
            FROM users
            WHERE expiration >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL :months MONTH), '%Y-%m-01')
            GROUP BY month
            ORDER BY month ASC
        ";
        
            $stmt = $this->pdo->prepare($queryUsers);
            $stmt->bindValue(':months', $months, PDO::PARAM_INT);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return ['sales' => $sales, 'customers' => $users];
        } catch (PDOException $e) {
            return ['error' => $e->getMessage()];
        }
    }
    
}    
?>
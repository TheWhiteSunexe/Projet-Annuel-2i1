document.addEventListener("DOMContentLoaded", () => {
    fetch("/Projet-Annuel-2i1/PA2i1/views/admin/back/api/ApiMonthlyStats.php")
      .then(response => response.json())
      .then(data => {
        new ApexCharts(document.querySelector("#reportsChart"), {
          series: [
            { name: 'Sales', data: data.sales },
            { name: 'Revenue', data: data.revenue },
            { name: 'Customers', data: data.customers }
          ],
          chart: {
            height: 350,
            type: 'area',
            toolbar: { show: false }
          },
          markers: { size: 4 },
          colors: ['#4154f1', '#2eca6a', '#ff771d'],
          fill: {
            type: "gradient",
            gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.3,
              opacityTo: 0.4,
              stops: [0, 90, 100]
            }
          },
          dataLabels: { enabled: false },
          stroke: { curve: 'smooth', width: 2 },
          xaxis: {
            type: 'category',
            categories: data.months
          },
          tooltip: {
            x: { format: 'MM/yyyy' }
          }
        }).render();
      })
      .catch(error => {
        console.error("Erreur chargement des stats mensuelles :", error);
      });
  });
  
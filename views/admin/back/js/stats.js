fetch('/Projet-Annuel-2i1/PA2i1/views/admin/back/api/ApiStats.php') 
    .then(response => response.json())
    .then(data => {
        const current = parseFloat(data.currentMonth) / 1000;
        const previous = parseFloat(data.previousMonth) / 1000;
        
        const salesCount = parseInt(data.salesCount);
        const totalClients = parseInt(data.totalClients);
        const variation = current - previous;
        const variationPercent = previous !== 0 ? ((variation / previous) * 100) : '100';

        const isUp = variation > 0;
        const isDown = variation < 0;

        // Revenu HTML
        let revenusHTML = `<div class="ps-3">
            <h6>${current.toLocaleString('fr-FR', { style: 'currency', currency: 'EUR' })}</h6>`;

        if (isUp) {
            revenusHTML += `
                <span class="text-success small pt-1 fw-bold">+${variationPercent}%</span>
                <span class="text-muted small pt-2 ps-1">en hausse</span>`;
        } else if (isDown) {
            revenusHTML += `
                <span class="text-danger small pt-1 fw-bold">${variationPercent}%</span>
                <span class="text-muted small pt-2 ps-1">en baisse</span>`;
        } else {
            revenusHTML += `
                <span class="text-muted small pt-1 fw-bold">0%</span>
                <span class="text-muted small pt-2 ps-1">stable</span>`;
        }

        revenusHTML += `</div>`;
        document.getElementById('chiffres-container').innerHTML = revenusHTML;

        // Ventes HTML
        document.querySelector('.sales-card .ps-3').innerHTML = `
            <h6>${salesCount.toLocaleString('fr-FR')} ventes</h6>
            <span class="text-muted small pt-2 ps-1">cette année</span>
        `;
        document.querySelector('.customers-card .ps-3').innerHTML = `
        <h6>${totalClients.toLocaleString('fr-FR')} clients</h6>
        <span class="text-muted small pt-2 ps-1">au total</span>
    `;
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des revenus :', error);
    });

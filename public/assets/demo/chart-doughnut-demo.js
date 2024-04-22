// doughnut-chart.js

$(document).ready(function() {


    var ctx = document.getElementById('myDoughnutChart').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [
                `Visité :${visitedCount}/${prescriptionDosage}`,
                `Pas Encore Visité:${nonVisitedCount}/${prescriptionDosage}`,
                `À Créer:${remainingAppointments}/${prescriptionDosage}`
            ],
            datasets: [{
                data: [visitedCount, nonVisitedCount, remainingAppointments],
                backgroundColor: [
                    '#1cc88a',
                    '#f6c23e',
                    '#e74a3b'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'right'
            }
        },
        plugins: {
            emptyDoughnut: {
                color: 'rgba(255, 128, 0, 0.5)',
                width: 2,
                radiusDecrease: 20
            }
        }
    });
});

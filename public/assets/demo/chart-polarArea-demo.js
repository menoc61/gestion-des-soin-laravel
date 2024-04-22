// doughnut-chart.js

$(document).ready(function() {


    var ctx = document.getElementById('mypolarAreaChart').getContext('2d');
    var mypolarAreaChart = new Chart(ctx, {
        type: 'polarArea',
        data: {
            labels: [
                `Visité :${visitedCount}/${allAppointment}`,
                `Pas Encore Visité:${nonVisitedCount}/${allAppointment}`,
                // `À Créer:${remainingAppointments}/${prescriptionDosage}`
            ],
            datasets: [{
                data: [visitedCount, nonVisitedCount],
                backgroundColor: [
                    '#157954',
                    '#f6c23e',
                    // '#e74a3b'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {
                position: 'right'
            },
            title: {
                display: true,
                text: "CHIFFRE D'AFFAIRE PAR MOIS",
                fontSize: 20,
                fontStyle: "bold",
                padding: 10,
              },
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

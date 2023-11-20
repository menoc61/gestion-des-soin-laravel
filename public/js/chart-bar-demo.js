import { Chart } from "chart.js";
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: _ydata,
        datasets: [
            {
                label: "Paiement",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: _xdata
            }
        ]
    },
    options: {
        scales: {
            xAxe: [
                {
                    time: {
                        unit: "month"
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }
            ],
            yAxes: [
                {
                    ticks: {
                        min: 0,
                        max: 10,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }
            ]
        },
        legend: {
            display: false
        }
    }
});

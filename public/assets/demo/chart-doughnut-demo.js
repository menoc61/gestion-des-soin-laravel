Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Area Chart Example
var ctx = document.getElementById("myDoughnutChart");
var myLineChart = new Chart(ctx, {
  type: "doughnut",
  data: {
    labels: _ydata,
    datasets: [
      {
        label: "Montant Total",
        lineTension: 0.3,
        borderColor: " #157954",
        pointRadius: 5,
        pointBackgroundColor: " #157954",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: " #157954",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: _xdata,
      },
    ],
  },
  options: {
    title: {
      display: true,
      text: "CHIFFRE D'AFFAIRE PAR MOIS",
      fontSize: 20,
      fontStyle: "bold",
      padding: 20,
    },
    scales: {
      xAxes: [
        {
          time: {
            unit: "date",
          },
          gridLines: {
            display: false,
          },
          ticks: {
            maxTicksLimit: 7,
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            min: 0,
            maxTicksLimit: 7,
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0.05)",
          },
        },
      ],
    },
    legend: {
      display: true,
    },
    tooltips: {
      enabled: true,
      mode: "index",
      intersect: false,
      callbacks: {
        label: function (tooltipItem, data) {
          var label = data.datasets[tooltipItem.datasetIndex].label || "";
          if (label) {
            label += ": ";
          }
          label += tooltipItem.yLabel;
          return label;
        },
      },
    },
  },
});

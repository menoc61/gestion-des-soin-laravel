// import { Chart } from "chart.js";
Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: "bar",
  data: {
    labels: _ydata,
    datasets: [
      {
        label: "Montant Total",
        backgroundColor: "#157954",
        borderColor: "#157954",
        data: _xdata,
      },
    ],
  },
  options: {
    // title: {
    //   display: true,
    //   text: "Chiffre d'affaire par mois",
    //   fontSize: 30,
    // //   fontStyle: "bold",
    //   padding: 10,
    // },
    scales: {
      xAxes: [
        {
          time: {
            unit: "month",
          },
          gridLines: {
            display: true,
          },
          ticks: {
            maxTicksLimit: 3,
          },
          scaleLabel: {
            display: false,
            labelString: "Mois",
            fontSize: 20,
            fontStyle: "bold",
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            min: 0,
            max: 1000000,
            maxTicksLimit: 5,
          },
          gridLines: {
            display: true,
          },
        //   scaleLabel: {
        //     display: true,
        //     labelString: "Montant",
        //     fontSize: 25,
        //     fontStyle: "bold",
        //   },
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

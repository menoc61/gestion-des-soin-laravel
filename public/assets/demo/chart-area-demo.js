Chart.defaults.global.defaultFontFamily =
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#292b2c";

// var ctx = document.getElementById("myAreaChart");
// var myLineChart = new Chart(ctx, {
//   type: "line",
//   data: {
//     labels: _ydata, // Dates de création (created_at)
//     datasets: [
//       {
//         label: "Montant Total",
//         lineTension: 0.3,
//         borderColor: "#157954",
//         pointRadius: 5,
//         pointBackgroundColor: "#157954",
//         pointBorderColor: "rgba(255,255,255,0.8)",
//         pointHoverRadius: 5,
//         pointHoverBackgroundColor: "#157954",
//         pointHitRadius: 50,
//         pointBorderWidth: 2,
//         data: _xdata, // Montants associés
//       },
//     ],
//   },
//   options: {
//     responsive: true,
//     title: {
//       display: true,
//       fontSize: 20,
//       fontStyle: "bold",
//       padding: 20,
//     },
//     animations: {
//         tension: {
//           duration: 1000,
//           easing: 'linear',
//           from: 1,
//           to: 0,
//           loop: true
//         }
//     },
//     scales: {
//       xAxes: [
//         {
//           type: "time",
//           time: {
//             unit: "day",
//           },
//           gridLines: {
//             display: false,
//           },
//           ticks: {
//             maxTicksLimit: 2,
//           },
//         },
//       ],
//       yAxes: [
//         {
//           ticks: {
//             min: 0,
//             maxTicksLimit: 3,
//           },
//           gridLines: {
//             color: "rgba(0, 0, 0, 0.05)",
//           },
//         },
//       ],
//     },
//     legend: {
//       display: true,
//     },
//   },
// });

var ctx = document.getElementById("myAreaChart").getContext("2d");
var myLineChart = new Chart(ctx, {
  type: "line",
  data: {
    labels: _ydata, // Dates de création (created_at)
    datasets: [
      {
        label: "Montant Total",
        lineTension: 0.3,
        borderColor: "#157954",
        pointRadius: 5,
        pointBackgroundColor: "#157954",
        pointBorderColor: "rgba(255,255,255,0.8)",
        pointHoverRadius: 5,
        pointHoverBackgroundColor: "#157954",
        pointHitRadius: 50,
        pointBorderWidth: 2,
        data: _xdata, // Montants associés
      },
    ],
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: "Montant Total par Date",
      fontSize: 20,
      fontStyle: "bold",
      padding: 20,
    },
    animation: {
        duration: 1000, // Durée de l'animation en millisecondes
        easing: 'linear',
        loop: true
      },
    scales: {
      xAxes: [
        {
          type: "time",
          time: {
            unit: "day",
          },
          gridLines: {
            display: false,
          },
          ticks: {
            maxTicksLimit: 2,
          },
        },
      ],
      yAxes: [
        {
          ticks: {
            min: 0,
            maxTicksLimit: 3,
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
    },
  });

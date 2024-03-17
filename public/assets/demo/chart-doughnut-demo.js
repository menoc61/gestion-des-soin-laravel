// Extracting labels and data for the chart
var labels = prescriptionDrugs.map(
  (drug) => `${drug.type}: ${drug.dose}/${sumPrescriptionDrugs}`
);
var data = prescriptionDrugs.map((drug) => parseFloat(drug.dose));
var colors = prescriptionDrugs.map((drug)=> drug.type == "new" ? "#28a745": "orange");
// Doughnut chart creation
var ctx = document.getElementById("myDoughnutChart").getContext("2d");
var myDoughnutChart = new Chart(ctx, {
  type: "doughnut",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Prescription Drugs",
        data: data,
        backgroundColor: colors,
      },
    ],
  },
  hoverOffset: 4,
  options: {
    responsive: true,
    legend: {
      display: true,
      position: "right",
    },
  },
});

// AREA CHART - Pengiriman Bulanan
var ctxArea = document.getElementById("pengirimanAreaChart").getContext("2d");
var pengirimanAreaChart = new Chart(ctxArea, {
  type: "line",
  data: {
    labels: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "Mei",
      "Jun",
      "Jul",
      "Agu",
      "Sep",
      "Okt",
      "Nov",
      "Des",
    ],
    datasets: [
      {
        label: "Total Pengiriman",
        lineTension: 0.3,
        backgroundColor: "rgba(78, 115, 223, 0.05)",
        borderColor: "rgba(78, 115, 223, 1)",
        pointRadius: 3,
        pointBackgroundColor: "rgba(78, 115, 223, 1)",
        pointBorderColor: "rgba(78, 115, 223, 1)",
        pointHoverRadius: 3,
        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
        pointHitRadius: 10,
        pointBorderWidth: 2,
        data: [120, 150, 170, 180, 220, 250, 300, 280, 260, 240, 210, 190],
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    scales: {
      x: { grid: { display: false } },
      y: {
        beginAtZero: true,
        ticks: { stepSize: 50 },
      },
    },
    plugins: {
      legend: { display: false },
    },
  },
});

// PIE CHART - Sumber Orderan
var ctxPie = document.getElementById("sumberOrderPieChart").getContext("2d");
var sumberOrderPieChart = new Chart(ctxPie, {
  type: "doughnut",
  data: {
    labels: ["Website", "Whatsapp", "Agen Offline"],
    datasets: [
      {
        data: [55, 30, 15],
        backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc"],
        hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf"],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: "bottom",
      },
    },
    cutout: "70%",
  },
});

(() => {
  const d = window.dashboardChartData;
  if (!d) return;

  // BAR CHART 
  const barCtx = document.getElementById('barChart');
  if (barCtx) {
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: d.barLabels,
        datasets: [
          { label: 'All Asset', data: d.assetCounts, backgroundColor: '#e63946', borderRadius: 4 },
          { label: 'Rent',      data: d.rentCounts,  backgroundColor: '#f4a261', borderRadius: 4 },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'top', labels: { usePointStyle: true, boxWidth: 8, padding: 20 } }
        },
        scales: {
          y: { beginAtZero: true, grid: { color: '#f1f3f5' } },
          x: { grid: { display: false } }
        }
      }
    });
  }

  // PIE CHART
  const pieCtx = document.getElementById('pieChart');
  if (pieCtx) {
    new Chart(pieCtx, {
      type: 'pie',
      data: {
        labels: d.pieLabels,
        datasets: [{
          data: d.pieCounts,
          backgroundColor: d.pieColors,
          borderWidth: 2,
          borderColor: '#ffffff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15, boxWidth: 8 } }
        }
      }
    });
  }
})();


// Chart data
const monthlyData = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
    datasets: [
        {
            label: 'All Asset',
            data: [650, 720, 680, 550, 540, 590],
            backgroundColor: '#e63946',
            borderRadius: 4,
        },
        {
            label: 'Rent',
            data: [580, 450, 620, 380, 410, 470],
            backgroundColor: '#f4a261',
            borderRadius: 4,
        }
    ]
};

const rentDistribution = {
    labels: ['Huawei MS XL', 'Huawei MS IOH', 'iForte', 'PT Must', 'PT PMT'],
    datasets: [{
        data: [25, 25, 35, 7, 8],
        backgroundColor: ['#0077ff', '#FFDE59', '#3b3F40', '#FFE9C7', '#F2994c'],
        borderWidth: 2,
        borderColor: '#ffffff'
    }]
};

// Bar Chart
const barCtx = document.getElementById('barChart').getContext('2d');
new Chart(barCtx, {
    type: 'bar',
    data: monthlyData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    boxWidth: 8,
                    padding: 20
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: '#f1f3f5'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
});

// Pie Chart
const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: rentDistribution,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    padding: 15,
                    boxWidth: 8
                }
            }
        }
    }
});



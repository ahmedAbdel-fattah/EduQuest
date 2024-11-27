const ctx1 = document.getElementById('studentPerformanceChart').getContext('2d');
const studentPerformanceChart = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ['John', 'Jane', 'Tom', 'Lucy', 'Mike'],
        datasets: [{
            label: 'Scores',
            data: [85, 90, 78, 92, 88],
            backgroundColor: '#6200EA',
            borderColor: '#6200EA',
            borderWidth: 1,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctx2 = document.getElementById('courseCompletionChart').getContext('2d');
const courseCompletionChart = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['Completed', 'Not Completed'],
        datasets: [{
            label: 'Course Completion Rate',
            data: [70, 30],
            backgroundColor: ['#6200EA', '#ff9f67'],
            borderColor: ['#6200EA', '#ff9f67'],
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
    }
});

const marketingData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
    datasets: [{
        label: 'Marketing Data',
        data: [200, 300, 400, 500, 600, 700],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'black',
        borderWidth: 1
    }]
};

const productsData = {
    labels: ['Guppi', 'Smasnug', 'Kelvin Kling', 'Hacoste', 'Nile', 'Nibba'],
    datasets: [{
        label: 'Products Data',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        borderColor: 'rgba(255, 99, 132, 1)',
        borderWidth: 1
    }]
};

const salesData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
    datasets: [{
        label: 'Sales Data',
        data: [100, 200, 300, 400, 500, 600],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
    }]
};

const customersData = {
    labels: ['Men', 'Women', 'Children'],
    datasets: [{
        label: 'Customers Data',
        data: [20, 30, 50],
        backgroundColor: ['rgba(255, 206, 86, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)'],
        borderColor: ['rgba(255, 206, 86, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],
        borderWidth: 1
    }]
};

const marketingCtx = document.getElementById('marketingCanvas').getContext('2d');
        new Chart(marketingCtx, {
            type: 'bar',
            data: marketingData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        const productsCtx = document.getElementById('productsCanvas').getContext('2d');
        new Chart(productsCtx, {
            type: 'bar',
            data: productsData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        const salesCtx = document.getElementById('salesCanvas').getContext('2d');
        new Chart(salesCtx, {
            type: 'line',
            data: salesData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        const customersCtx = document.getElementById('customersCanvas').getContext('2d');
        new Chart(customersCtx, {
            type: 'doughnut',
            data: customersData,
            options: {}
        });
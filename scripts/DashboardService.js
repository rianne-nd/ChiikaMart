var salesCanvas = document.getElementById("chartSalesOverTime");
new Chart(salesCanvas, {
    type: "line",
    data: {
        labels: window.salesOverTimeData.labels,
        datasets: [{
            label: "Sales Revenue",
            data: window.salesOverTimeData.data,
            borderColor: "#4d6076",
            backgroundColor: "rgba(77, 96, 118, 0.2)",
            tension: 0.3,
            fill: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var registrationsCanvas = document.getElementById("chartUserRegistrations");
new Chart(registrationsCanvas, {
    type: "line",
    data: {
        labels: window.userRegistrationData.labels,
        datasets: [{
            label: "New Users",
            data: window.userRegistrationData.data,
            borderColor: "#3d6374",
            backgroundColor: "rgba(61, 99, 116, 0.25)",
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var orderStatusCanvas = document.getElementById("chartOrderStatus");
new Chart(orderStatusCanvas, {
    type: "doughnut",
    data: {
        labels: window.orderStatusData.labels,
        datasets: [{
            data: window.orderStatusData.data,
            backgroundColor: [
                "#4d6076",
                "#3d6374",
                "#697985",
                "#b45309",
                "#b91c1c"
            ],
            hoverOffset: 4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

var topSellingCanvas = document.getElementById("chartTopSelling");
new Chart(topSellingCanvas, {
    type: "bar",
    data: {
        labels: window.topSellingData.labels,
        datasets: [{
            label: "Units Sold",
            data: window.topSellingData.data,
            backgroundColor: "rgba(77, 96, 118, 0.35)",
            borderColor: "#4d6076",
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var revenueCharacterCanvas = document.getElementById("chartRevenueCharacter");
new Chart(revenueCharacterCanvas, {
    type: "bar",
    data: {
        labels: window.revenueByCharacterData.labels,
        datasets: [{
            label: "Revenue",
            data: window.revenueByCharacterData.data,
            backgroundColor: "rgba(61, 99, 116, 0.35)",
            borderColor: "#3d6374",
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var revenueCollectionCanvas = document.getElementById("chartRevenueCollection");
new Chart(revenueCollectionCanvas, {
    type: "bar",
    data: {
        labels: window.revenueByCollectionData.labels,
        datasets: [{
            label: "Revenue",
            data: window.revenueByCollectionData.data,
            backgroundColor: "rgba(105, 121, 133, 0.35)",
            borderColor: "#697985",
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var reviewStarsCanvas = document.getElementById("chartReviewStars");
new Chart(reviewStarsCanvas, {
    type: "bar",
    data: {
        labels: window.reviewStarData.labels,
        datasets: [{
            label: "Total Reviews",
            data: window.reviewStarData.data,
            backgroundColor: "rgba(77, 96, 118, 0.25)",
            borderColor: "#4d6076",
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

var lowestStockCanvas = document.getElementById("chartLowestStock");
new Chart(lowestStockCanvas, {
    type: "bar",
    data: {
        labels: window.lowestStockData.labels,
        datasets: [{
            label: "Stock Quantity",
            data: window.lowestStockData.data,
            backgroundColor: "rgba(185, 28, 28, 0.25)",
            borderColor: "#b91c1c",
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

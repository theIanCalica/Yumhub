$(document).ready(function () {
    //  Top food
    $.ajax({
        type: "GET",
        url: "/api/getTopFoods",
        dataType: "json",
        success: function (data) {
            console.log(data);
            var labels = data.map((food) => food.name);
            var values = data.map((food) => food.order_items_count);

            var ct = $("#top-food-chart")[0].getContext("2d");
            var topFoodChart = new Chart(ct, {
                type: "doughnut",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Number of Orders",
                            data: values,
                            backgroundColor: [
                                "rgba(255, 99, 132, 0.6)",
                                "rgba(54, 162, 235, 0.6)",
                                "rgba(255, 206, 86, 0.6)",
                                "rgba(75, 192, 192, 0.6)",
                                "rgba(153, 102, 255, 0.6)",
                                "rgba(255, 159, 64, 0.6)",
                                "rgba(255, 99, 132, 0.6)",
                                "rgba(54, 162, 235, 0.6)",
                                "rgba(255, 206, 86, 0.6)",
                                "rgba(75, 192, 192, 0.6)",
                            ],
                            borderColor: [
                                "rgba(255, 99, 132, 1)",
                                "rgba(54, 162, 235, 1)",
                                "rgba(255, 206, 86, 1)",
                                "rgba(75, 192, 192, 1)",
                                "rgba(153, 102, 255, 1)",
                                "rgba(255, 159, 64, 1)",
                                "rgba(255, 99, 132, 1)",
                                "rgba(54, 162, 235, 1)",
                                "rgba(255, 206, 86, 1)",
                                "rgba(75, 192, 192, 1)",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    responsive: true,

                    plugins: {
                        legend: {
                            position: "top",
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.label || "";
                                    if (label) {
                                        label += ": ";
                                    }
                                    label += context.raw;
                                    return label;
                                },
                            },
                        },
                    },
                },
            });
        },
        error: function (data) {},
    });

    // Main chart orders
    $.ajax({
        type: "GET",
        url: "/api/getOrders",
        dataType: "json",
        success: function (data) {
            // Extract labels and data from the response
            console.log(data);
            let totalAnnualRevenue = 0;
            let totalAnnualCommission = 0;

            // Iterate over each item in the data to calculate the total revenue and commission
            data.forEach((item) => {
                // Convert revenue and commission from string to number
                let revenue = parseFloat(item.revenue);
                let commission = parseFloat(item.commission);

                // Check for NaN (Not-a-Number) values
                if (!isNaN(revenue)) {
                    totalAnnualRevenue += revenue; // Add to total revenue
                } else {
                    console.error("Invalid revenue value:", item.revenue);
                }

                if (!isNaN(commission)) {
                    totalAnnualCommission += commission; // Add to total commission
                } else {
                    console.error("Invalid commission value:", item.commission);
                }
            });

            // Update total values on the page
            $("#totRevenue").text("₱" + totalAnnualRevenue.toLocaleString());
            $("#totCommission").text(
                "₱" + totalAnnualCommission.toLocaleString()
            );

            const labels = data.map((item) => item.month); // Extract month names
            const revenueData = data.map((item) => item.revenue); // Extract monthly revenue values
            const commissionData = data.map((item) => item.commission); // Extract monthly commission values

            // Data for the chart
            const dataForChart = {
                labels: labels,
                datasets: [
                    {
                        label: "Revenue per Month",
                        data: revenueData,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 2,
                        tension: 0.4, // Smooth curve
                        pointRadius: 5, // Larger points
                        pointBackgroundColor: "rgba(75, 192, 192, 1)",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 2,
                    },
                    {
                        label: "Commission per Month",
                        data: commissionData,
                        backgroundColor: "rgba(255, 99, 132, 0.2)",
                        borderColor: "rgba(255, 99, 132, 1)",
                        borderWidth: 2,
                        tension: 0.4, // Smooth curve
                        pointRadius: 5, // Larger points
                        pointBackgroundColor: "rgba(255, 99, 132, 1)",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 2,
                    },
                ],
            };

            const config = {
                type: "line",
                data: dataForChart,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: "top",
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || "";
                                    if (label) {
                                        label += ": ";
                                    }
                                    if (context.parsed.y !== null) {
                                        label +=
                                            "₱" +
                                            context.parsed.y.toLocaleString();
                                    }
                                    return label;
                                },
                            },
                        },
                        datalabels: {
                            display: true,
                            color: "#444",
                            font: {
                                weight: "bold",
                            },
                            formatter: function (value) {
                                return "₱" + value.toLocaleString();
                            },
                        },
                        annotation: {
                            annotations: {
                                line1: {
                                    type: "line",
                                    yMin: 2000,
                                    yMax: 2000,
                                    borderColor: "red",
                                    borderWidth: 2,
                                    label: {
                                        content: "Target",
                                        enabled: true,
                                        position: "top",
                                    },
                                },
                            },
                        },
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                color: "rgba(200, 200, 200, 0.2)",
                            },
                            ticks: {
                                color: "#666",
                            },
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: "rgba(200, 200, 200, 0.2)",
                            },
                            ticks: {
                                color: "#666",
                                callback: function (value) {
                                    return "₱" + value.toLocaleString(); // Format y-axis values as currency
                                },
                            },
                        },
                    },
                },
            };

            // Create the chart
            const ctx = $("#main-chart")[0].getContext("2d");
            new Chart(ctx, config);
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        },
    });

    $.ajax({
        type: "GET",
        url: "/api/getCuisine",
        dataType: "json",
        success: function (data) {
            // Prepare data for the chart
            const labels = data.map((item) => item.name);
            const values = data.map((item) => item.total_orders);

            // Create chart
            const ctx = document
                .getElementById("cuisine-chart")
                .getContext("2d");
            if (ctx) {
                // Check if ctx is not null
                new Chart(ctx, {
                    type: "horizontalBar", // Horizontal bar chart type for Chart.js v2.9.4
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: "Orders per Cuisine",
                                data: values,
                                backgroundColor: "rgba(75, 192, 192, 0.2)",
                                borderColor: "rgba(75, 192, 192, 1)",
                                borderWidth: 1,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes: [
                                {
                                    ticks: {
                                        beginAtZero: true,
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Number of Orders",
                                    },
                                },
                            ],
                            yAxes: [
                                {
                                    scaleLabel: {
                                        display: true,
                                        labelString: "Cuisine",
                                    },
                                },
                            ],
                        },
                        legend: {
                            display: true,
                        },
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    return (
                                        data.datasets[tooltipItem.datasetIndex]
                                            .label +
                                        ": " +
                                        tooltipItem.yLabel
                                    );
                                },
                            },
                        },
                    },
                });
            } else {
                console.error("Canvas element not found");
            }
        },
        error: function (data) {
            console.log(data);
        },
    });
});

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
            let totalAnnualProfit = 0;

            // Iterate over each item in the data to calculate the total profit
            data.forEach((item) => {
                // Convert profit from string to number
                let profit = parseFloat(item.profit);

                // Check for NaN (Not-a-Number) values
                if (!isNaN(profit)) {
                    totalAnnualProfit += profit; // Add to total
                } else {
                    console.error("Invalid profit value:", item.profit);
                }
            });
            $("#tot").text("₱" + totalAnnualProfit.toLocaleString());
            const labels = data.map((item) => item.month); // Extract month names
            const chartData = data.map((item) => item.profit); // Extract monthly profit values

            // Data for the chart
            const dataForChart = {
                labels: labels,
                datasets: [
                    {
                        label: "Orders per Month",
                        data: chartData,
                        backgroundColor: "rgba(75, 192, 192, 0.2)",
                        borderColor: "rgba(75, 192, 192, 1)",
                        borderWidth: 2,
                        tension: 0.4, // Smooth curve
                        pointRadius: 5, // Larger points
                        pointBackgroundColor: "rgba(75, 192, 192, 1)",
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
                                return "$" + value.toLocaleString();
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
                                    return "$" + value.toLocaleString(); // Format y-axis values as currency
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
});

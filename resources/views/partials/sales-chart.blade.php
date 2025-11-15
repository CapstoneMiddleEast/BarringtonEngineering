<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<h2 class="text-xl font-bold dark:text-white text-gray-900 mb-3">Sales Enquiries Per Month</h2>
<canvas id="salesChart" width="400" height="200"></canvas>
<script>
    async function fetchSalesData() {
        try {
            const response = await fetch('/dashboard/sales_enquiries_chart_data');
            const data = await response.json();

            const ctx = document.getElementById('salesChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels, // Ensure labels are correctly set
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            type: 'category', // Explicitly set x-axis type
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Sales Enquiries'
                            }
                        }
                    }
                }
            });
        } catch (error) {
            console.error("Error fetching sales data:", error);
        }
    }

    fetchSalesData();
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!--<select id="timePeriod" class="form-control">-->
                <!--    <option value="daily">Daily</option>-->
                <!--    <option value="weekly">Weekly</option>-->
                <!--    <option value="monthly">Monthly</option>-->
                <!--</select>-->
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>

        const ctx = document.getElementById('myChart').getContext('2d');
        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Direct Order',
                    data: [],
                    borderColor: 'rgb(244, 168, 47)',
                    borderWidth: 2,
                    fill: false
                }, {
                    label: 'Paper Deals',
                    data: [],
                    borderColor: 'rgb(245, 105, 84)',
                    borderWidth: 2,
                    fill: false
                },
              <?php if($_SESSION['role']==4){ ?>
                {
                    label: 'Subscription',
                    data: [],
                    borderColor: 'rgb(9, 48, 247)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Consultancy',
                    data: [],
                    borderColor: 'rgb(2, 250, 246)',
                    borderWidth: 2,
                    fill: false
                },
                <?php } ?>

            
                ]
            
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            // Ensure y-axis shows integer values only
                            callback: function (value) {
                                return Number.isInteger(value) ? value : null;
                            },
                            stepSize: 1 // Optional: force a step size of 1 for better readability
                        }
                    }
                }
            }
        });

        function fetchData(period) {
            $.ajax({
                url: 'fetch_data.php',
                method: 'GET',
                data: { period: period },
                success: function (response) {
                    const data = JSON.parse(response);
                    myChart.data.labels = data.labels;
                    myChart.data.datasets[0].data = data.dealsData;
                    myChart.data.datasets[1].data = data.pdDealsData;
                     <?php if($_SESSION['role']==4){ ?>
                    myChart.data.datasets[2].data = data.subscriptionData;
                    myChart.data.datasets[3].data = data.consultancydata;
                    <?php } ?>



                    myChart.update();
                }
            });
        }

        $('#timePeriod').on('change', function () {
            const selectedPeriod = $(this).val();
            fetchData(selectedPeriod);
        });

        // Fetch initial data
        fetchData('daily');
    </script>
</body>

</html>

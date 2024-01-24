<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
</head>

<body>
    <h1>Latihan Chart</h1>

    <div class="col-lg-8 col-md-12 mt-2 w-70 h-60">
        <canvas id="realTimeChart" class="w-100"></canvas>
    </div>

    @vite('resources/js/app.js')
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            Echo.channel('addedData')
                .listen('addedDataEvent', (e) => {
                    console.table(e);
                });
        });
    </script> --}}
    <script>
        let chart;
        let labels;
        let datas;
        getData();

        function getData() {

            $.ajax({
                url: 'real-time-chart-data',
                method: 'GET',
                dataType: 'json',
                data: {
                    'country': "Indonesia",
                },
                success: function(data) {
                    labels = data.labels;
                    datas = data.Confirmed;

                    console.log(datas);

                    var ctx = document.getElementById('realTimeChart').getContext('2d');
                    if (chart) {
                        chart.destroy();
                    }

                    chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: datas,
                                label: 'COVID-19 Statustics For Indonesia',
                                backgroundColor: ['rgb(255,99,132)'],
                                borderWidth: 1,
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
                    })
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", xhr.status);
                    console.log("Status:", status);
                    console.log("Error:", error);
                }
            })
        }

        $(function() {
            getData();
        })

        setTimeout(() => {
            window.Echo.channel('addedData').listen('.App\\Events\\addedDataEvent', (e) => {
                console.log(e);

                chart.data.labels.push(e.label);
                chart.data.datasets[0].data.push(e.data);

                chart.data.labels.shift();
                chart.data.datasets[0].data.shift();

                chart.update();
            })
        }, 1000);


    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</body>

</html>

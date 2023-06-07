<!DOCTYPE html>
<html>
<head>
<title>Creating Dynamic Data Graph using PHP and Chart.js</title>
<style type="text/css">
BODY {
    width: 550PX;
}

#chart-container {
    width: 100%;
    height: auto;
}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>


</head>
<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <div id="chart-container">
        <canvas id="graph"></canvas>
    </div>

    <script>
        $(document).ready(function () {
            showGraph();
        });

        function showGraph() {

            $.post("data.php",
                function (data)
                {
                    console.log(data);
                    var day = [];
                    var total = [];

                    for (var i in data) {
                        day.push(data[i].day_name);
                        total.push(data[i].total_price);
                    }

                    var chartdata = {
                        labels: day,
                        datasets: [
                            {
                                label: 'ยอดขายในแต่ละวัน',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: total
                            }
                        ]
                    };

                    var graphTarget = $("#graph");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });

            $.post("datamount.php", function (data) {
                var month = [];
                var total = [];

                for (var i in data) {
                    // Convert the month number to a month name
                    var monthName = getMonthName(data[i].month_number);
                    month.push(monthName);
                    total.push(data[i].total_price);
                }
                var chartdata = {
                    labels: month,
                    datasets: [
                        {
                            label: 'Total Price',
                            backgroundColor: '#49e2ff',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: total
                        }
                    ]
                };

                var graphTarget = $("#graphCanvas");
                var barGraph = new Chart(graphTarget, {
                    type: 'bar',
                    data: chartdata
                });
            });
        }

        function getMonthName(monthNumber) {
            var monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            return monthNames[monthNumber - 1];
        }

    </script>

</body>
</html>
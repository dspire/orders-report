<!DOCTYPE html>
<html>
<head>
    <title>Show me line!</title>
</head>
<body>
<style>
.footer,
.push {
    height: 50px;
}
</style>

<h1>
    Revenue table
</h1>

<canvas id="myChart"></canvas>

<footer class="footer"></footer>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script type="text/javascript">
    let chartLabels = @json($labels);
    let chartDataset = @json($dataset);

    let customLabels = chartLabels.map(q => '`' + q + '`');

    let ctx = document.getElementById('myChart').getContext('2d');
    let chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: customLabels,
            datasets: [{
                label: 'Week Revenue',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: chartDataset
            }]
        },

        // Configuration options go here
        options: {}
    });
</script>

</body>
</html>

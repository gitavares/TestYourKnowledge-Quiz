<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Tests', 'Successful', 'Failed', 'Average'],

        <?php
        $testsResultsStats = TestResult::getFinishedTestsResults();

        $totalHighest = $testsResultsStats[0]['totalTests'];

        foreach ($testsResultsStats as $testResults) {
            $testName = $testResults['testName'];
            $totalTests = $testResults['totalTests'];
            $totalSuccessTests = $testResults['totalSuccessTests'];
            $totalFailedTests = $testResults['totalFailedTests'];
            $average = number_format($testResults['avgScore'], 1, '.', '');

            echo "['{$testName}', {$totalSuccessTests}, {$totalFailedTests}, {$average}], ";
        }
        ?>
    ]);
    
    var totalTests = <?php echo $totalHighest; ?>

    var options = {
        chart: {
            title: 'Top 5 Tests Performance',
            subtitle: 'Successful done, Failed, and Average',
        },
        series: {
            0: { axis: 'totalTaken' }, 
            1: { axis: 'totalTaken' }, 
            2: { axis: 'average' }
        },
        axes: {
            y: {
                totalTaken: { range: { max: totalTests, min: 0 }, label: 'Total Taken'}, // Left y-axis.
                average: { range: { max: 10, min: 0 }, side: 'right', label: 'Score Average'} // Right y-axis.
            }
        }, 
        isStacked: true,
        legend: { position: 'none' },
        vAxis: { format: 'decimal' },
        height: 300,
        colors: ['#0054d1', '#FFDE2B']
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
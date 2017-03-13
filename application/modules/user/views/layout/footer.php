
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 ticket-footer">
            <h5>Copyright © 2017<span><a href="#" target="_blank"> PMS </a></span>All rights reserved.</h5>
        </div>
    </div>
</div>
<script type="text/javascript">
    var BASE_URL = '<?php echo BASE_URL; ?>';
    var FRONTEND_URL = '<?php echo frontend_url(); ?>';
</script>
<script>
    $(document).ready(function () {
        $(".notificationicon").click(function () {
            $(this).toggleClass("open");
            $("#notificationMenu").toggleClass("open");
        });
    });

</script>
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
<script>
    /**
     * Define source data
     */
    var chartData = [{
            "country": "Average",
            "litres": 150
        }, {
            "country": "Good",
            "litres": 200.9
        }, {
            "country": "Excellent",
            "litres": 501.9
        }];

    /**
     * Add a 50% slice
     */

    var sum = 0;
    for (var x in chartData) {
        sum += chartData[x].litres;
    }
    chartData.push({
        "litres": sum,
        "alpha": 0
    });

    /**
     * Create the chart
     */

    var chart = AmCharts.makeChart("chartdiv", {
        "type": "pie",
        "startAngle": 0,
        "radius": "90%",
        "innerRadius": "0%",
        "dataProvider": chartData,
        "valueField": "litres",
        "titleField": "country",
        "alphaField": "alpha",
        "labelsEnabled": false,
        "pullOutRadius": 0,
        "pieY": "95%"
    });
</script>
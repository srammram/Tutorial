
<?php echo $this->load->view('layout/left-menu'); ?>
<style type="text/css">
    #map {
        height: 500px;
        width: 500px;
        margin: 0px;
        padding: 0px
    }
</style>
<div class="clear" style="clear: both;height:3em"></div>
<div class="common col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="col-lg-3 col-sm-6 col-xs-12">
        <div id="chartdiv"></div>
    </div>

    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 circle_red one accord active" onclick="accord(1)" title="one" >
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-cubes fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo count($dashboard_count) != '0' ? $dashboard_count[0]['ongoing'] : '0'; ?></div>
                        <div>All Ongoing Project</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 circle_green two accord " onclick="accord(2)" title="two">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-building-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo count($dashboard_count) != '0' ? $dashboard_count[0]['Upcoming'] : '0'; ?></div>
                        <div>All Upcoming Project</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 circle_yellow three accord " onclick="accord(3)" title="three">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-database fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo count($dashboard_count) != '0' ? $dashboard_count[0]['Pipeline'] : '0'; ?></div>
                        <div>All pipeline Project</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa fa-arrow-circle-down"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section_accord">
    <div class="accord_box" id="one">



    </div>
    <div class="accord_box" id="two" style="display:none;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 project_list">
            <div class="row">
                <div class="col-xs-3" data-toggle="modal" data-target="#myModal" >
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 1</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Projects</h4>
                            </div>
                            <div class="modal-body">
                                <p>Project Title =</p>
                                <p>Project Description =</p>
                                <p>Start Date =</p>
                                <p>End Date =</p>
                                <p>Estimated Hours =</p>
                                <p>Used Hours =</p>
                                <p>Team Involved =</p>
                                <p>Current Status =</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 2</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 3</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 4</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clear" style="clear: both;height:3em"></div>
            <div class="row">
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 5</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 6</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="accord_box" id="three" style="display:none;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 project_list">
            <div class="row">
                <div class="col-xs-3" data-toggle="modal" data-target="#myModal" >
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 1</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Projects</h4>
                            </div>
                            <div class="modal-body">
                                <p>Project Title =</p>
                                <p>Project Description =</p>
                                <p>Start Date =</p>
                                <p>End Date =</p>
                                <p>Estimated Hours =</p>
                                <p>Used Hours =</p>
                                <p>Team Involved =</p>
                                <p>Current Status =</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 2</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 3</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xs-3">
                    <a href="#">
                        <div class="boxTile">
                            <div class="square info easeAni">
                                <div class="text">
                                    <h2>Project 4</h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="clear" style="clear: both;height:3em"></div>

            <!--<div class="row">
                    <div class="col-xs-12 text-center pagination">
                            <ul class="pagination">
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                      </ul>
                    </div>
            </div>-->
        </div>
    </div>

</div>

<div class="row">
    <!-- bar chart -->

</div>
<div class="clearfix"></div>
</div>
<script type="text/javascript">
    var MapPoints = '[{"address":{"address":"plac Grzybowski, Warszawa, Polska","lat":"52.2360592","lng":"21.002903599999968"},"title":"Warszawa"},{"address":{"address":"Jana Paw\u0142a II, Warszawa, Polska","lat":"52.2179967","lng":"21.222655600000053"},"title":"Wroc\u0142aw"},{"address":{"address":"Wawelska, Warszawa, Polska","lat":"52.2166692","lng":"20.993677599999955"},"title":"O\u015bwi\u0119cim"}]';

    var MY_MAPTYPE_ID = 'custom_style';
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });

        if (jQuery('#map').length > 0) {

            var locations = jQuery.parseJSON(MapPoints);

            map = new google.maps.Map(document.getElementById('map'), {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
            });
            directionsDisplay.setMap(map);

            var infowindow = new google.maps.InfoWindow();
            var flightPlanCoordinates = [];
            var bounds = new google.maps.LatLngBounds();

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i].address.lat, locations[i].address.lng),
                    map: map
                });
                flightPlanCoordinates.push(marker.getPosition());
                bounds.extend(marker.position);

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i]['title']);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }

            map.fitBounds(bounds);

            // directions service configuration
            var start = flightPlanCoordinates[0];
            var end = flightPlanCoordinates[flightPlanCoordinates.length - 1];
            var waypts = [];
            for (var i = 1; i < flightPlanCoordinates.length - 1; i++) {
                waypts.push({
                    location: flightPlanCoordinates[i],
                    stopover: true
                });
            }
            calcRoute(start, end, waypts);
        }
    }

    function calcRoute(start, end, waypts) {
        var request = {
            origin: start,
            destination: end,
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: google.maps.TravelMode.DRIVING
        };
        directionsService.route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
                var route = response.routes[0];
                var summaryPanel = document.getElementById('directions_panel');
                summaryPanel.innerHTML = '';
                // For each route, display summary information.
                for (var i = 0; i < route.legs.length; i++) {
                    var routeSegment = i + 1;
                    summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
                    summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                    summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                    summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                }
            }
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
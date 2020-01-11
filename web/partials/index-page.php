<?php  
    $db = new mysqli('db5000267125.hosting-data.io','dbu244594','d23940EF%%',"dbs260683", 3306);
    $plant_data = [];
    if ($db->connect_error) {
        echo "Database Connection Error";
    }else{
        $db->query("SET time_zone='+05:00';");
    }

?>

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor text-capitalize">Advance Cultivation System - ML Assisted</h3>
        </div>
        <div class="col-md-7 align-self-center">

        </div>
        <div>
            <button
                class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i
                    class="ti-settings text-white"></i></button>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-center text-muted">
                                    Temperature
                                </h5>
                                <hr>
                                <div id="soilguage" class="text-center">
                                    <canvas id="temperature"></canvas>


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-center text-muted">
                                    Humidity
                                </h5>
                                <hr>
                                <div id="humidityguagee" class="text-center">
                                    <canvas id="humidity-guage"></canvas>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="text-center text-muted">
                                    Soil Dryness
                                </h5>
                                <input type="checkbox" checked data-on-color="primary" data-off-color="info">
                                <hr>
                                <div id="tempgauge" class="text-center">
                                    <canvas id="soildryness"></canvas>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-12 ">
                                <h5 class="text-center text-muted">
                                    Soil PH
                                </h5>
                                <hr>
                                <div id="phgauge" class="text-center">
                                    <canvas id="ph-guage"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <div>
                                <h4 class="card-title">Neural Network Prediction</h4>
                            </div>
                            <hr>
                            <div class="ml-auto">
                                <ul class="list-inline">
                                    <?php
                                        $diseases = [];
                                        $avg_predictions = [];
                                        $query = "SELECT AVG(bacterial_blight) as 'Bacterial Blight', AVG(bacterial_spot) as 'Bacterial Spot', AVG(black_rot) as 'Black Rot', AVG(mosaic_virus) as 'Mosaic Virus', AVG(normal) as 'Normal', AVG(powedry_mildew) as 'Powedry Mildew', AVG(rust) as 'Rust', AVG(scab) as 'Scab' FROM `disease_data`";
                                        $result = $db->query($query);
                                        if($result){
                                            if($result->num_rows){
                                                $avg_predictions = $result->fetch_assoc();
                                            }
                                        }
                                        foreach ($avg_predictions as $k => $v){
                                            if($v >= 10){
                                                $diseases[] = round($v, 2) . "% " . $k;
                                            }
                                        }
                                    
                                        foreach($diseases as $d){
                                            ?>
                                            <li>
                                                <h6 style="color:rgba(255, 255, 255,1)">
            
                                                <i class="fa fa-circle font-10 m-r-10"></i>
                                                <?= $d ?>
                                                </h6>
                                            </li>
                                            <?php

                                        }
                                        ?>
                                </ul>
                            </div>
                        </div>
                        <!-- <h4 class="card-title">Zoom gallery</h4> -->
                        <!-- <h6 class="card-subtitle">just add code under class="zoom-gallery".</h6> -->
                        <div class="zoom-gallery row m-t-30">
                        <?php include_once "image-gallery.php"; ?>    
                        </div>
                        <!-- <div id="morris-area-chart2" style="height: 405px;"></div> -->
                        <!-- <div id="area-example" style="height: 405px;"></div> -->

                    </div>
                </div>
                <div class="card card-default clearfix">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="btn-minimize" data-action="expand"><i
                                    class="mdi mdi-arrow-expand"></i></a>
                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0">ACS Detail</h4>


                    </div>
                    <div class="card-body collapse show">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                    <tr>
                                        <th>Varibles</th>
                                        <th>Image</th>
                                        <th>Bad</th>
                                        <th>Good</th>
                                        <th>Favorable</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Temperature</td>
                                        <td>
                                            <!-- <img src="./assets/images/gallery/chair.jpg" alt="iMac" width="80"> -->
                                            <i class="mdi mdi-oil-temperature fa-3x"></i>
                                        </td>
                                        <td>above 45°c</td>
                                        <td>20°c-25°c </td>
                                        <td>
                                            25°c-35°c
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Humidity</td>
                                        <td>
                                            <i class="mdi mdi-amazon-clouddrive fa-3x"></i>
                                        </td>
                                        <td>0%-30%</td>
                                        <td>30%-40%</td>
                                        <td>
                                            40%-70%
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>PH</td>
                                        <td>
                                            <i class="mdi mdi-chemical-weapon fa-3x"></i>
                                        </td>
                                        <td>0-5</td>
                                        <td>6</td>
                                        <td>
                                            5-7
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Soil Mositure</td>
                                        <td>
                                            <i class="fa fa-shower fa-3x"></i>
                                        </td>
                                        <td>0-200 and 900-1023</td>
                                        <td>200-400</td>
                                        <td>
                                            400-600
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Water Reservoir</td>
                                        <td>
                                            <i class="mdi mdi-cup-water fa-3x"></i>
                                        </td>
                                        <td>10%-20%</td>
                                        <td>20%-60%</td>
                                        <td>
                                            60%-90%
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <!-- Column -->
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="btn-minimize" data-action="expand"><i
                                    class="mdi mdi-arrow-expand"></i></a>
                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0">Water Level</h4>
                    </div>
                    <div class="card-body collapse show">
                        <div id="water-level1" class="text-center">
                            <canvas id="water-level"></canvas>

                        </div>

                    </div>
                </div>
                <!-- Column -->
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="btn-minimize" data-action="expand"><i
                                    class="mdi mdi-arrow-expand"></i></a>
                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0">NPK Availability</h4>
                    </div>
                    <div class="container text-center clearfix">
                        <div id="line-example"></div>


                    </div>

                </div>
                <!-- Column -->
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="btn-minimize" data-action="expand"><i
                                    class="mdi mdi-arrow-expand"></i></a>
                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0">
                            <!-- Latest Products -->
                            About Agriculture
                        </h4>
                    </div>
                    <div class="card-body p-0 collapse show text-center">
                        <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                            <!-- Carousel items -->
                            <div class="card-body collapse show bg-info">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item flex-column">
                                            <!-- <i class="fa fa-shopping-cart fa-2x text-white"></i> -->
                                            <p class="text-white">“The ultimate goal of farming is not the
                                                growing of
                                                crops, but the cultivation and perfection of human beings. ”


                                            </p>
                                            <!-- <h3 class="text-white font-light">Now Get <span class="font-bold">50%
                                                        Off</span><br>
                                                    on buy</h3> -->
                                            <div class="text-white m-t-20">
                                                <i>~ charles C.Maan</i>
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <!-- <i class="fa fa-shopping-cart fa-2x text-white"></i> -->
                                            <p class="text-white">“Agriculture is our wisest pursuit,because it
                                                will in
                                                the end contribute most to real wealth, good morals,and
                                                happiness.”</p>
                                            <!-- <h3 class="text-white font-light">Now Get <span class="font-bold">50%
                                                        Off</span><br>
                                                    on buy</h3> -->
                                            <div class="text-white m-t-20">
                                                <i>~ Thomas Jefferson</i>
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column active">
                                            <!-- <i class="fa fa-shopping-cart fa-2x text-white"></i> -->
                                            <p class="text-white">“Agriculture was the first occupation of
                                                man,and as
                                                it embraces the whole earth,it is the foundation of all other
                                                industries.”</p>
                                            <!-- <h3 class="text-white font-light">Now Get <span class="font-bold">50%
                                        w                 Off</span><br>
                                                    on buy</h3> -->
                                            <div class="text-white m-t-20">
                                                <i>~ E. W. STEWART</i>
                                            </div>

                                        </div>
                                        <div class="carousel-item flex-column">
                                            <!-- <i class="fa fa-shopping-cart fa-2x text-white"></i> -->
                                            <p class="text-white">In undertaking farming we undertake a
                                                responsibility
                                                covering the whole life cycle. We can break it or keep it whole.


                                            </p>
                                            <!-- <h3 class="text-white font-light">Now Get <span class="font-bold">50%
                                                        Off</span><br>
                                                    on buy</h3> -->
                                            <div class="text-white m-t-20">
                                                <i>~ LORD NORTHBOURNE</i>
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <!-- <i class="fa fa-shopping-cart fa-2x text-white"></i> -->
                                            <p class="text-white">The farmer is the only man in our economy who
                                                buys everything at retail, sells everything at wholesale, and
                                                pays the freight both ways.


                                            </p>
                                            <!-- <h3 class="text-white font-light">Now Get <span class="font-bold">50%
                                                        Off</span><br>
                                                    on buy</h3> -->
                                            <div class="text-white m-t-20">
                                                <i>~ JOHN F. KENNEDY</i>
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <!-- <i class="fa fa-shopping-cart fa-2x text-white"></i> -->
                                            <p class="text-white">Agriculture for an honorable and high-minded
                                                man, is the best of all occupations and arts by which men
                                                procure the means of living.


                                            </p>
                                            <!-- <h3 class="text-white font-light">Now Get <span class="font-bold">50%
                                                        Off</span><br>
                                                    on buy</h3> -->
                                            <div class="text-white m-t-20">
                                                <i>~ XENOPHON</i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->


        <!-- Row -->

        <!-- Row -->
        <!-- Row -->

        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <?php include_once "right-sidebar.php" ?>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer style="color:aliceblue;" class="footer text-center">
        2019 copyright © by Advance Cultivation System (ACS)
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
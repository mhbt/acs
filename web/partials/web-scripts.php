<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="./assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="./assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="./assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="./dark/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="./dark/js/waves.js"></script>
<!--Menu sidebar -->
<script src="./dark/js/sidebarmenu.js"></script>
<!--stickey kit -->
<script src="./assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
<script src="./assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!--Custom JavaScript -->
<script src="./dark/js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--morris JavaScript -->
<script src="./assets/plugins/raphael/raphael-min.js"></script>
<script src="./assets/plugins/morrisjs/morris.min.js"></script>
<!-- sparkline chart -->
<script src="./assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="./assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>


<script type="text/javascript">
        $.ajax({
            type: "GET",
            url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/motor-status/data/last/",
            contentType: "application/json",
            beforeSend: function (jqXHR, settings) {
                jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
            },
            success: function (json) {
                console.log(json);
                $("input[name='motor-status']").bootstrapToggle(json.value == 1 ? 'on' : 'off');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("error :" + XMLHttpRequest.responseText);
            }
        });

        // $.ajax({
        //     type: "GET",
        //     url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/buzzer/data/last/",
        //     contentType: "application/json",
        //     beforeSend: function (jqXHR, settings) {
        //         jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
        //         jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
        //         // jqXHR.setRequestHeader("Access-Control-Allow-Origin", "*");
        //     },
        //     success: function (json) {
        //         console.log(json);
        //         $("input[name='buzzer-status']").bootstrapToggle(json.value == 1 ? 'on' : 'off');
        //     },
        //     error: function (XMLHttpRequest, textStatus, errorThrown) {
        //         console.log("error :" + XMLHttpRequest.responseText);
        //     }
        // });
        setTimeout(() => {
            $(function () {
                $("input[name='motor-status']").change(function () {
                    console.log(this.checked);
                    let data = { "value": this.checked == 1 ? "1" : "0" };
                    data = JSON.stringify(data);
                    $.ajax({
                        type: "POST",
                        url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/motor-status/data",
                        crossDomain: true,
                        dataType: 'json',
                        contentType: "application/json",
                        data: data,
                        beforeSend: function (jqXHR, settings) {
                            jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                            jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
                        },
                        success: function (json) {
                            console.log(json);
                            // $("input[name='motor-status']").bootstrapToggle(json.value == 1 ? 'on' : 'off' );
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            console.log("error :" + XMLHttpRequest.responseText);
                            // $("input[name='motor-status']").bootstrapToggle('off' );
                        }
                    });
                });
            });
            // $(function () {
            //     $("input[name='buzzer-status']").change(function () {
            //         console.log(this.checked);
            //         let data = { "value": this.checked == 1 ? "1" : "0" };
            //         data = JSON.stringify(data);
            //         $.ajax({
            //             type: "POST",
            //             url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/buzzer/data",
            //             contentType: "application/json",
            //             crossDomain: true,
            //             dataType: 'json',
            //             data: data,
            //             beforeSend: function (jqXHR, settings) {
            //                 jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
            //                 jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
            //             },
            //             success: function (json) {
            //                 // $("input[name='buzzer-status']").bootstrapToggle(json.value == 1 ? 'on' : 'off' );
            //             },
            //             error: function (XMLHttpRequest, textStatus, errorThrown) {
            //                 console.log("error :" + XMLHttpRequest.responseText);
            //                 // $("input[name='buzzer-status']").bootstrapToggle('off' );
            //             }
            //         });
            //     });
            // });
        }, 2000);

    </script>
    <script>
        let date = new Date();
        let month = (date.getMonth() + 1);
        if(month <= 9){
            month = "0" + month;
        }
        let end_period = date.getFullYear() + "-" +  month + "-" + (date.getDate());
        console.log(end_period);
        // $.ajax({
        // type: "GET", 
        // url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/temp/data",
        // contentType: "application/json",
        // beforeSend: function(jqXHR, settings){
        //         jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
        //         jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
        //         },
        // success: function(json){
        //     console.log(json);
        // },
        // error: function (XMLHttpRequest, textStatus, errorThrown) {
        //                     console.log("error :"+XMLHttpRequest.responseText);
        //             }
        // });



        // $.ajax({
        // type: "GET", 
        // url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/ph/data/last",
        // contentType: "application/json",
        // beforeSend: function(jqXHR, settings){
        //         jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
        //         jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
        //         },
        // success: function(json){
        //     console.log(json);
        // },
        // error: function (XMLHttpRequest, textStatus, errorThrown) {
        //                     console.log("error :"+XMLHttpRequest.responseText);
        //             }
        // });
    </script>

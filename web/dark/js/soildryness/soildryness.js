 var gauge2 = new RadialGauge({
            renderTo: 'soildry',
            width: 200,
            height: 200,
            units: "Soil Dryness",
            minValue: 0,
            startAngle: 90,
            ticksAngle: 180,
            valueBox: true,
            maxValue: 1024,
            majorTicks: [
                "0",
                "100",
                "200",
                "300",
                "400",
                "500",
                "600",
                "700",
                "800",
                "900",
                "1000",
                "1100"
            ],
            minorTicks: 2,
            strokeTicks: true,
            highlights: [
                {
                    "from": 0,
                    "to": 230,
                    "color": "rgba(200, 50, 50, .75)"

                },
                {
                    "from": 231,
                    "to": 399,
                    "color": "rgba(253, 223, 1,0.75)"

                },
                {
                    "from": 400,
                    "to": 590,
                    "color": "rgba(76, 187, 23,0.75)"

                },
                {
                    "from": 591,
                    "to": 800,
                    "color": "rgba(253, 223, 1,0.75)"

                },
                {
                    "from": 800,
                    "to": 1023,
                    "color": "rgba(200, 50, 50, .75)"

                }
            ],
            colorPlate: "#fff",
            borderShadowWidth: 0,
            borders: false,
            needleType: "arrow",
            needleWidth: 2,
            needleCircleSize: 7,
            needleCircleOuter: true,
            needleCircleInner: false,
            animationDuration: 1500,
            animationRule: "linear"
        }).draw();
        $.ajax({
            type: "GET", 
            url: "https://io.adafruit.com/api/v2/imranshahzad/feeds/moisture/data/last",
            contentType: "application/json",
            beforeSend: function(jqXHR, settings){
                    jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                    jqXHR.setRequestHeader("X-AIO-Key", "6abf656d698d43ccb2bc2e6e2f840d0e");
                    },
            success: function(json){
                gauge2.value  = json.value
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("error :"+XMLHttpRequest.responseText);
                        }
            });
        setInterval(() => {
            $.ajax({
                type: "GET", 
                url: "https://io.adafruit.com/api/v2/imranshahzad/feeds/moisture/data/last",
                contentType: "application/json",
                beforeSend: function(jqXHR, settings){
                        jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                        jqXHR.setRequestHeader("X-AIO-Key", "6abf656d698d43ccb2bc2e6e2f840d0e");
                        },
                success: function(json){
                    gauge2.value  = json.value
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("error :"+XMLHttpRequest.responseText);
                            }
                });
        }, 10000);


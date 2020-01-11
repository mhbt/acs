 var soildrynesss = new RadialGauge({
            renderTo: 'soildryness',
            width: 200,
            height: 200,
            units: "soil dryness",
            minValue: 0,
            startAngle: 90,
            ticksAngle: 180,
            valueBox: true,
            maxValue: 1100,
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
                    "to": 900,
                    "color": "rgba(253, 223, 1,0.75)"
                },
                {
                    "from": 900,
                    "to": 1100,
                    "color": "rgba(200, 50, 50, .75)"
                }
            ],
            colorPlate: "#fff",
            borderShadowWidth: 0,
            borders: true,
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
            url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/moisture/data/last",
            contentType: "application/json",
            beforeSend: function(jqXHR, settings){
                    jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                    jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
                    },
            success: function(json){
                soildrynesss .value  = json.value
                window.eciot_moisture = json.value
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("error :"+XMLHttpRequest.responseText);
                        }
            });
        setInterval(() => {
            $.ajax({
                type: "GET", 
                url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/moisture/data/last",
                contentType: "application/json",
                beforeSend: function(jqXHR, settings){
                        jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                        jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
                        },
                success: function(json){
                    soildrynesss .value  = json.value
                    window.eciot_moisture = json.value
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("error :"+XMLHttpRequest.responseText);
                            }
                });
        }, 10000);






  var temp1 = new RadialGauge({
            renderTo: 'temperature',
            width: 200,
            height: 200,
            units: "Celsius °C",
            minValue: 0,
            startAngle: 0,
            ticksAngle: 350,
            valueBox: true,
            maxValue: 60,
            majorTicks: [
                "0",
                "5",
                "10",
                "15",
                "20",
                "25",
                "30",
                "35",
                "40",
                "45",
                "50",
                "55",
                "60"



            ],
            minorTicks: 2,
            strokeTicks: true,
            highlights: [
                {
                    "from": 0,
                    "to": 10,
                    "color": "rgba(27, 168, 240)"
                },
                {
                    "from": 45,
                    "to": 60,
                    "color": "rgba(200, 50, 50, .75)"
                },
                {
                    "from": 25,
                    "to": 35,
                    "color": "rgba(76, 187, 23,0.75)"
                },
                {
                    "from": 35,
                    "to": 45,
                    "color": "rgba(253, 223, 1,0.75)"

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
            animationRule: "linear",
            animationTarget: "plate"
        }).draw();
        $.ajax({
            type: "GET", 
            url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/temperature/data/last",
            contentType: "application/json",
            beforeSend: function(jqXHR, settings){
                    jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                    jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
                    },
            success: function(json){
                temp1.value = json.value
                window.eciot_temperature = json.value
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("error :"+XMLHttpRequest.responseText);
                        }
            });
        setInterval(() => {
        $.ajax({
            type: "GET", 
            url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/temperature/data/last",
            contentType: "application/json",
            beforeSend: function(jqXHR, settings){
                    jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                    jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
                    },
            success: function(json){
                temp1.value = json.value
                window.eciot_temperature = json.value
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("error :"+XMLHttpRequest.responseText);
                        }
            });
        }, 15000);
  var gauge3 = new LinearGauge({
            renderTo: 'water-level',
            width: 200,
            height: 395,
            units: "water-level %",
            minValue: 0,
            maxValue: 100,
            majorTicks: [
                "0",
                "10",
                "20",
                "30",
                "40",
                "50",
                "60",
                "70",
                "80",
                "90",
                "100"
            ],
            minorTicks: 10,
            strokeTicks: true,
            highlights: [
                {
                    "from": 0,
                    "to": 20,
                    "color": "rgba(200, 50, 50, .75)"
                },
                {
                    "from": 20,
                    "to": 60,
                    "color": "rgba(253, 223, 1,0.75)"
                },
                {
                    "from": 60,
                    "to": 100,
                    "color": "rgba(76, 187, 23,0.75)"
                }
            ],
            colorPlate: "#fff",
            borderShadowWidth: 0,
            borders: false,
            needleType: "arrow",
            needleWidth: 2,
            animationDuration: 1500,
            animationRule: "linear",
            tickSide: "left",
            numberSide: "left",
            needleSide: "left",
            barStrokeWidth: 7,
            barBeginCircle: false,
            value: 75
        }).draw();
        $.ajax({
            type: "GET", 
            url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/reservoir/data/last",
            contentType: "application/json",
            beforeSend: function(jqXHR, settings){
                    jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                    jqXHR.setRequestHeader("X-AIO-Key", KEY);
                    },
            success: function(json){
                gauge3.value  = json.value
                window.eciot_reservoir = json.value
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("error :"+XMLHttpRequest.responseText);
                        }
            });
        setInterval(() => {
            $.ajax({
                type: "GET", 
                url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/reservoir/data/last",
                contentType: "application/json",
                beforeSend: function(jqXHR, settings){
                        jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                        jqXHR.setRequestHeader("X-AIO-Key", KEY);
                        },
                success: function(json){
                    gauge3.value  = json.value
                    window.eciot_reservoir = json.value
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("error :"+XMLHttpRequest.responseText);
                            }
                });
        }, 7000);
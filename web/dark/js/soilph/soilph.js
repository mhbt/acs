
        var ph_gauge = new LinearGauge({
            renderTo: 'ph-guage',
            width: 100,
            height: 200,
            units: "SOIL-ph",
            minValue: 0,
            maxValue: 14,
            majorTicks: [
                "0",
                "1",
                "2",
                "3",
                "4",
                "5",
                "6",
                "7",
                "8",
                "9",
                "10",
                "11",
                "12",
                "13",
                "14"
            ],
            minorTicks: 5,
            strokeTicks: true,
            highlights: [
                {
                    "from": 0,
                    "to": 5.5,
                    "color": "rgba(200, 50, 50, .75)"
                },
                {
                    "from": 5.5,
                    "to": 8,
                    "color": "rgba(76, 187, 23,0.75)"
                },
                {
                    "from": 8,
                    "to": 14,
                    "color": "rgba(27, 168, 240)"

                }
            ],
            colorPlate: "#fff",
            borderShadowWidth: 0,
            borders: false,
            barBeginCircle: false,
            tickSide: "left",
            numberSide: "left",
            needleSide: "left",
            needleType: "line",
            needleWidth: 3,
            colorNeedle: "#EB7077",
            colorNeedleEnd: "#EB7077",
            animationDuration: 1500,
            animationRule: "linear",
            animationTarget: "plate",
            barWidth: 4,
            ticksWidth: 50,
            ticksWidthMinor: 15,
            value: 7
        }).draw();
        $.ajax({
            type: "GET", 
            url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/ph/data/last",
            contentType: "application/json",
            beforeSend: function(jqXHR, settings){
                    jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                    jqXHR.setRequestHeader("X-AIO-Key", KEY);
                    },
            success: function(json){
                ph_gauge.value  = json.value
                window.eciot_ph = json.value
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("error :"+XMLHttpRequest.responseText);
                        }
            });
        setInterval(() => {
            $.ajax({
                type: "GET", 
                url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/ph/data/last",
                contentType: "application/json",
                beforeSend: function(jqXHR, settings){
                        jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                        jqXHR.setRequestHeader("X-AIO-Key", KEY);
                        },
                success: function(json){
                    ph_gauge.value  = json.value
                    window.eciot_ph = json.value
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("error :"+XMLHttpRequest.responseText);
                            }
                });
        }, 15000);
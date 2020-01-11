var humidity_gauge = new RadialGauge({
            renderTo: 'humidity-guage',
            width: 200,
            height: 200,
            units: "Humidity %",
            minValue: 0,
            maxValue: 110,
            highlights: [
                {
                    "from": 0,
                    "to": 30,
                    "color": "rgba(200, 50, 50, .75)"
                },
                {
                    "from": 40,
                    "to": 60,
                    "color": "rgba(76, 187, 23,0.75)"
                },
                {
                    "from": 31,
                    "to": 39,
                    "color": "rgba(253, 223, 1,0.75)"
                }
            ],
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
                "100",
                "110"
            ],
        }).draw();
        $.ajax({
            type: "GET", 
            url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/humidity/data/last",
            contentType: "application/json",
            beforeSend: function(jqXHR, settings){
                    jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                    jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
                    },
            success: function(json){
                humidity_gauge.value  = json.value
                window.eciot_humidity = json.value
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                console.log("error :"+XMLHttpRequest.responseText);
                        }
            });
        setInterval(() => {
            $.ajax({
                type: "GET", 
                url: "https://io.adafruit.com/api/v2/ai_eciot/feeds/humidity/data/last",
                contentType: "application/json",
                beforeSend: function(jqXHR, settings){
                        jqXHR.setRequestHeader("Accept", "application/json; charset=utf-8");
                        jqXHR.setRequestHeader("X-AIO-Key", "aio_yzoE283hddW3jnp4lTaaHZp4tH19");
                        },
                success: function(json){
                    humidity_gauge.value  = json.value
                    window.eciot_humidity = json.value
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    console.log("error :"+XMLHttpRequest.responseText);
                            }
                });
        }, 10000);

/*
 * Play with this code and it'll update in the panel opposite.
 *
 * Why not try some of the options above?
 */
$.ajax({
  type: "GET",
  url: "http://acs.muhammadhassaan.com/api/get-data.php?attr=temperature&period=2018-01-01to"+ end_period + "&interval=week",
  crossDomain: true,
  beforeSend: function (jqXHR, settings) {
    
  },
  success: function (json) {
    console.log(json);
    Morris.Area({
      element: 'temperature1',
      data: json,
      xkey: 'date',
      ykeys: ['temperature'],
      labels: ['temperature'],
      hideHover: 'auto',
      lineColors: ['rgba(247, 211, 7,0.5)'],
      fillOpacity: 0.2,
      pointStrokeColors: ['#4F2404'],
      resize: true
      //   gridLineColor: 'rgba(120, 130, 140, 0.13)'
    }).draw();
    
  },
  error: function (XMLHttpRequest, textStatus, errorThrown) {
    console.log("error :" + XMLHttpRequest.responseText);
  }
});


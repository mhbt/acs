
$.ajax({
  type: "GET",
  url: "http://acs.muhammadhassaan.com/api/get-data.php?attr=ph&period=2018-01-01to"+ end_period + "&interval=week",
  crossDomain: true,
  beforeSend: function (jqXHR, settings) {
    
  },
  success: function (json) {
    console.log(json);
    Morris.Area({
      element: 'soilph1',
      data: json,
      xkey: 'date',
      ykeys: ['ph'],
      labels: ['Soil PH'],
  hideHover: 'auto',
  lineColors: ['#82C38E'],
  fillOpacity: 0.2,
  pointStrokeColors:['#82C38E'],
  resize: true
      //   gridLineColor: 'rgba(120, 130, 140, 0.13)'
    }).draw();
    
  },
  error: function (XMLHttpRequest, textStatus, errorThrown) {
    console.log("error :" + XMLHttpRequest.responseText);
  }
});



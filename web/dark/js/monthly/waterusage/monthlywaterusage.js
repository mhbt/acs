/*
 * Play with this code and it'll update in the panel opposite.
 *
 * Why not try some of the options above?
 */

$.ajax({
  type: "GET",
  url: "http://acs.muhammadhassaan.com/api/get-data.php?attr=reservoir&period=2018-01-01to"+ end_period + "&interval=month",
  crossDomain: true,
  beforeSend: function (jqXHR, settings) {
    
  },
  success: function (json) {
    console.log(json);
    Morris.Area({
      element: 'waterusage2',
      data: json,
      xkey: 'date',
      ykeys: ['reservoir'],
      labels: ['Water Usage'],
  hideHover: 'auto',
  lineColors: ['rgba(0,188,212,0.75)'],
  fillOpacity: 0.2,
  pointStrokeColors:['rgb(0,188,212)'],
  resize: true
      //   gridLineColor: 'rgba(120, 130, 140, 0.13)'
    }).draw();
    
  },
  error: function (XMLHttpRequest, textStatus, errorThrown) {
    console.log("error :" + XMLHttpRequest.responseText);
  }
});





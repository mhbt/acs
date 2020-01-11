$.ajax({
  type: "GET",
  url: "http://acs.muhammadhassaan.com/api/get-data.php?attr=npk&period=2018-01-01to"+ end_period + "&interval=week",
  crossDomain: true,
  beforeSend: function (jqXHR, settings) {
    
  },
  success: function (json) {
    console.log(json);
    Morris.Area({
      element: 'npk1',
      data: json,
      xkey: 'date',
      ykeys: ['nitrogen', 'phosphorous', 'kalium'],
      labels: ['Nitrogen', 'phosporous', 'potasium'],
      hideHover: 'auto',
      lineColors: ['#057B27', '#4B0B7A', '#BF8E43' ],
      fillOpacity: 0.2,
      pointStrokeColors:['#4F2404'],
      resize: true
      //   gridLineColor: 'rgba(120, 130, 140, 0.13)'
    }).draw();
    
  },
  error: function (XMLHttpRequest, textStatus, errorThrown) {
    console.log("error :" + XMLHttpRequest.responseText);
  }
});
// Morris.Area({
//     element: 'npk3',
//     data: [
//       { y: '2006', a: 100, b:200,  c:20 },
//       { y: '2007', a: 75, b: 35,  c:100  },
//       { y: '2008', a: 50, b: 75,  c:300  },
//       { y: '2009', a: 75,  b: 45,  c:200 },
//       { y: '2010', a: 50, b: 55,  c:50 },
//       { y: '2011', a: 75,  b: 65,  c:250 },
//       { y: '2012', a: 100, b: 75,  c:200 }
//     ],
//     xkey: 'y',
//     ykeys: ['a', 'b', 'c'],
//     labels: ['Nitrogen', 'phosporous', 'potasium'],
//     hideHover: 'auto',
//     lineColors: ['#057B27', '#4B0B7A', '#BF8E43' ],
//     fillOpacity: 0.2,
//     pointStrokeColors:['#4F2404'],
//     resize: true
//   //   gridLineColor: 'rgba(120, 130, 140, 0.13)'
//   });
/*
 * Play with this code and it'll update in the panel opposite.
 *
 * Why not try some of the options above?
 */
/*
 * Play with this code and it'll update in the panel opposite.
 *
 * Why not try some of the options above?
 */
/*
 * Play with this code and it'll update in the panel opposite.
 *
 * Why not try some of the options above?
 */
$.ajax({
  type: "GET",
  url: "http://acs.muhammadhassaan.com/api/get-data.php?attr=humidity&period=2018-01-01to"+ end_period + "&interval=week",
  crossDomain: true,
  beforeSend: function (jqXHR, settings) {
    
  },
  success: function (json) {
    console.log(json);
    Morris.Area({
      element: 'humidity1',
      data: json,
      xkey: 'date',
      ykeys: ['humidity'],
      labels: ['humidity'],
      hideHover: 'auto',
      lineColors: ['#009efb'],
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
//   element: 'area-example3',
//   data: [
//     { y: '2006', a: 100 },
//     { y: '2007', a: 75   },
//     { y: '2008', a: 50   },
//     { y: '2009', a: 75   },
//     { y: '2010', a: 50  },
//     { y: '2011', a: 75   },
//     { y: '2012', a: 100 }
//   ],
//   xkey: 'y',
//   ykeys: ['a'],
//   labels: ['SOIL MOISTURE'],
//   hideHover: 'auto',
//   lineColors: ['rgba(189, 145, 115,0.15)'],
//   fillOpacity: 0.2,
//   pointStrokeColors:['#4F2404'],
//   resize: true
// //   gridLineColor: 'rgba(120, 130, 140, 0.13)'
// });


// Morris.Area({
//   element: 'humidity1',
//   data: [
//     { y: '2006', a: 100 },
//     { y: '2007', a: 75   },
//     { y: '2008', a: 50   },
//     { y: '2009', a: 75   },
//     { y: '2010', a: 50  },
//     { y: '2011', a: 75   },
//     { y: '2012', a: 100 }
//   ],
//   xkey: 'y',
//   ykeys: ['a'],
//   labels: ['Humidity'],
//   hideHover: 'auto',
//   lineColors: ['#009efb'],
//   fillOpacity: 0.2,
//   pointStrokeColors:['#4F2404'],
//   resize: true
//   gridLineColor: 'rgba(120, 130, 140, 0.13)'
// });
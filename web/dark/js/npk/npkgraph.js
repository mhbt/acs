// let date = new Date();
setTimeout(()=>{
    console.log(window.eciot_ph);
    let n,p,k;
    if(window.eciot_ph > 1 && window.eciot_ph <=4.4){
        n = 0;
        p=0;
        k= 0;
    }else if (window.eciot_ph > 4.5 && window.eciot_ph <=4.9){
        n = 30;
        p=20;
        k= 50;
    }
    else if (window.eciot_ph > 5 && window.eciot_ph <=5.4){
        n = 40;
        p=35;
        k= 50;
    }
    else if (window.eciot_ph > 5.5 && window.eciot_ph <=5.9){
        n = 70;
        p=45;
        k= 70;
    }
    else if (window.eciot_ph > 6 && window.eciot_ph <=6.9){
        n = 85;
        p=55;
        k= 100;
    }
    else if (window.eciot_ph > 7 && window.eciot_ph <=7.5){
        n = 100;
        p=100;
        k= 100;
    }else if (window.eciot_ph > 7.6 && window.eciot_ph <=8){
        n = 85;
        p=55;
        k= 70;
    }
    else if (window.eciot_ph > 8 && window.eciot_ph <=9){
        n = 70;
        p=45;
        k= 70;
    }
    else if (window.eciot_ph > 9 && window.eciot_ph <=14){
        n = 40;
        p=55;
        k= 50;
    }
    Morris.Bar({
    element: 'line-example',
    data: [
        { y: 'NPK', "n": n, "p": p, "k":k }
        
    ],
    xkey: 'y',
    ykeys: ['n', 'p','k'],
    labels: ['Nitrogen', 'Phophorous','Potassium'],
    hideHover: 'auto',
    

    });
},2000);

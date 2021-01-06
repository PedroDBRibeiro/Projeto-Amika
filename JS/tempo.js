function diaSemana() {
    var d = new Date();
    var weekday = new Array(7);
    weekday[0] = "Domingo";
    weekday[1] = "Segunda-Feira";
    weekday[2] = "Terça-feira";
    weekday[3] = "Quarta-feira";
    weekday[4] = "Quinta-feira";
    weekday[5] = "Sexta-Feira";
    weekday[6] = "Sábado";

    var n = weekday[d.getDay()];

    if(d.getDay() + 1 < 7){
    var n1 = weekday[d.getDay() + 1];
    }
    else var n1 = weekday[(d.getDay() + 1) - 7];
    
    if(d.getDay() + 2 < 7){
    var n2 = weekday[d.getDay() + 2];
    }
    else var n2 = weekday[(d.getDay() + 2) - 7];

    if(d.getDay() + 3 < 7){
    var n3 = weekday[d.getDay() + 3];
    }
    else var n3 = weekday[(d.getDay() + 3) - 7];
    
    if(d.getDay() + 4 < 7){
    var n4 = weekday[d.getDay() + 4];
    }
    else var n4 = weekday[(d.getDay() + 4) - 7];
    
    document.getElementById("hoje").innerHTML = n;
    document.getElementById("amanhã").innerHTML = n1;
    document.getElementById("DPSamanha").innerHTML = n2;
    document.getElementById("DPSamanha2").innerHTML = n3;
    document.getElementById("DPSamanha3").innerHTML = n4;

    }
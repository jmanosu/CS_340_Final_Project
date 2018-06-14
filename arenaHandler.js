var start;
var myVar;
var numChams;
var Chams_name;
var Chams_pow;
var Chams_intel;
var Chams_endu;
var Chams_alive;
var display;

function eventhandler(){
	var randomEvent = Math.floor(Math.random() * 100);
	if(randomEvent >=0 && randomEvent < 30) powerEvent();
	else if (randomEvent >=30 && randomEvent < 60) intellEvent();
	else if (randomEvent >= 60 && randomEvent <90) enduranEvent();
	else DuelEvent();
	winCheck();
}

function winCheck(){
	var display = document.getElementById('displayEvents');
	//var numChams = document.getElementById('numChams').value;
	if(numChams > 1){
		display.innerHTML += "*******************************************\n";
	}
	else{
		var len = Chams_name.length;
		var i;
		var pos;
		for(i=0;i < len;i++){
			if(Chams_alive[i].innerHTML == 1){
				pos = i;
				i = len;
			}
		}
		display.innerHTML += "^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^\n";
		display.innerHTML += Chams_name[pos].innerHTML;
		display.innerHTML += " is the last one alive\n";
		display.innerHTML += "A winnter has been decided, game ends.\n";
		clearInterval(myVar);
	}
}

function powerEvent(){
	//var numChams = document.getElementById('numChams').value;
	//var display = document.getElementById('displayEvents');
	var ranChams = Math.floor(Math.random()*numChams);
	var RNG = Math.floor(Math.random()*100);
	if(RNG - Chams_pow[ranChams].innerHTML > 80){
		numChams --;
		Chams_alive[ranChams].innerHTML = 0;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " is attacked by a black bear, he trys to push it away but failed\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " was killed by the bear\n";
	}
	else if(RNG - Chams_pow[ranChams].innerHTML > 50){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " is attacked by a black bear, he pushes the bear back and runs away\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " is wounded by the bear\n";
		if(Chams_endu[ranChams].innerHTML >= 5) Chams_endu[ranChams].innerHTML--;
		if (Chams_endu[ranChams].innerHTML <= 0){
			display.innerHTML += "The injure is infected and ";
			display.innerHTML += Chams_name[ranChams].innerHTML;
			display.innerHTML += " passed away.\n";
		}
	}
	else if(RNG - Chams_pow[ranChams].innerHTML > 10){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " is attacked by a black bear, but he quickly strikes it with his weapon and the bear runs away\n";
	}
	else{
		Chams_intel[ranChams].innerHTML ++;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " is attacked by a black bear, he beats the bear away with a bare hand\n"
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " feels really good now\n";
	}
}

function intellEvent(){
	//var display = document.getElementById('displayEvents');
	var ranChams = Math.floor(Math.random()*numChams);
	var RNG = Math.floor(Math.random()*100);
	if(RNG - Chams_intel[ranChams].innerHTML > 80){
		numChams --;
		Chams_alive[ranChams].innerHTML = 0;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += "PUT TEXT HERE\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " was killed\n";
	}
	else if(RNG - Chams_intel[ranChams].innerHTML > 50){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += "PUT TEXT HERE\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += "PUT TEXT HERE\n";
		if(Chams_power[ranChams].innerHTML >= 5) Chams_power[ranChams].innerHTML--;
		if (Chams_power[ranChams].innerHTML <= 0){
			display.innerHTML += "PUT TEXT HERE";
			display.innerHTML += Chams_name[ranChams].innerHTML;
			display.innerHTML += " passed away.\n";
		}
	}
	else if(RNG - Chams_intel[ranChams].innerHTML > 10){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " PUT TEXT HERE\n";
	}
	else{
		Chams_endu[ranChams].innerHTML ++;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += "PUT TEXT HERE\n"
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " feels really good now\n";
	}
}

function enduranEvent(){
	//var display = document.getElementById('displayEvents');
	var ranChams = Math.floor(Math.random()*numChams);
	var RNG = Math.floor(Math.random()*100);
	if(RNG - Chams_endu[ranChams].innerHTML > 80){
		numChams --;
		Chams_alive[ranChams].innerHTML = 0;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " PUT TEXT HERE\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " was killed\n";
	}
	else if(RNG - Chams_endu[ranChams].innerHTML > 50){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " PUT TEXT HERE\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " PUT TEXT HERE\n";
		if(Chams_intel[ranChams].innerHTML >= 5) Chams_intel[ranChams].innerHTML--;
		if (Chams_intel[ranChams].innerHTML <= 0){
			display.innerHTML += "PUT TEXT HERE ";
			display.innerHTML += Chams_name[ranChams].innerHTML;
			display.innerHTML += " passed away.\n";
		}
	}
	else if(RNG - Chams_endu[ranChams].innerHTML > 10){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " PUT TEXT HERE\n";
	}
	else{
		Chams_pow[ranChams].innerHTML ++;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " PUT TEXT HERE\n"
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " PUT TEXT HERE\n";
	}
}

function DuelEvent(){
	//var display = document.getElementById('displayEvents');
	var ranCham1 = Math.floor(Math.random()*numChams); //attcker
	var ranCham2 = Math.floor(Math.random()*numChams); //defender
	var randomEvent = Math.floor(Math.random() * 60);
	while(ranCham1 == ranCham2) ranCham2 = Math.floor(Math.random()*numChams);
	var RNG = Math.floor(Math.random()*100);
	if(randomEvent < 20){
		display.innerHTML += Chams_name[ranCham1].innerHTML;;
		display.innerHTML += " tracked down "
		display.innerHTML += Chams_name[ranCham2].innerHTML;;
		display.innerHTML += " and he asks "
		display.innerHTML += Chams_name[ranCham2].innerHTML;;
		display.innerHTML += " to fight with him\n"
		if(RNG > 50 - (Chams_pow[ranCham1].innerHTML - Chams_pow[ranCham2].innerHTML)){
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " PUT TEXT HERE\n"
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			Chams_alive[ranCham1].innerHTML = 0;		
		}
		else{
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " PUT TEXT HERE\n"
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			Chams_alive[ranCham2].innerHTML = 0;
		}
	}
	else if(randomEvent < 40){
		display.innerHTML += Chams_name[ranCham1].innerHTML;
		display.innerHTML += " set a trap for "
		display.innerHTML += Chams_name[ranCham2].innerHTML;
		display.innerHTML += "\n"
		if(RNG > 50 - (Chams_intel[ranCham1].innerHTML - Chams_intel[ranCham2].innerHTML)){
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " PUT TEXT HERE\n"
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			Chams_alive[ranCham1].innerHTML = 0;
		}
		else{
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " PUT TEXT HERE\n"
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			Chams_alive[ranCham2].innerHTML = 0;
		}
	}
	else{
		display.innerHTML += Chams_name[ranCham1].innerHTML;
		display.innerHTML += " ambushed "
		display.innerHTML += Chams_name[ranCham2].innerHTML;
		display.innerHTML += " from the shadow\n"
		if(RNG > 50 - (Chams_endu[ranCham1].innerHTML - Chams_endu[ranCham2].innerHTML)){
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " PUT TEXT HERE\n"
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			Chams_alive[ranCham1].innerHTML = 0;
		}
		else{
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " PUT TEXT HERE\n"
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			Chams_alive[ranCham2].innerHTML = 0;
		}
	}
}

function areaStart(){
	if(start == true){
		myVar = setInterval(eventhandler, 1000);
		start = false;
	}	
}

window.onload = function(){
	display = document.getElementById('displayEvents');
	numChams = document.getElementById('numChams').value;
	Chams_name = document.getElementsByClassName('cNames');
	Chams_pow = document.getElementsByClassName('cPowers');
	Chams_intel = document.getElementsByClassName('cIntells');
	Chams_endu = document.getElementsByClassName('cEndurans');
	Chams_alive = document.getElementsByClassName('cAlives');
	start = true;
}
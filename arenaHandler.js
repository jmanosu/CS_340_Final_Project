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

		display.innerHTML += "^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^\n";
		display.innerHTML += "A winner has been decided, game ends.\n";
		clearInterval(myVar);
		document.getElementById('startButton').hidden = true;
		document.getElementById('resetButton').hidden = false;
	}
}

function powerEvent(){
	//var numChams = document.getElementById('numChams').value;
	//var display = document.getElementById('displayEvents');
	var ranChams = Math.floor(Math.random()*numChams);
	var RNG = Math.floor(Math.random()*100);
	if(RNG - Chams_pow[ranChams].innerHTML > 80){
		numChams --;
		removeChams(Chams_name[ranChams].innerHTML);
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
	updateChams(Chams_name[ranChams].innerHTML,
				Chams_pow[ranChams].innerHTML,
				Chams_intel[ranChams].innerHTML,
				Chams_endu[ranChams].innerHTML);
}

function intellEvent(){
	//var display = document.getElementById('displayEvents');
	var ranChams = Math.floor(Math.random()*numChams);
	var RNG = Math.floor(Math.random()*100);
	if(RNG - Chams_intel[ranChams].innerHTML > 80){
		numChams --;
		removeChams(Chams_name[ranChams].innerHTML);;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " saw a wild bear\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " ran away from wild bear\n";
	}
	else if(RNG - Chams_intel[ranChams].innerHTML > 50){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " found a machete on the ground\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " put the machete in his backpack\n";
		if(Chams_pow[ranChams].innerHTML >= 5) Chams_pow[ranChams].innerHTML--;
		if (Chams_pow[ranChams].innerHTML <= 0){
			display.innerHTML += " ate some posion berrys";
			display.innerHTML += Chams_name[ranChams].innerHTML;
			display.innerHTML += " passed away.\n";
		}
	}
	else if(RNG - Chams_intel[ranChams].innerHTML > 10){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " fell asleep under the trees\n";
	}
	else{
		Chams_endu[ranChams].innerHTML ++;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " used medical supplies\n"
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " feels really good now\n";
	}
	updateChams(Chams_name[ranChams].innerHTML,
				Chams_pow[ranChams].innerHTML,
				Chams_intel[ranChams].innerHTML,
				Chams_endu[ranChams].innerHTML);
}

function enduranEvent(){
	//var display = document.getElementById('displayEvents');
	var ranChams = Math.floor(Math.random()*numChams);
	var RNG = Math.floor(Math.random()*100);
	if(RNG - Chams_endu[ranChams].innerHTML > 80){
		numChams --;
		removeChams(Chams_name[ranChams].innerHTML);;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " was crushed by a bolder\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " was killed\n";
	}
	else if(RNG - Chams_endu[ranChams].innerHTML > 50){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " realized someone took his food\n";
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " screamed in rage\n";
		if(Chams_intel[ranChams].innerHTML >= 5) Chams_intel[ranChams].innerHTML--;
		if (Chams_intel[ranChams].innerHTML <= 0){
			display.innerHTML += " slowly bleed out due to a wound";
			display.innerHTML += Chams_name[ranChams].innerHTML;
			display.innerHTML += " passed away.\n";
		}
	}
	else if(RNG - Chams_endu[ranChams].innerHTML > 10){
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " hid from other champions\n";
	}
	else{
		Chams_pow[ranChams].innerHTML ++;
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " fashioned a spear\n"
		display.innerHTML += Chams_name[ranChams].innerHTML;
		display.innerHTML += " sharpened his spear\n";
	}
	updateChams(Chams_name[ranChams].innerHTML,
				Chams_pow[ranChams].innerHTML,
				Chams_intel[ranChams].innerHTML,
				Chams_endu[ranChams].innerHTML);
}

function DuelEvent(){
	//var display = document.getElementById('displayEvents');
	var ranCham1 = Math.floor(Math.random()*numChams); //attcker
	var ranCham2 = Math.floor(Math.random()*numChams); //defender
	var randomEvent = Math.floor(Math.random() * 60);
	while(ranCham1 == ranCham2) ranCham2 = Math.floor(Math.random()*numChams);
	var RNG = Math.floor(Math.random()*100);
	if(randomEvent < 20){
		display.innerHTML += Chams_name[ranCham1].innerHTML;
		display.innerHTML += " tracked down "
		display.innerHTML += Chams_name[ranCham2].innerHTML;
		display.innerHTML += " and he asks "
		display.innerHTML += Chams_name[ranCham2].innerHTML;
		display.innerHTML += " to fight with him\n"
		if(RNG > 50 - (Chams_pow[ranCham1].innerHTML - Chams_pow[ranCham2].innerHTML)){
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " couldn't find food\n"
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			removeChams(Chams_name[ranCham1].innerHTML);;
		}
		else{
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " was posioned\n"
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			removeChams(Chams_name[ranCham2].innerHTML);;
		}
	}
	else if(randomEvent < 40){
		display.innerHTML += Chams_name[ranCham1].innerHTML;
		display.innerHTML += " set a trap for "
		display.innerHTML += Chams_name[ranCham2].innerHTML;
		display.innerHTML += "\n"
		if(RNG > 50 - (Chams_intel[ranCham1].innerHTML - Chams_intel[ranCham2].innerHTML)){
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " a spear flew out of no where\n"
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			removeChams(Chams_name[ranCham1].innerHTML);;
		}
		else{
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " got attacked while sleeping\n"
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			removeChams(Chams_name[ranCham2].innerHTML);;
		}
	}
	else{
		display.innerHTML += Chams_name[ranCham1].innerHTML;
		display.innerHTML += " ambushed "
		display.innerHTML += Chams_name[ranCham2].innerHTML;
		display.innerHTML += " from the shadow\n"
		if(RNG > 50 - (Chams_endu[ranCham1].innerHTML - Chams_endu[ranCham2].innerHTML)){
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " saw a bunny rabbit in the bushes\n"
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " caught it with a trap\n";
			numChams --;
			removeChams(Chams_name[ranCham1].innerHTML);;
		}
		else{
			display.innerHTML += Chams_name[ranCham1].innerHTML;
			display.innerHTML += " shot in the new by an arrow\n"
			display.innerHTML += Chams_name[ranCham2].innerHTML;
			display.innerHTML += " was killed\n";
			numChams --;
			removeChams(Chams_name[ranCham2].innerHTML);;
		}
	}
	updateChams(Chams_name[ranCham1].innerHTML,
				Chams_pow[ranCham1].innerHTML,
				Chams_intel[ranCham1].innerHTML,
				Chams_endu[ranCham1].innerHTML);
	updateChams(Chams_name[ranCham2].innerHTML,
				Chams_pow[ranCham2].innerHTML,
				Chams_intel[ranCham2].innerHTML,
				Chams_endu[ranCham2].innerHTML);
}

function areaStart(){
	if(start == true){
		myVar = setInterval(eventhandler, 1000);
		start = false;
	}
}

function areaReset(){
	display.innerHTML = "";
	start = true;
	document.getElementById('startButton').hidden = false;
	document.getElementById('resetButton').hidden = true;
}

function updateChams(name,pow,intell,endu){
	 if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("GET","updateChams?name="+name+"&power="+pow+"&intell="+intell+"&endu="+endu,true);
        xmlhttp.send();
  }

function removeChams(name){
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.open("GET","removeChams.php?name="+name,true);
        xmlhttp.send();
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

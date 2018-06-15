function RerollStats(){
	var level = document.getElementById('level').value;
	var power = 5 * level + Math.floor(Math.random()*5);
	var intelligence = 5 * level + Math.floor(Math.random()*5);
	var endurance = 5 * level + Math.floor(Math.random()*5);
	document.getElementById('power').value = power;
	document.getElementById('intelligence').value = intelligence;
	document.getElementById('endurance').value = endurance;
	CalcCredits();
}

function CalcCredits(){
	var level = document.getElementById('level').value;
	var cost = Number(document.getElementById('power').value);
	cost += Number(document.getElementById('intelligence').value);
	cost += Number(document.getElementById('endurance').value);
	cost = Math.floor(cost / 10);
	document.getElementById('cost').innerHTML = "Cost: " + cost;
	document.getElementById('costs').value = cost;
}


function isBlank(inputField){
    if(inputField.type=="checkbox"){
		if(inputField.checked)
			return false;
		return true;
    }
    if (inputField.value==""){
		return true;
    }
    return false;
}

//function to highlight an error through colour by adding css attributes tot he div passed in
function makeRed(inputDiv){
   	inputDiv.style.backgroundColor="#AA0000";
	//inputDiv.parentNode.style.backgroundColor="#AA0000";
	inputDiv.parentNode.style.color="#FFFFFF";
}

//remove all error styles from the div passed in
function makeClean(inputDiv){
	inputDiv.parentNode.style.color="#000000";
}


window.onload = function(){
		RerollStats();
    var myForm = document.getElementById("addCham");

    //all inputs with the class required are looped through
    var requiredInputs = document.querySelectorAll(".required");
    	for (var i=0; i < requiredInputs.length; i++){
			requiredInputs[i].onfocus = function(){
				this.style.backgroundColor = "#EEEE00";
			}
    }

    //on submitting the form, "empty" checks are performed on required inputs.
    myForm.onsubmit = function(e){
		var requiredInputs = document.querySelectorAll(".required");
			for (var i=0; i < requiredInputs.length; i++){
				if( isBlank(requiredInputs[i]) ){
					e.preventDefault();
					makeRed(requiredInputs[i]);
				}
				else{
					makeClean(requiredInputs[i]);
				}
			}
			if ( !checkPswds() ) {
				e.preventDefault();
			}
		}
}

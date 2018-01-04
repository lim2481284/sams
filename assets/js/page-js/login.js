

//Background cover animation
$('.grad').mousemove(function(e){
	var amountMovedX = (e.pageX * -1 / 50);
	var amountMovedY = (e.pageY * -1 / 10);
	$('.body').css('background-position', amountMovedX + 'px ' + amountMovedY + 'px');
});



$(".loginRegisterToggle").click(function(){
	
	$(".toggleElement").animate({			
		height: "toggle",
		opacity:"toggle"
		
	},"slow");
});



function check()
{
	var pass1 = document.getElementById('pass');
	var pass2 = document.getElementById('confirmpass');
	if(pass1.value != pass2.value)
	{
		alert("Password Not Match");
		return false;
	}
}

function checkPass()
{
	var pass1 = document.getElementById('pass');
	var pass2 = document.getElementById('confirmpass');	
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
	if(pass2.value){
		if(pass1.value == pass2.value){
			pass2.style.backgroundColor = goodColor;			

		}else{
			pass2.style.backgroundColor = badColor;			

		}
	}
}
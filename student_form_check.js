function validateForm(studentForm){
	var firstName = document.getElementById("first_name").value;
	var lastName = document.getElementById("last_name").value;
	var ID = document.getElementById("ID_number").value;
	var email = document.getElementById("email").value;
	var reason = document.getElementById("reason").value;
	var idCheck = /^(W|w)[0-9]{7}$/;

	if(!firstName){
		alert("Please enter your first name");
		return false;
	}
	if(!lastName){
		alert("Please enter your last name");
		return false;
	}
	if(!ID){
		alert("Please enter your student ID");
		return false;
	}
	if(!email){
		alert("Please enter your e-mail address");
		return false;
	}
	if(!reason){
		alert("Please enter your reason for needing the class.");
		return false;
	}
	
	if(!idCheck.test(ID)){
		alert("Please enter a valid Student ID.");
		return false;
	}

	return true;
}

function Login(){
	var pseudo=document.login.pseudo.value;
	var username=pseudo.toLowerCase();
	var password=document.login.password.value;
	password=password.toLowerCase();
	if (pseudo=="student" && password=="iitu") {
	    alert("Use this password to confirm the completion of the lab!");
	} else { 
	    alert("Try again!"); 
	}
}

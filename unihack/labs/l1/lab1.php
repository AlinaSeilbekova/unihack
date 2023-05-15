<html>
<head>
<script type="text/javascript" src="login.js"></script>
</head>
<style>
	div{
		margin-top: 50px;
		margin-left: 50px;
	}
	.usern{
		margin-bottom: 15px;
	}
	a{
		padding: 5px;
		background-color: #e7e7e7;
		border-radius: 10px;
		text-decoration: none;
		color: black;
	}
	.login{
		background-color: #e7e7e7;
	}

</style>

<body>

	<div>
    <!-- <fieldset style="margin-top: 10px; padding: 10px; width=60%; color: red; border-color: red;"> -->
	<b>Login</b><br/>
	<form name="login" method="POST" action="">
	    Username : <input name="pseudo" class="usern"><br>
	    Password : <input type="password" name="password"><br><br>
	    <input onclick="Login()" type="button" value="login" name="button" class="login">
	</form>
	<a href="/../labPage">Back to lab page</a>
</div>

	
    <!-- </fieldset> -->
</body>
</html>
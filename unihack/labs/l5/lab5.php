<?php
$password="DrinkEnergyDrinkWithoutSugar";


echo '<html><body>


<h1>Login </h1>

<form>
    Password&nbsp;<input type="password" value="" name="password"/><br/>
    <input type="submit" value="login" />
</form>';


if ( isset($_GET["password"]) && $_GET["password"] == $password ){
    echo '<h3>Use this password to confirm the completion of the lab!</h3>';
}

if ( isset($_GET["password"]) && $_GET["password"] != $password ){
    echo '<h4>Try again!</h4>';
}
















































echo '





<!--
                                                                                                                                                                                                                                                        Je crois que c\'est vraiment trop simple là !
                                                                                                                                                                                                                                                            It\'s really too easy !
                                                                                                                                                                                                                                                                 password : '.$password.'

-->

</body></html>';

?>
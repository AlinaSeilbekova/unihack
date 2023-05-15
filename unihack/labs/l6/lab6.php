<?php
echo '<html><body>';

$password='SecurityIsOurProfession!';
echo "<h3>";
if (strcmp(strtolower($_SERVER['HTTP_USER_AGENT']),"admin")==0){
    echo "Welcome master!<br/>Password: $password";
} else {
    echo 'Wrong user-agent: you are not the "admin" browser!';
}
echo "</h3>";

echo '</body></html>';
?>

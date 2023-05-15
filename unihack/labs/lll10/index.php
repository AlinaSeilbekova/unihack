<?php
$FLAG = "qa26f3ugb5tqv7o0mbvtv414u8";

session_start();
// if ($_SERVER["SERVER_ADDR"] == $_SERVER["REMOTE_ADDR"]){
//     session_id($FLAG);
// }

function getFilename($phpsessid){
    return $filename = getcwd()."/tmp/".$phpsessid."_".microtime(true).".json";
}

function printAllMessages(){
    $files = glob(getcwd()."/tmp/".session_id()."_*");
    if(is_array($files)){
        foreach(array_reverse($files) as $filename)
            printMessages($filename);
    }

}
function printMessages($filename, $admin=false){
    $message = json_decode(file_get_contents($filename), true);
    print "<hr>\n";
    if ($message['status'] == "admin"){
        $message['message'] = "<span style='color:blue'>message read by the administrator</span>";
    }
    else if($admin){
        // admin
        $message['status'] = "admin";
        file_put_contents($filename,json_encode($message, JSON_PRETTY_PRINT));
    }
    print "<p style='font-weight:bold'>".$message['title']."</p>\n";
    print "<p>".nl2br($message['message'])."</p>\n";
}


$msg_saved=false;

$filename = getFilename(session_id());
if (!empty($_POST["title"]) && !empty($_POST["message"])) {

    // if(!preg_match("/^[a-zA-Z0-9_ \-]+$/",$_POST["title"]))
    //     die("Hacker detected!");

    $filters = array(
        "/<script|<embed|<iframe|<img|alert\(|confirm\(|prompt\(|javascript\s*:|eval\(|url\(|document\./i",
        "/<input|<select|<textarea|<marquee|<body|<meta|<audio|<video/i",
        "/=\s*['\"]|&#|\(\s*['\"]|\[\s*['\"]|=\s*\]|`/",
        "/onload\s*=|onerror\s*=|href\s*=|data\s*=|style\s*=|code\s*=|data\s*=|src\s*=/i",
    );
    // foreach($filters as $filter){
    //     if(preg_match($filter, $_POST['message']))
    //         die("Hacker detected!");
    //}

    $message = array(
        "title" => $_POST["title"], 
        "message" => $_POST["message"], 
        "status" => "unread",
        "date" => time(),
    );
    file_put_contents($filename,json_encode($message, JSON_PRETTY_PRINT));
    $msg_saved=true;
}


?>
<html>
    <head>
      <title>Messages</title>
    </head>
    <body>
        <h1>Write your message:</h1>

	<?php
            $status = "student";
            if (session_id() == $FLAG){
                //$status = "admin";
                $status = "student";
               //print "<h3 style='color:green'>Vous pouvez valider ce challenge avec ce mot de passe / You can validate the challenge with this password : $FLAG</h3>";
            }

            if ($msg_saved){
                print "<p style='color:green;font-weight:bold;'>Message posted</p>";
            }
	?>
	<hr>
	<div style="text-align: right; float:right;">You are: <?php print $status; ?></div>
        <form action="index.php" method="post" style="clear:both">
            <div>
                Topic :<br>
                <input type="text" name="title" value="" style="width:400px;" />
            </div>
            <div>
	       Content :<br>
	        <textarea name="message" style="width:400px;height:80px;"></textarea>
	    </div>
	    <div style="padding-top:10px;">
	        <input type="submit" value="Envoyer / Send" />
	    </div>
        </form>

        <br>
        <div>
            <h2>Messages :</h2>
            <p>Write what you want</p>
            <?php
                // admin
                if ($_SERVER["SERVER_ADDR"] == $_SERVER["REMOTE_ADDR"] && !empty($_GET['f']) ){
                    $filename = getcwd()."/tmp/".$_GET['f'];
                    if (file_exists($filename)){
                        printMessages($filename, $admin=true);
                    }
                } 
                // user
                else {
                    printAllMessages();
                }
            ?>
        </div>
        <br>
    </body>
</html>


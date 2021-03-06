<?PHP
session_start();
$user = $_SESSION['loggued_on_user'];
if (strlen($user) == 0) {
	echo "not logged\n";
	return ;
}
if ($_POST['msg']) {
	$msg = $_POST['msg'];
	if (strlen($msg) == 0)
		return ;
	if (file_exists("../htdocs/private/chat") == TRUE) {
		$fd = fopen("../htdocs/private/chat", "rw");
		flock($fd, LOCK_SH);
		$messages = unserialize(file_get_contents("../htdocs/private/chat"));
		flock($fd, LOCK_UN);
		fclose($fd);
	}
	else
		$messages = array();
	date_default_timezone_set("Europe/Paris"); 
	$message = array("login" => $_SESSION['loggued_on_user'], "time" => time(), "msg" => $msg);
	array_push($messages, $message);
	file_put_contents("../htdocs/private/chat", serialize($messages));
}
?>
<html>
	<head>
	<title>Chat</title>
	<style ="text/css">
		.button {
			margin-left: 8%;
			position: absolute;
			margin-top: 10px;
		}
		.txt {
			overflow: auto;
			resize: none;
			outline: none;
			height: 100%;
			width: 80%
		}
	</style>
	<script> setInterval(function(){top.frames['chat'].location = 'chat.php'}, 1000)</script>
	</head>
	<body>
		<form action="speak.php" method="POST">
			<input class="txt" placeholder="Message" name="msg" value=""/>
			<input class="button" type="submit"  name="submit" value="Envoyez"/>
		</form>
	</body>
</html>

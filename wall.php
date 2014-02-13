<?php
	session_start();
	require('connection.php');
	// var_dump($_SESSION);
	if(!isset($_SESSION['logged_in']))
				{
					// echo 'not logged in';
					header("location:index.php");
				}
	if(isset($_SESSION['greeting'])) 
		{
			echo $_SESSION['greeting'];
		}
		if(isset($_POST['logoff']))
		{
			unset($_POST['logoff']);
			unset($_SESSION['greeting']);
			unset($_SESSION['logged_in']);
			unset($_POST['hidden']);
			header("location:index.php");
		}


?>
<html>
<head>
	<meta charset="UTF-8" name="description" content="wall page">
	<title>Wall</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/wall.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">
        // function refreshPage () {
        //     var page_y = document.getElementsByTagName("body")[0].scrollTop;
        //     window.location.href = window.location.href.split('?')[0] + '?page_y=' + page_y;
        // }
        // window.onload = function () {
        //     setTimeout(refreshPage, 35000);
        //     if ( window.location.href.indexOf('page_y') != -1 ) {
        //         var match = window.location.href.split('?')[1].split("&")[0].split("=");
        //         document.getElementsByTagName("body")[0].scrollTop = match[1];
        //     }
        // }
    </script>
	
</head>
<body>
	<div id="container">
		<?php include_once ('./header.php'); ?>
		<h1>WELCOME TO FACEWALL</h1>
		<div>
			<form id="logoff" method="post" action="process.php">
				<input type="hidden" name="logoff" value="logoff">
				<input type="submit" value="sign off">
			</form>
		</div>
		<div>
			<form id="message" method="post" action="wall.php">
				<p>Post a message</p>
				<input type="hidden" name="hidden" value="message">
				<textarea name="message" rows="6" cols="80" placeholder="Type in message here"></textarea>
				<input id = 'submit' type="submit" value="Post a message" id="submity"> 
			</form>
		</div><!--end of message box-->
		<div class="box">
			<p><span>this should be red</span></p>
		</div>
	</div><!--end of container-->
</body>
</html>

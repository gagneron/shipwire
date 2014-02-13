<?php

	session_start();
	require('connection.php');
	$_SESSION['message'] = '';

	if(isset($_POST['action']) and $_POST['action'] =="login")
	{
		$logerrors = NULL;

		//login email
		if(empty($_POST['login_email']))
		{
			$logerrors[] = "Email field is empty";
		}
		elseif(filter_var($_POST['login_email'], FILTER_VALIDATE_EMAIL) == FALSE)
		{
			$logerrors[] = "Email format is incorrect";
		}

		//login password
		if(empty($_POST['login_password']))
		{
			$logerrors[] = "Password field is empty";
		}
		elseif (strlen($_POST['login_password'])<7) 
		{
			$logerrors[] = "Password must contain at least 7 characters";
		}

		
		$_SESSION['invalid'] = NULL;

		if($logerrors== NULL)
		{
			
			$selectsql = "SELECT id, first_name, email, password FROM users WHERE email='".$_POST['login_email']."' AND password='".$_POST['login_password']."'";
			$users = fetch_all($selectsql);
			

			if((count($users))!= 0)
			{
				$_SESSION['user_email'] = $users[0]['email']; //to be used for wall comments
				$_SESSION['user_id'] = $users[0]['id'];  //to be used in wall comment query
				$_SESSION['greeting'] = "Hello ".$users[0]['first_name']."!";
				$_SESSION['logged_in'] = true;
				header("location:wall.php");
			}
			else
			{
				$_SESSION['invalid'] = "User/password is invalid";
				header("location:index.php");
			}
		}
		else
		{
			$_SESSION['logerrors'] = $logerrors;
			header("location:index.php");
		}

	}

	elseif(isset($_POST['action']) and $_POST['action']=="registration")
	{
		$errors = NULL;
		$_SESSION['first_name'] = $_POST['first_name'];
		$_SESSION['last_name'] = $_POST['last_name'];
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['password'] = $_POST['password'];
		$_SESSION['confirm'] = $_POST['confirm_password'];
		$_SESSION['date'] = $_POST['birth_date'];
		//First name
		if(empty($_POST['first_name']))
		{
			$errors[] = "First name field is empty";
		}
		else if(is_numeric($_POST['first_name']))
		{
			$errors[] = "Invalid name: cannot contain numbers";
		}

		//last name
		if(empty($_POST['last_name']))
		{
			$errors[] = "Last name field is empty";
		}
		else if(is_numeric($_POST['last_name']))
		{
			$errors[] = "Invalid name: cannot contain numbers";
		}

		//email
		if(empty($_POST['email']))
		{
			$errors[]= "Email field is empty";
		}
		elseif(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == FALSE)
		{
			$errors[] = "Email format is invalid";
		}


		//password
		if (empty($_POST['password'])) 
		{
			$errors[] = "Password field is empty";
		}
		elseif (strlen($_POST['password'])<7)
		{
			$errors[] = "Password should be at least 7 characters";
		}

		//password confirm
		if (empty($_POST['confirm_password'])) 
		{
			$errors[] = "Confirm password field is empty";
		}
		elseif ($_POST['password'] != $_POST['confirm_password'])
		{
			$errors[] = "Passwords do not match";
		}

		//date
		if(!empty($_POST['birth_date']))
		{	$date = array(0,0,0);
			$date = explode("/", $_POST['birth_date']);
			if ((count($date) == 3) AND (is_numeric($date[0])) AND (is_numeric($date[1])) AND (is_numeric($date[2]))) 
			{	
				if (checkdate($date[0], $date[1], $date[2]))
				{
				   
				}
				else
				{
					 $success[] = "Date format is incorrect";
				} 
			}
			else
			{
				$errors[] = "Date format is incorrect";
			}
		}
		if($errors == NULL)
		{
			$selectsql = "SELECT id, first_name, email, password FROM users WHERE email='".$_POST['email']."'";
			$userz = fetch_all($selectsql);

			if((count($userz))== 0)
			{
				$_SESSION['greeting'] = "Welcome to Facewall, ".$_POST['first_name']."!";

				$_SESSION['user_email'] = $_POST['email']; //to be used for wall comments
				
				$insertsql = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
				VALUES ('".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['email']."', '".$_POST['password']."', NOW(), NOW())";
				mysql_query($insertsql);

				$selectsql = "SELECT id FROM users WHERE email='".$_POST['email']."'";
				$selectsql = fetch_all($selectsql);
				$selectsql2 = "SELECT id, first_name, email, password FROM users WHERE email='".$_POST['email']."'";
				$selectsql2 = fetch_all($selectsql2);
				$_SESSION['user_id'] = $selectsql2[0]['id'];  //to be used in wall comment query
				// var_dump($_SESSION['user_id']);
				$_SESSION['logged_in'] = true;
				header("location:wall.php");
				
			}
			else
			{
				$_SESSION['invalid'] = "You already exist! Please use login instead.";
				header("location:index.php");
			}
		}
		else
		{
			$_SESSION['error_messages'] = $errors;
			header("location:index.php");
		}
	}

	elseif(isset($_POST['logoff']) and $_POST['logoff'] =="logoff")
	{
		unset($_SESSION['logged_in']);
		header("location:index.php");

	}
	
?>

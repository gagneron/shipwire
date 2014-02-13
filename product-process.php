<?php 
	session_start();
	require('connection.php');

	$_SESSION = "";


	function addProduct()
	{
		mysql_query("INSERT INTO products (name, description, width, length, height, weight, value, created_at, updated_at)
			VALUES ('{$_POST['name']}', '{$_POST['description']}', '{$_POST['width']}', '{$_POST['length']}',  '{$_POST['height']}', '{$_POST['weight']}',  '{$_POST['value']}', NOW(), NOW())");
			
		//fetching data to display on edits page
		$_SESSION['allProducts'] = fetch_all("SELECT id, name, description, width, length, height, weight, value  FROM products ORDER BY updated_at DESC LIMIT 0, 20");

		$_SESSION['count'] = fetch_record("SELECT COUNT(id) as 'count' from products");

		header("location:edit.php");
	}


	function validate()
	{

		$errors = [];
		foreach($_POST as $key => $field)
		{
		
			$field = trim($field);
			$field = filter_var($field, FILTER_SANITIZE_STRING);
			$_POST[$key] = $field;
			$_SESSION[$key] = $field;

			if((!isset($field)) || (!$field) || ($field == ""))
			{
				$errors[] = "The ".$key." field is empty.";
			}
			if(($key !== 'description') && (strlen($field)>45))
			{
				$errors[] = "The ".$key." field must be limited to 45 characters";
			}
			if(($key == 'description') && (strlen($field)>10000))
			{
				$errors[] = "Desription is limited to 10,000 characters";
			}
			if($key == 'name' || $key == 'description')
			{
				if(!is_string($field))
				{
					$errors[] = ucfirst($key)." field is invalid.";
				}
			}
			if(($field) && ($key == 'width' || $key == 'length' || $key == 'height' || $key == 'weight' || $key == 'value'))
			{
				if(!is_numeric($field))
				{
					$errors[] = "The ".$key." field must be numeric.";
				}	
			}		
		}

		if (empty($errors)) addProduct(); // This is an important function
		
		else
		{
			$_SESSION['errors'] = $errors;
			header("location:index.php");
		}
	}

	
	validate();
		
	

	//trim words
	//could use a validator to check for weird characters
		//escape real_escape_string
?>
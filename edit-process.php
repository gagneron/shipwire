<?php
	session_start();
	require('connection.php');

	function pagination()
	{		
		$itemsPerPage = 20;
		$number = ($_POST['page-number']-1)*$itemsPerPage;
	
		$_SESSION['allProducts'] = fetch_all("SELECT id, name, description, width, length, height, weight, value  FROM products ORDER BY updated_at DESC LIMIT {$number},{$itemsPerPage} ");

		$data['allProducts'] = $_SESSION['allProducts'];
		// $data['hi'] = 'nothing';
		echo json_encode($data);
		
	}


	if(isset($_POST['action']) && $_POST['action'] == 'pagination') pagination();

	if(isset($_POST['deleteRow']) && ($_POST['deleteRow'] !== ""))
	{
		mysql_query("DELETE FROM products WHERE id = {$_POST['deleteRow']}");
		

		$data['deleted'] = TRUE;
		echo json_encode($data);
	}
	

	// header("location:edit.php");
?>

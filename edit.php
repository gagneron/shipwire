<?php
	session_start();
	require('connection.php');

?>
<html>
<head>
	<meta charset="UTF-8" name="description" content="wall page">
	<title>Wall</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/edit.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
	<script type="text/javascript" src="js/edit.js"></script>
	
</head>
<body>
	<div class="container">
		<?php include_once ('./header.php'); ?>
		<h1>Products</h1>
		<div class="pagination">

			<ul>
				<?php 
					$totalItems = $_SESSION['count']['count'];
					$itemsPerPage = 20;
					if($totalItems != 0)
					{
						for($i=1; $i<=$totalItems; $i+= $itemsPerPage)
						{	
							echo "<li>".ceil($i/$itemsPerPage)."</li>";
						}
					}
				?>
			</ul>
			<form method="get" action="edit-process.php" id="paginationForm">
				<input type="hidden" name="action" value="pagination"/>
				<input type="hidden" name="page-number"/>
			</form>
		</div>
		<table class="productsTable" id='table'>
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>W</th>
					<th>L</th>
					<th>H</th>
					<th>W</th>
					<th>Value</th>
					<th><button id="btnAdd">Add Product</button></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($_SESSION['allProducts'] as $singleProduct)
					{
						echo "<tr id='id".$singleProduct['id']."'>";
						// echo "<td id='"+$singleProduct['id']+"'></td>";


						foreach($singleProduct as $key=>$attribute)
						{
							if($key !== 'id')
							{
								echo "<td>".$attribute."</td>";								 
							}
						}
						echo "<td><img src='images/edit.png' class='btnEdit hidden'/></td>";
						echo "<td><img src='images/delete.png' class='btnDelete hidden'/></td>";
						echo "</tr>";
					}
				?>
			</tbody>
			
			<!-- these forms are hidden -->
		
		</table>
			<form action= "edit-process.php" method="post" id="updateForm" />
					<input type="hidden" id= "productId" name="productId" />
					<input type="hidden" id= "name" name="name" />
					<input type='hidden' id="description" name="description" />
					<input type ="hidden" id="width" name="width"/>
					<input type = "hidden" id="length" name="length" />
					<input type = "hidden" id="height" name="height" />
					<input type = "hidden" id= "weight" name="weight" />
					<input type = "hidden" id= "value" name="value"/>			
			</form>
			<form action= "edit-process.php" method="post" id="deleteForm" >
					<input type = "hidden" id= "deleteRow" name="deleteRow"/>			
			</form>



		<?php //var_dump($_SESSION); ?>
	</div>
</body>
</html>
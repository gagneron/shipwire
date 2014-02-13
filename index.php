<?php session_start();
	require('connection.php');
	// $_SESSION = "";
	// session_destroy();
	// unset($_SESSION);
?>
<html>
<head>
	<title>New Product</title>
	<meta charset="UTF-8" name="description" content="New Product">
	<meta name='viewport' content='width=device-width'>
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<div class='container'>
		<?php include_once ('./header.php'); ?>
		<h1>Add a Product</h1>
		<div class="errors">
			<?php 
			 // unset($_SESSION);
				if(isset($_SESSION['errors']))
				{
					echo "<p>The following errors were encountered:</p>";
					echo "<ul>";
					foreach($_SESSION['errors'] as $error)
					{
						echo "<li>".$error."</li>";
					}
					echo "</ul>";
				}
			?>
		</div>
		<form action= "product-process.php" method="post" id="productForm" >
			
			

				<div class='inputDiv' id='nameDiv'>
					<label for="name">Product Name*</label>
					<input type="text" id= "name" name="name" placeholder="enter product name" value="<?php echo $_SESSION['name']; ?>">
					<p class="errorBox">Field is required</p>
				</div>

				<div class='inputDiv' id='descriptionDiv'>
					<label for="description">Description*</label>
					<textarea cols='40' rows='10' type = "text" id="description" name="description" placeholder="enter a description" ><?php echo $_SESSION['description']; ?></textarea>
					<p class="errorBox">Field is required</p>
				</div>
			
			<fieldset class='dimensions'>
				<legend>Dimensions</legend>
				<div class='inputDiv'>
					<label for="width">Width*</label>
					<input type ="text" id="width" name="width" placeholder="0.0" value="<?php echo $_SESSION['width']; ?>">
					<p class="errorBox">Please enter a numeric value</p>
					<label for="width">in</label>
				</div>

				<div class='inputDiv'>
					<label for="length">Length*</label>
					<input type = "text" id="length" name="length" placeholder="0.0" value="<?php echo $_SESSION['length']; ?>">
					<p class="errorBox">Please enter a numeric value</p>
					<label for="length">in</label>
				</div>

				<div class='inputDiv'>
					<label for="height">Height*</label>
					<input type = "text" id="height" name="height" placeholder="0.0" value="<?php echo $_SESSION['height']; ?>">
					<p class="errorBox">Please enter a numeric value</p>
					<label for="height">in</label>
				</div>

				<div class='inputDiv'>
					<label for="weight">Weight*</label>
					<input type = "text" id= "weight" name="weight" placeholder="0.0" value="<?php echo $_SESSION['weight']; ?>">
					<p class="errorBox">Please enter a numeric value</p>
					<label for="weight">in</label>
				</div>
			</fieldset>
			

			<div class='inputDiv'>
				<label for="value">Value*</label>
				<input type = "text" id= "value" name="value" value="<?php echo $_SESSION['value']; ?>">
				<p class="errorBox">Please enter a numeric value</p>
				<label for="value">$</label>
			</div>

				<button id='submit' type="submit" name="submit" value="submit">Submit</button>
				<button id='clear' type="submit" name="clear" value="clear">Clear</button>
			
		</form>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
	<script src="js/index.js"></script> 
</body>
</html>

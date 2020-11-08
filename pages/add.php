<?php
	/***********************************************/
    /****** Author: solomon              ***********/
    /****** Desc: Code for adding to  bug report***
     ******            ********************
     ******  *****			**********************
     ******    									*******/
    /****** Date Created: dd-mm-yyyy 06-07-2019 ********/
    /******  ****************************************/
	/**********************************************/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add</title>
	<link rel="stylesheet" type="text/css" href="../css/basic.css">
</head>
</head>
<body>
	<?php
		echo "<br>";

		if(empty($_POST['product']) || empty($_POST['version'] || empty($_POST['solution'])))
		{
			echo "please enter your details";
		}	
		else
		{	
			echo "<a href=../main_page.php>Back to Home</a>"."<br>";
			//include the db connection
			include '../include/db_connect.php';

			//grabs what the user types in
			//bind it to the stmt_bind_parameter
			$product = htmlentities($_POST["product"]);
			$version = htmlentities($_POST["version"]);
			$solution = $_POST["solution"];

			$query_select = "INSERT INTO bugreports VALUES(NULL,?,?,?,NULL)";
			//the ? is a placeholder it tells mysqli whatever we replace it should be treated as data 

			//prepare the statement and assigning the parameters of connection and the query
			if($stmt = mysqli_prepare($conn,$query_select))
			{

			 //binds the variable to a prepared statement as parameters
			 //the purpose of bind_param it tells php which variables that should be substituted for the ?	
			//binds the variable to what the user typed in
			  mysqli_stmt_bind_param($stmt,"sds",$product,$version,$solution);

			  //this runs the query
			  //execute the result
			  if(mysqli_stmt_execute($stmt))
			  {

			  	echo "Insert Into tables successfully ";

			  }	else{echo "Error Inserting to Tables".mysqli_error($conn);}
					echo "<br>";

			}else{echo "Error preparing the statement ".mysqli_error($conn);}	
				echo "<br>";

			mysqli_stmt_close($stmt);
			mysqli_close($conn);
		}

	?>

	<form action="add.php" method="POST">
		<fieldset>
			<p>Product Name <input type="text" id="productname" name="product"></p>
			<p>Version <input type="text"  id="version" name="version"></p>
			<p>Solution <input type="text" id="solution" name="solution"></p>
			<input type="submit" name="submit" value="Submit">
		</fieldset>
	</form>
</body>
</html>
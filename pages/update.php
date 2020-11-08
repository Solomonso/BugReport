<?php
	/***********************************************/
    /****** Author: solomon              ***********/
    /****** Desc: Code for updating bug report***
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
	<title>Update</title>
	<link rel="stylesheet" type="text/css" href="../css/basic.css">
</head>
<body>

<?php
    //include db connection
	include '../include/db_connect.php';
	echo "<a href=../main_page.php>Back Home</a>"."<br>";

	if(isset($_POST['update']))
	{
		//? is a place holder for the data to be inserted
		$query = "UPDATE bugreports SET product_name =?,version=?,solution=? WHERE bug_id=?";

		//grab what the user typed in again 
		//for updating purpose
		//bind the variable to the stmt_bind_parameter
		$product_name = $_POST["product"];
		$version = $_POST["version"];
		$solution = $_POST["solution"];

		if($stmt=mysqli_prepare($conn,$query))
		{
			 //the purpose of bind_param it tells php which variables that should be substituted for the ?	
			//binds the variable to what the user typed in
			mysqli_stmt_bind_param($stmt,"sdsi",$product_name,$version,$solution,$_GET["id"]);
			if(mysqli_stmt_execute($stmt))
			{
				echo "Updated Successfully";
				echo "<br>";
			
			}else{echo "Unable to Update ".mysqli_error($conn);}

			mysqli_stmt_close($stmt);
		}else{echo "Unable to Prepare ".mysqli_error($conn);}	
	}	

		echo "<br>";



	//using the where clause in the select as the condition(restriction)
	$query_select = "SELECT product_name,version,solution FROM bugreports WHERE bug_id=?";

	if($stmt = mysqli_prepare($conn,$query_select))
	{
		//binds the id
		//use the $_GET to access the id via the url
		//using the bind_param because of the restriction in where clause
		mysqli_stmt_bind_param($stmt,"i",$_GET["id"]);
		
		if(mysqli_stmt_execute($stmt))
		{
			echo "Query Executed "."<br>";
		
		}else{echo "Query Execution Failed ".mysqli_error($conn);}	

		//bind result is for select type queries
		mysqli_stmt_bind_result($stmt,$product_name,$version,$solution);
		mysqli_stmt_store_result($stmt);

		while(mysqli_stmt_fetch($stmt))
		{}

	mysqli_stmt_free_result($stmt);
	mysqli_stmt_close($stmt);
	}else{echo "Unable to prepare query ".mysqli_error($conn);}	

	mysqli_close($conn);
?>
<form action="" method="POST">
	<fieldset>
		<p>Product Name <input type="text" name="product" id="productname" value="<?php echo $product_name;?>"></p>
		<p>Version <input type="text" name="version" id="version" value="<?php echo $version;?>"></p>
		<p>Solution <input type="text" name="solution" id="solution" value="<?php echo $solution;?>"></p>
		<input type="submit" name="update" value="Submit">
	</fieldset>	
	</form>
</body>
</html>
<?php
	/***********************************************/
    /****** Author: solomon              ***********/
    /****** Desc: Code for deleting from bug report***
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
	<title>Delete</title>
</head>
<body>
	<?php
		echo "<a href=../main_page.php>Back Home</a>"."<br>";
		echo "<br>";
		//include db connection
		include '../include/db_connect.php';
		//? it's just a placeholder
		$query_delete = "DELETE FROM bugreports WHERE bug_id=?";

		if($stmt = mysqli_prepare($conn,$query_delete))
		{
			//binds the id
			//use the $_GET to access the id via the url
			mysqli_stmt_bind_param($stmt,"i",$_GET["id"]);

			if(mysqli_stmt_execute($stmt))
			{
				echo "Deleted Successful";

			}else{echo "Error Deleteing ".mysqli_error($conn);}	

		}else{echo "Error Preparing the statement".mysqli_error($conn);}	

		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	?>
</body>
</html>
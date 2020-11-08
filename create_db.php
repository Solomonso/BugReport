<?php
	/***********************************************/
    /****** Author: solomon              ***********/
    /****** Desc: Code for creating database and table***
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
	<title>bug reports</title>
</head>
<body>
	<?php
		$conn = mysqli_connect("localhost","root","");

		if(!$conn)
		{
			echo "error connecting to the server".mysqli_error($conn);
		}
		else{echo "Connected to the server successfully"."<br>";}

		$db_name = "CREATE DATABASE bug_report";

		if($stmt = mysqli_prepare($conn,$db_name))
		{
			if(mysqli_stmt_execute($stmt))
			{
				echo "Database created successfully";

			}else{echo "Unable to create database";
				die(mysqli_error($conn));}	

				mysqli_stmt_close($stmt);

		}else{echo "Unable to prepare statement ".mysqli_error($conn);}

			echo "<br>";

		mysqli_select_db($conn,"bug_report");

		$db_table = "CREATE TABLE bugreports 
					(
					  bug_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					  product_name VARCHAR(128),
					  version REAL,
					  solution VARCHAR(128),
					  time TIMESTAMP
						);";

	    if($stmt = mysqli_prepare($conn,$db_table))
	    {
	    	if(mysqli_stmt_execute($stmt))
	    	{
	    		echo "Table created successfully";
	    	}else{echo "Error creating table ".mysqli_error($conn);}	
	    
	    	mysqli_stmt_close($stmt);

	    }else{echo "Unable to prepare statement ".mysqli_error($conn);}

	    mysqli_close($conn);

	?>
</body>
</html>
<?php
	/***********************************************/
    /****** Author: solomon              ***********/
    /****** Desc: Code that displays bug reports***
     ******  a link to add, delete and update     ********************
     ******  *****			**********************
     ******    									*******/
    /****** Date Created: dd-mm-yyyy 06-07-2019 ********/
    /******  ****************************************/
    /**********************************************/

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>
	<?php
		include 'include/db_connect.php';

		$query = "SELECT bug_id,product_name,version,solution,time FROM bugreports";

		if($stmt = mysqli_prepare($conn,$query))
		{
			
			//bind result is for select type queries
			//bind the column up in select, as  variables;
			mysqli_stmt_bind_result($stmt,$bug_id,$product,$version,$solution,$time);

			//excute the statement
			if(mysqli_stmt_execute($stmt))
			{
				echo "Executed Successfull"."<br>";

			}else{echo "Unable to execute statement".mysqli_error($conn);}	

			echo "<br>";

			mysqli_stmt_store_result($stmt);

			echo "<h2>Current Bug reports</h2>";
			echo "<table border=1px solid black;>";
			echo "<th>Product Name</th> <th>Version</th> <th>Solution</th> <th>Time of Bug</th>";

			echo "<a href=pages/add.php>Add a New Bug</a>"."<br>"."<br>";

			while(mysqli_stmt_fetch($stmt))
			{

				echo "<tr>";

				echo "<td>".$product."</td>";
				echo "<td>".$version."</td>";
				echo "<td>".$solution."</td>";
				echo "<td>".$time."</td>";

				//when the user clicks on the Edit
				//the id is sent to the the update.php
				//To access the id use $_GET
				echo "<td> <a href=pages/update.php?id=$bug_id>Edit</a></td>";
				echo "<td> <a href=pages/delete.php?id=$bug_id>Delete</a></td>";
 				//when the user clicks on the Delete
				//the id is sent to the the delete.php
				//To access the id use $_GET

				//? works  with a get parameter
				echo "</tr>";

			}

			echo "</table>";

			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
			mysqli_close($conn);

		}else{echo "Unable to prepare ".mysqli_error($conn);}	
	?>
</body>
</html>
<?php 
    	$conn = mysqli_connect("localhost","root","","bug_report");
		if(!$conn)
		{
			echo "Unable to connect to server ".mysqli_error($conn);

			echo "<br>";

		}else{echo "Connection Successfull"."<br>";}	

?>
<div class="w-100 h-100 p-3  border border-secondary rounded-top">
<h1 style="text-align: center;">Movie Site</h1>
</div>

<br>

			 <table width="100%"  border="0" class="table">

					<tr>
						<th  scope="col">Movie Name</th>
			            <th scope="col">Rating</th>
			            <th scope="col">Release Date</th>
			            <th scope="col">Genre</th>
			            <th scope="col">Language</th>
					</tr>

<?php
			session_start();
			$varname=$_GET['varname'];

			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "moviedb";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			$sql = "SELECT * FROM `moviedetails` WHERE `mName`= '".$varname."' ";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
 ?>




        
        <tr>
                
              <td scope="row" style="text-align: center;"><?php echo $row['mName'];?> </td>
              <td scope="row" style="text-align: center;"><?php echo $row['Rating'];?></td>
              <td scope="row" style="text-align: center;"><?php echo $row['releaseDate'];?></td>
              <td scope="row" style="text-align: center;"><?php echo $row['genrename'];?></td>
              <td scope="row" style="text-align: center;"><?php echo $row['languagename'];?></td>
             
           
            </tr>
<?php
    }
} 
else 
{
    echo "0 results";
}
$conn->close();
?>

 </table>

 
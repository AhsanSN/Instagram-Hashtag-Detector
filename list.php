<!--database connection-->
<?php
    
$host='localhost';
$username='anomozco_chatuser1';
$user_pass='XhJ6a~U%C_Ws';
$database_in_use='anomozco_chat';

$con = mysqli_connect($host,$username,$user_pass,$database_in_use);
if (!$con)
{
    echo"not connected";
}
if (!mysqli_select_db($con,$database_in_use))
{
    echo"database not selected";
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>
</head>
<body>

<table id="customers">
  <tr>
    <th>Username</th>
    <th>URL</th>
  </tr>
  <?php
  
  $email_query = "SELECT * FROM hashtagPosts";
            $result      = $con->query($email_query);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>".$row['url']."</td>";
                    echo "</tr>";
                    
                }
            }
  
  ?>


</table>

</body>
</html>

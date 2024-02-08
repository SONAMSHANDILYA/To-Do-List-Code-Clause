<?php
$con=mysqli_connect("localhost","root","","List");
$id=$_REQUEST["a"];

$r=mysqli_query($con,"delete from Todo_list where id='$id'");

if($r)
     header("location:index2.php");
?>
    

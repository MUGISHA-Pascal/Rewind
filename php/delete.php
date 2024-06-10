<?php
include 'config.php';

if(isset($_POST["ids"]))
{
    $ids =  json_decode($_POST["ids"]);
   
 foreach($ids as $id)
 {
  $query = "DELETE FROM clients WHERE id = '$id'";
  mysqli_query($conn, $query);
 }
}
?>
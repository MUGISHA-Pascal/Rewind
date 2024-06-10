<?php
include "config.php";
if(isset($_POST['input'])){
    $input=$_POST['input'];
    if($input!==""){
    $query="SELECT * FROM clients WHERE std_name LIKE '{$input}%' OR id LIKE '{$input}%' OR std_age LIKE '{$input}%' OR std_country LIKE '{$input}%'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){?>
<table class="table table-bordered table-striped mt-4">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Year</th>
            <th>Insurance problem</th>
        </tr>
    </thead>
    <tbody>
      <?php
while($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $name=$row['std_name'];
    $year=$row['std_age'];
    $Insuranceproblem=$row['std_country'];

    
      ?>
      
      <tr>
        <td><?php echo $id ?></td>
        <td><?php echo $name ?></td>
        <td><?php echo $year ?></td>
        <td><?php echo $Insuranceproblem ?></td>
      </tr>
      <?php
}
?>
    </tbody>
</table>
        
<?php
    }else{
        echo "<h6 class='text-danger text-center mt-3'>No data Found</h6>";
    }
}else{
    echo "";
}
}

?>
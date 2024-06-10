<?php

include 'config.php';

// if(isset($_POST["name"]) || isset($_POST["age"]) || isset($_POST["country"])){
    $input=file_get_contents("php://input");
    $decode=json_decode($input,true);

    $name=$decode["name"];
    $insurance = array("Home insurance"=>3000, "Auto insurance"=>5000, "Health insurance"=>6000, "Life insurance"=>7000);
    

    
    $age=$decode["age"];
    $country=$decode["country"];

    if($insurance[$country]){

        $sql="INSERT INTO clients (std_name,std_age,std_country) VALUES ('$name','$age','$country')";
        $run_sql=mysqli_query($conn,$sql);
    if($run_sql ){
        
        echo json_encode(["success"=>true,"message"=>$insurance[$country]]);
    }else{
        echo json_encode(["success"=>false,"message"=>"Server Problem"]);
    }
    }
  
    
// }

?>
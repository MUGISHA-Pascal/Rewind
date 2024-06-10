<?php  
include "config.php";
 $record_per_page = 5;  
 $page = '';  
 $output = '';  
 if(isset($_POST["page"]))  
 {  
      $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }                       
 $start_from = ($page - 1)*$record_per_page;  
 $query = "SELECT * FROM clients ORDER BY id DESC LIMIT $start_from, $record_per_page";  
 $result = mysqli_query($conn, $query);  
 $output .= "  
      <table class='table table-bordered'>  
           <tr>            
                <th width='100px' height='40px'>Name</th>  
                <th width='100px'>Age</th>
                <th width='200px'>Insurance problem</th>
           </tr>  
 ";  
 while($row = mysqli_fetch_array($result))  
 {  
      $output .= '  
           <tr>  
  
                <td>'.$row["std_name"].'</td>  
                <td>'.$row["std_age"].'</td>
                <td>'.$row["std_country"].'</td>
           </tr>  
      ';  
 }  
 $output .= '</table><br /><div align="center">';  
 $page_query = "SELECT * FROM clients ORDER BY id DESC";  
 $page_result = mysqli_query($conn, $page_query);  
 $total_records = mysqli_num_rows($page_result);  
 $total_pages = ceil($total_records/$record_per_page);  
 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
 }  
 $output .= '</div><br /><br />';  
 echo $output;  
 ?> 
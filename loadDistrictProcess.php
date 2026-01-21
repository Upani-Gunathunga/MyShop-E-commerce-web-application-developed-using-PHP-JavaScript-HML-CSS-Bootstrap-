<?php

require "connection.php";

if(isset($_GET["p"] )){
    $province_id = $_GET["p"];
   
    
    $districtrs = Database::search("SELECT * FROM `district`  WHERE 
    `province_province_id`='".$province_id."' ");
    $district_num = $districtrs->num_rows;

    for($x=0; $x< $district_num; $x++ ){
        $district_data = $districtrs->fetch_assoc();

       

         
         ?>
         <option value="<?php echo $district_data["district_id"];  ?>">
        <?php   echo $district_data["district_name"];  ?>
        </option>
         
         <?php

    }
}

?>
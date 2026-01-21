<?php

require "connection.php";

if(isset($_GET["d"] )){
    $district_id = $_GET["d"];
   
    
    $cityrs = Database::search("SELECT * FROM `city`  WHERE 
    `district_district_id`='".$district_id."' ");
    $city_num = $cityrs->num_rows;

    for($x=0; $x< $city_num; $x++ ){
        $city_data = $cityrs->fetch_assoc();

       

         
         ?>
         <option value="<?php echo $city_data["city_id"];?>">
        <?php   echo $city_data["city_name"];  ?>
        </option>
         
         <?php

    }
}

?>
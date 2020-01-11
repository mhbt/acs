<?php
    $result = $db->query("SELECT * FROM disease_data ORDER BY id DESC LIMIT 9");
    if($result){
        if($result->num_rows){
            while($dp = $result->fetch_assoc()){
                $plant_data[] = $dp;
            }
        }
    }


    // var_dump($plant_data);
    if(count($plant_data) > 0){
        foreach($plant_data as $dp){
            $max = 0;
            $disease = "Normal";
            foreach($dp as $k => $v){
                if($k == "id" || $k == "image"){
                    continue;
                }
                if($max < $v){
                    $max = $v;
                    $disease = $k;
                }
            }
            $disease_name = str_replace("_", " ",$disease);
            $disease_name = ucwords($disease_name);
            // echo $disease_name . "<br>";
            // echo $disease. "<br>";
            ?>
            <div class="col-md-4 mt-4">
                <a href="<?= $dp['image']?>" title="<?= $max . "% " . $disease_name ?>"> <img src="<?= $dp['image']?>" class="img-responsive" alt="img" /> </a>
            </div>
            <?php
        }
    }
?>
<!-- <div class="col-md-4">
    <a href="../assets/images/big/img1.jpg" title="Caption. Can be aligned to any side and contain any HTML."> <img src="../assets/images/big/img4.jpg" class="img-responsive" alt="img" /> </a>
</div>
<div class="col-md-4">
    <a href="../assets/images/big/img2.jpg" title="This image fits only horizontally."> <img src="../assets/images/big/img5.jpg" class="img-responsive" alt="img" /> </a>
</div>
<div class="col-md-4">
    <a href="../assets/images/big/img3.jpg"> <img src="../assets/images/big/img6.jpg" class="img-responsive" alt="img" /> </a>
</div>
<div class="col-md-4">
    <a href="../assets/images/big/img3.jpg"> <img src="../assets/images/big/img6.jpg" class="img-responsive" alt="img" /> </a>
</div> -->

<?php


$url2 = "./glanz.json";
$getfile2 = file_get_contents($url2);
$array_from_json_self = json_decode($getfile2, true);


if(isset($_POST['submit'])){

    if(!empty($_POST['channel'])) {

        foreach($_POST['channel'] as $value){



            $array2 = array($value);
            $result = array_merge($array_from_json_self, $array2);


            $result2 = json_encode($result, true);

            file_put_contents('glanz.json', $result2);
        }

    }

}


header("Location: ../glanz_table.php"); 
exit();




?>
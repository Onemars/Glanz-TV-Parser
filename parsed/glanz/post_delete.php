<?php


error_reporting(-1);
ini_set('display_errors', 'On');


$url2 = "glanz.json";
$getfile2 = file_get_contents($url2);
$array_from_json_self = json_decode($getfile2, true);


 if(isset($_POST['submit'])){

    if(!empty($_POST['channel'])) {

        foreach($_POST['channel'] as $value){


       $numbers= json_decode($getfile2,true); //json decode numbers ar
       
       if (($key = array_search($value, $numbers)) !== false) {
        unset($numbers[$key]);
        $numbers = array_values($numbers);
    }
    $numbers_final = json_encode($numbers);
  


}

}

}

    file_put_contents('glanz.json', $numbers_final);


header("Location: ../glanz_table.php"); 
exit();




?>
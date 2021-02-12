
<?php

header('Content-Type: text/plain');
error_reporting(-1);
ini_set('display_errors', 'On');

$url = "https://adresas_iki_parersio/parser/m3u-parser-simple.php?url=https://glanz_playlisto_adresas";
$getfile = file_get_contents($url);
$array_from_m3u = json_decode($getfile, true);


$url2 = "./glanz.json";
$glanz = file_get_contents($url2);
$search = json_decode($glanz, true);

// lyginame du json failus
foreach ($search as $key){
$found = array_filter($array_from_m3u,function($v,$k) use ($key){
  return $v['tvtitle'] == $key;
},ARRAY_FILTER_USE_BOTH);


foreach($found as $data)
{
// triname nereikalingus zodzius is playlisto     
$delete_array = array(" CEE", "(test)", " PREMIUM+", " HD", " FHD", " (FHD)", " (Naujiena!)");
$for_logos = str_replace($delete_array, '', $data['tvtitle']);
echo "#EXTINF:-1 tvg-id=\"";
echo $data['tvid']; 
echo '"';
echo " tvg-logo=\"";
echo $data['tvlogo'];
echo "\" group-title=\"";
// pasikeiciame grupe jeigu reikia
echo $data['tvgroup'];
echo "\"";
echo ' timeshift="';
echo $data['timeshift'];
echo '"';
echo ' catchup-days="';
echo $data['catchup-days'];
echo '"';
echo ' catchup-type="';
echo $data['catchup-type'];
echo '",';
echo str_replace($delete_array, '', $data['tvtitle']);
echo "\n";
echo $data['tvmedia'];
echo "\n";

}
}
<html>

<head>

    <title>Parser Glanz</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>
    <script type="text/javascript" src="../js/jquery.min.js"></script>

    <style>
.hidden{
  opacity:0;
  /*  OR   */
  position:absolute;
  left:-9999px;
}

input[type=button], input[type=submit], input[type=reset] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 7px 32px;
  text-decoration: none;
  margin: 0px 0px;
  cursor: pointer;
}

</style>


<script>
$(window).scroll(function() {
  sessionStorage.scrollTop = $(this).scrollTop();
});

$(document).ready(function() {
  if (sessionStorage.scrollTop != "undefined") {
    $(window).scrollTop(sessionStorage.scrollTop);
  }
});
</script>

<head>
<div class="uk-container uk-container-xsmall">
<br>
<h1 class="uk-heading-divider">Glanz parser</h1>
<div class="uk-column-1-2@s uk-column-1-3@m uk-column-divider uk-comment-primary uk-margin-small uk-align-center">



<?php
$url = "https://adresas_iki_parersio/parser/m3u-parser-simple.php?url=https://glanz_playlisto_adresas";
$getfile = file_get_contents($url);
$array_from_m3u = json_decode($getfile, true);


$url2 = "./glanz/glanz.json";
$getfile2 = file_get_contents($url2);
$array_from_json_self = json_decode($getfile2, true);


$result = is_int(array_reduce($array_from_json_self, function ($previous, $current) {
  return is_int($previous) && $current >= $previous;
}, PHP_INT_MIN));


// channel stats
echo '<b>Update: </b>';
echo $result ? 'New Channels!!' : 'No New';
echo $result;


$arr2= array_column($array_from_m3u, 'tvtitle');
echo '<br>';
echo '<b>All Channels: </b>';
echo count($arr2);
echo '<br>';
echo '<b>Added Channels: </b>';
echo count($array_from_json_self);
echo "</div>";

$disabled_channels = array_diff($arr2, $array_from_json_self);


// first table
echo '<table class="uk-table uk-table-striped uk-table-hover uk-table-small uk-table-middle uk-text-secondary">';
echo   "<thead>";
echo        "<tr>";
echo            "<th class=\"uk-table-expand\">Channel Name</th>";
echo           "<th class=\"uk-table-shrink\">Remove</th>";
echo       "</tr>";
echo    "</thead>";
echo    "<tbody>";
foreach ($array_from_json_self as $channel_enabled){
echo       "<tr>";
echo            "<td>";
echo         $channel_enabled;
echo              "</td>";
echo            "<td>";
echo           "<form method=\"post\" action=\"./glanz/post_delete.php\">";
echo           "    <input class=\"uk-checkbox\ hidden\" type=\"checkbox\" name='channel[]' value=\"$channel_enabled\" checked=\"true\">";
echo           "    <input type=\"submit\" value=\"Remove\" name=\"submit\">";
echo           "</form>";
echo           "</td>";
echo       "</tr>";
}
echo    "<tbody>";
echo "</table>";


// second table
echo '<table class="uk-table uk-table-striped uk-table-hover uk-table-small uk-table-middle uk-text-emphasis">';
echo   "<thead>";
echo        "<tr>";
echo            "<th class=\"uk-table-expand\">Channel Name</th>";
echo            "<th class=\"uk-table-shrink\">Add</th>";
echo       "</tr>";
echo    "</thead>";
echo    "<tbody>";
foreach ($disabled_channels as $key){
echo       "<tr>";
echo            "<td>";
echo         $key;
echo              "</td>";
echo           "<td>";
echo           "<form method=\"post\" action=\"./glanz/post.php\">";
echo           "    <input class=\"uk-checkbox\ hidden\" type=\"checkbox\" name='channel[]' value=\"$key\" checked=\"true\">";
echo           "    <input type=\"submit\" value=\"Add\" name=\"submit\">";
echo           "</form>";
echo "</td>";
echo       "</tr>";
}
echo    "<tbody>";
echo "</table>";

?>

</div>

</html>
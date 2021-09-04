<?php
// echo "<h1>";
//     print_r($_POST);
// echo "</h2>";
$var=4;
//echo $_POST['name'];
$fp = fopen('results.json', 'r');
$json = json_decode(file_get_contents("results.json"), true);
//array_push($json,array("id":"3","category":"water bottle","description":"small water bottle","price":"2.99","qty":"1"))

$newitem=array("id"=>$_POST['name']["id"],"category"=>$_POST['name']["category"],"description"=>$_POST['name']["description"],"price"=>$_POST['name']["price"],"qty"=>$_POST['name']["qty"]);
array_push($json,$newitem);
echo($json);
print_r($json);
fclose($fp);
file_put_contents("results.json",json_encode($json));
//$fp = fopen('results.json', 'w');
//fwrite($fp, $json);
//fwrite($fp,",")
//fclose($fp);
?>
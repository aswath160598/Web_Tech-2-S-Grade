<?php
$json = json_decode(file_get_contents("results.json"), true);
$jsond = json_decode(file_get_contents("item1.json"), true);
//print_r($json);
$arr=array();
$chair=array();
$mirror=array();
$chest=array();
$lamp=array();
for($i=0;$i<count($json);$i=$i+1){
$y=(string)$i;
$cat = $json[$y]["category"];
$qty = $json[$y]["qty"];
//echo $qty;
if(array_key_exists($cat,$arr)){
    $arr[$cat]+=$qty;
}
else{
    $arr[$cat]=$qty;
}
}
for($i=0;$i<count($jsond);$i+=1){
    $y=(string)$i;
    $cat1=$jsond[$y]["category"];
    if($cat1=="chair"){
        array_push($chair,$jsond[$y]);
    }
    else if($cat1=="lamp"){
        array_push($lamp,$jsond[$y]);
    }
    else if($cat1=="chest"){
        array_push($chest,$jsond[$y]);
    }
    else if($cat1=="mirror"){
        array_push($mirror,$jsond[$y]);
    }
}
$total=array_sum(array_values($arr));
//echo $total;
$key=array_keys($arr);
$prob=array();
$const=4;
for($i=0;$i<count($arr);$i+=1){
    $prob[$key[$i]]=round(($arr[$key[$i]]/$total)*$const);
}
$res=array();
//print_r(array_keys($prob)[0]);
if(count($prob)==1){
    if(array_keys($prob)[0]=="chair"){
        $res=$chair;
    }
    else if(array_keys($prob)[0]=="mirror"){
        $res=$mirror;
    }
    else if(array_keys($prob)[0]=="lamp"){
        $res=$lamp;
    }
    else if(array_keys($prob)[0]=="chest"){
        $res=$chest;
    }
}
else{
    if(array_key_exists("chair",$prob)){
    for($i=0;$i<$prob["chair"];$i+=1){
        array_push($res,$chair[$i]);
    }
    }
    if(array_key_exists("lamp",$prob)){
    for($i=0;$i<$prob["lamp"];$i+=1){
        array_push($res,$lamp[$i]);
    }
    }
    if(array_key_exists("mirror",$prob)){
    for($i=0;$i<$prob["mirror"];$i+=1){
        array_push($res,$mirror[$i]);
    }
    }
    if(array_key_exists("chest",$prob)){
    for($i=0;$i<$prob["chest"];$i+=1){
        array_push($res,$chest[$i]);
    }
    }
}
//print_r($res);
//echo $res[0]["photo"];
$imar=array();
$cap=array();
for($i=0;$i<count($res);$i+=1){
    array_push($imar,$res[$i]["photo"]);
    $cap[(string)$res[$i]["photo"]]=$res[$i]["description"];
}
$j=0;
//print_r($cap);
echo "
<!DOCTYPE html>
<html>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<style>

.button {
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 18px;
  padding: 10px;
  width: 100px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  float:left;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '>>';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: '';
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

div.footer {
    margin-top: 9%;
    margin-bottom: 0;
    width: 100%;
    background-color: whitesmoke;
}

.addr {
    margin-left: 12%;
    margin-right: 18%;
    text-align: center;
    width: 35%;
    display: inline-block;
    font-size: 16px;
    color: gray;
    padding: 3%;
}
.icon{
    margin: 1.5%;
    display: inline-block;
    max-height: 26px;
    max-width: 26px;
}

.icon:hover{
    cursor: pointer;
}

div.cont{
   background: radial-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url('logi.jpg');
    width: 100%;
}

.recom{
font-family: 'Comic Sans MS';
color:maroon;
font-weight:bold;
text-shadow: 1px 1px #d41b06;
font-size:350%;
}

</style>
<body>
<form>
<button class='button' type='submit' formaction='index.html' ><span>Home </span></button></form><br>
<h2 style='text-align:center' class='recom'><i>Smart Recommendations</i></h2>

<div class='row'>
  <div class='column'>
    <img src='loading.gif' style='width:100%' onclick='openModal();currentSlide(1)' class='hover-shadow cursor'>
  </div>
  <div class='column'>
    <img src='loading.gif' style='width:100%' onclick='openModal();currentSlide(2)' class='hover-shadow cursor'>
  </div>
  <div class='column'>
    <img src='loading.gif' style='width:100%' onclick='openModal();currentSlide(3)' class='hover-shadow cursor'>
  </div>
  <div class='column'>
    <img src='loading.gif' style='width:100%' onclick='openModal();currentSlide(4)' class='hover-shadow cursor'>
  </div>
</div>

<div id='myModal' class='modal'>
  <span class='close cursor' onclick='closeModal()'>&times;</span>
  <div class='modal-content'>

    <div class='mySlides'>
      <div class='numbertext'>1 / 4</div>
      <img src='' style='width:100%'>
    </div>

    <div class='mySlides'>
      <div class='numbertext'>2 / 4</div>
      <img src='' style='width:100%'>
    </div>

    <div class='mySlides'>
      <div class='numbertext'>3 / 4</div>
      <img src='' style='width:100%'>
    </div>
    
    <div class='mySlides'>
      <div class='numbertext'>4 / 4</div>
      <img src='' style='width:100%'>
    </div>
    
    <a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
    <a class='next' onclick='plusSlides(1)'>&#10095;</a>

    <div class='caption-container'>
      <p id='caption'></p>
    </div>


    <div class='column'>
      <img class='demo cursor' src='' style='width:100%' onclick='currentSlide(1)' alt='Nature and sunrise'>
    </div>
    <div class='column'>
      <img class='demo cursor' src='' style='width:100%' onclick='currentSlide(2)' alt='Snow'>
    </div>
    <div class='column'>
      <img class='demo cursor' src='' style='width:100%' onclick='currentSlide(3)' alt='Mountains and fjords'>
    </div>
    <div class='column'>
      <img class='demo cursor' src='' style='width:100%' onclick='currentSlide(4)' alt='Northern Lights'>
    </div>
  </div>
</div>
<form>
<button class='button' type='submit' formaction='cart.html' ><span>Add to Cart </span></button></form><br>
<div class='footer'>
    <div id='name'></div><div class='addr'><i><span>Aranoz.     |     901-947 South Drive, Houston, TX 77057, USA    |    Telephone: +1 555 1234</span></i></div><div class='icon'><img src='facebook.png' width='100%' ></div><div class='icon'><img src='twitter.png' width='100%' ></div><div class='icon'><img src='instagram.png' width='100%' ></div><div class='icon'><img src='web.png' width='100%' ></div></div>
<script>
function openModal() {
  document.getElementById('myModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('myModal').style.display = 'none';
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName('mySlides');
  var dots = document.getElementsByClassName('demo');
  var captionText = document.getElementById('caption');
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(' active', '');
  }
  slides[slideIndex-1].style.display = 'block';
  dots[slideIndex-1].className += ' active';
  captionText.innerHTML ='';
}
</script><script>
var barr = document.getElementsByClassName('column');
console.log(barr);
var imarr = document.getElementsByTagName('img');
var i=0;
setTimeout(showimg1,500);
function showimg1(){
for(i=0;i<barr.length;i++){
 barr[i].style.display = 'inline-block';
 }
 imarr[0].src = '".$imar[0]."';
 imarr[4].src = '".$imar[0]."';
 imarr[8].src = '".$imar[0]."';
 imarr[5].src = '".$imar[1]."';
 imarr[9].src = '".$imar[1]."';
 imarr[6].src = '".$imar[2]."';
 imarr[10].src = '".$imar[2]."';
 imarr[7].src = '".$imar[3]."';
 imarr[11].src = '".$imar[3]."';
 setTimeout(showimg2,500);
}


function showimg4()
{
  imarr[3].src = '".$imar[3]."';
}
function showimg3()
{
  imarr[2].src = '".$imar[2]."';
  setTimeout(showimg4,500);
  
}
function showimg2(){
imarr[1].src = '".$imar[1]."';
setTimeout(showimg3,500);
}

</script>
    
</body>
</html>

";
?>

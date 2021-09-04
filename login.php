<?php
$link = mysqli_connect("localhost", "root", "","tec");
if (isset($_POST['name']) and isset($_POST['password'])){
//3.1.1 Assigning posted values to variables.
$username = $_POST['name'];
$password = $_POST['password'];
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM users WHERE username='$username' and pwd='$password'";
 
$result = mysqli_query($link, $query) or die(mysqli_error($link));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
if ($count == 1){
setcookie('username', $username, time() + (86400 * 30), "/");
echo "
<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<style>
#snackbar {
    visibility: hidden;
    min-width: 250px;
    margin-left: -125px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 10%;
    font-size: 28px;
}

#snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
}

.loader {
  border: 16px solid whitesmoke;
  border-radius: 50%;
  border-top: 16px solid darkred;
  width: 120px;
  height: 120px;
  margin-left:48%;
  margin-top:15%;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>
</head>
<body onload='myFunction()'>
<div class='loader' style='z-index:3;position:absolute;'></div>
<img src='bg.jpg'  width='100%' style='z-index: 0;position:relative;margin:0;opacity:0.5'>

<div id='snackbar'><i>Logging in as ".$username."...</i></div>
<script>
function myFunction() {
    var x = document.getElementById('snackbar');
    x.className = 'show';
    setTimeout(function(){ x.className = x.className.replace('show', '');window.location.assign(\"index.html\"); }, 3000);
}
</script>
</body>
</html>
";

}else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
$fmsg = "Invalid Login Credentials.";
echo "<script>alert('Invalid Login Details');window.location.assign(\"login.html\")</script>";
// echo "<script>alert(".$fmsg.");window.location.assign(\"index.php\")</script>";
}
}
//3.1.4 if the user is logged in Greets the user with message
/*
if (isset($_COOKIE['username'])){

}
*/
?>
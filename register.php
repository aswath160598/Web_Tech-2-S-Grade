<?php
session_start();
$link = mysqli_connect("localhost", "root", "","tec");
// Check connection
extract($_POST);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT * FROM users WHERE username='$uname'";
$result = mysqli_query($link, $sql);
if(mysqli_num_rows($result) > 0){
    echo "Account already exists,please try logging in with different credentials";
}
else{
if($pwd != $pwdr){
    echo "Password Mismatch! re-enter the password";
}
else{
$sql = "INSERT INTO users (username,phone,address,email,pwd) VALUES ('$uname','$phone','$addr','$email','$pwd')";
mysqli_query($link, $sql);
// echo "<script>alert("Registered Successfully!!");</script>";
echo "<script>setTimeout(function(){window.location.assign(\"login.html\"); }, 1000);}</script>";
}
}
mysqli_close($link);
?>
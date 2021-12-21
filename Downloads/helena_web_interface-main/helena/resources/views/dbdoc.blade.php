<?php 
    $a=$_GET['adress'];
    $c=$_GET['city'];
    $p=$_GET['phone'];
    $s=$_GET['servizi'];
    $host = "127.0.0.1";
    $username = "root";
    $db = "helena";
    $con = mysqli_connect($host, $username) ;
    mysqli_select_db($con, $db);
    $cfdoc = Auth::user()->cf;
    $sql = "UPDATE `users` SET city='$c',adress='$a',phonenum='$p' WHERE cf='$cfdoc'";
    if(mysqli_query($con,$sql)){
    } else {    
    }
    $con = mysqli_connect($host, $username) ;
    mysqli_select_db($con, $db);
    $cfdoc = Auth::user()->cf;
    if($s !=" "){
        $sql = "SELECT * FROM `servizio`WHERE cf='$cfdoc'";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) == 1){
            while ($row = mysqli_fetch_array($result)) {
                $sql = "UPDATE `servizio` SET servizio='$s' WHERE cf='$cfdoc'";
                if(mysqli_query($con,$sql)){
                } else {}
            }
        } else {
            $sql = "INSERT INTO `servizio`(`cf`, `servizio`) VALUES ('$cfdoc','$s')";
            if(mysqli_query($con,$sql)){
            } else {}
        }
    }
    return redirect()->to("userinfo")->send();
?>
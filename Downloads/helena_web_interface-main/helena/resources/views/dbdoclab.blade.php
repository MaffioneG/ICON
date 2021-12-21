<?php 
    $n=$_GET['name'];
    $p=$_GET['phone'];
    $g=$_GET['day'];
    $oap=$_GET['apertura'];
    $och=$_GET['chiusura'];
    $id=$_GET['id'];
    $albo = Auth::user()->albo;
    $host = "127.0.0.1";
    $username = "root";
    $db = "helena";
    $con = mysqli_connect($host, $username) ;
    mysqli_select_db($con, $db);
    $sql = "UPDATE `dottori` SET telefono='$p',giorno='$g', nome= '$n' WHERE codlab='$albo'";
    if(mysqli_query($con,$sql)){
    } else {}
    if(isset($oap) && isset($och) && $oap != null  && $och != null){
        $sql = "SELECT * FROM `dottori` WHERE codicelab ='$albo'";
        $result = mysqli_query($con,$sql);
        if( mysqli_num_rows($result) != 0){
            $sql = "UPDATE `dottori` SET apertura='$oap',chiusura='$och' WHERE codicelab='$albo'";
            if(mysqli_query($con,$sql)){} else {}
        } 
    } 
    return redirect()->to("userinfo")->send();
?>
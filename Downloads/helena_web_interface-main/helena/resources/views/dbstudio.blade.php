<?php
    $c=$_GET['city']; 
    $a=$_GET['adress']; 
    $p=$_GET['phone'];
    $oap=$_GET['apertura'];
    $och=$_GET['chiusura'];
    $cfdoc = Auth::user()->albo;
    $host = "127.0.0.1";
    $username = "root";
    $db = "helena";
    $con = mysqli_connect($host, $username) ;
    mysqli_select_db($con, $db);
    echo $p;
    $sql = "UPDATE `users` SET phonenum='$p', adress='$a', city='$c' WHERE albo='$cfdoc'";
    if(mysqli_query($con,$sql)){
    } else {    }
    if(isset($oap) && isset($och) && $oap != null  && $och != null){  
        $sql = "SELECT * FROM `orarilab` WHERE codicelab ='$cfdoc'";
        $result = mysqli_query($con,$sql);
        if( mysqli_num_rows($result) != 0){
            $sql = "UPDATE `orarilab` SET apertura='$oap',chiusura='$och' WHERE codicelab='$cfdoc'";
            if(mysqli_query($con,$sql)){} else {}
        } else {   
            $sql = "INSERT INTO `orarilab`(`codicelab`, `apertura`, `chiusura`) VALUES ('$cfdoc','$oap','$och')";
            if(mysqli_query($con,$sql)){} else {}
        }
    } else {}
    $sql = "SELECT * FROM `esami`";
    $result = mysqli_query($con,$sql);
     while ($row = mysqli_fetch_array($result)) {
        $cod = $row['cod'];
        if(isset($_GET[$cod])){
            //qui no
            $sql = "INSERT INTO `esamilab`(`codlab`, `codesame`) VALUES ('$cfdoc','$cod')";
            if(mysqli_query($con,$sql)){
            } else {}
        }
    }  
    return redirect()->to("userinfo")->send();
?>
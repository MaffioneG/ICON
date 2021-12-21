<?php
    $n = $_GET['name'];
    $d = $_GET['day'];  
    $p = $_GET['phone'];
    $ap = $_GET['apertura'];
    $ch = $_GET['chiusura'];
    $id = $_GET['id'];
    $albo = Auth::user()->albo;
    $host = "127.0.0.1";
    $username = "root";
    $db = "helena";
    $con = mysqli_connect($host, $username) ;
    mysqli_select_db($con, $db);
    $sql = "INSERT INTO `dottori`(`nome`, `giorno`, `telefono`, `apertura`, `chiusura`, `id`, `codlab`) 
        VALUES ('$n','$d','$p','$ap','$ch','$id','$albo')";
            if(mysqli_query($con,$sql)){
            } else {}
    return redirect()->to("userinfo")->send();
?>
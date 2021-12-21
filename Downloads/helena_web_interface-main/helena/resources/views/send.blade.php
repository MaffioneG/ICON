<div>
    <?php
    session_start();
    $ric = $_GET['ricetta'];
    $paz =$_GET['paziente'];
    $host = "127.0.0.1";
    $username = "root";
    $db = "helena";
    $con = mysqli_connect($host, $username) ;
    mysqli_select_db($con, $db);
    $media = 0;
    $tot = 0;
    if(isset($paz)){
        $sql = "SELECT * FROM `patients` WHERE cf='$paz'";
        $result = mysqli_query($con,$sql);
        while ($row = mysqli_fetch_array($result)) {
            $mailpaz = $row['email'];
            
        }
    }
    $ogg = "".'<h1> <center> Ricetta Medica </center> </h1>'."";
   if( mail($mailpaz, $ogg, '<h3> Gentile paziente le inoltro il pdf contente la sua ricetta media </h3>'))
    {
        echo "ok";
    } else {
        echo "no";
    }
    return redirect()->to("dashboard")->send();
    ?>
</div>
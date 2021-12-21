<html>
    <head>
        <style>
            .form-popup {
                display: none;
                position: fixed;
                bottom: 300px;
                right: 600px;
                background: white;
                border: 2px solid #f1f1f1;
                z-index: 20;
            }
            .container { width:300px; height: 50px; overflow: scroll;}
            .form-container .btn {
                background-color: #04AA6D;
                color: white;
                padding: 5px 0px;
                border: none;
                cursor: pointer;
                width: 100%;
                margin-bottom:10px;
                opacity: 0.8;
            }
            .form-container .cancel {
                background-color: red;
            }
        </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Custom fonts for this template-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    </head>
    <body>
        <div>
            <div class="row">   
                <div class="col-xl-12 col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-primary">Recap Attività:  </h4>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </a>                
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                        <br> 
                        <?php
                            $host="127.0.0.1";
                            $username="root";
                            $db="helena";
                            $tab="events";
                            $con = mysqli_connect($host, $username) ;
                            mysqli_select_db($con,$db);             
                            $id = Auth::user()->albo;
                            $dataoggi = date("Y/m/d");
                            $sql = "SELECT * FROM `events` WHERE  codice='$id' AND start='$dataoggi'";
                                $result=mysqli_query($con,$sql);
                                if( mysqli_num_rows($result) != 0){
                                    while ($row=mysqli_fetch_array($result)) {
                                            $title=$row['title'];
                                            $tipoesame=$row['tipoesame'];                        
                                            echo "<hr>";
                                            echo "<h6> <center> Appuntamento:",$title,"</center> </h6>";
                                            echo "<h6> <center> Tipo Appuntamento:",$tipoesame,"</center> </h6>";
                                            echo"<hr>";    
                                    }                                  
                                } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>

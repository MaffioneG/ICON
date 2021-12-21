<x-app-layout>
<x-slot name="header">
</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
<head>
    <style>
    /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 5px 4px;
            border: none;
            cursor: pointer;
            width: 30%;
            margin-bottom:10px;
            opacity: 0.8;  
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
    <div class="row">
        <div class="col-xl-12 col-lg-4">
            <div class="card shadow mb-0">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><h1>Studio Analisi: {{ Auth::user()->name }}</h1>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">        
        <div class="col-xl-12 col-md-6 mb-7">
            <div class="card border-primary shadow h-100 py-3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                <center> 
                                <form  action="{{ route('dbdoc') }}" method="GET"  class="form-container">
                                    <h4> <b>Indirizzo : </b></h4> 
                                    <input type = text placeholder="{{ Auth::user()->adress }}" value="{{ Auth::user()->adress }}" name="adress" >       
                                    <hr>
                                    <h4> <b> Città : </b></h4>
                                    <input type = text placeholder="{{ Auth::user()->city }}" value="{{ Auth::user()->city }}" name="city" >  
                                    <hr>
                                    <h4> <b> Numero Telefonico : </b></h4> 
                                    <input type = text placeholder="{{ Auth::user()->phonenum }}" value="{{ Auth::user()->phonenum }}"name="phone" >  
                                    <hr>
                                    <?php
                                        $host = "127.0.0.1";
                                        $username = "root";
                                        $db = "helena";
                                        $con = mysqli_connect($host, $username) ;
                                        mysqli_select_db($con, $db);
                                        $servizio = "Al momento non offri nessun Servizio...";
                                        $cfdoc = Auth::user()->cf;
                                        $sql = "SELECT * FROM `servizio` WHERE cf='$cfdoc'";
                                        $result = mysqli_query($con,$sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            $servizio = $row['servizio'];                
                                        }
                                    ?>
                                    <h4> <b> Servizi Offerti :</b></h4>  
                                    <textarea cols="100" rows="9" placeholder="Aggiungi i tuoi Servizi" value= "<?php echo $servizio;?>" name="servizi" required > </textarea>
                                    <br> <br>
                                    <button type="submit" class="btn">SALVA</button> </center>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</body>
</div>
</x-app-layout>

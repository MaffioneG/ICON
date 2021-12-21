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
    <?php
        session_start();    
    ?>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">                     
                                <h3>  Sintomi  </h3>
                            </div>
                            <?php 
                                $sintomo= " "; 
                                $host = "127.0.0.1";
                                $username = "root";
                                $db = "helena";
                                $con = mysqli_connect($host, $username) ;
                                mysqli_select_db($con, $db);
                                if(isset($_SESSION['cf'])){
                                    $cfpaz = $_SESSION['cf']; 
                                    $sql = "SELECT * FROM `salute` WHERE cf='$cfpaz'";
                                    $result = mysqli_query($con,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $sintomo = $row['descrizione'];    
                                    }
                                }
                            ?> 
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $sintomo; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <h3>Terapia
                                <button onclick="openForm()" style="float: right;" > <i class="fa fa-pencil"></i></button> </h3>                
                                <div  class="form-popup" id="modifica">
                                    <form  action="{{ route('dashboard') }}" method="GET"  class="form-container">
                                        <textarea cols="100" rows="9" placeholder="Modica la terapia" name="terapia" required> </textarea>
                                        <button type="submit" class="btn">Salva</button>
                                        <button type="button" class="btn cancel" onclick="closeForm()">Chiudi</button>
                                    </form>
                                </div>
                            </div>     
                            <?php
                            if(!isset($_GET['terapia'])){
                                $terapia=" ";
                                $host = "127.0.0.1";
                                $username = "root";
                                $db = "helena";
                                $con = mysqli_connect($host, $username) ;
                                mysqli_select_db($con, $db);
                                if(isset($_SESSION['cf'])){
                                    $cfpaz = $_SESSION['cf']; 
                                    $sql = "SELECT * FROM `salute` WHERE cf='$cfpaz'";
                                    $result = mysqli_query($con,$sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        $terapia = $row['terapia'];
                                   }
                                }
                                } else {
                                    $terapia=$_GET['terapia'];    
                                    $host = "127.0.0.1";
                                    $username = "root";
                                    $db = "helena";
                                    $con = mysqli_connect($host, $username) ;
                                    mysqli_select_db($con, $db);
                                    if(isset($_SESSION['cf'])){
                                        $cfpaz = $_SESSION['cf']; 
                                        $sql = "UPDATE `salute` SET `terapia`='$terapia' WHERE cf='$cfpaz'";
                                        if(mysqli_query($con,$sql)){}    
                                    }
                                }
                            ?>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $terapia;?></div>
                            </div>                
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    <h3>Percorso</h3>
                                    <?php
                                        $host = "127.0.0.1";
                                        $username = "root";
                                        $db = "helena";
                                        $con = mysqli_connect($host, $username) ;
                                        mysqli_select_db($con, $db);
                                        $media = 0;
                                        $tot = 0;
                                        if(isset($_SESSION['cf'])){
                                            $cfpaz = $_SESSION['cf']; 
                                            $sql = "SELECT * FROM `salute` WHERE cf='$cfpaz'";
                                            $result = mysqli_query($con,$sql);
                                            while ($row = mysqli_fetch_array($result)) {
                                                $sint[0] = $row['sintomo1'];
                                                $sint[1] = $row['sintomo2'];
                                                $sint[2] = $row['sintomo3'];
                                                for($i=0; $i<3; $i++) {
                                                    $sql = " SELECT * FROM `intsalute`WHERE cf='$cfpaz' AND sintomo='$sint[$i]'";
                                                    $result=mysqli_query($con,$sql);
                                                    if( mysqli_num_rows($result) != 0){
                                                        while ($row=mysqli_fetch_array($result)) {
                                                            $tot = $tot + $row['int_1'];
                                                            $tot = $tot + $row['int_2'];
                                                            $tot = $tot + $row['int_3'];
                                                            $tot = $tot + $row['int_4'];
                                                            $tot = $tot + $row['int_5'];
                                                            $tot = $tot + $row['int_6'];
                                                            $tot = $tot + $row['int_7'];
                                                            $media = $media + 1;     
                                                        }

                                                    }
        
                                                }  
                                            }    
                                        }
                                        if( $media != 0){
                                            $media = $tot/$media;    
                                        }
                                        $media = 100 - $media;     
                                    ?> 
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $media?>%</div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: <?php echo $media?>%" aria-valuenow="100" aria-valuemin="0"
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                         </div>
                    </div>
             </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <h3>Prenota Visita  </h3>
                                <form  action="{{ route('dashboard') }}" method="GET" >
                                    <div class="container">
                                        <input type="checkbox" id="visita1" name="visita1" value="esamisangue">
                                        <label for="visita1"> Esami del Sangue</label><br>
                                        <input type="checkbox" id="visita2" name="visita2" value="dentista">
                                        <label for="visita2"> Visita Odontoiatrica</label><br>
                                        <input type="checkbox" id="visita3" name="visita3" value="orotino">
                                        <label for="visita3"> Visita Otorino</label><br>
                                        <input type="checkbox" id="visita4" name="visita4" value="ginecologo">
                                        <label for="visita4"> Visita Ginecologica</label><br>
                                        <input type="checkbox" id="visita5" name="visita5" value="esamiurine">
                                        <label for="visita5"> Esami delle Urine</label><br>
                                        <input type="checkbox" id="visita6" name="visita6" value="neurologo">
                                        <label for="visita6"> Visita Neurologica</label><br>
                                        <input type="checkbox" id="visita7" name="visita7" value="cardiocolo">
                                        <label for="visita7"> Visita Cardiologica</label><br>
                                        <input type="checkbox" id="visita8" name="visita8" value="ortopedico">
                                        <label for="visita8"> Visita Ortopedica</label><br>
                                        <input type="checkbox" id="visita9" name="visita9" value="gastrenterolgo">
                                        <label for="visita9"> Visita Gastrologica</label><br>
                                        <input type="checkbox" id="visita10" name="visita10" value="pneumologo">
                                        <label for="visita10"> Visita Pneumologica</label><br>   
                                    </div>  
                                    <div>
                                        <button type="submit" class="btn">Salva</button>
                                </form>
                                <?php
                                    $esami="Esami Da svolgere: "; 
                                    $slvdb = 0;
                                    if(isset($_GET['visita1'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita1']." ";
                                    }
                                    if(isset($_GET['visita2'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita2']." ";
                                    }
                                    if(isset($_GET['visita3'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita3']." ";
                                    }
                                    if(isset($_GET['visita4'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita4']." ";
                                    }
                                    if(isset($_GET['visita5'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita5']." ";
                                    }
                                    if(isset($_GET['visita6'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita6']." ";
                                    }
                                    if(isset($_GET['visita7'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita7']." ";
                                    }
                                    if(isset($_GET['visita8'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita8']." ";
                                    }
                                    if(isset($_GET['visita9'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita9']." ";
                                    }
                                    if(isset($_GET['visita10'])){
                                        $slvdb = 1;
                                        $esami = $esami.$_GET['visita10']." ";
                                    }
                                    if($slvdb == 1) {
                                        $host = "127.0.0.1";
                                        $username = "root";
                                        $db = "helena";
                                        $con = mysqli_connect($host, $username) ;
                                        mysqli_select_db($con, $db);
                                        if(isset($_SESSION['cf'])){
                                            $cfpaz = $_SESSION['cf']; 
                                            $sql = "UPDATE `salute` SET `esami`='$esami' WHERE cf='$cfpaz'";
                                            if(mysqli_query($con,$sql)){}    
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                        </div>     
                    </div>               
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php	
        $tipo='no';
        $ricerca='no';
		if(!isset($_GET['select2'])){
            $_SESSION['select2']='Salute';			
        } else {
            $tipo=$_GET['select2'];
            $_SESSION['select2']=$tipo;
        }
        if(!isset($_GET['search'])){ }
        else {
            $ricerca=$_GET['search'];
            $_SESSION['search']=$ricerca;
        }
    ?>
    <div>
        <div class="row">   
            <div class="col-xl-9 col-lg-4">
                <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo  $_SESSION['select2'];?> </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </a>
                    <div >
                        <form  action="{{ route('dashboard') }}" method="GET">
						    <?php
                                echo" <select name=select2 onchange='this.form.submit()'>";
                                echo" <option value=''> Seleziona: </option>";
					  	        echo" <option value='Salute'> Salute </option>";
                                echo"<option value='Alimentazione'> Alimentazione</option>";
                                echo" <option value='Attività Fisica'> Attività Fisica</option>";
						        echo"</select>";
					        ?>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <?php 
                        if($_SESSION['select2'] == null || $_SESSION['select2'] == "Salute"){
                            echo "<div id='salute-container' style='height: 300px;'></div>";
                        }
                        if($_SESSION['select2'] == "Alimentazione"){
                            echo "<div id='cibo-container' style='height: 300px;'></div>";
                        }
                        if($_SESSION['select2'] == "Attività Fisica"){
                            echo "<div id='sport-container' style='height: 300px;'></div>";
                        }
                    ?>   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-20">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <form class="form-inline mr-auto w-100 navbar-search" action="{{ route('dashboard') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Ricerca paziente.."  name ="search" onchange="this.form.submit()">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </a>                
                </div>
            </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <?php         
                            $host="127.0.0.1";
                            $username="root";
                            $db="helena";
                            $tab="oggetti";
                            $con = mysqli_connect($host, $username) ;
                            mysqli_select_db($con,$db);             
                            $setting = 0;
                            if(isset($_SESSION['search'])){                  
                                $ricerca=$_SESSION['search'];
                                $cfdoc = Auth::user()->cf;
                                $sql = "SELECT * FROM `docpaz` WHERE  cfdoc='$cfdoc'";
                                $result=mysqli_query($con,$sql);
                                if( mysqli_num_rows($result) != 0){
                                    while ($row=mysqli_fetch_array($result)) {
                                        $cfdoc=$row['cfdoc'];
                                        $cfpaz=$row['cfpaz'];
                                        $sql = "SELECT * FROM `patients` WHERE  nome='$ricerca' AND cf='$cfpaz'";
                                        $result=mysqli_query($con,$sql);
                                        if( mysqli_num_rows($result) == 1){
                                            while ($row=mysqli_fetch_array($result)) {
                                                $nome=$row['nome'];
                                                $cognome=$row['surname'];
                                                $data=$row['borndate'];
                                                $cf=$row['cf'];
                                                $phone=$row['phonenum'];
                                                $citta=$row['city'];
                                                $ind=$row['adress'];                         
                                                $_SESSION['cf']=$cf;                     
                                                $setting = 1;
                                                echo "<h3> <center>",$nome," ",$cognome,"</center> </h3>";
                                                echo "<hr>";
                                                echo "<h6> <center> Codice Fiscale:",$cf,"</center> </h6>";
                                                echo "<h6> <center> Data di Nascita:",$data,"</center> </h6>";
                                                echo "<h6> <center> Numero Telefonico:",$phone,"</center> </h6>";
                                                echo "<h6> <center> Citta di Residenza:",$citta,"</center> </h6>";
                                                echo "<h6> <center> Indirizzo di Residenza:",$ind,"</center> </h6>";
                                                echo"<hr>";
                                                echo"<center> <button onclick='openForm1()'> Invia Ricetta <i class='fa fa-send'></i></button> </center>";                
                                                echo"<div  class='form-popup' id='ricetta'>";
                                                echo"<form  action='send' method='GET'  class='form-container' enctype='multipart/form-data'>";
                                                echo"<input type='hidden' id='paziente' name='paziente' value=",$cf,">";
                                                echo"<input type='file' id='ricetta' name='ricetta' required>";
                                                echo"<hr>";
                                                echo"<button type='submit' class='btn'>Invia</button>";
                                                echo"<button type='button' class='btn cancel' onclick='closeForm1()'>Chiudi</button>";
                                                echo" </form>";
                                                echo"</div>";
                                            }
                                        }
                                    }                                  
                                }
                                if($setting == 0){
                                    $_SESSION['cf']=0;
                                    echo "<h2> </h2>";
                                }
                            } else {} 
                        ?>                 
                    </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                            </span>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</body>
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    @push('js')
    <script>
      const chartSalute = new Chartisan({
        el: '#salute-container',
        url: "@chart('salute')",
        hooks: new ChartisanHooks()
        .legend({ bottom: 0 })
            .datasets(['line'])
      })
      ;

    </script>
    <script>
      const chartCibo = new Chartisan({
        el: '#cibo-container',
        url: "@chart('cibo')",
        hooks: new ChartisanHooks()
        .legend({ bottom: 0 })
            .datasets(['line'])
      })
      ;

    </script>  
    <script>
      const chartSport = new Chartisan({
        el: '#sport-container',
        url: "@chart('sport')",
        hooks: new ChartisanHooks()
        .legend({ bottom: 0 })
           
      })
      ;

    </script>
    @endpush
    <script>
        function openForm() {
            document.getElementById("modifica").style.display = "block";
        }

        function closeForm() {
            document.getElementById("modifica").style.display = "none";
        }   
    </script>   
    <script>
        function openForm1() {
            document.getElementById("ricetta").style.display = "block";
        }

        function closeForm1() {
            document.getElementById("ricetta").style.display = "none";
        }   
    </script> 
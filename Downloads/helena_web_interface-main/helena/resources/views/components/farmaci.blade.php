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
  <?php
    session_start();
    if(!isset($_GET['farmaco'])){ }
    else {
      $farmaco=$_GET['farmaco'];
      $_SESSION['farmaco']=$farmaco;
    }
  ?>
  <div class="row">
    <div class="col-xl-12 col-lg-4">
      <div class="card shadow mb-0">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">               
          <form class="form-inline mr-auto w-100 navbar-search" action="{{ route('ricerca') }}" method="GET">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small"  size="150" placeholder="Ricerca Farmaco.."  name ="farmaco" onchange="this.form.submit()">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
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
                <?php
                  $host="127.0.0.1";
                  $username="root";
                  $db="helena";         
                  $con = mysqli_connect($host, $username) ;
                  mysqli_select_db($con,$db);                               
                  if(isset($_SESSION['farmaco'])){
                    $farmaco=$_SESSION['farmaco'];
                    $sql = "SELECT * FROM `farmaci` WHERE  nome='$farmaco'";
                    $result=mysqli_query($con,$sql);
                    if( mysqli_num_rows($result) != 0){
                      while ($row=mysqli_fetch_array($result)) {
                        $nome=$row['nome'];
                        $cosasono=$row['cosasono'];
                        $scopo=$row['scopo'];
                        $listanomi=$row['listanomi'];
                        $tipologia=$row['tipologia'];
                        $tempoass=$row['tempoass'];
                        $effetticoll=$row['effetticoll'];
                        echo"<center> <h4> <b>Famiglia : </b></h4> <h5> $nome ";
                        echo "<hr>";
                        echo"<center> <h4> <b>Cosa Sono : </b></h4> <h5> $cosasono ";
                        echo "<hr>";
                        echo"<center> <h4> <b>A Cosa Servono : </b></h4> <h5> $scopo ";
                        echo "<hr>";
                        echo"<center> <h4> <b>Quali Sono : </b></h4> <h5> $listanomi ";
                        echo "<hr>";
                        echo"<center> <h4> <b>In Che Forma Sono : </b></h4> <h5> $tipologia ";
                        echo "<hr>";
                        echo"<center> <h4> <b>Tempo Di Assunzione : </b></h4> <h5> $tempoass ";
                        echo "<hr>";
                        echo"<center> <h4> <b>Effetti Collaterali    : </b></h4> <h5> $effetticoll ";
                        echo "</center>";
                      }
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
</body>
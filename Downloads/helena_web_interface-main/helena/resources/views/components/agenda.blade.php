<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    </head>
    <body>
        <?php
            session_start();
        ?>
        <div class="container">
        <br />
        <br />
        @if( Auth::user()->type  == 'A')
            <center>
            <form  action="{{ route('agenda') }}" method="GET">
		        <select name=select3   onchange='this.form.submit()'>
                    <option value='Vuoto' selected> Filtra Calendario: </option>
                    <option value='Vuoto'>Tutti Gli Appunamenti</option>
                    <?php
                        $host = "127.0.0.1";
                        $username = "root";
                        $db = "helena";
                        $con = mysqli_connect($host, $username) ;
                        mysqli_select_db($con, $db);
                        $cfdoc = Auth::user()->albo;
                        $sql = "SELECT * FROM `esamilab`, `esami` WHERE `esamilab`.`codesame`=`esami`.`cod` AND `esamilab`.`codlab`='$cfdoc'";
                        $result = mysqli_query($con,$sql);
                        if( mysqli_num_rows($result) != 0){
                            while ($row = mysqli_fetch_array($result)) {
                                $nome= $row['nome'];
                                $cod = $row['codesame'];  
                                echo"<option value='$cod'>$nome</option>";          
                            }
                        }
                    ?>
			    </select>
            </form>                         
            </center>
        @endif
        <?php
            if(!isset($_GET['select3'])){
                $_SESSION['select3']='Vuoto';			
            } else {
                $tipo=$_GET['select3'];
                $_SESSION['select3']=$tipo;
            }
        ?>
        <div id="tagPHP" style="display: none;">
            <?php
                $variabilePHP = $_SESSION['select3'];
                echo htmlspecialchars($variabilePHP); 
            ?>
        </div> 
        <br>
        <div id="calendar"></div>
            <br/>
        </div>
        <script>
            $(document).ready(function (codice) {
                var codice = '{{ Auth::user()->albo }}';
                var div = document.getElementById("tagPHP");
                var tipoesame = div.textContent;
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') 
                    },
                    data:{
                        codice: codice,
                        tipoesame : tipoesame,      
                    }
                });
                var calendar = $('#calendar').fullCalendar({
                editable:true,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay'
                },      
                events:'/full-calender',
                selectable:true,
                selectHelper: true,
                select:function(start, end, allDay, codice)
                {
                    var title = prompt('Event Title:');       
                    if(title)
                    {
                        var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                        var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
                        var codice = '{{ Auth::user()->albo }}';
                        var div = document.getElementById("tagPHP");
                        var tipoesame = div.textContent;
                        $.ajax({
                            url:"/full-calender/action",
                            type:"POST",
                            data:{
                            title: title,
                            start: start,
                            end: end,
                            codice: codice,
                            tipoesame : tipoesame,
                            type: 'add'
                            },
                            success:function(data)
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Created Successfully");
                            }
                        })
                    }
                },
                editable:true,
                eventResize: function(event, delta, codice)
                {
                    var codice = '{{ Auth::user()->albo }}';
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url:"/full-calender/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            codice: codice,
                            type: 'update'
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },
                eventDrop: function(event, delta, codice)
                {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    var codice = '{{ Auth::user()->albo }}';
                    $.ajax({
                        url:"/full-calender/action",
                        type:"POST",
                        data:{
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            codice: codice,
                            type: 'update'
                        },
                        success:function(response)
                        {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },
                eventClick:function(event)
                {
                    var title = prompt('Motivo Eliminazione:');
                    if(confirm("Are you sure you want to remove it?"))
                    {
                        var id = event.id;
                        var codice = '{{ Auth::user()->albo }}';
                        $.ajax({
                            url:"/full-calender/action",
                            type:"POST",
                            data:{
                                id:id,
                                codice:codice,
                                type:"delete"
                            },
                            success:function(response)
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Deleted Successfully");
                            }
                        })
                    }
                }
                });
            });
        </script>
    </body>
</html>
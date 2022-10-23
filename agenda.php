<?php
session_start();
require 'config/connection.php';
require 'includes/auth_validate.php';
$privilege_admin = $_SESSION['privilege'];
if($privilege_admin !='RECEPCIONISTA'){
    header("location:error-403");
}
$db_consulting="SELECT*FROM doctor";
$result = mysqli_query($conn, $db_consulting);
$db_consulting_2="SELECT*FROM specialty";
$result_2 = mysqli_query($conn, $db_consulting_2);
$db_consulting_3="SELECT*FROM patient ORDER BY name_patient ASC";
$result_3 = mysqli_query($conn, $db_consulting_3);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL DE RECEPCIONISTA</title>
    <link rel="shortcut icon" href="assets/img/ico.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.min.js"></script>
    <script src="assets/js/es.js"></script>
    <link rel="stylesheet" href="assets/css/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-clockpicker.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap-clockpicker.css">
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400&display=swap');
    </style>
    <style>
        .fc th{
            padding: 10px 0px;
            vertical-align: middle;
            background: #F2F2F2;
        }
        .modal-lg {
             max-width: 35% !important;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <a class="logo" href="panel_reception"><img class="site-logo" src="assets/img/logo.png" alt=""></a>
        <nav class="menuhorizontal">
            <a href="logout.php"><i class="fa-solid fa-person-walking-arrow-right"></i> Cerrar Sesión</a> <!--este apartado esta para cerrar la sesion de la cuenta ingresada -->
        </nav>
    </div>
    <div class="all-1">
        <div class="menu">
            <nav class="menuvertical-1">
                <a href="panel_reception"><i class="fa-solid fa-house-medical"></i> Inicio</a> 
                <a href="agenda"><i class="fa-solid fa-calendar-days"></i> Agenda</a>
                <a href="register_patient"><i class="fa-solid fa-person-half-dress"></i> Registrar Paciente</a>
                <a href="patient"><i class="fa-solid fa-person-half-dress"></i> Paciente</a>
                <a href="about.php"><i class="fa-solid fa-circle-question"></i> Ayuda</a>
                <!--este apartado esta para abrir el menu de ayuda -->
            </nav>
        </div>
        <div class="form-8">
            <div class="form-7">
                <fieldset class="form-6">
                    <div class="col-12">
                        <div id="CalendarioWeb">
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $('#CalendarioWeb').fullCalendar({
                                header:{
                                    left:'today,prev,next',
                                    center:'title',
                                    right:'month,basicWeek,basicDay,agendaWeek,agendaDay'
                                },
                                dayClick:function(date,jsEvent,view){
                                    $('#btnAgregar').prop("disabled",false);
                                    $('#btnModificar').prop("disabled",true);
                                    $('#btnEliminar').prop("disabled",true);
                                    limpiarFormulario();
                                    $('#txtFecha').val(date.format());
                                    $("#ModalEventos").modal();
                                },
                                events:'eventos.php',

                                eventClick:function(calEvent,jsEvent,view){
                                    $('#btnAgregar').prop("disabled",true);
                                    $('#btnModificar').prop("disabled",false);
                                    $('#btnEliminar').prop("disabled",false);
                                    $('#tituloEvento').html(calEvent.title);
                                    $('#id_patient').val(calEvent.id_patient);
                                    $('#txtCompanion').val(calEvent.companion);
                                    $('#txtID').val(calEvent.id);
                                    $('#txtTitulo').val(calEvent.title);
                                    $('#txtColor').val(calEvent.color);
                                    FechaHora= calEvent.start._i.split(" ");
                                    $('#txtFecha').val(FechaHora[0]);   
                                    $('#id_doctor').val(calEvent.id_doctor);
                                    $('#id_specialty').val(calEvent.id_specialty);
                                    $("#ModalEventos").modal();
                                },
                                editable:true,
                                eventDrop:function(calEvent){
                                    $('#txtID').val(calEvent.id);
                                    $('#txtTitulo').val(calEvent.title);
                                    $('#txtColor').val(calEvent.color);
                                    $('#txtCompanion').val(calEvent.companion);
                                    var fechaHora=calEvent.start.format().split("T");
                                    $('#txtFecha').val(fechaHora[0]);
                                    $('#txtHora').val(fechaHora[1]);
                                    RecolectarDatosGUI();
                                    EnviarInformacion('modificar',NuevoEvento,true);
                                }
                            });
                        });
                    </script>
                    <!-- Modal -->
                    <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="tituloEvento"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="txtID" name="txtID">
                                <input type="hidden" id="txtFecha" name="txtFecha" />
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label for="doctor">Paciente:</label>
                                        </br>
                                        <select class="form-control" style="text-transform:uppercase;" id="id_patient">Paciente
                                        <?php
                                        while ($row = mysqli_fetch_array($result_3)){
                                            $id_patient = $row['id_patient'];
                                            $name_patient = $row['name_patient'];
                                            $surname_patient = $row['surname_patient'];
                                        ?>
                                            <option value="<?php echo $id_patient; ?>"><?php echo("$name_patient $surname_patient"); ?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label> </label>
                                        <div class="input-group">
                                            <a href="register_patient" class="myButton_patient"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Hora del evento:</label>
                                        <div class="input-group clockpicker" data-autoclose="true">
                                            <input type="text" id="txtHora" value="10:30" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Acompañante:</label>
                                    <textarea id="txtCompanion" rows="2" class="form-control" style="resize: none;"></textarea>
                                </div>
                                <div>
                                    <label for="doctor">Doctor</label>
                                    </br>
                                    <select class="form-control" style="text-transform:uppercase;" id="id_doctor">Doctor
                                    <?php
                                    while ($row = mysqli_fetch_array($result)){
                                        $id_doctor = $row['id_doctor'];
                                        $name_doctor = $row['name_doctor'];
                                        $surname_doctor = $row['surname_doctor'];
                                    ?>
                                        <option value="<?php echo $id_doctor; ?>"><?php echo("$name_doctor $surname_doctor"); ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div>
                                    <label for="specialty">ESPECIALIDAD</label>
                                    </br>
                                    <select class="form-control" id="id_specialty">ESPECIALIDAD
                                    <?php
                                    while ($row = mysqli_fetch_array($result_2)){
                                        $id_specialty = $row['id_specialty'];
                                        $title = $row['title'];
                                    ?>
                                        <option value="<?php echo $id_specialty; ?>"><?php echo $title; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Color:</label>
                                    <input type="color" value="#ff0000" id="txtColor" class="form-control" style="height: 36px;">
                                </div>        
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btnAgregar" class="btn btn-success" >Agregar</button>
                                <button type="button" id="btnModificar" class="btn btn-success" >Modificar</button>
                                <button type="button" id="btnEliminar" class="btn btn-danger" >Borrar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <script>
                        var NuevoEvento;

                        $('#btnAgregar').click(function(){
                            RecolectarDatosGUI();
                            EnviarInformacion('agregar',NuevoEvento);
                        });

                        $('#btnEliminar').click(function(){
                            RecolectarDatosGUI();
                            EnviarInformacion('eliminar',NuevoEvento);
                        });

                        $('#btnModificar').click(function(){
                            RecolectarDatosGUI();
                            EnviarInformacion('modificar',NuevoEvento);
                        });

                        function RecolectarDatosGUI(){
                            NuevoEvento= {
                                id:$('#txtID').val(),
                                id_patient:$('#id_patient').val(),
                                start:$('#txtFecha').val()+" "+$('#txtHora').val(),
                                color:$('#txtColor').val(),
                                companion:$('#txtCompanion').val(),
                                textColor:"#FFFFFF",
                                end:$('#txtFecha').val()+" "+$('#txtHora').val(),
                                id_doctor:$('#id_doctor').val(),
                                id_specialty:$('#id_specialty').val(),
                            };
                        }
                        function EnviarInformacion(accion,objEvento,modal){
                            $.ajax({
                                type:'POST',
                                url:'eventos.php?accion='+accion,
                                data:objEvento,
                                success:function(msg){
                                    if(msg){
                                        $('#CalendarioWeb').fullCalendar('refetchEvents');
                                        if(!modal){
                                            $("#ModalEventos").modal('toggle');
                                        }
                                    }
                                },
                                error:function(){
                                    alert("Hay un error ..");
                                }
                            });
                        }
                        $('.clockpicker').clockpicker();
                        function limpiarFormulario(){
                            $('#txtID').val('');
                            $('#txtTitulo').val('');
                            $('#txtColor').val('');
                            $('#txtCompanion').val('');
                        }
                    </script>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>
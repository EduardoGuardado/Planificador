<div class="row">
    <?php foreach($profesor as $p){?>
    <div class="col">
        <h4>ID:         <?php echo $p->idUsuario;?></h4>
        <h4>Nombre:     <?php echo $p->nombre;?></h4>
        <h4>Apellido:   <?php echo $p->apellido;?></h4>
        <h4>Rol:        <?php echo $p->rol;?></h4>
    </div>
    <?php }?>
</div>

<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
?>

<div class="row" style="padding-top: 2em;">
<?php if ($Nrol == $director) {?>
    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Profesores</h5>
                <p class="card-text">Lista de profesores registrados en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores " data-toggle="tooltip" data-placement="top" title="Ver profesores">
                    <i class="material-icons">person</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Materias</h5>
                <p class="card-text">Lista de materias registradas en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMaterias " data-toggle="tooltip" data-placement="top" title="Ver profesores">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Grados</h5>
                <p class="card-text">Lista de grados académicos registrados en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerGrados " data-toggle="tooltip" data-placement="top" title="Ver profesores">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>

<?php }else if($Nrol == $profesor){?>
    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Planificaciones</h5>
                <p class="card-text">Mis planificaciones realizadas.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisPlanificaciones/<?php echo $p->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Ver mis planificaciones">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Asignaciones</h5>
                <p class="card-text">Mis asignaciones.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisAsignaciones/<?php echo $p->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Ver mis planificaciones">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Calendario</h5>
                <p class="card-text">Mi calendario de planificaciones.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisCalendario " data-toggle="tooltip" data-placement="top" title="Ver mis planificaciones">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>
<?php }?>
</div>
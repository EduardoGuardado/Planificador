<?php foreach($profesor as $p){ ?>
    <?php $p->idUsuario; ?>
<?php } ?>

<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
?>

<div class="row" style="padding-top: 2em;">
<?php if ($Nrol == $director) {?>
    <div class="col">
        <div class="card tarjeta-profesor">
            <div class="card-body">
                <h5 class="card-title h3">Profesores</h5>
                <br>
                <p class="card-text">Lista de profesores registrados en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores " data-toggle="tooltip" data-placement="top" title="Ver profesores">
                    <i class="material-icons">person</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card tarjeta-materias">
            <div class="card-body">
                <h5 class="card-title h3">Materias</h5>
                <br>
                <p class="card-text">Lista de materias registradas en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMaterias " data-toggle="tooltip" data-placement="top" title="Ver Materias">
                    <i class="material-icons">book</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card tarjeta-grados">
            <div class="card-body">
                <h5 class="card-title h3">Grados</h5>
                <br>
                <p class="card-text">Lista de grados académicos registrados en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerGrados" data-toggle="tooltip" data-placement="top" title="Ver Grados">
                    <i class="material-icons">sort</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card tarjeta-materianivel">
            <div class="card-body">
                <h5 class="card-title h3">Asignaciones de Materias</h5>
                <br>
                <p class="card-text">Lista de grados académicos que tienen una materia asignada.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMateriasNivel " data-toggle="tooltip" data-placement="top" title="Ver Materias por Grado">
                    <i class="material-icons">checklist</i>
                </a>
            </div>
        </div>
    </div>

<?php }else if($Nrol == $profesor){?>
    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Planificaciones</h5>
                <br>
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
                <br>
                <p class="card-text">Mis asignaciones.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMisAsignaciones/<?php echo $p->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Ver mis asignaciones">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Calendario</h5>
                <br>
                <p class="card-text">Mi calendario de planificaciones.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PerfilesControlador/VerMiCalendario/<?php echo $p->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Ver mi calendario">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>
<?php }?>
</div>
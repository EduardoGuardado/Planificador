<div class="row">
    <?php foreach($profesor as $p){?>
    <div class="col">
        <h4>Nombre:     <?php echo $p->nombre;?></h4>
        <h4>Apellido:   <?php echo $p->apellido;?></h4>
        <h4>Rol:        <?php echo $p->rol;?></h4>
    </div>
    <?php }?>
</div>

<div class="row" style="padding-top: 2em;">
<?php if ($rol == "Director") {?>
    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Profesores</h5>
                <p class="card-text">Lista de profesores registrados en el sistema.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url().'index.php/PerfilesControlador/VerProfesores'; ?>" data-toggle="tooltip" data-placement="top" title="Ver profesores">
                    <i class="material-icons">person</i>
                </a>
            </div>
        </div>
    </div>
<?php }else{?>
    <div class="col">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Planificaciones</h5>
                <p class="card-text">Mis planificaciones realizadas.</p>
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url().'index.php/PerfilesControlador/VerMisPlanificaciones'; ?>" data-toggle="tooltip" data-placement="top" title="Ver mis planificaciones">
                    <i class="material-icons">list</i>
                </a>
            </div>
        </div>
    </div>
<?php }?>
</div>
<div class="row">
<?php foreach($ListaProfesores as $profesor){?>
    <?php if ($profesor->rol != $rol) {?>
        <div class="card" style="width: 23rem; margin: 5px;">
            <div class="card-body">
                <h5 class="card-title">Nombre: <?php echo $profesor->nombre." ".$profesor->apellido; ?></h5>
                <br>
                <div class="row">
                    <div class="col">
                        <h6 class="card-subtitle mb-2 text-muted">Correo: </h6>
                    </div>
                    <div class="col">
                        <p class="card-text"><?php echo $profesor->correo; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6 class="card-subtitle mb-2 text-muted">Telefono: </h6>
                    </div>
                    <div class="col">
                        <p class="card-text"><?php echo $profesor->telefono; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h6 class="card-subtitle mb-2 text-muted">Rol: </h6>
                    </div>
                    <div class="col">
                        <p class="card-text"><?php echo $profesor->rol; ?></p>
                    </div>
                </div>
                <div >
                    <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $profesor->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Planificaciones">
                        <i class="material-icons">list</i>
                    </a>
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/ProfesoresControlador/Editar/<?php echo $profesor->idUsuario; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $profesor->idUsuario;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </div>
            </div>
        </div>
    <?php }?>
<?php }?>
</div>
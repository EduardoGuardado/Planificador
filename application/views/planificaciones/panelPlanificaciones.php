<div class="row">
<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);

    $mensaje = "<div class='col'><div class='alert alert-dark text-center' role='alert'><p class='display-4'>No hay elementos para mostrar</p></div></div>";
?>
<?php foreach($ListaPlanificaciones as $planificacion){?>
    <div class="card" style="width: 23rem; margin: 5px;">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Materia Asignada: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $planificacion->materia;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Grado Asignado: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $planificacion->nivel."°";?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Nivel Educativo: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php $planificacion->tipo; if($planificacion->tipo == "B"){echo " Básica";}else if($planificacion->tipo == "M"){ echo " Bachillerato";} ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Sección: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $planificacion->seccion;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Año: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $planificacion->anio;?></p>
                </div>
            </div>
            <div >
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PlanificacionesControlador/VerDetalles/<?php echo $planificacion->idPlanificacion;?>/<?php echo $planificacion->idAsignacion;?>/<?php echo $planificacion->anio;?>/<?php echo $planificacion->materia;?>" data-toggle="tooltip" data-placement="top" title="Detalles de la planificación">
                    <i class="material-icons">list</i>
                </a>
                <?php if ($Nrol == $director) {?>
                    <div></div>
                <?php }else if($Nrol == $profesor){?>
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/PlanificacionesControlador/editar/<?php echo $planificacion->idPlanificacion;?>/<?php echo $planificacion->idAsignacion;?>/<?php echo $planificacion->anio;?>/<?php echo $idProfesor;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $planificacion->idPlanificacion;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                <?php }?>
            </div>
        </div>
    </div>
<?php }?>
<p><?php if($ListaPlanificaciones == null){echo $mensaje;}?></p>
</div>
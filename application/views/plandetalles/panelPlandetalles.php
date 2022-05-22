<div class="row">
<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
    
    $mensaje = "<div class='col'><div class='alert alert-dark text-center' role='alert'><p class='display-4'>No hay elementos para mostrar</p></div></div>";
    $realizado = "<div class='alert alert-success' role='alert' title='Realizada' style='padding: 5px; border-raius: 3px;'><i class='material-icons'>check</i></div>";
    $norealizado = "<div class='alert alert-danger' role='alert' title='Sin realizar' style='padding: 5px; border-raius: 3px;'><i class='material-icons'>error</i></div>";
?>
<?php foreach($ListaPlanDetalles as $plandetalle){?>
    <div class="card" style="width: 23rem; margin: 5px;">
        <div class="card-body">
            <h5 class="card-title">Contenido: </h5>
            
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Unidad <?php echo $plandetalle->unidad; ?>: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $plandetalle->nombreUnidad; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Tema: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $plandetalle->correlativo." ".$plandetalle->tema; ?></p>
                </div>
            </div>

            <h5 class="card-title">Periodo de ejecución: </h5>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Desde: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $plandetalle->desde; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Hasta: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $plandetalle->hasta; ?></p>
                </div>
            </div>

            <h5 class="card-title">Fecha de ejecución: </h5>
            <div class="row">
                <div class="col">
                    <p class="card-text"><?php echo $plandetalle->ejecutado; ?></p>
                </div>
                <?php echo ($plandetalle->hecho == 1) ? $realizado : $norealizado;?>
            </div>

            <div >
                <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php echo $plandetalle->idPlanDetalle;?>" data-toggle="tooltip" data-placement="top" title="Recursos">
                    <i class="material-icons">folder</i>
                </a>
                <?php if ($Nrol == $director) {?>
                    <div></div>
                <?php }else if($Nrol == $profesor){?>
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/PlanDetallesControlador/Editar/<?php echo $plandetalle->idPlanDetalle;?>/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $materia;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $plandetalle->idPlanDetalle;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                <?php }?>
            </div>
        </div>
    </div>
<?php }?>
<p><?php if($ListaPlanDetalles == null){echo $mensaje;}?></p>
</div>
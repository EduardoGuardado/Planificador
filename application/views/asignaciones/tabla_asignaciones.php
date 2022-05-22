<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);

    $mensaje = "<div class='col'><div class='alert alert-dark text-center' role='alert'><p class='display-4'>No hay elementos para mostrar</p></div></div>";
?>

<div class="row">
<?php foreach($ListaAsignaciones as $asignacion){?>
    <div class="card text-center" style="width: 23rem; margin: 5px; background-color: #F2F2F2">
        <div class="card-body">
            <h5>Materia: <?php echo $asignacion->nombre; ?></h5>
            <h5>Materia: <?php echo $asignacion->materia; ?></h5>
            <h5>Grado: <?php echo $asignacion->nivel."°"; ?></h5><br>
            
            <div class="text-left">
                <?php if ($Nrol == $director) {?>
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/AsignacionesControlador/editar/<?php echo $asignacion->idAsignacion;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $asignacion->idAsignacion;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                <?php }else if($Nrol == $profesor){?>
                    <div></div>
                <?php }?>
            </div>
        </div>
    </div>
<?php }?>
<p><?php if($ListaAsignaciones == null){echo $mensaje;}?></p>
</div>
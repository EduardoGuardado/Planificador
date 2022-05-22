<?php
    $mensaje = "<div class='col'><div class='alert alert-dark text-center' role='alert'><p class='display-4'>No hay elementos para mostrar</p></div></div>";
?>
<div class="row">
<?php foreach($ListaGrados as $grado){?>
    <div class="card" style="width: 23rem; margin: 5px;">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Grado: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $grado->nivel."°";?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Nivel educativo: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php $grado->tipo; if($grado->tipo == "B"){echo " Básica";}else if($grado->tipo == "M"){ echo " Bachillerato";} ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="card-subtitle mb-2 text-muted">Sección: </h6>
                </div>
                <div class="col">
                    <p class="card-text"><?php echo $grado->seccion;?></p>
                </div>
            </div>

            <div class="text-right">
                <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/GradosControlador/editar/<?php echo $grado->idGrado; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                    <i class="material-icons">edit</i>
                </a>
                <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $grado->idGrado;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                    <i class="material-icons">delete</i>
                </button>
            </div>
        </div>
    </div>
<?php }?>
<p><?php if($ListaGrados == null){echo $mensaje;}?></p>
</div>
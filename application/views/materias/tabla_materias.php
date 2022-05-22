<?php
    $mensaje = "<div class='col'><div class='alert alert-dark text-center' role='alert'><p class='display-4'>No hay elementos para mostrar</p></div></div>";
?>
<br>
<div class="row">
    <?php foreach($ListaMaterias as $materia){?>
        <div class="card" style="width: 20rem; margin: 5px;">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <h5 class="card-title"><?php echo $materia->materia; ?></h5>
                    </div>
                </div>

                <br>
                
                <div class="text-left">
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/MateriasControlador/editar/<?php echo $materia->idMateria; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $materia->idMateria;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </div>
            </div>
        </div>
<?php }?>
<p><?php if($ListaMaterias == null){echo $mensaje;}?></p>
</div>
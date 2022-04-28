<div class="row">
<?php foreach($ListaAsignaciones->result() as $asignacion){?>
    <div class="card text-center" style="width: 23rem; margin: 5px; background-color: #F2F2F2">
        <div class="card-body">
        <h5>Materia: <?php echo $asignacion->materia; ?></h5>
        <h5>Grado: <?php echo $asignacion->idGrado."°"; ?></h5><br>
        <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/MNDirControlador/editar/<?php echo $asignacion->idAsignacion;?>" data-toggle="tooltip" data-placement="top" title="Editar">
            <i class="material-icons">edit</i>
        </a>
        <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $asignacion->idAsignacion;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
            <i class="material-icons">delete</i>
        </button>
        </div>
    </div>
    <?php }?>
</div>
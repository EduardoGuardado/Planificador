<div class="row">
<?php foreach($ListaUnidades->result() as $unidades){?>
    <div class="card text-center" style="width: 23rem; margin: 5px; background-color: #F2F2F2">
        <div class="card-body">
        <h5>Unidad <?php echo $unidades->unidad; ?></h5>
        <h5><?php echo $unidades->nombreUnidad; ?></h5>
        <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/UnidadesControlador/editar/<?php echo $unidades->idDetalleUnidad;?>/<?php echo $idAsignacion; ?>" data-toggle="tool<<<tip" data-placement="top" title="Editar">
            <i class="material-icons">edit</i>
        </a>
        <button class="btn btn-danger btn-icon btn-sm" data-idasig="<?php echo $idAsignacion; ?>" data-eliminar="<?php echo $unidades->idDetalleUnidad;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
            <i class="material-icons">delete</i>
        </button>
        <a class="btn btn-info btn-icon btn-sm" href="<?php echo base_url()?>index.php/ContenidosControlador/index/<?php echo $unidades->idDetalleUnidad;?>" data-toggle="tooltip" data-placement="top" title="Contenidos">
        <i class="material-icons">list</i>
        </a>
        </div>
    </div>
    <?php }?>
</div>
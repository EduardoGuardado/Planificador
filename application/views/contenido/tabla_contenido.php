<div class="row">
<?php foreach($ListaContenido->result() as $contenido){?>
    <div class="card text-center" style="width: 23rem; margin: 5px; background-color: #F2F2F2">
        <div class="card-body">
        <h5 style="color: black;"><?php echo $contenido->correlativo; ?> <?php echo $contenido->tema; ?></h5>
        <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/ContenidosControlador/editar/<?php echo $contenido->idContenido;?>/<?php echo $idUnidad; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
            <i class="material-icons">edit</i>
        </a>
        <button class="btn btn-danger btn-icon btn-sm" data-idUni="<?php echo $idUnidad; ?>" data-eliminar="<?php echo $contenido->idContenido;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
            <i class="material-icons">delete</i>
        </button>
        </div>
    </div>
    <?php }?>
</div>

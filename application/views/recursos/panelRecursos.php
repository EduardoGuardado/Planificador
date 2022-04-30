<div class="row">
<?php foreach($ListaRecursos->result() as $recurso){?>
    <div class="card" style="width: 23rem; margin: 5px;">
        <div class="card-body">
            <h5 class="card-title">Tipo de recurso:</h5>
            <div class="row">
                <div class="col">
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $recurso->tipo; ?></h6>
                </div>
            </div>
            <h5 class="card-title">Recurso:</h5>
            <div class="row">
                <div class="col">
                    <p class="card-text"><?php echo $recurso->recurso; ?></p>
                </div>
            </div>
            <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $recurso->idRecurso;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                <i class="material-icons">delete</i>
            </button>
        </div>
    </div>
<?php }?>
</div>
<div class="row">
<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);

    $mensaje = "<div class='col'><div class='alert alert-dark text-center' role='alert'><p class='display-4'>No hay elementos para mostrar</p></div></div>";

?>

<?php foreach($ListaRecursos->result() as $recurso){?>
    <?php 
        /* SABER SI ES URL */
        $url = "https://";
        $buscaUrl = strpos($recurso->recurso, $url);
        /* SABER SI ES ARCHIVO */
        $archivo = "uploads/";
        $buscaArchivo = strpos($recurso->recurso, $archivo);

        /* OBTENER SOLO EL NOMBRE DEL ARCHIVO */
        $nombreArchivo = substr($recurso->recurso,8);

        /* OBTENER LA EXTENSIÓN */
        $tipo = "pdf";
        $extension = strpos($recurso->recurso, $tipo);
    ?>
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
                    <p class="card-text">
                        <?php if($buscaUrl !== FALSE){ ?>
                        <a class="stretched-link text-primary" href="<?php echo $recurso->recurso; ?>"><?php echo $recurso->recurso; ?></a>
                        <?php }else if($buscaArchivo !== FALSE) { ?>
                            <!-- ACCEDER AL RECURSO -->
                            <!-- Si es pdf mostrar esto -->
                            <?php if($extension !== FALSE){ ?>
                                <a class="btn btn-dark" href="<?php echo base_url()?><?php echo $recurso->recurso; ?>"><?php echo $nombreArchivo;?></a>
                            <?php }else{ ?>
                                <a class="btn btn-success" href="<?php echo base_url()?>index.php/RecursosControlador/Descargar/<?php echo $nombreArchivo; ?>/<?php echo $recurso->recurso; ?>"><i class="material-icons">download</i><?php echo $nombreArchivo; ?></a>
                            <?php }?>
                        <?php } ?>
                    </p>
                </div>
            </div>
            <?php if ($Nrol == $director) {?>
                <div></div>
            <?php }else if($Nrol == $profesor){?>
                <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $recurso->idRecurso;?>" data-quitar="<?php echo $recurso->recurso; ?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                    <i class="material-icons">delete</i>
                </button>
            <?php }?>
        </div>
    </div>
<?php }?>
<p><?php if($ListaRecursos->result() == null){echo $mensaje;}?></p>
</div>
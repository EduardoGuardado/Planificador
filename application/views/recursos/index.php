<br>
<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
?>
<div class="row">
    <div class="col-sm-12">
        <h3>Lista de Recursos</h3>
    </div>
    <?php if ($Nrol == $director) {?>
        <div></div>
    <?php }else if($Nrol == $profesor){?>
        <div class="col-sm-12 col-md-4 text-left">
            <a href="<?php echo base_url()?>index.php/RecursosControlador/Insertar/<?php echo $idPlanDetalle;?>" class="btn btn-primary">Agregar</a>
        </div>
    <?php }?>
</div>
<br>
<div class="row">
    <div class="container-fluid" id="divTabla">
        <?php $this->load->view('recursos/panelRecursos'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            var URl = $(this).data("quitar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el recurso?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id, URl: URl};
                    $.post('<?php echo base_url()?>index.php/RecursosControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PlanDetallesControlador/VerRecursos/<?php echo $idPlanDetalle;?>';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        $('#txt_busqueda').keyup(function(e){
            if(e.key == 'Enter'){
                buscar();
            }
        });

        function buscar(){
            var criterio = $('#txt_busqueda').val() == "" ? 'all': $('#txt_busqueda').val();
            $.post('<?php echo base_url()?>index.php/PlanDetallesControlador/buscar',{criterio:criterio}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>
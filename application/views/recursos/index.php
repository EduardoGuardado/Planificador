<br>
<div class="row">
    <div class="col-sm-12">
        <h3>Lista de Recursos</h3>
    </div>
    <div class="col-xs-10 col-md-8">
        <div class="input-group">
            <input id="txt_busqueda" type="text" class="form-control" placeholder="Buscar">
            <span class="input-group-btn">
            <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                buscar
            </button>
            </span>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 text-right">
        <a href="<?php echo base_url()?>index.php/RecursosControlador/Insertar/<?php echo $idPlanDetalle;?>" class="btn btn-primary">Agregar</a>
    </div>
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
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el recurso?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
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
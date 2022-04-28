<br>
<div class="row">
    <!-- REEMPLAZAMOS LOS CARACTERES ESPECIALES QUE SE AGREGARON EN LA URl Y DE ESTA MANERA PASAR EL VAROL EXACTO-->
    <?php $Nmateria = preg_replace('/[0-9\@\.\;\" "\%]+/', ' ', $materia);?>
    <div class="col-sm-12">
        <h3>Contenidos de la Planificación de <?php echo $Nmateria;?></h3>
        <br>
    </div>
    <div class="col-xs-10 col-md-8">
        <div class="input-group">
        <input type="hidden" id="idPlanificacion" value="<?php echo $idPlanificacion;?>">
        <input type="hidden" id="idAsignacion" value="<?php echo $idAsignacion;?>">
        <input type="hidden" id="anio" value="<?php echo $anio;?>">
            <div class="form-group">
                <p class="h5">Filtrar por:</p>
            </div>
            <div class="form-group">
                <select id="tema" class="form-control">
                    <option value="">Tema...</option>
                    <?php foreach($ListaPlanDetalles as $plandetalle){?>
                        <option value="<?php echo $plandetalle->tema;?>"><?php echo $plandetalle->tema;?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                <p>Fecha de ejecución:</p>
            </div>
            <div class="form-group">
                <input type="date" class="form-control" name="fecha" id="fecha" step="1" min="2010-01-01" max="2030-12-31">
            </div>
            <span class="input-group-btn">
                <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                    Buscar
                </button>
            </span>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 text-right">
        <a href="<?php echo base_url()?>index.php/PlanDetallesControlador/Insertar/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $materia;?>" class="btn btn-primary">Agregar</a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('plandetalles/panelPlandetalles'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el registro de la planificación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/PlanDetallesControlador/Eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/PlanDetallesControlador/VerDetalles/<?php echo $idPlanificacion;?>/<?php echo $idAsignacion;?>/<?php echo $anio;?>/<?php echo $materia;?>';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        function buscar(){
            var idPlanificacion     = $('#idPlanificacion').val();
            var idAsignacion        = $('#idAsignacion').val();
            var anio                = $('#anio').val();
            var tema                = $('#tema').val();
            var fecha               = $('#fecha').val();
            
            $.post('<?php echo base_url()?>index.php/PlanDetallesControlador/Buscar',{idPlanificacion:idPlanificacion, idAsignacion:idAsignacion, anio:anio, tema:tema, fecha:fecha}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>
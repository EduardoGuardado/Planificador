<br>
<h3>Unidades de la materia: <?php foreach($materias->result() as $res){ ?>
                    <?php echo $res->nombre;
                    }?>
</h3><br>
<div class="row">
    <div class="col-12">
            <div class="input-group-btn">
            <a href="<?php echo base_url()?>index.php/MNControlador/index" class="btn btn-dark">Regresar</a>
            <a href="<?php echo base_url()?>index.php/UnidadesControlador/insertar/<?php echo $idAsignacion; ?>" class="btn btn-warning">Asignar Unidades</a>
             </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $data['idAsignacion'] = $idAsignacion; ?>
        <?php $this->load->view('unidades/tabla_unidades',$data); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            var idAsig = $(this).data("idasig");
                        
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar la unidad seleccionada?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/UnidadesControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/UnidadesControlador/index/'+idAsig;
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
            var nivel = $('#nivel').val();
            var materia = $('#materia').val();
            var unidad = $('#unidad').val();
            $.post('<?php echo base_url()?>index.php/UnidadesControlador/buscar',{nivel:nivel,materia:materia, unidad:unidad}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>
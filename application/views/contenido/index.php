<br>
<h3>Temas de: <?php foreach($materias->result() as $res){ ?>
                    <?php echo $res->nombre;
                    }?>
</h3><br>
<div class="row">
    <div class="col-12">
            <div class="input-group-btn">
            <a href="<?php echo base_url()?>index.php/UnidadesControlador/index/<?php foreach($materias->result() as $res){ 
                    echo $res->id;
                    }?>" class="btn btn-dark">Regresar</a>
            <a href="<?php echo base_url()?>index.php/ContenidosControlador/insertar/<?php echo $idUnidad; ?>" class="btn btn-warning">Asignar Temas</a>
            </div>
        </div>
    </div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('contenido/tabla_contenido'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            var idUni = $(this).data("idUni");

            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar el Profesor?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/ContenidosControlador/eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/ContenidosControlador/'+idUni;
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
            $.post('<?php echo base_url()?>index.php/ContenidosControlador/buscar',{nivel:nivel,materia:materia, unidad:unidad}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>
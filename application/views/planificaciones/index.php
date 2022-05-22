<br>
<?php
    $director = "director";
    $profesor = "profesor";
    // CONVERTIMOS LA CADENA DEL ROL EN MINÚSCULAS
    $Nrol = strtolower($rol);
?>
<div class="row">
    <div class="col-sm-12">
        <h3>Planificaciones del Profesor <?php echo $NombreProfesor[0]->nombre." ".$NombreProfesor[0]->apellido;?></h3>
    </div>
    <div class="col-xs-10 col-md-8">
        <div class="input-group">
            <p>Filtrar por: </p>
            <input type="hidden" id="profesor" value="<?php echo $idProfesor;?>">
            <select class="form-control" id="materia">
                <option value="0">Materia...</option>
                <?php foreach($Materias as $materias){?>
                    <option value="<?php echo $materias->idMateria;?>"><?php echo $materias->materia;?></option>
                <?php }?>
            </select>
            <select class="form-control" id="seccion">
                <option value="s">Sección...</option>
                <?php foreach($Secciones as $secciones){?>
                    <option value="<?php echo $secciones->seccion;?>"><?php echo $secciones->seccion;?></option>
                <?php }?>
            </select>
            <select class="form-control" id="anio">
                <option value="0">Año...</option>
                <?php $anio = 2012;?>
                <?php for($i = 0; $i <= 10; $i++){?>
                    <option value="<?php echo $anio;?>"><?php echo $anio;?></option>
                    <?php $anio++;?>
                <?php }?>
            </select>
            <span class="input-group-btn">
            <button id="btn_busqueda" class="btn btn-default btn-fill" type="button" >
                buscar
            </button>
            </span>
        </div>
    </div>
    <?php if ($Nrol == $director) {?>
        <a href="<?php echo base_url()?>index.php/PerfilesControlador/VerProfesores" class="btn btn-secondary">Volver</a>
        <div></div>
    <?php }else if($Nrol == $profesor){?>
        <div class="col-sm-12 col-md-4 text-right">
            <a href="<?php echo base_url()?>index.php/InicioControlador/PerfilUsuario" class="btn btn-secondary">Volver</a>
            <a href="<?php echo base_url()?>index.php/PlanificacionesControlador/Insertar/<?php echo $idProfesor;?>" class="btn btn-primary">Agregar</a>
        </div>
    <?php }?>
</div>
<br>
<div class="row">
    <div class="col-12" id="divTabla">
        <?php $this->load->view('planificaciones/panelPlanificaciones'); ?>
    </div>
</div>

<script>
    $(function(){
        $(document).on("click", "button[data-eliminar]", function (evt) {
            var id = $(this).data("eliminar");
            
            swal({
                title: "Eliminar",
                text: "¿Está seguro que desea eliminar la Planificación?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {                    
                    var data = {id: id};
                    $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/Eliminar',data,function(response){
                        if(response == 'ok'){
                            window.location = '<?php echo base_url()?>index.php/ProfesoresControlador/VerPlanificaciones/<?php echo $idProfesor;?>';
                        }
                    });
                }
            });
        });

        $('#btn_busqueda').click(function(){
            buscar();
        });

        function buscar(){
            var profesor = $('#profesor').val();
            var materia = $('#materia').val();
            var seccion = $('#seccion').val();
            var anio    = $('#anio').val();

            $.post('<?php echo base_url()?>index.php/PlanificacionesControlador/Buscar/<?php echo $idProfesor;?>',{profesor:profesor, materia:materia, seccion:seccion, anio:anio}, function(response){
                $('#divTabla').html(response);
            });
        }
    });
</script>
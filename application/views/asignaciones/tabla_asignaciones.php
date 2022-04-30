<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
			<th>Materia</th>
            <th>Grado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ListaAsignaciones->result() as $asignacion){?>
            <tr>
                <td><?php echo $asignacion->idAsignacion; ?></td>
                <td><?php echo $asignacion->nombre; ?></td>
				<td><?php echo $asignacion->materia; ?></td>
                <td><?php echo $asignacion->nivel."°"; ?></td>
                <td class="text-right">
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/AsignacionesControlador/editar/<?php echo $asignacion->idAsignacion;?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $asignacion->idAsignacion;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
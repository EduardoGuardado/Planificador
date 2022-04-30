<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nivel</th>
            <th>Tipo</th>
            <th>Sección</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ListaGrados as $grado){?>
            <tr>
                <td><?php echo $grado->idGrado; ?></td>
                <td><?php echo $grado->nivel; ?></td>
                <td><?php echo $grado->tipo; ?></td>
                <td><?php echo $grado->seccion; ?></td>
                <td class="text-right">
                    <a class="btn btn-success btn-icon btn-sm" href="<?php echo base_url()?>index.php/GradosControlador/VerMateriasAsignadas/<?php echo $grado->idGrado; ?>/<?php echo $grado->nivel; ?>" data-toggle="tooltip" data-placement="top" title="Ver materias asignadas">
                        <i class="material-icons">list</i>
                    </a>
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/GradosControlador/editar/<?php echo $grado->idGrado; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $grado->idGrado;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Materia</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($ListaMaterias as $materia){?>
            <tr>
                <td><?php echo $materia->idMateria; ?></td>
                <td><?php echo $materia->materia; ?></td>
                <td class="text-right">
                    <a class="btn btn-warning btn-icon btn-sm" href="<?php echo base_url()?>index.php/MateriasControlador/editar/<?php echo $materia->idMateria; ?>" data-toggle="tooltip" data-placement="top" title="Editar">
                        <i class="material-icons">edit</i>
                    </a>
                    <button class="btn btn-danger btn-icon btn-sm" data-eliminar="<?php echo $materia->idMateria;?>" data-toggle="tooltip" data-placement="top" title="Eliminar">
                        <i class="material-icons">delete</i>
                    </button>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>
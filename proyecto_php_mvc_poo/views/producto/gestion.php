<div id="destacados">
    <h1>Gestionar productos</h1>
</div>
<a class="button" href="<?= base_url ?>producto/crear" >Crear</a>

<?php if (isset($_SESSION['producto'])): ?>
    <?= $_SESSION['producto'] == 'completed' ? "<span class ='correcto'>Se ha completado satisfactoriamente</span>" : '' ?>
    <?= $_SESSION['producto'] == 'failed' ? "<span class ='incorrecto'>Ha habido un error inesperado</span>" : '' ?>
    <?php Utils::deleteSesion('producto') ?>
<?php endif; ?>

<table class="table table-hover table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Categoria</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Fecha</th>
            <th scope="col"></th>
            <th scope="col"></th>

        </tr>
    </thead>
    <tbody>
        <?php while ($pro = $productos->fetch_object()): ?>
            <tr>
                <th scope="row"><?= $pro->id ?></th>
                <td><?= $pro->nombre ?></td>
                <td><?= $pro->descripcion ?></td>
                <td><?= $pro->categoria_id ?></td>
                <td><?= $pro->precio ?> €</td>
                <td><?= $pro->stock ?></td>
                <td><?= $pro->fecha ?></td>
                <td><a id="editar" class="action edit" id="edit" href="edit&id=<?= $pro->id ?>">Editar</a>
                    <a id="eliminar" class="action delete" id="delete" href="delete&id=<?= $pro->id ?>">Eliminar</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

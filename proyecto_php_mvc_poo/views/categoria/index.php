<div id="destacados">
    <h1>Gestionar categorias</h1>
</div>
<a class="button" href="<?=base_url?>categoria/crear" >Crear</a>
<?php if (isset($_SESSION['error-cat'])): ?>
    <?= $_SESSION['error-cat'] == 'failed' ? "<span class ='incorrecto'>Esta categoria ya existe</span>" : '' ?>
    <?php Utils::deleteSesion('error-cat') ?>
<?php endif; ?>

<table class="table table-hover table-dark">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($cat = $categorias->fetch_object()): ?>
            <tr>
                <th scope="row"><?= $cat->id ?></th>
                <td><?= $cat->nombre ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table> 
* Las categorias no pueden ser eliminadas desde el gestor de categorias ya que pueden pertenecer a otros productos, antes de borrar-las asegurate de que no estén en otros productos
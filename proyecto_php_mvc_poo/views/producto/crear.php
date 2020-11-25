<div id="destacados">
    <?php if (isset($edit)): ?>
        <h1>Editar el producto: <?= $pro->nombre ?></h1> 
        <?php $url_use = base_url . "producto/save&id=" . $_GET['id'] ?>
    <?php else: ?>
        <h1>Añadir un nuevo producto</h1> 
        <?php $url_use = base_url . "producto/save" ?>
    <?php endif; ?>

</div>
<div class="block_aside">
    <form action="<?= $url_use ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">* Nombre (max 30 caracteres permitidos):</label>
        <input type="text" name="nombre" value="<?= isset($pro->nombre) && is_object($pro) ? $pro->nombre : '' ?>" />

        <label for="descripcion">* Descripción:</label>
        <textarea name="descripcion"><?= isset($pro->descripcion) && is_object($pro) ? $pro->descripcion : '' ?></textarea>

        <label for="precio">* Precio:</label>
        <input type="text" name="precio" value="<?= isset($pro->precio) && is_object($pro) ? $pro->precio : '' ?>" />

        <label for="stock">* Cantidad de stock:</label>
        <input type="number" name="stock" value="<?= isset($pro->stock) && is_object($pro) ? $pro->stock : '' ?>" />

        <label for="Categoria">* Categoria:</label>
        <?php $categoria = Utils::showCategories(); ?>
        <select name="categoria">
            <?php while ($cat = $categoria->fetch_object()): ?>
                <option value="<?= $cat->id ?>" <?= isset($pro->categoria_id) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : '' ?> ><?= $cat->nombre ?></option>
            <?php endwhile; ?>
        </select>

        <label for="imagen">* Imagen:</label>
        <?php if (isset($pro->imagen) && is_object($pro) && is_dir("uploads") && !empty($pro->imagen)): ?>
            <img style="width: 250px; height: 250px" src="<?= base_url . 'uploads/images/' . $pro->imagen ?>" /><br/>
        <?php endif; ?>
        <input type="file" name="imagen" />


        <input type="submit" value="Enviar" />
    </form>
</div>


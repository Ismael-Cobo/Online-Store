<?php if (isset($categoria)): ?>
    <?php if ($productos->num_rows == 0): ?>
        <div id="destacados">
            <h1>No hay productos para mostrar</h1>
        </div>
    <?php else: ?>
        <div id="destacados">
            <h1>Productos con la categoria <?= $categoria->nombre ?></h1>
        </div>
        <?php while ($producto = $productos->fetch_object()): ?>
            <div class="product">

                <a href="<?= base_url ?>producto/ver&id=<?=$producto->id?>">
                    <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" />
                    <h2><?= $producto->nombre ?></h2>
                </a>

                <p style="text-align: center"><?= $producto->precio ?>€</p>
                <a class="acomprar" href="<?= base_url ?>carrito/add&id=<?= $producto->id ?>">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

<?php else: ?>
    <div id="destacados">
        <?= header("Location: " . base_url) ?>
    </div>
<?php endif; ?>



</div>



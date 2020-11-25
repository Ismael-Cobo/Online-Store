<?php if (isset($pro)): ?>
    <div id="destacados">
        <h1><?= $pro->nombre ?></h1>    
    </div>
    <div class="info_pro" >
        <div id="image">
            <img class="photo" src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" />
        </div>
        <div id="data">
            <h2 class="description"><?= $pro->descripcion ?></h2>
            <p class="price"><?= $pro->precio ?> €</p>
            <a class="acomprar" href="<?= base_url ?>carrito/add&id=<?= $pro->id ?>">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <?php header("Location: " . base_url) ?>
<?php endif; ?>




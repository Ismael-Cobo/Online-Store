<?php if (isset($_SESSION['identity'])): ?>
    <div id="destacados">
        <h1>Hacer pedido</h1>        
    </div>
    <div class="block_aside">
        <a href="<?=base_url?>carrito/index">Ver los productos y el precio del pedido</a>

        <h3 style="margin-top: 10px">Dirección para el envio</h3>
        <form action="<?= base_url ?>pedidos/add" method="POST">
            <label for="provincia">Provincia: </label>
            <input type="text" name="provincia" />

            <label for="localidad">Localidad: </label>
            <input type="text" name="localidad" />

            <label for="direccion">Direccion: </label>
            <input type="text" name="direccion" />


            <input type="submit" value="Confirmar pedido" style="width: auto" />

        </form>
    <?php else: ?>
        <div id="destacados">
            <h1>Debes de iniciar sesión</h1>
        </div>
        <p>Debes de haber iniciado sesion para poder ver tus pedidos</p>
    <?php endif; ?>
</div>

<?= var_dump($_SESSION) ?>
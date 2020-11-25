<!-- Barra lateral -->
<?php $stats = Utils::statsCarrito(); ?>
<aside id="lateral">
    <div id="login" class="block_aside">
        
        <h2>Carrito</h2>
        <a href="<?= base_url ?>carrito/index">Carrito</a>
        
        <br/><br/>
    </div>
    <div id="login" class="block_aside">
        <?php if (!isset($_SESSION['identity'])): ?>
            <h2>Entrar a la web</h2>
            <?= isset($_SESSION['error-login']) ? $_SESSION['error-login'] : '' ?>
            <form action="<?= base_url . 'usuario/login' ?>" method="POST">
                <label for="email">Email: </label>
                <input type="email" name="email">
                <label for="password">Contraseña: </label>
                <input type="password" name="password"><br/>
                <input type="submit" value="enviar">
            </form>
            <a href="<?= base_url ?>usuario/register">Registrate aqui</a>

        <?php elseif (isset($_SESSION['identity'])): ?>
            <h2><?= $_SESSION['identity']->nombre . ' ' . $_SESSION['identity']->apellidos ?></h2>
            <a href="<?= base_url ?>pedidos/view">Mis pedidos</a>
            <?php if (isset($_SESSION['admin'])): ?>
                <a href="<?= base_url ?>categoria/index">Gestionar categorias</a>
                <a href="<?= base_url ?>producto/gestion">Gestionar productos</a>
                <a href="<?= base_url ?>pedidos/gestionar">Gestionar pedidos</a>
            <?php endif; ?>
            <a href="<?= base_url ?>/usuario/logout">Cerrar sesión</a>
        <?php endif; ?>

    </div>



    <?php Utils::deleteSesion('error-login'); ?>
</aside>
<!-- Fin de la Cabecera -->
<!-- Contenido central -->

<div id="central">
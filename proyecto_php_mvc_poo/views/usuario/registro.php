<div id="destacados">
    <h1>Registrarse</h1>
</div>
<div class="block_aside">
    <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'completed'): ?>
        <strong style="color:greenyellow;">Te has registrado correctamente</strong>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
        <strong style="color:red;">No te has podido registrar correctamente, introduce bien los datos</strong>
    <?php endif; ?>
    <form action="<?= base_url ?>Usuario/save" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre"  /><br/>
        <?= isset($_SESSION['errores_login']['name']) ? $_SESSION['errores_login']['name'] : ''; ?>
        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos"  /><br/>
        <?= isset($_SESSION['errores_login']['surname']) ? $_SESSION['errores_login']['surname'] : ''; ?>
        <label for="email">Email</label>
        <input type="email" name="email"  /><br/>
        <?= isset($_SESSION['errores_login']['email']) ? $_SESSION['errores_login']['email'] : ''; ?>
        <label for="password">Contraseña</label>
        <input type="password" name="password"  /><br/>
        <?= isset($_SESSION['errores_login']['password']) ? $_SESSION['errores_login']['password'] : ''; ?>
        <input type="submit" value="Registrarse" />

    </form>
    <?= Utils::deleteSesion('register'); ?>
    <?= Utils::deleteSesion('errores_login'); ?>
</div>
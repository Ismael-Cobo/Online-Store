<div id="destacados">
    <h1>Crear una nueva categoria</h1>   
</div>
<div class="block_aside">
    <form action="<?= base_url ?>categoria/save" method="POST">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" />
        <?= isset($_SESSION['error-cat']) ? $_SESSION['error-cat'] : ''; ?>

        <input type="submit" value="Enviar" />
    </form>
</div>
    <?php
        Utils::deleteSesion('error-cat');        
    ?>
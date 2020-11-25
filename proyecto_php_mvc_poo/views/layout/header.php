<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tienda de camisetas</title>
        <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
       <!-- Jquery -->
       <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Sweet alert plugin -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        
        <!-- Imagen zoom plugin -->
        <script src="<?= base_url ?>/js/js_image/dist/js/image-zoom.min.js"></script>
        <!-- JS -->
        <script src="<?= base_url ?>js/index.js"></script>
        
        
    </head>

    <body>
        <div id="container">
            <!-- Cabecera -->

            <header id="header">
                <div id="logo">
                    <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta Logo" />
                    <a href="<?= base_url ?>">
                        <h1>Tienda de camisetas</h1>
                    </a>
                </div>
            </header>

            <!-- Fin de la Cabecera -->

            <!-- Menu -->
            <?php $categorias = Utils::showCategories(); ?>
            <nav id="nav">
                <ul>
                    <li><a href="<?= base_url ?>">Inicio</a></li>
                    <?php while ($cat = $categorias->fetch_object()): ?>

                        <li><a href="<?= base_url ?>categoria/ver&id=<?= $cat->id ?>"><?= $cat->nombre ?></a></li>
                    <?php endwhile; ?>

                </ul>

            </nav>
            <!-- Fin del Menu -->

            <div id="content">
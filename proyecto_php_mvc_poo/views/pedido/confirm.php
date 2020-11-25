<?php if (isset($_SESSION['pedido']) && isset($_SESSION['pedido']['completed'])): ?>
    <div id="destacados">
        <h1>Tu pedido se ha confirmado</h1>    
    </div>
    <div style="display: block; ">
        <p>Tu pedido se procesará al efectuar el pago.</p><br/>
        <div style="margin-left: 10%">
            <h2>Datos del pedido:</h2><br/>
            Número del pedido: <?= $pedido->id ?><br/>
            Total a pagar: <?= $pedido->coste ?> €<br/>
            Productos:

        </div>
    </div>
    <table>
        <th>#</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Unidades</th>
        <?php while ($producto = $productos->fetch_object()): ?>
            <tr>
                <td><img class="imagen_table" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>"></td>
                <td><a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a></td>            
                <td><?= $producto->precio ?> €</td>
                <td><?= $producto->unidades ?></td>
            </tr>
        <?php endwhile; ?>
    </table>



<?php else: ?>
    <p>Tu pedido no se ha podido procesar con éxito, intente contactar con nosotros para más información.</p>

<?php endif; ?>


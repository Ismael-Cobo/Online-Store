<div id="destacados">
    <h1>Detalle del pedido</h1>
</div>

<div style="display: block; ">
    <p>Tu pedido se procesará al efectuar el pago.</p><br/>
    <div style="margin-left: 10%">
        <h2>Datos del pedido:</h2><br/>
        Número del pedido: <?= $pedidov2->id ?><br/>
        Total a pagar: <?= $pedidov2->coste ?> €<br/>
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
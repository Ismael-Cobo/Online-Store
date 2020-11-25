<div id="destacados"><h1>Carrito de la compra</h1></div>
<?php if (isset($_SESSION['carrito'])): ?>
    <div class="cart">
        <div class="table">
            <table >
                <th>#</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Precio Total</th>
                <th>Eliminar</th>
                <?php if (isset($carrito)): ?>
                    <?php foreach ($carrito as $key => $valor): ?>

                        <tr>
                            <?php $producto = $valor['producto']; ?>
                            <td style="width: 20%" ><img class="imagen_table" src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>"></td>
                            <td><a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a></td>            
                            <td><?= $producto->precio ?> €</td>
                            
                            <td>
                                <a class="alterar_unidades" href="<?= base_url ?>carrito/up&indice=<?=$key?>">+</a>
                                    <?= $valor['unidades'] ?>
                                <a class="alterar_unidades" href="<?= base_url ?>carrito/down&indice=<?=$key?>">-</a>
                            </td>
                            <td><?= $stats[$key]['preciototal'] ?> €</td>
                            <td><a id="eliminar" class="action delete" id="delete" href="<?= base_url ?>carrito/remove&indice=<?=$key?>">Quitar del carrito</a></td>
                        </tr>
                    <?php endforeach; ?>

                <?php endif; ?>
            </table>
        </div>
        <div id="carrito_total">
            <h1>Total: <?= $stats['total'] ?> €</h1>
            
        </div>
        <a class="boton" style="color: red" href="<?= base_url ?>carrito/delete">Eliminar carrito</a>
        <a class="boton" href="<?= base_url ?>pedidos/hacer">Finalizar compra</a>
    </div>

<?php else: ?>
    <p>El carrito está vacio, añade algun producto haciendo clic <a href="<?= base_url ?>">aqui</a>.</p>
<?php endif; ?>

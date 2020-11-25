<div id="destacados">
    <?php if (isset($gestion)): ?>
        <h1>Gestionar pedidos</h1>
    <?php else: ?>
        <h1>Mis pedidos</h1>
    <?php endif; ?>
</div>
<table id="mis_pedidos">
    <th>#</th>
    <th>Coste</th>
    <th>Fecha</th>
    <th>Estado</th>
    <?php while ($ped = $pedidos->fetch_object()): ?>
        <tr>
            <td><a href="<?= base_url ?>pedidos/details&id=<?= $ped->id ?>"><?= $ped->id ?></a></td>
            <td><?= $ped->coste ?> €</td>
            <td><?= $ped->fecha ?></td>
            <td><?= $ped->estado ?></td>
        </tr>
    <?php endwhile; ?>
</table>
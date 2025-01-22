<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Menus</title>
</head>
<body>
    <?php 
        if (session()->getFlashdata('success')) echo session()->getFlashdata('success');
    ?>

    <?php if (isset($validation)): ?>
        <div>
            <?= \Config\Services::validation()->listErrors(); ?>
        </div>
    <?php endif; ?>


    <h1>Formulario de Menus</h1>

    <form method="post" action="<?= base_url('menus/save') ?>">

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="price">Precio:</label>
        <input type="number" name="price" id="price" required><br>

        <label for="description">Descripcion:</label>
        <textarea name="description" id="description"></textarea><br>
        
        <button type="submit">Guardar</button>
    </form>

    <h2>Listado de Menus</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Descripcion</th>
        </tr>
        <?php foreach ($menus as $menu): ?>
            <tr>
                <td><?= $menu['id'] ?></td>
                <td><?= $menu['name'] ?></td>
                <td><?= $menu['description'] ?></td>
                <td><?= $menu['price'] ?></td>
                <td><a href='<?=base_url('menus/delete/') . $menu['id'] ?>'>Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

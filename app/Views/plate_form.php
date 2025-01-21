<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Plates</title>
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


    <h1>Formulario de Plates</h1>

    <form method="post" action="<?= base_url('plates/save/aa9ed22b-d7ef-11ef-820e-683421824c3a') ?>">

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="price">Precio:</label>
        <input type="number" name="price" id="price" required><br>

        
        <label for="preparation_time">Tiempo de preparación (en minutos):</label> 
        <input type="number" name="preparation_time" id="preparation_time" required min="1"><br>

        <label for="description">Descripcion:</label>
        <textarea name="description" id="description"></textarea><br>

        <label for="category">Categoría:</label> 
        <select name="category" id="category" required> 
            <option value="">Seleccione una categoría</option> 
            <option value="Entrante">Entrante</option> 
            <option value="Plato Principal">Plato Principal</option> 
            <option value="Postre">Postre</option> 
            <option value="Ensalada">Ensalada</option> 
            <option value="Sopa">Sopa</option> 
            <option value="Guarnición">Guarnición</option> 
            <option value="Desayuno">Desayuno</option> 
            <option value="Almuerzo">Almuerzo</option>
        </select>
        
        
        <button type="submit">Guardar</button>
    </form>

    <h2>Listado de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Tiempo de preparacion</th>
            <th>Descripcion</th>
            <th>Categoria</th>
        </tr>
        <?php foreach ($plates as $plate): ?>
            <tr>
                <td><?= $plate['id'] ?></td>
                <td><?= $plate['name'] ?></td>
                <td><?= $plate['price'] ?></td>
                <td><?= $plate['preparation_time'] ?></td>
                <td><?= $plate['description'] ?></td>
                <td><?= $plate['category'] ?></td>
                <td><a href='<?=base_url('plates/delete/') . $plate['id'] ?>'>Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ingredientes</title>
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


    <h1>Formulario de Ingredientes</h1>

    <form method="post" action="<?= base_url('ingredients/save') ?>">

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="category">Categoria:</label>
        <select name="category" id="category" required>
            <option value="" disabled selected>Seleccione una Categoria</option>
            <option value="vegetal">Vegetal</option>
            <option value="carne">Carne</option>
            <option value="pescado">Pescado</option>
            <option value="especia">Especia</option>
            <option value="lacteos">Lácteos</option>
            <option value="frutas">Frutas</option>
            <option value="granos">Granos</option>
            <option value="bebidas">Bebidas</option>
            <option value="condimentos">Condimentos</option>
            <option value="panaderia">Panadería</option>
        </select><br>

        

        <label for="quantity_available">Cantidad disponible:</label>
        <input 
          type="number" 
          id="quantity_available" 
          name="quantity_available" 
          step="0.01" 
          min="0" 
          required 
        /><br>

        <label for="unit">Selecciona una unidad:</label>
        <select id="unit" name="unit" required>
            <option value="" disabled selected>Seleccione una unidad</option>
            <option value="g">g (gramos)</option>
            <option value="ml">ml (mililitros)</option>
            <option value="kg">kg (kilogramos)</option>
            <option value="l">l (litros)</option>
            <option value="oz">oz (onzas)</option>
            <option value="lb">lb (libras)</option>
            <option value="cda">cda (cucharadas)</option>
            <option value="unidad">unidad </option>
        </select><br>

        <label for="expiration_date">Fecha de expiracion:</label>
        <input 
          type="date" 
          id="expiration_date" 
          name="expiration_date" 
          min="<?php echo date('Y-m-d'); ?>" 
          required 
        /><br>

        <label for="price">Precio:</label>
        <input 
          type="number" 
          id="price" 
          name="price" 
          step="0.01" 
          min="0" 
          required 
        /><br>

        <label for="allergens">Seleccione un alergeno:</label>
        <select id="allergens" name="allergens">
            <option value="" selected>Ninguno</option>
            <option value="gluten">Gluten</option>
            <option value="crustáceos">Crustáceos</option>
            <option value="huevos">Huevos</option>
            <option value="pescado">Pescado</option>
            <option value="cacahuetes">Cacahuetes</option>
            <option value="soja">Soja</option>
            <option value="leche">Leche</option>
            <option value="frutos secos">Frutos secos</option>
            <option value="apio">Apio</option>
            <option value="mostaza">Mostaza</option>
            <option value="sesamo">Sésamo</option>
            <option value="sulfitos">Sulfitos</option>
            <option value="altramuces">Altramuces</option>
            <option value="moluscos">Moluscos</option>
        </select><br>

        <button type="submit">Guardar</button>
    </form>

    <h2>Listado de Ingredientes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Cantidad disponible</th>
            <th>Unidad</th>
            <th>Fecha de Caducidad</th>
            <th>Precio</th>
            <th>Alergenos</th>
        </tr>
        <?php foreach ($ingredients as $ingredient): ?>
            <tr>
                <td><?= $ingredient['id'] ?></td>
                <td><?= $ingredient['name'] ?></td>
                <td><?= $ingredient['category'] ?></td>
                <td><?= $ingredient['quantity_available'] ?></td>
                <td><?= $ingredient['unit'] ?></td>
                <td><?= $ingredient['expiration_date'] ?></td>
                <td><?= $ingredient['price'] ?></td>
                <td><?= !empty($ingredient['allergens']) ? $ingredient['allergens'] : "ninguno"?></td>

                <td><a href='<?=base_url('ingredients/delete/') .$ingredient['id'] ?>'>Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Menus_Plates</title>
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


    <h1>Formulario de Menus_Plates</h1>

    <form method="post" action="<?= base_url('plates/save/aa9ed22b-d7ef-11ef-820e-683421824c3a') ?>">

        <select name="id_menu" id="id_menu">
          <?php foreach ($menus_plates as $menu_plate): ?>
              
            <option><?= $menu_plate['id_menu'] ?></option>
             
          <?php endforeach; ?>
        </select>

        <select name="id_menu" id="id_menu">
          <?php foreach ($menus_plates as $menu_plate): ?>
              
            <option><?= $menu_plate['id_menu'] ?></option>
             
          <?php endforeach; ?>
        </select>

        

        <label for="amount">Cantidad de plato:</label>
        <input type="number" name="amount" id="amount" required><br>



        
        <button type="submit">Guardar</button>
    </form>

    <h2>Listado de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            
        </tr>
        <?php foreach ($plates as $plate): ?>
            <tr>
                <td><?= $plate['id'] ?></td>
                
                <td><a href='<?=base_url('plates/delete/') . $plate['id'] ?>'>Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

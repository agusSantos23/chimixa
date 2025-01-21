<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Usuario</title>
</head>
<body>
    <?php 
        if (session()->getFlashdata('success')) {
            echo session()->getFlashdata('success');
        } 
    ?>

    <?php if (isset($validation)): ?>
        <div>
            <?= \Config\Services::validation()->listErrors(); ?>
        </div>
    <?php endif; ?>


    <h1>Formulario de Usuario</h1>

    <form method="post" action="<?= base_url('users/save') ?>">

        <label for="role">Rol:</label>
        <select name="role" id="role" required>
            <option value="client" >Client</option>
            <option value="chef" >Chef</option>
            <option value="admin">Admin</option>
        </select><br>

        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="lastname">Apellido:</label>
        <input type="text" name="lastname" id="lastname" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br>

        <label for="phone">Teléfono:</label>
        <input type="text" name="phone" id="phone" required><br>

        <label for="country">País:</label>
        <input type="text" name="country" id="country" required><br>

        <button type="submit">Guardar</button>
    </form>

    <h2>Listado de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Rol</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>País</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['role'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['lastname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['phone'] ?></td>
                <td><?= $user['country'] ?></td>
                <td><a href='<?=base_url('users/delete/') .$user['id'] ?>'>Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>

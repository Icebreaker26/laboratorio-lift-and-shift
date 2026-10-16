<h2>Página de Contacto</h2>

<!-- El controlador inyecta esta variable aquí si existe un mensaje -->
<?php echo $mensaje_db; ?>

<form action="" method="POST" class="form-contacto">
    <label for="nombre">Tu Nombre: </label><br>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="correo">Tu Correo: </label><br>
    <input type="email" id="correo" name="correo" required><br><br>

    <label for="comentario">Tu Comentario: </label><br>
    <textarea id="comentario" name="comentario" rows="5"></textarea><br><br>

    <button type="submit">Enviar Mensaje</button>
</form>

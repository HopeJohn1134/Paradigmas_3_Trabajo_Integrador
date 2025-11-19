<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Iniciar Sesión</title>
<link rel="stylesheet" href="public/css/estilos.css">
<style>
/* Un poco de CSS rápido para el formulario */
.login-container { max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
input { width: 100%; padding: 10px; margin: 10px 0; box-sizing: border-box; }
.btn { width: 100%; background: #333; color: white; padding: 10px; border: none; cursor: pointer; }
.btn:hover { background: #555; }
.error { color: red; text-align: center; }
</style>
</head>
<body>

<div class="login-container">
<h2 style="text-align:center">Iniciar Sesión</h2>

<?php if(isset($error)): ?>
<p class="error"><?php echo $error; ?></p>
<?php endif; ?>

<form action="index.php?c=usuario&a=autenticar" method="POST">
<label>Email:</label>
<input type="email" name="email" required placeholder="ejemplo@correo.com">

<label>Contraseña:</label>
<input type="password" name="password" required>

<button type="submit" class="btn">Entrar</button>
</form>

<p style="text-align:center; margin-top:15px;">
<a href="index.php">Volver al inicio</a>
</p>
</div>

</body>
</html>

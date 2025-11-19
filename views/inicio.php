<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reseñas - Inicio</title>
<link rel="stylesheet" href="public/css/estilos.css">
<style>
/* CSS Rápido para que no se vea feo ahora mismo */
.contenedor-articulos { display: flex; gap: 20px; justify-content: center; }
.tarjeta { border: 1px solid #ccc; padding: 15px; width: 30%; border-radius: 8px; box-shadow: 2px 2px 5px rgba(0,0,0,0.1); }
.categoria { color: #666; font-size: 0.9em; font-weight: bold; }
h2 { margin-top: 0; color: #333; }
.btn { display: inline-block; margin-top: 10px; padding: 8px 15px; background: #007BFF; color: white; text-decoration: none; border-radius: 4px; }
</style>
</head>
<body>

<div style="text-align: center; padding: 20px;">
<h1>Bienvenido a Reseñas Web</h1>
<p>Descubre qué opinan los demás sobre tus temas favoritos.</p>
</div>

<h2 style="text-align:center;">Artículos Destacados</h2>

<div class="contenedor-articulos">
<?php if (!empty($articulos)): ?>
<?php foreach ($articulos as $art): ?>
<div class="tarjeta">
<span class="categoria"><?php echo htmlspecialchars($art['categoria']); ?></span>
<h2><?php echo htmlspecialchars($art['titulo']); ?></h2>
<p><?php echo htmlspecialchars(substr($art['descripcion'], 0, 100)) . '...'; ?></p>

<a href="index.php?c=articulo&a=ver&id=<?php echo $art['id_articulo']; ?>" class="btn">Ver Reseñas</a>
</div>
<?php endforeach; ?>
<?php else: ?>
<p>No hay artículos para mostrar.</p>
<?php endif; ?>
</div>

</body>
</html>

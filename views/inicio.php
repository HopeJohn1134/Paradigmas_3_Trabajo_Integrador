<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Reseñas</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>

    <?php require_once 'views/layout/header.php'; ?>

    <main class="container">
        <section class="hero">
            <h1>Bienvenido a la Plataforma de Reseñas</h1>
            <p>Explora reseñas y calificaciones de películas, series, videojuegos, podcasts y
                libros.</p>
        </section>

        <section class="features">
            <h2>Artículos Destacados</h2>

            <div
                style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-top: 20px;">

                <?php if (!empty($articulos)): ?>
                    <?php foreach ($articulos as $art): ?>
                        <div class="card"
                            style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; width: 300px; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <span
                                style="font-size: 0.8em; color: #666; text-transform: uppercase; letter-spacing: 1px;">
                                <?php echo htmlspecialchars($art['categoria']); ?>
                            </span>

                            <h3 style="margin: 10px 0; color: #333;">
                                <?php echo htmlspecialchars($art['titulo']); ?>
                            </h3>

                            <p style="color: #555; font-size: 0.9em;">
                                <?php echo htmlspecialchars(substr($art['descripcion'], 0, 100)) . '...'; ?>
                            </p>

                            <a href="index.php?c=articulo&a=ver&id=<?php echo $art['id_articulo']; ?>"
                                style="display: inline-block; margin-top: 10px; padding: 8px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">
                                Ver Reseñas
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay artículos disponibles en este momento.</p>
                <?php endif; ?>

            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <a href="https://github.com/HopeJohn1134/Paradigmas_3_Trabajo_Integrador"
                target="_blank">
                &copy; 2025 Hope John - GitHub
            </a>
        </div>
    </footer>

    <script src="public/js/main.js"></script>
</body>
</html>
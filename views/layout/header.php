<header class="header">
    <div class="container nav">
        <div class="logo">
            <a href="index.php">
                <img src="public/img/logo.svg" alt="Logo Plataforma de Reseñas">
            </a>
        </div>

        <button class="menu-toggle" id="menuToggle" aria-label="Abrir menú">
            ☰
        </button>

        <nav class="menu">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="index.php?c=articulo&a=catalogo">Catálogo</a></li>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li>
                        <span style="color: white; font-weight: bold;">
                            Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?>
                        </span>
                    </li>
                    <li><a href="index.php?c=usuario&a=logout" class="btn-logout">Salir</a></li>
                <?php else: ?>
                    <li><a href="index.php?c=usuario&a=login">Ingresar</a></li>
                    <li><a href="index.php?c=usuario&a=registro">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
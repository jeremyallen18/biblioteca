<?php
session_start();
require 'db.php';

// Obtener todos los libros digitales
$query = "SELECT id, titulo, descripcion, archivo_pdf, fecha_subida FROM libros_digitales ORDER BY fecha_subida DESC";
$resultado = $conexion->query($query);
$libros = $resultado->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Digital</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/biblioteca_digital.css">
</head>
<body>
<div class='library-container'>
    <div class='library-content'>
        <!-- Header -->
        <header class='library-header'>
            <div class='library-title'>
                <i class='fas fa-book-open'></i>
                <span>Biblioteca Digital</span>
            </div>
            <div class='nav-buttons'>
                <a href='contenido.php' class='btn btn-secondary'>
                    <i class='fas fa-home'></i>
                    <span>Inicio</span>
                </a>
            </div>
        </header>
        
        <!-- Contenido principal -->
        <main class="container">
            <h2 class="page-title"><i class="fas fa-file-pdf"></i> Nuestra Colección Digital</h2>

            <?php if(count($libros) > 0): ?>
            <div class="libros-grid">
                <?php foreach($libros as $libro): ?>
                    <div class="libro-card">
                        <div class="book-info"> <!-- Changed from libro-body to book-info for consistency -->
                            <h3 class="book-title"><?php echo htmlspecialchars($libro['titulo']); ?></h3> <!-- Added book-title class -->
                            <p class="book-description"><?php echo htmlspecialchars($libro['descripcion']); ?></p>
                            <p class="libro-meta"> <!-- Kept libro-meta, can be styled if needed -->
                                <i class="fas fa-calendar-alt"></i> <?php echo date('d/m/Y', strtotime($libro['fecha_subida'])); ?>
                            </p>
                            <a href="<?php echo htmlspecialchars($libro['archivo_pdf']); ?>" class="btn btn-download" download>
                                <i class="fas fa-download"></i> Descargar PDF
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-books-message">
                <p>No hay libros digitales disponibles aún.</p>
                <?php if(isset($_SESSION['admin_id'])): ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>
    
    <!-- Footer -->
        <footer class="footer">
            <p>Biblioteca Digital &copy; <?php echo date('Y'); ?> - Todos los derechos reservados</p>
            <p>Total de libros disponibles: <?php echo count($libros); ?></p>
        </footer>
    </div> <!-- library-content -->
</div> <!-- library-container -->
</body>
</html>
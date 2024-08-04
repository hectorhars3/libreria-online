<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    if (!in_array($book_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $book_id;
    }
}

$books = [
    1 => ['title' => 'Libro 1', 'author' => 'Autor 1', 'price' => 10.00],
    2 => ['title' => 'Libro 2', 'author' => 'Autor 2', 'price' => 15.00],
    3 => ['title' => 'Libro 3', 'author' => 'Autor 3', 'price' => 20.00]
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de Compras - Librería en Línea</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="bg-primary text-white p-3">
    <h1 class="text-center">Librería en Línea</h1>
    <div class="text-end">
      <a href="logout.php" class="btn btn-secondary">Cerrar Sesión</a>
    </div>
  </header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Librería</a>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Novedades</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="cart.php">Carrito</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Mi Cuenta</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <main class="container mt-4">
    <h2>Carrito de Compras</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Título</th>
          <th>Autor</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($_SESSION['cart'] as $book_id) {
            echo "<tr>
                    <td>{$books[$book_id]['title']}</td>
                    <td>{$books[$book_id]['author']}</td>
                    <td>\${$books[$book_id]['price']}</td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>
  </main>
  <footer class="bg-dark text-white text-center p-3 mt-4">
    <p>&copy; 2024 Librería en Línea. Todos los derechos reservados.</p>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

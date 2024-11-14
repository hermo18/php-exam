<?php

include('./config/database.php');
include_once('api/fetch_book.php');
include('./operations/crud.php');


if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
    fetchBookByISBN($isbn);
}


$search = isset($_GET['search']) ? $_GET['search'] : '';


if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    deleteBook($delete_id);
}


$result = getBooks($search);
?>

<!-- Formulario para buscar y agregar un libro usando ISBN desde la API -->
<form method="POST" action="index.php">
    <label for="isbn">Buscar por ISBN en la API:</label>
    <input type="text" id="isbn" name="isbn" required>
    <input type="submit" value="Buscar y agregar">
</form>

<!-- Formulario para buscar libros en la base de datos -->
<form method="get" action="index.php">
    <label for="search">Buscar en la BDD:</label>
    <input type="text" id="search" name="search" placeholder="Buscar por título, autor o ISBN"
        value="<?php echo htmlspecialchars($search); ?>">
    <input type="submit" value="Buscar">
</form>

<?php

if ($result->num_rows > 0) {
    echo "<h1>Lista de Libros</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Fecha de Publicación</th>
                <th>Acciones</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["title"] . "</td>
                <td>" . $row["author"] . "</td>
                <td>" . $row["isbn"] . "</td>
                <td>" . $row["publishDate"] . "</td>
                <td>
                    <a href='operations/edit.php?id=" . $row["id"] . "'>Editar</a> |
                    <a href='?delete_id=" . $row["id"] . "' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este libro?\")'>Eliminar</a>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No se encontraron resultados.</p>";
}


$conn->close();
?>
<?php

include('../config/database.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = "SELECT id, title, author, isbn, publishDate FROM libros WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Libro no encontrado.";
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $publishDate = $_POST['publishDate'];


    $update_sql = "UPDATE libros SET title = ?, author = ?, isbn = ?, publishDate = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssi", $title, $author, $isbn, $publishDate, $id);
    $stmt->execute();


    header("Location: ../index.php");
    exit;
}
?>

<h1>Editar Libro</h1>
<form method="POST" action="edit.php?id=<?php echo $id; ?>">
    <label for="title">Título:</label><br>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br><br>

    <label for="author">Autor:</label><br>
    <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>"
        required><br><br>

    <label for="isbn">ISBN:</label><br>
    <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>" required><br><br>

    <label for="publishDate">Fecha de Publicación:</label><br>
    <input type="text" id="publishDate" name="publishDate" value="<?php echo htmlspecialchars($book['publishDate']); ?>"
        required><br><br>

    <input type="submit" value="Actualizar">
</form>

<a href="../index.php">Volver a la lista</a>

<?php

$conn->close();
?>
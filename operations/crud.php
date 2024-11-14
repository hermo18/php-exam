<?php

include('./config/database.php');

// Obtener libros de la db
function getBooks($search)
{
    global $conn;
    $sql = "SELECT id, title, author, isbn, publishDate FROM libros WHERE title LIKE ? OR author LIKE ? OR isbn LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);

    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    return $result;
}


// Eliminar un libro
function deleteBook($id)
{
    global $conn;
    $sql = "DELETE FROM libros WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

?>
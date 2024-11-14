<?php

include_once('./config/database.php');

function callOpenLibraryAPI($isbn)
{
    $url = 'https://openlibrary.org/api/books';
    $queryParams = [
        'bibkeys' => 'ISBN:' . $isbn,
        'format' => 'json',
        'jscmd' => 'data'
    ];

    $queryString = http_build_query($queryParams);
    $fullUrl = $url . '?' . $queryString;


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $fullUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        curl_close($ch);
        return null;
    }

    curl_close($ch);
    return $response;
}

// Verificar si el libro ya existe en la base de datos, i ya existe el libro, no hacemos el INSERT
function fetchBookByISBN($isbn, $apiCaller = 'callOpenLibraryAPI')
{
    global $conn;


    $sqlCheck = "SELECT id FROM libros WHERE isbn = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("s", $isbn);
    $stmtCheck->execute();
    $stmtCheck->store_result();


    if ($stmtCheck->num_rows > 0) {
        echo "<p>El libro con el ISBN {$isbn} ya existe en la base de datos.</p>";
        $stmtCheck->close();
        return;
    }

    $response = $apiCaller($isbn);

    if ($response === null) {
        echo 'Error: No se pudo conectar a la API.';
        return;
    }


    $bookData = json_decode($response, true);


    if (isset($bookData['ISBN:' . $isbn])) {
        $book = $bookData['ISBN:' . $isbn];
        $title = $book['title'] ?? 'Sin título';
        $author = isset($book['authors'][0]['name']) ? $book['authors'][0]['name'] : 'Desconocido';
        $publishDate = $book['publish_date'] ?? 'Desconocida';


        $sqlInsert = "INSERT INTO libros (title, author, isbn, publishDate) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("ssss", $title, $author, $isbn, $publishDate);
        $stmtInsert->execute();
        $stmtInsert->close();

        echo "<p>El libro '{$title}' fue añadido correctamente.</p>";
    } else {
        echo "<p>No se encontraron datos para el ISBN proporcionado.</p>";
    }

    $stmtCheck->close();
}
?>
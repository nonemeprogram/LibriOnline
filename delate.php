<?php
$conn = new mysqli("localhost", "root", "", "libri");
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT copertina FROM books WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
unlink("uploads/" . $row['copertina']);

$sql = "DELETE FROM books WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Libro eliminato con successo.";
} else {
    echo "Errore: " . $conn->error;
}
$conn->close();
header("Location: index.php");

<?php
$conn = new mysqli("localhost", "root", "", "libri");
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$titolo = $_POST['titolo'];
$autore = $_POST['autore'];
$copertina = $_FILES['copertina']['name'];
$target = "uploads/" . basename($copertina);

if (move_uploaded_file($_FILES['copertina']['tmp_name'], $target)) {
    $sql = "INSERT INTO books (titolo, autore, copertina) VALUES ('$titolo', '$autore', '$copertina')";
    if ($conn->query($sql) === TRUE) {
        echo "Libro caricato con successo.";
    } else {
        echo "Errore: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Errore nel caricamento della copertina.";
}
$conn->close();
header("Location: index.php");


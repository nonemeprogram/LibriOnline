<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Libri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            color: red;
        }
        .libro {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .libro img {
            width: 80px;
            height: 120px;
            margin-right: 20px;
        }
        .libro .info {
            display: flex;
            flex-direction: column;
        }
        .libro .info .titolo {
            font-size: 1.2em;
            color: blue;
        }
        .libro .info .autore {
            font-size: 1em;
            color: black;
        }
        .libro .info .azione {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<h1>Libri:</h1>
<?php
$conn = new mysqli("localhost", "root", "", "libri");
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='libro'>
                    <img src='uploads/" . $row["copertina"] . "'>
                    <div class='info'>
                        <span class='titolo'>" . $row["titolo"] . "</span>
                        <span class='autore'>Autore: " . $row["autore"] . "</span>
                        <span class='azione'><a href='delete.php?id=" . $row["id"] . "'>Elimina</a></span>
                    </div>
                </div>";
    }
} else {
    echo "Nessun libro trovato.";
}
$conn->close();
?>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="titolo">Titolo:</label>
    <input type="text" name="titolo" id="titolo" required><br>
    <label for="autore">Autore:</label>
    <input type="text" name="autore" id="autore" required><br>
    <label for="copertina">Copertina:</label>
    <input type="file" name="copertina" id="copertina" required><br>
    <button type="submit">Carica Libro</button>
</form>
</body>
</html>

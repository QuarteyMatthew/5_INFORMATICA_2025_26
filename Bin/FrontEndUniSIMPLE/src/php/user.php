<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "unithogheter";

$conn = new mysqli($servername, $username, $password, $dbname);

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$telefono = $_POST["telefono"];
$luogo_nascita = $_POST["luogo_nascita"];
$data_nascita = $_POST["data_nascita"];
$codice_fiscale = $_POST["codice_fiscale"];
$email = $_POST["email"];
$pass = $_POST["password"];
$via = $_POST["via"];
$cap = $_POST["cap"];
$citta = $_POST["citta"];
$numero_civico = $_POST["numero_civico"];
$ateneo = isset($_POST["ateneo"]) ? $_POST["ateneo"] : null;

if ($conn->connect_error) {
    die("Connection falied: " . $conn->connect_error);
}

$sql = "insert into utenti (nome, cognome, telefono, luogo_nascita, DATA_NASCITA, codice_fiscale, email, pass, via, cap, citta, Numero_civico, ateneo_riferimento) VALUES ('$nome', '$cognome', '$telefono', '$luogo_nascita', '$data_nascita', '$codice_fiscale', '$email', '$pass', '$via', '$cap', '$citta', '$numero_civico', '$ateneo');";

if ($conn->query($sql) === TRUE) {
    echo "Tutto creato bene";
} else {
    echo "errore";
}
?>
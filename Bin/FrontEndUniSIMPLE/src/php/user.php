<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use environment variables when available; defaults match docker-compose in src/php/docker-compose.yml
$servername = getenv('DB_HOST') ?: 'db';
$username = getenv('DB_USER') ?: 'user';
$password = getenv('DB_PASS') ?: 'pass';
$dbname   = getenv('DB_NAME') ?: 'unitg';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (Exception $e) {
    http_response_code(500);
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Read POST values (basic fallback to empty strings)
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$cognome = isset($_POST['cognome']) ? $_POST['cognome'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$luogo_nascita = isset($_POST['luogo_nascita']) ? $_POST['luogo_nascita'] : '';
$data_nascita = isset($_POST['data_nascita']) ? $_POST['data_nascita'] : null;
$codice_fiscale = isset($_POST['codice_fiscale']) ? $_POST['codice_fiscale'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';
$via = isset($_POST['via']) ? $_POST['via'] : '';
$cap = isset($_POST['cap']) ? $_POST['cap'] : '';
$citta = isset($_POST['citta']) ? $_POST['citta'] : '';
$numero_civico = isset($_POST['numero_civico']) ? $_POST['numero_civico'] : '';
$ateneo = isset($_POST['ateneo']) ? $_POST['ateneo'] : null;

// Prepared statement to avoid SQL injection and give better error messages
try {
    $stmt = $conn->prepare(
        "INSERT INTO utenti (nome, cognome, telefono, luogo_nascita, data_nascita, codice_fiscale, email, pass, via, cap, citta, numero_civico, ateneo_riferimento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param('sssssssssssss', $nome, $cognome, $telefono, $luogo_nascita, $data_nascita, $codice_fiscale, $email, $pass, $via, $cap, $citta, $numero_civico, $ateneo);

    if ($stmt->execute()) {
        echo 'Tutto creato bene';
    } else {
        http_response_code(500);
        echo 'Errore: ' . $stmt->error;
    }

    $stmt->close();
} catch (Exception $e) {
    http_response_code(500);
    echo 'Errore esecuzione query: ' . $e->getMessage();
}

$conn->close();
?>
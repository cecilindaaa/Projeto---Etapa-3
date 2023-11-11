<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new SQLite3('database.db');

if (!$db) {
    die("Erro na conexão com o banco de dados");
}

$query = "CREATE TABLE IF NOT EXISTS consultas (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    objetivo TEXT,
    compatibilidade TEXT,
    compreensao TEXT,
    utilidade TEXT,
    opiniao TEXT
)";

$result = $db->exec($query);

if ($result !== false) {

} else {
    die("Erro na criação da tabela: " . $db->lastErrorMsg());
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $objetivo = $_POST['comment1'];
    $compatibilidade = $_POST['comment2'];
    $compreensao = $_POST['comment3'];
    $utilidade = $_POST['comment4'];
    $opiniao = $_POST['comment5'];

    $query = "INSERT INTO consultas (objetivo, compatibilidade, compreensao, utilidade, opiniao)
    VALUES (:objetivo, :compatibilidade, :compreensao, :utilidade, :opiniao)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':objetivo', $objetivo, SQLITE3_TEXT);
    $stmt->bindParam(':compatibilidade', $compatibilidade, SQLITE3_TEXT);
    $stmt->bindParam(':compreensao', $compreensao, SQLITE3_TEXT);
    $stmt->bindParam(':utilidade', $utilidade, SQLITE3_TEXT);
    $stmt->bindParam(':opiniao', $opiniao, SQLITE3_TEXT);

    $result = $stmt->execute();

if ($result !== false) {
    echo "Sua Avaliação foi enviada com sucesso!";
} else {
    echo "Erro ao armazenar dados do formulário.";
}
        
}
}
        
$db->close();
?>
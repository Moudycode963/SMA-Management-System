<?php
// public/debug_db.php

echo "<h1>🕵️‍♂️ Datenbank Debugger</h1>";

// 1. Umgebungsvariablen prüfen
$host = getenv('DB_HOST');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

echo "<h2>1. Environment Check</h2>";
echo "<strong>DB_HOST:</strong> " . ($host ?: '<span style="color:red">LEER (Fehler!)</span>') . "<br>";
echo "<strong>DB_DATABASE:</strong> " . ($db ?: '<span style="color:red">LEER</span>') . "<br>";
echo "<strong>DB_USERNAME:</strong> " . ($user ?: '<span style="color:red">LEER</span>') . "<br>";
echo "<strong>DB_PASSWORD:</strong> " . ($pass ? '****** (Gesetzt)' : '<span style="color:red">LEER (Fehler!)</span>') . "<br>";

// 2. Verbindungsversuch
echo "<h2>2. Verbindungsversuch</h2>";

try {
    $dsn = "mysql:host=$host;port=3306;dbname=$db;charset=utf8mb4";
    echo "Versuche Verbindung zu: <code>$dsn</code><br>...<br>";

    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h3 style='color:green'>✅ ERFOLG! Verbindung hergestellt.</h3>";
    echo "Datenbank antwortet: " . $pdo->query("SELECT VERSION()")->fetchColumn();

} catch (PDOException $e) {
    echo "<h3 style='color:red'>❌ FEHLER!</h3>";
    echo "<strong>Meldung:</strong> " . $e->getMessage() . "<br>";
    echo "<strong>Code:</strong> " . $e->getCode();
}
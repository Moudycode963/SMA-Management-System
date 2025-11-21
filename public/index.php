<?php

// 1. Wir laden den Composer Autoloader
// Er übernimmt ab jetzt das Laden ALLER Klassen (deine & externe)
require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database; // Wir "importieren" die Klasse, um sie kurz benutzen zu können

try {
    // Der Autoloader sieht "App\Config\Database", schaut in composer.json,
    // sieht "App" -> "app/", und lädt "app/Config/Database.php".
    $db = Database::getInstance()->getConnection();

    echo "<h1>✅ System Status: Online</h1>";
    echo "<p>Datenbank-Verbindung erfolgreich via PSR-4 Autoloading hergestellt.</p>";

} catch (Exception $e) {
    echo "<h1>❌ System Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
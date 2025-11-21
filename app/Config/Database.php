<?php
 # Konfigurationsdateien (z.B. Datenbank-Verbindung)


namespace App\Config;
// 👈 WICHTIG: Der Namespace

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    // ... (Rest des Codes bleibt gleich wie in meiner ersten Version)
}
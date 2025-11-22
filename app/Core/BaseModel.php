<?php

namespace App\Core;

use App\Config\Database;
use PDO;

abstract class BaseModel
{
    // Die Verbindung ist für alle erbenden Klassen zugänglich (protected)
    protected PDO $db;

    public function __construct()
    {
        // Holt die Singleton-Datenbankverbindung und speichert sie
        $this->db = Database::getInstance()->getConnection();
    }

    // Später könnten hier generische CRUD-Methoden (Create, Read, Update, Delete) stehen.
}
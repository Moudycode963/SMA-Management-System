<?php

namespace App\Models;

use App\Core\BaseModel;

class User extends BaseModel
{
    // Die Tabelle, mit der dieses Model arbeitet
    protected string $table = 'T_Mitarbeiter';

    /**
     * Sucht einen Mitarbeiter anhand des Benutzernamens (oder der ID)
     * @param string $username
     * @return array|false
     */
    public function findUserByUsername(string $username): array|false
    {
        $sql = "SELECT * FROM {$this->table} WHERE name = :username LIMIT 1";

        // PDO Prepared Statement (WICHTIG für Security gegen SQL-Injection!)
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Gibt das Ergebnis als assoziatives Array zurück
        return $stmt->fetch();
    }
}
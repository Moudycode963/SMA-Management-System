-- Datenbank wechseln (oder sicherstellen, dass sie ausgewählt ist)
USE security_db;

-- -----------------------------------------------------
-- T_Einsatzorte (FA-M-01)
-- Speichert die GPS-Koordinaten für die Standortverifizierung
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS T_Einsatzorte
(
    id               INT AUTO_INCREMENT PRIMARY KEY,
    name             VARCHAR(100)   NOT NULL UNIQUE,
    adresse          VARCHAR(255)   NOT NULL,
    gps_lat          DECIMAL(10, 8) NOT NULL,           -- Breitengrad
    gps_lon          DECIMAL(11, 8) NOT NULL,           -- Längengrad
    checkin_radius_m INT            NOT NULL DEFAULT 50 -- 50m Radius (FA-E-02)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- T_Mitarbeiter (FA-E-01)
-- Basis-Nutzerprofile. Wir speichern das Passwort sicher als Hash.
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS T_Mitarbeiter
(
    id            INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100)                    NOT NULL UNIQUE,
    passwort_hash VARCHAR(255)                    NOT NULL, -- Speichert den Hash des Passworts
    rolle         ENUM ('Mitarbeiter', 'Manager') NOT NULL DEFAULT 'Mitarbeiter',
    kontakt_email VARCHAR(100) UNIQUE,
    erstellt_am   TIMESTAMP                                DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- T_Schichten
-- Definiert die Planung und den Soll-Zustand.
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS T_Schichten
(
    id                    INT AUTO_INCREMENT PRIMARY KEY,
    einsatzort_id         INT      NOT NULL,
    plan_startzeit        DATETIME NOT NULL,
    plan_endzeit          DATETIME NOT NULL,
    erforderliche_ma_zahl INT      NOT NULL DEFAULT 1,
    notizen               TEXT,

    FOREIGN KEY (einsatzort_id) REFERENCES T_Einsatzorte (id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- T_Schicht_Zuweisung
-- Verknüpft Mitarbeiter mit Schichten (N:M Beziehung)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS T_Schicht_Zuweisung
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    schicht_id     INT                                                             NOT NULL,
    mitarbeiter_id INT                                                             NOT NULL,
    status         ENUM ('zugewiesen', 'angenommen', 'abgelehnt', 'abgeschlossen') NOT NULL DEFAULT 'zugewiesen',

    FOREIGN KEY (schicht_id) REFERENCES T_Schichten (id) ON DELETE CASCADE,
    FOREIGN KEY (mitarbeiter_id) REFERENCES T_Mitarbeiter (id) ON DELETE CASCADE,

    -- Stellt sicher, dass ein Mitarbeiter nur einmal pro Schicht zugewiesen ist
    UNIQUE KEY unique_assignment (schicht_id, mitarbeiter_id)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- T_Zeiterfassung (Kernfunktionalität Check-in/out)
-- Speichert die tatsächlichen Zeit- und GPS-Daten
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS T_Zeiterfassung
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    zuweisung_id    INT NOT NULL UNIQUE, -- 1:1 zu T_Schicht_Zuweisung
    checkin_zeit    DATETIME,
    checkin_gps_lat DECIMAL(10, 8),
    checkin_gps_lon DECIMAL(11, 8),
    checkout_zeit   DATETIME,
    gps_verifiziert BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (zuweisung_id) REFERENCES T_Schicht_Zuweisung (id) ON DELETE CASCADE
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- T_SOS_Meldungen (FA-E-04)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS T_SOS_Meldungen
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    mitarbeiter_id INT                                          NOT NULL,
    zeitstempel    TIMESTAMP                                             DEFAULT CURRENT_TIMESTAMP,
    gps_lat        DECIMAL(10, 8)                               NOT NULL,
    gps_lon        DECIMAL(11, 8)                               NOT NULL,
    status         ENUM ('Offen', 'Bearbeitung', 'Geschlossen') NOT NULL DEFAULT 'Offen',

    FOREIGN KEY (mitarbeiter_id) REFERENCES T_Mitarbeiter (id) ON DELETE CASCADE
) ENGINE = InnoDB;
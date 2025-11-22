<?php

namespace App\Core;

class Router
{
    // Hier speichern wir alle Routen: $routes['GET']['/login'] = callback
    protected array $routes = [];

    // Route für GET-Anfragen registrieren
    public function get(string $path, array $callback): void
    {
        $this->routes['get'][$path] = $callback;
    }

    // Route für POST-Anfragen registrieren (z.B. Formular absenden)
    public function post(string $path, array $callback): void
    {
        $this->routes['post'][$path] = $callback;
    }

    // Die Hauptfunktion: Anfrage auswerten und Controller starten
    public function resolve()
    {
        // 1. Pfad ermitteln (ohne Query-Parameter wie ?id=1)
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position !== false) {
            $path = substr($path, 0, $position);
        }

        // 2. Methode ermitteln (get oder post)
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        // 3. Prüfen, ob die Route existiert
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            // 404 Not Found
            http_response_code(404);
            echo "<h1>404 - Seite nicht gefunden</h1>";
            return;
        }

        // 4. Controller instanziieren und Methode aufrufen
        // $callback ist z.B. [HomeController::class, 'index']
        if (is_array($callback)) {
            $controller = new $callback[0](); // Erstellt new HomeController()
            $callback[0] = $controller;
        }

        return call_user_func($callback);
    }
}
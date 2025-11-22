<?php

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        echo "<h1>🏠 Dashboard Home</h1>";
        echo "<p>Willkommen im Security Management System.</p>";
    }

    public function login()
    {
        echo "<h1>🔐 Login Seite</h1>";
        echo "<p>Hier kommt das Login-Formular hin.</p>";
    }
}
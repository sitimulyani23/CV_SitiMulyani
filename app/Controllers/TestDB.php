<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;

class TestDB extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();
            echo "✅ Koneksi ke database berhasil!<br>";
            echo "Database: " . $db->getDatabase() . "<br>";
        } catch (\Exception $e) {
            echo "❌ Gagal terhubung ke database!<br>";
            echo "Error: " . $e->getMessage();
        }
    }
}

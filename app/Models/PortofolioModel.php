<?php

namespace App\Models;

use CodeIgniter\Model;

class PortofolioModel extends Model
{
    protected $table = 'portofolio';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul', 'deskripsi', 'link', 'gambar'
    ];
}

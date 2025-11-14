<?php

namespace App\Models;

use CodeIgniter\Model;

class PengalamanModel extends Model
{
    protected $table = 'pengalaman';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_perusahaan', 'posisi', 'mulai', 'selesai', 'deskripsi'
    ];
}

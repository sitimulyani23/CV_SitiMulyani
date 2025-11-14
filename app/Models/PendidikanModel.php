<?php

namespace App\Models;

use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table = 'pendidikan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'institusi', 'jurusan', 'tahun_masuk', 'tahun_lulus', 'keterangan'
    ];
}

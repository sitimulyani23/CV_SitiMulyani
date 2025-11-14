<?php
// File: app/Controllers/CvController.php
namespace App\Controllers;

use App\Models\BiodataModel;
use App\Models\KeahlianModel;
use App\Models\PendidikanModel;
use App\Models\PengalamanModel;
use App\Models\PortofolioModel;

class CvController extends BaseController
{
    public function index()
    {
        $biodataModel = new BiodataModel();
        $keahlianModel = new KeahlianModel();
        $pendidikanModel = new PendidikanModel();
        $pengalamanModel = new PengalamanModel();
        $portofolioModel = new PortofolioModel();

        $biodata = $biodataModel->first();

        $data = [
            'biodata'     => $biodata,
            'keahlian'    => $keahlianModel->where('biodata_id', $biodata['id'])->findAll(),
            'pendidikan'  => $pendidikanModel->where('biodata_id', $biodata['id'])->findAll(),
            'pengalaman'  => $pengalamanModel->where('biodata_id', $biodata['id'])->findAll(),
            'portofolio'  => $portofolioModel->where('biodata_id', $biodata['id'])->findAll(),
        ];

        return view('cv/layout', $data);
    }
}
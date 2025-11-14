<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'name' => 'Siti Mulyani',
            'description' => 'Portofolio interaktif dengan visual 3D, efek partikel, dan neon. Jelajahi karya saya.'
        ];

        // Pastikan kita render layout, bukan langsung hero
        return view('cv/layout', $data);
    }
}

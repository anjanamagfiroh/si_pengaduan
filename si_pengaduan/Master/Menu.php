<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/uts_anjanamagfiroh/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'Petugas', 'Link' => $base . 'petugas'),
            array('Text' => 'Pelanggan', 'Link' => $base . 'pelanggan'),
            array('Text' => 'Pengaduan', 'Link' => $base . 'pengaduan'),
        ];
        return $data;
    }
}

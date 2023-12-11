<?php

namespace Master;

use Config\Query_builder;

class Pelanggan
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('pelanggan')->get()->resultArray();
        $res = '<a href="?target=pelanggan&act=tambah_pelanggan" class="btn btn-info btn-sm">Tambah Pelanggan</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nik</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td width="100">' . $r['nik'] . '</td>
                <td>' . $r['nama'] . '</td>
                <td>' . $r['username'] . '</td>
                <td>' . $r['password'] . '</td>
                <td>' . $r['telp'] . '</td>
                <td width="150">
                    <a href="?target=pelanggan&act=edit_pelanggan&id=' . $r['nik'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=pelanggan&act=delete_pelanggan&id=' . $r['nik'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=pelanggan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pelanggan&act=simpan_pelanggan">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telp</label>
                <input type="text" class="form-control" id="Telp" name="Telp">

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $telp = $_POST['telp'];

        $data = array(
            'nik' => $nik,
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'telp' => $telp,

        );
        return $this->db->table('pelanggan')->insert($data);
    }
    public function edit($id)
    {
        // get data pelanggan
        $r = $this->db->table('pelanggan')->where("nik='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=pelanggan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pelanggan&act=update_pelanggan">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['nik'] . '">

            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" value="' . $r['nik'] . '">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="' . $r['nama'] . '">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="' . $r['username'] . '">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" value="' . $r['password'] . '">
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telp</label>
                <input type="text" class="form-control" id="telp" name="telp" value="' . $r['telp'] . '">
            </div>


            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>';
        return $res;
    }

    public function cekRadio($val, $val2)
    {
        if ($val == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $telp = $_POST['telp'];

        $data = array(
            'nik' => $nik,
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'telp' => $telp,
        );
        return $this->db->table('pelanggan')->where("nik='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('pelanggan')->where("nik='$id'")->delete();
    }
}

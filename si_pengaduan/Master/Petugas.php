<?php

namespace Master;

use Config\Query_builder;

class Petugas
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('petugas')->get()->resultArray();
        $res = '<a href="?target=petugas&act=tambah_petugas" class="btn btn-info btn-sm">Tambah Petugas</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>ID_Petugas</th>
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
                <td width="100">' . $r['id_petugas'] . '</td>
                <td>' . $r['nama_petugas'] . '</td>
                <td>' . $r['username'] . '</td>
                <td>' . $r['password'] . '</td>
                <td>' . $r['telp_petugas'] . '</td>
                <td width="150">
                    <a href="?target=petugas&act=edit_petugas&id=' . $r['id_petugas'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=petugas&act=delete_petugas&id=' . $r['id_petugas'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=petugas" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=petugas&act=simpan_petugas">
            <div class="mb-3">
                <label for="id_petugas" class="form-label">id_petugas</label>
                <input type="text" class="form-control" id="id_petugas" name="id_petugas">
            </div>
            <div class="mb-3">
                <label for="nama_petugas" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_petugas" name="nama_petugas">
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
            <label for="telp_petugas" class="form-label">Telp</label>
            <input type="text" class="form-control" id="telp_petugas" name="telp_petugas">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_petugas = $_POST['id_petugas'];
        $nama_petugas = $_POST['nama_petugas'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $telp_petugas = $_POST['telp_petugas'];

        $data = array(
            'id_petugas' => $id_petugas,
            'nama_petugas' => $nama_petugas,
            'username' => $username,
            'password' => $password,
            'telp_petugas' => $telp_petugas,
        );
        return $this->db->table('petugas')->insert($data);
    }
    public function edit($id)
    {
        // get data petugas
        $r = $this->db->table('petugas')->where("id_petugas='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=petugas" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=petugas&act=update_petugas">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_petugas'] . '">
            <div class="mb-3">
                <label for="id_petugas" class="form-label">ID petugas</label>
                <input type="text" class="form-control" id="id_petugas" name="id_petugas" value="' . $r['id_petugas'] . '">
            </div>
            <div class="mb-3">
                <label for="nama_petugas" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="' . $r['nama_petugas'] . '">
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
                <label for="telp_petugas" class="form-label">Telp</label>
                <input type="text" class="form-control" id="telp_petugas" name="telp_petugas" value="' . $r['telp_petugas'] . '">
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
        $id_petugas = $_POST['id_petugas'];
        $nama_petugas = $_POST['nama_petugas'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $telp_petugas = $_POST['telp_petugas'];

        $data = array(
            'id_petugas' => $id_petugas,
            'nama_petugas' => $nama_petugas,
            'username' => $username,
            'password' => $password,
            'telp_petugas' => $telp_petugas,
        );
        return $this->db->table('petugas')->where("id_petugas='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('petugas')->where("id_petugas='$id'")->delete();
    }
}

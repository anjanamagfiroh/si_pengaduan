<?php

namespace Master;

use Config\Query_builder;

class Pengaduan
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('pengaduan')->get()->resultArray();
        $res = '<a href="?target=pengaduan&act=tambah_pengaduan" class="btn btn-info btn-sm">Tambah Pengaduan</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Tanggal Pengaduan</th>
                    <th>Nik</th>
                    <th>Isi Laporan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td>' . $r['id_pengaduan'] . '</td>
                <td>' . $r['tgl_pengaduan'] . '</td>
                <td>' . $r['nik'] . '</td>
                <td>' . $r['isi_laporan'] . '</td>
                <td width="150">
                    <a href="?target=pengaduan&act=edit_pengaduan&id=' . $r['id_pengaduan'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=pengaduan&act=delete_pengaduanl&id=' . $r['id_pengaduan'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=pengaduan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pengaduan&act=simpan_pengaduan">
            <div class="mb-3">
                <label for="id_pengaduan" class="form-label">Id</label>
                <input type="text" class="form-control" id="id_pengaduan" name="id_pengaduan">
            </div>
            <div class="mb-3">
                <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
                <input type="date" class="form-control" id="tgl_pengaduan" name="tgl_pengaduan">
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">Nik</label>
                <input type="text" class="form-control" id="nik" name="nik">
            </div>
            <div class="mb-3">
                <label for="isi_laporan" class="form-label">Isi Laporan</label>
                <input type="text" class="form-control" id="isi_laporan" name="isi_laporan">

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id_pengaduan = $_POST['id_pengaduan'];
        $tgl_pengaduan = $_POST['tgl_pengaduan'];
        $nik = $_POST['nik'];
        $isi_laporan = $_POST['isi_laporan'];

        $data = array(
            'id_pengaduan' => $id_pengaduan,
            'tgl_pengaduan' => $tgl_pengaduan,
            'nik' => $nik,
            'isi_laporan' => $isi_laporan,

        );
        return $this->db->table('pengaduan')->insert($data);
    }
    public function edit($id)
    {
        // get data pengaduan
        $r = $this->db->table('pengaduan')->where("id_pengaduan='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=pengaduan" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pengaduan&act=update_pengaduan">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id_pengaduan'] . '">

            <div class="mb-3">
                <label for="id_pengaduan" class="form-label">Id</label>
                <input type="text" class="form-control" id="id_pengaduan" name="id_pemgaduan" value="' . $r['id_pengaduan'] . '">
            </div>
            <div class="mb-3">
                <label for="tgl_pengaduan" class="form-label">Tanggal Pengaduan</label>
                <input type="date" class="form-control" id="tgl_pengaduan" name="tgl_pengaduan" value="' . $r['tgl_pengaduan'] . '">
            </div>
            <div class="mb-3">
                <label for="nik" class="form-label">Nik</label>
                <input type="text" class="form-control" id="nik" name="nik" value="' . $r['nik'] . '">
            </div>
            <div class="mb-3">
                <label for="isi_laporan" class="form-label">Isi Laporan</label>
                <input type="text" class="form-control" id="isi_laporan" name="isi_laporan" value="' . $r['isi_laporan'] . '">


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
        $id_pengaduan = $_POST['id_pengaduan'];
        $tgl_pengaduan = $_POST['tgl_pengaduan'];
        $nik = $_POST['nik'];
        $isi_laporan = $_POST['isi_laporan'];

        $data = array(
            'id_pengaduan' => $id_pengaduan,
            'tgl_pengaduan' => $tgl_pengaduan,
            'nik' => $nik,
            'isi_laporan' => $isi_laporan,

        );
        return $this->db->table('pengaduan')->where("id_pengaduan='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('pengaduan')->where("id_pengaduan='$id'")->delete();
    }
}

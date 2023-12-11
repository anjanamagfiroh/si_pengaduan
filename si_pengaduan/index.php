<?php

use Master\Menu;
use Master\Petugas;
use Master\Pelanggan;
use Master\Pengaduan;

include 'autoload.php';
include 'Config/Database.php';

$menu = new Menu();
$petugas = new Petugas($dataKoneksi);
$pelanggan = new Pelanggan($dataKoneksi);
$pengaduan = new Pengaduan($dataKoneksi);
// $mahasiswa->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UlanganTengahSemester</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="">CRUD OOP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria- controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php
foreach ($menu->topMenu() as $r) {
    ?>
                            <li class="nav-item">
                                <a href="<?php echo $r['Link']; ?>" class="nav-link">
                                    <?php echo $r['Text']; ?>
                                </a>
                            </li>
                        <?php
}
?>
                    </ul>
                </div>
            </div>
        </nav>
        <br>
        <div class="content">
            <h5>Content <?php echo strtoupper($target); ?></h5>
            <?php
if (!isset($target) or $target == "home") {
    echo "Hai, Selamat Datang Di Beranda";
    // =========== start kontent petugas ======================
} elseif ($target == "petugas") {
    if ($act == "tambah_petugas") {
        echo $petugas->tambah();
    } elseif ($act == "simpan_petugas") {
        if ($petugas->simpan()) {
            echo "<script>
                            alert('data sukses disimpan');
                            window.location.href='?target=petugas';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal disimpan');
                            window.location.href='?target=petugas';
                        </script>";
        }
    } elseif ($act == "edit_petugas") {
        $id = $_GET['id'];
        echo $petugas->edit($id);
    } elseif ($act == "update_petugas") {
        if ($petugas->update()) {
            echo "<script>
                            alert('data sukses diubah');
                            window.location.href='?target=petugas';
                        </script>";
        } else {
            echo "<script>
                            alert('data gagal diubah');
                            window.location.href='?target=petugas';
                        </script>";
        }
    } elseif ($act == "delete_petugas") {
        $id = $_GET['id'];
        if ($petugas->delete($id)) {
            echo "<script>
                            alert('data sukses dihapus');
                            window.location.href='?target=petugas';
                        </script>";
        } else {
            echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=petugas';
                    </script>";
        }
    } else {
        echo $petugas->index();
    }

    // pelanggan
} elseif ($target == "pelanggan") {
    if ($act == "tambah_pelanggan") {
        echo $pelanggan->tambah();
    } elseif ($act == "simpan_pelanggan") {
        if ($pelanggan->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=pelanggan';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=pelanggan';
                    </script>";
        }
    } elseif ($act == "edit_pelanggan") {
        $id = $_GET['id'];
        echo $pelanggan->edit($id);
    } elseif ($act == "update_pelanggan") {
        if ($pelanggan->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?target=pelanggan';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=pelanggan';
                    </script>";
        }
    } elseif ($act == "delete_pelanggan") {
        $id = $_GET['id'];
        if ($pelanggan->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=pelanggan';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=pelanggan';
                </script>";
        }
    } else {
        echo $pelanggan->index();
    }

    // pengaduan
} elseif ($target == "pengaduan") {
    if ($act == "tambah_pengaduan") {
        echo $pengaduan->tambah();
    } elseif ($act == "simpan_pengaduan") {
        if ($pengaduan->simpan()) {
            echo "<script>
                        alert('data sukses disimpan');
                        window.location.href='?target=pengaduan';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=pengaduan';
                    </script>";
        }
    } elseif ($act == "edit_pengaduan") {
        $id = $_GET['id'];
        echo $pengaduan->edit($id);
    } elseif ($act == "update_pengaduan") {
        if ($pengaduan->update()) {
            echo "<script>
                        alert('data sukses diubah');
                        window.location.href='?targetpengaduan';
                    </script>";
        } else {
            echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=pengaduan';
                    </script>";
        }
    } elseif ($act == "delete_pengaduan") {
        $id = $_GET['id'];
        if ($pengaduan->delete($id)) {
            echo "<script>
                        alert('data sukses dihapus');
                        window.location.href='?target=pengaduan';
                    </script>";
        } else {
            echo "<script>
                    alert('data gagal dihapus');
                    window.location.href='?target=pengaduan';
                </script>";
        }
    } else {
        echo $pengaduan->index();
    }

    // no pengguna
} elseif ($target == 'pengguna') {

    echo "selamat datang di pengguna";
}
?>
    </div>
</div>
</body>
</html>
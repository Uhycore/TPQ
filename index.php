<?php
require_once 'controllers/roleController.php';
require_once 'controllers/userController.php';
require_once 'controllers/santriController.php';
require_once 'controllers/mapelController.php';

require_once 'models/nilaiModel.php';
require_once 'models/keuanganModel.php';

require_once 'models/mapelModel.php';
require_once 'models/santriModel.php';



session_start();


$modul = isset($_GET['modul']) ? $_GET['modul'] : null;

$objRoles = new RoleController();
$objUsers = new UserController();
$objSantri = new SantriController();
$objMapel = new MapelController();

$objNilai = new NilaiModel();
$objKeuangan = new KeuanganModel();

$obj_mapel = new MapelModel();
$obj_santri = new SantriModel();






switch ($modul) {
    case 'login':
        $pengguna = $obj_santri->getAllSantris();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];


            foreach ($pengguna as $user) {
                if ($user->username == $username && $user->password == $password) {
                    // Jika username dan password cocok, periksa role
                    if ($user->role->roleId == 1) {
                        // Role ID 1 (admin)
                        $santriId = $user->santriId;
                        $user = $obj_santri->getSantriById($santriId);
                        $_SESSION['username_login'] = $user;
                        include 'views/role/roleDashboard.php';
                    } else if ($user->role->roleId == 3) {
                        // Role ID 3 (santri)
                        $santriId = $user->santriId;
                        $user = $obj_santri->getSantriById($santriId);
                        $_SESSION['username_login'] = $user;
                        include 'views/santri/santriDashboard.php';
                    }
                }
            }
        }
        break;
    case 'logout':
        unset($_SESSION['username_login']);
        include 'views/items/login.php';
        break;
    case 'role':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objRoles->listRoles();

                break;
            case 'input':
                include 'views/role/roleInput.php';
                break;
            case 'add':
                $roleName = $_POST['roleNama'];
                $roelDeskripsi = $_POST['roleDeskripsi'];
                $roleStatus = $_POST['roleStatus'];

                $objRoles->addRole($roleName, $roelDeskripsi, $roleStatus);
                break;
            case 'delete':
                $roleId = $_POST['roleId'];

                $objRoles->deleteRole($roleId);
                break;

            case 'edit':
                $roleId = $_GET['roleId'];

                $objRoles->editById($roleId);
                break;
            case 'update':
                $roleId = $_POST['roleId'];
                $roleName = $_POST['roleNama'];
                $roelDeskripsi = $_POST['roleDeskripsi'];
                $roleStatus = $_POST['roleStatus'];

                $objRoles->updateRole($roleId, $roleName, $roelDeskripsi, $roleStatus);
                break;
            default:
                $objRoles->listRoles();
                break;
        }
        break;
    case 'user':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objUsers->listUsers();
                break;
            case 'input':
                $objUsers->inputUsers();

                break;
            case 'add':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $objUsers->addUser($username, $password, $role);
                break;
            case 'edit':
                $userId = $_GET['userId'];

                $objUsers->editById($userId);
                break;
            case 'update':
                $userId = $_POST['userId'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];

                $objUsers->updateUser($userId, $username, $password, $role);
                break;

            case 'delete':
                $userId = $_POST['userId'];

                $objUsers->deleteUser($userId);
                break;
        }
        break;
    case 'santri':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objSantri->listSantri();
                break;
            case 'input':
                include 'views/santri/santriInput.php';
                break;
            case 'add':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $santriJenisKelamin = $_POST['santriJenisKelamin'];
                $santriTempatTglLahir = $_POST['santriTempatTglLahir'];
                $santriAlamat = $_POST['santriAlamat'];
                $santriNamaOrtu = $_POST['santriNamaOrtu'];
                $santriNoTelpOrtu = $_POST['santriNoTelpOrtu'];
                $santriGajiOrtu = $_POST['santriGajiOrtu'];

                $objSantri->addSantri($username, $password, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
                break;
            case 'edit':
                $santriId = $_GET['santriId'];

                $objSantri->editById($santriId);
                break;
            case 'update':
                $santriId = $_POST['santriId'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $santriJenisKelamin = $_POST['santriJenisKelamin'];
                $santriTempatTglLahir = $_POST['santriTempatTglLahir'];
                $santriAlamat = $_POST['santriAlamat'];
                $santriNamaOrtu = $_POST['santriNamaOrtu'];
                $santriNoTelpOrtu = $_POST['santriNoTelpOrtu'];
                $santriGajiOrtu = $_POST['santriGajiOrtu'];

                $objSantri->updateSantri($username, $password, $santriId, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
                break;
        }
        break;
    case 'mapel':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objMapel->listMapel();
                break;
            case 'input':
                include 'views/items/mapelInput.php';
                break;
            case 'add':
                $mapelNama = $_POST['mapelNama'];
                $mapelDeskripsi = $_POST['mapelDeskripsi'];

                $objMapel->addMapel($mapelNama, $mapelDeskripsi);
                break;
            case 'edit':
                $mapelId = $_GET['mapelId'];

                $objMapel->editById($mapelId);
                break;
            case 'update':
                $mapelId = $_POST['mapelId'];
                $mapelNama = $_POST['mapelNama'];
                $mapelDeskripsi = $_POST['mapelDeskripsi'];

                $objMapel->updateMapel($mapelId, $mapelNama, $mapelDeskripsi);
                break;
            case 'delete':
                $mapelId = $_POST['mapelId'];

                $objMapel->deleteMapel($mapelId);
                break;
        }
        break;
    case 'nilai':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'input':
                $santris = $obj_santri->getAllSantris();
                $mapels = $obj_mapel->getAllmapels();

                include 'views/items/nilaiInput.php';
                break;

            case 'add':
                $santriId = $_POST['santriId'];
                $mapelId = $_POST['mapelId'];
                $nilais = $_POST['nilai'];

                $detail_nilai_data = [];
                $counter = 1;
                foreach ($mapelId as $key => $mapel_id) {
                    $mapel = $obj_mapel->getMapelById($mapel_id);

                    if ($mapel) {
                        $detailNilaiNode = new DetailNilaiNode($counter++, $mapel, $nilais[$key]);
                        $detail_nilai_data[] = $detailNilaiNode;
                    }
                }


                if (!empty($detail_nilai_data)) {
                    $objNilai->addNilai($santriId, $detail_nilai_data);
                    header("Location: index.php?modul=nilai");
                } else {
                    echo "Detail nilai tidak lengkap!";
                    exit;
                }
                break;


            default:
                $nilaiNodes = $objNilai->getAllNilai();
                // echo "<pre>";
                // print_r($nilaiNodes);
                // echo "</pre>";
                include 'views/items/nilaiList.php';
                break;
        }
        break;
    case 'keuangan':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'input':
                $santris = $obj_santri->getAllSantris();
                include 'views/items/keuanganInput.php';
                break;

            case 'add':

                $santriId = $_POST['santriId'];
                $tanggal = $_POST['tanggal'];
                $nominal = $_POST['nominal'];


                $detailKeuanganData = [];
                $counter = 1;

                $detailKeuanganNode = new DetailKeuanganNode($counter++, $tanggal, $nominal);


                $detailKeuanganData[] = $detailKeuanganNode;



                $tes = $objKeuangan->addKeuangan($santriId, $detailKeuanganData);


                header("Location: index.php?modul=keuangan");
                break;




            default:
                $keuanganNodes = $objKeuangan->getAllKeuangan();

                include 'views/items/keuanganList.php';
        }
        break;


    default:
        if (isset($_SESSION['username_login']) && $_SESSION['username_login']->role->roleId == 3) {
            include 'views/santri/santriDashboard.php';
        } else if (isset($_SESSION['username_login']) && $_SESSION['username_login']->role->roleId == 1) {
            include 'views/role/roleDashboard.php';
        }
        include 'views/items/login.php';
        break;
}

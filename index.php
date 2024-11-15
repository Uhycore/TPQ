<?php
require_once 'controllers/roleController.php';
require_once 'controllers/adminController.php';
require_once 'controllers/santriController.php';
require_once 'controllers/mapelController.php';


require_once 'models/nilaiModel.php';
require_once 'models/keuanganModel.php';

require_once 'models/mapelModel.php';
require_once 'models/santriModel.php';

require_once 'models/guruModel.php';
require_once 'models/adminModel.php';



session_start();


$modul = isset($_GET['modul']) ? $_GET['modul'] : null;

$objRoles = new RoleController();
$objSantri = new SantriController();
$objMapel = new MapelController();
$objAdmin = new AdminController();

$objNilai = new NilaiModel();
$objKeuangan = new KeuanganModel();

$obj_mapel = new MapelModel();
$obj_santri = new SantriModel();

$obj_guru = new GuruModel();
$obj_admin = new AdminModel();



switch ($modul) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $santri = $obj_santri->getSantriByUsername($username);
            $guru = $obj_guru->getGuruByUsername($username);
            $admin = $obj_admin->getAdminByUsername($username);

            if ($santri) {
                if ($santri->password == $password && $santri->role->roleId == 3) {
                    $_SESSION['username_login'] = $santri;
                    header("Location: index.php?modul=null");
                    exit();
                } else {
                    $error = "Password atau role tidak sesuai.";
                }
            } elseif ($guru) {
                if ($guru->password == $password && $guru->role->roleId == 2) {
                    $_SESSION['username_login'] = $guru;
                    header("Location: index.php?modul=null");
                    exit();
                } else {
                    $error = "Password atau role tidak sesuai.";
                }
                $error = "Username tidak ditemukan.";
            } elseif ($admin) {
                if ($admin->password == $password && $admin->role->roleId == 1) {
                    $_SESSION['username_login'] = $admin;
                    header("Location: index.php?modul=null");
                    exit();
                } else {
                    $error = "Password atau role tidak sesuai.";
                }
                $error = "Username tidak ditemukan.";
            } else {
                $error = "Username tidak ditemukan.";
            }

            include 'views/items/login.php';
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
                $objRoles->addRole();
            case 'delete':
                $objRoles->deleteRole();
                break;
            case 'edit':
                $objRoles->editById();
                break;
            case 'update':
                $objRoles->updateRole();
                break;
            default:
                $objRoles->listRoles();
                break;
        }
        break;
    case 'admin':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $objAdmin->listAdmins();
                break;
            case 'input':
                include 'views/admin/adminInput.php';
                break;
            case 'add':
                $objAdmin->addAdmins();
                break;
            case 'delete':
                $objAdmin->deleteAdmins();
                break;
            case 'edit':
                $objAdmin->editById();
                break;
            case 'update':
                $objAdmin->updateAdmins();
                break;
            default:
                $objAdmin->listAdmins();
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

                $objSantri->addSantri($username, $password, 3, $santriJenisKelamin, $santriTempatTglLahir, $santriAlamat, $santriNamaOrtu, $santriNoTelpOrtu, $santriGajiOrtu);
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
    case 'guru':
        $fitur = isset($_GET['fitur']) ? $_GET['fitur'] : null;

        switch ($fitur) {
            case 'list':
                $gurus = $obj_guru->getAllGurus();

                include 'views/guru/guruList.php';
                break;

            case 'input':
                include 'views/guru/guruInput.php';
                break;

            case 'add':
                $username = $_POST['username'];
                $password = $_POST['password'];
                $guruJenisKelamin = $_POST['guruJenisKelamin'];
                $guruTempatTglLahir = $_POST['guruTempatTglLahir'];
                $guruKelas = $_POST['guruKelas'];
                $guruAlamat = $_POST['guruAlamat'];
                $guruNoTelp = $_POST['guruNoTelp'];

                $guruModel->addGuru($username, $password, 2, $guruJenisKelamin, $guruTempatTglLahir, $guruKelas, $guruAlamat, $guruNoTelp);


                header('Location: ?guru=fitur&list');
                break;

            case 'edit':
                $guruId = $_GET['guruId'];

                include 'views/guru/guruEdit.php';
                break;

            case 'update':
                $guruId = $_POST['guruId'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $guruJenisKelamin = $_POST['guruJenisKelamin'];
                $guruTempatTglLahir = $_POST['guruTempatTglLahir'];
                $guruKelas = $_POST['guruKelas'];
                $guruAlamat = $_POST['guruAlamat'];
                $guruNoTelp = $_POST['guruNoTelp'];

                $guruModel->updateGuru($username, $password, $guruId, $guruJenisKelamin, $guruTempatTglLahir, $guruKelas, $guruAlamat, $guruNoTelp);

                header('Location: ?guru=fitur&list');
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
            break;
        } else if (isset($_SESSION['username_login']) && $_SESSION['username_login']->role->roleId == 2) {
            include 'views/role/roleDashboard.php';
            break;
        } else if (isset($_SESSION['username_login']) && $_SESSION['username_login']->role->roleId == 1) {
            include 'views/role/roleDashboard.php';
            break;
        }
        include 'views/items/login.php';
        break;
}

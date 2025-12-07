<?php
class MobilController {
    private $db;
    private $mobil; 
    private $targetDir = "../asset/mobil/";

    public function __construct(){
        $dbase = new Database();
        $this->db = $dbase->getConnection();
        $this->mobil = new Mobil($this->db); 
        
        if (!is_dir($this->targetDir)) {
            mkdir($this->targetDir, 0777, true);
        }
    }

    public function index() {
        $stmt = $this->mobil->readOrders();
        $result = $stmt->get_result();
        $orders = $result->fetch_all(MYSQLI_ASSOC);

        return $orders;
    }

    public function create() {
        include "page/input_mobil.php";
    }

    public function listMobil() {
        $stmt = $this->mobil->readAllMobil();
        if ($stmt) {
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function store() {
        $fileName1 = $_FILES['gambar']['name'];
        $tmpName1  = $_FILES['gambar']['tmp_name'];

        $fileName2 = $_FILES['gambar_detail']['name'];
        $tmpName2  = $_FILES['gambar_detail']['tmp_name'];
        
        $targetFile1 = $this->targetDir . basename($fileName1);
        $targetFile2 = $this->targetDir . basename($fileName2);
        
        if (move_uploaded_file($tmpName1, $targetFile1) && move_uploaded_file($tmpName2, $targetFile2)) {
            $this->mobil->nama_car     = $_POST['nama_car'];
            $this->mobil->harga        = $_POST['harga'];
            $this->mobil->speed        = $_POST['speed'];
            $this->mobil->energy       = $_POST['energy'];
            $this->mobil->seri         = $_POST['seri'];
            $this->mobil->tipe         = $_POST['tipe'];
            $this->mobil->deskripsi    = $_POST['deskripsi'];
            $this->mobil->img_car      = $fileName1;
            $this->mobil->img_car_detail = $fileName2;

            if ($this->mobil->store()) {
                header("Location: admin.php?url=add&status=success");
                exit;
            } else {
                header("Location: admin.php?url=add&status=error_db");
                exit;
            }

        } else {
            header("Location: admin.php?url=add&status=error_upload");
            exit;
        }
    }

    public function edit($id) {
        return $this->mobil->readOneMobil($id);
    }

    public function update() {
        $this->mobil->id = $_POST['id'];

        $updateGambar = !empty($_FILES['gambar']['name']);
        $updateGambarDetail = !empty($_FILES['gambar_detail']['name']);

        $old_img_car = $_POST['old_img_car'];
        $old_img_car_detail = $_POST['old_img_car_detail'];

        $this->mobil->img_car = $old_img_car;
        $this->mobil->img_car_detail = $old_img_car_detail;

        if ($updateGambar) {
            $fileName1 = $_FILES['gambar']['name'];
            $tmpName1  = $_FILES['gambar']['tmp_name'];
            $targetFile1 = $this->targetDir . basename($fileName1);
            if (move_uploaded_file($tmpName1, $targetFile1)) {
                $this->mobil->img_car = $fileName1;
                if ($old_img_car && file_exists($this->targetDir . $old_img_car)) {
                    unlink($this->targetDir . $old_img_car);
                }
            } else {
                header("Location: admin.php?url=listMobil&status=error_upload");
                exit;
            }
        }

        if ($updateGambarDetail) {
            $fileName2 = $_FILES['gambar_detail']['name'];
            $tmpName2  = $_FILES['gambar_detail']['tmp_name'];
            $targetFile2 = $this->targetDir . basename($fileName2);
            if (move_uploaded_file($tmpName2, $targetFile2)) {
                $this->mobil->img_car_detail = $fileName2;
                 if ($old_img_car_detail && file_exists($this->targetDir . $old_img_car_detail)) {
                    unlink($this->targetDir . $old_img_car_detail);
                }
            } else {
                header("Location: admin.php?url=listMobil&status=error_upload");
                exit;
            }
        }

        $this->mobil->nama_car     = $_POST['nama_car'];
        $this->mobil->harga        = $_POST['harga'];
        $this->mobil->speed        = $_POST['speed'];
        $this->mobil->energy       = $_POST['energy'];
        $this->mobil->seri         = $_POST['seri'];
        $this->mobil->tipe         = $_POST['tipe'];
        $this->mobil->deskripsi    = $_POST['deskripsi'];

        if ($this->mobil->update()) {
            header("Location: admin.php?url=listMobil&status=update_success");
            exit;
        } else {
            header("Location: admin.php?url=editMobil&id=" . $this->mobil->id . "&status=error_db");
            exit;
        }
    }

    public function destroy($id) {
        $mobil_to_delete = $this->mobil->readOneMobil($id);

        if ($this->mobil->delete($id)) {
            if ($mobil_to_delete) {
                if ($mobil_to_delete['img_car'] && file_exists($this->targetDir . $mobil_to_delete['img_car'])) {
                    unlink($this->targetDir . $mobil_to_delete['img_car']);
                }
                if ($mobil_to_delete['img_car_detail'] && file_exists($this->targetDir . $mobil_to_delete['img_car_detail'])) {
                    unlink($this->targetDir . $mobil_to_delete['img_car_detail']);
                }
            }
            header("Location: admin.php?url=listMobil&status=delete_success");
        } else {
            header("Location: admin.php?url=listMobil&status=delete_error");
        }
        exit;
    }
}
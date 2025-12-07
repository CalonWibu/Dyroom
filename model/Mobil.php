<?php
class Mobil{

    private $connection;
    private $table_mobil = "mobil";
    private $table_personal = "personal";

    public $id;
    public $nama_car;
    public $harga;
    public $speed;
    public $energy;
    public $seri;
    public $tipe;
    public $img_car;
    public $img_car_detail;
    public $deskripsi; 

    public function __construct($db){
        $this->connection = $db;
    }

    public function store(){
        try{
            $query = "INSERT INTO ".$this->table_mobil." (nama_car, harga, speed, energy, seri, tipe, img_car, img_car_detail, deskripsi) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($query);

            $this->nama_car = htmlspecialchars(strip_tags($this->nama_car));
            $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));

            $stmt->bind_param("sisssssss", 
                $this->nama_car, 
                $this->harga, 
                $this->speed, 
                $this->energy, 
                $this->seri, 
                $this->tipe, 
                $this->img_car, 
                $this->img_car_detail, 
                $this->deskripsi
            );

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
        catch (\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function readOrders(){
        try {
            $query = "SELECT c.*, u.nama, u.email, m.nama_car, m.harga, m.seri 
                      FROM ".$this->table_personal." c 
                      JOIN users u ON c.id_pembeli = u.id
                      JOIN mobil m ON c.id_mobil = m.id
                      ORDER BY c.id_pembeli DESC"; 

            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            
            return $stmt;
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function readAllMobil(){
        try {
            $query = "SELECT * FROM " . $this->table_mobil . " ORDER BY id DESC";
            $stmt = $this->connection->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        catch(\Exception $e){
            echo $e->getMessage();
            return null;
        }
    }

    public function readOneMobil($id){
        try {
            $query = "SELECT * FROM " . $this->table_mobil . " WHERE id = ? LIMIT 1";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }
        catch(\Exception $e){
            error_log($e->getMessage());
            return null;
        }
    }

    public function update(){
        try{
            $query = "UPDATE " . $this->table_mobil . " SET 
                        nama_car = ?, 
                        harga = ?, 
                        speed = ?, 
                        energy = ?, 
                        seri = ?, 
                        tipe = ?, 
                        img_car = ?, 
                        img_car_detail = ?, 
                        deskripsi = ?
                      WHERE id = ?";
            
            $stmt = $this->connection->prepare($query);

            $this->nama_car = htmlspecialchars(strip_tags($this->nama_car));
            $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));

            $stmt->bind_param("sisssssssi", 
                $this->nama_car, 
                $this->harga, 
                $this->speed, 
                $this->energy, 
                $this->seri, 
                $this->tipe, 
                $this->img_car, 
                $this->img_car_detail, 
                $this->deskripsi,
                $this->id
            );

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
        catch (\Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }

    public function delete($id){
        try{
            $query = "DELETE FROM " . $this->table_mobil . " WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
        catch (\Exception $e){
            error_log($e->getMessage());
            return false;
        }
    }
}
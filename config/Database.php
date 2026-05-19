<?php
class Database{
    private $connection;

    public function getConnection(){
        $this->connection = null;
        try{
            // mysqli(namaserver, username_database, password_database, nama_database)
            $this->connection = new mysqli("localhost", "ojokerro_Lautan", "Lautan1234567", "ojokerro_lautanlembardb");

            if($this->connection->connect_error){
                throw new Exception($this->connection->connect_error);
            }

            $this->connection->set_charset("utf8");
            return $this->connection;
        }catch(Exception $e){
            echo 'Connection failed : '.$e->getMessage();
        }
    }
}
<?php
class Database{
    private $connection;

    public function getConnection(){
        $this->connection = null;
        try{
            // mysqli(namaserver, username_database, password_database, nama_database)
            $this->connection = new mysqli("127.0.0.1", "ojokerro_lautan", "Lautan321~", "ojokerro_lautandb");

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
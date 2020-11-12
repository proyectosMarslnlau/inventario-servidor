<?php
    require_once ('../../config/database.php');

    class crud{
        function __construct(){}

        public static function consultar($valor){
            $consulta = "SELECT * FROM $valor";
            try {
                $sql = Database::getInstance()->getDb()->prepare($consulta);
                $sql->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
?>
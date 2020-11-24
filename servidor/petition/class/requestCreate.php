<?php
    require_once ('../../../config/database.php');

    class petitionCreate{
        function __construct(){}

        public static function inscribirObjeto($code, $cifra, $nombre, $lugar, $costo, $anio, $estado, $imagen, $qr, $descripcion){
            $consulta = "INSERT INTO datos(code, cifra, nombre, lugar, costo, anio, estado, imagen, qr, descripcion) VALUES(?, ?, ?, ?, ? ,? ,? ,?, ?, ?)";
            try {
                $sql = Database::getInstance()->getDb()->prepare($consulta);
                $sql->execute([$code, $cifra, $nombre, $lugar, $costo, $anio, $estado, $imagen, $qr, $descripcion]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
        //--------------------------------------------------
        public static function inscribirUsuario($iduser, $materia, $sigla, $idsigla){
            $consulta = "INSERT INTO inscritos(iduser, materia, sigla, idsigla) VALUES(?, ?, ?, ?)";
            try {
                $sql = Database::getInstance()->getDb()->prepare($consulta);
                $sql->execute([$iduser, $materia, $sigla, $idsigla]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
?>
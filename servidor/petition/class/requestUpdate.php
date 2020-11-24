<?php
    require_once ('../../../config/database.php');

    class petitionUpdate{
        function __construct(){}

        public static function editarObjeto($code, $cifra, $nombre, $lugar, $costo, $anio, $estado, $imagen, $qr, $descripcion, $iddatos){
            $consulta = "UPDATE datos SET code=?, cifra=?, nombre=?, lugar=?, costo=?, anio=?, estado=?, imagen=?, qr=?, descripcion=? WHERE  iddatos=?";
            try {
                $sql = Database::getInstance()->getDb()->prepare($consulta);
                $sql->execute([$code, $cifra, $nombre, $lugar, $costo, $anio, $estado, $imagen, $qr, $descripcion ,$iddatos]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
        //
        public static function editarObjetoSinImagen($code, $cifra, $nombre, $lugar, $costo, $anio, $estado, $qr, $descripcion, $iddatos){
            $consulta = "UPDATE datos SET code=?, cifra=?, nombre=?, lugar=?, costo=?, anio=?, estado=?, qr=?, descripcion=? WHERE  iddatos=?";
            try {
                $sql = Database::getInstance()->getDb()->prepare($consulta);
                $sql->execute([$code, $cifra, $nombre, $lugar, $costo, $anio, $estado, $qr, $descripcion ,$iddatos]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
?>
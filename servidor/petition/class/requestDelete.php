<?php
    require_once ('../../config/database.php');

    class petitionDelete{
        function __construct(){}

        public static function borrarMateria($idUsuario, $sigla){
            $consulta = "DELETE FROM inscritos WHERE iduser=? AND sigla=?";
            try {
                $sql = Database::getInstance()->getDb()->prepare($consulta);
                $sql->execute([$idUsuario, $sigla]);
                return $sql;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
?>
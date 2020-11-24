<?php
    require_once ('../../../config/database.php');

    class petitionDelete{
        function __construct(){}

        public static function borrarObjeto($iddatos){
            $consulta = "DELETE FROM datos WHERE iddatos=?";
            try {
                $sql = Database::getInstance()->getDb()->prepare($consulta);
                $sql->execute([$iddatos]);
                return true;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
?>
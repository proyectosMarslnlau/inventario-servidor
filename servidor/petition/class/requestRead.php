<?php
require_once('../../../config/database.php');

class petitionRead
{
    function __construct()
    {
    }
    //Consulta de USUARIO Y PASSWORD **************************
    public static function consultarUsuario($user, $pass)
    {
        $consulta = "SELECT * FROM login WHERE user=? AND pass=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$user, $pass]);
            $cont = $sql->rowCount();
            if ($cont == 1) {
                $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            } elseif ($cont == 0) {
                $respuesta = false;
            } else {
                $respuesta = false;
            }
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }

    //Consulta de REPETICION DE CODGO REPETIDO ************************
    public static function consultarRepeticion($code, $cifra)
    {
        $consulta = "SELECT * FROM datos WHERE code=? AND cifra=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$code, $cifra]);
            $cont = $sql->rowCount();
            if ($cont < 1) {
                $respuesta = true;
            } else {
                $respuesta = false;
            }
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }
    //Consulta de REPETICION DE CODGO REPETIDO  para el ID
    public static function consultarRepeticionId($iddatos)
    {
        $consulta = "SELECT * FROM datos WHERE iddatos=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$iddatos]);
            $cont = $sql->rowCount();
            if ($cont < 1) {
                $respuesta = true;
            } else {
                $respuesta = false;
            }
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }
    //Consulta todos los datos **********************************
    public static function consultarTodoObjetos()
    {
        $consulta = "SELECT * FROM datos";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute();
            $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }
    //Consulta UNICO los datos ****************
    public static function consultarUnicoObjeto($code, $cifra)
    {
        $consulta = "SELECT * FROM datos WHERE code=? AND cifra=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$code, $cifra]);
            $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }
    //Consulta UNICO los datos ****************
    public static function consultarUnicoCode($code)
    {
        $consulta = "SELECT * FROM datos WHERE code=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$code]);
            $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }
    //Consulta UNICO los datos
    public static function consultarUnicoObjetoId($iddatos)
    {
        $consulta = "SELECT * FROM datos WHERE iddatos=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$iddatos]);
            $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }
    //-*******************************************************
    public static function consultarTodo($valor)
    {
        $consulta = "SELECT * FROM $valor";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function consultarMateriaDuplicada($idUsuario, $sigla)
    {
        $consulta = "SELECT * FROM inscritos WHERE iduser=? AND sigla=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$idUsuario, $sigla]);
            $cont = $sql->rowCount();
            return $cont;
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function consultarMateriaInformacion($idUsuario)
    {
        $consulta = "SELECT * FROM inscritos WHERE iduser=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$idUsuario]);
            $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function consultarMaterialInformacion($tabla, $sigla)
    {
        $consulta = "SELECT * FROM $tabla WHERE sigla=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$sigla]);
            $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function consultarInformacion($semestre)
    {
        $consulta = "SELECT * FROM informacion WHERE semestre=?";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute([$semestre]);
            $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }

    public static function consultarNoticias()
    {
        $consulta = "SELECT * FROM noticias";
        try {
            $sql = Database::getInstance()->getDb()->prepare($consulta);
            $sql->execute();
            $respuesta = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $respuesta;
        } catch (PDOException $e) {
            return false;
        }
    }
}

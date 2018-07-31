<?php

class Conecta extends PDO
{
    private $tipo_de_base = 'mysql';
    private $host         = 'localhost';
    private $dbname       = 'cordelima';
    private $usuario      = 'root';
    private $contrasena   = '';

    function __construct()
    {
        $this->mConexion();
    }

    public function mConexion()
    {
        try {
            $this->cn = new PDO($this->tipo_de_base.':host='.$this->host.';dbname='.$this->dbname,
                $this->usuario, $this->contrasena);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function total_pagina()
    {
        $rows = $this->sql_fetch_assoc($this->sql_query('SELECT FOUND_ROWS() AS rows'));
        return $rows['rows'];
    }

    public function sql_lista_tablas()
    {
        $sql    = "SHOW TABLES FROM ".$this->dbname;
        $data   = array();
        $result = $this->sql_query($sql);
        foreach ($result as $row) {
            $data[] = $row[0];
        }
        return $data;
    }

    public function sql_lista_campo($tabla)
    {
        $db     = $this->cn->query("DESCRIBE ".$tabla);
        $result = $db->fetchAll();
        return $result;
    }

    public function sql_num_rows($rs)
    {
        return $rs->rowCount();
    }

    public function sql_query($sql)
    {
        try {
            $rs = $this->cn->query($sql);
            if (!$rs) {
                print_r($this->cn->errorInfo());
                exit();
            }
            return $rs;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function sql_execute($sql)
    {
        $rs = $this->cn->exec($sql);
        return $rs;
    }

    public function sql_fetch_assoc($rs)
    {
        return $rs->fetch(PDO::FETCH_ASSOC);
    }

    public function ArrayLista($sql)
    {
        $data = array();
        $rs   = $this->sql_query($sql);
        if ($rs) {
            while ($row = $this->sql_fetch_assoc($rs)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function sql_fecha($fecha)
    {
        $fechaAct = "null";
        if (strlen($fecha) > 0) {
            if ($fecha != "0000-00-00") {
                $fechaFormat = explode("/", $fecha);
                $fechaAct    = "'".$fechaFormat[2]."-".$fechaFormat[1]."-".$fechaFormat[0]."'";
            }
        }
        return $fechaAct;
    }

    public function cerrarCN()
    {
        if (!$this->cn) {
            $this->cn = null;
        }
    }
}
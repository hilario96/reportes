<?php
class AdminModel extends Mysql{
    public function __construct()
    {
        parent::__construct();
    }
    public function selectStockM()
    {
        $sql = "SELECT nombre, cantidad FROM insumos WHERE cantidad <= 10 ORDER BY cantidad ASC LIMIT 10";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectinsumos()
    {
        $sql = "SELECT insumo, cantidad, SUM(cantidad) as total FROM detalle_documentacion group by id_producto ORDER BY cantidad DESC LIMIT 10";
        $res = $this->select_all($sql);
        return $res;
    }
    public function Insumos()
    {
        $sql = "SELECT COUNT(*) FROM Insumos WHERE estado = 1";
        $res = $this->selecT($sql);
        return $res;
    }
    public function Promotores()
    {
        $sql = "SELECT COUNT(*) FROM Promotores WHERE estado = 1";
        $res = $this->selecT($sql);
        return $res;
    }
    public function usuarios()
    {
        $sql = "SELECT COUNT(*) FROM Usuarios WHERE estado = 1";
        $res = $this->selecT($sql);
        return $res;
    }
    public function Documentacion()
    {
        $sql = "SELECT COUNT(*) FROM Documentacion WHERE fecha > CURDATE();";
        $res = $this->selecT($sql);
        return $res;
    }
  
    public function Reportes()
    {
        $sql = "SELECT COUNT(*) FROM Reportes WHERE fecha > CURDATE();";
        $res = $this->selecT($sql);
        return $res;
    }
}

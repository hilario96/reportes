<?php
class InsumosModel extends Mysql{
    public $id, $clave_promotor, $codigo, $objeto, $cantidad, $fecha, $condicion;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectInsumos()
    {
        $sql = "SELECT * FROM Insumos WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectInsumosInactivos()
    {
        $sql = "SELECT * FROM Insumos WHERE estado = 0";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarInsumos(string $clave_promotor, String $codigo, string $objeto, string $cantidad, string $fecha, string $condicion)
    {
        $return = "";
        $this->clave_promotor = $clave_promotor;
        $this->codigo = $codigo;
        $this->objeto = $objeto;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
        $this->condicion = $condicion;
        $sql = "SELECT * FROM Insumos WHERE codigo = '{$this->codigo}'";
        $result = $this->select_all($sql);
        if (empty($result)) {
            $query = "INSERT INTO Insumos(clave_promotor, codigo, objeto, cantidad, fecha, condicion) VALUES (?,?,?,?,?,?)";
            $data = array($this->clave_promotor, $this->codigo, $this->objeto, $this->cantidad, $this->fecha, $this->condicion);
            $resul = $this->insert($query, $data);
            $return = $resul;
        }else {
            $return = "existe";
        }
        return $return;
    }
    public function editarInsumos(int $id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM Insumos WHERE id = '{$this->id}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarinsumos(String $clave_promotor, String $codigo, string $objeto, string $cantidad, string $fecha, string $condicion, int $id)
    {
        $return = "";
        $this->clave_promotor = $clave_promotor;
        $this->codigo = $codigo;
        $this->objeto = $objeto;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
        $this->condicion = $condicion;
        $this->id = $id;
        $query = "UPDATE Insumos SET clave_promotor=?, codigo=?, objeto=?, cantidad=?, fecha=?, condicion=? WHERE id=?";
        $data = array($this->clave_promotor, $this->codigo, $this->objeto, $this->cantidad, $this->fecha, $this->condicion, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarInsumos(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE Insumos SET estado = 0 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function reingresarInsumos(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE Insumos SET estado = 1 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
?>
<?php
class PromotoresModel extends Mysql{
    public $id, $clave_promotor, $nombre, $direccion, $telefono;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectpromotores()
    {
        $sql = "SELECT * FROM Promotores WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectPromotoresInactivos()
    {
        $sql = "SELECT * FROM Promotores WHERE estado = 0";
        $res = $this->select_all($sql);
        return $res;
    }
    public function BuscarPromotores(string $clave_promotor)
    {
        $this->clave_promotor = $clave_promotor;
        $sql = "SELECT * FROM Promotores WHERE clave = $this->clave_promotor AND estado = 1";
        $res = $this->select($sql);
        return $res;
    }
    public function insertarPromotores(String $clave_promotor, string $nombre, string $direccion, string $telefono)
    {
        $return = "";
        $this->clave_promotor = $clave_promotor;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $sql = "SELECT * FROM Promotores WHERE clave_promotor = '{$this->clave_promotor}'";
        $result = $this->select_all($sql);
        if (empty($result)) {
            $query = "INSERT INTO Promotores(clave_promotor, nombre, direccion, telefono) VALUES (?,?,?,?)";
            $data = array($this->clave_promotor, $this->nombre, $this->direccion, $this->telefono);
            $resul = $this->insert($query, $data);
            $return = $resul;
        }else {
            $return = "existe";
        }
        return $return;
    }
    public function editarPromotores(int $id)
    {
        $this->id = $id;
        $sql = "SELECT * FROM promotores WHERE id = '{$this->id}'";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarPromotores(String $clave_promotor, string $nombre, string $direccion, string $telefono, int $id)
    {
        $return = "";
        $this->clave_promotor = $clave_promotor;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->id = $id;
        $query = "UPDATE Promotores SET clave_promotor=?, nombre=?, direccion=?, telefono=? WHERE id=?";
        $data = array($this->clave_promotor, $this->nombre, $this->direccion, $this->telefono, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminarPromotores(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE Promotores SET estado = 0 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function reingresarpromotores(int $id)
    {
        $return = "";
        $this->id = $id;
        $query = "UPDATE promotores SET estado = 1 WHERE id=?";
        $data = array($this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
?>
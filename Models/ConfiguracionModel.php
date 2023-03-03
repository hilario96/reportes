<?php
class ConfiguracionModel extends Mysql{
    public $id, $clav, $nombre, $telefono, $direccion, $razon;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectConfiguracion()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarConfiguracion(String $clav, string $nombre, string $telefono, string $direccion, string $razon ,int $id)
    {
        $return = "";
        $this->clav = $clav;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->id = $id;
        $query = "UPDATE configuracion SET clav=?, nombre=?, telefono=?, direccion=?, razon=? WHERE id=?";
        $data = array($this->clav, $this->nombre, $this->telefono, $this->direccion, $this->razon ,$this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
}
?>
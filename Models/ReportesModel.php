<?php
class ReportesModel extends Mysql{
    public $id, $promotor,$clave_promotor, $codigo, $id_reporte, $objeto, $id_objeto, $cantidad, $condicion, $fecha, $estado, $total;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectreportes()
    {
        $sql = "SELECT * FROM reportes WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectDetalle()
    {
        $sql = "SELECT * FROM detalle_temp WHERE clave_promotor = $_SESSION[id]";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarDetalle(String $clave_promotor,String $codigo, string $objeto,  string $cantidad, string $condicion, string $fecha, string $estado)
    {
        $return = "";
        $this->clave_promotor = $clave_promotor;
        $this->codigo = $codigo;
        $this->objeto = $objeto;
        $this->cantidad = $cantidad;
        $this->condicion = $condicion;
        $this->fecha = $fecha;
        $this->estado = $estado;
            $query = "INSERT INTO detalle_temp(clave_promotor, codigo, objeto, cantidad, condicion, fecha, estado) VALUES (?,?,?,?,?,?,?)";
            $data = array($this->clave_promotor, $this->codigo, $this->objeto, $this->cantidad, $this->condicion, $this->fecha, $this->estado);
            $resul = $this->insert($query, $data);
            $return = $resul;
        return $return;
    }
    public function buscarObjeto(int $codigo)
    {
        $this->codigo = $codigo;
        $sql = "SELECT * FROM insumos WHERE codigo = '{$this->codigo}' AND estado = 1";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizarReportes(String $clave_promotor, string $objeto, string $codigo, string $cantidad, string $condicion, string $fecha, string $estado, int $id)
    {
        $return = "";
        $this->clave_promotor = $clave_promotor;
        $this->objeto = $objeto;
        $this->codigo = $codigo;
        $this->cantidad = $cantidad;
        $this->condicion = $condicion;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->id = $id;
        $query = "UPDATE reportes SET clave_promotor=? objeto=? codigo=?, cantidad=?, condicion=?, fecha=? estado=? WHERE id=?";
        $data = array($this->clave_promotor, $this->objeto, $this->codigo, $this->cantidad, $this->condicion, $this->fecha, $this->estado, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function buscarObjetoexiste($id_objeto, $clave_promotor)
    {
        $query = "SELECT * FROM detalle_temp WHERE clave_promotor = '{$clave_promotor}' AND id_objeto = '{$id_objeto}'";
        $resul = $this->select($query);
        return $resul;
    }
    public function actualizarCantidad(int $cantidad,String $total, int $id)
    {
        $this->cantidad = $cantidad;
        $this->total = $total;
        $this->id = $id;
        $query = "UPDATE detalle_temp SET cantidad =?, total =? WHERE id =?";
        $data = array($this->cantidad, $this->total ,$this->id);
        $resul = $this->update($query, $data);
        return $resul;
    }
    public function verificarObjetos($clave_promotor)
    {
        $query = "SELECT * FROM detalle_temp WHERE clave_promotor = '{$clave_promotor}'";
        $resul = $this->select_all($query);
        return $resul;
    }
    public function stockActual($id_objeto)
    {
        $query = "SELECT cantidad FROM insumos WHERE id = '{$id_objeto}'";
        $resul = $this->select($query);
        return $resul;
    }
    public function buscaridR()
    {
        $sql = "SELECT MAX(id) from reportes";
        $res = $this->select($sql);
        return $res;
    }
    public function registrarReporte(String $total)
    {
        $return = "";
        $this->total = $total;
        $query = "INSERT INTO reportes(total) VALUES (?)";
        $data = array($this->total);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }


    public function registrar(String $id, string $clave_promotor, string $codigo, string $objeto, string $cantidad, string $fecha, string $condicion, string $estado)
    {
        $return = "";
        $this->id = $id;
        $this->objeto = $objeto;
        $this->cantidad = $cantidad;
        $this->clave_promotor = $clave_promotor;
        

        $query = "INSERT INTO insumos (id, clave_promotor, codigo, objeto, fecha, condicion, estado) VALUES (?,?,?,?,?,?,?)";
        $data = array($this->id, $this->clave_promotor, $this->codigo, $this->objeto, $this->cantidad, $this->fecha, $this->condicion, $this->estado);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }
    public function ListarReportes(int $id)
    {
        $sql = "SELECT * FROM insumos WHERE id = '{$id}'";
        $res = $this->select_all($sql);
        return $res;
    }
    public function registrarStock(int $cantidad, int $id)
    {
        $this->cantidad = $cantidad;
        $this->id = $id;
        $query = "UPDATE insumos SET cantidad =? WHERE id =?";
        $data = array($this->cantidad, $this->id);
        $resul = $this->update($query, $data);
        return $resul;
    }
    public function selectConfiguracion()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
    public function VaciarReporte(string $clave_promotor)
    {
        $this->id = $clave_promotor;
        $sql = "DELETE FROM detalle_temp WHERE clave_promotor = $clave_promotor";
        $resul = $this->delete($sql);
    }
}

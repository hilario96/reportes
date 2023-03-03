<?php
class DocumentacionModel extends Mysql{
    public $id, $clave_promotor, $codigo, $objeto, $id_objeto, $cantidad, $condicion, $fecha;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectDocumentacion()
    {
        $sql = "SELECT * FROM documentacion WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function selectDetalle()
    {
        $sql = "SELECT * FROM detalle_temp WHERE clave_promotor = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function insertarDetalle( string $clave_promotor,String $objeto, string $id_objeto, string $codigo, string $cantidad, string $condicion, string $fecha, string $estado)
    {
        $return = "";
        $this->id = $id;
        $this->clave_promotor = $clave_promotor;
        $this->objeto = $objeto;
        $this->id_objeto = $id_objeto;
        $this->codigo = $codigo;
        $this->cantidad = $cantidad;
        $this->condicion = $condicion;
        $this->fecha = $fecha;
        $this->estado = $estado;

            $query = "INSERT INTO detalle_temp(clave_promotor, objeto, codigo, cantidad, condicion, fecha, estado) VALUES (?,?,?,?,?,?,?)";
            $data = array($this->clave_promotor, $this->objeto, $this->id_objeto, $this->cantidad, $this->condicion,$this->fecha, $this->estado,);
            $resul = $this->insert($query, $data);
            $return = $resul;
        return $return;
    }
    public function buscarProducto(int $codigo)
    {
        $this->codigo = $codigo;
        $sql = "SELECT * FROM Insumos WHERE codigo = '{$this->codigo}' AND estado = 1";
        $res = $this->select($sql);
        if (empty($res)) {
            $res = 0;
        }
        return $res;
    }
    public function actualizardocumentacion(String $clave_promotor, String $objeto,  string $codigo, String $cantidad, string $condicion, string $fecha, string $estado)
    {
        $return = "";
        $this->id = $id;
        $this->clave_promotor = $clave_promotor;
        $this->objeto = $objeto;
        $this->codigo = $codigo;
        $this->cantidad = $cantidad;
        $this->condicion = $condicion;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $query = "UPDATE documentacion SET clave_promotor=? objeto=? codigo=; cantiad=?, condicion=?, fecha=?, estado=? WHERE id=?";
        $data = array($this->id_promotor, $this->objeto, $this->codigo, $this->cantidad, $this->condicion, $this->fecha, $this->estado, $this->id);
        $resul = $this->update($query, $data);
        $return = $resul;
        return $return;
    }
    public function eliminardocumentacion(int $id)
    {
        $this->id = $id;
        $sql = "DELETE FROM detalle_temp WHERE id = $id";
        $resul = $this->delete($sql);
    }
    public function buscarobjetoexiste($id_objeto, $clave_promotor)
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
    public function verificarinsumos($clave_promotor)
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
        $sql = "SELECT MAX(id) from documentacion";
        $res = $this->select($sql);
        return $res;
    }
    public function registrarReporte(int $promotor, String $total)
    {
        $return = "";
        $this->clave_promotor = $clave_promotor;
        $this->total = $total;
        $query = "INSERT INTO documentacion(clave_promotor, total) VALUES (?,?)";
        $data = array($this->clave_promotor, $this->total);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }


    public function registrarDetalle(string $clave_promotor, string $objeto, string $codigo, string $cantidad, string $condicion, string $fecha, string $estado)
    {
        $return = "";
        $this->clave_promotor = $clave_promotor;
        $this->objeto = $objeto;
        $this->codigo = $codigo;
        $this->cantidad = $cantidad;
        $this->condicion = $condicion;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $query = "INSERT INTO detalle_documentacion(clave_promotor,codigo, objeto, cantidad, condicion, fecha, estado) VALUES (?,?,?,?,?,?,?,?)";
        $data = array($this->clave_promotor, $this->objeto, $this->codigo, $this->cantidad, $this->condicion, $this->fecha);
        $resul = $this->insert($query, $data);
        $return = $resul;
        return $return;
    }
    public function ListarDocumentacion(int $id)
    {
        $sql = "SELECT * FROM detalle_documentacion WHERE id = $id";
        $res = $this->select_all($sql);
        return $res;
    }
    public function Pdfclave_promotor(int $clave_promotor)
    {
        $sql = "SELECT * FROM promotores WHERE id = $clave_promotor";
        $res = $this->select($sql);
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
    public function selectPromotores()
    {
        $sql = "SELECT * FROM promotores WHERE estado = 1";
        $res = $this->select_all($sql);
        return $res;
    }
    public function VaciarDocumentacion(string $clave_promotor)
    {
        $this->id = $clave_promotor;
        $sql = "DELETE FROM detalle_temp WHERE clave_promotor = $clave_promotor";
        $resul = $this->delete($sql);
    }
    public function VerDocumentacion(string $clave_promotor)
    {
        $this->id = $clave_promotor;
        $sql = "SELECT * FROM reportes WHERE clave_promotor = $clave_promotor";
        $resul = $this->delete($sql);
    }
}

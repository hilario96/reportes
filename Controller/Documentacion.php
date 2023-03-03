<?php
    class Documentacion extends Controllers{
        protected $totalPagar, $tot = 0;
        public function __construct()
        {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url());
        }
            parent::__construct();

        }
        public function Listar()
        {        
            $this->views->getView($this, "Listar");
        }
        public function listardocumentacion()
        {
            $data = $this->model->selectDocumentacion();
            $this->views->getView($this, "Listardocumentacion", $data, "");
        }
        public function ingresar()
        {
            $id = $_POST['id'];

            $objeto = $_POST['objeto'];
            
            $codigo = $_post['codigo'];
            $cantidad = $_post['cantidad'];
            $condicion = $_post['condicion'];
            $fecha = $_post['fecha'];
            $estado = $_post['estado'];
            $total = $cantidad;
            $clave_promotor = $_SESSION['id'];
            $existe = $this->model->buscarInsumoexiste($id, $clave_promotor);
            if ($existe) {
                $idP = $existe['id'];
                $cant = $existe['cantidad'];
                $cantidad = $_POST['cantidad'] + $cant;
                $total = $existe[''] * $cantidad;
                $this->model->actualizarCantidad($cantidad,$total ,$idP);
                echo "1";
            }else{
                $insert = $this->model->insertarDetalle($objeto, $codigo, $condicion, $fecha, $estado);
                if ($insert > 0) {
                $this->Listar();
                }else{
                echo "error";
                }
            }
            header("location: " . base_url() . "documentacion/Listar?msg=$alert");
        die();
        }
        public function documentacion()
        {
            $data = $this->model->selectDetalle();
            foreach ($data as $documentacion) {
            $this->totalPagar = $this->totalPagar + $documentacion['total']; 
            echo "<tr>
                <td>".$documentacion['id']."</td>
                <td>".$documentacion['objeto']."</td>
                <td class='verificarCantidad'>" . $documentacion['cantidad'] . "</td>
                
                <td>" . $documentacion['objeto'] . "</td>
                
                <td>" . $documentacion['codigo'] . "</td>
                <td>" . $documentacion['condicion'] . "</td>
                <td>" . $documentacion['fecha'] . "</td>
                <td>" . $documentacion['estado'] . "</td>
                <td>
                <button typu='button' class='btn btn-danger' onclick='EliminarDetalle(" . $documentacion['id'] . ");'>Eliminar</button>
                </td>
            </tr>";
            
            }
            $tot = number_format($this->totalPagar, 2, ".", ",");

            echo "<input type='hidden' id='totalPagar' value='" . $tot. "'/>";
            header('location: ' . base_url() . 'documentacion/Listar');
        die();
        }
    
    public function eliminar()
    {
        
        $id = $_POST['id'];
        $this->model->eliminarDocumentacion($id);
         header('location: ' . base_url() . 'documentacion/Listar');
        die();
    }
    public function buscarobjeto()
    {
        $codigo = $_POST['codigo'];
        $data = $this->model->buscarObjeto($codigo);
        echo json_encode($data);
        header('location: ' . base_url() . 'documentacion/Listar');
        die();
    }
    public function registarDocumentacion()
    {
        $data = $this->model->buscaridR();
        $result = $data['MAX(id)'];
        if ($result == null) {
            $id_documentacion = 1;
        }else{
            $id_documentacion = $result;
        }
        header('location: ' . base_url() . 'documentacion/Listar');
        die();
    }
    public function registrar()
    {
        $nombre = $_POST['nombre'];
        $totalO = $_POST['totalO'];
        if ($nombre == 0 || $promotor == "") {
            # code...
            $this->model->registrarReporte(1, $totalO);
        }else{
            $this->model->registrarReporte($nombre, $totalO);
        }
        $data = $this->model->buscaridR();
        $result = $data['MAX(id)'];
        $insumos = $this->model->verificarInsumos($_SESSION['id']);
        foreach ($insumos as $data) {
            $stock = $this->model->stockActual($data['objeto']);
            $stockActual = $stock['cantidad'];
            $insertar = $this->model->registrarDetalle($result, $data['nombre'], $data['objeto'], $data ['codigo'], $data['cantidad'], $data['condicion'], $data['fecha'], $data['estado']);
            $this->model->registrarStock($stockActual - $data['cantidad'], $data['objeto']);
        }
        $this->model->VaciarReportes($_SESSION['id']);
        die();
        header('location: ' . base_url() . 'Documentacion/Listar');
        die();
    }
    public function verDocumentacion()
    {
        $config = $this->model->selectConfiguracion();
        $id = $_GET['id'];
        $clave_promotor = $_GET['clave_promotor'];
        $data = $this->model->ListarDocumentacion($id);
        $clave_promotor = $this->model->Pdfclave_promotor($clave_promotor);
        $this->views->getView($this, "VerDocumentacion", $data ,"",$config, $clave_promotor);
        header('location: ' . base_url() . 'Documentacion/Listar');
        die();
    }
    public function buscarclave_promotor()
    {
        $return = array();
        $data = $this->model->selectPromotores();
        if (!empty($data)) {
            foreach ($data as $promotores) {
                $res['id'] = $promotores['id'];
                $res['value'] = $promotores['objeto'];
                array_push($return, $res);
            }
        }
        echo json_encode($return);
        header('location: ' . base_url() . 'documentacion/Listar');
        die();
    }
    
}

<?php
    class Reportes extends Controllers{
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
        public function lista()
        {
            $data = $this->model->selectReportes();
            $this->views->getView($this, "ListarReportes", $data, "");
        }
        public function ingresar()
        {
            $id = $_POST['id'];
            $clave_promotor = $_POST['clave_promotor'];
            $objeto = $_POST['objeto'];
            $codigo = $_POST['codigo'];
            $cantidad = $_POST['cantidad'];
            $condicion = $_POST['condicion'];
            $total = $cantidad * $precio;
            $clave_promomotor = $_SESSION['id'];
            $existe = $this->model->buscarObjetoexiste($id, $clave_promotor);
            if ($existe) {
                $idi = $existe['id'];
                $cant = $existe['cantidad'];
                $cantidad = $_POST['cantidad'] + $cant;
                $total = $existe['precio'] * $cantidad;
                $this->model->actualizarCantidad($cantidad,$total ,$idi);
                echo "1";
            }else{
                $insert = $this->model->insertarDetalle($id,$clave_promotor, $objeto, $codigo, $cantidad,$condicion,$fecha,$estado);
                if ($insert > 0) {
                $this->Listar();
                }else{
                echo "error";
                }
            }
        }
        public function selectReportes()
        {
            $data = $this->model->selectReportes();
            foreach ($data as $reportes) {
                      echo "<tr>
                <td>".$reportes['id']."</td>
                <td>".$reportes['clave_promotor']."</td>
                <td>".$reportes['objeto']."</td>
                <td>".$reportes['codigo']."</td>
                <td>".$reportes['cantidad'] ."</td>
                <td>".$reportes['condicion'] ."</td>
                <td>".$reportes['fecha']."</td>               
                <td>
                <button type='button' data-id='" . $reportes['id'] . "' class='btn btn-danger eliminar'>Eliminar</button>
                </td>
            </tr>";
            
            }
            $tot = number_format($this->totalPagar, 2, ".", ",");

            echo "<input type='hidden' id='totalPagar' value='" . $tot. "'/>";
        }
    public function buscar()
    {
        $codigo = $_POST['codigo'];
        $data = $this->model->buscarProducto($codigo);
        echo json_encode($data);
    }
    public function registarDocumetcion()
    {
        $data = $this->model->buscaridR();
        $result = $data['MAX(id)'];
        if ($result == null) {
            $id_reporte = 1;
        }else{
            $id_reporte = $result;
        }
        
    }
    public function registrarReporte()
    {
        $totalI = $_POST['totalI'];
        $this->model->registrarReporte($totalI);
        $data = $this->model->buscaridR();
         $result = $data['MAX(id)'];
        $insumos = $this->model->verificarObjetos($_SESSION['id']);
        foreach ($Insumos as $data) {
            $stock = $this->model->stockActual($data['id_objeto']);
            $stockActual = $stock['cantidad'];
            $insertar = $this->model->registrarDetalleReportes($result, $data['id'], $data['id_reportes'], $data['objeto'], $data['id_objeto'], $data['cantidad'], $data['condicion'], $data['promotor'], $data['clave_promotor'], $data['fecha'], $data['estado']);
            $this->model->registrarStock($stockActual + $data['cantidad'], $data['id_objeto']);
        }
        $this->model->VaciarReporte($_SESSION['id']);
        die();
    }
    public function ver()
    {
        $alert = $this->model->selectConfiguracion();
        $id = $_GET['id'];
        $data = $this->model->ListarReportes($id);
        $this->views->getView($this, "VerReportes", $data, $alert);
        

    }
    public function anular()
    {
        $this->model->VaciarReporte($_SESSION['id']);
    }
}

<?php
class Insumos extends Controllers
{
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
        $data = $this->model->selectInsumos();
        $this->views->getView($this, "Listar", $data, "");
    }
    public function eliminados()
    {
        $data = $this->model->selectInsumosInactivos();
        $this->views->getView($this, "Eliminados", $data, "");
    }
    public function insertar()
    {
        $clave_promotor = $_POST['clave_promotor'];
        $codigo = $_POST['codigo'];
        $objeto = $_POST['objeto'];
        $cantidad = $_POST['cantidad'];
        $fecha = $_POST['fecha'];
        $condicion = $_POST['condicion'];
        $insert = $this->model->insertarInsumos($clave_promotor, $codigo, $objeto, $cantidad, $fecha, $condicion);
        if ($insert > 0) {
            $alert = 'registrado';
        } else if ($insert == 'existe') {
            $alert = 'existe';
        } else {
            $alert = 'error';
        }
        $this->model->selectInsumos();
        header("location: " . base_url() . "Insumos/Listar?msg=$alert");
        die();
    }
    public function editar()
    {
        $id = $_GET['id'];
        $data = $this->model->editarInsumos($id);
        if ($data == 0) {
            $this->Listar();
        } else {
            $this->views->getView($this, "Editar", $data);
        }
    }
    public function actualizar()
    {
        $id = $_POST['id'];
        $clave_promotor = $_POST ['clave_promotor']; 
        $codigo = $_POST['codigo'];
        $objeto = $_POST['objeto'];
        $cantidad = $_POST['cantidad'];
        $fecha = $_POST['fecha'];
        $condicion = $_POST['condicion'];
        $actualizar = $this->model->actualizarInsumos($clave_promotor, $codigo, $objeto, $cantidad, $fecha, $condicion, $id);
        if ($actualizar == 1) {
            $alert =  'modificado';
        } else {
            $alert = 'error';
        }
        header("location: " . base_url() . "Insumos/Listar?msg=$alert");
        die();
    }
    public function eliminar()
    {
        $id = $_GET['id'];
        $eliminar = $this->model->eliminarInsumos($id);
        $data = $this->model->selectInsumos();
        header('location: ' . base_url() . 'Insumos/Listar');
        //$this->views->getView($this, "Listar", $data, $eliminar);
        die();
    }
    public function reingresar()
    {
        $id = $_GET['id'];
        $this->model->reingresarInsumos($id);
        $data = $this->model->selectInsumos();
        header('location: ' . base_url() . 'Insumos/Listar');
        //$this->views->getView($this, "Listar", $data);
        die();
    }
}
?>
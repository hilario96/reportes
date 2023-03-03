<?php
    class Promotores extends Controllers{
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
            $data = $this->model->selectPromotores();         
            $this->views->getView($this, "Listar", $data, "");
        }
    public function eliminados()
    {
        $data = $this->model->selectPromotoresInactivos();
        $this->views->getView($this, "Eliminados", $data, "");
    }
        public function insertar()
        {
            $clave_promotor = $_POST['clave_promotor'];
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $insert = $this->model->insertarPromotores($clave_promotor, $nombre, $direccion, $telefono);
            if ($insert > 0) {
            $alert = 'registrado';
            }else if ($insert == 'existe') {
            $alert = 'existe';
            }else{
            $alert =  'error';
            }
            $this->model->selectPromotores();
            header("location: " . base_url() . "Promotores/Listar?msg=$alert");
            die();
        }
        public function editar()
        {
            $id = $_GET['id'];
            $data = $this->model->editarPromotores($id);
            if ($data == 0) {
                $this->Listar();
            }else{
                $this->views->getView($this, "Editar", $data);
            }
        }
    public function actualizar()
    {
        $id = $_POST['id'];
        $clave_promotor = $_POST['clave_promotor'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $actualizar = $this->model->actualizarPromotores($clave_promotor, $nombre, $direccion, $telefono, $id);
        if ($actualizar == 1) {
            $alert = 'modificado';
        }else {
            $alert = 'error';
        }
        header("location: " . base_url() . "Promotores/Listar?msg=$alert");
        die();
    }
    public function eliminar()
    {
        $id = $_GET['id'];
        $this->model->eliminarPromotores($id);
        header("location: " . base_url() . "Promotores/Listar");
        die();
    }
    public function reingresar()
    {
        $id = $_GET['id'];
        $this->model->reingresarPromotores($id);
        $data = $this->model->selectClientes();
        header("location: " . base_url() . "promotores/Listar");
        die();
    }
    public function buscar()
    {
        $clave_promotor = $_POST['clave_promotor'];
        $data = $this->model->Buscarpromotor($clave_promotor);
        echo json_encode($data);
    }
}

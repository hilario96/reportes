<?php
    class Admin extends Controllers{
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
            $insu = $this->model->insumos();
            $prom = $this->model->promotores();
            $usu = $this->model->usuarios();
            $doc = $this->model->documentacion();
            $rep = $this->model->reportes();
            $data = $insu['COUNT(*)'];
            $promotores = $prom['COUNT(*)'];  
            $usuarios = $usu['COUNT(*)'];
            $documentacion = $doc['COUNT(*)'];
            $reportes = $rep['COUNT(*)'];
            $this->views->getView($this, "Listar", $data, $promotores, $usuarios, $documentacion, $reportes);
        }
        public function reportes()
        {
            $data = $this->model->selectStockM();
            echo json_encode($data);
        }
        public function reportestorta()
        {
            $data = $this->model->selectinsumos();
            echo json_encode($data);
        }
}

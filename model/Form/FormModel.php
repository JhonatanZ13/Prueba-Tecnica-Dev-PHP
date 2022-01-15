<?php
    include_once '../model/MasterModel.php';

    class FormModel extends MasterModel{

        public function getAreas(){
            $sql = 'SELECT * FROM `areas`';
            $consulta = $this->query($sql);
            return $consulta;
        }

        public function getRoles(){
            $sql = 'SELECT * FROM `roles`';
            $consulta = $this->query($sql);
            return $consulta;
        }
    }
    
?>
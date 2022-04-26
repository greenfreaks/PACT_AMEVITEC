<?php
    class BusquedaModel extends Model{
        public function __construct(){
            parent::__construct();
        }

        public function searchUser($searchText){
            $selected_search = [];
            try{
                $query_search = $this->db->connect()->prepare(''); //TODO Zury obtener usuarios que su correo o nombre incida con el texto de busqueda, obtener id de usuario, nombre completo (usar CONCAT) y total de proyectos
                $query_search->execute(['text' => $searchText]);
                while($row_search = $query_search->fetch()){
                    $search=array();
                    $search['nombre'] = $row_search['nombre'];
                    $search['total_proyectos'] = $row_search['n_proyectos'];
                    $search['proyectos'] = $this->getUserTech($row_search['idusuario']);
                    array_push($selected_search, $search);
                }
                return $selected_search;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }

        public function getUserTech($userID){
            $selected_alltech = [];
            try{
                $query_alltech = $this->db->connect()->prepare(''); //TODO Zury obtener los proyectos de un usuario 
                $query_alltech->execute(['perfilID' => $userID]);
                while($row_tech = $query_alltech->fetch()){
                    $tech=array();
                    $tech['id'] = $row_tech['idtecnologia'];
                    $tech['nombre_tecnologia'] = $row_tech['nombre'];
                    $tech['nivelTRL'] = $row_tech['nombre'];
                    array_push($selected_alltech, $tech);
                }
                return $selected_alltech;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }

        public function searchProjects($searchText){
            $selected_search = [];
            try{
                $query_search = $this->db->connect()->prepare(''); //TODO Zury
                $query_search->execute(['text' => $searchText]);
                while($row_search = $query_search->fetch()){
                    $search=array();
                    $search['id'] = $row_search['id'];
                    $search['nombre_proyecto'] = $row_search['nombre_proyecto'];
                    $search['nombre_usuario'] = $row_search['nombre_usuario'];
                    $search['nivelTRL'] = $row_search['nivelTRL'];
                    array_push($selected_search, $search);
                }
                return $selected_search;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }
    }
?>
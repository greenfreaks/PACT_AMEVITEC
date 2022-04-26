<?php

include_once 'user_session.php';

    class ApiModel extends Model
    {
        public function __construct(){
            parent::__construct();
        }

        public function getMunicipios(){
            $items = [];
            try{
                $query = $this->db->connect()->query('select `idestado`,`estado` from `estado`;');
                
                while($row = $query->fetch()){
                    $estado=array();
                    $estado['id'] = $row['idestado'];
                    $estado['nombre'] = $row['estado'];
                    $estado['municipios'] = [];
                    try{
                        $query_municipios = $this->db->connect()->prepare('select `idmunicipio`, `municipio` from `municipio` where estado_idestado = :idestado;');
                        $query_municipios->execute(['idestado' => $row['idestado']]);
                        
                        while($row_municipios = $query_municipios->fetch()){
                            $municipio=array();
                            $municipio['id'] = $row_municipios['idmunicipio'];
                            $municipio['nombre'] = $row_municipios['municipio'];
            
                            array_push($estado['municipios'], $municipio);
                        }
                    }catch(PDOException $e){
                        return [];
                    }
    
                    array_push($items, $estado);
                }
                return $items;
            }catch(PDOException $e){
                return [];
            }
        }

        public function getDisciplinas(){

            $selected_campo = [];
            try{
                $query_campo = $this->db->connect()->query('SELECT `idcampo_conocimiento`,`campo_conocimiento` FROM `campo_conocimiento`;');
                while($row_campo = $query_campo->fetch()){
                    $campo=array();
                    $campo['id'] = $row_campo['idcampo_conocimiento'];
                    $campo['campo'] = $row_campo['campo_conocimiento'];

                    $campo['disciplinas'] = [];
                    try{
                        $query_disciplinas = $this->db->connect()->prepare('SELECT `iddisciplina`, `disciplina` from `disciplina` where campo_conocimiento_idcampo_conocimiento = :idcampo_conocimiento;');
                        $query_disciplinas->execute(['idcampo_conocimiento' => $row_campo['idcampo_conocimiento']]);
                        while($row_disciplinas = $query_disciplinas->fetch()){
                            $disciplina=array();
                            $disciplina['id'] = $row_disciplinas['iddisciplina'];
                            $disciplina['disciplina'] = $row_disciplinas['disciplina'];

                            $disciplina['subdisciplinas'] = [];
                            try{
                                $query_subdisciplinas = $this->db->connect()->prepare('SELECT `idsubdisciplina`, `subdisciplina` from `subdisciplina` where disciplina_iddisciplina = :iddisciplina');
                                $query_subdisciplinas->execute(['iddisciplina' => $row_disciplinas['iddisciplina']]);
                                while($row_subdisciplinas = $query_subdisciplinas->fetch()){
                                    $subdisciplina=array();
                                    $subdisciplina['id'] = $row_subdisciplinas['idsubdisciplina'];
                                    $subdisciplina['subdisciplina'] = $row_subdisciplinas['subdisciplina'];
                                    array_push($disciplina['subdisciplinas'] , $subdisciplina);
                                }
                                
                            }catch(PDOException $e){
                                return [];
                            }

                            array_push($campo['disciplinas'], $disciplina);
                        }

                    }catch(PDOException $e){
                        return [];
                    }

                    array_push($selected_campo, $campo);
                }
                return $selected_campo;
            }catch(PDOException $e){
                return [];
            }

        }

        public function getSectores(){
            $selected_sector = [];
            try{
                $query_sector = $this->db->connect()->query('SELECT `idsector_scian`, `sector_scian` FROM `sector_scian` WHERE 1');
                while($row_sector = $query_sector->fetch()){
                    $sector=array();
                    $sector['id'] = $row_sector['idsector_scian'];
                    $sector['sector'] = $row_sector['sector_scian'];

                    $sector['subsectores'] = [];
                    try{
                        $query_subsector = $this->db->connect()->prepare('SELECT `idsubsector_scian`, `subsector_scian` FROM `subsector_scian` WHERE `sector_scian_idsector_scian`= :idsector');
                        $query_subsector->execute(['idsector' => $row_sector['idsector_scian']]);
                        while($row_subsector = $query_subsector->fetch()){
                            $subsector=array();
                            $subsector['id'] = $row_subsector['idsubsector_scian'];
                            $subsector['subsector'] = $row_subsector['subsector_scian'];
                            $subsector['ramas'] = [];

                            try{
                                $query_rama = $this->db->connect()->prepare('SELECT `idrama_scian`, `rama_scian` FROM `rama_scian` WHERE `subsector_scian_idsubsector_scian`= :idsubsector');
                                $query_rama->execute(['idsubsector' => $row_subsector['idsubsector_scian']]);
                                while($row_rama = $query_rama->fetch()){
                                    $rama=array();
                                    $rama['id'] = $row_rama['idrama_scian'];
                                    $rama['rama'] = $row_rama['rama_scian'];
                                    array_push($subsector['ramas'], $rama);
                                }

                            }catch(PDOException $e){
                                //echo e;
                                return [];
                            }

                            array_push($sector['subsectores'], $subsector);
                        }
                        
                    }catch(PDOException $e){
                        //echo e;
                        return [];
                    }

                    array_push($selected_sector, $sector);
                }
                return $selected_sector;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }
    }

?>
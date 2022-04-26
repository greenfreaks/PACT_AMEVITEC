<?php

class TrlModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function isTechOfUser($techID){
        try{
            $query_owner = $this->db->connect()->prepare('SELECT `nombre` FROM `tecnologia` WHERE `idtecnologia`= :techid AND `usuario_general_idusuario_general`= :userID;');
            $query_owner->execute([
                'techid' => $techID,
                'userID' => $_SESSION['userId']
                ]);
            if($query_owner->rowCount()==1){
                return true;
            }
            return false;
        }catch(PDOException $e){
            //echo $e;
            return false;
        }
    }

    public function canBeEvaluated(){

        try{
            $query_lasteval = $this->db->connect()->prepare('SELECT
                    `idevaluacionTrl`,
                    `nivel`,
                    `createdAt`,
                    DATEDIFF(NOW(),`createdAt`) as lasteval
                FROM
                    `evaluaciontrl`
                WHERE
                    `tecnologia_idtecnologia` = :techid
                ORDER BY `createdAt` DESC
                LIMIT 1;');
            $query_lasteval->execute([
                    'techid' => $_SESSION['techID']
                ]);
            if($query_lasteval->rowCount()==0){
                return true;
            }  
            if($query_lasteval->rowCount()==1){
                $row_lasteval = $query_lasteval->fetch();
                $selected_lasteval ['lasteval'] = $row_lasteval['lasteval'];
                if($row_lasteval['lasteval'] >= 5){
                    return true;
                }
            }
            return false;
        }catch(PDOException $e){
            throw $e;
            return false;
        }

    }

    public function getPreguntas(){
        $selected_cat = [];
        try{
            $query_cat = $this->db->connect()->query('SELECT `idtrl_categoria`, `categoria`, `descripcion` FROM `trl_categoria`;');
            while($row_cat = $query_cat->fetch()){
                $cat=array();
                $cat['id'] = $row_cat['idtrl_categoria'];
                $cat['categoria'] = $row_cat['categoria'];
                $cat['descripcion'] = $row_cat['descripcion'];
                $cat['glosario'] = array();
                try{
                    $query_glosario = $this->db->connect()->prepare('SELECT `concepto`, `definicion` FROM `trl_glosario` WHERE `trl_categoria_idtrl_categoria`=:categoria;');
                    $query_glosario->execute(['categoria' => $row_cat['idtrl_categoria']]);
                    while($row_glosario = $query_glosario->fetch()){
                        $glosario=array();
                        $glosario['concepto'] = $row_glosario['concepto'];
                        $glosario['definicion'] = $row_glosario['definicion'];
                        array_push($cat['glosario'], $glosario);
                    }
                }catch(PDOException $e){
                    //echo e;[
                    $cat['glosario'] = [];
                }
                $cat['preguntas'] = array();
                try{
                    $query_preguntas = $this->db->connect()->prepare('SELECT `idtrl_pregunta`, `pregunta` FROM `trl_pregunta` WHERE `trl_categoria_idtrl_categoria`=:categoria;');
                    $query_preguntas->execute(['categoria' => $row_cat['idtrl_categoria']]);
                    while($row_preguntas = $query_preguntas->fetch()){
                        $preguntas=array();
                        $preguntas['id'] = $row_preguntas['idtrl_pregunta'];
                        $preguntas['pregunta'] = $row_preguntas['pregunta'];
                        array_push($cat['preguntas'], $preguntas);
                    }
                    $cat['shuffle_preguntas'] = shuffle($cat['preguntas']);
                }catch(PDOException $e){
                    //echo e;
                    $cat['preguntas'] = [];
                }
                
                array_push($selected_cat, $cat);
            }
            return $selected_cat;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function insertEval($data){
        $insert_eval = $this->db->connect();
        //insertar
        $query_eval = $insert_eval->prepare(
        'INSERT INTO `evaluaciontrl` (`tecnologia_idtecnologia`, `startTime`, `finishTime`, `idsPreguntasSi`) 
        VALUES (:idTech, :ST, :FT, :answers)');
        try{
            $query_eval->execute([
                'idTech' => $_SESSION['techID'],
                'ST' => $data['startTime'],
                'FT' => $data['finishTime'],
                'answers' => $data['answers'],
            ]);
            return $insert_eval->lastInsertId();
        }catch(PDOException $e){
            //echo $e;
            //echo 'data:('.$data['data'].')';
            return null;
        }
    }

    public function insertAnswers($data,$idEval){
        $insert_answer = $this->db->connect();
        $query_answer = $insert_answer->prepare(
        'INSERT INTO `trl_respuesta` (`trl_pregunta_idtrl_pregunta`, `evaluacionTRL_idevaluacionTRL`) VALUES (:idPregunta, :idEvaluacion);');
        try{
            $insert_answer->beginTransaction();
            foreach ($data as $row)
            {
                $query_answer->execute([
                    'idPregunta' => $row,
                    'idEvaluacion' => $idEval
                ]);
            }
            $insert_answer->commit();
            
            return $insert_answer->lastInsertId();
        }catch(PDOException $e){
            //echo 'data:('.$data['data'].')';
            $insert_answer->rollback();
            throw $e;
            return null;
        }
    }

    public function getTrlLevel($idEval){
        $selected_level = [];
        try{
            $query_level = $this->db->connect()->prepare(
                'SELECT nivel,porcentaje FROM (SELECT c1 AS nivel, ROUND(c4*100/c2) AS porcentaje FROM (
                SELECT nivel_idnivel AS c1, COUNT(nivel_idnivel) AS c2
                  FROM trl_pregunta 
                  GROUP BY nivel_idnivel) AS cp 
                INNER JOIN (SELECT nivel_idnivel AS c3, COUNT(trl_pregunta_idtrl_pregunta) AS c4 
                FROM trl_pregunta AS t1 
                LEFT JOIN trl_respuesta AS t2
                ON ( t1.idtrl_pregunta= t2.trl_pregunta_idtrl_pregunta) 
                WHERE evaluacionTRL_idevaluacionTRL= :idEvaluacion
                GROUP BY nivel_idnivel) AS cr
                ON (cp.c1= cr.c3)
                ORDER BY porcentaje DESC, cp.c1 DESC) AS generalNivel
                WHERE porcentaje >= 30
                LIMIT 1;');
            $query_level->execute(['idEvaluacion' => $idEval]);
            while($row_level = $query_level->fetch()){
                $selected_level['nivel'] = $row_level['nivel'];
            }
            return $selected_level;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function updateEvalTrlLevel($level,$ideval){
        $insert_level = $this->db->connect();
        //insertar
        $query_level = $insert_level->prepare(
        'UPDATE `evaluaciontrl` SET `nivel` = :nivel WHERE (`idevaluacionTrl` = :idEval);');
        try{
            $query_level->execute([
                'nivel' => $level,
                'idEval' => $ideval
            ]);
            return $insert_level->lastInsertId();
        }catch(PDOException $e){
            //echo $e;
            //echo 'data:('.$data['data'].')';
            return null;
        }
    }

    public function clearAnswers($idEval){
        $delete_data = $this->db->connect();
        $query_delete = $delete_data->prepare(
        'DELETE FROM `trl_respuesta` WHERE (`evaluacionTRL_idevaluacionTRL` = :idEval);');
        try{
            $query_delete->execute([
                'idEval' => $idEval
            ]);
            return $query_delete->rowCount();
        }catch(PDOException $e){
            $query_delete->rollback();
            throw $e;
            //echo 'data:('.$data['data'].')';
            return null;
        }
    }

    public function getCategories($idEval){
        $selected_cat = [];
        try{
            $query_cat = $this->db->connect()->prepare(
                'SELECT  C1 AS id_categoria, ROUND(c4*100/c2) as porcentaje FROM (
                                SELECT trl_categoria_idtrl_categoria AS c1, COUNT(trl_categoria_idtrl_categoria) AS c2
                                FROM trl_pregunta 
                                group by trl_categoria_idtrl_categoria) AS cp INNER JOIN
                (SELECT trl_categoria_idtrl_categoria AS c3, COUNT(trl_pregunta_idtrl_pregunta) AS c4 
                FROM trl_pregunta as t1 LEFT join trl_respuesta AS t2
                ON (t1.idtrl_pregunta= t2.trl_pregunta_idtrl_pregunta AND evaluacionTRL_idevaluacionTRL= :idEval) 
                GROUP BY trl_categoria_idtrl_categoria) AS cr INNER JOIN 
                (SELECT idtrl_categoria as c5, categoria as c6 from trl_categoria) as cc
                ON (cp.c1= cr.c3 and cr.c3 = cc.c5) order by c5;');
            $query_cat->execute(['idEval' => $idEval]);
            while($row_cat = $query_cat->fetch()){
                $cat=array();
                $cat['id'] = $row_cat['id_categoria'];
                $cat['porcentaje'] = $row_cat['porcentaje'];
                array_push($selected_cat, $cat);
            }
            return $selected_cat;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function updateCategories($Cat,$idEval){
        $insert_cat = $this->db->connect();
        $query_cat = $insert_cat->prepare(
        'INSERT INTO `evaluaciontrl_has_trl_categoria` (`evaluacionTrl_idevaluacionTrl`, `trl_categoria_idtrl_categoria`, `porcentaje`) VALUES (:evalID, :catID, :porcentaje)');
        try{
            $insert_cat->beginTransaction();
            foreach ($Cat as $row)
            {
                $query_cat->execute([
                    'evalID' => $idEval,
                    'catID' => $row['id'],
                    'porcentaje' => $row['porcentaje']
                ]);
            }
            $insert_cat->commit();
            
            return $insert_cat->lastInsertId();
        }catch(PDOException $e){
            //echo 'data:('.$data['data'].')';
            $insert_cat->rollback();
            throw $e;
            return null;
        }
    }

    public function obtenerAvancesNivel ($evalID){
        $selected_avancNivel = [];
        try{
            $query_avancNivel = $this->db->connect()->prepare(
                'SELECT c1 as nivel,c2 as aspNivel,c4 as aspLogrados,ROUND(c4*100/c2) as porcentaje FROM (
                    SELECT nivel_idnivel AS c1, COUNT(nivel_idnivel) AS c2
                      FROM trl_pregunta 
                      group by nivel_idnivel) AS cp INNER JOIN
                    (SELECT nivel_idnivel AS c3, COUNT(trl_pregunta_idtrl_pregunta) AS c4 
                    FROM trl_pregunta as t1 left join trl_respuesta AS t2
                    ON (evaluacionTRL_idevaluacionTRL= :idEvaluacion AND t1.idtrl_pregunta= t2.trl_pregunta_idtrl_pregunta) 
                    GROUP BY nivel_idnivel) AS cr
                    ON (cp.c1= cr.c3);');
            $query_avancNivel->execute(['idEvaluacion' => $evalID]);
            while($row_avancNivel = $query_avancNivel->fetch()){
                $avancNivel=array();
                $avancNivel['nivel'] = $row_avancNivel['nivel'];
                $avancNivel['aspNivel'] = $row_avancNivel['aspNivel'];
                $avancNivel['aspLogrados'] = $row_avancNivel['aspLogrados'];
                $avancNivel['porcentaje'] = $row_avancNivel['porcentaje'];
                array_push($selected_avancNivel, $avancNivel);
            }
            return $selected_avancNivel;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function getTrlLevelPlus($evalID){
        try{
            $avancesNivel = $this->obtenerAvancesNivel($evalID);
            
            $nivelMaximoEvaluar= 2; //equivalente al nivel 3
            $porcentajeGeneral= 0;
            $selected_level = [];
            //nivel 0 seleccionado por defaulr
            $selected_level['nivel'] = 0;
            $selected_level['porcentaje'] = 0;
            //rangos de porcentajes permitidos para cada nivel (estados)
            $restriccionesPorcentajes = array(
                array(1),
                array(3,1),
                array(3,2,2),
                array(4,3,3,2),
                array(4,4,3,2,3),
                array(4,4,4,4,3,3),
                array(4,4,4,4,4,4,4),
                array(4,4,4,4,4,4,3,4),
                array(4,4,4,4,4,4,4,4,4)  
            );
            $estadoPorcentajes = array();
            $seObtuvoNivel = false;
            
            //definir en que rango se encuentra el porcentaje de avance de cada nivel
            for($i=0;$i<9;$i++){
                $porcentajeGeneral+=$avancesNivel[$i]['porcentaje'];
                if($avancesNivel[$i]['porcentaje']<30){
                    array_push($estadoPorcentajes, 0);
                }else if (($avancesNivel[$i]['porcentaje']>=30) && ($avancesNivel[$i]['porcentaje']<40)){
                    array_push($estadoPorcentajes, 1);
                }else if(($avancesNivel[$i]['porcentaje']>=40) && ($avancesNivel[$i]['porcentaje']<50)){
                    array_push($estadoPorcentajes, 2);
                }else if(($avancesNivel[$i]['porcentaje']>=50) && ($avancesNivel[$i]['porcentaje']<60)){
                    array_push($estadoPorcentajes, 3);
                }else {
                    array_push($estadoPorcentajes, 4);
                }
            }
            $porcentajeGeneral=$porcentajeGeneral/9;
            
            //deacuerdo con el porcentaje de avance general se define que niveles se van a evaluar
            if($porcentajeGeneral>=34 && $porcentajeGeneral<67){
                $nivelMaximoEvaluar= 5;
            }else if ($porcentajeGeneral>=67){
                $nivelMaximoEvaluar= 8;
            }
            
            //se evaluan los niveles
            for($i=$nivelMaximoEvaluar;$i>=0;$i--){
                $seCumplenRestricciones= true;
                //se comparan los porcentajes de cada nivel
                for($j=$i;$j>=0;$j--){
                    if($restriccionesPorcentajes[$avancesNivel[$i]['nivel']-1][$j] > $estadoPorcentajes[$j]){
                        $seCumplenRestricciones = false;
                    break;
                    }
                }
                if($seCumplenRestricciones){
                    $selected_level['nivel'] = $avancesNivel[$i]['nivel'];
                    $selected_level['porcentaje'] = $avancesNivel[$i]['porcentaje'];
                break;
                }
            }   
            return $selected_level;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

}

?>
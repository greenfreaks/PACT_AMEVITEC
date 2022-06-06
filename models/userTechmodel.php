<?php

class userTechModel extends Model{
     private $hayNivelesBajos = false;

    public function __construct(){
        parent::__construct();
    }

    public function getAllTech(){
        $selected_alltech = [];
        try{
            $query_alltech = $this->db->connect()->prepare('SELECT `idtecnologia`, `nombre`, `tipo_alianza_idtipo_alianza` FROM `tecnologia` WHERE  `usuario_general_idusuario_general`= :userID ');
            $query_alltech->execute(['userID' => $_SESSION['userId']]);
            while($row_tech = $query_alltech->fetch()){
                $tech=array();
                $tech['id'] = $row_tech['idtecnologia'];
                $tech['techname'] = $row_tech['nombre'];
                array_push($selected_alltech, $tech);
            }
            return $selected_alltech;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
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
            throw $e;
            return false;
        }
    }

    public function getTech(){
        $selected_tech = [];
        try{
            //$query_tech = $this->db->connect()->prepare('SELECT `nombre`, `tipo_alianza_idtipo_alianza` FROM `tecnologia` WHERE `idtecnologia`= :techid AND `perfil_academico_idperfil_academico`= :perfilID ;');
            $query_tech = $this->db->connect()->prepare(
                'SELECT `idtecnologia`,`nombre`,`idtipo_alianza`, `tipo_alianza` FROM `tecnologia` 
                INNER JOIN `tipo_alianza`
                on (`idtipo_alianza`=`tipo_alianza_idtipo_alianza` AND `idtecnologia`= :techid);');
            $query_tech->execute([
                'techid' => $_SESSION['techID']
                ]);
            if($query_tech->rowCount()==1){
                $row_tech = $query_tech->fetch();
                $selected_tech ['techname'] = $row_tech['nombre'];
                $selected_tech ['alianzaID'] = $row_tech['idtipo_alianza'];
                $selected_tech ['tipo_alianza'] = $row_tech['tipo_alianza'];
                // $selected_tech['idTecnologia'] = $row_tech['idTecnologia'];
            }
            return $selected_tech;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function getTechScian(){
        $selected_ramas = [];
        try{
            $query_ramas = $this->db->connect()->prepare(
                'SELECT `tecnologia_idtecnologia` AS idTecnologia, `idsector_scian`, `sector_scian`, `idsubsector_scian` ,`subsector_scian`,`idrama_scian`,`rama_scian` 
                FROM `tecnologia_has_rama_scian`
                INNER JOIN `rama_scian` ON (`idrama_scian`= `rama_scian_idrama_scian`)
                INNER JOIN `subsector_scian`  ON (`idsubsector_scian`=`subsector_scian_idsubsector_scian`)
                INNER JOIN `sector_scian` ON (`idsector_scian`=`sector_scian_idsector_scian`)
                WHERE `tecnologia_idtecnologia`= :techid;');
            $query_ramas->execute(['techid' => $_SESSION['techID']]);
            while($row_ramas = $query_ramas->fetch()){
                $ramas=array();
                $ramas['idTecnologia'] = $row_ramas['idTecnologia'];
                $ramas['idsector_scian'] = $row_ramas['idsector_scian'];
                $ramas['sector_scian'] = $row_ramas['sector_scian'];
                $ramas['idsubsector_scian'] = $row_ramas['idsubsector_scian'];
                $ramas['subsector_scian'] = $row_ramas['subsector_scian'];
                $ramas['idrama_scian'] = $row_ramas['idrama_scian'];
                $ramas['rama_scian'] = $row_ramas['rama_scian'];
                array_push($selected_ramas, $ramas);
            }
            return $selected_ramas;
        }catch(PDOException $e){
            throw $e;
            return [];
        }
    }

    public function getPredicados(){
        $selected_predicados = [];
        try{
            //$query_predicados = $this->db->connect()->query('');
            $query_predicados = $this->db->connect()->prepare(
                'SELECT `idmanera_solucionar` AS idManera,
                `tecnologia_idtecnologia`AS idTecnologia,
                `idtipo_tecnologia`  AS idTipo,
                 `tipo_tecnologia` as tipo,
                 `idverbo_solucion` AS idVerbo,
                 `verbo_solucion` AS verbo ,
                 `complemento` as complemento,
                 `idusuario_tecnologia` AS idUsuario,
                 `usuario_tecnologia` AS usuario
                FROM `manera_solucionar`
                 INNER JOIN `tipo_tecnologia` on( `idtipo_tecnologia`=`tipo_tecnologia_idtipo_tecnologia`)
                 INNER JOIN `verbo_solucion` on(`idverbo_solucion`=`verbo_solucion_idverbo_solucion`)
                 INNER JOIN `usuario_tecnologia`on (`idusuario_tecnologia` = `usuario_tecnologia_idusuario_tecnologia`)
                WHERE (`tecnologia_idtecnologia`= :techid);');
            $query_predicados->execute(['techid' => $_SESSION['techID']]);
            while($row_predicados = $query_predicados->fetch()){
                $predicados=array();
                $predicados['idManera'] = $row_predicados['idManera'];
                $predicados['idTecnologia'] = $row_predicados['idTecnologia'];
                $predicados['idTipo'] = $row_predicados['idTipo'];
                $predicados['tipo'] = $row_predicados['tipo'];
                $predicados['idVerbo'] = $row_predicados['idVerbo'];
                $predicados['verbo'] = $row_predicados['verbo'];
                $predicados['complemento'] = $row_predicados['complemento'];
                $predicados['idUsuario'] = $row_predicados['idUsuario'];
                $predicados['usuario'] = $row_predicados['usuario'];
                array_push($selected_predicados, $predicados);
            }
            return $selected_predicados;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function getObjetivosONU(){
        $selected_objetivos = [];
        try{
            $query_objetivos = $this->db->connect()->prepare('SELECT `idobjetivo_sotenible_onu`, `objetivo_sotenible_onu` FROM `tecnologia_has_objetivo_sotenible_onu`
            INNER JOIN `objetivo_sotenible_onu` ON (`idobjetivo_sotenible_onu`=`objetivo_sotenible_onu_idobjetivo_sotenible_onu`)
            WHERE `tecnologia_idtecnologia`= :techid;');
            $query_objetivos->execute(['techid' => $_SESSION['techID']]);
            while($row_objetivos = $query_objetivos->fetch()){
                $objetivo=array();
                $objetivo['id'] = $row_objetivos['idobjetivo_sotenible_onu'];
                $objetivo['objetivo'] = $row_objetivos['objetivo_sotenible_onu'];
                array_push($selected_objetivos, $objetivo);
            }
            return $selected_objetivos;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function getBeneficiados(){
        $selected_beneficios = [];
        try{
            $query_beneficios = $this->db->connect()->prepare('SELECT  `idtipo_problematica`, `tipo_problematica` FROM tecnologia_has_tipo_problematica
            INNER JOIN `tipo_problematica` ON (`idtipo_problematica` = `tipo_problematica_idtipo_problematica`)
            WHERE `tecnologia_idtecnologia` = :techid;');
            $query_beneficios->execute(['techid' => $_SESSION['techID']]);
            while($row_beneficios = $query_beneficios->fetch()){
                $beneficios=array();
                $beneficios['id'] = $row_beneficios['idtipo_problematica'];
                $beneficios['beneficio'] = $row_beneficios['tipo_problematica'];
                array_push($selected_beneficios, $beneficios);
            }
            return $selected_beneficios;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    //============================================================================
    public function isLicenceValid($licencia){
        try{
            $query_prefix = $this->db->connect()->prepare('SELECT `idcodigo_reporteTrl` FROM `codigo_reportetrl` WHERE `codigo_reporteTrl`=:licencia AND `evaluacionTrl_idevaluacionTrl` IS NULL;');
            $query_prefix->execute([
                'licencia' => $licencia
                ]);
            if($query_prefix->rowCount()==1){
                $row_prefix = $query_prefix->fetch();
                $selected_prefix ['id'] = $row_prefix['idcodigo_reporteTrl'];
                return $selected_prefix ['id'];
            }
            return false;
        }catch(PDOException $e){
            throw $e;
            return false;
        }
    }

    public function setLicence($idEval,$idcodigoreporteTrl){
        $setlicence = $this->db->connect();
        $query_licence = $setlicence->prepare(
        'UPDATE `codigo_reportetrl` SET `evaluacionTrl_idevaluacionTrl` = :ideval WHERE (`idcodigo_reporteTrl` = :idcodigoreporteTrl);');
        try{
            $query_licence->execute([
                'ideval' => $idEval,
                'idcodigoreporteTrl' => $idcodigoreporteTrl
            ]);
            return $query_licence->rowCount();
        }catch(PDOException $e){
            $query_licence->rollback();
            throw $e;
            //echo 'data:('.$data['data'].')';
            return null;
        }
    }
    //============================================================================

    public function getTRLEval(){
        $selected_TRL = [];
        try{
            //$query_TRL = $this->db->connect()->query('');
            $query_TRL = $this->db->connect()->prepare('SELECT `idevaluacionTrl`, `nivel`, `createdAt` FROM  `evaluaciontrl`
            WHERE `tecnologia_idtecnologia` = :techid ORDER BY `evaluaciontrl`.`idevaluacionTrl` DESC LIMIT 1;');
            $query_TRL->execute(['techid' => $_SESSION['techID']]);
            while($row_TRL = $query_TRL->fetch()){
                $TRL=array();
                $TRL['id'] = $row_TRL['idevaluacionTrl'];
                $TRL['nivel'] = $row_TRL['nivel'];
                $TRL['fecha'] = $row_TRL['createdAt'];
                $TRL['desbloqueado'] = $this->estaDesbloquedoPDF($row_TRL['idevaluacionTrl']);
                $TRL['resultados'] = [];
                    try{
                        $query_cat = $this->db->connect()->prepare('SELECT `categoria`,`porcentaje` FROM  `evaluaciontrl`
                        INNER JOIN `evaluaciontrl_has_trl_categoria` ON (`idevaluacionTrl`= `evaluacionTrl_idevaluacionTrl`)
                        INNER JOIN `trl_categoria` ON (`idtrl_categoria`= `trl_categoria_idtrl_categoria`)
                        WHERE `idevaluacionTrl` = :ideval
                        ORDER BY `idevaluacionTrl` ASC ,idtrl_categoria ASC;');
                        $query_cat->execute(['ideval' => $row_TRL['idevaluacionTrl']]);
                        while($row_cat = $query_cat->fetch()){
                            $cat=array();
                            $cat['categoria'] = $row_cat['categoria'];
                            $cat['porcentaje'] = $row_cat['porcentaje'];
                            array_push($TRL['resultados'], $cat);
                        }
                    }catch(PDOException $e){
                        //echo e;
                        $TRL['resultados'] = [];
                    }
                
                array_push($selected_TRL, $TRL);
            }
            return $selected_TRL;
        }catch(PDOException $e){
            //echo e;
            return [];
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

    public function estaDesbloquedoPDF($evalID){
        try{
            $query_codigo = $this->db->connect()->prepare( 'SELECT `idevaluacionTrl`, `idcodigo_reporteTrl` FROM  `evaluaciontrl`
            INNER JOIN `codigo_reportetrl`
            ON (`idevaluacionTrl`=`evaluacionTrl_idevaluacionTrl`)
            WHERE `idevaluacionTrl` = :idEvaluacion ;');
            $query_codigo->execute(['idEvaluacion' => $evalID]);
            if($query_codigo->rowCount()==1){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            //echo e;
            return false;
        }
    }

    public function nombreTecnologia($evalID){
        $selected_tecnhology = [];
        try{
            $query_tecnhology = $this->db->connect()->prepare('SELECT  `nombre` FROM  `tecnologia`
            INNER JOIN `evaluaciontrl`
            ON (`idtecnologia` = `tecnologia_idtecnologia`)
            WHERE `idevaluacionTrl` = :idEvaluacion;');
            $query_tecnhology->execute([
                'idEvaluacion' => $evalID
                ]);
            if($query_tecnhology->rowCount()==1){
                $row_tecnhology = $query_tecnhology->fetch();
                $selected_tecnhology ['nombre'] = $row_tecnhology['nombre'];
            }
            return $selected_tecnhology;
        }catch(PDOException $e){
            throw $e;
            return [];
        }
    }
    public function getTrlLevel($evalID){
        $selected_level = [];
        try{
            $query_level = $this->db->connect()->prepare(
                'SELECT nivel, porcentaje FROM (SELECT c1 AS nivel, ROUND(c4*100/c2) AS porcentaje FROM (
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
            $query_level->execute(['idEvaluacion' => $evalID]);
            while($row_level = $query_level->fetch()){
                $selected_level['nivel'] = $row_level['nivel'];
                $selected_level['porcentaje'] = $row_level['porcentaje'];
            }
            return $selected_level;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function obtenerIdsPreguntas($evalID){
        $selected_idsPreguntas = [];
        try{
            $query_idsPreguntas = $this->db->connect()->prepare('SELECT `idsPreguntasSi` FROM `evaluaciontrl`
            WHERE `idevaluacionTrl`= :idEvaluacion ;');
            $query_idsPreguntas->execute([
                'idEvaluacion' => $evalID
                ]);
            if($query_idsPreguntas->rowCount()==1){
                $row_idsPreguntas = $query_idsPreguntas->fetch();
                $selected_idsPreguntas ['idsPreguntasSi'] = $row_idsPreguntas['idsPreguntasSi'];
            }
            return $selected_idsPreguntas;
        }catch(PDOException $e){
            throw $e;
            return [];
        }
    }

    public function insertAnswers($evalID){
        $cadenaIdsPreguntas = $this->obtenerIdsPreguntas($evalID);
        $data = explode ( "," , $cadenaIdsPreguntas['idsPreguntasSi'] );
        $insert_answer = $this->db->connect();
        $query_answer = $insert_answer->prepare(
        'INSERT INTO `trl_respuesta` (`trl_pregunta_idtrl_pregunta`, `evaluacionTRL_idevaluacionTRL`) VALUES (:idPregunta, :idEvaluacion);');
        try{
            $insert_answer->beginTransaction();
            foreach ($data as $row)
            {
                $query_answer->execute([
                    'idPregunta' => $row,
                    'idEvaluacion' => $evalID
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

    public function clearAnswers($evalID){
        $delete_data = $this->db->connect();
        $query_delete = $delete_data->prepare(
        'DELETE FROM `trl_respuesta` WHERE (`evaluacionTRL_idevaluacionTRL` = :idEval);');
        try{
            $query_delete->execute([
                'idEval' => $evalID
            ]);
            return $query_delete->rowCount();
        }catch(PDOException $e){
            $query_delete->rollback();
            throw $e;
            //echo 'data:('.$data['data'].')';
            return null;
        }
    }

    public function obtenerDescripcionNiveles(){
        $selected_descNiveles = [];
        try{
            $query_descNiveles = $this->db->connect()->query('SELECT idnivel,descripcion FROM trl_nivel;');
            while($row_descNiveles = $query_descNiveles->fetch()){
                $descNiveles=array();
                $descNiveles['id'] = $row_descNiveles['idnivel'];
                $descNiveles['descripcion'] = $row_descNiveles['descripcion'];
                array_push($selected_descNiveles, $descNiveles);
            }
            return $selected_descNiveles;
        }catch(PDOException $e){
            //echo e;
            return [];
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

    public function obtenerAvancesCategoria($evalID){
        $selected_avancCategoria = [];
        try{
            $query_avancCategoria = $this->db->connect()->prepare('SELECT `categoria`,`porcentaje` FROM  `evaluaciontrl`
            INNER JOIN `evaluaciontrl_has_trl_categoria` ON (`idevaluacionTrl`= `evaluacionTrl_idevaluacionTrl`)
            INNER JOIN `trl_categoria` ON (`idtrl_categoria`= `trl_categoria_idtrl_categoria`)
            WHERE `idevaluacionTrl` = :idEvaluacion
            ORDER BY `idevaluacionTrl` ASC, idtrl_categoria ASC;');
            $query_avancCategoria->execute(['idEvaluacion' => $evalID]);
            while($row_avancCategoria = $query_avancCategoria->fetch()){
                $avancCategoria=array();
                $avancCategoria['categoria'] = $row_avancCategoria['categoria'];
                $avancCategoria['porcentaje'] = $row_avancCategoria['porcentaje'];
                array_push($selected_avancCategoria, $avancCategoria);
            }
            return $selected_avancCategoria;
        }catch(PDOException $e){
            //echo e;
            return [];
        }

    }

    public function obtenerRecomendaciones ($evalID){
        $nivel = $this->getTrlLevelPlus($evalID);
        $nivelNoAlcanzado = $nivel['nivel']+1;
        $selected_recomEviden = [];
        try{
            if($nivel['nivel']<9){
                $query_recomEviden = $this->db->connect()->prepare('(SELECT trl_nivel_idnivel, descripcion as descr, NULL as orden FROM trl_evidencia 
                WHERE trl_nivel_idnivel BETWEEN 1 AND :nivel) UNION
                            (SELECT trl_nivel_idnivel, texto as descr, orden FROM trl_recomendacion 
                            WHERE 	trl_nivel_idnivel BETWEEN :nivelNoAlcanzado AND 9)
                            ORDER BY trl_nivel_idnivel ASC,orden ASC;');
                $query_recomEviden->execute(['nivel' => $nivel['nivel'], 'nivelNoAlcanzado' => $nivelNoAlcanzado]);
            }else{
                $query_recomEviden = $this->db->connect()->prepare('(SELECT trl_nivel_idnivel, descripcion as descr, NULL as orden FROM trl_evidencia 
                WHERE trl_nivel_idnivel BETWEEN 1 AND :nivel)
                            ORDER BY trl_nivel_idnivel ASC,orden ASC;');
                $query_recomEviden->execute( ['nivel' => $nivel['nivel']]);
            }
            while($row_recomEviden = $query_recomEviden->fetch()){
                $recomEviden=array();
                $recomEviden['trl_nivel_idnivel'] = $row_recomEviden['trl_nivel_idnivel'];
                $recomEviden['descr'] = $row_recomEviden['descr'];
                $recomEviden['orden'] = $row_recomEviden['orden'];
                array_push($selected_recomEviden, $recomEviden);
            }
            return $selected_recomEviden;
        }catch(PDOException $e){
            echo $e;
            return [];
        }
    }

    public function obtenerServiciosBasicos($tipoUsuario){
        $selected_servicioBasicos = [];
        try{
            $query_servicioBasicos = $this->db->connect()->prepare('SELECT trl_tipo_producto_idtrl_tipo_producto, nombre FROM trl_nominacion_producto 
            INNER JOIN trl_producto ON trl_nominacion_producto_idtrl_nominacion_producto=idtrl_nominacion_producto
            WHERE idtrl_producto BETWEEN 93 AND 100 AND tipo_usuario_idtipo_usuario= :tipoUsuario ;');
            $query_servicioBasicos->execute(['tipoUsuario' => $tipoUsuario]);
            while($row_servicioBasicos = $query_servicioBasicos->fetch()){
                $servicioBasicos=array();
                $servicioBasicos['tipoProducto'] = $row_servicioBasicos['trl_tipo_producto_idtrl_tipo_producto'];
                $servicioBasicos['nombre'] = $row_servicioBasicos['nombre'];
                
                array_push($selected_servicioBasicos, $servicioBasicos);
            }
            return $selected_servicioBasicos;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function obtenerNivelesBajoAvance($evalID){
        $selected_nivelesBajoAvance = [];
        try{
            $query_nivelesBajoAvance = $this->db->connect()->prepare(' SELECT    if(c4<((50*c2)/100),1,0) AS esBajo FROM (
                SELECT nivel_idnivel AS c1, COUNT(nivel_idnivel) AS c2
                  FROM trl_pregunta 
                  group by nivel_idnivel) AS cp INNER JOIN
(SELECT nivel_idnivel AS c3, COUNT(trl_pregunta_idtrl_pregunta) AS c4 
FROM trl_pregunta as t1 left join trl_respuesta AS t2
ON (evaluacionTRL_idevaluacionTRL= :idEval AND t1.idtrl_pregunta= t2.trl_pregunta_idtrl_pregunta) 
GROUP BY nivel_idnivel) AS cr
ON (cp.c1= cr.c3);');
            $query_nivelesBajoAvance->execute(['idEval' => $evalID]);
            while($row_nivelesBajoAvance = $query_nivelesBajoAvance->fetch()){
                if((!$this->hayNivelesBajos) AND ($row_nivelesBajoAvance['esBajo']==1))
                $this->hayNivelesBajos=TRUE;

                $nivelesBajoAvance=array();
                $nivelesBajoAvance['esBajo'] = $row_nivelesBajoAvance['esBajo'];
                array_push($selected_nivelesBajoAvance, $nivelesBajoAvance);
            }
            return $selected_nivelesBajoAvance;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function obtenerPruductos($evalID, $tipoPruducto,$tipoUsuario){
        $nivelesBajos = $this->obtenerNivelesBajoAvance($evalID);
        $selected_servicios = [];
        $yaExisteCursos = false;
        
        try{
            if($this->hayNivelesBajos==true){
                   
            for ($i=0; $i<9;$i++){
                $nivelAcutal = $i+1;
                if($nivelesBajos[$i]['esBajo']==1){
                    $query_servicios = $this->db->connect()->prepare('SELECT nombre, enlace FROM trl_nominacion_producto
                    INNER JOIN trl_producto ON idtrl_nominacion_producto =
                   trl_nominacion_producto_idtrl_nominacion_producto
                    INNER JOIN trl_producto_has_trl_nivel ON idtrl_producto = trl_producto_idtrl_producto
                    WHERE  trl_nivel_idnivel = :nivel  AND
                   trl_tipo_producto_idtrl_tipo_producto = :idTipoProducto AND tipo_usuario_idtipo_usuario = :tipoUsuario 
                    GROUP BY trl_nominacion_producto.nombre,enlace;');
                    $query_servicios->execute(['idTipoProducto' => $tipoPruducto, 'nivel' =>$nivelAcutal , 'tipoUsuario' =>$tipoUsuario]);
                    while($row_servicios = $query_servicios->fetch()){
                        for($j=0; $j< count($selected_servicios,0);$j++){
                            if ($selected_servicios[$j]['nombre'] == $row_servicios['nombre']){
                                $yaExisteCursos = true;
                                break;
                            }
                        }
                        if($yaExisteCursos==false){
                            $servicios=array();
                            $servicios['nombre'] = $row_servicios['nombre'];
                            array_push($selected_servicios, $servicios);
                        }else{
                            $yaExisteCursos = false;
                        }

                    }
                }
            }    
            }
            return $selected_servicios;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    
    }

    public function obtenerSaltosGraficaTpl($evalID){
        $selected_saltosGraficaTpl = [];
        try{
            for ($nivel=1; $nivel<=9;$nivel++){
                $query_saltosGraficaTpl = $this->db->connect()->prepare('SELECT tplContestadas, ROUND(tplContestadas*100/tpl) as promedio
                from (select `nivel_idnivel`,`trl_tpl_idtrl_tpl` as tpl, count(`idtrl_pregunta`) as reactivos  
                    from `trl_pregunta` as preguntasTodas where `nivel_idnivel`= :nivel group by `trl_tpl_idtrl_tpl`) as totalPreguntas
                    inner join
                (select `trl_tpl_idtrl_tpl` as tplContestadas, count(`trl_pregunta_idtrl_pregunta`) as contestadas
                from   `trl_respuesta` as respuestas  inner join  `trl_pregunta` as preguntas 
                on (`nivel_idnivel`= :nivel1 and `evaluacionTRL_idevaluacionTRL`=:idEval AND preguntas.idtrl_pregunta= respuestas.trl_pregunta_idtrl_pregunta)
                group by `trl_tpl_idtrl_tpl`) as preguntasContestadas
                on (tpl=tplContestadas)
                ORDER BY promedio DESC, tplContestadas DESC
                LIMIT 1;');
                $query_saltosGraficaTpl->execute(['idEval' => $evalID, 'nivel' =>$nivel,'nivel1' =>$nivel]);
                if($query_saltosGraficaTpl->rowCount()==1){
                    $row_saltosGraficaTpl = $query_saltosGraficaTpl->fetch();
                    $saltosGraficaTpl=array();
                    $saltosGraficaTpl['tpl'] = $row_saltosGraficaTpl['tplContestadas'];
                    array_push($selected_saltosGraficaTpl, $saltosGraficaTpl);
                }else{
                    $saltosGraficaTpl=array();
                    $saltosGraficaTpl['tpl'] = 0;
                    array_push($selected_saltosGraficaTpl, $saltosGraficaTpl);
                }
            }
            return $selected_saltosGraficaTpl;
        }catch(PDOException $e){
            //echo e;
            return [];
        }

    }

    function obtenerFirma ($evalID){
        $selected_firma = [];
        try{
            $query_firma = $this->db->connect()->prepare('SELECT HEX(AES_ENCRYPT(:evalID, :secretC)) as firma;');
            $query_firma->execute([
                'secretC' => constant('SECRET'),
                'evalID' => $evalID,
                ]);
            if($query_firma->rowCount()==1){
                $row_firma = $query_firma->fetch();
                $selected_firma ['firma'] = $row_firma['firma'];
            }
            return $selected_firma;
        }catch(PDOException $e){
            throw $e;
            return [];
        }
    }

    public function getTrlLevels($evalID){
        $selected_levels = [];
        try{
            $query_level = $this->db->connect()->prepare(
                'SELECT nivel, porcentaje FROM (SELECT c1 AS nivel, ROUND(c4*100/c2) AS porcentaje FROM (
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
                ORDER BY porcentaje DESC, cp.c1 DESC) AS generalNivel;');
            $query_level->execute(['idEvaluacion' => $evalID]);
            while($row_level = $query_level->fetch()){
                $nivel=array();
                $nivel['nivel'] = $row_level['nivel'];
                $nivel['porcentaje'] = $row_level['porcentaje'];
                array_push($selected_levels, $nivel);
            }
            return $selected_levels;
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
<?php
    include "public/php/conexion.php";

    $sql = "SELECT * FROM perfil_academico pa
    INNER JOIN usuario_general ug ON pa.usuario_general_idusuario_general = ug.idusuario_general
    INNER JOIN grado_academico ga ON pa.grado_academico_idgrado_academico = ga.idgrado_academico
    INNER JOIN organizacion org ON pa.organizacion_actual = org.idorganizacion
    INNER JOIN funcion_academico fa ON pa.funcion_academico_idfuncion_academico = fa.idfuncion_academico
    INNER JOIN subdisciplina sub ON pa.subdisciplina_idsubdisciplina = sub.idsubdisciplina
    INNER JOIN disciplina dis ON sub.disciplina_iddisciplina = dis.iddisciplina
    INNER JOIN campo_conocimiento camp ON dis.campo_conocimiento_idcampo_conocimiento = camp.idcampo_conocimiento
    INNER JOIN perfil_academico_has_actividad_experiencia exp ON exp.perfil_academico_idperfil_academico $where LIMIT 10 ";

    $resultado = mysqli_query($connection, $sql);
    $datos = mysqli_fetch_all($resultado,MYSQLI_ASSOC);

    var_dump($datos);

    if(!empty($datos)){
        echo json_encode($datos);
    }else{
        echo json_encode([]);
    }
?>
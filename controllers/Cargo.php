<?php
    require_once '../models/Cargo.php';
    /*Seccion para registrar el cargo */
    if(isset($_POST['registrar'])){
        $nro_item = addslashes(strip_tags($_POST['nro_item']));
        $tipo_cargo = addslashes(strip_tags($_POST['tipo_item']));

        registrarCargo($nro_item, $tipo_cargo);
    }

    function registrarCargo($nro_item, $tipo_cargo){
        if(!empty($nro_item) and !empty($tipo_cargo)){
            $cargo = new Cargo();
            if($cargo->create($nro_item, $tipo_cargo)){
                header('Location: ../views/vacaciones/cargos');
            }else{
                header('Location: ../views/vacaciones/cargos?'.base64_encode('res').'='.base64_encode('error_query'));
            }
        }else{
            header('Location: ../views/vacaciones/cargos?'.base64_encode('res').'='.base64_encode('falta_datos'));
        }
    }
    /*Fin de la seccion para registrar el cargo */
    /*Seccion para editar el cargo */
    if(isset($_POST['editar'])){
        $nro_item = addslashes(strip_tags($_POST['nro_item_e']));
        $tipo_cargo = addslashes(strip_tags($_POST['tipo_cargo_e']));
        $cod = addslashes(strip_tags($_POST['cod']));

        editarCargo($nro_item, $tipo_cargo, $cod);
    }

    function editarCargo($nro_item, $tipo_cargo, $cod){
        if(!empty($tipo_cargo) and !empty($tipo_cargo) and !empty($cod)){
            $cargo = new Cargo();
            if($cargo->update($nro_item, $tipo_cargo, $cod)){
                header('Location: ../views/vacaciones/cargos');
            }else{
                header('Location: ../views/vacaciones/cargos?'.base64_encode('res').'='.base64_encode('error_query'));
            }
        }else{
            header('Location: ../views/vacaciones/cargos?'.base64_encode('res').'='.base64_encode('falta_datos'));
        }
    }
    /*Fin de la seccion para registrar el cargo */
    if(isset($_POST['eliminar'])){
        $cod = addslashes(strip_tags($_POST['cod_el']));

        eliminarCargo($cod);
    }
    function eliminarCargo($cod){
        if(!empty($cod)){
            $cargo = new Cargo();
            if($cargo->delete($cod)){
                header('Location: ../views/vacaciones/cargos');
            }else{
                header('Location: ../views/vacaciones/cargos?'.base64_encode('res').'='.base64_encode('error_query'));
            }
        }else{
            header('Location: ../views/vacaciones/cargos?'.base64_encode('res').'='.base64_encode('falta_datos'));
        }
    }
    /*Seccion para eliminar el cargo */
<!DOCTYPE html>
<html lang="en">
<?php 
    include '../layout/head.php';
?>

<body>
    <!-- Menu navegacion -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="../../">
                        <img src="../../public/img/logo.png" alt="Logo index" width="40" height="40">
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="personal">PERSONAL</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">CARGOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">RUTA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="unidad">UNIDAD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="situacion">SITUACION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="beneficio">BENEFICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">REPORTES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cas">CAS</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Fin menu navegacion -->
    <!-- Alertas -->
    <div class="alert alert-danger alert-dismissible fade show oculto" id="error-reg" role="alert">
        <span class="mensaje-alerta">Error en registro</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="alert alert-warning alert-dismissible fade show oculto" id="falt-camp" role="alert">
        <span class="mensaje-alerta">Debe ingresar todos los campos solicitados</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- Fin Alertas -->
    <!-- Tabla de cargo -->
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="col-10" style="padding : 0;">
                <h5 class="text-center">CARGOS</h5>
                <div class="row mt-5">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalNuevoCargo">
                                NUEVO CARGO
                            </button>
                        </div>
                    </div>
                </div>
                <table class="table table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ITEM</th>
                            <th scope="col" class="text-center">NOMBRE DE CARGO</th>
                            <th scope="col" class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once '../../models/cargo.php';
                            $carg = new Cargo();
                            $cargo = $carg->read();
                            foreach ($cargo as $car) {
                        ?>
                        <tr>
                            <td class="text-center"><?= $car['nro_item'];?></td>
                            <td class="text-center"><?= $car['tipo_cargo'];?></td>
                            <td class="text-center">
                                <a href="" title="Editar" data-toggle="modal" data-target="#modalEditar<?= $car['nro_item'];?>"><i
                                        class="far fa-edit"></i></a>
                                <a href="" title="Eliminar" data-toggle="modal" data-target="#modalEliminar<?= $car['nro_item'];?>"><i
                                        class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <!-- Modal editar cargo -->
                        <form action="../../controllers/cargo.php" method="post">
                            <div class="modal fade" id="modalEditar<?= $car['nro_item'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">EDITAR CARGO</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                                require_once '../../models/cargo.php';
                                                $datos = new Cargo();
                                                $datos = $datos->getDatos($car['nro_item']);
                                                foreach ($datos as $valor) {
                                            ?>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?= $valor['nro_item'];?>" name="nro_item_e" required>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" value="<?= $valor['tipo_cargo'];?>" name="tipo_cargo_e" required>
                                                </div>
                                                <input type="hidden" value="<?= $valor['nro_item'];?>" name="cod">
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary" name="editar">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Final Modal editar cargo -->
                        <!-- Modal eliminar unidad -->
                        <form action="../../controllers/cargo.php" method="post">
                                <div class="modal fade" id="modalEliminar<?= $car['nro_item'];?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">¿Esta seguro que desea eliminar?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                                            <input type="hidden" name="cod_el" value="<?= $car['nro_item'];?>">
                                            <button type="submit" class="btn btn-danger" name="eliminar">Si</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                        <!-- Final Modal eliminar unidad -->
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Fin Tabla de cargo -->
    <!-- Modal registrar cargo -->
    <form action="../../controllers/cargo.php" method="post">
        <div class="modal fade" id="modalNuevoCargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">NUEVO CARGO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Numero de item" name="nro_item" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nombre del item" name="tipo_item" required>
                            </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Final Modal registrar cargo -->
    <?php 
        if(!empty($_REQUEST)){
             if($_REQUEST[base64_encode('res')] == base64_encode('error_query')){
    ?>
                <style>
                    #error-reg{
                        display:block;
                    }
                </style>
    <?php      
            }
            if($_REQUEST[base64_encode('res')] == base64_encode('falta_datos')){
    ?>
                <style>
                    #falt-camp{
                        display:block;
                    }
                </style>
    <?php
            }     
        }
    ?>
    <?php 
        include '../layout/script.php';    
    ?>
</body>

</html>
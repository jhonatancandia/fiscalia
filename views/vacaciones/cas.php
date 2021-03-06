<!DOCTYPE html>
<html lang="en">
<?php 
    include '../layout/head.php';
    session_start();
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
                    <img src="../../public/img/logo.png" alt="Logo index" width="40" height="40">
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                <?php 
                    if(!empty($_SESSION) and $_SESSION['rol'] == "administrador"){
                ?>
                        <li class="nav-item">
                            <a class="nav-link" href="personal">PERSONAL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cargos">CARGOS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="../ruta">RUTA</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="unidad">UNIDAD</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="situacion">SITUACION</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">BENEFICIO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../reportes">REPORTES</a>
                        </li>
                <?php
                    }elseif (!empty($_SESSION) and $_SESSION['rol'] == "usuario") {
                        header('Location: ../ruta');        
                    }else{
                        header('Location: ../../');
                    }
                ?>
            </ul>
            <a href="../../controllers/Usuario.php?peticion=logout" class="navbar-text">SALIR</a>
        </div>
    </nav>
    <!-- Fin menu navegacion -->
    <!-- Alertas -->
    <div class= "alert alert-danger alert-dismissible fade show oculto" id="error-reg" role="alert">
        <span class="mensaje-alerta">Error en registro</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class= "alert alert-warning alert-dismissible fade show oculto" id="falt-camp" role="alert">
        <span class="mensaje-alerta">Debe ingresar todos los campos solicitados</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- Fin de Alertas -->
    <!-- Tabla cas -->
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="col-10" style="padding : 0;">
                <h5 class="text-center">CAS</h5>
                <div class="row mt-5">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar...">
                        </div>
                    </div>
                        <div class="col">
                            <div class="form-group text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalNuevoCas">
                                    NUEVO CAS
                                </button>
                            </div>
                        </div>
                </div>
                    <div class="table-responsive">
                    <table class="table table-hover mt-2">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">CAS</th>
                            <th scope="col" class="text-center">RANGO</th>
                            <th scope="col" class="text-center">DIAS DE VACACION</th>
                            <th scope="col" class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once '../../models/Cas.php';
                        $c = new Cas();
                        $cas = $c->read();
                        foreach ($cas as $cs) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $cs['cas']; ?></td>
                        <td class="text-center"><?= $cs['rango']; ?></td>
                        <td class="text-center"><?= $cs['dias'];?></td>
                        <td class="text-center">
                           <a href="" title="Editar" data-toggle="modal" data-target="#modalEditarCas<?= $cs['cod_cas'];?>"><i
                           class="far fa-edit"></i></a>
                           <a href="" title="Eliminar" data-toggle="modal" data-target="#modalEliminarCas<?= $cs['cod_cas'];?>"><i 
                           class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                        <!-- Modal eliminar cas -->
                        <form action="../../controllers/Cas.php" method="post">
                            <div class="modal fade" tabindex="-1" role="dialog" id="modalEliminarCas<?= $cs['cod_cas'];?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">¿Estas seguro que deseas eliminar?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <input type="hidden" value="<?= $cs['cod_cas'];?>" name="cod_el">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                            <button type="submit" name="eliminar" class="btn btn-success" >Si</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Final Modal eliminar cas -->
                        <!-- Modal editar cas -->
                        <form action="../../controllers/Cas.php" method="post">
                            <div class="modal fade" id="modalEditarCas<?= $cs['cod_cas'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">EDITAR CAS</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                                $cases = new Cas();
                                                $cas = $cases->getDatos($cs['cod_cas']);
                                                foreach ($cas as $caas) {
                                            ?>
                                                    <label for="cas_e">Cas</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="cas_e" value="<?= $caas['cas'] ?>" required>
                                                    </div>
                                                    <label for="inicio_e">Rango</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="rango_e" value="<?= $caas['rango'] ?>" required>
                                                    </div>
                                                    <label for="dias_e">Dias</label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="dias_e" value="<?= $caas['dias'] ?>" required>
                                                    </div>
                                                    <input type="hidden" name="cod_cas" value="<?= $cs['cod_cas'];?>">
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
                        <!-- Final Modal editar cas -->
                    <?php
                        }
                    ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Tabla cas -->
    <!-- Modal registrar nuevo cas -->
    <form action="../../controllers/Cas.php" method="post">
        <div class="modal fade" id="modalNuevoCas" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">NUEVO CAS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="cas" placeholder="Cas" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="rango" placeholder="Rango" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="dias" placeholder="Dias de vacacion" required>
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
    <!-- Final Modal registrar cas -->
    <?php 
        include '../layout/error.php';
        include '../layout/script.php';    
    ?>
</body>

</html>
 
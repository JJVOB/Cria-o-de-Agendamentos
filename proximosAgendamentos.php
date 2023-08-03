<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="normalize.css">
        <link rel="stylesheet" type="text/css" href="estilo.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    </head>
    <body id="fundo">
        <section id="home">
            <div id="caixa_formulario" class="container pt-5 pb-5">
                <div class="row">
                    <h1 class="display-4 text-center col"> PRÓXIMOS AGENDAMENTOS </h1>
                </div>

                <div class="row justify-content-center">
                    <table id="tabela" class="table table-bordereds justify-content-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome do evento</th>
                                <th>Descrição do evento</th>
                                <th>Data de inicio</th>
                                <th>Data final</th>
                                <th>Cliente</th>
                                <th>Ações</th>
                            </tr>

                            <tbody class="table table-bordereds justify-content-center">
                            <?php 
                                require_once 'connection.php';
                                $db = getConnection();

                                $time = time();
                                $sql = "SELECT * FROM consultoria WHERE UNIX_TIMESTAMP(data_final) > $time ";
                                
                                $result = $db->query($sql);
                                $rows = $result->fetchAll();

                                foreach($rows as $key => $value){
                                    if(!empty($value['data_inicial']) && isset($value['data_inicial'])){
                                        $value['data_inicial'] = date('d/m/Y H:i', strtotime($value['data_inicial']));
                                    }

                                    if(!empty($value['data_final']) && isset($value['data_final'])){
                                        $value['data_final'] = date('d/m/Y H:i', strtotime($value['data_final']));
                                    }

                                    echo '
                                        <tr>
                                            <th>' .$value['ID']. '</th>
                                            <td>' .$value['titulo']. '</td>
                                            <td>' .$value['descricao']. '</td>
                                            <td>' .$value['data_inicial']. '</td>
                                            <td>' .$value['data_final']. '</td>
                                            <td>' .$value['cliente']. '</td>
                                            <td> 
                                                <button class="btn btn-primary btn-edit" style="display: inline;" value="'. $value['ID'] .'"data-bs-toggle="modal" data-bs-target="#editarClienteModal"> <i class="fas fa-edit"></i></button>
                                                <button  class="btn btn-danger btn-delete" style="display: inline;" value="'. $value['ID'] .'"data-bs-toggle="modal" data-bs-target="#confirmarExclusaoModal"><i class="fas fa-trash-alt"></i></button>
                                                
                                            </td>
                                        </tr>
                                    ';
                                }
                            ?>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModalLabel">Editar Cliente</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formEdit" method="post" action="editEvento.php">
                            <div class="modal-body">

                                <div>
                                    <div class="form-group row">
                                        <label for="nomeDoEvento" class="col-md-3 col-form-label">Nome do evento</label>
                                        <div class="col-md-9">
                                            <input required="required" class="form-control" type="text" id="nomeDoEventoEdit" placeholder=" Nome do evento " name="nomeDoEventoEdit" maxlength="255">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="descricao" class="col-md-3 col-form-label">Descrição</label>
                                        <div class="col-md-9">
                                            <input required="required" class="form-control" type="text" id="descricaoEdit" placeholder=" Descrição " name="descricaoEdit">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="iniciodata" class="col-md-3 col-form-label">Data de início</label>
                                        <div class="col-md-9">
                                            <input required="required" class="form-control" type="date" id="iniciodataEdit" placeholder=" Data de inicio do evento" name="iniciodataEdit">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="fimdata" class="col-md-3 col-form-label">Data de fim</label>
                                        <div class="col-md-9">
                                            <input required="required" class="form-control" type="date" id="fimdataEdit" placeholder=" Data de termino termino " name="fimdataEdit">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cliente" class="col-md-3 col-form-label">Cliente</label>
                                        <div class="col-md-9">
                                            <input required="required" class="form-control" type="text" id="clienteEdit" placeholder=" Cliente " name="clienteEdit" maxlength="255">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button id="save" type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="confirmarExclusaoModal" tabindex="-1" role="dialog" aria-labelledby="modalConfirmacaoLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalConfirmacaoLabel">Confirmação de Exclusão</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Tem certeza de que deseja excluir este item?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form id="formDelete" action="deleteEvento.php" method="post" style="display: inline;">
                                <button id="delete" type="submit" class="btn btn-danger">Excluir</button>
                            </form> 
                        </div>
                    </div>
                    </div>
            </div>

            <!-- <div class="modal fade" id="confirmarExclusaoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel">Confirmar Exclusão</h1>
                        <button type="button" id="fecharIconeExcluir" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                    <p>Deseja realmente excluir este evento?</p>
                    <input type="hidden" name="idDelete" id="idDelete">
                    </div>
                    <div class="modal-footer">
                    <button type="button" id="fecharExcluir" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="formDelete" action="deleteEvento.php" method="post" style="display: inline;">
                        <button id="delete" type="submit" class="btn btn-danger">Excluir</button>
                    </form> 
                    </div>
                    </div>
                </div>
                </div> -->


        </section>
        <script src="assets/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
    </body>
</html>
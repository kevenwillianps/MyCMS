<?php

/** Importação de classes */
use \vendor\model\Users;

/** Instânciamento de classes */
$Users = new Users();

/** Verifico se existem registros */
if (count($Users->All()) > 0)
{ ?>

    <div class="row animate slideIn">

        <div class="col-md-6">

            <h5 class="card-title">

                <strong>

                    <i class="fas fa-users mr-1"></i>Usuários

                </strong>

                /Listagem/

            </h5>

        </div>

        <div class="col-md-6 text-right">

            <a type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&PRODUCT=GR&TABLE=GUSUARIO&ACTION=G_USUARIO_FORM')">

                <i class="fas fa-list-ul mr-1"></i>Novo Usuário

            </a>

        </div>

        <?php

        /** Listagem de todos os registros */
        foreach ($Users->All() as $keyResultUser => $resultUser){ ?>

            <div class="col-md-3 d-flex mb-3 animate slideIn">

                <div class="card p-3 shadow-sm w-100">

                    <div class="d-flex align-items-center">

                        <div class="w-100">

                            <div class="media">

                                <div class="media-body">

                                    <h5 class="mb-0 mt-0">

                                        <?php echo utf8_encode(@(string)$resultUser->name_first)?> <?php echo utf8_encode(@(string)$resultUser->name_last)?>

                                    </h5>

                                </div>

                            </div>

                            <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">

                                <div class="d-flex flex-column">

                                    <span class="articles">

                                        Publicações

                                    </span>

                                    <span class="number1">

                                        38

                                    </span>

                                </div>

                                <div class="d-flex flex-column">

                                    <span class="followers">

                                        Acessos

                                    </span>

                                    <span class="number2">

                                        <?php echo utf8_encode(@(string)$resultUser->SITUACAO) === 'A' ? 'Ativo' : 'Inativo'?>

                                    </span>

                                </div>

                            </div>

                            <div class="button mt-2 d-flex flex-row align-items-center">

                                <button class="btn btn-sm btn-outline-primary w-100">

                                    <i class="far fa-eye mr-1"></i>Detalhes

                                </button>

                                <button type="button" class="btn btn-sm btn-primary w-100 ml-2" onclick="request('FOLDER=VIEW&PRODUCT=GR&TABLE=GUSUARIO&ACTION=G_USUARIO_FORM&USUARIO_ID=<?php echo utf8_encode(@(int)$resultUser->USUARIO_ID)?>')">

                                    <i class="fas fa-pencil-alt mr-1"></i>Editar

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php }?>

    </div>

    <?php

}else{ ?>

    <div class="card shadow-sm mb-3 animate slideIn">

        <div class="card-body text-center">

            <h1 class="card-title text-center">

                <span class="badge badge-primary">

                    GU-1

                </span>

            </h1>

            <h4 class="card-subtitle text-center text-muted">

                Ainda não foram cadastrados usuários.

            </h4>

            <div class="text-center my-3">

                <img src="image/043-Colosseum.svg" alt="MySupport - Página Não Encontrada" class="img-fluid" width="100">

            </div>

            <a type="button" class="stretched-link text-muted text-decoration-none mt-3" onclick="request('FOLDER=VIEW&TABLE=GUSUARIO&ACTION=G_USUARIO_FORM')">

                Cadastrar

            </a>

        </div>

    </div>

<?php }?>

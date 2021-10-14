<?php

/** Importação de classes */
use \vendor\model\Main;
use \vendor\model\Users;

/** Instânciamento de classes */
$Main = new Main();
$Users = new Users();

/** Operações Iniciais */
$Main->SessionStart();

?>

<div class="row animate slideIn">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-users mr-1"></i>Usuários

            </strong>

            /Listagem/

        </h5>

    </div>

    <?php

    /** Permissão para criar */
    if (!empty($_SESSION['USER_PERMISSIONS']->users['create']))
    {?>

        <div class="col-md-6 text-right">

            <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_FORM')">

                <i class="fas fa-plus-circle mr-1"></i>Adicionar

            </button>

        </div>

    <?php }?>

</div>

<?php
/** Verifico se existem registros */
if (count($Users->All()) > 0)
{ ?>

    <div class="row">

        <?php

        /** Listagem de todos os registros */
        foreach ($Users->All() as $keyResultUser => $resultUser){ ?>

            <form role="form" id="formUsers_<?php echo utf8_encode(@(string)$keyResultUser)?>" class="col-md-3 d-flex mb-3 animate slideIn">

                <div class="card p-3 shadow-sm w-100">

                    <div class="d-flex align-items-center">

                        <div class="w-100">

                            <div class="media">

                                <div class="media-body">

                                    <h5 class="mb-0 mt-0">

                                        <?php echo utf8_encode(@(string)$resultUser->user_id)?> - <?php echo utf8_encode(@(string)$resultUser->name_first)?> <?php echo utf8_encode(@(string)$resultUser->name_last)?>

                                    </h5>

                                </div>

                            </div>

                            <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">

                                <div class="d-flex flex-column">

                                    <span class="articles">

                                        Conteúdo

                                    </span>

                                    <span class="number1">

                                        <?php echo utf8_encode(@(int)$resultUser->quantity_contents)?>

                                    </span>

                                </div>

                                <div class="d-flex flex-column">

                                    <span class="followers">

                                        Vinculados

                                    </span>

                                    <span class="number2">

                                        <?php echo utf8_encode(@(int)$resultUser->quantity_contents_subs)?>

                                    </span>

                                </div>

                            </div>

                            <div class="button mt-2 d-flex flex-row align-items-center">

                                <?php

                                /** Permissão para criar */
                                if (!empty($_SESSION['USER_PERMISSIONS']->users['delete']))
                                {?>

                                    <button type="button" class="btn btn-sm btn-outline-danger w-100" onclick="sendForm('#formUsers_<?php echo utf8_encode(@(string)$keyResultUser)?>')">

                                        <i class="fas fa-fire-alt mr-1"></i>Excluir

                                    </button>

                                <?php }?>

                                <?php

                                /** Permissão para criar */
                                if (!empty($_SESSION['USER_PERMISSIONS']->users['update']))
                                {?>

                                    <button type="button" class="btn btn-sm btn-primary w-100 ml-2" onclick="request('FOLDER=VIEW&TABLE=USERS&ACTION=USERS_FORM&USER_ID=<?php echo utf8_encode(@(int)$resultUser->user_id)?>')">

                                        <i class="fas fa-pencil-alt mr-1"></i>Editar

                                    </button>

                                <?php }?>

                            </div>

                        </div>

                    </div>

                </div>

                <input type="hidden" name="FOLDER" value="ACTION">
                <input type="hidden" name="TABLE" value="USERS">
                <input type="hidden" name="ACTION" value="USERS_DELETE">
                <input type="hidden" name="USER_ID" value="<?php echo utf8_encode(@(int)$resultUser->user_id)?>">

            </form>

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

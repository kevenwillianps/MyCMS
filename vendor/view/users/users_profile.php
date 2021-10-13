<?php

    /** Importação de classes */
    use \vendor\model\Main;
    use \vendor\model\Users;
    use \vendor\controller\users\UsersValidate;

    /** Instânciamento de classes */
    $Main = new Main();
    $Users = new Users();
    $UsersValidate = new UsersValidate();

    /** Operações */
    $Main->SessionStart();

    /** Tratamento dos dados de entrada */
    $UsersValidate->setUserId(@(int)$_SESSION['USER_ID']);

    /** Busca de registro */
    $resultUsers = $Users->GetProfile($UsersValidate->getUserId());

?>

<div class="row animate slideIn">

    <div class="col-md-6">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-users mr-1"></i>Usuários

            </strong>

            /Perfil/

        </h5>

    </div>

</div>

<div class="bg-white shadow-sm rounded overflow-hidden animate slideIn border">

    <div class="px-4 pt-0 pb-4 cover" style="background-image: url('./image/profile_cover.jpg')">

        <div class="media align-items-end profile-head">

            <div class="profile mr-3">

                <a type="button" class="btn btn-outline-light btn-sm btn-block mb-2" onclick="request('FOLDER=VIEW&TABLE=USERS_FILES&ACTION=USERS_FILES_FORM_PROFILE')">

                    Alterar Foto

                </a>

                <?php

                /** Verifico se a imagem esta preenchida */
                if (empty(@(string)$resultUsers->path_profile))
                { ?>

                    <img src="image/profile_perfil.png" alt="keven" width="130" class="rounded mb-2 img-thumbnail">

                <?php }else{ ?>

                    <img src="<?php echo utf8_encode(@(string)$resultUsers->path_profile)?>/<?php echo utf8_encode(@(string)$resultUsers->name)?>" alt="keven" width="130" class="rounded mb-2 img-thumbnail">

                <?php }?>

            </div>

            <div class="media-body mb-5 text-white">

                <h4 class="mt-0 mb-0">

                    <?php echo utf8_encode(@(string)$resultUsers->name_first)?> <?php echo utf8_encode(@(string)$resultUsers->name_last)?> - <i class="fas fa-birthday-cake mr-1"></i><?php echo utf8_encode(date('d/m/Y', @(string)$resultUsers->date_birth))?>

                </h4>

                <p class="mb-4">

                    <cite><i class="fas fa-at mr-1"></i><?php echo utf8_encode(@(string)$resultUsers->email)?></cite>

                </p>

            </div>

        </div>

    </div>

    <div class="bg-light p-4 d-flex justify-content-end text-center">

        <ul class="list-inline mb-0">

            <li class="list-inline-item">

                <h5 class="font-weight-bold mb-0 d-block">215</h5>

                <small class="text-muted">

                    <i class="fas fa-image mr-1"></i>

                    Postagens

                </small>

            </li>

        </ul>

    </div>

    <div class="px-4 mb-3">

        <h5 class="mb-0">

            <strong>Histórico</strong> de Atividades

        </h5>

        <div class="main-card card shadow-sm">

            <div class="card-body">

                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">

                    <?php

                    /** Listagem de Itens */
                    foreach (json_decode($resultUsers->history, true) as $keyResult => $result)
                    { ?>

                        <div class="vertical-timeline-item vertical-timeline-element">

                            <div>

                                <span class="vertical-timeline-element-icon bounce-in">

                                    <i class="badge badge-dot badge-dot-xl <?php echo @(string)$result['class']?>"> </i>

                                </span>

                                <div class="vertical-timeline-element-content bounce-in">

                                    <h4 class="timeline-title">

                                        <?php echo @(string)$result['title']?>

                                    </h4>

                                    <p>

                                        <?php echo @(string)$result['description']?>, <?php echo date('h:m:s', strtotime(@(string)$result['time']))?>

                                    </p>

                                    <span class="vertical-timeline-element-date">

                                        <?php echo date('d/m/y', strtotime(@(string)$result['date']))?>

                                    </span>

                                </div>

                            </div>

                        </div>

                    <?php }?>

                </div>

            </div>

        </div>

    </div>

</div>
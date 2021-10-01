<?php

    /** Importação de classes */
    use vendor\model\Configurations;

    /** Instânciamento de Classes */
    $Configurations = new Configurations();

    /** Busco o registro */
    $resultConfiguration = $Configurations->Get(@(int)$_POST['CONFIGURATION_ID']);

    /** Decodifico as preferencias */
    $resultConfiguration->preferences = (object)json_decode(base64_decode($resultConfiguration->preferences));

?>

<div class="row mt-3">

    <div class="col-md-12">

        <h5 class="card-title">

            <strong>

                <i class="fas fa-cog mr-1"></i>Configurações

            </strong>

            /Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONFIGURATIONS&ACTION=CONFIGURATIONS_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

</div>

<form role="form" id="formConfigurations" class="card shadow-sm animate slideIn">

    <div class="card-body">

        <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">

            <li class="nav-item nav-link-pill mr-1" role="inicio">

                <a class="nav-link active" id="pills-inicio-tab" data-toggle="pill" href="#pills-inicio" role="tab" aria-controls="pills-inicio" aria-selected="false">

                    <i class="fas fa-info mr-1"></i>Inicio

                </a>

            </li>

            <li class="nav-item nav-link-pill mx-1" role="configuracoes">

                <a class="nav-link" id="pills-configuracoes-tab" data-toggle="pill" href="#pills-configuracoes" role="tab" aria-controls="pills-configuracoes" aria-selected="false">

                    <i class="fas fa-cog mr-1"></i>Arquivos

                </a>

            </li>

            <li class="nav-item nav-link-pill mx-1" role="email">

                <a class="nav-link" id="pills-configuracoes-tab" data-toggle="pill" href="#pills-email" role="tab" aria-controls="pills-email" aria-selected="false">

                    <i class="fas fa-at mr-1"></i>Email

                </a>

            </li>

        </ul>

        <div class="tab-content" id="pills-tabContent">

            <div class="tab-pane fade active show" id="pills-inicio" role="tabpanel" aria-labelledby="pills-inicio-tab">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="title">

                                Título:

                            </label>

                            <input type="text" class="form-control" id="title" name="title" value="<?php echo utf8_encode(@(string)$resultConfiguration->title)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="copyright">

                                Copyright:

                            </label>

                            <input type="text" class="form-control" id="copyright" name="copyright" value="<?php echo utf8_encode(@(string)$resultConfiguration->copyright)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="author">

                                Autor:

                            </label>

                            <input type="text" class="form-control" id="author" name="author" value="<?php echo utf8_encode(@(string)$resultConfiguration->author)?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="description">

                                Descrição:

                            </label>

                            <input type="text" class="form-control" id="description" name="description" value="<?php echo utf8_encode(@(string)$resultConfiguration->description)?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="keywords">

                                Palavras Chaves:

                            </label>

                            <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo utf8_encode(@(string)$resultConfiguration->keywords)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="twitter_user">

                                Usuário Twitter:

                            </label>

                            <input type="text" class="form-control" id="twitter_user" name="twitter_user" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->twitter_user)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="facebook_id">

                                Facebook ID:

                            </label>

                            <input type="text" class="form-control" id="facebook_id" name="facebook_id" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->facebook_id)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="url">

                                URL do Site:

                            </label>

                            <input type="text" class="form-control" id="url" name="url" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->url)?>">

                        </div>

                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="pills-configuracoes" role="tabpanel" aria-labelledby="pills-configuracoes-tab">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_path_contents">

                                Caminho dos Arquivos <strong>Conteúdo</strong>:

                            </label>

                            <input type="text" class="form-control" id="file_path_contents" name="file_path_contents" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->file_path_contents)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_path_contents_subs">

                                Caminho dos Arquivos <strong>Sub-Conteúdo</strong>:

                            </label>

                            <input type="text" class="form-control" id="file_path_contents_subs" name="file_path_contents_subs" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->file_path_contents_subs)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_path_users_files">

                                Caminho dos Arquivos de <strong>Usuários</strong>:

                            </label>

                            <input type="text" class="form-control" id="file_path_users_files" name="file_path_users_files" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->file_path_users_files)?>">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="file_name">

                                Nome dos Arquivos:

                            </label>

                            <input type="text" class="form-control" id="file_name" name="file_name" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->file_name)?>">

                        </div>

                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="pills-email" role="tabpanel" aria-labelledby="pills-email-tab">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="email_host">

                                Host:

                            </label>

                            <input type="text" class="form-control" id="email_host" name="email_host" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->email_host)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="email_username">

                                Usuário:

                            </label>

                            <input type="text" class="form-control" id="email_username" name="email_username" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->email_username)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="email_port">

                                Port:

                            </label>

                            <input type="text" class="form-control" id="email_port" name="email_port" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->email_port)?>">

                        </div>

                    </div>

                    <div class="col-md-12">

                        <div class="form-group">

                            <label for="email_password">

                                Senha:

                            </label>

                            <input type="text" class="form-control" id="email_password" name="email_password" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->email_password)?>">

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="form-group mb-0 text-right">

            <button type="button" class="btn btn-primary" onclick="sendForm('#formConfigurations')">

                <i class="far fa-save mr-1"></i>Salvar

            </button>

        </div>

    </div>

    <input type="hidden" name="FOLDER" value="ACTION">
    <input type="hidden" name="TABLE" value="CONFIGURATIONS">
    <input type="hidden" name="ACTION" value="CONFIGURATIONS_SAVE">
    <input type="hidden" name="configuration_id" value="<?php echo utf8_encode(@(int)$resultConfiguration->configuration_id)?>">

</form>

<script type="text/javascript">

    /** Caixa de seleção customizada */
    $('select').selectpicker();

</script>
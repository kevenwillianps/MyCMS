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

            <li class="nav-item nav-link-pill mx-1" role="imagens">

                <a class="nav-link" id="pills-imagens-tab" data-toggle="pill" href="#pills-imagens" role="tab" aria-controls="pills-imagens" aria-selected="false">

                    <i class="far fa-file-image mr-1"></i>Imagens

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

                </div>

            </div>

            <div class="tab-pane fade" id="pills-configuracoes" role="tabpanel" aria-labelledby="pills-configuracoes-tab">

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="file_path_contents">

                                Caminho dos Arquivos <strong>Conteúdo</strong>:

                            </label>

                            <input type="text" class="form-control" id="file_path_contents" name="file_path_contents" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->file_path_contents)?>">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <label for="file_path_contents_subs">

                                Caminho dos Arquivos <strong>Sub-Conteúdo</strong>:

                            </label>

                            <input type="text" class="form-control" id="file_path_contents_subs" name="file_path_contents_subs" value="<?php echo utf8_encode(@(string)$resultConfiguration->preferences->file_path_contents_subs)?>">

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

            <div class="tab-pane fade" id="pills-imagens" role="tabpanel" aria-labelledby="pills-imagens-tab">

                <h6 class="text-muted">

                    <i class="fas fa-info mr-1"></i>Imagens <strong>Redimensionadas:</strong>

                </h6>

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_resize_height">

                                Altura:

                            </label>

                            <input type="number" class="form-control" id="file_resize_height" name="file_resize_height" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_resize_height)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_resize_width">

                                Largura

                            </label>

                            <input type="number" class="form-control" id="file_resize_width" name="file_resize_width" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_resize_width)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_resize_quality">

                                Qualidade:

                            </label>

                            <input type="number" class="form-control" id="file_resize_quality" name="file_resize_quality" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_resize_quality)?>">

                        </div>

                    </div>

                </div>

                <h6 class="text-muted">

                    <i class="fas fa-info mr-1"></i>Imagens para <strong>Miniatura:</strong>

                </h6>

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_thumbnail_height">

                                Altura:

                            </label>

                            <input type="number" class="form-control" id="file_thumbnail_height" name="file_thumbnail_height" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_thumbnail_height)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_thumbnail_width">

                                Largura

                            </label>

                            <input type="number" class="form-control" id="file_thumbnail_width" name="file_thumbnail_width" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_thumbnail_width)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_thumbnail_quality">

                                Qualidade:

                            </label>

                            <input type="number" class="form-control" id="file_thumbnail_quality" name="file_thumbnail_quality" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_thumbnail_quality)?>">

                        </div>

                    </div>

                </div>

                <h6 class="text-muted">

                    <i class="fas fa-info mr-1"></i>Imagens para <strong>Perfil:</strong>

                </h6>

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_profile_height">

                                Altura:

                            </label>

                            <input type="number" class="form-control" id="file_profile_height" name="file_profile_height" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_profile_height)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_profile_width">

                                Largura

                            </label>

                            <input type="number" class="form-control" id="file_profile_width" name="file_profile_width" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_profile_width)?>">

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                            <label for="file_profile_quality">

                                Qualidade:

                            </label>

                            <input type="number" class="form-control" id="file_profile_quality" name="file_profile_quality" value="<?php echo utf8_encode(@(int)$resultConfiguration->preferences->file_profile_quality)?>">

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
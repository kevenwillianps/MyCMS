<?php

/** Importação de classes */
use vendor\model\ContentCategories;

/** Instânciamento de Classes */
$ContentCategories = new ContentCategories();

/** Busco o Pedido */
$resultContentCategory = $ContentCategories->Get(@(int)$_POST['CONTENT_CATEGORY_ID']);

?>

<div class="row animate slideIn">

    <div class="col-md-12">

        <h5>

            <strong>

                <i class="fas fa-cog mr-1"></i>Categoria

            </strong>

            /Detalhes/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONTENT_CATEGORIES&ACTION=CONTENT_CATEGORIES_DATAGRID')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card">

            <div class="card-body">

                <div class="card shadow-sm mb-3">

                    <div class="card-body bg-gray">

                        <div class="row grid-divider">

                            <div class="col-md">

                                <ul class="list-unstyled mb-0">

                                    <li class="media">

                                        <div class="media-body">

                                            <h6 class="mt-0 mb-0">

                                                Nome:

                                            </h6>

                                            <h5>

                                                <strong>

                                                    <?php echo utf8_encode(@(string)$resultContentCategory->name)?>

                                                </strong>

                                            </h5>

                                        </div>

                                    </li>

                                </ul>

                            </div>

                            <div class="col-md">

                                <ul class="list-unstyled mb-0">

                                    <li class="media">

                                        <div class="media-body">

                                            <h6 class="mt-0 mb-0">

                                                Data de Cadastro:

                                            </h6>

                                            <h5>

                                                <strong>

                                                    <?php echo utf8_encode(date('d/m/Y', strtotime(@(string)$resultContentCategory->date)))?>

                                                </strong>

                                            </h5>

                                        </div>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">

                    <?php

                    /** Listagem de Itens */
                    foreach (json_decode(base64_decode($resultContentCategory->history), true) as $keyResult => $result)
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
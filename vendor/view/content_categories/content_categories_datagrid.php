<?php

/** Importação de classes */
use \vendor\model\Main;
use vendor\model\ContentCategories;

/** Instânciamento de Classes */
$Main = new Main();
$ContentCategories = new ContentCategories();

/** Operações Iniciais */
$Main->SessionStart();

?>

<div class="row mt-3 animate slideIn">

    <div class="col-md-6">

        <h5>

            <strong>

                <i class="fas fa-filter mr-1"></i>Categoria

            </strong>

            /Listagem/

        </h5>

    </div>

    <?php

    /** Permissão para criar */
    if (!empty($_SESSION['USER_PERMISSIONS']->content_categories['create']))
    {?>

        <div class="col-md-6 text-right">

            <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=CONTENT_CATEGORIES&ACTION=CONTENT_CATEGORIES_FORM')">

                <i class="fas fa-plus-circle mr-1"></i>Adicionar

            </button>

        </div>

    <?php }?>

    <?php

    /** Verifico se existem registros */
    if (count($ContentCategories->All()) === 0)
    { ?>

        <div class="col-md-2 mx-auto mt-3">

            <img src="image/desert.svg" alt="" class="img-fluid">

        </div>

    <?php }else{ ?>

        <div class="col-md-12 mt-1">

            <table class="table table-bordered table-borderless table-hover bg-white rounded shadow-sm">

                <thead>

                    <tr>

                        <th scope="col" class="text-center">

                            #

                        </th>

                        <th scope="col">

                            Nome

                        </th>

                        <th scope="col">

                            Descrição

                        </th>

                        <th scope="col" class="text-center">

                            Operações

                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php

                /** Listagem de Todos os Registros */
                foreach ($ContentCategories->All() as $keyResultContentCategories => $resultContentCategories)
                { ?>

                    <tr class="border-top">

                        <td class="text-center">

                            <?php echo utf8_encode(@(int)$resultContentCategories->content_category_id)?>

                        </td>

                        <td>

                            <?php echo utf8_encode(@(string)$resultContentCategories->name)?>

                        </td>

                        <td>

                            <?php echo utf8_encode(@(string)$resultContentCategories->description)?>

                        </td>

                        <td class="text-center">

                            <div class="btn-group dropleft">

                                <button class="btn btn-primary dropdown-toggle" type="button" id="buttonDropdown_<?php echo utf8_encode($keyResultContentCategories)?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <i class="fas fa-cog"></i>

                                </button>

                                <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">

                                    <?php

                                    /** Permissão para criar */
                                    if (!empty($_SESSION['USER_PERMISSIONS']->content_categories['update']))
                                    {?>

                                        <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=CONTENT_CATEGORIES&ACTION=CONTENT_CATEGORIES_FORM&CONTENT_CATEGORY_ID=<?php echo utf8_encode(@(int)$resultContentCategories->content_category_id)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="fas fa-pencil-alt"></i>

                                        </span>

                                            Editar

                                        </a>

                                    <?php }?>

                                    <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=CONTENT_CATEGORIES&ACTION=CONTENT_CATEGORIES_DETAIL&CONTENT_CATEGORY_ID=<?php echo utf8_encode(@(int)$resultContentCategories->content_category_id)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="far fa-eye"></i>

                                        </span>

                                        Detalhes

                                    </a>

                                    <?php

                                    /** Permissão para criar */
                                    if (!empty($_SESSION['USER_PERMISSIONS']->content_categories['delete']))
                                    {?>

                                        <a type="button" class="dropdown-item" onclick="sendForm('#formSituationDelete_<?php echo utf8_encode(@(int)$keyResultContentCategories)?>')">

                                        <span class="badge badge-danger mr-1">

                                            <i class="fas fa-fire-alt"></i>

                                        </span>

                                            Excluir

                                        </a>

                                    <?php }?>

                                </div>

                                <form role="form" id="formContentCategoriesDelete_<?php echo utf8_encode(@(int)$keyResultContentCategories)?>">

                                    <input type="hidden" name="FOLDER" value="ACTION">
                                    <input type="hidden" name="TABLE" value="CONTENT_CATEGORIES">
                                    <input type="hidden" name="ACTION" value="CONTENT_CATEGORIES_DELETE">
                                    <input type="hidden" name="content_category_id" value="<?php echo utf8_encode(@(int)$resultSituation->content_category_id)?>">

                                </form>

                            </div>

                        </td>

                    </tr>

                <?php }?>

                </tbody>

            </table>

        </div>

    <?php }?>

</div>
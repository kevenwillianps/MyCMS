<?php

/** Importação de classes */
use vendor\model\Highlighters;

/** Instânciamento de Classes */
$Highlighters = new Highlighters();

?>

<div class="row mt-3 animate slideIn">

    <div class="col-md-6">

        <h5>

            <strong>

                <i class="fas fa-highlighter mr-1"></i>Marcadores

            </strong>

            /Listagem/

        </h5>

    </div>

    <div class="col-md-6 text-right">

        <button class="btn btn-primary btn-sm" type="button" onclick="request('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_FORM')">

            <i class="fas fa-plus-circle mr-1"></i>Adicionar

        </button>

    </div>

    <?php

    /** Verifico se existem registros */
    if (count($Highlighters->All()) === 0)
    { ?>

        <div class="col-md-12">

            <div class="alert alert-warning border-warning shadow-sm" role="alert">

                <h4 class="alert-heading">

                    <strong>

                        Ooops!

                    </strong>

                </h4>

                <p>

                    Nõ foram localizados registros

                </p>

            </div>

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
                foreach ($Highlighters->All() as $keyResultHighlighters => $resultHighlighters)
                { ?>

                    <tr class="border-top">

                        <td class="text-center">

                            <?php echo utf8_encode(@(int)$resultHighlighters->highlighter_id)?>

                        </td>

                        <td>

                            <?php echo utf8_encode(@(string)$resultHighlighters->name)?>

                        </td>

                        <td>

                            <?php echo utf8_encode(@(string)$resultHighlighters->description)?>

                        </td>

                        <td class="text-center">

                            <div class="btn-group dropleft">

                                <button class="btn btn-primary dropdown-toggle" type="button" id="buttonDropdown_<?php echo utf8_encode($keyResultHighlighters)?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <i class="fas fa-cog"></i>

                                </button>

                                <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">

                                    <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_FORM&HIGHLIGHTER_ID=<?php echo utf8_encode(@(int)$resultHighlighters->highlighter_id)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="fas fa-pencil-alt"></i>

                                        </span>

                                        Editar

                                    </a>

                                    <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=HIGHLIGHTERS&ACTION=HIGHLIGHTERS_DETAIL&HIGHLIGHTER_ID=<?php echo utf8_encode(@(int)$resultHighlighters->highlighter_id)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="far fa-eye"></i>

                                        </span>

                                        Detalhes

                                    </a>

                                    <a type="button" class="dropdown-item" onclick="sendForm('#formSituationDelete_<?php echo utf8_encode(@(int)$keyResultHighlighters)?>')">

                                        <span class="badge badge-danger mr-1">

                                            <i class="fas fa-fire-alt"></i>

                                        </span>

                                        Excluir

                                    </a>

                                </div>

                                <form role="form" id="formSituationDelete_<?php echo utf8_encode(@(int)$keyResultHighlighters)?>">

                                    <input type="hidden" name="FOLDER" value="ACTION">
                                    <input type="hidden" name="TABLE" value="HIGHLIGHTERS">
                                    <input type="hidden" name="ACTION" value="HIGHLIGHTERS_DELETE">
                                    <input type="hidden" name="highlighter_id" value="<?php echo utf8_encode(@(int)$resultHighlighters->highlighter_id)?>">

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
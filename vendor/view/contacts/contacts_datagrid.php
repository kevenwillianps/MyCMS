<?php

/** Importação de classes */
use vendor\model\Contacts;

/** Instânciamento de Classes */
$Contacts = new Contacts();

?>

<div class="row mt-3 animate slideIn">

    <div class="col-md-6">

        <h5>

            <strong>

                <i class="fas fa-inbox mr-1"></i>Mensagens

            </strong>

            /Listagem/

        </h5>

    </div>

    <?php

    /** Verifico se existem registros */
    if (count($Contacts->All()) === 0)
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

                        <th scope="col" class="text-center">

                            Operações

                        </th>

                    </tr>

                </thead>

                <tbody>

                <?php

                /** Listagem de Todos os Registros */
                foreach ($Contacts->All() as $keyResultContact => $resultContact)
                { ?>

                    <tr class="border-top">

                        <td class="text-center">

                            <?php echo utf8_encode(@(int)$resultContact->contact_id)?>

                        </td>

                        <td>

                            <?php echo utf8_encode(@(string)$resultContact->name)?>

                        </td>

                        <td class="text-center">

                            <div class="btn-group dropleft">

                                <button class="btn btn-primary dropdown-toggle" type="button" id="buttonDropdown_<?php echo utf8_encode($keyResultContact)?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <i class="fas fa-cog"></i>

                                </button>

                                <div class="dropdown-menu shadow-sm" aria-labelledby="dropdownMenuButton">

                                    <a type="button" class="dropdown-item" onclick="request('FOLDER=VIEW&TABLE=SITUATIONS&ACTION=SITUATIONS_DETAIL&SITUATION_ID=<?php echo utf8_encode(@(int)$resultContact->contact_id)?>')">

                                        <span class="badge badge-primary mr-1">

                                            <i class="far fa-eye"></i>

                                        </span>

                                        Detalhes

                                    </a>

                                </div>

                            </div>

                        </td>

                    </tr>

                <?php }?>

                </tbody>

            </table>

        </div>

    <?php }?>

</div>
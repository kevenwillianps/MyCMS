<?php

/** Importação de classes */
use vendor\model\ContentsSubs;

/** Instânciamento de Classes */
$ContentsSubs = new ContentsSubs();

/** Busco o Pedido */
$resultContentSub = $ContentsSubs->Get(@(int)$_POST['CONTENT_SUB_ID']);

?>

<div class="row animate slideIn">

    <div class="col-md-12">

        <h5>

            <strong>

                <i class="far fa-clipboard mr-1"></i>Conteúdo

            </strong>

            /Vinculados/Formulário/

            <button type="button" class="btn btn-primary btn-sm" onclick="request('FOLDER=VIEW&TABLE=CONTENTS_SUBS&ACTION=CONTENTS_SUBS_DATAGRID&CONTENT_ID=<?php echo utf8_encode(@(int)$_POST['CONTENT_ID'])?>')">

                <i class="fas fa-chevron-left mr-1"></i>Voltar

            </button>

        </h5>

    </div>

    <div class="col-md-12">

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="card shadow-sm mb-3">

                    <div class="card-body bg-gray">

                        <div class="row grid-divider">

                            <div class="col-md">

                                <ul class="list-unstyled mb-0">

                                    <li class="media">

                                        <div class="media-body">

                                            <h6 class="mt-0 mb-0">

                                                Título:

                                            </h6>

                                            <h5>

                                                <strong>

                                                    <?php echo utf8_encode(@(string)$resultContentSub->title)?>

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

                                                    <?php echo utf8_encode(date('d/m/Y', strtotime(@(string)$resultContentSub->date)))?>

                                                </strong>

                                            </h5>

                                        </div>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

                <canvas id="myChartMensal"></canvas>

                <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">

                    <?php

                    /** Listagem de Itens */
                    foreach (json_decode(base64_decode($resultContentSub->history), true) as $keyResult => $result)
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

                                        <?php echo @(string)$result['description']?>,
                                        <?php echo date('h:m:s', strtotime(@(string)$result['time']))?>.
                                        País: <strong><?php echo @(string)$result['country']?></strong>,
                                        estado: <strong><?php echo @(string)$result['state']?></strong>,
                                        cidade: <strong><?php echo @(string)$result['city']?></strong>,
                                        latitude: <strong><?php echo @(string)$result['latitude']?></strong>,
                                        longitude: <strong><?php echo @(string)$result['longitude']?></strong>

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

<script type="text/javascript">

    var ctxMensal = document.getElementById('myChartMensal').getContext('2d');
    var myChartMensal = new Chart(ctxMensal, {
        type: 'line',
        data: {
            labels: [<?php foreach (json_decode(base64_decode($resultContentSub->history), true) as $keyResult => $result){

                echo "'" . 'Data ' . $result->date . "',";

            }?>],
            datasets: [{
                label: 'serviços',
                data: [<?php  foreach (json_decode(base64_decode($resultContentSub->history), true) as $keyResult => $result){

                    echo @(int)$result->date . ',';

                }?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    display: false,
                },
                title: {
                    display: false,
                    text: 'Chart.js Line Chart'
                }
            }
        }
    });

</script>
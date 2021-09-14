/** Grupo de variáveis que guardar os dados dos campos do arquivo */
const inputs_file = new Object();
inputs_file.descricao = [];
inputs_file.base64 = [];

/** Limpo os dados utilizados anteriormente */
function clearData() {

    inputs_file.descricao = [];
    inputs_file.base64 = []

}

/** Preparo o arquivo para envio */
function prepareUploadFile(origin) {

    /** Limpo os dados utilizados anteriormente */
    clearData();

    /** Preparo o envio de múltiplos arquivos */
    for (let i = 0; i < $(origin)[0].files.length; i++) {

        /** Instâncimento de objeto para ler o conteúdo do arquivo */
        let fileReader = new FileReader();

        /** Leio o conteúdo do arquivo **/
        fileReader.readAsDataURL($(origin)[0].files[i]);

        /** Pego o nome real do arquivo */
        inputs_file.descricao.push('mycms_' + (btoa(Math.random() * 10000)) + '.' + ($(origin)[0].files[i].name.substring($(origin)[0].files[i].name.indexOf('.') + 1)));

        /** Trasnformar o arquivo em base64 */
        fileReader.onload = (e) => {

            /** Particionar o base64 em Array **/
            let localString = e.target.result.split(',')[1];
            let start = 0;
            let end = 2097152;
            let localArray = Array();
            let part = null;

            /** Executo de acordo com o tamanho do base64 */
            for (let j = 0; j < localString.length; j++) {

                /** Preencho selecionando o que esta entre o valor inicial e final */
                part = localString.substring(start, end);

                /** Verifico se cheguei ao final do base64, senão preencho as variáveis */
                if (part && part !== null) {

                    /** Coloca o trecho do base64 na última posição da array */
                    localArray.push(part);

                    /** Crio um novo intervalo de valores */
                    start = end;
                    end = end + 2097152;

                }

            }

            /** Informo minha array de base64 particionada */
            inputs_file.base64[i] = localArray;

        };

    }

}

/** Preparo a requisição para envio */
function prepareForm(form) {

    /** Envio as requisições de acordo com o tamanho da array **/
    for (let i = 0; i < inputs_file.base64.length; i++) {

        for (let j = 0; j < inputs_file.base64[i].length; j++) {

            sendFile(form, inputs_file.descricao[i], inputs_file.base64[i][j], inputs_file.base64[i].length, j)

        }

    }

}

/** Envio da requisição */
function sendFile(form, descricao, base64, tamanho, ponteiro) {

    $.ajax({

        url: Server + 'router.php',
        type: 'post',
        dataType: 'json',
        async: false,
        data: $(form).serialize() + '&descricao=' + descricao + '&arquivo=' + base64 + '&tamanho=' + tamanho + '&ponteiro=' + ponteiro,

        /** Antes de enviar */
        beforeSend: function () {

            /** Construo o bloqueio de página */
            blockPage(true, '', null, '', '', 'random', 'circle', 'md');

        },

        /** Caso tenha sucesso */
        success: function (response) {

            /** Verifico o retorno */
            switch (response.cod) {

                /** Verifica se é redirecionamento */
                case 200:

                    /** Redireciono a página */
                    request(response.redirect);
                    break;

                /** Sucesso */
                case 3:

                    /** Redireciono a página */
                    console.log('Sucesso');
                    break;

            }

        },

        /** Caso tenha falha */
        error: function (xhr, ajaxOptions, thrownError) {

            let messages = Array();
            messages.push([null, xhr.status + ' - ' + ajaxOptions + ' - ' + thrownError]);

            /** Abro um popup com os dados **/
            openPopup('Atenção', messages);

        },

        complete: function () {

            /** Delay de resposta */
            window.setTimeout(() => {

                /** Remoção do Bloqueio de Página */
                blockPage(false);

            }, 500);

        }

    });

}
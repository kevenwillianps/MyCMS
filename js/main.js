/** Pega a url atual**/
let Server = null;

/** Editor de Texto */
let ckeditor = null;

/** Inicio o editor de texto */
function loadCkeditor() {

    /** Listo todos os editores de texto */
    $('.editor').each(function () {

        /** Pego o nome do campo */
        let id = $(this).attr('id');

        ClassicEditor

            .create(document.querySelector('#' + id), {})
            .then(editor => {
                ckeditor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });

    })

}

/** Coloco a página no topo */
function scrollToTop() {

    $(window).scrollTop(0);

}

/** Carrego o arquivo de configurações */
$.getJSON("config.json", function (data) {

    /** Carrego o url do servidor */
    Server = data['url_aplicacao'];

});

/** Envio uma requisição para o backend */
function sendForm(form, editor) {

    /** Preparo o formulário para envio */
    $.ajax({

        url: Server + "router.php",
        type: "post",
        dataType: "json",
        data: editor === 'S' ? $(form).serialize() + '&' + $('.editor').attr('id') + '=' + encodeURIComponent(ckeditor.getData()) : $(form).serialize(),

        /** Antes de enviar */
        beforeSend: function () {

            /** Construo o bloqueio de página */
            blockPage(true, '', null, '', '', 'random', 'circle', 'md');

        },

        /** Caso tenha sucesso */
        success: function (response) {

            /** Legenda(s)
             *
             * Code 202 Accepted
             * Code 99 Logout
             * Code 98 Open Document
             * Code 200 OK
             *
             * /

             /** Verifico o tipo de resposta */
            switch (response.cod) {

                /** Verifico se a autenticação foi bem sucedida*/
                case 202:

                    /** Redireciono a página */
                    location.href = Server;
                    break;

                /** Verifica se é logout */
                case 99:

                    /** Redireciono a página */
                    location.href = Server;
                    break;

                /** Verifica se é redirecionamento */
                case 200:

                    /** Redireciono a página */
                    request(response.redirect);
                    break;

                /** Verifica se é apenas uma mensagem popup */
                default:

                    /** Abro um popup com os dados **/
                    modalPage(true, 0, 0, response.title, response.message, '', 'alert', '', true);
                    break;

            }

        },

        /** Caso tenha falha */
        error: function (xhr, ajaxOptions, thrownError) {

            /** Abro um popup com os dados **/
            modalPage(true, 0, 0,  xhr.status + ' - ' + ajaxOptions, thrownError, '', 'alert', '', true);

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

/** Função para carregar páginas */
function request(data) {

    /** Preparo o formlário para envio */
    $.ajax({

        url: Server + 'router.php',
        type: 'post',
        dataType: 'json',
        data: data,

        /** Antes de enviar */
        beforeSend: function () {

            /** Construo o bloqueio de página */
            blockPage(true, '', null, '', '', 'random', 'circle', 'md');

        },

        /** Caso tenha sucesso */
        success: function (response) {

            /** Legenda(s)
             *
             * Code 202 Accepted
             * Code 99 Logout
             * Code 98 Open Document
             * Code 200 OK
             *
             * /

             /** Verifico o retorno */
            switch (response.cod) {

                case 0:

                    scrollToTop();
                    $('#sidebar').html(response.menu);
                    $('#page-wrapper').html(response.data);
                    break;

                default:

                    /** Abro um popup com os dados **/
                    modalPage(true, 0, 0, response.title, response.message, '', 'alert', '', true);
                    break;

            }

        },

        /** Caso tenha falha */
        error: function (xhr, ajaxOptions, thrownError) {

            /** Abro um popup com os dados **/
            modalPage(true, 0, 0,  xhr.status + ' - ' + ajaxOptions, thrownError, '', 'alert', '', true);

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
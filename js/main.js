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

/** Remoção do Alvo Desejado */
function removeElement(target) {

    /** Remoção do elemento desejado */
    $(target).remove();

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

/** Excluir Modal */
function destroyModal(name) {

    $(name).on('hidden.bs.modal', function () {

        $(name).remove();

    });

}

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

                /** Verifica se é visualização de documento */
                case 98:

                    /** Redireciono a página */
                    modalDocument('Etiqueta', response.path, response.pedido_id);
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

                /** Verifica se é visualização de documento */
                case 98:

                    /** Redireciono a página */
                    modalDocument('Etiqueta', response.path, response.pedido_id);
                    break;

                /** Verifica se é logout */
                case 99:

                    /** Redireciono a página */
                    location.href = Server;
                    break;

                default:

                    /** Cancela o block page */
                    blockPage(false);

                    /** Abro um popup com os dados **/
                    modalPage(true, 0, 0, response.title, response.message, '', 'alert', '', true);
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

function openPopup(title, message) {

    /** Oculto o popup anterior **/
    $('#modalSendForm').modal('dispose');
    $('#modalSendForm').remove();
    $('.modal-backdrop').remove();
    $('nav').removeAttr('style');
    $('footer').removeAttr('style');

    let div = '<div class="modal hide fade in shadow-sm" id="modalPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">';
    div += '	<div class="modal-dialog">';
    div += '		<div class="modal-contents">';
    div += '			<div class="modal-header">';
    div += '                <h5 class="modal-title" id="myModalLabel">' + title + '</h5>';
    div += '                <button type="button" class="close" data-dismiss="modal" onclick="destroyModal(\'#modalPopUp\')">&times;</button>';
    div += '            </div>';
    div += '            <div class="modal-body text-break text-justify">';
    div += '            <ul class="list-unstyled">';
    for (let i = 0; i < message.length; i++) {
        div += '                <li class="media">';
        div += '                    <div class="media-body">';
        div += '                        ' + message[i][1];
        div += '                    </div>';
        div += '                </li>';
    }
    div += '            </ul>';
    div += '            </div>';
    div += '            <div class="modal-footer">';
    div += '                <button type="button" class="btn btn-danger text-white" data-dismiss="modal" onclick="destroyModal(\'#modalPopUp\')"><i class="far fa-times-circle mr-1"></i>Fechar</button>';
    div += '            </div>';
    div += '        </div>';
    div += '    </div>';
    div += '</div>';

    /** Carrego o popup **/
    $('body').append(div);

    /** Abro o popup **/
    $('#modalPopUp').modal('show');

}

/** Modal de Confirmação */
function modalConfirm(title, message, form) {

    /** Estrutura Html */
    let div = '<div class="modal hide fade in shadow-sm" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">';
    div += '	<div class="modal-dialog">';
    div += '		<div class="modal-contents">';
    div += '			<div class="modal-header">';
    div += '                <h5 class="modal-title" id="myModalLabel">' + title + '</h5>';
    div += '                <button type="button" class="close" data-dismiss="modal" onclick="destroyModal(\'#modalConfirm\')">&times;</button>';
    div += '            </div>';
    div += '            <div class="modal-body text-break">';
    div += message;
    div += '                <div class="row mt-3 pt-3 border-top">';
    div += '                    <div class="col-md-6 text-left">';
    div += '                        <button type="button" class="btn btn-danger text-white" data-dismiss="modal" onclick="destroyModal(\'#modalConfirm\')"><i class="far fa-times-circle mr-1"></i>Fechar</button>';
    div += '                    </div>';
    div += '                    <div class="col-md-6 text-right">';
    div += '                        <button type="button" class="btn btn-primary text-white" data-dismiss="modal" onclick="sendForm(\'' + form + '\')"><i class="fas fa-running mr-1"></i>Continuar</button>';
    div += '                    </div>';
    div += '                </div>';
    div += '            </div>';
    div += '        </div>';
    div += '    </div>';
    div += '</div>';

    /** Carrego o popup **/
    $('body').append(div);

    /** Abro o popup **/
    $('#modalConfirm').modal('show');

}

/** Modal de Documento */
function modalDocument(title, path, pedido_id) {

    let div = '<div class="modal hide fade in shadow-sm" id="modalDocument" tabindex="-1" role="dialog" aria-labelledby="modalDocument" aria-hidden="true" data-backdrop="static">';
    div += '	<div class="modal-dialog">';
    div += '		<div class="modal-contents">';
    div += '			<div class="modal-header">';
    div += '                <h5 class="modal-title" id="myModalLabel">' + title + '</h5>';
    div += '                <button type="button" class="close" data-dismiss="modal" onclick="destroyModal(\'#modalDocument\')">&times;</button>';
    div += '            </div>';
    div += '            <div class="modal-body text-break text-justify">';
    div += '                <object data="' + Server + path + '" type="application/pdf" class="embed-responsive embed-responsive-16by9 shadow-sm rounded border" style="height: 400px">';
    div += '                    <embed src="' + Server + path + '" type="application/pdf" class="embed-responsive-item shadow-sm rounded border"/>';
    div += '                </object>';
    div += '            </div>';
    if (pedido_id > 0) {
        div += '            <div class="modal-footer">';
        div += '                <button type="button" class="btn btn-danger text-white" data-dismiss="modal" onclick="request(\'FOLDER=VIEW&PRODUCT=TN&TABLE=TSERVICOPEDIDO&ACTION=T_SERVICO_PEDIDO_FORM&SERVICO_PEDIDO_ID=' + pedido_id + '\')"><i class="far fa-times-circle mr-1"></i>Fechar</button>';
        div += '            </div>';
    }
    else {
        div += '            <div class="modal-footer">';
        div += '                <button type="button" class="btn btn-danger text-white" data-dismiss="modal" onclick="destroyModal(\'#modalDocument\')"><i class="far fa-times-circle mr-1"></i>Fechar</button>';
        div += '            </div>';
    }
    div += '        </div>';
    div += '    </div>';
    div += '</div>';

    /** Carrego o popup **/
    $('body').append(div);

    /** Abro o popup **/
    $('#modalDocument').modal('show');

}
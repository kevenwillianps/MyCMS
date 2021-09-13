/** Informo que o campo esta inválido */
function addInvalidInput(data) {

    /** Parâmetros de entrada */
    let _data = data;

    /** Percorro todos os campos do meu formulário */
    for (let i = 0; i < _data.length; i++)
    {

        /** Adiciono o classe de inválido */
        $('#' + _data[i][0]).addClass('is-invalid');

    }

}

/** Removo o campo inválido */
function removeInvalidInput() {

    /** Pego todos os campos do formulário */
    let data = listInputs();

    /** Percorro todos os campos do meu formulário */
    for (let i = 0; i < data.length; i++)
    {

        /** Removo o classe de inválido */
        $('#' + data[i]).removeClass('is-invalid');

    }

}

/** Função para desativar todos os campos */
function disableInputs() {

    /** Pego todos os campos do formulário */
    let data = listInputs();

    /** Bloqueio todos os campos */
    for (let i = 0; i <= data.length; i++)
    {

        /** Bloqueio os campos */
        $('#' + data[i]).attr('readonly', 'readonly');

    }

}

/** Função para ativar todos os campos */
function enableInputs() {

    /** Pego todos os campos do formulário */
    let data = listInputs();

    /** Habilito todos os campos */
    for (let i = 0; i <= data.length; i++)
    {

        /** Ativo os campos */
        $('#' + data[i]).removeAttr('readonly');

    }

}

/** Função para pegar todos os campos de um formulário */
function listInputs() {

    /** Pego todos os campos do formulário */
    let data = [];

    /** Pego todos os campos do formulário */
    $('input[type="text"]').each(function() {

        data.push($(this).attr('name'));

    });

    /** Retorno os dadods coletados */
    return data;

}
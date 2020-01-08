function formatar(mascara, documento) {
    var i = documento.value.length;
    var saida = mascara.substring(0, 1);
    var texto = mascara.substring(i)

    if (texto.substring(0, 1) != saida) {
        documento.value += texto.substring(0, 1);
    }

}

function somenteData(num) {
    var er = /[^0-9/]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
        campo.value = "";
    }
}

function somenteCPF(num) {
    var er = /[^0-9.-]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
        campo.value = "";
    }
}

function somenteNumeros(num) {
    var er = /[^0-9.,]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
        campo.value = "";
    }
}

// JavaScript Document
//adiciona mascara de cnpj
function mascaraCNPJ(cnpj) {
    if (mascaraInteiro(cnpj) == false) {
        event.returnValue = false;
    }
    return formataCampo(cnpj, '00.000.000/0000-00', event);
}

//adiciona mascara de cep
function mascaraCep(cep) {
    if (mascaraInteiro(cep) == false) {
        event.returnValue = false;
    }
    return formataCampo(cep, '00.000-000', event);
}

//adiciona mascara de data
function mascaraData(data) {
    if (mascaraInteiro(data) == false) {
        event.returnValue = false;
    }
    return formataCampo(data, '00/00/0000', event);
}

//adiciona mascara ao telefone
function mascaraTelefone(tel) {
    if (mascaraInteiro(tel) == false) {
        event.returnValue = false;
    }
    return formataCampo(tel, '(00) 0000-0000', event);
}

//adiciona mascara ao CPF
function mascaraCPF(cpf) {
    if (mascaraInteiro(cpf) == false) {
        event.returnValue = false;
    }
    return formataCampo(cpf, '000.000.000-00', event);
}

//valida telefone
function validarTelefone(tel) {
    exp = exp = /\(\d{2}\)\ \d{4}\-\d{4}/
    if (!exp.test(tel.value))
        return false;
    return true;
}

//valida CEP
function validarCep(cep) {
    exp = /\d{2}\.\d{3}\-\d{3}/
    if (!exp.test(cep.value))
        return false;
    return true;
}

//valida data
function validarData(data) {

    exp = /^((((0?[1-9]|[12]\d|3[01])[\.\-\/](0?[13578]|1[02])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|[12]\d|30)[\.\-\/](0?[13456789]|1[012])[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|((0?[1-9]|1\d|2[0-8])[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?\d{2}))|(29[\.\-\/]0?2[\.\-\/]((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00)))|(((0[1-9]|[12]\d|3[01])(0[13578]|1[02])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|[12]\d|30)(0[13456789]|1[012])((1[6-9]|[2-9]\d)?\d{2}))|((0[1-9]|1\d|2[0-8])02((1[6-9]|[2-9]\d)?\d{2}))|(2902((1[6-9]|[2-9]\d)?(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)|00))))$/;
    if (!exp.test(data.value)) {

        return false;
    }

    return true;
}

//valida o CPF digitado
function validarCPF(objCpf) {

    var cpf = objCpf.value;

    if (cpf == '')
        return true;

    exp = /\.|\-|\//g
    cpf = cpf.toString().replace(exp, "");
    var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
    var soma1 = 0, soma2 = 0;
    var vlr = 11;
    // Elimina CPFs invalidos conhecidos    
    if (cpf.length != 11 ||
            cpf == "00000000000" ||
            cpf == "11111111111" ||
            cpf == "22222222222" ||
            cpf == "33333333333" ||
            cpf == "44444444444" ||
            cpf == "55555555555" ||
            cpf == "66666666666" ||
            cpf == "77777777777" ||
            cpf == "88888888888" ||
            cpf == "99999999999")
        return false;
    for (i = 0; i < 9; i++) {
        soma1 += eval(cpf.charAt(i) * (vlr - 1));
        soma2 += eval(cpf.charAt(i) * vlr);
        vlr--;
    }
    soma1 = (((soma1 * 10) % 11) == 10 ? 0 : ((soma1 * 10) % 11));
    soma2 = (((soma2 + (2 * soma1)) * 10) % 11);
    var digitoGerado = (soma1 * 10) + soma2;
    if (digitoGerado != digitoDigitado) {
        return false;
    }

    return true;
}

//valida numero inteiro com mascara
function mascaraInteiro() {
    if (event.keyCode < 48 || event.keyCode > 57) {
        event.returnValue = false;
        return false;
    }
    return true;
}

//valida o CNPJ digitado
function validarCNPJ(cnpj) {

    exp = /\-|\.|\/|\(|\)| /g;
    cnpj = cnpj.value.toString().replace(exp, "");

    if (cnpj == '')
        return true;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj.length != 14 || cnpj == "00000000000000"
            || cnpj == "11111111111111" || cnpj == "22222222222222"
            || cnpj == "33333333333333" || cnpj == "44444444444444"
            || cnpj == "55555555555555" || cnpj == "66666666666666"
            || cnpj == "77777777777777" || cnpj == "88888888888888"
            || cnpj == "99999999999999")
        return false;

    // Valida DVs
    length = cnpj.length - 2
    numbers = cnpj.substring(0, length);
    digit = cnpj.substring(length);
    sum = 0;
    pos = length - 7;
    for (i = length; i >= 1; i--) {
        sum += numbers.charAt(length - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    result = sum % 11 < 2 ? 0 : 11 - sum % 11;
    if (result != digit.charAt(0))
        return false;

    length = length + 1;
    numbers = cnpj.substring(0, length);
    sum = 0;
    pos = length - 7;
    for (i = length; i >= 1; i--) {
        sum += numbers.charAt(length - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    result = sum % 11 < 2 ? 0 : 11 - sum % 11;
    if (result != digit.charAt(1))
        return false;

    return true;

}

//formata de forma generica os campos
function formataCampo(campo, mascara, evento) {
    var boleanoMascara;
    var Digitato = evento.keyCode;
    var exp = /\-|\.|\/|\(|\)| /g
    var campoSoNumeros = campo.value.toString().replace(exp, "");
    var posicaoCampo = 0;
    var novoValorCampo = "";
    var tamanhoMascara = campoSoNumeros.length;
    if (Digitato != 8) { // backspace 
        for (i = 0; i <= tamanhoMascara; i++) {
            boleanoMascara = ((mascara.charAt(i) == "-") || (mascara.charAt(i) == ".")
                    || (mascara.charAt(i) == "/"))
            boleanoMascara = boleanoMascara || ((mascara.charAt(i) == "(")
                    || (mascara.charAt(i) == ")") || (mascara.charAt(i) == " "))
            if (boleanoMascara) {
                novoValorCampo += mascara.charAt(i);
                tamanhoMascara++;
            } else {
                novoValorCampo += campoSoNumeros.charAt(posicaoCampo);
                posicaoCampo++;
            }
        }
        campo.value = novoValorCampo;
        return true;
    } else {
        return true;
    }
}

function calcularIdade(aniversario) {
    var nascimento = aniversario.split("/")
    var ano_aniversario = nascimento[2];
    var mes_aniversario = nascimento[1];
    var dia_aniversario = nascimento[0];
    var d = new Date,
            ano_atual = d.getFullYear(),
            mes_atual = d.getMonth() + 1,
            dia_atual = d.getDate(),
            ano_aniversario = +ano_aniversario,
            mes_aniversario = +mes_aniversario,
            dia_aniversario = +dia_aniversario,
            quantos_anos = ano_atual - ano_aniversario;
    if (mes_atual < mes_aniversario || mes_atual == mes_aniversario && dia_atual < dia_aniversario) {
        quantos_anos--;
    }

    return quantos_anos < 0 ? 0 : quantos_anos;
}

function validarSenha(form) {
    senha = $('#senha').val()
    senhaRepetida = $('#confirmarSenha').val()
    if (senha != senhaRepetida) {
        alert("Senhar diferentes. Repita a senha corretamente !");
    }
}

function validarAno(ano) {

    if (ano.value < 1950 || ano.value > 2100) {
        alert('Ano inválido! Digite um valore entre 1950 e 2100 !');
        ano.value = '';
    }
    return ano;
}

function teste(){
  alert("JavaScript !");
}


gi
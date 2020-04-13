function exibirNumeroProcesso() {
  var valorCombo = document.getElementById('tipoProcesso').value;
  //alert(valorCombo);
  if (valorCombo == 2) {
    $('#labelNumeroProcesso').show();
    $('#numeroProcesso').show();
  } else {
    $('#labelNumeroProcesso').hide();
    $('#numeroProcesso').hide();
  }
}

function validarSenha() {
  var senha = document.getElementById('s1').value;
  var senha2 = document.getElementById('s2').value;

  if (senha != senha2) {
    exibirMensagem('.alert-danger', 'Erro!', 'Dados Não Conferem, Por favor informar Senhas Iguais!!!');
  }
}

function exibirMensagem(seletorComponente, titulo, mensagem) {
  const DEZ_SEGUNDOS = 10000;

  $('.alert').hide();

  titulo && $(`${seletorComponente} strong`).html(titulo);
  mensagem && $(`${seletorComponente} span`).html(mensagem);
  $(seletorComponente).show();
  $('html, body').animate(
    {
      scrollTop: $(seletorComponente).offset().top,
    },
    'slow'
  );

  window.setTimeout(() => $('.alert').hide(), DEZ_SEGUNDOS);
}

function limparPreenchimento(seletoresComponentes) {
  seletoresComponentes.forEach(seletorComponente => $(seletorComponente) && $(seletorComponente).val(''));
}

function serializarComoObjeto(formulario) {
  return formulario.serializeArray().reduce((obj, item) => {
    obj[item.name] = item.value;
    return obj;
  }, {});
}

$(function(){
	$('[name=preco]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
	$('[name=promocao]').maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

	$('[name=tipo_tamanho]').change(function(){
		var val = $(this).val();
		if(val == 'letra'){
			$('#tamanho_letra').parent().show();
			$('#tamanho_numero').parent().hide();
		}else{
			$('#tamanho_letra').parent().hide();
			$('#tamanho_numero').parent().show();
		}
	})
})
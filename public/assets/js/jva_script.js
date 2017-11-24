





//Popula o combo dos produtos filtrando pelo grupo

$(function(){
    $('#grupo').change('#grupo option', function(){
        var campos =  $('#grupo option:selected').val();


        //$('option').attr('value');
        $.ajax({
            method: "POST",
            url: "funcoes.php",
            data: {grupo: "sim", codGrupo: campos},
            dataType: "json",
            success: function(retorno){
                var options = '<option value=""></option>';
                $.each(retorno,function(key,value){
                    options += '<option value="'+value.CODIGO+'">'+value.PRODUTO+'</option>'
                    //console.log(key+':'+value.CODIGO);
                });
             
                console.log(options);
                $('#produto').html(options).show();
            },
            error:function(){alert("Erro!");}
        });

    });

});



//retorna o valor do produto e o codigo para finalizar o pedido

$(function(){
    $('#produto').change('#produto option', function(){
        var campos =  $('#produto option:selected').val();


        //$('option').attr('value');
        $.ajax({
            method: "POST",
            url: "funcoes.php",
            data: {addProduto: "sim", produto: campos},
            dataType: "json",
            success: function(retorno){
                console.log(retorno);
                $('input[name=valor]').val(retorno['PRECOVENDA']);
                $('input[name=cod_produto]').val(retorno['CODIGO']);
                $('input[name=qtde]').val('1.00');
                var v1 = parseFloat($('input[name=qtde]').val());
                var v2 = parseFloat($('input[name=valor]').val());

                var r = v1 * v2;

                $('input[name=total]').val(r);


            },
            error:function(){alert("Erro!");}
        });





    });

});

//Preencher o label de pesquisa de código com zeros a esquerda para fixar tamanho 6 
$(function(){
	$('input[name=SelecaoCodigo]').change(function(){
        var strResult = $('input[name=SelecaoCodigo]').val();
		var qtd = $.trim($('input[name=SelecaoCodigo]').val()).length;
		var tamanho = 6;

			if(($('input[name=SelecaoCodigo]').val() != '' || !$('input[name=SelecaoCodigo]').val()) &&  $.trim($('input[name=SelecaoCodigo]').val()).length){
                if(qtd < tamanho){

					var limite = tamanho-qtd;

					for(i=0;i<limite;i++){

						strResult = '0'+strResult;

					}
                }
				$('input[name=SelecaoCodigo]').val(strResult);
            }
	});
});

// Busca por valores do código digitado no banco de dados
$(function(){
    $('#SelecaoCodigo').change('#SelecaoCodigo', function(){
        var campos =  $('#SelecaoCodigo').val();

        $.ajax({
            method: "POST",
            url: "funcoes.php",
            data: {addProduto: "sim", codProduto: campos},
            dataType: "json",
            success: function(retorno){
               console.log(retorno);
			    $('label[name=NomeProduto]').text(retorno['PRODUTO']);
                $('input[name=valor]').val(retorno['PRECOVENDA']);
                $('input[name=cod_produto]').val(retorno['CODIGO']);
                $('input[name=qtde]').val('1.00');
                var v1 = parseFloat($('input[name=qtde]').val());
                var v2 = parseFloat($('input[name=valor]').val());
                var r = v1 * v2;

                $('input[name=total]').val(r);
            },
            error:function(){alert("Erro!");}
        });

    });

});


// Função para fazer com que a tecla Enter pule de label e não dê Submit na página.
$(function(){
	$('#docNovo').on('keydown', 'input, select, textarea', function(e) {
		var self = $(this)
				, form = self.parents('form:eq(0)')
				, foco
				, proximo
				, indice
				;
		
		
		if ((e.which == 13) || (e.keyCode == 13)){
			foco = $('#docNovo').find('input,a,select,button,textarea').filter(':visible');
			indice = foco.eq(foco.index(this) + 1);
			proximo = foco.eq(foco.index(indice));
			if (proximo != '') {
					proximo.focus();
					return false
				} 
			}
	});
});

// Calcular total
$(function(){
    $('input').keyup(
        function() {
            var v1 = parseFloat($('input[name=qtde]').val());
            var v2 = parseFloat($('input[name=valor]').val());

            var r = v1 * v2;

            $('input[name=total]').val(r);
        });
});




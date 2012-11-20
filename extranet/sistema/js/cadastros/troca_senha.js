$(document).ready(function(){
	$("#btNovaSenha").button();
	
	$("#boxMensagem").dialog({
		autoOpen:false,
		modal:true,
		height:150,
		width:250,
		title:'Atenção',
		buttons:{
			'Ok': function(){
				$(this).dialog('close');
				$(window.document.location).attr('href','inicio.php');

			}
		},
		close:function (){
			
		}
		
	});
	
	
});

function trocaSenha(){
	
	var senhaAntiga 	= $("#senhaAntiga").val();
	var senhaNova 		= $("#senhaNova").val();
	var confirmaSenha 	= $("#confirmaSenhaNova").val();
	
	if(senhaAntiga=="" || senhaNova =="" || confirmaSenha==""){
		alert("Nenhum campo pode ficar em branco.");
		$("#senhaAntiga").focus();
		
		
	}else{
		
		if(senhaNova==confirmaSenha){			
			$.post("inc/troca_senha.php",{
				senhaAntiga:senhaAntiga,
				senhaNova:senhaNova,
				confirmaSenha:confirmaSenha
				
			},
			function(resposta){
				switch(resposta){
				
				case "0":
					 $("#boxMensagem").html('Alteração realizada com sucesso!');
					 $("#boxMensagem").dialog('open');	                			
					break;
				case "1":
					 alert("A senha antiga não é valída.");
					 $("#senhaAntiga").focus();
					break;
				case "2":
					 $("#boxMensagem").html('Ocorreu um problema no sistema, caso o problema persistir favor entre em contato com o suporte.');
					 $("#boxMensagem").dialog('open');
					break;
					
				case "3":
					 $("#boxMensagem").html('Ocorreu um problema no sistema, caso o problema persistir favor entre em contato com o suporte.');
					 $("#boxMensagem").dialog('open');
					break;			
				
				}
				
			});
		}else{
			alert("A nova senha e a confirmação de senha não são iguais.");
			$("#senhaNova").focus();
		}
	}
};
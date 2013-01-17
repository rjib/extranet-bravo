
	$( "#boxLoadingEtiquetaHeader" ).dialog({
		autoOpen: false,
	    modal: true,
		height: 150,
		width: 250,
	    closeOnEscape:false,
		resizable:false,
		draggable:false,
		title: 'Gerando etiquetas...'
	}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();
    
        //$(document).ready(function(){
        $("#boxEtiquetaPecaCasadeiStep1").dialog({
     		autoOpen: false,
    		height: 250,
    		width:550,
    		modal: true,
    		resizable: false,
    		title: "Etiqueta Peca Casadei"	,
    		buttons:{
    		'Imprimir Etiquetas': function() {
        		
        		if($("#numeroOrdemProducaoStep1").val()!='' && $("#descricaoProdutoStep1").val()!=''){
        			$("#boxLoadingEtiquetaHeader").dialog("open");
        			$.post('ireport/relatorio/gerarCodeBarEtiquetaPecaCasaDeiPorOP.php',{'nu_op':$("#numeroOrdemProducaoStep1").val()}, function(data,status){
        				if (status == "success") {        					        					
        					window.open("ireport/relatorio/pcp_etiqueta_casadei.php?nu_op="+$("#numeroOrdemProducaoStep1").val(),"Etiqueta Peça (Casadei)","menubar=0,resizable=1,width=410,height=500,location=0");
        					$("#boxLoadingEtiquetaHeader").dialog("close");
        					$("#boxEtiquetaPecaCasadeiStep1").dialog("close");  
        				}
        			});
            		}else{
                		alert("Nenhuma OP válida foi encontrada!");

                    	}
    			},
    		'Cancelar': function(){ $(this).dialog('close');$("#numeroOrdemProducaoStep1").val('')}
			}
			});
    	//}
    	$("#step1").hide();

     function openBoxEtiquetaPecaCasadei(){
			$("#boxEtiquetaPecaCasadeiStep1").dialog('open');
			$("#numeroOrdemProducaoStep1").focus();
			$("#step1").hide();
			//alert('teste');
     }
     function getValidaOrdemProducaoPecaCasadei(){
    	 //alert($("#numeroOrdemProducaoStep1").val());
    	 if($.trim($("#numeroOrdemProducaoStep1").val()) != ""){
    			if($("#numeroOrdemProducaoStep1").val() != null && $("#numeroOrdemProducaoStep1").val() != ""){
    			  $.get('inc/relatorios/etiquetas/etiqueta_casadei_pesquisa_op.php', {'numeroOrdemProducaoStep1': $("#numeroOrdemProducaoStep1").val()}, function(resposta){
    				if(resposta){			  			  
    				  $("#descricaoProdutoStep1").val(resposta.ds_produto);
    				  $("#quantidadeProdutoStep1").val(resposta.qtd_produto);
    				  $("#loteStep1").val(resposta.nu_lote);    				  
    				  $("#step1").show('fast');
    				}else{
    					alert("OP não encontrada!");
      				  $("#descricaoProdutoStep1").val('');
    				  $("#quantidadeProdutoStep1").val('');
    				  $("#loteStep1").val('');    				  
    				  $("#step1").hide('fast');		
    				}
    			  }, 'json');  
    			}
    		}			
         }
     
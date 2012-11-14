$(document).ready(function(){	
	$("#boxDivergencias").dialog({
		autoOpen:false,
		modal: true,
		resizable: false,
		height: 300,
		width: 640,
        closeOnEscape:false,
		resizable:false,
		draggable:false,
		title: 'Informativo do Sistema',
		buttons: {
			Ok: function() {
				$( this ).dialog( 'close' );
				$("#boxFinishi").dialog('open');
				search();	
				gridLoader(searchfor, page);
			},
		}
		}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();	

	function loading(){
		$("#boxLoading").dialog('open');
		
	}
	
	$("#arquivo_ac").button();
	$("#btEnviarAC").button();
	
//Box data de importacao do arquivo AC
	
	$( "#boxImportarAC" ).dialog({
			autoOpen: false,
            modal: true,
			height: 200,
			width: 370,
			title: 'Importar Arquivo Optisave (.ac)',
            buttons: {
                'Cancelar': function() {
                    $( this ).dialog( "close" );
                    $("#arquivoSelecionado").html('Nenhum');
                }
            },
            close: function() {
            	$nomeArquivo = $("#arquivo_ac").val();
            	if($nomeArquivo!=""){
            		$("#arquivoSelecionado").html($nomeArquivo);
            	}else{
            		$("#arquivoSelecionado").html('Nenhum');
            	}
            }
    });
	//boxfinish sucesso
	$( '#boxFinishi' ).dialog({
		autoOpen: false,
        modal: true,
		height: 120,
		width: 250,
		title: 'Atenção',
        buttons: {
        	'Ok':function(){
        		$(this).dialog('close');		            		
        	}
        	}
        });			
	
	//boxloading
	$( "#boxLoading" ).dialog({
		autoOpen: false,
        modal: true,
		height: 200,
		width: 250,
        closeOnEscape:false,
		resizable:false,
		draggable:false,
		title: 'Importando Arquivo...'
	}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();
	
	//upload do arquivo	
	 $('#btEnviarAC').click(function(){
	        $('#formUpload').ajaxForm({ 
	        	beforeSubmit:  loading,
	            success: function(data) {	                               
	                if(data.sucesso == true){
	                	if(data.divergencia ==true){
	                		$("#boxImportarAC").dialog('close');
	                		$("#boxLoading").dialog('close');
	                		$("#boxDivergencias").load("helpers/getDivergenciasOp.php",{divergencias:data.dadosDivergencia});
	                		$("#boxDivergencias").dialog('open');
	                		
	                		
	                	}else{
		                	$("#boxLoading").dialog('close');
		                	$("#boxFinishi").dialog('open');
		                	$("#boxImportarAC").dialog('close');
		        			search();	
		        			gridLoader(searchfor, page);
	                	}
	                }else{
	                	$("#boxLoading").dialog('close');
	                	$("#arquivoSelecionado").html('Nenhum');
	                	alert(data.msg);                  
	                }                
	            },
	            error : function(){	            	
	            	$("#boxLoading").dialog('close');
	            	$("#arquivoSelecionado").html('Nenhum');
	            	alert('Erro ao enviar requisição!');
	            },
	            dataType: 'json',
	            url: 'cadastros/ordem_producao/importar_ac.php',
	            resetForm: true
	        }).submit();
	    })

});
function importarAC(planoCorte){
		$("#arquivoOrigem").html(planoCorte+'.ad');
		$("#boxImportarAC").dialog('open');
		$("#nomeAD").val(planoCorte);
}
function getNameArquivo(){
	$nomeArquivo = $("#arquivo_ac").val();
	if ($nomeArquivo != "") {
		$("#arquivoSelecionado").html($nomeArquivo);
	} else {
		$("#arquivoSelecionado").html('Nenhum');
	}
	
}

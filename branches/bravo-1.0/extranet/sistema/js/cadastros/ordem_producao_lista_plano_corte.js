$(document).ready(function(){
	
	$("#boxErro").dialog({
		autoOpen:false,
        resizable: false,
        height:200,
		width: 400,
        modal: true,
        title: 'Atenção!',
        buttons: {
        	'Ok':function(){
        		$(this).dialog('close');
        		
        	},
        }
	
	}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();
	
	
	
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
			'Ok': function() {
				$( this ).dialog( 'close' );
				$("#boxFinishi").dialog('open');
				search();	
				gridLoader(searchfor, page);
			},
		}
		}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();	

	function loading(){
		$("#boxImportarAC").dialog('close');
		$("#boxLoading").dialog('open');
		
	}
	
	$("#arquivo_ac").button();
	$("#btEnviarAC").button();
	
//Box data de importacao do arquivo AC
	
	$( "#boxImportarAC" ).dialog({
			autoOpen: false,
            modal: true,
			height: 200,
			width: 390,
			title: 'Importar Arquivo Optisave (.ac)',
            buttons: {
                'Cancelar': function() {
                    $( this ).dialog( "close" );
                    $("#arquivoSelecionado").html('Nenhum');
                }
            },
            close: function() {
            	var nomeArquivo = $("#arquivo_ac").val();
            	if(nomeArquivo!=""){
            		$("#arquivoSelecionado").html(nomeArquivo);
            	}else{
            		$("#arquivoSelecionado").html('Nenhum');
            	}
            }
    });
	//boxfinish sucesso
	$( '#boxFinishi' ).dialog({
		autoOpen: false,
        modal: true,
		height: 130,
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
		height: 150,
		width: 250,
        closeOnEscape:false,
		resizable:false,
		draggable:false,
		title: 'Importando Arquivo...'
	}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();
	
	//boxLoadingEtiqueta
	$( "#boxLoadingEtiqueta" ).dialog({
		autoOpen: false,
        modal: true,
		height: 150,
		width: 250,
        closeOnEscape:false,
		resizable:false,
		draggable:false,
		title: 'Gerando etiquetas.'
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
	                		var nomeArquivo = $("#nomeAD").val();
	                		var co_pcp_ad = $("#co_pcp_ad").val();
	                		$("#boxDivergencias").load("helpers/getDivergenciasOp.php",{divergencias:data.dadosDivergencia, nomeArquivo:nomeArquivo, co_pcp_ad:co_pcp_ad});
	                		$("#boxDivergencias").dialog('open');
	                		
	                		
	                	}else{
		                	$("#boxLoading").dialog('close');
		                	$("#boxFinishi").dialog('open');
		                	$("#boxImportarAC").dialog('close');
		        			search();	
		        			gridLoader(searchfor, page);
	                	}
	                }else{
	                	$("#boxImportarAC").dialog('close');
	                	$("#boxLoading").dialog('close');
	                	$("#arquivoSelecionado").html('Nenhum');	                	  
	                	$("#boxErro").html(data.msg);
	                	$("#boxErro").dialog('open');
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

function importarAC(co_pcp_ad,no_pcp_ad){
		$("#arquivoOrigem").html(no_pcp_ad+'.ad');
		$("#boxImportarAC").dialog('open');
		$("#nomeAD").val(no_pcp_ad);
		$("#co_pcp_ad").val(co_pcp_ad);
}

function getNameArquivo(){
	$nomeArquivo = $("#arquivo_ac").val();
	if ($nomeArquivo != "") {
		$("#arquivoSelecionado").html($nomeArquivo);
	} else {
		$("#arquivoSelecionado").html('Nenhum');
	}
	
}

function gerarEtiqueta(co_pcp_ad, no_pcp_ad){
	$("#boxLoadingEtiqueta").dialog("open");
	//$(window.document.location).attr('href','ireport/pcp_etiqueta.php?co_pcp_ad='+co_pcp_ad);
	$.post('cadastros/ordem_producao/gerarEtiqueta.php',{co_pcp_ad:co_pcp_ad, no_pcp_ad:no_pcp_ad}, function(data){
			if(data=="true"){
				$("#temp").load('ireport/gerarBarCode128.php',{co_pcp_ad:co_pcp_ad}, function(data,status){
					 if (status == "success") {
						// $("#temp").load('ireport/pcp_etiqueta.php',{co_pcp_ad:co_pcp_ad}, function(data,status){
							 //if (status == "success") {	
								// $("#boxLoadingEtiqueta").dialog("close");
								$(window.document.location).attr('href','ireport/pcp_etiqueta.php?co_pcp_ad='+co_pcp_ad);
							 }
						// });						  
						    
					 //}
					
				});
				//$(window.document.location).attr('href','ireport/gerarBarCode128.php?co_pcp_ad='+co_pcp_ad);
				//$(window.document.location).attr('href','ireport/pcp_etiqueta.php?co_pcp_ad='+co_pcp_ad);
				
			}else{
				$("#boxLoadingEtiqueta").dialog("close");
				$("#boxErro").html("Não foi possivel gerar etiqueta, favor entre em contato com o suporte!");
				$("#boxErro").dialog("open");
			}				
		
	});

	

	
	
}

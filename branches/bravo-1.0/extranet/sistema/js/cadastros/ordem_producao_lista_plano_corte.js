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
	
	
	$("#boxConfirmaQuantidade").dialog({
		autoOpen:false,
		modal: true,
		resizable: false,
		height: 350,
		width: 840,
        closeOnEscape:false,
		resizable:false,
		draggable:false,
		title: 'Enviar CasaDei',
		buttons: {
			'Confirmar': function() {
				//$( this ).dialog( 'close' );
				//$("#boxFinishi").dialog('open');
				var co_pcp_op = new Array();
				//pega valores selecionados
				$("input[type=text][name='quantidadeCasadei[]']").each(function(){
					co_pcp_op.push($(this).attr("id")+"-"+$(this).val());
				});
				co_pcp_ad = $("#co_ad").val();
				no_pcp_ad = $("#no_ad").val();
				enviarCasadei(co_pcp_ad, no_pcp_ad, co_pcp_op);
				//search();	
				//gridLoader(searchfor, page);
			}, 
			'Cancelar':function(){
				//alert('teste');
				$( this ).dialog( 'close' );
			},
		}
		});
	
	
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
	
	//boxloading
	$( "#boxLoadingCasadei" ).dialog({
		autoOpen: false,
        modal: true,
		height: 110,
		width: 250,
        closeOnEscape:false,
		resizable:false,
		draggable:false,
		title: 'Enviando Casadei...'
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
		title: 'Gerando etiquetas...'
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

function confirmaQuantidade(co_pcp_ad, no_pcp_ad){
	//enviarCasadei(co_pcp_ad, no_pcp_ad);
	$("#boxConfirmaQuantidade").load("inc/pcp/enviar_casadei_form.php",{co_pcp_ad:co_pcp_ad, no_pcp_ad:no_pcp_ad});
	$("#boxConfirmaQuantidade").dialog('open');
	
}


function enviarCasadei(co_pcp_ad, no_pcp_ad, co_pcp_op){
	
	$("#boxLoadingCasadei").dialog('open');
	$.post('cadastros/ordem_producao/enviar_casaDei.php',{co_pcp_ad:co_pcp_ad, no_pcp_ad:no_pcp_ad, co_pcp_op:co_pcp_op}, function(data){
		if(data=="true"){
			$("#boxLoadingCasadei").dialog('close');
			$("#boxConfirmaQuantidade").dialog( 'close' );
			search();	
			gridLoader(searchfor, page);
		}else{
			$("#boxErro").dialog('open');			
			$("#boxErro").html("Não foi possível enviar PIs, pois a quantidade ultrapassa a ordem de produção");
			$("#boxLoadingCasadei").dialog('close');
		}
		});
	
	
}

function gerarEtiqueta(co_pcp_ad, no_pcp_ad){
	$("#boxLoadingEtiqueta").dialog("open");
	//$(window.document.location).attr('href','ireport/pcp_etiqueta.php?co_pcp_ad='+co_pcp_ad);
	$.post('cadastros/ordem_producao/gerarEtiqueta.php',{co_pcp_ad:co_pcp_ad, no_pcp_ad:no_pcp_ad}, function(data){
			if(data=="true"){
				$("#temp").load('ireport/pcp/gerarBarCode128.php',{co_pcp_ad:co_pcp_ad}, function(data,status){
					 if (status == "success") {
						 $("#boxLoadingEtiqueta").dialog("close");
						// $("#temp").load('ireport/pcp_etiqueta.php',{co_pcp_ad:co_pcp_ad}, function(data,status){
							 //if (status == "success") {	
								// $("#boxLoadingEtiqueta").dialog("close");
								//$(window.document.location).attr('href','ireport/pcp_etiqueta.php?co_pcp_ad='+co_pcp_ad);
								window.open("ireport/pcp/pcp_etiqueta_pilha.php?co_pcp_ad="+co_pcp_ad,"Etiqueta de Pilha","menubar=0,resizable=0,width=810,height=800,location=0");
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

//gerarEtiquetaPeca CASADEI
function gerarEtiquetaPeca(co_pcp_ad){
	$("#boxLoadingEtiqueta").dialog("open");	
				$("#temp").load('ireport/pcp/gerarCodeBarEtiquetaPecaCasadeiPorAD.php',{co_pcp_ad:co_pcp_ad}, function(data,status){
					 if (status == "success") {
						 $("#boxLoadingEtiqueta").dialog("close");
						// $("#temp").load('ireport/pcp_etiqueta.php',{co_pcp_ad:co_pcp_ad}, function(data,status){
							 //if (status == "success") {	
								// $("#boxLoadingEtiqueta").dialog("close");
								//$(window.document.location).attr('href','ireport/pcp_etiqueta.php?co_pcp_ad='+co_pcp_ad);
								window.open("ireport/pcp/pcp_etiqueta_casadei.php?co_pcp_ad="+co_pcp_ad,"Etiqueta de Pilha","menubar=0,resizable=1,width=410,height=500,location=0");
							 }
				});

}			

//gerarEtiquetaPeca CASADEI
function gerarEtiquetaPecaPI(co_pcp_ad) {

	window.open('ireport/pcp/pcp_etiqueta_peca_pi.php?co_pcp_ad='
			+ co_pcp_ad, "Etiqueta Peça (Casadei)",
			"menubar=0,resizable=1,width=410,height=500,location=0");

}
//gerarLista PIs
function gerarLista(co_pcp_ad,no_pcp_ad) {

	window.open('ireport/pcp/pcp_lista_pi.php?ad='
			+ co_pcp_ad+'&job='+no_pcp_ad, "Lista PIs",
			"menubar=0,directories=0,titlebar=1,resizable=1,width=1000,height=700,location=0");

}
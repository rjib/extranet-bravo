$(document).ready(function() {
	$("#adicionarModulo").button();
	$("#boxAdicionarSub").hide();
	$("#boxExcluir").hide();
	
	
	$("#btn_gravar_novo_modulo").button();
	$("#btn_cancelar").button();
	
	$("#boxMensagem").dialog({
		autoOpen:false,
		modal:true,
		height:150,
		width:250,
		title:'Atenção',
		buttons:{
			'Ok': function(){
				$(this).dialog('close');
				$("#boxAdicionarModulo").dialog("close");
				$("#boxAdicionarModulo").dialog("close");
				$("#boxExcluir").dialog("close");
				$("#boxAlterar").dialog("close");
			}
		},
		close:function (){
			$("#boxAdicionarModulo").dialog("close");
			$("#boxAdicionarModulo").dialog("close");
			$("#boxExcluir").dialog("close");
		}
		
	});
	
	
	//Box adicionar novo modulo
	$( "#boxAdicionarModulo" ).dialog({
			autoOpen: false,
            modal: true,
    		resizable:false,
    		draggable:false,
			height: 280,
			width: 470,
			title:'Adicionar novo módulo',
            buttons: {
                
                'Salvar':function(){
                	var no_modulo 	= $("#no_modulo").val();
                	var co_pai 		= 0;
                	var fl_ativo 	= $("input[name='fl_ativo']:checked").val();
                	var fl_acoes 	= $("input[name='fl_acoes']:checked").val();
                	var ds_modulo 	= $("#ds_modulo").val();
	                	//$.post('inc/cadastros/ordem_producao_pi_gerar_ad.php', {
	                	$.post('inc/configuracoes/modulo_ins.php',
	                			{
	                			 no_modulo:no_modulo, 
	                			 co_pai:co_pai, 
	                			 fl_ativo:fl_ativo,
	                			 fl_acoes:fl_acoes,
	                			 ds_modulo:ds_modulo
	                			 },
	                			 function (resposta){
	                				 switch(resposta){
	                				 case "0": 
	                					 $("#boxMensagem").html('Cadastro realizado com sucesso!');
	                					 $("#boxMensagem").dialog('open');	                					 
	                	                 $("#no_modulo").val('');
	                	                
	                					 break;
	                				 case "1":
	                					 $("#boxMensagem").html('Por favor digite o nome do módulo.');
	                					 $("#no_modulo").focus();
	                					 $("#boxMensagem").dialog('open');
	                					 break;
	                				 case "2": 
	                					 $("#boxMensagem").html('Ocorreu um problema no sistema, caso o problema persistir favor entre em contato com o suporte.');
	                					 $("#boxMensagem").dialog('open');
	                					 break;
	                				 	
	                				 }
	                				 
	                			 }
	                	);
                },
                'Cancelar': function() {
                    $( this ).dialog( "close" );
                }
     },
     close: function(){
    	 $(window.document.location).attr('href','inicio.php?pg=modulos');    	 
     }
    });	
	
	
	//Box alterar modulos
	$( "#boxAlterar" ).dialog({
			autoOpen: false,
            modal: true,
    		resizable:false,
    		draggable:false,
			height: 280,
			width: 470,
			title:'Alterar Módulo',
            buttons: {
                
                'Salvar':function(){
                	
                	var no_modulo 		= $("#no_modulo_alt").val();
                	var ds_modulo		= $("#ds_modulo_alt").val();
                	var co_modulo		= $("#co_modulo_alt").val();
                	var fl_ativo	 	= $("input[name='fl_ativo_alt']:checked").val();
                	var fl_acoes 		= $("input[name='fl_acoes_alt']:checked").val();
                	
	                	$.post('inc/configuracoes/modulo_alt.php',
	                			{	                		
	                			 no_modulo_alt:no_modulo,
	                			 fl_ativo_alt:fl_ativo,
	                			 ds_modulo_alt:ds_modulo,
	                			 fl_acoes_alt:fl_acoes,
	                			 co_modulo_alt:co_modulo
	                			 },
	                			 function (resposta){
	                				 switch(resposta){
	                				 case "0": 
	                					 $("#boxMensagem").html('Alteração realizada com sucesso!');
	                					 $("#boxMensagem").dialog('open');	                					 
	                	                
	                					 break;
	                				 case "1":
	                					 $("#boxMensagem").html('Por favor digite o nome do módulo.');
	                					 $("#no_modulo_alt").focus();
	                					 $("#boxMensagem").dialog('open');
	                					 break;
	                				 case "2": 
	                					 $("#boxMensagem").html('Ocorreu um problema no sistema, caso o problema persistir favor entre em contato com o suporte.');
	                					 $("#boxMensagem").dialog('open');
	                					 break;
	                				 	
	                				 }
	                				 
	                			 }
	                	);
                },
                'Cancelar': function() {
                    $( this ).dialog( "close" );
                }
     },
     close: function(){
    	 $(window.document.location).attr('href','inicio.php?pg=modulos');    	 
     }
    });	
	
});

/**
 * Metodo para dicionar novo modulo principal ao sistema
 * @author Ricardo S. Alvarenga
 * @since 12/11/2012
 * */
function addModulo(){
	$("#boxAdicionarModulo").dialog('open');	
}


/**
 * Metodo para dicionar novo submodulo ao sistema
 * @author Ricardo S. Alvarenga
 * @since 12/11/2012
 * @param int id	codigo do modulo pai
 * */
function addSub(id){
	var nome = $("#"+id).html();
	$("#box_add_sub_mod_pai").html(nome);
	$("#boxAdicionarSub").show();
	
	
	//Box adicionar novo submodulo
	$( "#boxAdicionarSub" ).dialog({
			autoOpen: true,
            modal: true,
    		resizable:false,
    		draggable:false,
			height: 280,
			width: 470,
			title:'Adicionar novo sub-módulo',
            buttons: {
                
                'Salvar':function(){
                	var no_modulo 	= $("#no_modulo_add_sub").val();
                	var co_pai 		=  id;
                	var fl_status 	= $("#fl_ativo_add_sub").val();
	                	//$.post('inc/cadastros/ordem_producao_pi_gerar_ad.php', {
	                	$.post('inc/configuracoes/modulo_ins.php',
	                			{
	                			 no_modulo:no_modulo, 
	                			 co_pai:co_pai, 
	                			 fl_status:fl_status
	                			 },
	                			 function (resposta){
	                				 switch(resposta){
	                				 case "0": 
	                					 $("#boxMensagem").html('Cadastro realizado com sucesso!');
	                					 $("#boxMensagem").dialog('open');	                					
	                	                 $("#no_modulo").val('');	                	                 
	                					 break;
	                				 case "1":
	                					 $("#boxMensagem").html('Por favor digite o nome do sub-módulo.');
	                					 $("#no_modulo").focus();
	                					 $("#boxMensagem").dialog('open');
	                					 break;
	                				 case "2": 
	                					 $("#boxMensagem").html('Ocorreu um problema no sistema, caso o problema persistir favor entre em contato com o suporte.');
	                					 $("#boxMensagem").dialog('open');
	                					 break;
	                				 	
	                				 }
	                				 
	                			 }
	                	);
                },
                'Cancelar': function() {
                    $( this ).dialog( "close" );
                }
     }, 
     close:function (){
    	 $(window.document.location).attr('href','inicio.php?pg=modulos');  
     }
    });	
}


/**
 * Metodo para excluír um modulo e seu filhos
 * @author Ricardo S. Alvarenga
 * @since 12/11/2012
 * @param int id	codigo do modulo pai
 * */
function excluir(id){
	$("#boxExcluir").show();
	$("#boxExcluir").dialog({
		autoOpen:true,
        resizable: false,
        height:200,
		width: 400,
        modal: true,
        title: 'Atenção!',
        buttons: {
            "Sim": function() {
            	var co_pai = id;
            	$.post('inc/configuracoes/modulo_ex.php',
            			{
            			 co_pai:co_pai
            			 },
            			 function (resposta){
            				 switch(resposta){
            				 case "0": 
            					 $("#boxMensagem").html('Módulo excluído com sucesso!');
            					 $("#boxMensagem").dialog('open');
            					 break;
            				 case "1":
            					 $("#boxMensagem").html('Ocorreu um problema no sistema, caso persistir favor entre em contato com o suporte.');
            					 $("#boxMensagem").dialog('open');
            					 break;
            				 }
            			 });
            },
            "Não": function() {
                $( this ).dialog( "close" );
            }
        },
        close:function (){
            $(window.document.location).attr('href','inicio.php?pg=modulos');        	
        }
    });
}
function editar(co_pai){
	$("#boxAlterar").load('cadastros/modulos/modulo_form_alt.php',{co_pai:co_pai});
	$("#boxAlterar").dialog('open');
}
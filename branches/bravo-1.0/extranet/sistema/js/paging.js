/* ROTINAS DO COMPONENTE GRID & LIST - N�O ALTERAR A PARTIR DAQUI **************************************************/

/*	Vari�veis gen�ricas	*/

var searchfor = '';		//String do que procurar no grid
var page = 1;			//P�gina inicial para a fun��o gridLoader()

function search(){
	
	$(searchdiv).focus(function(){
		if($(this).val() == 'Pesquisar...'){
			$(this).val('');
			$(this).css('color','#000');
		}
	});
	
	$(searchdiv).blur(function(){
		if($(this).val() == 'Pesquisar...' || $(this).val() == ''){
			$(this).css('color','#999');
			$(this).val('Pesquisar...');
		}
	});
	
	$(searchdiv).keyup(function(){

		gridLoader($(this).val(), 1);
			
	});
}

function gridLoader(searchfor, page){
	
	//Mostra a mensagem ou anima��o de carregamento
	$(consolediv).html(loadmsg);
	
	//Carrega os dados do grid
	$(controlsdivclass).load(controlsscript, 'load=controls&searchfor=' + searchfor + '&p=' + page,function(){
		
		//Adiciona a estiliza��o aos controles
		$(controlsdivclass + ' table').addClass(controlsclass);
		
		//Carrega o grid
		$(griddivid).load(gridscript, 'load=grid&searchfor=' + searchfor + '&p=' + page,function(){
				
			//Adiciona a estiliza��o ao grid
			$(griddivid + ' table').addClass(gridclass);
					
			//Inicia o plugin tablesorter no grid
			$(griddivid + ' table').tablesorter({
				widthFixed: false, 
				widgets: ['zebra'],
				headers: gridheaders,
			});
			
			//Cria um handler para o evento de clicar nas p�ginas
			$(controlsdivclass + ' a').click(function(){
				
				//Recupera a url atual
				var url = $(this).attr('href');
				
				page = url.match(/[\&|\?]p\=[0-9]{1,9999999}/);
				page = page[0].match(/[0-9]{1,9999999}/);
				gridLoader(searchfor, page);

				return false;
				
			});
				
		});
	
	});
	
	//Esconde a mensagem ou anima��o de carregamento
	$(consolediv).html('');

}

/* Carrega as funcionalistitemidades da p�gina */
$(document).ready(function(){
	
	//Inicia a fun��o search para o input designado para esta fun��o
	search();
	
	//Carrega o grid
	gridLoader(searchfor, page);
	
});
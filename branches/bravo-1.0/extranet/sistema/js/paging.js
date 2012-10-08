/* ROTINAS DO COMPONENTE GRID & LIST - NÃO ALTERAR A PARTIR DAQUI **************************************************/

/*	Variáveis genéricas	*/

var searchfor = '';		//String do que procurar no grid
var page = 1;			//Página inicial para a função gridLoader()

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
	
	//Mostra a mensagem ou animação de carregamento
	$(consolediv).html(loadmsg);
	
	//Carrega os dados do grid
	$(controlsdivclass).load(controlsscript, 'load=controls&searchfor=' + searchfor + '&p=' + page,function(){
		
		//Adiciona a estilização aos controles
		$(controlsdivclass + ' table').addClass(controlsclass);
		
		//Carrega o grid
		$(griddivid).load(gridscript, 'load=grid&searchfor=' + searchfor + '&p=' + page,function(){
				
			//Adiciona a estilização ao grid
			$(griddivid + ' table').addClass(gridclass);
					
			//Inicia o plugin tablesorter no grid
			$(griddivid + ' table').tablesorter({
				widthFixed: false, 
				widgets: ['zebra'],
				headers: gridheaders,
			});
			
			//Cria um handler para o evento de clicar nas páginas
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
	
	//Esconde a mensagem ou animação de carregamento
	$(consolediv).html('');

}

/* Carrega as funcionalistitemidades da página */
$(document).ready(function(){
	
	//Inicia a função search para o input designado para esta função
	search();
	
	//Carrega o grid
	gridLoader(searchfor, page);
	
});
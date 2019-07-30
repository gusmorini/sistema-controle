$(document).ready( function(){

	$('.url-vai').click( function(){

		var carrega_url = this.id;
		carrega_url = 'php/'+carrega_url+'.php';

		$.ajax({

			url: carrega_url,

			success: function(data){
				$('#corpo').html(data);
			},

			beforeSend: function(){
				$('#loader').css({ display:"block" });
			},

			complete: function(){
				$('#loader').css({ display:"none" });
			}

			// data, é criada automaticamente dentro da função ajax

		});

	});

});
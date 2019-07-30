$(document).ready(function(){

$('[data-toggle="tooltip"]').tooltip();
$('[data-toggle="popover"]').popover();

/*@file utils.js
@brief Conjunto de funções para tratamento dos dados
@author Marcone Gledson de Almeida
@date 2008
*/

      /*   @brief Converte uma string em formato moeda para float
      @param valor(string) - o valor em moeda
      @return valor(float) - o valor em float
   */
   function converteMoedaFloat(valor){
      
      if(valor === ""){
         valor =  0;
      }else{
         valor = valor.replace(".","");
         valor = valor.replace(",",".");
         valor = parseFloat(valor);
      }
      return valor;

   }
   
   /*   @brief Converte um valor em formato float para uma string em formato moeda
      @param valor(float) - o valor float
      @return valor(string) - o valor em moeda
   */
   function converteFloatMoeda(valor){
      var inteiro = null, decimal = null, c = null, j = null;
      var aux = new Array();
      valor = ""+valor;
      c = valor.indexOf(".",0);
      //encontrou o ponto na string
      if(c > 0){
         //separa as partes em inteiro e decimal
         inteiro = valor.substring(0,c);
         decimal = valor.substring(c+1,valor.length);
      }else{
         inteiro = valor;
      }
      
      //pega a parte inteiro de 3 em 3 partes
      for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
         aux[c]=inteiro.substring(j-3,j);
      }
      
      //percorre a string acrescentando os pontos
      inteiro = "";
      for(c = aux.length-1; c >= 0; c--){
         inteiro += aux[c]+'.';
      }
      //retirando o ultimo ponto e finalizando a parte inteiro
      
      inteiro = inteiro.substring(0,inteiro.length-1);
      
      decimal = parseInt(decimal);
      if(isNaN(decimal)){
         decimal = "00";
      }else{
         decimal = ""+decimal;
         if(decimal.length === 1){
            decimal = decimal+"0";
         }
      }
      
      
      valor = "R$ "+inteiro+","+decimal;
      
      
      return valor;

   }



function validar(){

	var debito = cadcont.debtotal.value;

	var valor = converteMoedaFloat(cadcont.val_recebe.value);	

	var $divMensagem = document.getElementById('divMensagem');

	if (valor > debito) {

		$divMensagem.innerHTML = 'Valor inválido';
		cadcont.val_recebe.focus();
		return false;
	}
	else{

		$divMensagem.innerHTML = '';
		return true;

	}

}// function-receber


   // jquery
   
   $('.lembretes-info').hide(); // esconde informações dos lembretes

   $('.li-info').click(function(){
      $('.'+this.id).show();
   });

   $('.m-dinheiro').mask("#.##0,00", {reverse: true});
   $('.m-cpf').mask("999.999.999-99", {reverse: true});
   $('.m-cnpj').mask("99.999.999/9999-99", {reverse: true});
   $('.m-num').mask("99999999999999", {reverse: true});
   $('.m-cel').mask("9 9999-9999", {reverse: true});

});   // ready() garante o carregamento do DOM


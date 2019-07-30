//escreve data por extenso
   
function dataExt(hoje) {

   meses = new Array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
   semana = new Array("Domingo","Segunda-feira","Terça-feira","Quarta-feira","Quinta-feira","Sexta-feira","Sábado");      

   //hoje = new Date();
   dia = hoje.getDate();
   dias = hoje.getDay();
   mes = hoje.getMonth();
   ano = hoje.getYear();

     if (navigator.appName == "Netscape"){
       ano = ano + 1900;
     }   
   
   diaext = dia + " de " + meses[mes]
   + " de " + ano;

   return diaext;

}// data por extenso
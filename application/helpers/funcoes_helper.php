<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function limpar($string){
	$table = array(
        '/'=>'', '('=>'', ')'=>'',
    );
    // Traduz os caracteres em $string, baseado no vetor $table
    $string = strtr($string, $table);
	$string= preg_replace('/[,.;:`´^~\'"]/', null, iconv('UTF-8','ASCII//TRANSLIT',$string));
	$string= strtolower($string);
	$string= str_replace(" ", "-", $string);
	$string= str_replace("---", "-", $string);
	return $string;
}

function data_ext($string){
    
    $dia_sem= date('w', strtotime($string));

    if($dia_sem == 0){
    $semana = "Domingo";
    }elseif($dia_sem == 1){
    $semana = "Segunda-feira";
    }elseif($dia_sem == 2){
    $semana = "Terça-feira";
    }elseif($dia_sem == 3){
    $semana = "Quarta-feira";
    }elseif($dia_sem == 4){
    $semana = "Quinta-feira";
    }elseif($dia_sem == 5){
    $semana = "Sexta-feira";
    }else{
    $semana = "Sábado";
    }

    $dia= date('d', strtotime($string));

    $mes_num = date('m', strtotime($string));
    if($mes_num == '01'){
    $mes= "Janeiro";
    }elseif($mes_num == '02'){
    $mes = "Fevereiro";
    }elseif($mes_num == '03'){
    $mes = "Março";
    }elseif($mes_num == '04'){
    $mes = "Abril";
    }elseif($mes_num == '05'){
    $mes = "Maio";
    }elseif($mes_num == '06'){
    $mes = "Junho";
    }elseif($mes_num == '07'){
    $mes = "Julho";
    }elseif($mes_num == '08'){
    $mes = "Agosto";
    }elseif($mes_num == '09'){
    $mes = "Setembro";
    }elseif($mes_num == '10'){
    $mes = "Outubro";
    }elseif($mes_num == '11'){
    $mes = "Novembro";
    }else{
    $mes = "Dezembro";
    }

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));
    //return $semana.', '.$dia.' de '.$mes.' de '.$ano.' '.$hora;
    return $semana.', '.$dia.' de '.$mes.' de '.$ano;
}

function data_br($string){
    
    $dia_sem= date('w', strtotime($string));

    if($dia_sem == 0){
    $semana = "Domingo";
    }elseif($dia_sem == 1){
    $semana = "Segunda-feira";
    }elseif($dia_sem == 2){
    $semana = "Terça-feira";
    }elseif($dia_sem == 3){
    $semana = "Quarta-feira";
    }elseif($dia_sem == 4){
    $semana = "Quinta-feira";
    }elseif($dia_sem == 5){
    $semana = "Sexta-feira";
    }else{
    $semana = "Sábado";
    }

 	$dia= date('d', strtotime($string));

	$mes_num = date('m', strtotime($string));
 	if($mes_num == '01'){
    $mes= "Janeiro";
    }elseif($mes_num == '02'){
    $mes = "Fevereiro";
    }elseif($mes_num == '03'){
    $mes = "Março";
    }elseif($mes_num == '04'){
    $mes = "Abril";
    }elseif($mes_num == '05'){
    $mes = "Maio";
    }elseif($mes_num == '06'){
    $mes = "Junho";
    }elseif($mes_num == '07'){
    $mes = "Julho";
    }elseif($mes_num == '08'){
    $mes = "Agosto";
    }elseif($mes_num == '09'){
    $mes = "Setembro";
    }elseif($mes_num == '10'){
    $mes = "Outubro";
    }elseif($mes_num == '11'){
    $mes = "Novembro";
    }else{
    $mes = "Dezembro";
    }

    $ano = date('Y', strtotime($string));
    $hora = date('H:i', strtotime($string));
    //return $semana.', '.$dia.' de '.$mes.' de '.$ano.' '.$hora;
    return $dia.'/'.$mes_num.'/'.$ano;
}

function data_brasil($data=null){
	if($data){
		$data1 = explode("-",$data);
		$data2 = $data1[2]."/".$data1[1]."/".$data1[0];
	}else{
		$data2 = date("d/m/Y");
	}
    return($data2);
}

function data_usa($data=null){	
	if($data){
		$data1 = explode("/",$data);
		$data2 = $data1[2]."-".$data1[1]."-".$data1[0];
	}else{
		$data2 = date("Y-m-d");
	}
	return $data2;
}

function data_form(){
    return date("Y-m-d");
}

function data_form_br(){
	return date("d/m/Y");
}

function dinheiro_sql($valor){
    $valor1 = str_replace(".","",$valor);
    $valor2 = str_replace(",",".", $valor1);
    return($valor2);
}

function dinheiro($valor){
    $valor1 = number_format($valor, 2,',','.');
    return($valor1);    
}

function contar_dias($data_inicial, $data_final){
    
    // primeiramente transformar a data em padrão Ingles AAAA-MM-DD

    // Define os valores a serem usados

    // Usa a função strtotime() e pega o timestamp das duas datas:

    $time_inicial = strtotime($data_inicial);

    $time_final = strtotime($data_final);

    // Calcula a diferença de segundos entre as duas datas:

    $diferenca = $time_final - $time_inicial; // 19522800 segundos

    // Calcula a diferença de dias

    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

    // Exibe uma mensagem de resultado:
    // A diferença entre as datas 23/03/2009 e 04/11/2009 é de 225 dias
    
    return($dias);
}

function conta_vencida($data_inicial, $data_final){
    
    // primeiramente transformar a data em padrão Ingles AAAA-MM-DD

    // Define os valores a serem usados

    // Usa a função strtotime() e pega o timestamp das duas datas:

    $time_inicial = strtotime($data_inicial);

    $time_final = strtotime($data_final);

    // Calcula a diferença de segundos entre as duas datas:

    $diferenca = $time_final - $time_inicial; // 19522800 segundos

    // Calcula a diferença de dias

    $dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

    // Exibe uma mensagem de resultado:
    // A diferença entre as datas 23/03/2009 e 04/11/2009 é de 225 dias
	
	if($dias > 31){
		$vencido = 'SIM';
	}else{
		$vencido = 'NÃO';
	}
    
    return($vencido);
}

function escreve_resultado($i){
    $contador = count($i);
    if($contador>1){
        $res = "$contador restultados encontrados";
    }else{
        $res = "$contador resultado encontrado";
    }
    return $res;
}
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello/{nome}', function ($nome) {
    if(strlen($nome) < 3)
        return "O nome deve conter ao menos 3 caracteres";
    if(preg_match('/[0-9]/', $nome))
        return "Não é permitido conter números";
    return "Olá " . $nome . " Bem-vindo ao meu site";
});
Route::get('/conta/{n1}/{n2}/{operação?}', function ($n1, $n2, $operacao=null) {
    
    if(!ctype_digit($n1) || !ctype_digit($n2))
        return "Digite apenas números inteiros";
    
    $soma = $n1 + $n2;
    $subtracao = $n1 - $n2;
    $multiplicacao = $n1 * $n2;
    if($n2 == 0)
        $divisao = 0;
    else
        $divisao = $n1 / $n2;

    switch($operacao){
        case "soma":
            return "Soma = $soma";
            break;
        case "subtração":
            return "Subtração = $subtracao";
            break;
        case "multiplicação":
            return "multiplicação = $soma";
            break;
        case "divisão":
            return "Divisão = $subtracao";
            break;
        default:
            return 
            "Soma = $soma<br>
            Subtração = $subtracao<br>
            Multiplicação = $multiplicacao<br>
            Divisão = $divisao";
    }


});

Route::get('/idade/{ano}/{mes?}/{dia?}', function ($ano, $mes=null, $dia=null) {

    

    if($mes == null){
        $data = new DateTime("$ano-00-00");
        $dataAtual = new DateTime();
        $diferenca = $data->diff($dataAtual);

        return "idade = ". $diferenca->y . " anos";
    }elseif($dia == null){
        $data = new DateTime("$ano-$mes-00");
        $dataAtual = new DateTime();
        $diferenca = $data->diff($dataAtual);

        return "idade = ". $diferenca->y . " anos, " . $diferenca->m . " meses" ;
    }
    
});
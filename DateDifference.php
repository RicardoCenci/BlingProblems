<form method="get">
    <!-- If i use type='date' on those inputs, the GET recieves the date formated YYYY-mm-dd; -->
    <label for="initial">Data Inicial</label>
    <input type="text" name="initialDate" id="initial" value="29/04/2021">

    <label for="final">Data Final</label>
    <input type="text" name="finalDate" id="final" value="6/05/2021">
    <input type="submit" >
</form>
<?php

// Escreva um algoritmo que calcule o número de semanas decorridas partir de uma data inicial
// e final recebidos no formato dd/mm/aaaa. Não deve usar funções de data e hora

if (!empty($_GET)) {
    $InitialDate = $_GET["initialDate"];
    $FinalDate = $_GET["finalDate"];

    if(empty($InitialDate) or empty($FinalDate)){
        echo("One of the dates is missing");
        exit();
    }

    // Converts all the dates do Julian Days;
    $JulianInitialDate = JulianDateFrom($InitialDate);
    $JulianFinalDate = JulianDateFrom($FinalDate);

    //Diff between both dates
    $days = intval(abs(($JulianFinalDate - $JulianInitialDate)));
    $Weeks = abs(floor($days/7));
    echo("The difference between {$InitialDate} and {$FinalDate} is {$Weeks} weeks or {$days} days");
}

function JulianDateFrom(String $date){
    //Here im expecting that the $date is a safe input and formated correctly(dd/mm/yyyy)
    $date = strSplit("/",$date);
    $day = intval($date[0]);
    $month = intval($date[1]);
    $year = intval($date[2]);
    return 365*$year + floor($year/4) - floor($year/100) + floor($year/400) + $day + floor((153*$month+8)/5);
}

function strSplit(String $delimiter, String $str){
    //My implementation of strSplit
    $buffer = "";
    $final = array();
    for ($i=0; $i < strlen($str); $i++) {
        if($str[$i] == $delimiter){
            $final[count($final)] = $buffer;
            $buffer = "";
            continue;
        }
        $buffer= $buffer.$str[$i];

        if ($i+1 >= strlen($str)) {
            $final[count($final)] = $buffer;
            break;
        }
    }
    return $final;
}
?>
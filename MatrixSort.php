<style>
fieldset{border: 0;}
</style>
<form method="get">
    <h1>Matrix Sort</h1>
    <fieldset>
        <input type="number" name="1" value="5">
        <input type="number" name="2" value="4">
        <input type="number" name="3" value="3">
    </fieldset>
    <fieldset>
        <input type="number" name="4" value="8">
        <input type="number" name="5" value="7">
        <input type="number" name="6" value="6">
    </fieldset>
    <fieldset>
        <input type="number" name="7" value="2">
        <input type="number" name="8" value="1">
        <input type="number" name="9" value="0">
    </fieldset>
    <input type="submit">
    
</form>
<?php 
// Um algoritmo deve receber uma matriz 3x3 de números e reordená-la de forma crescente
// linha a linha. Exemplo:
// Entrada
//  5 4 3
//  8 6 7
//  2 1 0
//  Saída
//  0 1 2
//  3 4 5
//  6 7 8
if (!empty($_GET)) {
    $matriz = [
        [$_GET['1'],$_GET['2'],$_GET['3']],
        [$_GET['4'],$_GET['5'],$_GET['6']],
        [$_GET['7'],$_GET['8'],$_GET['9']]
    ];
    $matriz = MatrizSort($matriz);
    echo("Sorted Matrix");
    printMatriz($matriz);
}

function MatrizSort($matriz){
    function ArrSort(&$arr){
        //Im using pass by reference just to simplify the returnings
        //This is a simple insertion sort
    
        function isSorted(&$arr){
            for ($j=0; $j < count($arr)-1; $j++) { 
                if($arr[$j] < $arr[$j +1]){
                    continue;
                }else{
                    return false;
                }
            }
            return true;
        }
    
        //Probably O(n^2) but we are working with small arrays
        while (!isSorted($arr)) {
    
            for ($i=0; $i < count($arr) -1; $i++) { 
                if($arr[$i] > $arr[$i+1]){
                    $buffer = $arr[$i];
                    $arr[$i] = $arr[$i+1];
                    $arr[$i+1] = $buffer;
                }
            }
        }
    }

    //Concatenate all arrays togheter and save the number of elements in then
    $arr = mergeMatrix($matriz);
    $numberOfRows = count($matriz);
    //Sorts the array
    ArrSort($arr);

    //Then take chunks of it to assemble a matriz
    return arrDivide($arr,$numberOfRows);
}
function mergeMatrix($mat){
    $arr = [];
    $pos = 0;
    for ($i=0; $i < count($mat); $i++) { 
        for ($j=0; $j < count($mat[$i]); $j++) { 
            $arr[$pos] = $mat[$i][$j];
            $pos++;
        }
    }
    return $arr;
}
function arrDivide($arr,$numberOfRows){
    $mat = [];
    $numberOfElements = count($arr)/$numberOfRows;
    $pos = 0;
    $newArr = [];
    for ($i=0; $i < count($arr); $i++) { 
        $newArr[$pos] = $arr[$i];
        $pos++;
        if ($pos >= $numberOfElements) {
            $pos = 0;
            $mat[count($mat)+1] = array_values($newArr);
            $newArr = []; 
        }

    }
    return array_values($mat);
}
function printMatriz($matriz){
    echo("<pre>");
    for ($i=0; $i < count($matriz); $i++) {
        for ($j=0; $j < count($matriz[$i]); $j++) { 
            echo($matriz[$i][$j]." ");
        }
        echo("<br/>");
    }
    echo("</pre>");
}
?>
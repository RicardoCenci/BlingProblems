<form method="get">
    <label for="a">A</label>
    <input type="number" name="a" id="a" value='6'>
    <label for="b">B</label>
    <input type="number" name="b" id="b" value='3'>
    <label for="c">C</label>
    <input type="number" name="c" id="c" value='5'>
    <label for="d">D</label>
    <input type="number" name="d" id="d" value='7'>
    <label for="e">E</label>
    <input type="number" name="e" id="e" value='8'>
    <label for="f">F</label>
    <input type="number" name="f" id="f" value='10'>
    <input type="submit">
</form>
<?php
// Receba 6 números representando medidas a,b,c,d,e,f e relacionar quantos e quais triângulos
// é possível formar usando estas medidas. (para formar um triângulo as soma dos lados mais
// curtos deve ser maior que a medida do lado mais longo) Exemplo de saída [abc], [abd] ....
if (!empty($_GET)) {
    $arr = [
        intval($_GET['a']),
        intval($_GET['b']),
        intval($_GET['c']),
        intval($_GET['d']),
        intval($_GET['e']),
        intval($_GET['f']),
    ];
    $triangles = findTriangles($arr);
    echo "Possible Triangles<br/>";
    printMatriz($triangles);
}

function findTriangles($arr){
    $size = count($arr);
    $triangles = array();
    
    //First i sort the array
    //Here im using the insertion sort that i build from the last algorithm
    ArrSort($arr);

    for ($i = $size - 1; $i >= 1; $i--) { 
        //Take the index of the last 2 numbers
        $j = 0;
        $k = $i - 1;
        while ($j < $k) {
            //Test if the First number + penultimate number > last number
            if( $arr[$j] + $arr[$k] > $arr[$i] ){
                for ($p = $j; $p < $k ; $p++) {
                    //Because the array is sorted, we can garantee
                    //That the number that enters here is the minimun number
                    //to form a triangle, so, just iterate over J and K to find all the others 
                    //All the numbers between them are valid triangles
                    array_push($triangles, [$arr[$p],$arr[$k],$arr[$i]]); 
                }
                $k--;
            }else{
                $j++;
            }
        }
    }
    return $triangles;
}

function ArrSort(&$arr){
    //Im using pass by reference just to simplify the return
    //This is a simple insertion sort made by me

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

function printArr($arr){
    for ($i=0; $i < count($arr); $i++) { 
        echo($arr[$i]." ");
    }
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
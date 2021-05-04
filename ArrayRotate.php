<form method="get">
    <label for="arr">Array(separed by comma)</label>
    <input type="text" name="arr" id="arr" value='1,2,3,4,5,6'>
    <label for="positions">Positions</label>
    <input type="number" name="positions" id="positions" value='2'>
    <label for="RTL">Rotate Right to Left</label>
    <input type="radio" name="RTL" id="RTL">
    <input type="submit">
</form>
<?php

if (!empty($_GET)) {
    $arr = explode(",",$_GET['arr']);
    $RTL = !empty($_GET['RTL']);
    $positions = intval($_GET['positions']);

    //Im using pass by reference;
    arrRotate($arr,$positions, $RTL);


    print("Output, rotated by: {$positions} positions<br/>");
    printArr($arr);
}



function arrRotate(array &$arr, int $positions, bool $rightToLeft = false){

    function rotate(&$arr, $head, $tail){
        while ($head < $tail) {
            //Swap the elements
            $buffer = $arr[$head];
            $arr[$head] = $arr[$tail];
            $arr[$tail] = $buffer;
            $head++;
            $tail--;
        }
        return $arr;
    }

    $arrLength= count($arr)-1;
    if($rightToLeft){
        //Starts rotating on the last element that need to be rotated right to left
        rotate($arr,$arrLength - $positions +1, $arrLength);
        //Rotate the rest of the array, exept the positions
        rotate($arr,0,$arrLength - $positions);
 
    }else{
        //Rotate the positions
        rotate($arr,0, $positions-1);
        //Rotate the rest of the array, exept the positions
        rotate($arr,$positions,$arrLength);
    }
    //Rotate all the array
    rotate($arr,0,$arrLength);
}

function printArr($arr){
    for ($i=0; $i < count($arr); $i++) { 
        echo($arr[$i]." ");
    }
}
?>

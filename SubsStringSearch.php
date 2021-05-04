<form method="GET">
    <label for="needle">Needle</label>
    <input type="text" name="needle" id="needle" value="lazy">
    <label for="needle">Haystack</label>
    <input type="text" name="haystack" id="haystack" value="The brown fox jumped over the lazy dog">
    <input type="submit">
</form>
<?php
// Um algoritmo deve buscar um sub-texto dentro de um texto fornecido e retornar a quantidade
// de vezes que ele ocorre. (Não usar funções de busca em string). 

if (!empty($_GET['needle']) and !empty($_GET['haystack'])) {
    echo "There was ".search($_GET['needle'], $_GET['haystack'])." occurrences of the pattern ' {$_GET['needle']} ' in the text";
}else{
    echo "Please input all the required fields";
    exit();
}

function search($needle, $haystack){
    //A simple naive algorithm to search substrings
    $haystackLen = strlen($haystack);
    $buffer = "";
    $occurrences = 0;
    // $haystackLen - strlen($needle) -1 ignores the last latter because there is no way to match the needle there
    for ($i=0; $i <= $haystackLen - strlen($needle); $i++) { 

        if ($haystack[$i] == $needle[0]) {
            //Check if the first char on the needle is the same as the haystack, if it is, iterate over the needle lenght to test if its a match
            $j=0;
            for (; $j < strlen($needle); $j++) { 

                if ($haystack[$i + $j] == $needle[$j]) {
                    //Stores is in a buffer to test later if the pattern is match
                    $buffer = $buffer.$haystack[$i + $j];
                }else{
                    break;
                }
            }

            $i = ($i+$j)-1;
            if ($buffer == $needle) {
                $occurrences++;
            }
            $buffer = "";

        }
    }
    return $occurrences;
}

?>
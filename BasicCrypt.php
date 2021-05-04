<form method="get" enctype="multipart/form-data">
    <label for="value">Number</label>
    <input type="number" name="input" step="0.01" id="value">
    <label for="key">key</label>
    <input type="text" name="key" id="key">
    <input type="submit" >
</form>
<?php

// Um algoritmo deve ler uma sequência de 10 caracteres como uma chave representando os
// dígitos de 0 a 9, depois deve ler um número e apresentá-lo cifrado com esta chave. Exemplo:
// chave “abcdefghij” número “123,40” saída “bcd,ea” 

if (!empty($_GET)) {
    $input = $_GET['input'];
    $key = $_GET['key'];
    for ($i=0; $i < strlen($input); $i++) {
        if ($input[$i] == ".") {
            $input[$i] = ",";
            continue;
        }
        $keyIndex = intval($input[$i]);
        $input[$i] = $key[$keyIndex];
    }
    echo $input;
}
?>
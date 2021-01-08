<?php

var_dump ($_FILES);

//var_dump ($_SERVER);
function momentoCGI(){
    echo "<h1>Ambiente CGI</h1>".PHP_EOL;

    $ul = "<ul>";
    foreach ($_SERVER as $chave=>$valor){
        $li = "<li><mark>$chave</mark>".PHP_EOL;
        //.= concatenação cumulativa
        $li.=": $valor</li>";

        $ul.=$li;
    }//foreach
    $ul."</ul>";

    echo $ul;

    /*
     * estamos a acompanhar esta escrita com Git
     * queremos introduzir git branch
     * criar "ramos" / "contextos de dev"
     * git branch <nomeDoRamo>
     * por exemplo, fizémos
     * git branch get
     * mas depois não gostamos do nome "get"
     * e quisemos mudá-lo para "branchGet"
     * git branch -m get branchGet
     *
     * para passar a trabalhar no context do novo
     * ramos
     *
     * git checkout <nomeDoRamo>
     * no nosso caso
     * git checkout branchGet
     *
     * e estou no branch
     */
}

//momento1();

/*
 * exemplo de receber por $_GET
 */
function momentoGet(){
    //receção por GET
    echo "<h2>Recebido por GET:</h2>";
    foreach (
        $_GET as
        $nameUsadoNoHtml => $valorFornecido
    ){
        echo "$nameUsadoNoHtml : $valorFornecido<br>";
    }//foreach
}//momentoGet

function momentoPost(){
    //receção por GET
    echo "<h2>Recebido por POST:</h2>";
    foreach (
        $_POST as
        $nameUsadoNoHtml => $valorFornecido
    ){
        echo "$nameUsadoNoHtml : $valorFornecido<br>";
    }//foreach
}//momentoPost

function momentoPostCom1Binario(){
    //receção por POST
    echo "<h2>Recebido por POST com suporte a 1 binário:</h2>";
    foreach (
        $_POST as
        $nameUsadoNoHtml => $valorFornecido
    ){
        echo "$nameUsadoNoHtml : $valorFornecido<br>";
    }//foreach

    foreach($_FILES as $nameUsadoNoHtml => $valorFornecido){
        receiveSingleFile($nameUsadoNoHtml);
    }

}//momentoPostCom1Binario

function bThereAreMultipleBinaries(
    $pHtmlFileElementName
){
    $b = is_array($_FILES[$pHtmlFileElementName]['name']) &&
        count($_FILES[$pHtmlFileElementName]['name'])>0;

    return $b;
}//bThereAreMultipleBinaries

/*
 * 'name' => string 'amemail_v7.pptx' (length=15)
      'type' => string 'application/vnd.openxmlformats-officedocument.presentationml.presentation' (length=73)
      'tmp_name' => string 'H:\PHP.TEMP\php1872.tmp' (length=23)
      'error' => int 0
      'size' => int 433639
 */
function receiveSingleFile(
    $pHtmlFileElementName
){
    $strName = $_FILES[$pHtmlFileElementName]['name'];
    $strTmp = $_FILES[$pHtmlFileElementName]['tmp_name'];
    $strType = $_FILES[$pHtmlFileElementName]['type'];
    $e = $_FILES[$pHtmlFileElementName]['error'];
    $size = $_FILES[$pHtmlFileElementName]['size'];

    if ($e===0){
        $bFalseOnFailure =
            move_uploaded_file(
                $strTmp,
                $strName
            );

        if ($bFalseOnFailure!==false){
            echo "Recebi o ficheiro ".$strName."<BR>";
        }
        return $bFalseOnFailure;
    }
    return false;
}


momentoCGI();
momentoGet();
momentoPost();
momentoPostCom1Binario();

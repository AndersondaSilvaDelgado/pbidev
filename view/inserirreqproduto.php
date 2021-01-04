<?php

require_once('../control/ReqProdutoCTR.class.php');

$info = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($info)):

    $reqProdutoCTR = new ReqProdutoCTR();
    echo $reqProdutoCTR->salvarReqProduto($info, "inserirreqproduto");

endif;

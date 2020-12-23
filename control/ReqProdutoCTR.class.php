<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/ReqProdutoDAO.class.php');
/**
 * Description of ReqProduto
 *
 * @author anderson
 */
class ReqProdutoCTR {
    //put your code here
    
    private $base = 2;
    
    public function salvarReqProduto($info, $pagina) {

        $dados = $info['dado'];
        $this->salvarLog($dados, $pagina);

        $jsonObjReqProduto = json_decode($dados);

        $dadosReqProduto = $jsonObjReqProduto->reqproduto;

        $reqProdutoDAO = new ReqProdutoDAO();
        $idReqProdArray = array();
        foreach ($dadosReqProduto as $req) {
            $v = $reqProdutoDAO->verifReqProd($req, $this->base);
            if ($v == 0) {
                $reqProdutoDAO->insReqProd($req, $this->base);
            }
            $idReqProdArray[] = array("idReqProduto" => $req->idReqProduto);
        }
        $dadoReqProd = array("reqproduto"=>$idReqProdArray);
        $retReq = json_encode($dadoReqProd);
        return "REQPRODUTO#" . $retReq;
    }
    
}

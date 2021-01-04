<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/LogDAO.class.php');
require_once('../model/dao/CabecReqProdDAO.class.php');
require_once('../model/dao/ItemReqProdDAO.class.php');
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

        $pos1 = strpos($dados, "_") + 1;

        $cabec = substr($dados, 0, ($pos1 - 1));
        $item = substr($dados, $pos1);

        $jsonObjCabec = json_decode($cabec);
        $jsonObjItem = json_decode($item);

        $dadosCabec = $jsonObjCabec->cabec;
        $dadosItem = $jsonObjItem->item;

        $cabecReqProdDAO = new CabecReqProdDAO();
        $idCabecArray = array();
        foreach ($dadosCabec as $cabec) {
            $v = $cabecReqProdDAO->verifCabec($cabec, $this->base);
            if ($v == 0) {
                $cabecReqProdDAO->insCabec($cabec, $this->base);
            }
            $idCabec = $cabecReqProdDAO->idCabec($cabec, $this->base);
            $this->salvarItem($idCabec, $cabec->idCabecReqProd, $dadosItem);
            $idCabecArray[] = array("idCabecReqProd" => $cabec->idCabecReqProd);
        }
        $dadoCabec = array("cabec"=>$idCabecArray);
        $retCabec = json_encode($dadoCabec);
        return "REQPRODUTO#" . $retCabec . "_";
        
    }
    
    private function salvarItem($idCabecBD, $idCabecCel, $dadosItem) {
        
        $itemReqProdDAO = new ItemReqProdDAO();
        $idItemArray = array();
        foreach ($dadosItem as $item) {
            if ($idCabecCel == $item->idCabecItemReqProd) {
                $v = $itemReqProdDAO->verifItem($idCabecBD, $item, $this->base);
                if ($v == 0) {
                    $itemReqProdDAO->insItem($idCabecBD, $item, $this->base);
                }
                $idItemArray[] = array("idItemReqProd"=>$item->idItemReqProd, "idCabecItemReqProd"=>$idCabecCel);
            }
        }
        $dadoItem = array("item"=>$idItemArray);
        $retItem = json_encode($dadoItem);
        return $retItem;
        
    }
    
    private function salvarLog($dados, $pagina) {
        $logDAO = new LogDAO();
        $logDAO->salvarDados($dados, $pagina, $this->base);
    }
    
}

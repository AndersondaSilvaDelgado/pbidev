<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
require_once ('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of ReqProdutoDAO
 *
 * @author anderson
 */
class ReqProdutoDAO extends Conn {
    //put your code here
    
    //put your code here
    public function verifReqProd($req, $base) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PBI_REQ_PROD "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $req->dthrReqProd . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNC_ID = " . $req->idFuncReqProd . " ";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
    }

    public function idReqProd($req, $base) {

        $select = " SELECT "
                . " ID AS ID "
                . " FROM "
                . " PBI_REQ_PROD "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $req->dthrReqProd . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNC_ID = " . $req->idFuncReqProd;

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $id = $item['ID'];
        }

        return $id;
    }

    public function insReqProd($req, $base) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PBI_REQ_PROD ("
                . " FUNC_ID "
                . " , OS_NRO"
                . " , ITEM_OS "
                . " , PROD_ID"
                . " , QTDE_PROD "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " , APARELHO_ID "
                . " ) "
                . " VALUES ("
                . " " . $req->idFuncReqProd
                . " , " . $req->osReqProd
                . " , " . $req->itemOSReqProd
                . " , " . $req->idProdReqProd
                . " , " . $req->qtdeReqProd
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($req->dthrReqProd, $base)
                . " , TO_DATE('" . $req->dthrReqProd . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , " . $req->aparelhoReqProd
                . " )";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }

    
}

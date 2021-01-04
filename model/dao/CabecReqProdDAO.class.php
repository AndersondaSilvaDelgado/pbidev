<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
require_once ('../model/dao/AjusteDataHoraDAO.class.php');
/**
 * Description of CabecReqProdDAO
 *
 * @author anderson
 */
class CabecReqProdDAO extends Conn {
    
    
    public function verifCabec($cabec, $base) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PBI_CABEC_REQ_PROD "
                . " WHERE "
                . " DTHR_INICIAL_CEL = TO_DATE('" . $cabec->dthrInicialCabecReqProd . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNC_ID = " . $cabec->idFuncCabecReqProd . " "
                . " AND "
                . " OS_NRO = " . $cabec->nroOSCabecReqProd . " ";

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

    public function idCabec($cabec, $base) {

        $select = " SELECT "
                . " ID AS ID "
                . " FROM "
                . " PBI_CABEC_REQ_PROD "
                . " WHERE "
                . " DTHR_INICIAL_CEL = TO_DATE('" . $cabec->dthrInicialCabecReqProd . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " FUNC_ID = " . $cabec->idFuncCabecReqProd . " "
                . " AND "
                . " OS_NRO = " . $cabec->nroOSCabecReqProd . " ";

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
    
    public function insCabec($cabec, $base) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PBI_CABEC_REQ_PROD ("
                . " FUNC_ID "
                . " , APARELHO_ID "
                . " , OS_NRO "
                . " , ITEM_OS "
                . " , DTHR_INICIAL "
                . " , DTHR_INICIAL_CEL "
                . " , DTHR_INICIAL_TRANS "
                . " , DTHR_FINAL "
                . " , DTHR_FINAL_CEL "
                . " , DTHR_FINAL_TRANS "
                . " , STATUS "
                . " ) "
                . " VALUES ("
                . " " . $cabec->idFuncCabecReqProd
                . " , " . $cabec->aparelhoCabecReqProd
                . " , " . $cabec->nroOSCabecReqProd
                . " , " . $cabec->itemOSCabecReqProd
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($cabec->dthrInicialCabecReqProd, $base)
                . " , TO_DATE('" . $cabec->dthrInicialCabecReqProd . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($cabec->dthrFinalCabecReqProd, $base)
                . " , TO_DATE('" . $cabec->dthrFinalCabecReqProd . "','DD/MM/YYYY HH24:MI') "
                . " , SYSDATE "
                . " , " . $cabec->statusCabecReqProd
                . " )";
        
        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}

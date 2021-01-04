<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemReqProdDAO
 *
 * @author anderson
 */
class ItemReqProdDAO extends Conn {
    
    
    public function verifItem($idCabec, $item, $base) {

        $select = " SELECT "
                . " COUNT(*) AS QTDE "
                . " FROM "
                . " PBI_ITEM_REQ_PROD "
                . " WHERE "
                . " DTHR_CEL = TO_DATE('" . $item->dthrItemReqProd . "','DD/MM/YYYY HH24:MI') "
                . " AND "
                . " CABEC_ID = " . $idCabec
                . " AND "
                . " PROD_ID = " . $item->idProdItemReqProd;

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $it) {
            $v = $it['QTDE'];
        }

        return $v;
    }

    public function insItem($idCabec, $item, $base) {

        $ajusteDataHoraDAO = new AjusteDataHoraDAO();

        $sql = "INSERT INTO PBI_ITEM_REQ_PROD ("
                . " CABEC_ID "
                . " , PROD_ID "
                . " , EMBPROD_ID "
                . " , LOCALPAD_ID "
                . " , QTDE_PROD "
                . " , DTHR "
                . " , DTHR_CEL "
                . " , DTHR_TRANS "
                . " ) "
                . " VALUES ("
                . " " . $idCabec
                . " , " . $item->idProdItemReqProd
                . " , " . $item->idEmbItemReqProd
                . " , " . $item->idLocalItemReqProd
                . " , " . $item->qtdeItemReqProd
                . " , " . $ajusteDataHoraDAO->dataHoraGMT($item->dthrItemReqProd, $base)
                . " , TO_DATE('" . $item->dthrItemReqProd . "','DD/MM/YYYY HH24:MI')"
                . " , SYSDATE "
                . " )";

        $this->Conn = parent::getConn($base);
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}

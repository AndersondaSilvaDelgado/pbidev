<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of LocalProdDAO
 *
 * @author anderson
 */
class DepProdDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($base) {

        $select = " SELECT "
                    . " LOCALPAD_ID AS \"idLocalProd\" "
                    . " , DEPPROD_ID AS \"idLocal\" "
                    . " , EMBPROD_ID AS \"idEmbProd\" "
                . " FROM "
                    . " USINAS.VMB_PROD_DEP_INDU "
                . " ORDER BY "
                    . " NOME "
                . " ASC ";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of EmbalProdDAO
 *
 * @author anderson
 */
class EmbalProdDAO extends Conn {
    //put your code here
    
/** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($base) {

        $select = " SELECT "
                    . " EMBPROD_ID AS \"idEmbalProd\" "
                    . " , EMBAL_ID AS \"idEmbal\" "
                    . " , DADOSPROD_ID AS \"idProd\" "
                . " FROM "
                    . " USINAS.VMB_PROD_INDU ";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}

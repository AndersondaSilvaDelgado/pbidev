<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of ProdutoDAO
 *
 * @author anderson
 */
class ProdutoDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($base) {

//        $select = " SELECT DISTINCT "
//                    . " DADOSPROD_ID AS \"idProduto\" "
//                    . " , CD AS \"codProduto\" "
//                    . " , CARACTER(DESCR) AS \"descrProduto\" "
//                . " FROM "
//                    . " USINAS.VMB_PROD_INDU "
//                . " ORDER BY "
//                    . " CD "
//                . " ASC ";
        
        $select = " SELECT "
                    . " DADOSPROD_ID "
                    . " , CD "
                    . " , CARACTER(DESCR) "
                . " FROM "
                    . " USINAS.VMB_PROD_INDU "
                . " GROUP BY "
                    . " DADOSPROD_ID "
                    . " , CD "
                    . " , CARACTER(DESCR) "
                . " HAVING "
                    . " COUNT(DADOSPROD_ID) > 1 ";

        $this->Conn = parent::getConn($base);
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of LocalDAO
 *
 * @author anderson
 */
class LocalDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados($base) {

        $select = " SELECT "
                    . " DEPPROD_ID AS \"idLocal\" "
                    . " , CARACTER(NOME) AS \"descrLocal\" "
                . " FROM "
                    . " USINAS.DEP_PROD "
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

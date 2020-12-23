<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/ColabDAO.class.php');
require_once('../model/dao/DepProdDAO.class.php');
require_once('../model/dao/DepositoDAO.class.php');
require_once('../model/dao/EmbalProdDAO.class.php');
require_once('../model/dao/EmbalagemDAO.class.php');
require_once('../model/dao/EscalaTrabDAO.class.php');
require_once('../model/dao/ItemOSDAO.class.php');
require_once('../model/dao/OSDAO.class.php');
require_once('../model/dao/ParadaDAO.class.php');
require_once('../model/dao/ProdutoDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    private $base = 2;
    
    public function dadosColab($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $colabDAO = new ColabDAO();
        
            $dados = array("dados"=>$colabDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosDepProd($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $depProdDAO = new DepProdDAO();
        
            $dados = array("dados"=>$depProdDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosDeposito($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $depositoDAO = new DepositoDAO();
        
            $dados = array("dados"=>$depositoDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosEmbalProd($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $embalProdDAO = new EmbalProdDAO();
        
            $dados = array("dados"=>$embalProdDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosEmbalagem($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $embalagemDAO = new EmbalagemDAO();
        
            $dados = array("dados"=>$embalagemDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosEscalaTrab($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $escalaTrabDAO = new EscalaTrabDAO();
        
            $dados = array("dados"=>$escalaTrabDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosOS($versao, $info) {

        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
        
            $osDAO = new OSDAO();
            $itemOSDAO = new ItemOSDAO();

            $dado = $info['dado'];

            $dadosOS = array("dados" => $osDAO->dados($dado, $this->base));
            $resOS = json_encode($dadosOS);

            $dadosItemOS = array("dados" => $itemOSDAO->dados($dado, $this->base));
            $resItemOS = json_encode($dadosItemOS);

            return $resOS . "#" . $resItemOS;

        }
        
    }

    public function dadosParada($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $paradaDAO = new ParadaDAO();
        
            $dados = array("dados"=>$paradaDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    public function dadosProduto($versao) {
        
        $versao = str_replace("_", ".", $versao);
       
        if($versao >= 1.00){
            
            $produtoDAO = new ProdutoDAO();
        
            $dados = array("dados"=>$produtoDAO->dados($this->base));
            $json_str = json_encode($dados);

            return $json_str;
        
        }
        
    }
    
    
}

<?php

include_once($path_classes . 'fla_conexao.class.php');
class fla_empresas {
    private $cod_empresa;
    private $nom_fantasia;
    private $raz_social;
    private $num_cpnj;
    private $num_insc_municipal;
    private $num_ie;
    private $cep_empresa;
    private $des_endereco;
    private $des_bairro;
    private $des_estado;
    private $des_cidade;
    private $num_telefone;
    private $num_celular;
    private $tip_empresa;
    private $ind_disponivel;
    
    public function get_cod_empresa() {
        return $this->cod_empresa;
    }

    public function set_cod_empresa($cod_empresa) {
        $this->cod_empresa = $cod_empresa;
    }

    public function get_nom_fantasia() {
        return $this->nom_fantasia;
    }

    public function set_nom_fantasia($nom_fantasia) {
        $this->nom_fantasia = $nom_fantasia;
    }

    public function get_raz_social() {
        return $this->raz_social;
    }

    public function set_raz_social($raz_social) {
        $this->raz_social = $raz_social;
    }

    public function get_num_cpnj() {
        return $this->num_cpnj;
    }

    public function set_num_cpnj($num_cpnj) {
        $this->num_cpnj = $num_cpnj;
    }

    public function get_num_insc_municipal() {
        return $this->num_insc_municipal;
    }

    public function set_num_insc_municipal($num_insc_municipal) {
        $this->num_insc_municipal = $num_insc_municipal;
    }

    public function get_num_ie() {
        return $this->num_ie;
    }

    public function set_num_ie($num_ie) {
        $this->num_ie = $num_ie;
    }

    public function get_cep_empresa() {
        return $this->cep_empresa;
    }

    public function set_cep_empresa($cep_empresa) {
        $this->cep_empresa = $cep_empresa;
    }

    public function get_des_endereco() {
        return $this->des_endereco;
    }

    public function set_des_endereco($des_endereco) {
        $this->des_endereco = $des_endereco;
    }

    public function get_des_bairro() {
        return $this->des_bairro;
    }

    public function set_des_bairro($des_bairro) {
        $this->des_bairro = $des_bairro;
    }

    public function get_des_estado() {
        return $this->des_estado;
    }

    public function set_des_estado($des_estado) {
        $this->des_estado = $des_estado;
    }

    public function get_des_cidade() {
        return $this->des_cidade;
    }

    public function set_des_cidade($des_cidade) {
        $this->des_cidade = $des_cidade;
    }

    public function get_num_telefone() {
        return $this->num_telefone;
    }

    public function set_num_telefone($num_telefone) {
        $this->num_telefone = $num_telefone;
    }

    public function get_num_celular() {
        return $this->num_celular;
    }

    public function set_num_celular($num_celular) {
        $this->num_celular = $num_celular;
    }

    public function get_tip_empresa() {
        return $this->tip_empresa;
    }

    public function set_tip_empresa($tip_empresa) {
        $this->tip_empresa = $tip_empresa;
    }

    public function get_ind_disponivel() {
        return $this->ind_disponivel;
    }

    public function set_ind_disponivel($ind_disponivel) {
        $this->ind_disponivel = $ind_disponivel;
    }

    public function insereEmpresa() {
        
    }
}
?>

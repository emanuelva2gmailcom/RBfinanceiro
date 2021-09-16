<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;

class RelatoriosController extends AppController
{
    public function caixadiario()
    {
        $this->loadModel('Lancamentos');
        $this->loadModel('Fluxocontas');
        $this->loadModel('Fornecedores');
        $this->loadModel('Clientes');
        $this->paginate = [
            'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes'],
        ];
        $lancamentos = $this->paginate($this->Lancamentos);
        $arrays = [];
        foreach($lancamentos as $lancamento):
            $teste =  FrozenTime::now()->i18nFormat('yyyy-MM-dd');
            if(($lancamento->data_baixa !== null) && ($lancamento->data_baixa->i18nFormat('yyyy-MM-dd') == $teste)) {

                // debug($lancamento->data_baixa->i18nFormat('yyyy-MM-dd'));debug($teste);
                if($lancamento->tipo == 'REALIZADO') {
                    array_push($arrays, [$lancamento->valor, 
                            $lancamento->fluxoconta->conta, 
                            $lancamento->fornecedore->nome,
                            $lancamento->cliente->nome,
                            $lancamento->descricao]);
                }
            }
        endforeach;
        $this->set(compact('arrays'));
    }

    public function dre()
    {

    }

    public function fluxodecaixa()
    {

    }

    public function gerencial()
    {
        
    }
}
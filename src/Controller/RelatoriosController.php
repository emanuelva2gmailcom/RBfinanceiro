<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;

class RelatoriosController extends AppController
{
    public function caixadiario()
    {
        $this->loadModel('Lancamentos');
        $this->paginate = [
            'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']] , 'Fornecedores', 'Clientes'],
            'conditions' => ['data_baixa is not' => null] 
        ];

        $lancamentos = $this->paginate($this->Lancamentos);

        $arrays = [];
        foreach($lancamentos as $lancamento):
            $teste =  FrozenTime::now()->i18nFormat('yyyy-MM-dd', 'UTC');
            $grupo = $lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo;
            if(($lancamento->data_baixa->i18nFormat('yyyy-MM-dd') == $teste)) {
                if($grupo == 'entrada'){
                    $lancamento->valor = '+'.$lancamento->valor;
                }else{
                    $lancamento->valor = '-'.$lancamento->valor;
                }
                
                if($lancamento->tipo == 'REALIZADO') {
                    array_push($arrays, [$lancamento->valor, 
                    $lancamento->fluxoconta ? $lancamento->fluxoconta->conta : '', 
                    $lancamento->fornecedore ? $lancamento->fornecedore->nome : '',
                    $lancamento->cliente ? $lancamento->cliente->nome : '',
                    $lancamento->descricao,
                    ]);
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
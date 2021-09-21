<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;

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

    public function array_date($ini = null, $fim = null)
    {
        $resposta = [];
        $ini = new Time($ini, 'UTC');
        $fim = new Time($fim, 'UTC');
        while($ini < $fim){
            $ini->modify('+1 days');
            array_push($resposta, $ini);
            
        }
        debug($resposta);debug($ini);debug($fim);exit;
    }
    
    public function gerencial()
    {
        $cu = false;
        $data = [];
        if ($this->request->is('post')) {
            $response = $this->request->getdata();
            $this->array_date($response['comeco'], $response['final']);
            
            $this->loadModel('Lancamentos');
            $this->loadModel('Fluxocontas');
            $this->paginate = [
                'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']] , 'Fornecedores', 'Clientes'], 
            ];
            $lancamentos = $this->paginate($this->Lancamentos);
            
            $contas = $this->Fluxocontas->find('all', ['contain' => ['Fluxosubgrupos' => ['Fluxogrupos']]]);

            $results = [];
            foreach($contas as $conta):
                $valor = 0;
                foreach($lancamentos as $lancamento):
                    if($conta->fluxosubgrupo->fluxogrupo->grupo == 'entrada' && $lancamento->fluxoconta->conta == $conta->conta){
                        $valor += intval($lancamento->valor);
                    }else if($conta->fluxosubgrupo->fluxogrupo->grupo == 'saida' && $lancamento->fluxoconta->conta == $conta->conta){
                        $valor -= intval('-'.$lancamento->valor);
                    }
                endforeach;
                array_push($results, ['conta' => $conta->conta, 'valor' => $valor, 'tipo' => $conta->fluxosubgrupo->fluxogrupo->grupo]);
            endforeach;
            $cu = true;
            $this->set(compact('results', 'cu'));
        }
        $this->set(compact('cu'));
    }

    public function dre()
    {

    }

    public function fluxodecaixa()
    {

    }

}
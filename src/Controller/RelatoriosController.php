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
        if($ini > $fim){return $this->redirect(['action' => 'index']);}
        while($ini <= $fim){
            array_push($resposta, $ini->i18nFormat('yyyy-MM-dd'));
            $ini->modify('+1 days');
        }
        return $resposta;
    }

    public function array_soma($array = null, $ii = null)
    {
        $resposta = 0;
        for($i = $ii; $i < count($array); $i++): 
            $resposta += $array[$i];
        endfor; 
        return $resposta;
    }
    
    public function gerencial()
    {
        $cu = false;
        if ($this->request->is('post')) {
            
            $response = $this->request->getdata();
            if(FrozenTime::now()->i18nFormat('yyyy-MM-dd') < $response['final']){return $this->redirect(['action' => 'index']);}
            $datas = $this->array_date($response['comeco'], $response['final']);
            $valores = [];
            $saidas = [];
            $entradas = [];

            $this->loadModel('Lancamentos');
            $this->loadModel('Fluxocontas');
            $this->paginate = [
                'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']] , 'Fornecedores', 'Clientes'], 
                'conditions' => ['tipo' => 'REALIZADO']
            ];
            $lancamentos = $this->paginate($this->Lancamentos);
            
            $contas = $this->Fluxocontas->find('all', ['contain' => ['Fluxosubgrupos' => ['Fluxogrupos']]]);
            
            $result = [];
                foreach($contas as $conta):
                    $result = [];
                    foreach($datas as $data):
                        $valor = null;
                        foreach($lancamentos as $lancamento):
                            if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') && ($lancamento->fluxoconta->conta == $conta->conta) && ($data == $lancamento->data_baixa->i18nFormat('yyyy-MM-dd'))){
                                $valor += intval($lancamento->valor);
                            }
                            else if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') && ($lancamento->fluxoconta->conta == $conta->conta) && ($data == $lancamento->data_baixa->i18nFormat('yyyy-MM-dd'))){
                                $valor += intval('-'.$lancamento->valor);
                            }
                        endforeach;
                        array_push($result, $valor);
                    endforeach;
                    array_unshift($result, $conta->conta);
                    array_push($result, $this->array_soma($result, 1));
                    array_push($valores, $result);
                endforeach;
            
            foreach($contas as $conta):
                if($conta->fluxosubgrupo->fluxogrupo->grupo == 'entrada'){
                    array_push($entradas, $conta->conta);
                }else if($conta->fluxosubgrupo->fluxogrupo->grupo == 'saida'){
                    array_push($saidas, $conta->conta);
                }
            endforeach;
            $cu = true;
            $this->set(compact('valores', 'cu', 'saidas', 'entradas', 'datas'));
        }
        $this->set(compact('cu'));
    }

    public function dre()
    {

    }

    public function fluxodecaixa()
    {
        $cu = false;
        if ($this->request->is('post')) {
            
            $response = $this->request->getdata();
            if(FrozenTime::now()->i18nFormat('yyyy-MM-dd') < $response['final']){return $this->redirect(['action' => 'index']);}
            $datas = $this->array_date($response['comeco'], $response['final']);
            $valores = [];
            $saidas = [];
            $entradas = [];

            $this->loadModel('Lancamentos');
            $this->loadModel('Fluxocontas');
            $this->paginate = [
                'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']] , 'Fornecedores', 'Clientes'], 
                'conditions' => ['tipo' => 'PREVISTO']
            ];
            $lancamentos = $this->paginate($this->Lancamentos);
            
            $contas = $this->Fluxocontas->find('all', ['contain' => ['Fluxosubgrupos' => ['Fluxogrupos']]]);
            $result = [];
            
            foreach($contas as $conta):
                if($conta->fluxosubgrupo->fluxogrupo->grupo == 'entrada'){
                    array_push($entradas, $conta->conta);
                }else if($conta->fluxosubgrupo->fluxogrupo->grupo == 'saida'){
                    array_push($saidas, $conta->conta);
                }
            endforeach;

            $totale = [];
            $totals = [];

            foreach($datas as $data):
                $totale[$data] = null;
                $totals[$data] = null;
            endforeach;
            foreach($contas as $conta):
                $result = [];
                foreach($datas as $data):
                    
                    $valor = null;
                    foreach($lancamentos as $lancamento):
                        if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') && ($lancamento->fluxoconta->conta == $conta->conta) && ($data == $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'))){
                            $valor += intval($lancamento->valor);
                        }
                        else if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') && ($lancamento->fluxoconta->conta == $conta->conta) && ($data == $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'))){
                            $valor += intval('-'.$lancamento->valor);
                        }
                    endforeach;
                    if(in_array($conta->conta, $entradas)) {
                        $totale[$data] += $valor;
                    }else if(in_array($conta->conta, $entradas)){
                        $totals[$data] += $valor;
                    }
                    array_push($result, $valor);
                endforeach;
                
                array_unshift($result, $conta->conta);
                array_push($result, $this->array_soma($result, 1));
                array_push($valores, $result);
            endforeach;
            $cu = true;
            $this->set(compact('valores', 'cu', 'saidas', 'entradas', 'datas', 'totale', 'totals'));
        }
        $this->set(compact('cu'));
    }

    public function index()
    {

    }
}
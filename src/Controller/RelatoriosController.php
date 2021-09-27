<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\Http\Client;
use Cake\Http\Client\Request as ClientRequest;

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
    
    public function dre()
    {
    }

    public function total_before($data = null, $lancamentos = null, $namedata = null)
    {
        $valor = 0;
        $date = new Time($data, 'UTC');
        $data = $date->modify('-1 days');
        foreach($lancamentos as $l):
            if($l->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada' && $data->i18nFormat('yyyy-MM-dd') == $l->$namedata->i18nFormat('yyyy-MM-dd')){
                $valor += $l->valor;
            }else if($l->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida' && $data->i18nFormat('yyyy-MM-dd') == $l->$namedata->i18nFormat('yyyy-MM-dd')){
                $valor -= $l->valor;
            }
        endforeach;
        return $valor;
    }

    public function getRelatorio($tipo = null)
    {
        $obj = ['header' => [],
                'rows' =>[
                    'th' => [
                        'entradas' => [],
                        'saidas' => []
                    ],
                    'td' => []
                ],
                'total' => [
                    'entradas' => [],
                    'saidas' => [],
                    'entradas-saidas' => [],
                    'inicial' => [],
                    'final' => []
                ]
            ];
            $this->loadModel('Lancamentos');
            $this->loadModel('Fluxocontas');
            $this->paginate = [
                'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']] , 'Fornecedores', 'Clientes'], 
                'conditions' => ['tipo' => $tipo]
            ];
            $lancamentos = $this->paginate($this->Lancamentos);
            $comeco = FrozenTime::now()->i18nFormat('yyyy-MM-dd');
            $final = null;
            foreach($lancamentos as $lancamento):
                if($lancamento->data_vencimento->i18nFormat('yyyy-MM-dd') >= $comeco){
                    $final = $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd');
                }
            endforeach;
            $obj['header'] = $this->array_date($comeco, $final);
            $obj['total']['inicial'] = [$this->total_before($comeco, $lancamentos, 'data_vencimento')];
            $contas = [];
            $result = [];
            
            foreach($lancamentos as $lancamento):
                if(in_array($lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'), $obj['header'])){
                    if($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada'){
                        array_push($obj['rows']['th']['entradas'], $lancamento->fluxoconta->conta);
                    }else if($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida'){
                        array_push($obj['rows']['th']['saidas'], $lancamento->fluxoconta->conta);
                    }
                    if(!in_array($lancamento->fluxoconta->conta, $contas)){
                        array_push($contas, $lancamento->fluxoconta->conta);
                    }
                }
            endforeach;

            foreach($obj['header'] as $data):
                $obj['total']['entradas'][$data] = null;
                $obj['total']['saidas'][$data] = null;
            endforeach;

            foreach($contas as $conta):
                $result = [];
                foreach($obj['header'] as $data):
                    $valor = null;
                    foreach($lancamentos as $lancamento):
                        if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'))){
                            $valor += intval($lancamento->valor);
                        }
                        else if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'))){
                            $valor += intval('-'.$lancamento->valor);
                        }
                    endforeach;
                    if(in_array($conta, $obj['rows']['th']['entradas'])) {
                        $obj['total']['entradas'][$data] += $valor;
                    }else if(in_array($conta, $obj['rows']['th']['saidas'])){
                        $obj['total']['saidas'][$data] += $valor;
                    }
                    array_push($result, $valor);
                endforeach;
                
                array_unshift($result, $conta);
                array_push($result, $this->array_soma($result, 1));
                array_push($obj['rows']['td'], $result);
            endforeach;
            $show = true;
            array_push($obj['total']['entradas'], array_sum($obj['total']['entradas']));
            array_push($obj['total']['saidas'], array_sum($obj['total']['saidas']));
            foreach($obj['total']['entradas'] as $i => $t):
                array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
            endforeach; 
            foreach($obj['total']['entradas-saidas'] as $i => $es):
                array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
                if($i == count($obj['total']['entradas-saidas']) - 1) {break;}
                array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
            endforeach;
            return $obj;
    }

    public function index()
    {
        $fluxo = $this->getRelatorio('PREVISTO');
        $gerencial = $this->getRelatorio('REALIZADO');

        $this->set(compact('fluxo', 'gerencial'));
    }

    public function fluxodecaixa()
    {
        $show = false;
        $obj = ['header' => [],
                'rows' =>[
                    'th' => [
                        'entradas' => [],
                        'saidas' => []
                    ],
                    'td' => []
                ],
                'total' => [
                    'entradas' => [],
                    'saidas' => [],
                    'entradas-saidas' => [],
                    'inicial' => [],
                    'final' => []
                ]
            ];
        if ($this->request->is('post')) {
            
            $request = $this->request->getdata();
            // debug($request);exit;
            if(FrozenTime::now()->i18nFormat('yyyy-MM-dd') < $request['final']){return $this->redirect(['action' => 'index']);}
            $obj['header'] = $this->array_date($request['comeco'], $request['final']);
            $this->loadModel('Lancamentos');
            $this->loadModel('Fluxocontas');
            $this->paginate = [
                'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']] , 'Fornecedores', 'Clientes'], 
                'conditions' => ['tipo' => 'PREVISTO']
            ];
            $lancamentos = $this->paginate($this->Lancamentos);
            $obj['total']['inicial'] = [$this->total_before($request['comeco'], $lancamentos, 'data_vencimento')];
            $contas = [];
            $result = [];
            
            foreach($lancamentos as $lancamento):
                if(in_array($lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'), $obj['header'])){
                    if($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada'){
                        array_push($obj['rows']['th']['entradas'], $lancamento->fluxoconta->conta);
                    }else if($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida'){
                        array_push($obj['rows']['th']['saidas'], $lancamento->fluxoconta->conta);
                    }
                    if(!in_array($lancamento->fluxoconta->conta, $contas)){
                        array_push($contas, $lancamento->fluxoconta->conta);
                    }
                }
            endforeach;

            foreach($obj['header'] as $data):
                $obj['total']['entradas'][$data] = null;
                $obj['total']['saidas'][$data] = null;
            endforeach;

            foreach($contas as $conta):
                $result = [];
                foreach($obj['header'] as $data):
                    $valor = null;
                    foreach($lancamentos as $lancamento):
                        if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'))){
                            $valor += intval($lancamento->valor);
                        }
                        else if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'))){
                            $valor += intval('-'.$lancamento->valor);
                        }
                    endforeach;
                    if(in_array($conta, $obj['rows']['th']['entradas'])) {
                        $obj['total']['entradas'][$data] += $valor;
                    }else if(in_array($conta, $obj['rows']['th']['saidas'])){
                        $obj['total']['saidas'][$data] += $valor;
                    }
                    array_push($result, $valor);
                endforeach;
                
                array_unshift($result, $conta);
                array_push($result, $this->array_soma($result, 1));
                array_push($obj['rows']['td'], $result);
            endforeach;
            $show = true;
            array_push($obj['total']['entradas'], array_sum($obj['total']['entradas']));
            array_push($obj['total']['saidas'], array_sum($obj['total']['saidas']));
            foreach($obj['total']['entradas'] as $i => $t):
                array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
            endforeach; 
            foreach($obj['total']['entradas-saidas'] as $i => $es):
                array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
                if($i == count($obj['total']['entradas-saidas']) - 1) {break;}
                array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
            endforeach;
            $this->set(compact('obj', 'show'));
        }
        $this->set(compact('show'));
    }
    public function gerencial()
    {
        $show = false;
        $obj = ['header' => [],
                'rows' =>[
                    'th' => [
                        'entradas' => [],
                        'saidas' => []
                    ],
                    'td' => []
                ],
                'total' => [
                    'entradas' => [],
                    'saidas' => [],
                    'entradas-saidas' => [],
                    'inicial' => [],
                    'final' => []
                ]
            ];
        if ($this->request->is('post')) {
            
            $request = $this->request->getdata();
            // debug($request);exit;
            if(FrozenTime::now()->i18nFormat('yyyy-MM-dd') < $request['final']){return $this->redirect(['action' => 'index']);}
            $obj['header'] = $this->array_date($request['comeco'], $request['final']);
            $this->loadModel('Lancamentos');
            $this->loadModel('Fluxocontas');
            $this->paginate = [
                'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']] , 'Fornecedores', 'Clientes'], 
                'conditions' => ['tipo' => 'REALIZADO']
            ];
            $lancamentos = $this->paginate($this->Lancamentos);
            $obj['total']['inicial'] = [$this->total_before($request['comeco'], $lancamentos, 'data_vencimento')];
            $contas = [];
            $result = [];
            
            foreach($lancamentos as $lancamento):
                if(in_array($lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'), $obj['header'])){
                    if($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada'){
                        array_push($obj['rows']['th']['entradas'], $lancamento->fluxoconta->conta);
                    }else if($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida'){
                        array_push($obj['rows']['th']['saidas'], $lancamento->fluxoconta->conta);
                    }
                    if(!in_array($lancamento->fluxoconta->conta, $contas)){
                        array_push($contas, $lancamento->fluxoconta->conta);
                    }
                }
            endforeach;

            foreach($obj['header'] as $data):
                $obj['total']['entradas'][$data] = null;
                $obj['total']['saidas'][$data] = null;
            endforeach;

            foreach($contas as $conta):
                $result = [];
                foreach($obj['header'] as $data):
                    $valor = null;
                    foreach($lancamentos as $lancamento):
                        if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'))){
                            $valor += intval($lancamento->valor);
                        }
                        else if(($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat('yyyy-MM-dd'))){
                            $valor += intval('-'.$lancamento->valor);
                        }
                    endforeach;
                    if(in_array($conta, $obj['rows']['th']['entradas'])) {
                        $obj['total']['entradas'][$data] += $valor;
                    }else if(in_array($conta, $obj['rows']['th']['saidas'])){
                        $obj['total']['saidas'][$data] += $valor;
                    }
                    array_push($result, $valor);
                endforeach;
                
                array_unshift($result, $conta);
                array_push($result, $this->array_soma($result, 1));
                array_push($obj['rows']['td'], $result);
            endforeach;
            $show = true;
            array_push($obj['total']['entradas'], array_sum($obj['total']['entradas']));
            array_push($obj['total']['saidas'], array_sum($obj['total']['saidas']));
            foreach($obj['total']['entradas'] as $i => $t):
                array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
            endforeach; 
            foreach($obj['total']['entradas-saidas'] as $i => $es):
                array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
                if($i == count($obj['total']['entradas-saidas']) - 1) {break;}
                array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
            endforeach;
            $this->set(compact('obj', 'show'));
        }
        $this->set(compact('show'));
    }
}
<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Lancamento;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\Http\Client;
use Cake\Http\Client\Request as ClientRequest;
use Cake\Event\EventInterface;
use Cake\Core\Configure;
use DebugKit\DebugTimer;

class RelatoriosController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->FormProtection->setConfig('unlockedActions', ['getGerencial', 'getFluxoDeCaixa']);
    }

    public function caixadiario()
    {
        $this->getCaixaDiario();
    }

    public function getCaixaDiario()
    {
        $renovados = $this->getrenovado();
        $this->loadModel('Lancamentos');
        $lancamentos = $this->Lancamentos->find('all', [
            'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']], 'Fornecedores', 'Clientes'],
            'conditions' => ['data_baixa is not' => null], $renovados['simple']
        ]);


        $arrays = [];
        foreach ($lancamentos as $lancamento) :
            $teste =  FrozenTime::now()->i18nFormat('yyyy-MM-dd', 'UTC');
            $grupo = $lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo;
            if (($lancamento->data_baixa->i18nFormat('yyyy-MM-dd') == $teste)) {
                if ($grupo == 'entrada') {
                    $lancamento->valor = '+' . $lancamento->valor;
                } else {
                    $lancamento->valor = '-' . $lancamento->valor;
                }

                if ($lancamento->tipo == 'REALIZADO') {
                    array_push($arrays, [
                        $lancamento->valor,
                        $lancamento->fluxoconta ? $lancamento->fluxoconta->conta : ' ',
                        $lancamento->fornecedore ? $lancamento->fornecedore->nome : ' ',
                        $lancamento->cliente ? $lancamento->cliente->nome : ' ',
                        $lancamento->descricao,
                    ]);
                }
            }
        endforeach;
        $this->set(compact('arrays'));
        return $arrays;
    }


    public function exportCaixaDiario()
    {
        $renovados = $this->getrenovado();
        $data = $this->getCaixaDiario();
        $this->loadModel('Lancamentos');
        $this->paginate = [
            'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']], 'Fornecedores', 'Clientes'],
            'conditions' => ['data_baixa is not' => null], $renovados['simple']
        ];

        $lancamentos = $this->paginate($this->Lancamentos);
        $this->setResponse($this->getResponse()->withDownload('Caixa_Diário.csv'));
        $header = ['Valor', 'Conta', 'Fornecedor', 'Cliente', 'Descrição'];
        $this->set(compact('data'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => 'data',
                'header' => $header,
            ]);
    }

    public function array_date($ini = null, $fim = null, $periodo = null, $dias = null)
    {
        $resposta = [];
        $ini = new Time($ini, 'UTC');
        $fim = new Time($fim, 'UTC');
        while($ini <= $fim) {
            array_push($resposta, $ini->i18nFormat($periodo[0]));
            $ini->modify($periodo[1]);
            $ini->day == $fim->day ? array_push($resposta, $ini->i18nFormat($periodo[0])) : '';
        }

        return $resposta;
    }

    public function array_soma($array = null, $ii = null)
    {
        $resposta = 0;
        for ($i = $ii; $i < count($array); $i++) :
            $resposta += $array[$i];
        endfor;
        return $resposta;
    }

    public function getDre($tipo = null, $date = null, $periodo = null) 
    {
        $periodo = ['yyyy-MM-dd', '+1 days'];
        $date = 'data_vencimento';
        $renovados = $this->getrenovado();
        $obj = [
            'header' => [],
            'rows' => [
                'th' => [
                    'receita' => [],
                    'variaveis' => [],
                    'fixo' => []
                ],
                'td' => []
            ],
        ];
        $this->loadModel('Lancamentos');
        $this->loadModel('Drecontas');
        $this->paginate = [
            'contain' => ['Drecontas' => ['Dregrupos'], 'Fornecedores', 'Clientes'],
            'conditions' => [$renovados['simple']]
        ];
        $lancamentos = $this->paginate($this->Lancamentos);
        $comeco = FrozenTime::now()
                        ->day(1)
                        ->subMonth(1);
        foreach ($lancamentos as $lancamento) :
            if ($lancamento->$date->i18nFormat($periodo[0]) >= $comeco->i18nFormat($periodo[0])) {
                $final = $lancamento->$date->i18nFormat($periodo[0]);
            }
        endforeach;
        $final = $comeco;
        $final = $final->day(cal_days_in_month(CAL_GREGORIAN, $comeco->month, $comeco->year))->i18nFormat($periodo[0]);
        $obj['header'] = $this->array_date($comeco->i18nFormat($periodo[0]), $final, $periodo);
        $obj['total']['inicial'] = [$this->total_before($comeco->i18nFormat($periodo[0]), $lancamentos, $date)];
        $contas = [];
        $result = [];
        
        foreach ($lancamentos as $lancamento) :
            if (in_array($lancamento->$date->i18nFormat($periodo[0]), $obj['header'])) {
                if ($lancamento->dreconta->dregrupo->grupo == 'receita') {
                    array_push($obj['rows']['th']['receita'], $lancamento->fluxoconta->conta);
                } else if ($lancamento->dreconta->dregrupo->grupo == 'fixo') {
                    array_push($obj['rows']['th']['fixo'], $lancamento->fluxoconta->conta);
                } else if ($lancamento->dreconta->dregrupo->grupo == 'variavel') {
                    array_push($obj['rows']['th']['variavel'], $lancamento->fluxoconta->conta);
                }
                if (!in_array($lancamento->dreconta->conta, $contas)) {
                    array_push($contas, $lancamento->dreconta->conta);
                }
            }
        endforeach;
        debug($contas);exit;
        
        foreach ($obj['header'] as $data) :
            $obj['total']['receitas'][$data] = 0;
            $obj['total']['fixos'][$data] = 0;
            $obj['total']['variaveis'][$data] = 0;
        endforeach;

        foreach ($contas as $conta) :
            $result = [];
            foreach ($obj['header'] as $data) :
                $valor = 0;
                foreach ($lancamentos as $lancamento) :
                    if (($lancamento->dreconta->dregrupo->grupo == 'receita') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval($lancamento->valor);
                    } else if (($lancamento->dreconta->dregrupo->grupo == 'receita') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval('-' . $lancamento->valor);
                    }
                endforeach;
                if (in_array($conta, $obj['rows']['th']['entradas'])) {
                    $obj['total']['entradas'][$data] += $valor;
                } else if (in_array($conta, $obj['rows']['th']['saidas'])) {
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
            foreach ($obj['total']['entradas'] as $i => $t) :
                if ($i != array_key_last($obj['total']['entradas'])) {
                    array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
                }
            endforeach;
            foreach ($obj['total']['entradas-saidas'] as $i => $es) :
                array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
                if ($i != array_key_last($obj['total']['entradas-saidas'])) {
                    if ($i == count($obj['total']['entradas-saidas']) - 1) {
                        break;
                    }
                    array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
                }
            endforeach;
        return $obj;
    }

    public function dre()
    {
        $obj = [
            'header' => ['DRE'],
            'rows' => [
                'th' => [
                    'Faturamento' => [],
                    '( - ) Custos Variáveis' => [],
                    '(=) Margem de Contribuição (1-2)' => [],
                    ' ( - ) Custos Fixos' => [],
                    '(=) Resultado Líquido ' => []
                ],
                'td' => []
            ],
        ];
        $this->loadModel('Lancamentos');
        $lancamentos = $this->Lancamentos->find('all', [
            'contain' => ['Drecontas' => ['Dregrupos']],
            'conditions' => ['Lancamentos.dreconta_id IS NOT' => null]
        ]);
        foreach ($lancamentos as $lancamento) {
            debug($lancamento);
        }
        // debug($obj);
        exit;
    }



    public function total_before($data = null, $lancamentos = null, $namedata = null)
    {
        $valor = 0;
        $date = new Time($data, 'UTC');
        $data = $date->modify('-1 days');
        foreach ($lancamentos as $l) :
            if ($l->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada' && $data->i18nFormat('yyyy-MM-dd') == $l->$namedata->i18nFormat('yyyy-MM-dd')) {
                $valor += $l->valor;
            } else if ($l->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida' && $data->i18nFormat('yyyy-MM-dd') == $l->$namedata->i18nFormat('yyyy-MM-dd')) {
                $valor -= $l->valor;
            }
        endforeach;
        return $valor;
    }

    public function getRelatorio($tipo = null, $date = null, $periodo = null)
    {
        $renovados = $this->getrenovado();
        $obj = [
            'header' => [],
            'rows' => [
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
            'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']], 'Fornecedores', 'Clientes'],
            'conditions' => ['tipo' => $tipo, $renovados['simple']]
        ];
        $lancamentos = $this->paginate($this->Lancamentos);
        $comeco = FrozenTime::now()->i18nFormat($periodo[0]);
        $final = null;
        foreach ($lancamentos as $lancamento) :
            if ($lancamento->$date->i18nFormat($periodo[0]) >= $comeco) {
                $final = $lancamento->$date->i18nFormat($periodo[0]);
            }
        endforeach;
        $obj['header'] = $this->array_date($comeco, $final, $periodo);
        $obj['total']['inicial'] = [$this->total_before($comeco, $lancamentos, $date)];
        $contas = [];
        $result = [];

        foreach ($lancamentos as $lancamento) :
            if (in_array($lancamento->$date->i18nFormat($periodo[0]), $obj['header'])) {
                if ($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') {
                    array_push($obj['rows']['th']['entradas'], $lancamento->fluxoconta->conta);
                } else if ($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') {
                    array_push($obj['rows']['th']['saidas'], $lancamento->fluxoconta->conta);
                }
                if (!in_array($lancamento->fluxoconta->conta, $contas)) {
                    array_push($contas, $lancamento->fluxoconta->conta);
                }
            }
        endforeach;

        foreach ($obj['header'] as $data) :
            $obj['total']['entradas'][$data] = 0;
            $obj['total']['saidas'][$data] = 0;
        endforeach;

        foreach ($contas as $conta) :
            $result = [];
            foreach ($obj['header'] as $data) :
                $valor = 0;
                foreach ($lancamentos as $lancamento) :
                    if (($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval($lancamento->valor);
                    } else if (($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval('-' . $lancamento->valor);
                    }
                endforeach;
                if (in_array($conta, $obj['rows']['th']['entradas'])) {
                    $obj['total']['entradas'][$data] += $valor;
                } else if (in_array($conta, $obj['rows']['th']['saidas'])) {
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
        foreach ($obj['total']['entradas'] as $i => $t) :
            if ($i != array_key_last($obj['total']['entradas'])) {
                array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
            }
        endforeach;
        foreach ($obj['total']['entradas-saidas'] as $i => $es) :
            array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
            if ($i != array_key_last($obj['total']['entradas-saidas'])) {
                if ($i == count($obj['total']['entradas-saidas']) - 1) {
                    break;
                }
                array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
            }
        endforeach;

        return $obj;
    }

    public function index()
    {
    }




    public function fluxodecaixa()
    {
    }


    public function getFluxoDeCaixa()
    {
        $show = false;
        if ($this->request->is('get')) {
            $dia = ['yyyy-MM-dd', '+1 days'];
            $obj = $this->getRelatorio('PREVISTO', 'data_vencimento', $dia);
            $obj['total']['entradas'] = array_values($obj['total']['entradas']);
            $obj['total']['saidas'] = array_values($obj['total']['saidas']);
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode([true, $obj, null]));
            return $this->response;
        }
        if ($this->request->is('post')) {
            $request = $this->request->getData();
            $renovados = $this->getrenovado();
            $obj = [
                'header' => [],
                'rows' => [
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
            $dia = ['yyyy-MM-dd', '+1 days'];
            $mes = ['yyyy-MM', '+1 months'];
            $ano = ['yyyy', '+1 years'];
            $periodo = null;
            switch ($request[2]) {
                case 'mes':
                    $periodo = $mes;
                    break;
                case 'ano':
                    $periodo = $ano;
                    break;
                case 'dia':
                    $periodo = $dia;
                    break;
            }
            $obj['header'] = $this->array_date($request[0], $request[1], $periodo);
            $this->loadModel('Lancamentos');
            $this->loadModel('Fluxocontas');
            $lancamentos = $this->Lancamentos->find('all', [
                'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']], 'Fornecedores', 'Clientes'],
                'conditions' => ['tipo' => 'PREVISTO', $renovados['simple']]
            ]);
            $obj['total']['inicial'] = [$this->total_before($request[0], $lancamentos, 'data_vencimento')];
            $contas = [];
            $result = [];
            $testes = [];
            foreach ($lancamentos as $lancamento) :
                if ($lancamento->lancamento_id !== null) {
                    $testes[] = $lancamento->lancamento_id;
                }
                if (in_array($lancamento->data_vencimento->i18nFormat($periodo[0]), $obj['header'])) {
                    if ($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') {
                        array_push($obj['rows']['th']['entradas'], $lancamento->fluxoconta->conta);
                    } else if ($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') {
                        array_push($obj['rows']['th']['saidas'], $lancamento->fluxoconta->conta);
                    }
                    if (!in_array($lancamento->fluxoconta->conta, $contas)) {
                        array_push($contas, $lancamento->fluxoconta->conta);
                    }
                }
            endforeach;

            foreach ($obj['header'] as $data) :
                $obj['total']['entradas'][$data] = 0;
                $obj['total']['saidas'][$data] = 0;
            endforeach;

            foreach ($contas as $conta) :
                $result = [];
                foreach ($obj['header'] as $data) :
                    $valor = 0;
                    foreach ($lancamentos as $lancamento) :
                        if (($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat($periodo[0]))) {
                            $valor += intval($lancamento->valor);
                        } else if (($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat($periodo[0]))) {
                            $valor += intval('-' . $lancamento->valor);
                        }
                    endforeach;
                    if (in_array($conta, $obj['rows']['th']['entradas'])) {
                        $obj['total']['entradas'][$data] += $valor;
                    } else if (in_array($conta, $obj['rows']['th']['saidas'])) {
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
            foreach ($obj['total']['entradas'] as $i => $t) :
                if ($i != array_key_last($obj['total']['entradas'])) {
                    array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
                }
            endforeach;
            foreach ($obj['total']['entradas-saidas'] as $i => $es) :
                array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
                if ($i != array_key_last($obj['total']['entradas-saidas'])) {
                    if ($i == count($obj['total']['entradas-saidas']) - 1) {
                        break;
                    }
                    array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
                }
            endforeach;
            $obj['total']['entradas'] = array_values($obj['total']['entradas']);
            $obj['total']['saidas'] = array_values($obj['total']['saidas']);
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode([$show, $obj, $request]));
            return $this->response;
        }
    }



    public function gerencial()
    {
    }

    public function getGerencial()
    {
        $show = false;
        if ($this->request->is('get')) {
            $mes = ['yyyy-MM', '+1 months'];
            $obj = $this->getRelatorio('REALIZADO', 'data_baixa', $mes);
            $obj['total']['entradas'] = array_values($obj['total']['entradas']);
            $obj['total']['saidas'] = array_values($obj['total']['saidas']);
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode([true, $obj, null]));
            return $this->response;
        }
        if ($this->request->is('post')) {
            $request = $this->request->getData();
            $renovados = $this->getrenovado();
            $obj = [
                'header' => [],
                'rows' => [
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
            $dia = ['yyyy-MM-dd', '+1 days'];
            $mes = ['yyyy-MM', '+1 months'];
            $ano = ['yyyy', '+1 years'];
            $periodo = null;
            switch ($request[2]) {
                case 'mes':
                    $periodo = $mes;
                    break;
                case 'ano':
                    $periodo = $ano;
                    break;
                case 'dia':
                    $periodo = $dia;
                    break;
            }
            $obj['header'] = $this->array_date($request[0], $request[1], $periodo);
            $this->loadModel('Lancamentos');
            $this->loadModel('Fluxocontas');
            $lancamentos = $this->Lancamentos->find('all', [
                'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']], 'Fornecedores', 'Clientes'],
                'conditions' => ['tipo' => 'REALIZADO', $renovados['simple']]
            ]);
            $obj['total']['inicial'] = [$this->total_before($request[0], $lancamentos, 'data_baixa')];
            $contas = [];
            $result = [];

            foreach ($lancamentos as $lancamento) :
                if (in_array($lancamento->data_baixa->i18nFormat($periodo[0]), $obj['header'])) {
                    if ($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') {
                        array_push($obj['rows']['th']['entradas'], $lancamento->fluxoconta->conta);
                    } else if ($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') {
                        array_push($obj['rows']['th']['saidas'], $lancamento->fluxoconta->conta);
                    }
                    if (!in_array($lancamento->fluxoconta->conta, $contas)) {
                        array_push($contas, $lancamento->fluxoconta->conta);
                    }
                }
            endforeach;

            foreach ($obj['header'] as $data) :
                $obj['total']['entradas'][$data] = 0;
                $obj['total']['saidas'][$data] = 0;
            endforeach;

            foreach ($contas as $conta) :
                $result = [];
                foreach ($obj['header'] as $data) :
                    $valor = 0;
                    foreach ($lancamentos as $lancamento) :
                        if (($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_baixa->i18nFormat($periodo[0]))) {
                            $valor += intval($lancamento->valor);
                        } else if (($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'saida') && ($lancamento->fluxoconta->conta == $conta) && ($data == $lancamento->data_baixa->i18nFormat($periodo[0]))) {
                            $valor += intval('-' . $lancamento->valor);
                        }
                    endforeach;
                    if (in_array($conta, $obj['rows']['th']['entradas'])) {
                        $obj['total']['entradas'][$data] += $valor;
                    } else if (in_array($conta, $obj['rows']['th']['saidas'])) {
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
            foreach ($obj['total']['entradas'] as $i => $t) :
                if ($i != array_key_last($obj['total']['entradas'])) {
                    array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
                }
            endforeach;
            foreach ($obj['total']['entradas-saidas'] as $i => $es) :
                array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
                if ($i != array_key_last($obj['total']['entradas-saidas'])) {
                    if ($i == count($obj['total']['entradas-saidas']) - 1) {
                        break;
                    }
                    array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
                }
            endforeach;
            $obj['total']['entradas'] = array_values($obj['total']['entradas']);
            $obj['total']['saidas'] = array_values($obj['total']['saidas']);
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode([$show, $obj, $request]));
            return $this->response;
        }
    }
}

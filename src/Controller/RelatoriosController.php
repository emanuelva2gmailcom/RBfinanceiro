<?php

declare(strict_types=1);

namespace App\Controller;

use Abraham\TwitterOAuth\Response;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\Http\Client;
use Cake\Http\Client\Request as ClientRequest;
use Cake\Event\EventInterface;
use Cake\Core\Configure;

class RelatoriosController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->FormProtection->setConfig('unlockedActions', ['getGerencial', 'getFluxoDeCaixa', 'dreAPI']);
    }

    public function caixadiario()
    {
        $this->getCaixaDiario();
    }

    public function relatoriodiario()
    {
        $renovados = $this->getrenovado();
        $this->loadModel('Lancamentos');
        $lancamentos = $this->Lancamentos->find('list', [
            'contain' => ['Subcontas' => ['Contas' => ['Subgrupos' => 'Grupos']], 'Fornecedores', 'Clientes'],
            'conditions' => [
                $renovados['simple'],
                'DATE(lancamentos.created)' => FrozenTime::now()->i18nFormat('yyyy-MM-dd')
            ],
            'valueField' => function($d) {
                if ($d->subconta->conta->subgrupo->grupo->grupo == 'entrada') {
                    return [
                        '+' . $d->valor,
                        $d->subconta ? $d->subconta->subconta : ' ',
                        $d->fornecedore ? $d->fornecedore->nome : ' ',
                        $d->cliente ? $d->cliente->nome : ' ',
                        $d->descricao,
                    ];
                }else {
                    return [
                        '-' . $d->valor,
                        $d->subconta ? $d->subconta->subconta : ' ',
                        $d->fornecedore ? $d->fornecedore->nome : ' ',
                        $d->cliente ? $d->cliente->nome : ' ',
                        $d->descricao,
                    ];
                }
            }
        ]);
        $this->set(compact('lancamentos'));
    }

    public function getCaixaDiario()
    {
        $renovados = $this->getrenovado();
        $this->loadModel('Lancamentos');
        $lancamentos = $this->Lancamentos->find('list', [
            'contain' => ['Subcontas' => ['Contas' => ['Subgrupos' => 'Grupos']], 'Fornecedores', 'Clientes'],
            'conditions' => ['data_baixa is not' => null, $renovados['simple'], 'tipo' => 'REALIZADO', 'data_baixa' =>  FrozenTime::now()],
            'valueField' => function($d) {
                if ($d->subconta->conta->subgrupo->grupo->grupo == 'entrada') {
                    return [
                        '+' . $d->valor,
                        $d->subconta ? $d->subconta->subconta : ' ',
                        $d->fornecedore ? $d->fornecedore->nome : ' ',
                        $d->cliente ? $d->cliente->nome : ' ',
                        $d->descricao,
                    ];
                }else {
                    return [
                        '-' . $d->valor,
                        $d->subconta ? $d->subconta->subconta : ' ',
                        $d->fornecedore ? $d->fornecedore->nome : ' ',
                        $d->cliente ? $d->cliente->nome : ' ',
                        $d->descricao,
                    ];
                }

            }]);
        $this->set(compact('lancamentos'));
        return $lancamentos;
    }


    public function exportCaixaDiario()
    {
        $renovados = $this->getrenovado();
        $data = $this->getCaixaDiario();
        $this->loadModel('Lancamentos');
        $this->paginate = [
            'contain' => ['Subcontas' => ['Contas' => ['Subgrupos' => 'Grupos']], 'Fornecedores', 'Clientes'],
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

    public function array_date($ini = null, $fim = null, $periodo = null)
    {
        $resposta = [];
        $ini = new Time($ini, 'UTC');
        $fim = new Time($fim, 'UTC');
        while ($ini <= $fim) {
            array_push($resposta, $ini->i18nFormat($periodo[0]));
            $ini->modify($periodo[1]);
            // $ini->i18nFormat($periodo[0]) == $fim->i18nFormat($periodo[0]) ? array_push($resposta, $ini->i18nFormat($periodo[0])) : '';
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

    public function postDre($request = null, $date = 'data_vencimento')
    {
        // $request = ['2021-9', '2021-11', 'mes'];
        $request[0] = new Time($request[0], 'UTC');
        $request[1] = new Time($request[1], 'UTC');
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
        }
        $renovados = $this->getrenovado();
        $obj = [
            'header' => [],
            'rows' => [
                'th' => [
                    'receita' => [],
                    'variavel' => [],
                    'fixo' => []
                ],
                'td' => []
            ],
            'total' => [
                'receitas' => [],
                'contribuicao' => [],
                'fixos' => [],
                'variaveis' => [],
                'liquido' => [],
            ]
        ];
        $response = [
            'header' => [],
            'body' => [],
            'total' => [
                'receitas' => [],
                'contribuicao' => [],
                'fixos' => [],
                'variaveis' => [],
                'liquido' => [],
            ]
        ];
        $this->loadModel('Lancamentos');
        $this->loadModel('Subcontas');
        $lancamentos = $this->paginate($this->Lancamentos);
        $lancamentos = $this->Lancamentos->find('all', [
            'contain' => ['Subcontas' => [ 'Contas' => ['Subgrupos' => ['Grupos']]], 'Fornecedores', 'Clientes'],
            'conditions' => [$renovados['simple']]
        ]);
        if ($request[0] == $request[1]) {
            array_push($obj['header'], $request[0]->i18nFormat($periodo[0]));
        } else {
            $obj['header'] = $this->array_date($request[0], $request[1], $periodo);
        }

        $contas = [];
        $result = [];
        foreach ($lancamentos as $lancamento) :
            if (in_array($lancamento->$date->i18nFormat($periodo[0]), $obj['header'])) {
                if ($lancamento->subconta->conta->subgrupo->subgrupo == 'Receitas') {
                    array_push($obj['rows']['th']['receita'], $lancamento->subconta->conta->conta);
                } else if ($lancamento->subconta->conta->subgrupo->subgrupo == 'Gastos Fixos') {
                    array_push($obj['rows']['th']['fixo'], $lancamento->subconta->conta->conta);
                } else if ($lancamento->subconta->conta->subgrupo->subgrupo == 'Gastos Variáveis') {
                    array_push($obj['rows']['th']['variavel'], $lancamento->subconta->conta->conta);
                }
                if (!in_array($lancamento->subconta->conta->conta, $contas)) {
                    array_push($contas, $lancamento->subconta->conta->conta);
                }
            }
        endforeach;

        foreach ($obj['header'] as $data) :
            $obj['total']['receitas'][$data] = 0;
            $obj['total']['contribuicao'][$data] = 0;
            $obj['total']['fixos'][$data] = 0;
            $obj['total']['variaveis'][$data] = 0;
            $obj['total']['liquido'][$data] = 0;
        endforeach;
        foreach ($contas as $conta) :
            $result = [];

            foreach ($obj['header'] as $data) :
                $valor = 0;
                foreach ($lancamentos as $lancamento) :
                    if (($lancamento->subconta->conta->subgrupo->subgrupo == 'Receitas') && ($lancamento->subconta->conta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval($lancamento->valor);
                    } else if (($lancamento->subconta->conta->subgrupo->subgrupo == 'Gastos Fixos') && ($lancamento->subconta->conta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval('-' . $lancamento->valor);
                    } else if (($lancamento->subconta->conta->subgrupo->subgrupo == 'Gastos Variáveis') && ($lancamento->subconta->conta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval('-' . $lancamento->valor);
                    }

                endforeach;
                if (in_array($conta, $obj['rows']['th']['receita'])) {
                    $obj['total']['receitas'][$data] += $valor;
                    $obj['total']['contribuicao'][$data] += $valor;
                    $obj['total']['liquido'][$data] += $valor;
                } else if (in_array($conta, $obj['rows']['th']['fixo'])) {
                    $obj['total']['fixos'][$data] += $valor;
                    $obj['total']['liquido'][$data] += $valor;
                } else if (in_array($conta, $obj['rows']['th']['variavel'])) {
                    $obj['total']['variaveis'][$data] += $valor;
                    $obj['total']['contribuicao'][$data] += $valor;
                    $obj['total']['liquido'][$data] += $valor;
                }
                array_push($result, $valor);
            endforeach;
            array_push($result, array_sum($result));
            array_push($obj['rows']['td'], array_merge([$conta], $result));
        endforeach;

        $obj['total']['receitas'] = array_values($obj['total']['receitas']);
        $obj['total']['variaveis'] = array_values($obj['total']['variaveis']);
        $obj['total']['contribuicao'] = array_values($obj['total']['contribuicao']);
        $obj['total']['fixos'] = array_values($obj['total']['fixos']);
        $obj['total']['liquido'] = array_values($obj['total']['liquido']);

        array_push($obj['total']['receitas'], array_sum($obj['total']['receitas']));
        array_push($obj['total']['variaveis'], array_sum($obj['total']['variaveis']));
        array_push($obj['total']['contribuicao'], array_sum($obj['total']['contribuicao']));
        array_push($obj['total']['fixos'], array_sum($obj['total']['fixos']));
        array_push($obj['total']['liquido'], array_sum($obj['total']['liquido']));

        array_unshift($obj['total']['receitas'], '1 - Faturamento');
        array_push($response['total']['receitas'], $obj['total']['receitas']);
        array_unshift($obj['total']['variaveis'], '2 - Custos Variáveis');
        array_push($response['total']['variaveis'], $obj['total']['variaveis']);
        array_unshift($obj['total']['contribuicao'], '3 - (=) Margem de Contribuição (1 - 2)');
        array_push($response['total']['contribuicao'], $obj['total']['contribuicao']);
        array_unshift($obj['total']['fixos'], '4 - Custos Fixos');
        array_push($response['total']['fixos'], $obj['total']['fixos']);
        array_unshift($obj['total']['liquido'], '5 - Resultado Liquido (3 - 4)');
        array_push($response['total']['liquido'], $obj['total']['liquido']);

        foreach ($obj['rows']['td'] as $row) {
            if (in_array($row[0], $obj['rows']['th']['receita'])) {
                array_push($response['total']['receitas'], $row);
            } else if (in_array($row[0], $obj['rows']['th']['variavel'])) {
                array_push($response['total']['variaveis'], $row);
            } else if (in_array($row[0], $obj['rows']['th']['fixo'])) {
                array_push($response['total']['fixos'], $row);
            }
        }
        $response['header'] = array_merge(['DRE'], $obj['header'], ['TOTAL'], ['%']);

        $receitasTotal = $response['total']['receitas'][0][array_key_last($response['total']['receitas'][0])];

        if ($receitasTotal != 0) {
            foreach ($response['total'] as $index => $array) {
                foreach ($array as $key => $value) {

                    array_push($response['total'][$index][$key], (number_format(($value[array_key_last($value)] / $receitasTotal) * 100, 2, '.', ' ') . ' %'));
                }
            }
        }
        // debug($response);exit;
        return $response;
    }

    public function getDre($date = null, $periodo = null)
    {
        $renovados = $this->getrenovado();
        $obj = [
            'header' => [],
            'rows' => [
                'th' => [
                    'receita' => [],
                    'variavel' => [],
                    'fixo' => []
                ],
                'td' => []
            ],
            'total' => [
                'receitas' => [],
                'contribuicao' => [],
                'fixos' => [],
                'variaveis' => [],
                'liquido' => [],
            ]
        ];
        $response = [
            'header' => [],
            'body' => [],
            'total' => [
                'receitas' => [],
                'contribuicao' => [],
                'fixos' => [],
                'variaveis' => [],
                'liquido' => [],
            ]
        ];
        $this->loadModel('Lancamentos');
        $this->loadModel('Subgrupos');
        $lancamentos = $this->paginate($this->Lancamentos);
        $lancamentos = $this->Lancamentos->find('all', [
            'contain' => ['Subcontas' => [ 'Contas' => ['Subgrupos' => ['Grupos']]], 'Fornecedores', 'Clientes'],
            'conditions' => [$renovados['simple']]
        ]);
        $comeco = FrozenTime::now()
            ->day(1)
            ->subMonth(1);
        array_push($obj['header'], $comeco->i18nFormat($periodo[0]));

        $contas = [];
        $result = [];
        foreach ($lancamentos as $lancamento) :
            if (in_array($lancamento->$date->i18nFormat($periodo[0]), $obj['header'])) {
                if ($lancamento->subconta->conta->subgrupo->subgrupo == 'Receitas') {
                    array_push($obj['rows']['th']['receita'], $lancamento->subconta->conta->conta);
                } else if ($lancamento->subconta->conta->subgrupo->subgrupo == 'Gastos Fixos') {
                    array_push($obj['rows']['th']['fixo'], $lancamento->subconta->conta->conta);
                } else if ($lancamento->subconta->conta->subgrupo->subgrupo == 'Gastos Variáveis') {
                    array_push($obj['rows']['th']['variavel'], $lancamento->subconta->conta->conta);
                }
                if (!in_array($lancamento->subconta->conta->conta, $contas)) {
                    array_push($contas, $lancamento->subconta->conta->conta);
                }
            }
        endforeach;
        foreach ($obj['header'] as $data) :
            $obj['total']['receitas'][$data] = 0;
            $obj['total']['contribuicao'][$data] = 0;
            $obj['total']['fixos'][$data] = 0;
            $obj['total']['variaveis'][$data] = 0;
            $obj['total']['liquido'][$data] = 0;
        endforeach;
        foreach ($contas as $conta) :
            $result = [];

            foreach ($obj['header'] as $data) :
                $valor = 0;
                foreach ($lancamentos as $lancamento) :
                    if (($lancamento->subconta->conta->subgrupo->subgrupo == 'Receitas') && ($lancamento->subconta->conta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval($lancamento->valor);
                    } else if (($lancamento->subconta->conta->subgrupo->subgrupo == 'Gastos Fixos') && ($lancamento->subconta->conta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval('-' . $lancamento->valor);
                    } else if (($lancamento->subconta->conta->subgrupo->subgrupo == 'Gastos Variáveis') && ($lancamento->subconta->conta->conta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval('-' . $lancamento->valor);
                    }

                endforeach;
                if (in_array($conta, $obj['rows']['th']['receita'])) {
                    $obj['total']['receitas'][$data] += $valor;
                    $obj['total']['contribuicao'][$data] += $valor;
                    $obj['total']['liquido'][$data] += $valor;
                } else if (in_array($conta, $obj['rows']['th']['fixo'])) {
                    $obj['total']['fixos'][$data] += $valor;
                    $obj['total']['liquido'][$data] += $valor;
                } else if (in_array($conta, $obj['rows']['th']['variavel'])) {
                    $obj['total']['variaveis'][$data] += $valor;
                    $obj['total']['contribuicao'][$data] += $valor;
                    $obj['total']['liquido'][$data] += $valor;
                }
                array_push($result, $valor);
            endforeach;
            array_push($result, array_sum($result));
            array_push($obj['rows']['td'], array_merge([$conta], $result));
        endforeach;

        $obj['total']['receitas'] = array_values($obj['total']['receitas']);
        $obj['total']['variaveis'] = array_values($obj['total']['variaveis']);
        $obj['total']['contribuicao'] = array_values($obj['total']['contribuicao']);
        $obj['total']['fixos'] = array_values($obj['total']['fixos']);
        $obj['total']['liquido'] = array_values($obj['total']['liquido']);

        array_push($obj['total']['receitas'], array_sum($obj['total']['receitas']));
        array_push($obj['total']['variaveis'], array_sum($obj['total']['variaveis']));
        array_push($obj['total']['contribuicao'], array_sum($obj['total']['contribuicao']));
        array_push($obj['total']['fixos'], array_sum($obj['total']['fixos']));
        array_push($obj['total']['liquido'], array_sum($obj['total']['liquido']));

        array_unshift($obj['total']['receitas'], '1 - Faturamento');
        array_push($response['total']['receitas'], $obj['total']['receitas']);
        array_unshift($obj['total']['variaveis'], '2 - Custos Variáveis');
        array_push($response['total']['variaveis'], $obj['total']['variaveis']);
        array_unshift($obj['total']['contribuicao'], '3 - (=) Margem de Contribuição (1 - 2)');
        array_push($response['total']['contribuicao'], $obj['total']['contribuicao']);
        array_unshift($obj['total']['fixos'], '4 - Custos Fixos');
        array_push($response['total']['fixos'], $obj['total']['fixos']);
        array_unshift($obj['total']['liquido'], '5 - Resultado Liquido (3 - 4)');
        array_push($response['total']['liquido'], $obj['total']['liquido']);

        foreach ($obj['rows']['td'] as $row) {
            if (in_array($row[0], $obj['rows']['th']['receita'])) {
                array_push($response['total']['receitas'], $row);
            } else if (in_array($row[0], $obj['rows']['th']['variavel'])) {
                array_push($response['total']['variaveis'], $row);
            } else if (in_array($row[0], $obj['rows']['th']['fixo'])) {
                array_push($response['total']['fixos'], $row);
            }
        }
        $response['header'] = array_merge(['DRE'], $obj['header'], ['TOTAL'], ['%']);

        $receitasTotal = $response['total']['receitas'][0][array_key_last($response['total']['receitas'][0])];

        if ($receitasTotal != 0) {
            foreach ($response['total'] as $index => $array) {
                foreach ($array as $key => $value) {
                    array_push($response['total'][$index][$key], (number_format(($value[array_key_last($value)] / $receitasTotal) * 100, 2, '.', ' ') . ' %'));
                }
            }
        }
        return $response;
    }

    public function dreAPI()
    {
        $mes = ['yyyy-MM', '+1 months'];
        if ($this->request->is('get')) {
            $obj = $this->getDre('data_competencia', $mes);
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode([true, $obj, null]));
            return $this->response;
        } else if ($this->request->is('post')) {
            $request = $this->request->getData();
            $obj = $this->postDre($request, 'data_competencia');
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode([true, $obj, null]));
            return $this->response;
        }
    }

    public function dre()
    {
    }

    public function total_before($data = null, $lancamentos = null, $namedata = null)
    {
        $valor = 0;
        $date = new Time($data, 'UTC');
        $data = $date->modify('-1 days');
        foreach ($lancamentos as $l) :
            if ($l->subconta->conta->subgrupo->grupo->grupo == 'entrada' && $data->i18nFormat('yyyy-MM-dd') == $l->$namedata->i18nFormat('yyyy-MM-dd')) {
                $valor += $l->valor;
            } else if ($l->subconta->conta->subgrupo->grupo->grupo == 'saida' && $data->i18nFormat('yyyy-MM-dd') == $l->$namedata->i18nFormat('yyyy-MM-dd')) {
                $valor -= $l->valor;
            }
        endforeach;
        return $valor;
    }

    public function getRelatorio($tipo = "PREVISTO", $date = 'data_vencimento', $periodo = ['yyyy-MM', '+1 months'])
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
        $this->loadModel('Subcontas');
        $this->paginate = [
            'contain' => ['Subcontas' => ['Contas' => ['Subgrupos' => 'Grupos']], 'Fornecedores', 'Clientes'],
            'conditions' => ['tipo' => $tipo, $renovados['simple']]
        ];
        $lancamentos = $this->paginate($this->Lancamentos);
        $comeco = FrozenTime::now()->i18nFormat($periodo[0]);
        $final = $comeco;
        foreach ($lancamentos as $lancamento) :
            // debug([$lancamento->$date->i18nFormat($periodo[0]) >= $comeco, $lancamento->$date->i18nFormat($periodo[0]), $final]);
            if ($lancamento->$date->i18nFormat($periodo[0]) >= $final) {
                $final = $lancamento->$date->i18nFormat($periodo[0]);
            }
        endforeach;
        // debug([$comeco, $final]);exit;
        $obj['header'] = $this->array_date($comeco, $final, $periodo);
        $obj['total']['inicial'] = [$this->total_before($comeco, $lancamentos, $date)];
        $contas = [];
        $result = [];

        foreach ($lancamentos as $lancamento) :
            if (in_array($lancamento->$date->i18nFormat($periodo[0]), $obj['header'])) {
                if ($lancamento->subconta->conta->subgrupo->grupo->grupo == 'entrada') {
                    array_push($obj['rows']['th']['entradas'], $lancamento->subconta->subconta);
                } else if ($lancamento->subconta->conta->subgrupo->grupo->grupo == 'saida') {
                    array_push($obj['rows']['th']['saidas'], $lancamento->subconta->subconta);
                }
                if (!in_array($lancamento->subconta->subconta, $contas)) {
                    array_push($contas, $lancamento->subconta->subconta);
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
                    if (($lancamento->subconta->conta->subgrupo->grupo->grupo == 'entrada') && ($lancamento->subconta->subconta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
                        $valor += intval($lancamento->valor);
                    } else if (($lancamento->subconta->conta->subgrupo->grupo->grupo == 'saida') && ($lancamento->subconta->subconta == $conta) && ($data == $lancamento->$date->i18nFormat($periodo[0]))) {
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
        // $request = ['2021-11-12', '2022-01-12', 'mes'];
        $show = false;
        if ($this->request->is('get')) {
            $dia = ['yyyy-MM-dd', '+1 days'];
            $mes = ['yyyy-MM', '+1 months'];
            $obj = $this->getRelatorio('PREVISTO', 'data_vencimento', $mes);
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
            $this->loadModel('Subcontas');
            $lancamentos = $this->Lancamentos->find('all', [
                'contain' => ['Subcontas' => ['Contas' => ['Subgrupos' => 'Grupos']], 'Fornecedores', 'Clientes'],
                'conditions' => ['tipo' => 'PREVISTO', $renovados['simple']]
            ]);
            $obj['total']['inicial'] = [$this->total_before($request[0], $lancamentos, 'data_vencimento')];
            $contas = [];
            $result = [];

            foreach ($lancamentos as $lancamento) :
                if (in_array($lancamento->data_vencimento->i18nFormat($periodo[0]), $obj['header'])) {
                    if ($lancamento->subconta->conta->subgrupo->grupo->grupo == 'entrada') {
                        array_push($obj['rows']['th']['entradas'], $lancamento->subconta->subconta);
                    } else if ($lancamento->subconta->conta->subgrupo->grupo->grupo == 'saida') {
                        array_push($obj['rows']['th']['saidas'], $lancamento->subconta->subconta);
                    }
                    if (!in_array($lancamento->subconta->subconta, $contas)) {
                        array_push($contas, $lancamento->subconta->subconta);
                    }
                }
            endforeach;
            // debug($alllancamentos);exit;

            foreach ($obj['header'] as $data) :
                $obj['total']['entradas'][$data] = 0;
                $obj['total']['saidas'][$data] = 0;
            endforeach;
            foreach ($contas as $conta) :
                $result = [];
                foreach ($obj['header'] as $data) :
                    $valor = 0;
                    foreach ($lancamentos as $lancamento) :
                        if (($lancamento->subconta->conta->subgrupo->grupo->grupo == 'entrada') && ($lancamento->subconta->subconta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat($periodo[0]))) {
                            $valor += intval($lancamento->valor);
                        } else if (($lancamento->subconta->conta->subgrupo->grupo->grupo == 'saida') && ($lancamento->subconta->subconta == $conta) && ($data == $lancamento->data_vencimento->i18nFormat($periodo[0]))) {
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
            // debug($obj);exit;
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
        // $request = ['2021-11-12', '2021-11-20', 'mes'];
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
            $this->loadModel('Subcontas');
            $lancamentos = $this->Lancamentos->find('all', [
                'contain' => ['Subcontas' => ['Contas' => ['Subgrupos' => 'Grupos']], 'Fornecedores', 'Clientes'],
                'conditions' => ['tipo' => 'REALIZADO', $renovados['simple']]
            ]);
            $obj['total']['inicial'] = [$this->total_before($request[0], $lancamentos, 'data_baixa')];
            $contas = [];
            $result = [];

            foreach ($lancamentos as $lancamento) :
                if (in_array($lancamento->data_baixa->i18nFormat($periodo[0]), $obj['header'])) {
                    if ($lancamento->subconta->conta->subgrupo->grupo->grupo == 'entrada') {
                        array_push($obj['rows']['th']['entradas'], $lancamento->subconta->subconta);
                    } else if ($lancamento->subconta->conta->subgrupo->grupo->grupo == 'saida') {
                        array_push($obj['rows']['th']['saidas'], $lancamento->subconta->subconta);
                    }
                    if (!in_array($lancamento->subconta->subconta, $contas)) {
                        array_push($contas, $lancamento->subconta->subconta);
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
                        if (($lancamento->subconta->conta->subgrupo->grupo->grupo == 'entrada') && ($lancamento->subconta->subconta == $conta) && ($data == $lancamento->data_baixa->i18nFormat($periodo[0]))) {
                            $valor += intval($lancamento->valor);
                        } else if (($lancamento->subconta->conta->subgrupo->grupo->grupo == 'saida') && ($lancamento->subconta->subconta == $conta) && ($data == $lancamento->data_baixa->i18nFormat($periodo[0]))) {
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

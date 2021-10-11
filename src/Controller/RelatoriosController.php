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
        $this->getCaixaDiario();
    }

    public function getCaixaDiario()
    {
        $this->loadModel('Lancamentos');
        $this->paginate = [
            'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']], 'Fornecedores', 'Clientes'],
            'conditions' => ['data_baixa is not' => null]
        ];

        $lancamentos = $this->paginate($this->Lancamentos);

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
        $data = $this->getCaixaDiario();
        $this->loadModel('Lancamentos');
        $this->paginate = [
            'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']], 'Fornecedores', 'Clientes'],
            'conditions' => ['data_baixa is not' => null]
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

    public function dre()
    {
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
            'conditions' => ['tipo' => $tipo]
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
            array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
        endforeach;
        foreach ($obj['total']['entradas-saidas'] as $i => $es) :
            array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
            if ($i == count($obj['total']['entradas-saidas']) - 1) {
                break;
            }
            array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
        endforeach;
        return $obj;
    }

    public function index()
    {
        $dia = ['yyyy-MM-dd', '+1 days'];
        $mes = ['yyyy-MM', '+1 months'];
        $fluxo = $this->getRelatorio('PREVISTO', 'data_vencimento', $dia);
        $gerencial = $this->getRelatorio('REALIZADO', 'data_baixa', $mes);

        $this->set(compact('fluxo', 'gerencial'));
    }

    public function exportRelatorioGerencial()
    {
        $mes = ['yyyy-MM', '+1 months'];
        $data = $this->getRelatorio('REALIZADO', 'data_baixa', $mes);

        $entradas = [];
        $saidas = [];

        foreach ($data['rows']['td'] as $valor) {
            if (in_array($valor[0], $data['rows']['th']['entradas'])) {
                $entradas[] = $valor;
            }
            if (in_array($valor[0], $data['rows']['th']['saidas'])) {
                $saidas[] = $valor;
            }
        }
        if ($entradas == null) {
            $entradas = [[]];
        }
        if ($saidas == null) {
            $saidas = [[]];
        }
        array_unshift($entradas, $data['header']);
        array_unshift($entradas[0], 'contas');

        array_push($entradas[0], 'total');

        array_push($entradas, $data['total']['entradas']);
        array_unshift($entradas[array_key_last($entradas)], 'Entradas');

        array_push($saidas, $data['total']['saidas']);
        array_unshift($saidas[array_key_last($saidas)], 'Saidas');

        array_push($saidas, $data['total']['entradas-saidas']);
        array_unshift($saidas[array_key_last($saidas)], 'Entradas - Saidas');

        $serialize = ['entradas', 'saidas'];

        $this->setResponse($this->getResponse()->withDownload('Gerencial.csv'));
        $this->set(compact('entradas', 'saidas'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => $serialize,
            ]);
    }

    public function exportRelatorioFluxoCx()
    {
        $dia = ['yyyy-MM-dd', '+1 days'];
        $data = $this->getRelatorio('PREVISTO', 'data_vencimento', $dia);
        $entradas = [];
        $saidas = [];

        foreach ($data['rows']['td'] as $valor) {
            if (in_array($valor[0], $data['rows']['th']['entradas'])) {
                $entradas[] = $valor;
            }
            if (in_array($valor[0], $data['rows']['th']['saidas'])) {
                $saidas[] = $valor;
            }
        }
        if ($entradas == null) {
            $entradas = [[]];
        }
        if ($saidas == null) {
            $saidas = [[]];
        }
        array_unshift($entradas, $data['header']);
        array_unshift($entradas[0], 'contas');
        array_push($entradas[0], 'total');

        array_push($entradas, $data['total']['entradas']);
        array_unshift($entradas[array_key_last($entradas)], 'Entradas');

        array_push($saidas, $data['total']['saidas']);
        array_unshift($saidas[array_key_last($saidas)], 'Saidas');

        array_push($saidas, $data['total']['entradas-saidas']);
        array_unshift($saidas[array_key_last($saidas)], 'Entradas - Saidas');

        array_push($saidas, $data['total']['inicial']);
        array_unshift($saidas[array_key_last($saidas)], 'Inicial');

        array_push($saidas, $data['total']['final']);
        array_unshift($saidas[array_key_last($saidas)], 'Final');


        $serialize = ['entradas', 'saidas'];

        $this->setResponse($this->getResponse()->withDownload('Fluxo De Caixa.csv'));
        $this->set(compact('entradas', 'saidas'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => $serialize,
            ]);
    }



    public function fluxodecaixa()
    {
        $show = $this->getFluxoDeCaixa($this->request->getData())[0];
        $obj = $this->getFluxoDeCaixa($this->request->getData())[1];
        $request = $this->getFluxoDeCaixa($this->request->getData())[2];
        $this->set(compact('obj', 'show', 'request'));
    }


    public function getFluxoDeCaixa($data = null)
    {
        $show = false;
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
        $request = $data;
        if (empty($data)) {
            return [$show, $obj, $request];
        }
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
            'conditions' => ['tipo' => 'PREVISTO']
        ]);
        $obj['total']['inicial'] = [$this->total_before($request[0], $lancamentos, 'data_vencimento')];
        $contas = [];
        $result = [];
        $testes = [];
        $testes2 = [];
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
            array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
        endforeach;
        foreach ($obj['total']['entradas-saidas'] as $i => $es) :
            array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
            if ($i == count($obj['total']['entradas-saidas']) - 1) {
                break;
            }
            array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
        endforeach;
        return [$show, $obj, $request];
    }


    public function exportFluxoDeCaixa($request = null)
    {
        $data = $this->getFluxoDeCaixa(explode(",", $request))[1];
        $entradas = [];
        $saidas = [];

        foreach ($data['rows']['td'] as $valor) {
            if (in_array($valor[0], $data['rows']['th']['entradas'])) {
                $entradas[] = $valor;
            }
            if (in_array($valor[0], $data['rows']['th']['saidas'])) {
                $saidas[] = $valor;
            }
        }
        if ($entradas == null) {
            $entradas = [[]];
        }
        if ($saidas == null) {
            $saidas = [[]];
        }
        array_unshift($entradas, $data['header']);
        array_unshift($entradas[0], 'contas');
        array_push($entradas[0], 'total');

        array_push($entradas, $data['total']['entradas']);
        array_unshift($entradas[array_key_last($entradas)], 'Entradas');

        array_push($saidas, $data['total']['saidas']);
        array_unshift($saidas[array_key_last($saidas)], 'Saidas');

        array_push($saidas, $data['total']['entradas-saidas']);
        array_unshift($saidas[array_key_last($saidas)], 'Entradas - Saidas');

        array_push($saidas, $data['total']['inicial']);
        array_unshift($saidas[array_key_last($saidas)], 'Inicial');

        array_push($saidas, $data['total']['final']);
        array_unshift($saidas[array_key_last($saidas)], 'Final');


        $serialize = ['entradas', 'saidas'];

        $this->setResponse($this->getResponse()->withDownload('Fluxo De Caixa.csv'));
        $this->set(compact('entradas', 'saidas'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => $serialize,
            ]);
    }

    public function gerencial()
    {
        $show = $this->getGerencial($this->request->getData())[0];
        $obj = $this->getGerencial($this->request->getData())[1];
        $request = $this->getGerencial($this->request->getData())[2];
        $this->set(compact('obj', 'show', 'request'));
    }

    public function getGerencial($data = null)
    {
        $show = false;
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
        $request = $data;
        if (empty($data)) {
            return [$show, $obj, $request];
        }
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
            'conditions' => ['tipo' => 'REALIZADO']
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
            array_push($obj['total']['entradas-saidas'], $t + $obj['total']['saidas'][$i]);
        endforeach;
        foreach ($obj['total']['entradas-saidas'] as $i => $es) :
            array_push($obj['total']['final'], $es + $obj['total']['inicial'][$i]);
            if ($i == count($obj['total']['entradas-saidas']) - 1) {
                break;
            }
            array_push($obj['total']['inicial'], $obj['total']['final'][$i]);
        endforeach;
        return [$show, $obj, $request];
    }

    public function exportGerencial($request = null)
    {
        $data = $this->getGerencial(explode(",", $request))[1];
        $entradas = [];
        $saidas = [];

        foreach ($data['rows']['td'] as $valor) {
            if (in_array($valor[0], $data['rows']['th']['entradas'])) {
                $entradas[] = $valor;
            }
            if (in_array($valor[0], $data['rows']['th']['saidas'])) {
                $saidas[] = $valor;
            }
        }
        if ($entradas == null) {
            $entradas = [[]];
        }
        if ($saidas == null) {
            $saidas = [[]];
        }
        array_unshift($entradas, $data['header']);
        array_unshift($entradas[0], 'contas');

        array_push($entradas[0], 'total');

        array_push($entradas, $data['total']['entradas']);
        array_unshift($entradas[array_key_last($entradas)], 'Entradas');

        array_push($saidas, $data['total']['saidas']);
        array_unshift($saidas[array_key_last($saidas)], 'Saidas');

        array_push($saidas, $data['total']['entradas-saidas']);
        array_unshift($saidas[array_key_last($saidas)], 'Entradas - Saidas');

        $serialize = ['entradas', 'saidas'];

        $this->setResponse($this->getResponse()->withDownload('Gerencial.csv'));
        $this->set(compact('entradas', 'saidas'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => $serialize,
            ]);
    }
}

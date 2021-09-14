<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Lancamentos Controller
 *
 * @property \App\Model\Table\LancamentosTable $Lancamentos
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RelatoriosController extends AppController
{
    public function fluxodecaixa()
    {
        $this->loadModel('Fluxocontas');
        $lancamento = $this->Fluxocontas->get(1);
        debug($lancamento->conta);exit;
        $array = [];
        $array = [
            'periodo' => $this->request->getQuery('periodo'),
            'comeco' => $this->request->getQuery('comeco'),
            'final' => $this->request->getQuery('final'),
        ];
        $this->set(compact('array'));
    }
}

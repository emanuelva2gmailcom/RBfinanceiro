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
        $this->loadModel('Fluxosubgrupos');
        $this->loadModel('Fluxogrupos');
        $this->paginate = [
            'contain' => ['Fluxosubgrupos','Fluxogrupos'],
        ];
        $lancamentos = $this->paginate($this->Fluxocontas);
        $subgrupos = $this->paginate($this->Fluxosubgrupos);
        // $grupos = $this->paginate($this->Fluxogrupos);
        // debug($lancamentos);exit;
        $array = [
            'periodo' => $this->request->getQuery('periodo'),
            'comeco' => $this->request->getQuery('comeco'),
            'final' => $this->request->getQuery('final'),
        ];
        $this->set(compact('array', 'lancamentos', 'subgrupo'));
    }
}

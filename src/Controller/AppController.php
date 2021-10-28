<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Usermgmt.UserAuth');

        $this->loadComponent('FormProtection');
    }
    public function caixaaberto()
    {
        $this->loadModel('Caixas');
        $now = FrozenTime::now()->i18nFormat('dd-MM-yyyy', 'UTC');
        $caixas = $this->Caixas->find('all');
        foreach ($caixas as $caixa) :
            if (($now == $caixa->data_caixa) && ($caixa->is_aberto == true)) {
                return $caixa->id_caixa;
                return $caixa->is_aberto;
            }
        endforeach;
        return false;
    }
    public function caixaaberto2()
    {
        $this->loadModel('Caixas');
        $now = FrozenTime::now()->i18nFormat('dd-MM-yyyy', 'UTC');
        $caixas = $this->Caixas->find('all');
        foreach ($caixas as $caixa) :
            if (($now == $caixa->data_caixa) && ($caixa->is_aberto == true)) {
                return $caixa->is_aberto;
            }

        endforeach;
        return false;
    }
    public function getrenovado()
    {
        $renovados = [];
        $resposta = [
            'and' => 'AND ',
            'or' => 'OR ',
            'simple' => ''
        ];
        $this->loadModel('Lancamentos');
        $lancamentos = $this->Lancamentos->find('all');
        foreach ($lancamentos as $lancamento) :
            $lancamento->lancamento_id != null ? array_push($renovados, $lancamento->lancamento_id) : '';
        endforeach;
        switch ($renovados != null) {
            case true:
                $resposta['simple'] .= "id_lancamento NOT IN(" . implode(',', $renovados) . ")";
                $resposta['and'] .= "id_lancamento NOT IN(" . implode(',', $renovados) . ")";
                $resposta['or'] .= "id_lancamento NOT IN(" . implode(',', $renovados) . ")";
                break;

            case false:
                $resposta['simple'] = "";
                $resposta['and'] = "";
                $resposta['or'] = "";
                break;
        }
        return $resposta;
    }
}

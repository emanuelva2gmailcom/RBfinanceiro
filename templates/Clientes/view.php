<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>

<?php
$this->assign('title', __('Cliente'));
?>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="cardVIEW card card-outline container bg-white ">

    <div class="cardheaderVIEW card-header d-sm-flex">
      <h2 class="card-title"><?= h($cliente->nome) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">
        <tr>
          <th><?= __('Nome') ?></th>
          <td><?= h($cliente->nome) ?></td>
        </tr>
        <tr>
          <th><?= __('Cpf') ?></th>
          <td> <?= h($cliente->cpf) ?></td>
        </tr>
        <tr>
          <th> <?= __('Endereço') ?></th>
          <td><?= h($cliente->endereco) ?></td>
        </tr>
        <tr>
          <th><?= __('E-mail') ?></th>
          <td><?= h($cliente->email) ?></td>
        </tr>
        <tr>
          <th><?= __('Telefone') ?></th>
          <td><?= h($cliente->telefone) ?></td>
        </tr>
        <tr>
          <th><?= __('N° do Cliente') ?></th>
          <td><?= $this->Number->format($cliente->id_cliente) ?></td>
        </tr>
        <tr>
          <th><?= __('Criado') ?></th>
          <td><?= h($cliente->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th><?= __('Modificado') ?></th>
          <td><?= h($cliente->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th><?= __('Pendente') ?></th>
          <td><?= $cliente->is_pendente ? __('Sim') : __('Não'); ?></td>
        </tr>
      </table>
    </div>
    <div class="cardfooterVIEW card-footer bg-white">
      <div class="cardfooterVIEW2 d-flex bd-highlight mb-3">
        <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $cliente->id_cliente],
          ['confirm' => __('você quer mesmo deletar o cliente {0}?',  $cliente->nome), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
        ) ?>
        <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $cliente->id_cliente], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn vis btn-sm btn-outline-info p-2 bd-highlight']) ?>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="relacionadosVIEW related related-caixaregistros view card container bg-white">

    <div class="relacionadosheaderVIEW card-header d-sm-flex">
      <h3 class="cardtitleVIEW card-title"><?= __('Relacionados') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">
        <tr>
          <th><?= __('N° do Lançamento') ?></th>
          <th><?= __('Tipo') ?></th>
          <th><?= __('Descrição') ?></th>
          <th><?= __('Valor') ?></th>
          <th><?= __('Data de Emissão') ?></th>
          <th><?= __('Data de Baixa') ?></th>
          <th><?= __('Data de Vencimento') ?></th>
          <th><?= __('Criado') ?></th>
          <th><?= __('Modificado') ?></th>
          <th><?= __('Conta') ?></th>
          <th><?= __('Fornecedor') ?></th>
          <th><?= __('Cliente') ?></th>
          <th><?= __('Lançamento') ?></th>
          <!-- <th><?= __('Dreconta Id') ?></th> -->
          <th class="actions"><?= __('Ações') ?></th>
        </tr>
        <?php if (empty($lancamento->lancamentos)) { ?>
          <tr>
            <td colspan="15">
              Não Encontrado!
            </td>
          </tr>
        <?php } else { ?>
          <?php foreach ($lancamento->lancamentos as $lancamentos) : ?>
            <tr>
              <td><?= h($lancamentos->id_lancamento) ?></td>
              <td><?= h($lancamentos->tipo) ?></td>
              <td><?= h($lancamentos->descricao) ?></td>
              <td><?= h($lancamentos->valor) ?></td>
              <td><?= h($lancamentos->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <?php if (empty($lancamento->data_baixa)) { ?>
                <td><?= h($lancamento->data_baixa) ?></td>
              <?php } else { ?>
                <td><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <?php } ?>
              <td><?= h($lancamentos->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($lancamentos->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($lancamentos->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td><?= h($lancamentos->fluxoconta_id) ?></td>
              <td><?= h($lancamentos->fornecedor_id) ?></td>
              <td><?= h($lancamentos->cliente_id) ?></td>
              <td><?= h($lancamentos->lancamento_id) ?></td>
              <td><?= h($lancamentos->dreconta_id) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id_lancamento], ['class' => 'btn vis btn-xs btn-outline-info']) ?>
                <?= $this->Html->link(__('Editar'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id_lancamento], ['class' => 'btn edi btn-xs btn-outline-success']) ?>
                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class' => 'btn del btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $lancamentos->id_lancamento)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php } ?>
      </table>
    </div>
  </div>
</div>

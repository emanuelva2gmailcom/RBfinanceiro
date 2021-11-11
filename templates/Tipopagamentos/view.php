<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tipopagamento $tipopagamento
 */
?>

<?php
$this->assign('title', __('Tipopagamento'));
?>

<div class="container-fluid d-flex align-items-center justify-content-center views">

<div class="cardVIEW card card-outline container bg-white ">

    <div class="cardheaderVIEW card-header d-sm-flex">
      <h2 class="cardtitleVIEW card-title"><?= h($tipopagamento->nome) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">
        <tr>
          <th><?= __('Nome') ?></th>
          <td><?= h($tipopagamento->nome) ?></td>
        </tr>
        <tr>
          <th><?= __('Descrição') ?></th>
          <td><?= h($tipopagamento->descricao) ?></td>
        </tr>
        <tr>
          <th><?= __('N° do Tipo de Pagamento') ?></th>
          <td><?= $this->Number->format($tipopagamento->id_tipopagamento) ?></td>
        </tr>
        <tr>
          <th><?= __('Criado') ?></th>
          <td><?= h($tipopagamento->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th><?= __('Modificado') ?></th>
          <td><?= h($tipopagamento->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
      </table>
    </div>
    <div class="cardfooterVIEW card-footer bg-white">
      <div class="cardfooterVIEW2 d-flex mr-auto justify-content-around">
        <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $tipopagamento->id_tipopagamento],
          ['confirm' => __('Você quer mesmo deletar {0}?',  $tipopagamento->nome), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
        ) ?>
        <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $tipopagamento->id_tipopagamento], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn vis btn-sm btn-outline-info p-2 bd-highlight']) ?>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="relacionadosVIEW related related-caixaregistros view card container bg-white">

    <div class="relacionadosheaderVIEW card-header d-sm-flex" >
      <h3 class="cardtitleVIEW card-title"><?= __('Relacionados') ?></h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX table-hover text-nowrap">
        <tr>
          <th><?= __('N° de Caixa Registro') ?></th>
          <th><?= __('Caixa') ?></th>
          <th><?= __('Tipo de Pagamento') ?></th>
          <th><?= __('Lançamento') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php if (empty($tipopagamento->caixaregistros)) { ?>
          <tr>
            <td colspan="5">
              Não encontrado!
            </td>
          </tr>
        <?php } else { ?>
          <?php foreach ($tipopagamento->caixaregistros as $caixaregistros) : ?>
            <tr>
              <td><?= h($caixaregistros->id_caixaregistro) ?></td>
              <td><?= h($caixaregistros->caixa_id) ?></td>
              <td><?= h($caixaregistros->tipopagamento_id) ?></td>
              <td><?= h($caixaregistros->lancamento_id) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Caixaregistros', 'action' => 'view', $caixaregistros->id_caixaregistro], ['class' => 'btn vis btn-xs btn-outline-info']) ?>
                <?= $this->Html->link(__('Editar'), ['controller' => 'Caixaregistros', 'action' => 'edit', $caixaregistros->id_caixaregistro], ['class' => 'btn edi btn-xs btn-outline-success']) ?>
                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Caixaregistros', 'action' => 'delete', $caixaregistros->id_caixaregistro], ['class' => 'btn del btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $caixaregistros->id_caixaregistro)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php } ?>
      </table>
    </div>
  </div>
</div>

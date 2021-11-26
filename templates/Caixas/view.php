<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixa $caixa
 */
?>


<?php
$this->assign('title', __('Caixas')); ?>

<div class="container-fluid d-flex align-items-center justify-content-center views">

  <div class="cardVIEW card card-outline container bg-white ">

    <div class="cardheaderVIEW card-header d-sm-flex">
      <h2 class="card-title"><?= h($caixa->id_caixa) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table theINDEX tboINDEX text-nowrap">
        <tr>
          <th><?= __('N° de Caixa') ?></th>
          <td><?= $this->Number->format($caixa->id_caixa) ?></td>
        </tr>
        <tr>
          <th><?= __('Data do Caixa') ?></th>
          <td><?= h($caixa->data_caixa) ?></td>
        </tr>
        <tr>
          <th><?= __('Criado') ?></th>
          <td><?= h($caixa->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th><?= __('Modificado') ?></th>
          <td><?= h($caixa->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th><?= __('Aberto') ?></th>
          <td><?= $caixa->is_aberto ? __('Sim') : __('Não'); ?></td>
        </tr>
      </table>
    </div>
    <div class="cardfooterVIEW card-footer bg-white">
      <div class="cardfooterVIEW2 d-flex bd-highlight mb-3">
        <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $caixa->id_caixa],
          ['confirm' => __('Você quer mesmo deletar {0}?',  $caixa->id_caixa), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight' ]
        ) ?>
        <!-- <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $caixa->id_caixa], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?> -->
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn vis btn-sm btn-outline-info p-2 bd-highligh']) ?>
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
          <th><?= __('N° do Caixa Registro') ?></th>
          <th><?= __('Caixa') ?></th>
          <th><?= __('Tipo de Pagamento') ?></th>
          <th><?= __('Lançamento') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
        </tr>
        <?php if (empty($caixa->caixaregistros)) { ?>
          <tr>
            <td class="cardtitleVIEW" colspan="5">
              Não encontrado!
            </td>
          </tr>
        <?php } else { ?>
          <?php foreach ($caixa->caixaregistros as $caixaregistros) : ?>
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

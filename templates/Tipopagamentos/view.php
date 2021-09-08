<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tipopagamento $tipopagamento
 */
?>

<?php
$this->assign('title', __('Tipopagamento') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Tipopagamentos' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($tipopagamento->id_tipopagamento) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($tipopagamento->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($tipopagamento->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Tipopagamento') ?></th>
            <td><?= $this->Number->format($tipopagamento->id_tipopagamento) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($tipopagamento->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($tipopagamento->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $tipopagamento->id_tipopagamento],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $tipopagamento->id_tipopagamento), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $tipopagamento->id_tipopagamento], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-caixaregistros view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Caixaregistros') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Caixaregistros' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Caixaregistros' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Caixaregistro') ?></th>
          <th><?= __('Caixa Id') ?></th>
          <th><?= __('Tipopagamento Id') ?></th>
          <th><?= __('Lancamento Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($tipopagamento->caixaregistros)) { ?>
        <tr>
            <td colspan="5" class="text-muted">
              Caixaregistros record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($tipopagamento->caixaregistros as $caixaregistros) : ?>
        <tr>
            <td><?= h($caixaregistros->id_caixaregistro) ?></td>
            <td><?= h($caixaregistros->caixa_id) ?></td>
            <td><?= h($caixaregistros->tipopagamento_id) ?></td>
            <td><?= h($caixaregistros->lancamento_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Caixaregistros', 'action' => 'view', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Caixaregistros', 'action' => 'edit', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Caixaregistros', 'action' => 'delete', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $caixaregistros->id_caixaregistro)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>


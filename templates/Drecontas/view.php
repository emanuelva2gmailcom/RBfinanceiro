<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dreconta $dreconta
 */
?>

<?php
$this->assign('title', __('Dreconta') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Drecontas' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($dreconta->id_dreconta) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Conta') ?></th>
            <td><?= h($dreconta->conta) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($dreconta->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Dregrupo') ?></th>
            <td><?= $dreconta->has('dregrupo') ? $this->Html->link($dreconta->dregrupo->id_dregrupo, ['controller' => 'Dregrupos', 'action' => 'view', $dreconta->dregrupo->id_dregrupo]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Dreconta') ?></th>
            <td><?= $this->Number->format($dreconta->id_dreconta) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($dreconta->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($dreconta->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $dreconta->id_dreconta],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $dreconta->id_dreconta), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $dreconta->id_dreconta], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-lancamentos view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Lancamentos') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Lancamentos' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Lancamentos' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Lancamento') ?></th>
          <th><?= __('Tipo') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Valor') ?></th>
          <th><?= __('Data Emissao') ?></th>
          <th><?= __('Data Baixa') ?></th>
          <th><?= __('Data Vencimento') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Fluxoconta Id') ?></th>
          <th><?= __('Fornecedor Id') ?></th>
          <th><?= __('Cliente Id') ?></th>
          <th><?= __('Lancamento Id') ?></th>
          <th><?= __('Dreconta Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($dreconta->lancamentos)) { ?>
        <tr>
            <td colspan="15" class="text-muted">
              Lancamentos record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($dreconta->lancamentos as $lancamentos) : ?>
        <tr>
            <td><?= h($lancamentos->id_lancamento) ?></td>
            <td><?= h($lancamentos->tipo) ?></td>
            <td><?= h($lancamentos->descricao) ?></td>
            <td><?= h($lancamentos->valor) ?></td>
            <td><?= h($lancamentos->data_emissao) ?></td>
            <td><?= h($lancamentos->data_baixa) ?></td>
            <td><?= h($lancamentos->data_vencimento) ?></td>
            <td><?= h($lancamentos->created) ?></td>
            <td><?= h($lancamentos->modified) ?></td>
            <td><?= h($lancamentos->fluxoconta_id) ?></td>
            <td><?= h($lancamentos->fornecedor_id) ?></td>
            <td><?= h($lancamentos->cliente_id) ?></td>
            <td><?= h($lancamentos->lancamento_id) ?></td>
            <td><?= h($lancamentos->dreconta_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $lancamentos->id_lancamento)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subconta $subconta
 */
?>

<?php
$this->assign('title', __('Subconta') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Subcontas' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($subconta->id_subconta) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Subconta') ?></th>
            <td><?= h($subconta->subconta) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($subconta->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Conta') ?></th>
            <td><?= $subconta->has('conta') ? $this->Html->link($subconta->conta->id_conta, ['controller' => 'Contas', 'action' => 'view', $subconta->conta->id_conta]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Subconta') ?></th>
            <td><?= $this->Number->format($subconta->id_subconta) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($subconta->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($subconta->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $subconta->id_subconta],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $subconta->id_subconta), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $subconta->id_subconta], ['class' => 'btn btn-secondary']) ?>
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
          <th><?= __('Data Competencia') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Subconta Id') ?></th>
          <th><?= __('Fornecedor Id') ?></th>
          <th><?= __('Cliente Id') ?></th>
          <th><?= __('Lancamento Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($subconta->lancamentos)) { ?>
        <tr>
            <td colspan="15" class="text-muted">
              Lancamentos record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($subconta->lancamentos as $lancamentos) : ?>
        <tr>
            <td><?= h($lancamentos->id_lancamento) ?></td>
            <td><?= h($lancamentos->tipo) ?></td>
            <td><?= h($lancamentos->descricao) ?></td>
            <td><?= h($lancamentos->valor) ?></td>
            <td><?= h($lancamentos->data_emissao) ?></td>
            <td><?= h($lancamentos->data_baixa) ?></td>
            <td><?= h($lancamentos->data_vencimento) ?></td>
            <td><?= h($lancamentos->data_competencia) ?></td>
            <td><?= h($lancamentos->created) ?></td>
            <td><?= h($lancamentos->modified) ?></td>
            <td><?= h($lancamentos->subconta_id) ?></td>
            <td><?= h($lancamentos->fornecedor_id) ?></td>
            <td><?= h($lancamentos->cliente_id) ?></td>
            <td><?= h($lancamentos->lancamento_id) ?></td>
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


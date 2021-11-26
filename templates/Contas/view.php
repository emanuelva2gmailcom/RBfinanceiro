<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Conta $conta
 */
?>

<?php
$this->assign('title', __('Conta') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Contas' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($conta->id_conta) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Conta') ?></th>
            <td><?= h($conta->conta) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($conta->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Subgrupo') ?></th>
            <td><?= $conta->has('subgrupo') ? $this->Html->link($conta->subgrupo->id_subgrupo, ['controller' => 'Subgrupos', 'action' => 'view', $conta->subgrupo->id_subgrupo]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Conta') ?></th>
            <td><?= $this->Number->format($conta->id_conta) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($conta->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($conta->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $conta->id_conta],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $conta->id_conta), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $conta->id_conta], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-subcontas view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Subcontas') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Subcontas' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Subcontas' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Subconta') ?></th>
          <th><?= __('Subconta') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Conta Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($conta->subcontas)) { ?>
        <tr>
            <td colspan="7" class="text-muted">
              Subcontas record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($conta->subcontas as $subcontas) : ?>
        <tr>
            <td><?= h($subcontas->id_subconta) ?></td>
            <td><?= h($subcontas->subconta) ?></td>
            <td><?= h($subcontas->descricao) ?></td>
            <td><?= h($subcontas->created) ?></td>
            <td><?= h($subcontas->modified) ?></td>
            <td><?= h($subcontas->conta_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Subcontas', 'action' => 'view', $subcontas->id_subconta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Subcontas', 'action' => 'edit', $subcontas->id_subconta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subcontas', 'action' => 'delete', $subcontas->id_subconta], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $subcontas->id_subconta)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>


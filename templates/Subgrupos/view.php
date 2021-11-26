<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subgrupo $subgrupo
 */
?>

<?php
$this->assign('title', __('Subgrupo') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Subgrupos' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($subgrupo->id_subgrupo) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Subgrupo') ?></th>
            <td><?= h($subgrupo->subgrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($subgrupo->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Grupo') ?></th>
            <td><?= $subgrupo->has('grupo') ? $this->Html->link($subgrupo->grupo->id_grupo, ['controller' => 'Grupos', 'action' => 'view', $subgrupo->grupo->id_grupo]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Subgrupo') ?></th>
            <td><?= $this->Number->format($subgrupo->id_subgrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($subgrupo->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($subgrupo->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $subgrupo->id_subgrupo],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $subgrupo->id_subgrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $subgrupo->id_subgrupo], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-contas view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Contas') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Contas' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Contas' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Conta') ?></th>
          <th><?= __('Conta') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Subgrupo Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($subgrupo->contas)) { ?>
        <tr>
            <td colspan="7" class="text-muted">
              Contas record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($subgrupo->contas as $contas) : ?>
        <tr>
            <td><?= h($contas->id_conta) ?></td>
            <td><?= h($contas->conta) ?></td>
            <td><?= h($contas->descricao) ?></td>
            <td><?= h($contas->created) ?></td>
            <td><?= h($contas->modified) ?></td>
            <td><?= h($contas->subgrupo_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Contas', 'action' => 'view', $contas->id_conta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Contas', 'action' => 'edit', $contas->id_conta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contas', 'action' => 'delete', $contas->id_conta], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $contas->id_conta)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>


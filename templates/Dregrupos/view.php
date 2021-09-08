<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dregrupo $dregrupo
 */
?>

<?php
$this->assign('title', __('Dregrupo') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Dregrupos' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($dregrupo->id_dregrupo) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Grupo') ?></th>
            <td><?= h($dregrupo->grupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($dregrupo->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Dregrupo') ?></th>
            <td><?= $this->Number->format($dregrupo->id_dregrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($dregrupo->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($dregrupo->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $dregrupo->id_dregrupo],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $dregrupo->id_dregrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $dregrupo->id_dregrupo], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-drecontas view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Drecontas') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Drecontas' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Drecontas' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Dreconta') ?></th>
          <th><?= __('Conta') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Dregrupo Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($dregrupo->drecontas)) { ?>
        <tr>
            <td colspan="7" class="text-muted">
              Drecontas record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($dregrupo->drecontas as $drecontas) : ?>
        <tr>
            <td><?= h($drecontas->id_dreconta) ?></td>
            <td><?= h($drecontas->conta) ?></td>
            <td><?= h($drecontas->descricao) ?></td>
            <td><?= h($drecontas->created) ?></td>
            <td><?= h($drecontas->modified) ?></td>
            <td><?= h($drecontas->dregrupo_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Drecontas', 'action' => 'view', $drecontas->id_dreconta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Drecontas', 'action' => 'edit', $drecontas->id_dreconta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Drecontas', 'action' => 'delete', $drecontas->id_dreconta], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $drecontas->id_dreconta)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>


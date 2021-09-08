<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxosubgrupo $fluxosubgrupo
 */
?>

<?php
$this->assign('title', __('Fluxosubgrupo') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Fluxosubgrupos' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($fluxosubgrupo->id_fluxosubgrupo) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Subgrupo') ?></th>
            <td><?= h($fluxosubgrupo->subgrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($fluxosubgrupo->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Fluxogrupo') ?></th>
            <td><?= $fluxosubgrupo->has('fluxogrupo') ? $this->Html->link($fluxosubgrupo->fluxogrupo->id_fluxogrupo, ['controller' => 'Fluxogrupos', 'action' => 'view', $fluxosubgrupo->fluxogrupo->id_fluxogrupo]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Fluxosubgrupo') ?></th>
            <td><?= $this->Number->format($fluxosubgrupo->id_fluxosubgrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fluxosubgrupo->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fluxosubgrupo->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $fluxosubgrupo->id_fluxosubgrupo],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $fluxosubgrupo->id_fluxosubgrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $fluxosubgrupo->id_fluxosubgrupo], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-fluxocontas view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Fluxocontas') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Fluxocontas' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Fluxocontas' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Fluxoconta') ?></th>
          <th><?= __('Conta') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Fluxosubgrupo Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($fluxosubgrupo->fluxocontas)) { ?>
        <tr>
            <td colspan="7" class="text-muted">
              Fluxocontas record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($fluxosubgrupo->fluxocontas as $fluxocontas) : ?>
        <tr>
            <td><?= h($fluxocontas->id_fluxoconta) ?></td>
            <td><?= h($fluxocontas->conta) ?></td>
            <td><?= h($fluxocontas->descricao) ?></td>
            <td><?= h($fluxocontas->created) ?></td>
            <td><?= h($fluxocontas->modified) ?></td>
            <td><?= h($fluxocontas->fluxosubgrupo_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Fluxocontas', 'action' => 'view', $fluxocontas->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Fluxocontas', 'action' => 'edit', $fluxocontas->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Fluxocontas', 'action' => 'delete', $fluxocontas->id_fluxoconta], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $fluxocontas->id_fluxoconta)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>


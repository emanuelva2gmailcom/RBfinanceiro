<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxogrupo $fluxogrupo
 */
?>

<?php
$this->assign('title', __('Fluxogrupo') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Fluxogrupos' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($fluxogrupo->id_fluxogrupo) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Grupo') ?></th>
            <td><?= h($fluxogrupo->grupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($fluxogrupo->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Fluxogrupo') ?></th>
            <td><?= $this->Number->format($fluxogrupo->id_fluxogrupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fluxogrupo->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fluxogrupo->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $fluxogrupo->id_fluxogrupo],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $fluxogrupo->id_fluxogrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $fluxogrupo->id_fluxogrupo], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-fluxosubgrupos view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Fluxosubgrupos') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Fluxosubgrupos' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Fluxosubgrupos' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Fluxosubgrupo') ?></th>
          <th><?= __('Subgrupo') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Fluxogrupo Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($fluxogrupo->fluxosubgrupos)) { ?>
        <tr>
            <td colspan="7" class="text-muted">
              Fluxosubgrupos record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($fluxogrupo->fluxosubgrupos as $fluxosubgrupos) : ?>
        <tr>
            <td><?= h($fluxosubgrupos->id_fluxosubgrupo) ?></td>
            <td><?= h($fluxosubgrupos->subgrupo) ?></td>
            <td><?= h($fluxosubgrupos->descricao) ?></td>
            <td><?= h($fluxosubgrupos->created) ?></td>
            <td><?= h($fluxosubgrupos->modified) ?></td>
            <td><?= h($fluxosubgrupos->fluxogrupo_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Fluxosubgrupos', 'action' => 'view', $fluxosubgrupos->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Fluxosubgrupos', 'action' => 'edit', $fluxosubgrupos->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Fluxosubgrupos', 'action' => 'delete', $fluxosubgrupos->id_fluxosubgrupo], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $fluxosubgrupos->id_fluxosubgrupo)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Grupo $grupo
 */
?>

<?php
$this->assign('title', __('Grupo') );

$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Grupos' => ['action'=>'index'],
      'View',
    ]
  ])
);
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($grupo->id_grupo) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Grupo') ?></th>
            <td><?= h($grupo->grupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($grupo->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Grupo') ?></th>
            <td><?= $this->Number->format($grupo->id_grupo) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($grupo->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($grupo->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete',  $grupo->id_grupo],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $grupo->id_grupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $grupo->id_grupo], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-subgrupos view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Subgrupos') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('New'), ['controller' => 'Subgrupos' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('List '), ['controller' => 'Subgrupos' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Subgrupo') ?></th>
          <th><?= __('Subgrupo') ?></th>
          <th><?= __('Descricao') ?></th>
          <th><?= __('Created') ?></th>
          <th><?= __('Modified') ?></th>
          <th><?= __('Grupo Id') ?></th>
          <th class="actions"><?= __('Actions') ?></th>
      </tr>
      <?php if (empty($grupo->subgrupos)) { ?>
        <tr>
            <td colspan="7" class="text-muted">
              Subgrupos record not found!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($grupo->subgrupos as $subgrupos) : ?>
        <tr>
            <td><?= h($subgrupos->id_subgrupo) ?></td>
            <td><?= h($subgrupos->subgrupo) ?></td>
            <td><?= h($subgrupos->descricao) ?></td>
            <td><?= h($subgrupos->created) ?></td>
            <td><?= h($subgrupos->modified) ?></td>
            <td><?= h($subgrupos->grupo_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['controller' => 'Subgrupos', 'action' => 'view', $subgrupos->id_subgrupo], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Edit'), ['controller' => 'Subgrupos', 'action' => 'edit', $subgrupos->id_subgrupo], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Delete'), ['controller' => 'Subgrupos', 'action' => 'delete', $subgrupos->id_subgrupo], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $subgrupos->id_subgrupo)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>


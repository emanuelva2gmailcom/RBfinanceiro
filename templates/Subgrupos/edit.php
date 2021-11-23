<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subgrupo $subgrupo
 */
?>

<?php $this->assign('title', __('Edit Subgrupo') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Subgrupos' => ['action'=>'index'],
      'View' => ['action'=>'view', $subgrupo->id_subgrupo],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($subgrupo) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('subgrupo');
      echo $this->Form->control('descricao');
      echo $this->Form->control('grupo_id', ['options' => $grupos, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $subgrupo->id_subgrupo],
          ['confirm' => __('Are you sure you want to delete # {0}?', $subgrupo->id_subgrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

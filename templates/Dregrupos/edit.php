<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dregrupo $dregrupo
 */
?>

<?php $this->assign('title', __('Edit Dregrupo') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Dregrupos' => ['action'=>'index'],
      'View' => ['action'=>'view', $dregrupo->id_dregrupo],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($dregrupo) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('grupo');
      echo $this->Form->control('descricao');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $dregrupo->id_dregrupo],
          ['confirm' => __('Are you sure you want to delete # {0}?', $dregrupo->id_dregrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

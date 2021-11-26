<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subconta $subconta
 */
?>

<?php $this->assign('title', __('Add Subconta') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Subcontas' => ['action'=>'index'],
      'Add',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($subconta) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('subconta');
      echo $this->Form->control('descricao');
      echo $this->Form->control('conta_id', ['options' => $contas, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

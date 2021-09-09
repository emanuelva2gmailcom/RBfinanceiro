<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dreconta $dreconta
 */
?>

<?php $this->assign('title', __('Add Dreconta') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Drecontas' => ['action'=>'index'],
      'Add',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($dreconta) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('conta');
      echo $this->Form->control('descricao');
      echo $this->Form->control('dregrupo_id', ['options' => $dregrupos, 'empty' => true]);
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

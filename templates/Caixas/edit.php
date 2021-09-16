<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixa $caixa
 */
?>

<?php $this->assign('title', __('Edit Caixa') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Caixas' => ['action'=>'index'],
      'View' => ['action'=>'view', $caixa->id_caixa],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($caixa) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('data_caixa');
      echo $this->Form->control('is_aberto', ['custom' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $caixa->id_caixa],
          ['confirm' => __('Are you sure you want to delete # {0}?', $caixa->id_caixa), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

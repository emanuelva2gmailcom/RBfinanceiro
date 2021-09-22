<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comprovante $comprovante
 */
?>

<?php $this->assign('title', __('Add Comprovante') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Comprovantes' => ['action'=>'index'],
      'Add',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($comprovante) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('nome_arquivo');
      echo $this->Form->control('tipo');
      echo $this->Form->control('lancamento_id', ['options' => $lancamentos, 'empty' => true]);
      echo $this->Form->control('img');
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

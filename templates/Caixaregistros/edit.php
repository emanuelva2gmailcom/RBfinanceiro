<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixaregistro $caixaregistro
 */
?>

<?php $this->assign('title', __('Edit Caixaregistro') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Caixaregistros' => ['action'=>'index'],
      'View' => ['action'=>'view', $caixaregistro->id_caixaregistro],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($caixaregistro) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('caixa_id', ['options' => $caixas, 'empty' => true]);
      echo $this->Form->control('tipopagamento_id', ['options' => $tipopagamentos, 'empty' => true]);
      echo $this->Form->control('lancamento_id', ['options' => $lancamentos, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $caixaregistro->id_caixaregistro],
          ['confirm' => __('Are you sure you want to delete # {0}?', $caixaregistro->id_caixaregistro), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

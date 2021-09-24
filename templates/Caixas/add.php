<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Caixa $caixa
 */
?>

<?php $this->assign('title', __('Adicionar Caixa') ); ?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($caixa) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('data_caixa');
      echo $this->Form->control('is_aberto', ['custom' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Salvar')) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

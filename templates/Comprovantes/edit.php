<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comprovante $comprovante
 */
?>

<?php $this->assign('title', __('Editar Comprovante') ); ?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($comprovante) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('nome_arquivo');
      echo $this->Form->control('tipo');
      echo $this->Form->control('lancamento_id', ['options' => $lancamentos, 'empty' => true]);
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

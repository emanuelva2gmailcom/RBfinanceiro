<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>

<?php $this->assign('title', __('Editar Cliente') ); ?>

<div class="card card-primary card-outline">
  <?= $this->Form->create($cliente) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('nome');
      echo $this->Form->control('cpf');
      echo $this->Form->control('endereco');
      echo $this->Form->control('email');
      echo $this->Form->control('telefone');
      echo $this->Form->control('is_pendente', ['custom' => true]);
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

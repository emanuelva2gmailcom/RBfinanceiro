<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dregrupo $dregrupo
 */
?>

<?php $this->assign('title', __('Adicionar Dregrupo') ); ?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($dregrupo) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('grupo');
      echo $this->Form->control('descricao');
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

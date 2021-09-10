<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dregrupo $dregrupo
 */
?>

<?php $this->assign('title', __('Editar Dregrupo') ); ?>



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
          __('Deletar'),
          ['action' => 'delete', $dregrupo->id_dregrupo],
          ['confirm' => __('Você quer mesmo deletar {0}?', $dregrupo->id_dregrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Salvar')) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

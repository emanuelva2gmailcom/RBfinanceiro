<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxogrupo $fluxogrupo
 */
?>

<?php $this->assign('title', __('Editar Fluxogrupo') ); ?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($fluxogrupo) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('grupo', [ 'label' => 'Grupo' ]);
      echo $this->Form->control('descricao', [ 'label' => 'Descrição' ]);
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

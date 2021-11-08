<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxosubgrupo $fluxosubgrupo
 */
?>

<?php $this->assign('title', __('Adicionar Subgrupo')); ?>

<div class="container d-flex justify-content-center">

  <div class="carADD card card-danger m-5">
    <div class="carbADD card-body bg-info">
      <?= $this->Form->create($fluxosubgrupo) ?>

      <?= $this->Form->control('subgrupo', ['label' => 'Subgrupo'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('descricao', ['label' => 'Descrição'], ['label' => 'Descrição'], ['class' => 'form-control']); ?>
      <?= $this->Form->control('fluxogrupo_id', ['options' => $fluxogrupos, 'empty' => true], ['label' => 'Grupo'], ['class' => 'form-control']); ?>

    </div>


    <div class="carfADD card-footer bg-white d-flex">
      <div class="mr-auto p-2">
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btnADD btn btn-default']) ?>
      </div>
      <div class="p-2">
        <?= $this->Form->button(__('Salvar')) ?>
      </div>
    </div>

    <?= $this->Form->end() ?>
  </div>
</div>

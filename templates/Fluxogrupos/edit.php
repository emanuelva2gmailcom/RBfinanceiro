<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxogrupo $fluxogrupo
 */
?>

<?php $this->assign('title', __('Editar "{0}"', $fluxogrupo->grupo) ); ?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($fluxogrupo) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('grupo', [ 'label' => 'Grupo' ]);
      echo $this->Form->control('descricao', [ 'label' => 'Descrição' ]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <!-- <?= $this->Html->link(
          __('Delete'),
          ['action' => 'delete', $fluxogrupo->id_fluxogrupo],
          ['confirm' => __('Você quer mesmo deletar "{0}"?', $fluxogrupo->grupo), 'class' => 'btn btn-danger']
      ) ?> -->
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Salvar')) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

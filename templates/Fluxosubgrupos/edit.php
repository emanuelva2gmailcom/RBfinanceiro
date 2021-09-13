<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxosubgrupo $fluxosubgrupo
 */
?>

<?php $this->assign('title', __('Edit Fluxosubgrupo') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Fluxosubgrupos' => ['action'=>'index'],
      'View' => ['action'=>'view', $fluxosubgrupo->id_fluxosubgrupo],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($fluxosubgrupo) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('subgrupo');
      echo $this->Form->control('descricao');
      echo $this->Form->control('fluxogrupo_id', ['options' => $fluxogrupos, 'empty' => true]);
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

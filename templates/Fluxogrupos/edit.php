<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxogrupo $fluxogrupo
 */
?>

<?php $this->assign('title', __('Edit Fluxogrupo') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Fluxogrupos' => ['action'=>'index'],
      'View' => ['action'=>'view', $fluxogrupo->id_fluxogrupo],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($fluxogrupo) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('grupo');
      echo $this->Form->control('descricao');
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $fluxogrupo->id_fluxogrupo],
          ['confirm' => __('Are you sure you want to delete # {0}?', $fluxogrupo->id_fluxogrupo), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

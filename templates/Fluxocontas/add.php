<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxoconta $fluxoconta
 */
?>

<?php $this->assign('title', __('Adicionar Fluxoconta') ); ?>

<style>


    .btn{
        background-color: green;
        color: white;
        border: 1px solid green;
    }

    .btn:hover{
        background-color: white;
        color: green;
        border: 1px solid green;
    }

    .btn:focus{
        background-color: green;
        color: white;
        border: 1px solid green;
    }

</style>


<div class="container p-5" style="width: 60%;min-width:80%;border-radius: 20px;">
<div class="card bg-info" style="border-radius: 20px;">
  <?= $this->Form->create($fluxoconta) ?>
  <div class="card-body text-white">
    <?php
      echo $this->Form->control('conta');
      echo $this->Form->control('descricao');
      echo $this->Form->control('fluxosubgrupo_id', ['options' => $fluxosubgrupos, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer bg-white d-flex"  style="border-radius: 0px 0px 20px 20px;">

<div class="mr-auto p-2">

    <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>

</div>

<div class="p-2" >

    <?= $this->Form->button(__('Salvar')) ?>

</div>

</div>

  <?= $this->Form->end() ?>
</div>
</div>

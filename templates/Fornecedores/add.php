<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore $fornecedore
 */
?>

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


<?php $this->assign('title', __('Adicionar Fornecedor') ); ?>


<div class="container p-5" style="width: 60%;min-width:80%;border-radius: 20px;">
<div class="card bg-info" style="border-radius: 20px;">
  <?= $this->Form->create($fornecedore) ?>
  <div class="card-body text-white">
    <?php
      echo $this->Form->control('nome');
      echo $this->Form->control('cnpj');
      echo $this->Form->control('responsavel');
      echo $this->Form->control('endereco');
      echo $this->Form->control('email');
      echo $this->Form->control('telefone');
      echo $this->Form->control('is_pendente', ['custom' => true]);
    ?>
  </div>

  <div class="card-footer bg-white d-flex justify-content-between"  style="border-radius: 0px 0px 20px 20px;">
    <div class="d-flex">
     <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
    <div class="d-flex" style="margin-left: 87%;">
      <?= $this->Form->button(__('Salvar')) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>

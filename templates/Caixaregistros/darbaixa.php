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
  <?= $this->Form->create($caixaregistro,['type' => 'file']) ?>
   <div class="card-body text-white">
    <?php
    echo $this->Form->control('tipopagamento_id', ['options' => $tipopagamentos]);
    ?>
    <div class="form-group">
      <?= $this->Form->control('uploadfiles', ['type' => 'file']); ?>
    </div>
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

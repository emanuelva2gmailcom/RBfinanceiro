<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento[]|\Cake\Collection\CollectionInterface $lancamentos
 */
?>



<?php $this->assign('title', __('Lancamentos')); ?>

<style>
    .teste {
        color: #E1E7F0;
    }
</style>
<script>
function realizado() {
    document.getElementById('real').style.display= 'block';
    document.getElementById('teste').style.display= 'block';
    document.getElementById('prev').style.display= 'none';
  }

  function previsto(){
    document.getElementById('real').style.display= 'none';
    document.getElementById('teste').style.display= 'block';
    document.getElementById('prev').style.display= 'block';
  }
</script>
<div class="container-fluid vh-50 bg-red m-0 py-5 justify-content-center">
  <div class="row">
    <div class="col-4">
      <div class="d-flex justify-content-center">
        <div class="bd-placeholder-img rounded-circle bg-blue" style="width: 140px; height: 140px;"></div>
      </div>
      <div class="d-flex justify-content-center">
        <h2 class="text-center">Fluxo de Caixa</h2>
      </div>
      <div class="d-flex justify-content-center">
        <p class="text-center">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
      </div>
      <div class="d-flex justify-content-center">
        <p class="text-center"><?= $this->Html->link(__('Fluxodecaixa'), ['action' => '#'], ['class' => 'btn btn-primary', 'onclick' => 'realizado()']) ?></p>
      </div>
    </div>
    <div class="col-4">
      <div class="d-flex justify-content-center">
        <div class="bd-placeholder-img rounded-circle bg-blue" style="width: 140px; height: 140px;"></div>
      </div>
      <div class="d-flex justify-content-center">
        <h2 class="text-center">Caixa Gerencial</h2>
      </div>
      <div class="d-flex justify-content-center">
        <p class="text-center">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
      </div>
      <div class="d-flex justify-content-center">
      <?= $this->Html->link(__('Gerencial'), ['action' => '#'], ['class' => 'btn btn-primary', 'onclick' => 'previsto()']) ?>
      </div>
    </div>
    <div class="col-4">
      <div class="d-flex justify-content-center">
        <div class="bd-placeholder-img rounded-circle bg-blue" style="width: 140px; height: 140px;"></div>
      </div>
      <div class="d-flex justify-content-center">
        <h2 class="text-center">Caixa Diário</h2>
      </div>
      <div class="d-flex justify-content-center">
        <p class="text-center">Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
      </div>
      <div class="d-flex justify-content-center">
      <?= $this->Html->link(__('Caixa diario'), ['controller' => 'relatorios', 'action' => 'caixadiario'], ['class' => 'btn btn-primary btn-sm']) ?>
      </div>
    </div>
  </div>
</div>
<div id="teste" class="container-fluid vh-50 bg-blue m-0 py-5 justify-content-center" style="display: none;">

  <div class="card-body table-responsive p-0">
    <div id='prev' style="display:none;">
        <?= $this->element('relatorios/gerencial', ['obj' => $gerencial]) ?>
    </div>

    <div id='real' style="display:none;">
        <?= $this->element('relatorios/fluxodecaixa', ['obj' => $fluxo]) ?>
    </div>
  </div>

</div>
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
    document.getElementById('prev').style.display= 'none';
  }

  function previsto(){
    document.getElementById('real').style.display= 'none';
    document.getElementById('prev').style.display= 'block';
  }
</script>
<div class="card   card-outline bg-dark">
    <div class="card-header d-sm-flex">
        <h2 class="card-title">
            <!-- -->
        </h2>

        <div>
            <?= $this->Html->link(__('Gerencial'), ['action' => '#'], ['class' => 'btn btn-primary', 'onclick' => 'previsto()']) ?>
        </div>
        <div style="margin-left: 25px;">
            <?= $this->Html->link(__('Fluxodecaixa'), ['action' => '#'], ['class' => 'btn btn-primary', 'onclick' => 'realizado()']) ?>
        </div>

        <div class="card-toolbox">

            <?= $this->Paginator->limitControl([], null, [
                'label' => false,
                'class' => 'form-control-sm',
            ]); ?>
            <?= $this->Html->link(__('Novo Lançamento'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>

    <!-- /.card-header -->
    <?= $this->Html->link(__('Caixa diario'), ['controller' => 'relatorios', 'action' => 'caixadiario'], ['class' => 'btn btn-primary btn-sm']) ?>


  <div class="card-body table-responsive p-0">
    <div id='prev' style="display:none;">
    <?= $this->element('relatorios/gerencial', ['obj' => $gerencial]) ?>
  </div>

    <div id='real' style="display:none;">
        <?= $this->element('relatorios/fluxodecaixa', ['obj' => $fluxo]) ?>
    </div>
    <!-- /.card-footer -->
  </div>

</div>
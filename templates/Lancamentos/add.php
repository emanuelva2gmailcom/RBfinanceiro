<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<?php $this->assign('title', __('Add Lancamento') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Lancamentos' => ['action'=>'index'],
      'Add',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($lancamento) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('tipo');
      echo $this->Form->control('descricao');
      echo $this->Form->control('valor');
      echo $this->Form->control('data_emissao');
      echo $this->Form->control('data_baixa');
      echo $this->Form->control('data_vencimento');
      echo $this->Form->control('fluxoconta_id', ['options' => $fluxocontas, 'empty' => true]);
      echo $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => true]);
      echo $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => true]);
      echo $this->Form->control('lancamento_id');
      echo $this->Form->control('dreconta_id', ['options' => $drecontas, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div> -->

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Shipper</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Destination</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Schedule</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Cargo</small></p>
            </div>
        </div>
    </div>
    
    <form role="form">
    <?= $this->Form->create($lancamento) ?>
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Shipper</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                  <?= $this->Form->control('tipo', [ 'label' => 'Tipo', 'placeholder' => 'Tipo' ], [ 'class' => 'form-control' ]);?>
                     <!-- <label class="control-label">First Name</label>
                     <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter First Name" /> -->
                </div>
                <div class="form-group">
                  <?= $this->Form->control('descricao', [ 'label' => 'descricao', 'placeholder' => 'descricao' ], [ 'class' => 'form-control' ]);?>
                </div>
                <div class="form-group">
                  <?= $this->Form->control('valor', [ 'label' => 'valor', 'placeholder' => 'valor' ], [ 'class' => 'form-control' ]);?>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Destination</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                  <?= $this->Form->control('data_emissao', [ 'label' => 'data_emissao', 'placeholder' => 'data_emissao' ], [ 'class' => 'form-control' ]);?>
                </div>
                <div class="form-group">
                  <?= $this->Form->control('data_baixa', [ 'label' => 'data_baixa', 'placeholder' => 'data_baixa' ], [ 'class' => 'form-control' ]);?>
                </div>
                <div class="form-group">
                  <?= $this->Form->control('data_vencimento', [ 'label' => 'data_vencimento', 'placeholder' => 'data_vencimento' ], [ 'class' => 'form-control' ]);?>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Schedule</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                  <?= $this->Form->control('fluxoconta_id', ['options' => $fluxocontas, 'empty' => true], [ 'label' => 'data_emissao', 'placeholder' => 'data_emissao' ], [ 'class' => 'form-control' ]);?>
                </div>
                <div class="form-group">
                  <?= $this->Form->control('dreconta_id', ['options' => $drecontas, 'empty' => true], [ 'label' => 'data_baixa', 'placeholder' => 'data_baixa' ], [ 'class' => 'form-control' ]);?>
                </div>
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Cargo</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                  <?= $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => true], [ 'label' => 'data_emissao', 'placeholder' => 'data_emissao' ], [ 'class' => 'form-control' ]);?>
                </div>
                <div class="form-group">
                  <?= $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => true], [ 'label' => 'data_baixa', 'placeholder' => 'data_baixa' ], [ 'class' => 'form-control' ]);?>
                </div>
                <?= $this->Form->button(__('Save')) ?>
            </div>
        </div>
    </form>
    <?= $this->Form->end() ?>
</div>

<script>
  $(document).ready(function () {

var navListItems = $('div.setup-panel div a'),
    allWells = $('.setup-content'),
    allNextBtn = $('.nextBtn');

allWells.hide();

navListItems.click(function (e) {
    e.preventDefault();
    var $target = $($(this).attr('href')),
        $item = $(this);

    if (!$item.hasClass('disabled')) {
        navListItems.removeClass('btn-success').addClass('btn-default');
        $item.addClass('btn-success');
        allWells.hide();
        $target.show();
        $target.find('input:eq(0)').focus();
    }
});

allNextBtn.click(function () {
    var curStep = $(this).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
        curInputs = curStep.find("input[type='text'],input[type='url']"),
        isValid = true;

    $(".form-group").removeClass("has-error");
    for (var i = 0; i < curInputs.length; i++) {
        if (!curInputs[i].validity.valid) {
            isValid = false;
            $(curInputs[i]).closest(".form-group").addClass("has-error");
        }
    }

    if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
});

$('div.setup-panel div a.btn-success').trigger('click');
});
</script>
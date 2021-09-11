  <?php
  /**
   * @var \App\View\AppView $this
   * @var \App\Model\Entity\Lancamento $lancamento
   */
  ?>

  <?php $this->assign('title', __('Add Lancamento')); ?>





  <!------ Include the above in your HEAD tag ---------->

  <style>
    /* Latest compiled and minified CSS included as External Resource*/

    /* Optional theme */

    /* @import url('//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css'); */
  

    .stepwizard-step p {
      margin-top: 0px;
      color: #666;
    }

    .stepwizard-row {
      display: table-row;
    }

    .stepwizard {
      display: table;
      width: 100%;
      position: relative;
    }

    .stepwizard-step button [disabled] {
      /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
    }

    .stepwizard .btn.disabled,
    .stepwizard .btn[disabled],
    .stepwizard fieldset[disabled] .btn {
      opacity: 1 !important;
      color: #bbb;
    }

    .stepwizard-row:before {
      top: 14px;
      bottom: 0;
      position: absolute;
      content: " ";
      width: 100%;
      height: 1px;
      background-color: #ccc;
      z-index: 0;
    }

    .stepwizard-step {
      display: table-cell;
      text-align: center;
      position: relative;
    }

    .btn-circle {
      width: 30px;
      height: 30px;
      text-align: center;
      padding: 6px 0;
      font-size: 12px;
      line-height: 1.428571429;
      border-radius: 15px;
    }
   
  </style>
 <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->

  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <div class="card-body">
    <?= $this->Form->create($lancamento) ?>
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

    <div class="containe">
      <div class="container panel panel-primary setup-content" id="step-1">
        <div class="panel-heading">
          <h3 class="panel-title">Shipper</h3>
        </div>
        <div class="panel-body">
          <div class="form-group">

            <?= $this->Form->control('tipo', ['label' => 'Tipo', 'placeholder' => 'tipo'], ['class' => 'form-control']); ?>
          </div>
          <div class="form-group">
            <?= $this->Form->control('descricao', ['label' => 'Descrição', 'placeholder' => 'Descrição'], ['class' => 'form-control']); ?>
          </div>

          <div class="form-group">
            <?= $this->Form->control('valor', ['label' => 'Valor', 'placeholder' => 'Valor'], ['class' => 'form-control']); ?>
          </div>
          <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
        </div>
      </div>
    </div>
    <div class="panel panel-primary setup-content" id="step-2">
      <div class="panel-heading">
        <h3 class="panel-title">Destination</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <?= $this->Form->control('data_emissao', ['label' => 'Data de Emissão', 'placeholder' => 'Data de Emissão'], ['class' => 'form-control']); ?>
        </div>
        <div class="form-group">
          <?= $this->Form->control('data_baixa', ['label' => 'Data de Baixa', 'placeholder' => 'Data de Baixa'], ['class' => 'form-control']); ?>
        </div>

        <div class="form-group">
          <?= $this->Form->control('data_vencimento', ['label' => 'Data de Vencimento', 'placeholder' => 'Data de Vecimento'], ['class' => 'form-control']); ?>
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
          <?= $this->Form->control('fluxoconta_id', ['options' => $fluxocontas, 'empty' => true]); ?>
        </div>
        <div class="form-group">
          <?= $this->Form->control('dreconta_id', ['options' => $drecontas, 'empty' => true]); ?>

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
          <?= $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => true]); ?>
        </div>
        <div class="form-group">
          <?= $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => true]); ?>
        </div>
        <?= $this->Form->button(__('Save', ['class' => 'btn btn-success pull-right'])) ?>
        <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>

      </div>
    </div>
    <?= $this->Form->end() ?>
  </div>

  <script>
    $(document).ready(function() {

      var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');

      allWells.hide();

      navListItems.click(function(e) {
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

      allNextBtn.click(function() {
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
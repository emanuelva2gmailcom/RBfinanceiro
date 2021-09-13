  <?php
  /**
   * @var \App\View\AppView $this
   * @var \App\Model\Entity\Lancamento $lancamento
   */
  ?>

  <?php $this->assign('title', __('Add Lancamento')); ?>

  <?= $this->Html->css('bs-stepper.min.css'); ?>
  <?= $this->Html->script('bs-stepper.min.js'); ?>

  <div class="container">
        <div id="stepper1" class="bs-stepper">
          <div class="bs-stepper-header bg-light">
            <div class="step" data-target="#test-l-1">
              <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">1</span>
                <span class="bs-stepper-label">First step</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#test-l-2">
              <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">2</span>
                <span class="bs-stepper-label">Second step</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#test-l-3">
              <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">3</span>
                <span class="bs-stepper-label">Third step</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#test-l-4">
              <button type="button" class="btn step-trigger">
                <span class="bs-stepper-circle">4</span>
                <span class="bs-stepper-label">Third step</span>
              </button>
            </div>
          </div>
          <div class="bs-stepper-content bg-dark">
            <?= $this->Form->create($lancamento) ?>
            <div id="test-l-1" class="content bg-dark">
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
              </div>
              <div class="btn btn-primary" onclick="stepper1.next()">Next</div>
            </div>
            <div id="test-l-2" class="content bg-dark">
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
              </div>
              <div class="btn btn-primary" onclick="stepper1.next()">Next</div>
              <div class="btn btn-primary" onclick="stepper1.previous()">Previous</div>
            </div>
            <div id="test-l-3" class="content bg-dark">
              <div class="panel-body">
                <div class="form-group">
                  <?= $this->Form->control('fluxoconta_id', ['options' => $fluxocontas, 'empty' => true]); ?>
                </div>
                <div class="form-group">
                  <?= $this->Form->control('dreconta_id', ['options' => $drecontas, 'empty' => true]); ?>
                </div>
              </div>
              <div class="btn btn-primary" onclick="stepper1.next()">Next</div>
              <div class="btn btn-primary" onclick="stepper1.previous()">Previous</div>
            </div>
            <div id="test-l-4" class="content bg-dark">
              <div class="panel-body">
                <div class="form-group">
                  <?= $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => true]); ?>
                </div>
                <div class="form-group">
                  <?= $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => true]); ?>
                </div>
              </div>
              <?= $this->Form->button(__('Save', ['class' => 'btn btn-dark pull-right'])) ?>
              <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
              <div class="btn btn-primary" onclick="stepper1.previous()">Previous</div>
            </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
  </div>
  <script>
    var stepper1Node = document.querySelector('#stepper1')
    var stepper1 = new Stepper(document.querySelector('#stepper1'))

    stepper1Node.addEventListener('show.bs-stepper', function(event) {
      console.warn('show.bs-stepper', event)
    })
    stepper1Node.addEventListener('shown.bs-stepper', function(event) {
      console.warn('shown.bs-stepper', event)
    })

    var stepper2 = new Stepper(document.querySelector('#stepper2'), {
      linear: false,
      animation: true
    })
    var stepper3 = new Stepper(document.querySelector('#stepper3'), {
      animation: true
    })
    var stepper4 = new Stepper(document.querySelector('#stepper4'))
  </script>
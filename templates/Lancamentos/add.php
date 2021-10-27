<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<style>
    @media (max-width: 620px) {
        .card {
            position: absolute;
            margin-left: -77px;
            min-width: 90%;
        }

        .tipo {

            min-width: 275px;
        }

        .line {
            min-width: 2px;
            min-height: 2px;
            margin: 0px;
        }
    }

    @media (max-width: 370px) {

        .line {
            display: none;

        }

        .bs-stepper-header {
            display: flex;
            justify-content: space-between;
        }

        .poxa,
        .grupo {
            width: 275px;
        }

    }
</style>

<?php $this->assign('title', __('Adicionar Lançamento')); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?= $this->Html->css('bs-stepper.min.css'); ?>
<?= $this->Html->script('bs-stepper.min.js'); ?>
<div class="container p-5" style="width: 60%;min-width:80%;">
    <div id="stepper1" class="bs-stepper card">
        <div class="bs-stepper-header bg-info" style="margin: 0px;">
            <div class="step" data-target="#test-l-1">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">1</span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#test-l-2">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">2</span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#test-l-3">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">3</span>
                </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#test-l-4">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">4</span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content bg-white" style="padding: 20px;">
            <?= $this->Form->create($lancamento, ['type' => 'file']) ?>
            <div id="test-l-1" class="content bg-white">
                <div class="panel-body text-info">
                    <div class="form-group ">
                        <?= $this->Form->label('Tipo') ?>
                        <?= $this->Form->select('tipo', ['PREVISTO' => 'PREVISTO', 'REALIZADO' => 'REALIZADO'], ['class' => 'form-control tipo', 'empty' => 'SELECIONE']); ?>
                        <span class="span text-red"></span>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('descricao', ['label' => 'Descrição', 'placeholder' => 'Descrição'], ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('valor', ['label' => 'Valor', 'placeholder' => 'Valor'], ['class' => 'border border-success text-info form-control']); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div style="background-color: green; color: white;" id="proximo" class="btn" onclick="stepper1.next()">Próximo</div>

                </div>
            </div>

            <div id="test-l-2" class="content bg-white">
                <div class="panel-body text-info">
                    <div class="form-group">
                        <?= $this->Form->control('data_emissao', ['label' => 'Data de Emissão', 'placeholder' => 'dd/mm/yyyy'], ['class' => 'border border-success text-info form-control poxa']); ?>
                    </div>
                    <div class="form-group baixa">
                        <?= $this->Form->control('data_baixa', ['label' => 'Data de Baixa', 'placeholder' => 'Data de Baixa'], ['class' => 'border border-success text-info form-control poxa']); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('data_vencimento', ['label' => 'Data de Vencimento', 'placeholder' => 'Data de Vecimento'], ['class' => 'border border-success text-info form-control poxa']); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div style="background-color: green; color: white;" class="btn" onclick="stepper1.previous()">Voltar</div>
                    <div style="background-color: green; color: white;" class="btn" onclick="stepper1.next()">Próximo</div>
                </div>
            </div>
            <div id="test-l-3" class="content bg-white">
                <div class="panel-body text-info">

                    <div class="form-group">
                        <?= $this->Form->control('grupo', ['options' => $Grupos, 'empty' => 'SELECIONE', 'class' => 'grupo']) ?>
                        <span class="s-grupo text-red"></span>
                    </div>

                    <!-- <div class="form-group tudo">
                          <?= $this->Form->control('fluxoconta_id', ['options' => $tudo, 'empty' => 'SELECIONE', 'class' => 'conta']); ?>
                      </div> -->
                    <div class="form-group select">
                        <label for="" class="l-todos">Conta</label>
                        <select name="" class="todos form-control" id="">
                            <option value="0">SELECIONE</option>
                            <?php
                            foreach ($todos as $t => $todo) :
                            ?>
                                <option value=<?= $t ?>><?= $todo ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group select">
                        <label for="" class="l-entradas d-none">Conta</label>
                        <select name="" class="entradas form-control d-none" id="">
                            <option>SELECIONE</option>
                            <?php
                            foreach ($entradas as $i => $entrada) :
                            ?>
                                <option value=<?= $i ?>><?= $entrada ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="form-group select ">
                        <label for="" class="l-saidas d-none">Conta</label>
                        <select name="" class="saidas form-control d-none" id="">
                            <option>SELECIONE</option>
                            <?php
                            foreach ($saidas as $o => $saida) :
                            ?>
                                <option value=<?= $o ?>><?= $saida ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="d-flex justify-content-between">
                    <div style="background-color: green; color: white;" class="btn" onclick="stepper1.previous()">Voltar</div>
                    <div style="background-color: green; color: white;" class="btn" id="teste" onclick="stepper1.next()">Próximo</div>
                </div>
            </div>
            <div id="test-l-4" class="content bg-white">
                <div class="panel-body text-info">
                    <div class="fornecedor form-group">
                        <?= $this->Form->control('fornecedor_id', ['label' => 'Fornecedor'], ['options' => $fornecedores, 'empty' => 'SELECIONE']); ?>
                    </div>
                    <div class="cliente form-group">
                        <?= $this->Form->control('cliente_id', ['label' => 'Cliente'], ['options' => $clientes, 'empty' => 'SELECIONE']); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('Comprovante', ['type' => 'file'], ['class' => 'file']); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn text-white btn-info']) ?>
                    </div>
                    <div>
                        <div style="background-color: green; color: white;" class="btn" onclick="stepper1.previous()">Voltar</div>
                        <?= $this->Form->button(__('Salvar', ['class' => 'btn pull-right']), ['confirm' => 'Quer mesmo salvar esse lançamento?']) ?>
                    </div>
                </div>
            </div>
            <?= $this->Form->end() ?>
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

    </div>
</div>


<script>
    $(".tipo").change(function() {
        $tipo = $(".tipo").val();
        if ($tipo == "PREVISTO") {
            $(".file").addClass('d-none');
            $('.baixa').addClass('d-none');
        } else {
            $(".file").removeClass('d-none');
            $('.baixa').removeClass('d-none');
        }
    });

    $('.grupo').change(function() {
        $grupo = $(".grupo option:selected").text();

        if ($grupo == 'saida') {
            $('.entradas').addClass('d-none')
            $('.l-entradas').addClass('d-none')

            $('.todos').addClass('d-none')
            $('.l-todos').addClass('d-none')

            $('.saidas').removeClass('d-none')
            $('.l-saidas').removeClass('d-none')
            $('.saidas').attr('id', 'fluxoconta-id').attr('name', 'fluxoconta_id')

            $('#teste').attr('onclick', 'stepper1.next()')
            $('.s-grupo').text(' ')

        } else if ($grupo == 'entrada') {
            $('.saidas').addClass('d-none')
            $('.l-saidas').addClass('d-none')

            $('.todos').addClass('d-none')
            $('.l-todos').addClass('d-none')

            $('.entradas').removeClass('d-none')
            $('.l-entradas').removeClass('d-none')
            $('.entradas').attr('id', 'fluxoconta-id').attr('name', 'fluxoconta_id')

            $('#teste').attr('onclick', 'stepper1.next()')
            $('.s-grupo').text(' ')
        } else {
            $('.saidas').addClass('d-none');
            $('.l-saidas').addClass('d-none')

            $('.entradas').addClass('d-none');
            $('.l-entradas').addClass('d-none')

            $('.todos').removeClass('d-none');
            $('.l-todos').removeClass('d-none')


        }

    });


    $('.entradas').change(function() {
        $tipo = $(".entradas option:selected").text();
        if ($tipo.indexOf('cliente') != -1) {
            $('.cliente').removeClass('d-none')
            $('.fornecedor').addClass('d-none');

        } else {
            $('.cliente').addClass('d-none');
            $('.fornecedor').addClass('d-none');
        }

    });


    $('.saidas').change(function() {
        $tipo = $(".saidas option:selected").text();

        if ($tipo.indexOf('fornecedor') != -1) {

            $('.cliente').addClass('d-none')
            $('.fornecedor').removeClass('d-none');

        } else {
            $('.cliente').addClass('d-none');
            $('.fornecedor').addClass('d-none');
        }
    });


    $('.tipo').change(function() {
        $tipo = $('.tipo').val();
        try {
            const response = axios.get('/caixas/getAberto').then(function(response) {
                if ((response.data !== true) && ($tipo !== 'PREVISTO')) {
                    $('.span').text('Caixa Fechado');
                    $('#proximo').removeAttr('onclick')
                } else {
                    $('.span').text(' ');
                    $('#proximo').attr('onclick', 'stepper1.next()');
                }
            })
        } catch (error) {
            console.log(error);
        }

    })


    function grupo($grupo) {
        $grupo = $grupo;
        if ($grupo == 0) {
            $('#teste').removeAttr('onclick')
            $('.todos').prop('disabled', true);
        }

        $('#teste').click(function() {
                if ($grupo == 0) {
                    $('.s-grupo').text('Campo Obrigatório')
                } else {
                    $('.s-grupo').text(' ')
                }
            })
    }

    $('.grupo').ready(function() {
        $grupo = $('.grupo').val();
        grupo($grupo)
    })

    $('.grupo').change(function() {
        $grupo = $('.grupo').val();
        grupo($grupo)
    })
</script>

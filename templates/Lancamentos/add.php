<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php $this->assign('title', __('Adicionar Lançamento')); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?= $this->Html->css('bs-stepper.min.css'); ?>
<?= $this->Html->script('bs-stepper.min.js'); ?>
<div class="containerADD container p-5">
    <div id="stepper1" class="cardlancADD bs-stepper card">
        <div class="bsstepperheaderADD bs-stepper-header">
            <div class="step" data-target="#test-l-1">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">1</span>
                </button>
            </div>
            <div class="lineADD line"></div>
            <div class="step" data-target="#test-l-2">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">2</span>
                </button>
            </div>
            <div class="lineADD line"></div>
            <div class="step" data-target="#test-l-3">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">3</span>
                </button>
            </div>
            <div class="lineADD line"></div>
            <div class="step" data-target="#test-l-4">
                <button type="button" class="btn step-trigger">
                    <span class="bs-stepper-circle">4</span>
                </button>
            </div>
        </div>
        <div class="bssteppercontentADD bs-stepper-content">
            <?= $this->Form->create($lancamento, ['type' => 'file']) ?>
            <div id="test-l-1" class="bssteppercontentContent content">
                <div class="panel-body">
                    <div class="form-group ">
                        <?= $this->Form->label('Tipo') ?>
                        <?= $this->Form->select('tipo', ['PREVISTO' => 'PREVISTO', 'REALIZADO' => 'REALIZADO'], ['class' => 'form-control', 'empty' => 'SELECIONE', 'class' => 'tipo']); ?>
                        <span class="tipo-span"></span>
                        <span class="Campo-Obrigatorio"></span>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('descricao', ['label' => 'Descrição', 'placeholder' => 'Descrição'], ['class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('valor', ['label' => 'Valor', 'placeholder' => 'Valor'], ['class' => 'border form-control']); ?>
                        <span class="Campo-Obrigatorio0"></span></span>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('parcela', ['label' => 'Parcela', 'placeholder' => 'Parcela'], ['class' => 'border form-control']); ?>
                        <span class="Campo-Obrigatorio1"></span>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div id="Card1-Proximo" class="prox-antADD btn" onclick="stepper1.next()">Próximo</div>

                </div>
            </div>

            <div id="test-l-2" class="bssteppercontentContent content">
                <div class="panel-body">
                    <div class="form-group">
                        <?= $this->Form->control('data_emissao', ['label' => 'Data de Emissão', 'placeholder' => 'dd/mm/yyyy'], ['class' => 'border form-control dataADD']); ?>
                        <span class="Campo-Obrigatorio0"></span></span>
                    </div>
                    <div class="form-group data-baixa">
                        <?= $this->Form->control('data_baixa', ['label' => 'Data de Baixa', 'placeholder' => 'Data de Baixa'], ['class' => 'border form-control dataADD']); ?>
                        <span class="Campo-Obrigatorio1"></span></span>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('data_vencimento', ['label' => 'Data de Vencimento', 'placeholder' => 'Data de Vencimento'], ['class' => 'border form-control dataADD']); ?>
                        <span class="Campo-Obrigatorio2"></span></span>
                    </div>
                    <div class="form-group competencia">
                        <?= $this->Form->control('data_competencia', ['label' => 'Data de Competência', 'placeholder' => 'Data de Competência'], ['class' => 'border form-control dataADD']); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="prox-antADD btn" onclick="stepper1.previous()">Voltar</div>
                    <div id="Card2-Proximo" class="prox-antADD btn" onclick="stepper1.next()">Próximo</div>
                </div>
            </div>
            <div id="test-l-3" class="bssteppercontentContent content">
                <div class="panel-body">
                    <div class="form-group">
                        <?= $this->Form->control('grupo_id', ['options' => $Grupos, 'empty' => 'SELECIONE', 'class' => 'grupo']); ?>
                        <span class="s-grupo"></span>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('subconta_id', ['options' => $subcontas, 'empty' => 'SELECIONE', ['class' => 'subconta']]); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="prox-antADD btn" onclick="stepper1.previous()">Voltar</div>
                    <div id="Card3-Proximo" class="prox-antADD btn" onclick="stepper1.next()">Próximo</div>
                </div>
            </div>

            <div id="test-l-4" class="bssteppercontentContent content">
                <div class="panel-body">
                    <div class="fornecedor form-group">
                        <?= $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => 'SELECIONE']); ?>
                    </div>
                    <div class="cliente form-group">
                        <?= $this->Form->control('cliente_id', ['options' => $clientes, 'empty' => 'SELECIONE']); ?>
                    </div>
                    <div class="form-group">
                        <?= $this->Form->control('Comprovante', ['type' => 'file'], ['class' => 'file']); ?>
                    </div>
                </div>
                <div class="footerADD d-flex justify-content-between">
                    <div>
                        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'cancelarADD btn']) ?>
                    </div>
                    <div>
                        <div class="prox-antADD btn" onclick="stepper1.previous()">Voltar</div>
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
    // $('document').ready(function() {
    //     $('#Card2-Proximo').removeAttr('onclick')
    // })
    //---------------- Código de Barramento do Primeiro STEP----------------------
    // >>>>>>>>>>Campo TIPO<<<<<<<<<<<<<<<<<<
    // $('.tipo').ready(function() {
    //     $tipo = $('.tipo').val();
    //     $('#Card1-Proximo').click(function() {
    //         if ($tipo == '') {
    //             $('.tipo-span').text('Campo Obrigatório');
    //         }
    //     })
    //     $('#Card1-Proximo').removeAttr('onclick')

    // })
    // $('.tipo').change(function() {
    //     $tipo = $('.tipo').val();
    //     try {
    //         const response = axios.get('/caixas/getCaixaaberto').then(function(response) {
    //             if ((response.data !== true) && ($tipo !== 'PREVISTO')) {
    //                 if ($tipo == '') {
    //                     $('.tipo-span').text(' ');
    //                     $('.tipo-span').text('Campo Obrigatório');
    //                     $('#Card1-Proximo').removeAttr('onclick')
    //                 } else {
    //                     $('.tipo-span').text('Caixa Fechado');
    //                     $('#Card1-Proximo').removeAttr('onclick')
    //                 }

    //             } else {
    //                 $('.tipo-span').text(' ');
    //                 $('#Card1-Proximo').attr('onclick', 'stepper1.next()');
    //             }
    //             if (response.data == true) {
    //                 if ($tipo == '') {
    //                     $('.tipo-span').text('Campo Obrigatório');
    //                     $('#Card1-Proximo').removeAttr('onclick')
    //                 } else {
    //                     $('.tipo-span').text(' ');
    //                     $('#Card1-Proximo').attr('onclick', 'stepper1.next()');
    //                 }
    //             }

    //         })
    //     } catch (error) {
    //         console.log(error);

    //     }
    //     if ($tipo == "PREVISTO") {
    //         $(".file").addClass('d-none');
    //         $('.data-baixa').addClass('d-none');
    //     } else {
    //         $(".file").removeClass('d-none');
    //         $('.data-baixa').removeClass('d-none');
    //     }
    // })

    // // >>>>>>>>>>Campos VALOR e PARCELA<<<<<<<<<<<<<<<<<<
    // $('#Card1-Proximo').click(function() {
    //     var inputs = [$('#valor').val(), $('#parcela').val()];
    //     inputs.forEach(function(input, index) {
    //         if (input == "") {
    //             $('.Campo-Obrigatorio' + index).text('Campo Obrigatório');
    //             $('#Card1-Proximo').removeAttr('onclick')
    //         } else {
    //             $('.Campo-Obrigatorio' + index).text(' ');
    //             $('#Card1-Proximo').attr('onclick', 'stepper1.next()');
    //         }
    //     });

    // })
    // $('#valor').keyup(function() {
    //     if (this.value.length >= 1) {
    //         $('.Campo-Obrigatorio0').text(' ');
    //     }
    // });
    // $('#parcela').keyup(function() {
    //     if (this.value.length >= 1) {
    //         $('.Campo-Obrigatorio1').text(' ');

    //     }
    // });

    //---------------- Código de Barramento do Segundo STEP----------------------
    // >>>>>>>>>>Campos de  DATAS<<<<<<<<<<<<<<<<<<
    // $('document').ready(function() {
    //     $('#Card2-Proximo').removeAttr('onclick')
    // })
    // $('#Card2-Proximo').click(function() {
    //     var inputs = [$('#data-emissao').val(), $('#data-baixa').val(), $('#data-vencimento').val()];
    //     inputs.forEach(function(input, index) {
    //         if (input == "") {
    //             $('.Campo-Obrigatorio' + index).text('Campo Obrigatório');
    //             $('#Card2-Proximo').removeAttr('onclick')
    //         } else {
    //             $('.Campo-Obrigatorio' + index).text(' ');
    //             $('#Card2-Proximo').attr('onclick', 'stepper1.next()');
    //         }
    //     });
    // })

    // function data(span, index) {
    //     if (span.length >= 0) {
    //         $('.Campo-Obrigatorio' + index).text(' ');
    //     }
    // }
    // $('#data-emissao').keyup(function() {
    //     data(this.value, 0)

    // });
    // $('#data-emissao').change(function() {
    //     data(this.value, 0)

    // });
    // $('#data-baixa').keyup(function() {
    //     data(this.value, 1)
    // });
    // $('#data-baixa').change(function() {
    //     data(this.value, 1)
    // });

    // $('#data-vencimento').keyup(function() {
    //     data(this.value, 2)
    // });
    // $('#data-vncimento').change(function() {
    //     data(this.value, 2)
    // });

    //---------------- Código de Barramento do Terceiro STEP----------------------
    // >>>>>>>>>>Campos de  GRUPO e Conta<<<<<<<<<<<<<<<<<<
    // function grupo(grupos) {
    //     var grupos = grupos;
    //     if (grupos == 0) {
    //         $('Card3-Proximo').removeAttr('onclick')
    //         // $('.todos').prop('disabled', true);
    //     }

    //     $('Card3-Proximo').click(function() {
    //         if (grupos == 0) {
    //             $('.s-grupo').text('Campo Obrigatório')
    //         } else {
    //             $('.s-grupo').text(' ')
    //         }
    //     })
    // }

    // $('.grupo').ready(function() {
    //     var grupos = $('.grupo').val();
    //     // alert(grupo)
    //     grupo(grupos)
    // })

    // $('.grupo').change(function() {
    //     var grupos = $('.grupo').val();
    //     grupo(grupos)
    // })
</script>

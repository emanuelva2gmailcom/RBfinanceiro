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
             <?= $this->Form->create($lancamento, ['type' => 'file', 'id' => 'teste']) ?>
             <div id="test-l-1" class="bssteppercontentContent content">
                 <div class="panel-body">
                     <div class="form-group ">
                         <?= $this->Form->label('Tipo') ?>
                         <?= $this->Form->select('tipo', ['PREVISTO' => 'PREVISTO', 'REALIZADO' => 'REALIZADO'], ['class' => 'form-control', 'empty' => 'SELECIONE', 'class' => 'tipo', 'value' => '']); ?>
                         <span class="tipo-span"></span>
                         <span class="Campo-Obrigatorio"></span>
                     </div>
                     <div class="form-group">
                         <?= $this->Form->control('descricao', ['label' => 'Descrição', 'placeholder' => 'Descrição', 'value' => 'descricao'], ['class' => 'form-control']); ?>
                     </div>
                     <div class="form-group">
                         <?= $this->Form->control('valor', ['label' => 'Valor', 'placeholder' => 'Valor', 'value' => 200], ['class' => 'border form-control']); ?>
                         <span class="Campo-Obrigatorio0"></span>
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
                         <?= $this->Form->control('data_emissao', ['label' => 'Data de Emissão', 'placeholder' => 'dd/mm/yyyy', 'value' => '30/11/2021'], ['class' => 'border form-control dataADD']); ?>
                         <span class="Campo-Obrigatorio00"></span>
                     </div>
                     <div class="form-group data-baixa">
                         <?= $this->Form->control('data_baixa', ['label' => 'Data de Baixa', 'placeholder' => 'Data de Baixa', 'value' => '30/11/2021'], ['class' => 'border form-control dataADD']); ?>
                         <span id='previsto'></span></span>
                     </div>
                     <div class="form-group">
                         <?= $this->Form->control('data_vencimento', ['label' => 'Data de Vencimento', 'placeholder' => 'Data de Vencimento', 'value' => '30/11/2021'], ['class' => 'border form-control dataADD']); ?>
                         <span class="Campo-Obrigatorio02"></span>
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
                         <span class="Campo-Obrigatorio10"></span>
                     </div>
                     <div class="form-group select">
                         <label for="" class="entradas d-none">Conta</label>
                         <select name="" class="entradas form-control d-none" id="">
                             <option>SELECIONE</option>
                             <?php
                                foreach ($entradas as $e => $entrada) :
                                ?>
                                 <option value=<?= $e ?>><?= $entrada ?></option>
                             <?php endforeach; ?>
                         </select>
                         <span class="Campo-Obrigatorio00"></span>
                     </div>
                     <div class="form-group select">
                         <label for="" class="saidas d-none">Conta</label>
                         <select name="" class="saidas form-control d-none" id="">
                             <option>SELECIONE</option>
                             <?php
                                foreach ($saidas as $s => $saida) :
                                ?>
                                 <option value=<?= $s ?>><?= $saida ?></option>
                             <?php endforeach; ?>
                         </select>
                         <span class="Campo-Obrigatorio01"></span>
                     </div>
                     <div class="form-group select">
                         <label for="" class="tudo">Conta</label>
                         <select name="" class="tudo form-control" id="">
                             <option>SELECIONE</option>
                             <?php
                                foreach ($subcontas as $s => $subconta) :
                                ?>
                                 <option value=<?= $s ?>><?= $subconta ?></option>
                             <?php endforeach; ?>
                         </select>
                     </div>
                 </div>
                 <!-- <div class="form-group">
                  <?= $this->Form->control('subconta_id', ['options' => $subcontas, 'empty' => 'SELECIONE']); ?>
                         <span class="Campo-Obrigatorio1"></span>
                     </div> -->
                 <div class="d-flex justify-content-between">
                     <div class="prox-antADD btn" onclick="stepper1.previous()">Voltar</div>
                     <div id="Card3-Proximo" class="prox-antADD btn" onclick="stepper1.next()">Próximo</div>
                 </div>
             </div>

             <div id="test-l-4" class="bssteppercontentContent content">
                 <div class="panel-body">
                     <div class="fornecedor form-group fornecedor">
                         <?= $this->Form->control('fornecedor_id', ['options' => $fornecedores, 'empty' => 'SELECIONE']); ?>
                     </div>
                     <div class="cliente form-group cliente">
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
                         <?= $this->Form->button(__('Salvar', ['class' => 'btn pull-right'], ['id' => 'bora'])) ?>
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
     $('document').ready(function() {
         $('#Card1-Proximo').removeAttr('onclick')
         $('#Card2-Proximo').removeAttr('onclick')
         $('#Card3-Proximo').removeAttr('onclick')
     })

     //---------------- Código de Barramento do Primeiro STEP----------------------
     // >>>>>>>>>>Campo TIPO<<<<<<<<<<<<<<<<<<

     $('.tipo').ready(function() {
         $tipo = $('.tipo').val();
         $('#Card1-Proximo').click(function() {
             if ($tipo == '') {
                 $('.tipo-span').text('Campo Obrigatório');
             }
         })
     })
     var caixa = 0
     $('.tipo').change(function() {
         $tipo = $('.tipo').val();
         try {
             const response = axios.get('/caixas/getCaixaaberto').then(function(response) {
                 if ((response.data !== true) && ($tipo !== 'PREVISTO')) {
                     if ($tipo == '') {
                         $('.tipo-span').text(' ');
                         $('.tipo-span').text('Campo Obrigatório');
                     } else {
                         $('.tipo-span').text('Caixa Fechado');
                         $('#Card1-Proximo').removeAttr('onclick')
                     }

                 } else {
                     $('.tipo-span').text(' ');
                 }
                 if (response.data == true) {
                     caixa = true;
                     if ($tipo == '') {
                         $('.tipo-span').text('Campo Obrigatório');
                     } else {
                         $('.tipo-span').text(' ');
                     }
                 }

             })
         } catch (error) {
             console.log(error);

         }
         if ($tipo == "PREVISTO") {
             $(".file").addClass('d-none');
             $('.data-baixa').addClass('d-none');
             $('#previsto').removeClass('Campo-Obrigatorio01')
         } else {
             $(".file").removeClass('d-none');
             $('.data-baixa').removeClass('d-none');
             $('#previsto').addClass('Campo-Obrigatorio01')
         }
     })


     // FUNÇÂO AUXILIAR
     function auxiliar() {
         var tipo = $('.tipo').val();
         var Valor = $('#valor').val();

         if ((Valor != '') && ($tipo == 'PREVISTO' || ($tipo == 'REALIZADO' && caixa == true))) {
             $('#Card1-Proximo').attr('onclick', 'stepper1.next()');
         } else {
             $('#Card1-Proximo').removeAttr('onclick')
         }
     }
     setInterval("auxiliar()", 1000)
     // >>>>>>>>>>Campos VALOR e PARCELA<<<<<<<<<<<<<<<<<<

     $('#Card1-Proximo').click(function() {
         var inputs = [$('#valor').val()];
         inputs.forEach(function(input, index) {
             if (input == "") {
                 $('.Campo-Obrigatorio' + index).text('Campo Obrigatório');
             } else {
                 $('.Campo-Obrigatorio' + index).text(' ');
             }
         });

     })

     $('#valor').keyup(function() {
         if (this.value.length >= 1) {
             $('.Campo-Obrigatorio0').text(' ');
         }
     });

     //---------------- Código de Barramento do Segundo STEP----------------------
     // >>>>>>>>>>Campos de  DATAS<<<<<<<<<<<<<<<<<<

     $('#Card2-Proximo').click(function() {
         var inputs = [$('#data-emissao').val(), $('#data-baixa').val(), $('#data-vencimento').val()];
         inputs.forEach(function(input, index) {
             if (input == "") {
                 $('.Campo-Obrigatorio0' + index).text('Campo Obrigatório');

             } else {
                 $('.Campo-Obrigatorio0' + index).text(' ');
             }
         });
     })

     function data(span, index) {
         if (span.length >= 0) {
             $('.Campo-Obrigatorio0' + index).text(' ');
         }
     }
     $('#data-emissao').keyup(function() {
         data(this.value, 0)

     });
     $('#data-emissao').change(function() {
         data(this.value, 0)

     });
     $('#data-baixa').keyup(function() {
         data(this.value, 1)
     });
     $('#data-baixa').change(function() {
         data(this.value, 1)
     });

     $('#data-vencimento').keyup(function() {
         data(this.value, 2)
     });
     $('#data-vencimento').change(function() {
         data(this.value, 2)
     });

     // FUNÇÂO AUXILIAR

     function auxiliar2() {
         $tipo = $('.tipo').val();
         if ($tipo == "PREVISTO") {
             var dataEmissao = $('#data-emissao').val()
             var dataVencimento = $('#data-vencimento').val()
             if ((dataEmissao != "") && (dataVencimento != "")) {
                 $('#Card2-Proximo').attr('onclick', 'stepper1.next()');
             } else {
                 $('#Card2-Proximo').removeAttr('onclick')

             }


         } else {
             var dataEmissao = $('#data-emissao').val()
             var dataBaixa = $('#data-baixa').val()
             var dataVencimento = $('#data-vencimento').val()
             if ((dataEmissao != "") && (dataBaixa != "") && (dataVencimento != "")) {
                 $('#Card2-Proximo').attr('onclick', 'stepper1.next()');
             } else {
                 $('#Card2-Proximo').removeAttr('onclick')

             }

         }

     }
     setInterval("auxiliar2()", 1000)
     //---------------- Código de Barramento do Terceiro STEP----------------------
     // >>>>>>>>>>Campos de  GRUPO e CONTA<<<<<<<<<<<<<<<<<<

     $('#grupo-id').change(function() {
         $('.CampoGrupo').text(' ');
         var inputs = [$(".entradas option:selected").text(), $(".saidas option:selected").text()];
         inputs.forEach(function(input, index) {
             $('.Campo-Obrigatorio0' + index).text(' ')
         })
         var grupo = $("#grupo-id option:selected").text()
         if (grupo == 'saida') {
             $('.saidas').removeClass('d-none')

             $('.entradas').addClass('d-none')
             $('.tudo').addClass('d-none')
             $('.fornecedor').removeClass('d-none')
             $('.cliente').addClass('d-none')

             $('.saidas').attr('id', 'subconta_id').attr('name', 'subconta_id')

         } else if (grupo == 'entrada') {
             $('.entradas').removeClass('d-none')

             $('.saidas').addClass('d-none')
             $('.tudo').addClass('d-none')
             $('.cliente').removeClass('d-none')
             $('.fornecedor').addClass('d-none')

             $('.entradas').attr('id', 'subconta_id').attr('name', 'subconta_id')
         } else {
             $('.tudo').removeClass('d-none')

             $('.saidas').addClass('d-none')
             $('.entradas').addClass('d-none')
         }
     })

     $('#Card3-Proximo').click(function() {

         var inputs = [
             [$(".entradas option:selected").text(), $('.entradas').is(":hidden")],
             [$(".saidas option:selected").text(), $('.saidas').is(":hidden")],
         ];
         var grupo = $("#grupo-id option:selected").text();
         var cont = 0;
         inputs.forEach(function(input, index) {
             if (input[0] == "SELECIONE") {
                 cont++
                 if (input[0] == "SELECIONE" && input[1] == false) {
                     $('#Card3-Proximo').removeAttr('onclick')
                     $('.Campo-Obrigatorio0' + index).text('Campo Obrigatório')

                 }
             }
         });
         if (grupo == 'SELECIONE') {
             $('.Campo-Obrigatorio10').text('Campo Obrigatório')
         }
     })

     // FUNÇÂO AUXILIAR


     $('#grupo-id').change(function() {
         console.log(this.value)
         if (this.value != ' ') {
             $('.Campo-Obrigatorio10').text(' ');
         }
     });


     function conta(index) {
         $('.Campo-Obrigatorio0' + index).text(' ')
     }
     $('.entradas').change(function() {
         conta(0)
     })
     $('.saidas').change(function() {
         conta(1)
     })


     function auxiliar3() {
         var inputs = [
             [$(".entradas option:selected").text(), $('.entradas').is(":hidden")],
             [$(".saidas option:selected").text(), $('.saidas').is(":hidden")],
         ];
         var grupo = $("#grupo-id option:selected").text();
         var cont = 0;
         inputs.forEach(function(input, index) {
             if (input[0] == "SELECIONE") {
                 cont++
             }
         });

         if (cont < 2 && grupo != 'SELECIONE') {
             $('#Card3-Proximo').attr('onclick', 'stepper1.next()');

         } else {
             $('#Card3-Proximo').removeAttr('onclick')
         }

     }
     setInterval("auxiliar3()", 1000)
 </script>
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

                     <div class="form-group">
                         <?= $this->Form->control('descricao', ['label' => 'Descrição', 'placeholder' => 'Descrição', 'value' => 'descricao'], ['class' => 'form-control']); ?>
                     </div>
                     <div class="form-group">
                         <?= $this->Form->control('valor', ['label' => 'Valor', 'placeholder' => 'Valor', 'value' => 200], ['class' => 'border form-control']); ?>
                         <span class="Campo-Obrigatorio0"></span>
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
                         <span class="Campo-Obrigatorio000"></span>
                     </div>
                     <div class="form-group data-baixa">
                         <?= $this->Form->control('data_baixa', ['label' => 'Data de Baixa', 'placeholder' => 'Data de Baixa', 'value' => '30/11/2021'], ['class' => 'border form-control dataADD']); ?>
                         <span class='Campo-Obrigatorio001'></span></span>
                     </div>
                     <div class="form-group">
                         <?= $this->Form->control('data_competencia', ['label' => 'Data de Competência', 'placeholder' => 'Data de Competencia', 'value' => '30/11/2021'], ['class' => 'border form-control dataADD']); ?>
                         <span class="Campo-Obrigatorio002"></span>
                     </div>
                     <div class="form-group">
                         <?= $this->Form->control('data_vencimento', ['label' => 'Data de Vencimento', 'placeholder' => 'Data de Vencimento', 'value' => '30/11/2021'], ['class' => 'border form-control dataADD']); ?>
                         <span class="Campo-Obrigatorio003"></span>
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
                         <span class="CampoGrupo"></span>
                     </div>

                     <div class="form-group select">
                         <label for="" class="variaveis d-none">Conta</label>
                         <select name="" class="variaveis form-control d-none" id="">
                             <option>SELECIONE</option>
                             <?php
                                foreach ($variaveis as $v => $variavel) :
                                ?>
                                 <option value=<?= $v ?>><?= $variavel ?></option>
                             <?php endforeach; ?>
                         </select>
                         <span class="variaveis Campo-Obrigatorio00"></span>
                     </div>
                     <div class="form-group select">
                         <label for="" class="fixos d-none">Conta</label>
                         <select name="" class="fixos form-control d-none" id="">
                             <option>SELECIONE</option>
                             <?php
                                foreach ($fixos as $f => $fixo) :
                                ?>
                                 <option value=<?= $f ?>><?= $fixo ?></option>
                             <?php endforeach; ?>
                         </select>
                         <span class="fixos Campo-Obrigatorio01"></span>
                     </div>

                 </div>
                 <div class="form-group select">
                     <label for="" class="receitas d-none">Conta</label>
                     <select name="" class="receitas form-control d-none" id="">
                         <option>SELECIONE</option>
                         <?php
                            foreach ($receitas as $r => $receita) :
                            ?>
                             <option value=<?= $r ?>><?= $receita ?></option>
                         <?php endforeach; ?>
                     </select>
                     <span class="receitas Campo-Obrigatorio02"></span>
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
                     <!-- <span class="tudo Campo-Obrigatorio03"></span> -->
                     <!-- <div class="form-group">
                         <?= $this->Form->control('subconta_id', ['options' => $subcontas, 'empty' => 'SELECIONE']); ?>
                         <span class="Campo-Obrigatorio1"></span>
                     </div> -->
                 </div>
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
         </script>

     </div>
 </div>

 <script>
     $('document').ready(function() {
         $('#Card1-Proximo').removeAttr('onclick')
         $('#Card2-Proximo').removeAttr('onclick')
         $('#Card3-Proximo').removeAttr('onclick')
     })



     function conta(index) {
         $('.Campo-Obrigatorio0' + index).text(' ')
     }
     $('.variaveis').change(function() {
         conta(0)
     })
     $('.fixos').change(function() {
         conta(1)
     })
     $('.receitas').change(function() {
         conta(2)
     })
     $('#grupo-id').change(function() {
         $('.CampoGrupo').text(' ');
         var inputs = [$(".variaveis option:selected").text(), $(".fixos option:selected").text(), $(".receitas option:selected").text()];
         inputs.forEach(function(input, index) {
             $('.Campo-Obrigatorio0' + index).text(' ')
         })
         var grupo = $("#grupo-id option:selected").text()
         if (grupo == 'Gastos Variáveis') {
             $('.variaveis').removeClass('d-none')

             $('.fixos').addClass('d-none')
             $('.receitas').addClass('d-none')
             $('.tudo').addClass('d-none')
             $('.fornecedor').removeClass('d-none')
             $('.cliente').addClass('d-none')

             $('.variaveis').attr('id', 'subconta_id').attr('name', 'subconta_id')

         } else if (grupo == 'Gastos Fixos') {
             $('.fixos').removeClass('d-none')

             $('.variaveis').addClass('d-none')
             $('.receitas').addClass('d-none')
             $('.tudo').addClass('d-none')
             $('.fornecedor').removeClass('d-none')
             $('.cliente').addClass('d-none')

             $('.fixos').attr('id', 'subconta_id').attr('name', 'subconta_id')
         } else if (grupo == 'Receitas') {
             $('.receitas').removeClass('d-none')

             $('.variaveis').addClass('d-none')
             $('.fixos').addClass('d-none')
             $('.tudo').addClass('d-none')
             $('.cliente').removeClass('d-none')
             $('.fornecedor').addClass('d-none')

             $('.receitas').attr('id', 'subconta_id').attr('name', 'subconta_id')

         } else {
             $('.tudo').removeClass('d-none')

             $('.variaveis').addClass('d-none')
             $('.receitas').addClass('d-none')
             $('.fixos').addClass('d-none')
         }
     })
     //---------------- Código de Barramento do Primeiro STEP----------------------
     // >>>>>>>>>>Campos VALOR <<<<<<<<<<<<<<<<<<

     //  FUNÇÂO AUXILIAR
     function auxiliar() {
         var Valor = $('#valor').val();
         if (Valor != '') {
             $('#Card1-Proximo').attr('onclick', 'stepper1.next()');
         } else {
             $('#Card1-Proximo').removeAttr('onclick')
         }
     }
     setInterval("auxiliar()", 100)

     $('#Card1-Proximo').click(function() {
         var input = $('#valor').val();
         if (input == "") {
             $('.Campo-Obrigatorio0').text('Campo Obrigatório');
         } else {
             $('.Campo-Obrigatorio0').text(' ');
         }


     })

     $('#valor').keyup(function() {
         if (this.value.length >= 1) {
             $('.Campo-Obrigatorio0').text(' ');
         }
     });
     //---------------- Código de Barramento do Segundo STEP----------------------
     // >>>>>>>>>>Campos de  DATAS<<<<<<<<<<<<<<<<<<

     $('#Card2-Proximo').click(function() {
         var inputs = [$('#data-emissao').val(), $('#data-baixa').val(), $('#data-competencia').val(), $('#data-vencimento').val()];
         inputs.forEach(function(input, index) {
             if (input == "") {
                 $('.Campo-Obrigatorio00' + index).text('Campo Obrigatório');

             } else {
                 $('.Campo-Obrigatorio00' + index).text(' ');
             }
         });
     })

     function data(span, index) {
         if (span.length >= 0) {
             $('.Campo-Obrigatorio00' + index).text(' ');
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

     $('#data-competencia').keyup(function() {
         data(this.value, 2)
     });
     $('#data-competencia').change(function() {
         data(this.value, 2)
     });

     $('#data-vencimento').keyup(function() {
         data(this.value, 3)
     });
     $('#data-vencimento').change(function() {
         data(this.value, 3)
     });

     // FUNÇÂO AUXILIAR

     function auxiliar2() {
         var dataEmissao = $('#data-emissao').val()
         var dataBaixa = $('#data-baixa').val()
         var dataCompetencia = $('#data-competencia').val()
         var dataVencimento = $('#data-vencimento').val()
         if ((dataEmissao != "") && (dataBaixa != "") && (dataCompetencia != "") && (dataVencimento != "")) {
             $('#Card2-Proximo').attr('onclick', 'stepper1.next()');
         } else {
             $('#Card2-Proximo').removeAttr('onclick')

         }
     }
     setInterval("auxiliar2()", 100)


     $('#Card3-Proximo').click(function() {
         console.log('tyrt')
         var inputs = [
             [$(".variaveis option:selected").text(), $('.variaveis').is(":hidden")],
             [$(".fixos option:selected").text(), $('.fixos').is(":hidden")],
             [$(".receitas option:selected").text(), $('.receitas').is(":hidden")]
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
             $('.CampoGrupo').text('Campo Obrigatório')
         }
     })
     $('#grupo-id').change(function() {
         console.log(this.value)
         if (this.value != ' ') {
             $('.Campo-Obrigatorio10').text(' ');
         }
     });


     function conta(index) {
         $('.Campo-Obrigatorio0' + index).text(' ')
     }
     $('.variaveis').change(function() {
         conta(0)
     })
     $('.fixos').change(function() {
         conta(1)
     })
     $('.receitas').change(function() {
         conta(2)
     })

     function auxiliar3() {
         var inputs = [
             [$(".variaveis option:selected").text(), $('.variaveis').is(":hidden")],
             [$(".fixos option:selected").text(), $('.fixos').is(":hidden")],
             [$(".receitas option:selected").text(), $('.receitas').is(":hidden")]
         ];
         
         var grupo = $("#grupo-id option:selected").text();
         var cont = 0;
         inputs.forEach(function(input, index) {
             if (input[0] == "SELECIONE") {
                 cont++
             }
         });

         if (cont < 3 && grupo != 'SELECIONE') {
             $('#Card3-Proximo').attr('onclick', 'stepper1.next()');

         } else {
             $('#Card3-Proximo').removeAttr('onclick')
         }

     }
     setInterval("auxiliar3()", 1000)
 </script>
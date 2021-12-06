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
                     <div class="form-group competencia">
                         <?= $this->Form->control('data_competencia', ['label' => 'Data de Competência', 'placeholder' => 'Data de Competência', 'value' => '30/11/2021'], ['class' => 'border form-control dataADD']); ?>
                     </div>
                 </div>
                 <div class="d-flex justify-content-end">
                     <div id="Card1-Proximo" class="prox-antADD btn" onclick="stepper1.next()">Próximo</div>
                 </div>
             </div>
             <div id="test-l-2" class="bssteppercontentContent content">
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
                         <?= $this->Form->button(__('Salvar'), ['id' => 'bora']) ?>
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
     })

     $('form').submit(function() {
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
                     $('.Campo-Obrigatorio0' + index).text('Campo Obrigatório')

                 }
             }
         });
         if (grupo == 'SELECIONE') {
             $('.CampoGrupo').text('Campo Obrigatório')
         }
         if (cont < 3 && grupo != 'SELECIONE') {
             $(this).unbind('submit').submit()

         } else {
             event.preventDefault();
         }

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

             $('.variaveis').attr('id', 'subconta_id').attr('name', 'subconta_id')

         } else if (grupo == 'Gastos Fixos') {
             $('.fixos').removeClass('d-none')

             $('.variaveis').addClass('d-none')
             $('.receitas').addClass('d-none')
             $('.tudo').addClass('d-none')
             $('.fixos').attr('id', 'subconta_id').attr('name', 'subconta_id')
         } else if (grupo == 'Receitas') {
             $('.receitas').removeClass('d-none')

             $('.variaveis').addClass('d-none')
             $('.fixos').addClass('d-none')
             $('.tudo').addClass('d-none')

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
     setInterval("auxiliar()", 1000)
     $('document').load(function() {
         auxiliar()
     })

     $('#Card1-Proximo').click(function() {
         var input = $('#valor').val();
         if (input == "") {
             $('.Campo-Obrigatorio').text('Campo Obrigatório');
         } else {
             $('.Campo-Obrigatorio').text(' ');
         }


     })

     $('#valor').keyup(function() {
         if (this.value.length >= 1) {
             $('.Campo-Obrigatorio0').text(' ');
         }
     });
 </script>
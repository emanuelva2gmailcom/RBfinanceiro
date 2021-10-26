<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore[]|\Cake\Collection\CollectionInterface $fornecedores
 */
?>

<style>
    .tr1 a {
        color: #029BE1;
    }

    .nm a {
        color: green;
    }

    .sorting_disabled{
        color: green;
    }

    td{
        color: #17a2b8;
    }

    .dataTables_info{
        color: green;
    }

    .dataTables_empty{
        color: #17a2b8;
    }

    .dataTables_filter input:focus {
      color: #17a2b8;
      border: green solid 2px;

    }
    .dataTables_filter input{
      color: #17a2b8;
      border: green solid 2px;

    }

    .dataTables_filter label{
      color: #17a2b8;

    }

    .buttons-copy{
        background-color: #17a2b8;
        color: white;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-copy:hover{
        background-color: white;
        color: #17a2b8;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-excel{
        background-color: green;
        color: white;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-excel:hover{
        background-color: white;
        color: green;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-pdf{
        background-color: black;
        color: white;
        border: 1px solid black;
        opacity: 0.7;
    }

    .buttons-pdf:hover{
        background-color: white;
        color: black;
        border: 1px solid black;
        opacity: 0.7;
    }

    .ts .btn{
        background-color: green;
        color: white;
        border: 1px solid green;
    }

    .ts .btn:hover{
        background-color: white;
        color: green;
        border: 1px solid green;
    }

    .ts .btn:focus{
        background-color: green;
        color: white;
        border: 1px solid green;
    }

    @media (width: 320px) {
    .teste  {
      width: 316px;
      margin-left: -16%;
    }

    .pe{
        width: 50px;
    }

    .ts .btn{
       font-size: 14px;
    }

  }

  @media (width: 370px) {
    .teste  {
      width: 316px;
      margin-left: -16%;
    }

    .pe{
        width: 50px;
    }

    .ts .btn{
       font-size: 14px;
    }

  }


</style>


       <div class="card">
           <div class="card-header">
               <div class="card-body">
                   <?= $this->Form->create([], ['id' => 'form', 'class' => 'row']) ?>
                   <div class="teste d-flex flex-row justify-content-center align-items-center content bg-info mb-3 p-3" style="border-radius: 20px;">
                       <div class="col-3 px-3">
                           <?= $this->Form->control(0, ['label' => 'Começo', 'type' => 'date'], ['class' => 'form-control text-white']); ?>
                       </div>
                       <div class="col-3 px-3">
                           <?= $this->Form->control(1, ['label' => 'Final', 'type' => 'date'], ['class' => 'la form-control']); ?>
                       </div>
                       <div class="pe col-3 px-3 mb-3">
                           <label>Período</label>
                           <?= $this->Form->select(2, ['mes' => 'MÊS', 'ano' => 'ANO', 'dia' => 'DIA'], ['class' => 'periodo form-control select2bs4']); ?>
                       </div>
                       <div class="ts col-3 px-2 mt-3">
                           <?= $this->Form->button(__('Calcular'),) ?>
                       </div>
                   </div>
               </div>
           </div>
           <div class="card-2 card-body">
               <table id="example" class="table table-sm table-bordered table-striped table-responsive">
               </table>
           </div>
       </div>
       <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
       <script>
           $('.select2bs4').select2({
               theme: 'bootstrap4'
           })

           function datase(data) {
               response = []
               data.total.entradas.push(data.total.entradas[0])
               data.total.entradas[0] = 'Entradas'
               response.push(data.total.entradas)
               data.rows.td.map(function(d) {
                   if (data.rows.th['entradas'].includes(d[0])) {
                       response.push(d)
                   }
               })
               data.total.saidas.push(data.total.saidas[0])
               data.total.saidas[0] = 'Saidas'
               response.push(data.total.saidas)
               data.rows.td.map(function(d) {
                   if (data.rows.th['saidas'].includes(d[0])) {
                       response.push(d)
                   }
               })
               data.total['entradas-saidas'].unshift('Entradas - Saídas')
               data.total.inicial.unshift('Saldo Inicial')
               data.total.final.unshift('Saldo Final')
               response.push(data.total['entradas-saidas'])
               response.push(data.total.inicial)
               response.push(data.total.final)
               return response
           }


           function formatador(data) {
               data['header'].unshift('Index')
               data['header'].push('Total')
               columns = []
               //    inner = ''
               data['header'].map(function(dat) {
                   columns.push({
                       title: dat,
                   })
               })
               //    $("#thead").html(inner)
               //    dataa =
               $("#example").DataTable({
                   "data": datase(data),
                   "columns": columns,
                   "columnDefs": [{
                       "defaultContent": "-",
                       "targets": "_all"
                   }],
                   "paging": true,
                   "lengthChange": false,
                   "searching": true,
                   "ordering": false,
                   "info": true,
                   "autoWidth": false,
                   "responsive": true,
                   "language": {
                "emptyTable":     "Nenhum registro disponível na tabela",
                "zeroRecords":    "Nenhum registro encontrado",
                "info": "Mostrando _START_ de _END_ dos _TOTAL_ fornecedores",
                "infoEmpty":      "Mostrando 0 de 0 dos 0 fornecedores",
                "infoFiltered":   "(filtrado do total de _MAX_ fornecedores)",
                "search": "Procurar:",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Depois"
    },
},
                   "buttons": ["copy",  "excel", "pdf"]
               }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
               //    console.log('fez')
           }
           $(function() {
               $("button").click(async function(event) {
                   event.preventDefault();
                   const csrf = document.querySelector("#form").querySelectorAll('input[name ="_csrfToken"]')[0].value;
                   $comeco = $("#0").val()
                   $final = $("#1").val()
                   $periodo = $(".periodo").val()
                   console.log([$comeco, $final, $periodo])
                   try {
                       const response = axios.post('/relatorios/getFluxoDeCaixa/', [$comeco, $final, $periodo], {
                           headers: {
                               "X-CSRF-Token": csrf
                           }
                       }).then(function(response) { // handle success
                           $("#example").DataTable().destroy();
                           $("#example").empty()
                           formatador(response.data[1])
                       })
                   } catch (error) {
                       console.error(error);
                   }
               })
               try {
                   const response = axios.get('/relatorios/getFluxoDeCaixa/').then(function(response) { // handle success
                       formatador(response.data[1])
                   })
               } catch (error) {
                   console.error(error);
               }

               // $(".table").DataTable({
               //     "paging": true,
               //     "lengthChange": false,
               //     "searching": true,
               //     "ordering": false,
               //     "info": true,
               //     "autoWidth": false,
               //     "responsive": true,
               //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
               // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');;
               // $("").DataTable({
               //     "ordering": false,
               //     "autoWidth": false,
               //     "responsive": true,
               //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
               // }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');;
           });
       </script>

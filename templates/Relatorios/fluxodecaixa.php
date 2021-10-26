       <div class="card">
           <div class="card-header">
               <div class="card-body">
                   <?= $this->Form->create([], ['id' => 'form']) ?>
                   <div class="d-flex flex-row justify-content-center align-items-center content bg-info mb-3 p-3" style="border-radius: 20px;">
                       <div class="col-3 px-4">
                           <?= $this->Form->control(0, ['label' => 'Começo', 'type' => 'date'], ['class' => 'form-control text-white']); ?>
                       </div>
                       <div class="col-3 px-4">
                           <?= $this->Form->control(1, ['label' => 'Final', 'type' => 'date'], ['class' => 'la form-control']); ?>
                       </div>
                       <div class="col-3 px-4">
                           <label>Período</label>
                           <?= $this->Form->select(2, ['mes' => 'MÊS', 'ano' => 'ANO', 'dia' => 'DIA'], ['class' => 'periodo form-control select2bs4']); ?>
                       </div>
                       <div class="col-3 px-5 mt-3">
                           <?= $this->Form->button(__('Calcular'),) ?>
                       </div>
                   </div>
               </div>
           </div>
           <div class="card-body">
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
                   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
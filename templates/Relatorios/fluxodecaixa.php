       <div class="card">
           <div class="card-header">
               <h3 class="card-title">DataTable with default features</h3>
           </div>
           <!-- /.card-header -->
           <div class="card-body">
               <table id="example1" class="table table-sm table-bordered table-striped table-responsive">
                   <thead>
                       <tr id="thead">
                       </tr>
                   </thead>
                   <tbody>

                   </tbody>
               </table>
           </div>
       </div>
       <div class="container-sm d-flex justify-content-center p-5">
           <div style="border: green 2px solid;border-radius: 20px;" class="card-sm bg-white shadow" style="width: 32rem;">
               <div class="card-body">
                   <h2 style="font-size: 30px; color: green;" class="card-subtitle text-center">Pesquisa de Fluxo de Caixa Avançado</h2>
                   <hr class="border-info">
                   <div class="form-group">
                       <?= $this->Form->create([], ['id' => 'form']) ?>
                       <?= $this->Form->control(0, ['label' => 'Começo', 'type' => 'date'], ['class' => 'form-control text-white']); ?>
                       <?= $this->Form->control(1, ['label' => 'Final', 'type' => 'date'], ['class' => 'la form-control']); ?>
                       <label>Período</label><br>
                       <?= $this->Form->select(2, ['mes' => 'MÊS', 'ano' => 'ANO', 'dia' => 'DIA'], ['class' => 'periodo form-control select2bs4']); ?>
                   </div>
               </div>
               <div class="d-flex justify-content-end card-footer">
                   <?= $this->Form->button(__('Submit', ['class' => 'btn btn-dark pull-right'])) ?>
                   <?= $this->Form->end() ?>
               </div>
           </div>
           <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
           <script>
               $('.select2bs4').select2({
                   theme: 'bootstrap4'
               })

               function datase(data) {
                   response = []
                   response.push(data.total.entradas)
                   data.rows.td.map(function(d) {
                       if (data.rows.th['entradas'].includes(d[0])) {
                           response.push(d)
                       }
                       inner += "<td></td>"
                   })
                   response.push(data.total.saidas)
                   data.rows.td.map(function(d) {
                       if (data.rows.th['saidas'].includes(d[0])) {
                           response.push(d)
                       }
                   })
                   console.log(data)
                   data.total['entradas-saidas'].unshift('Entradas - Saídas')
                   data.total.inicial.unshift('Saldo Inicial')
                   data.total.final.unshift('Saldo Final')
                   response.push(data.total['entradas-saidas'])
                   response.push(data.total.inicial)
                   response.push(data.total.final)
                   return response
               }


               function formatador(data) {
                   data.header.unshift('')
                   columns = []
                   inner = ''
                   data['header'].map(function(dat) {
                       columns.push({
                           data: dat,
                           render: function(data, type, row) {
                               return data;
                           }
                        })
                        inner += `<td>${dat}</td>`
                       
                   })
                   $(inner).appendTo("#head")
                   dataa = datase(data)
                   $(`<th scope="col">Total</th>`).appendTo("#thead")
                   // $("#example1").DataTable().clear()
                   $("#example1").DataTable({
                       "data": dataa,
                       "columns" : columns,
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
                   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
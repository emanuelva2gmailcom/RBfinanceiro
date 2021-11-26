
<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore[]|\Cake\Collection\CollectionInterface $fornecedores
 */
?>
<div class="card cardRELATORIOS">
    <div class="card-header">
        <?= $this->Form->create([], ['id' => 'form', 'class' => 'row']) ?>
        <div class="formgroupPAINEL col-md-3">
            <label>Período</label>
            <?= $this->Form->select(2, [ 'mes' => 'MÊS','ano' => 'ANO'], ['class' => 'periodo form-control select2bs4']); ?>
        </div>
        <div class="formgroupPAINEL col-md-3">
            <?= $this->Form->control(0, ['label' => 'Começo', 'type' => 'month'], ['class' => 'form-control']); ?>
        </div>
        <div class="formgroupPAINEL col-md-3">
            <?= $this->Form->control(1, ['label' => 'Final', 'type' => 'month'], ['class' => 'form-control']); ?>
        </div>

        <div class="formgroupPAINEL col-md-3">
            <label>Enviar</label>
            <?= $this->Form->button(__('Enviar'), ['class' => 'btnADD form-control']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="card-2 card-body table-responsive">
        <table id="example" class="table table-sm table-bordered table-striped">
        <thead class="theINDEX">

            </thead>
            <tbody class="tboINDEX">

            </tbody>
        </table>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $('#reservation').daterangepicker()

    function datase(data) {
        data.total.receitas.map((row, index) => {
            if(index == 0){
                $($('#example').DataTable().row.add(row).draw()
                    .node()).addClass('relatorioFC');
            } else {
                $($('#example').DataTable().row.add(row).draw()
                .node()).addClass('text-success');
            }
        })
        data.total.variaveis.map((row, index) => {
            if(index == 0){
                $($('#example').DataTable().row.add(row).draw()
                    .node()).addClass('relatorioFC');
            } else {
                $($('#example').DataTable().row.add(row).draw()
                    .node()).addClass('text-danger');
            }
        })
        data.total.contribuicao.map((row, index) => {
            if(index == 0){
                $($('#example').DataTable().row.add(row).draw()
                    .node()).addClass('relatorioFC');
            }
        })
        data.total.fixos.map((row, index) => {
            if(index == 0){
                $($('#example').DataTable().row.add(row).draw()
                    .node()).addClass('relatorioFC');
            } else {
                $($('#example').DataTable().row.add(row).draw()
                    .node()).addClass('text-danger');
            }
        })
        data.total.liquido.map((row, index) => {
            if(index == 0){
                $($('#example').DataTable().row.add(row).draw()
                    .node()).addClass('relatorioFC');
            }
        })
    }


    function formatador(data) {
        columns = []
        data['header'].map(function(dat, key) {
            if (key == 0) {
                columns.push({
                    title: dat,
                    data: key,
                    width: "200px"
                })
            } else {
                columns.push({
                    title: dat,
                    data: key,
                    width: "150px"
                })
            }
        })


        $("#example").DataTable({
            "columns": columns,
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all",

            }],
            "paging": true,
            "lengthChange": false,
            "pageLength": 100,
            "searching": true,
            "ordering": false,
            "info": true,
            "scrollX": true,
            "language": {
                "emptyTable": "Nenhum registro disponível na tabela",
                "zeroRecords": "Nenhum registro encontrado",
                "info": " ",
                "infoEmpty": " ",
                "infoFiltered": " ",
                "search": "Procurar:",
                "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Depois"
                    },
            },
            "buttons": [{
              extend: 'copyHtml5',
              text: 'Copiar',

              exportOptions: {
                orthogonal: 'export',
                columns: function(column, data, node) {
                  if (column > 7) {
                    return false;
                  }
                  return true;
                },
              }
            }, "print", "csvHtml5", "excelHtml5", "pdfHtml5",{
              extend: 'collection',
              text: 'Mostrar Colunas',
              buttons: [ 'columnsVisibility' ],
              visibility: true
            }, ]
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        datase(data)
    }
    $(function() {
        $("button").click(async function(event) {
            event.preventDefault();
            const csrf = document.querySelector("#form").querySelectorAll('input[name ="_csrfToken"]')[0].value;
            $comeco = $("#0").val()
            $final = $("#1").val()
            $periodo = $(".periodo").val()
            try {
                const response = axios.post('/relatorios/dreAPI/', [$comeco, $final, $periodo], {
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
            const response = axios.get('/relatorios/dreAPI/').then(function(response) { // handle success
                formatador(response.data[1])
            })
        } catch (error) {
            console.error(error);
        }
    });
</script>

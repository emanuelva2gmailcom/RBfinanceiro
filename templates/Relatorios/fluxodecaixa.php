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

    .sorting_disabled {
        color: green;
    }

    td {}

    .dataTables_info {
        color: green;
    }

    .dataTables_empty {
        color: #17a2b8;
    }

    .dataTables_filter input:focus {
        color: #17a2b8;
        border: green solid 2px;

    }

    .dataTables_filter input {
        color: #17a2b8;
        border: green solid 2px;

    }

    .dataTables_filter label {
        color: #17a2b8;

    }

    .buttons-copy {
        background-color: #17a2b8;
        color: white;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-copy:hover {
        background-color: white;
        color: #17a2b8;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-print {
        background-color: #0099CC;
        color: white;
        border: 1px solid #0099CC;
        opacity: 0.7;
    }

    .buttons-print:hover {
        background-color: white;
        color: #0099CC;
        border: 1px solid #0099CC;
        opacity: 0.7;
    }

    .buttons-csv {
        background-color: green;
        color: white;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-csv:hover {
        background-color: white;
        color: green;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-excel {
        background-color: #006400;
        color: white;
        border: 1px solid #006400;
        opacity: 0.7;
    }

    .buttons-excel:hover {
        background-color: white;
        color: #006400;
        border: 1px solid #006400;
        opacity: 0.7;
    }

    .buttons-pdf {
        background-color: #4b4b4b;
        color: white;
        border: 1px solid #4b4b4b;
        opacity: 0.7;
    }

    .buttons-pdf:hover {
        background-color: white;
        color: #4b4b4b;
        border: 1px solid #4b4b4b;
        opacity: 0.7;
    }

    .buttons-collection {
        background-color: black;
        color: white;
        border: 1px solid black;
        opacity: 0.7;
    }

    .buttons-collection:hover {
        background-color: white;
        color: black;
        border: 1px solid black;
        opacity: 0.7;
    }

    .ts .btn {
        background-color: green;
        color: white;
        border: 1px solid green;
    }

    .ts .btn:hover {
        background-color: white;
        color: green;
        border: 1px solid green;
    }

    .ts .btn:focus {
        background-color: green;
        color: white;
        border: 1px solid green;
    }

</style>


<div class="card">
    <div class="card-header">
        <?= $this->Form->create([], ['id' => 'form', 'class' => 'row']) ?>
        <div class="col-md-3">
            <?= $this->Form->control(0, ['label' => 'Começo', 'type' => 'date'], ['class' => 'form-control text-white']); ?>
        </div>
        <div class="col-md-3">
            <?= $this->Form->control(1, ['label' => 'Final', 'type' => 'date'], ['class' => 'la form-control']); ?>
        </div>
        <div class="col-md-3">
            <label>Período</label>
            <?= $this->Form->select(2, ['mes' => 'MÊS', 'ano' => 'ANO', 'dia' => 'DIA'], ['class' => 'periodo form-control select2bs4']); ?>
        </div>
        <div class="col-md-3">
            <label>Enviar</label>
            <?= $this->Form->button(__('Enviar'), ['class' => 'form-control']) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <div class="card-2 card-body table-responsive">
        <table id="example" class="table table-sm table-bordered table-striped">
            <thead class="text-green">

            </thead>
            <tbody class="text-info">

            </tbody>
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
        $($('#example').DataTable().row.add(data.total.entradas).draw()
            .node()).addClass('bg-success');
        // response.push(data.total.entradas)
        data.rows.td.map(function(d) {
            if (data.rows.th['entradas'].includes(d[0])) {
                // response.push(d)
                $($('#example').DataTable().row.add(d).draw()
                    .node()).addClass('text-success');
            }
        })
        data.total.saidas.push(data.total.saidas[0])
        data.total.saidas[0] = 'Saidas'
        $($('#example').DataTable().row.add(data.total.saidas).draw()
            .node()).addClass('bg-danger');
        data.rows.td.map(function(d) {
            if (data.rows.th['saidas'].includes(d[0])) {
                $($('#example').DataTable().row.add(d).draw()
                    .node()).addClass('text-danger');
            }
        })
        data.total['entradas-saidas'].unshift('Entradas - Saídas')
        data.total.inicial.unshift('Saldo Inicial')
        data.total.final.unshift('Saldo Final')
        $($('#example').DataTable().row.add(data.total['entradas-saidas']).draw()
            .node()).addClass('bg-info');
        $($('#example').DataTable().row.add(data.total.inicial).draw()
            .node()).addClass('bg-info');
        $($('#example').DataTable().row.add(data.total.final).draw()
            .node()).addClass('bg-info');
    }


    function formatador(data) {
        data['header'].unshift('Index')
        data['header'].push('Total')
        columns = []
        //    inner = ''
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
            "searching": true,
            "ordering": false,
            "info": true,
            "scrollX": true,
            "language": {
                "emptyTable": "Nenhum registro disponível na tabela",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando _START_ de _END_ dos _TOTAL_ fluxos de caixas",
                "infoEmpty": "Mostrando 0 de 0 dos 0 fluxos de caixas",
                "infoFiltered": "(filtrado do total de _MAX_ fluxos de caixas)",
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

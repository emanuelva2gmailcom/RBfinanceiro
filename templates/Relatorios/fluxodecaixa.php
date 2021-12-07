<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore[]|\Cake\Collection\CollectionInterface $fornecedores
 */
?>

<div class="card cardRELATORIOS" id="teste">
    <div class="card-header">
        <?= $this->Form->create([], ['id' => 'form', 'class' => 'row']) ?>
        <div class="formgroupPAINEL col-md-3">
            <?= $this->Form->control(0, ['label' => 'Começo', 'type' => 'date'], ['class' => 'form-control']); ?>
        </div>
        <div class="formgroupPAINEL col-md-3">
            <?= $this->Form->control(1, ['label' => 'Final', 'type' => 'date'], ['class' => 'form-control']); ?>
        </div>
        <div class="formgroupPAINEL col-md-3">
            <label>Período</label>
            <?= $this->Form->select(2, ['mes' => 'MÊS', 'ano' => 'ANO', 'dia' => 'DIA'], ['class' => 'periodo form-control select2bs4']); ?>
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

    function datase(data) {
        response = []
        data.total['entradas'].unshift('Entradas:')
        $($('#example').DataTable().row.add(data.total.entradas).draw()
            .node()).addClass('relatorioFC');
        data.rows.td.map(function(d) {
            if (data.rows.th['entradas'].includes(d[0])) {
                $($('#example').DataTable().row.add(d).draw()
                    .node()).addClass('text-success');
            }
        })
        data.total['saidas'].unshift('Saidas:')
        $($('#example').DataTable().row.add(data.total.saidas).draw()
            .node()).addClass('relatorioFC');
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
            .node()).addClass('relatorioFC');
        $($('#example').DataTable().row.add(data.total.inicial).draw()
            .node()).addClass('relatorioFC');
        $($('#example').DataTable().row.add(data.total.final).draw()
            .node()).addClass('relatorioFC');
    }


    function formatador(data) {
        data['header'].unshift('Index')
        data['header'].push('Total')
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
                    "previous": "Anterior"
                },
            },
            "buttons": [{
              extend: 'copyHtml5',
              text: 'Copiar',

              exportOptions: {
                orthogonal: 'export',
                columns: function(column, data, node) {
                //   if (column > 7) {
                //     return false;
                //   }
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
                const response = axios.post('/relatorios/getFluxoDeCaixa/', [$comeco, $final, $periodo], {
                    headers: {
                        "X-CSRF-Token": csrf
                    }
                }).then(function(response) { // handle success
                    console.log(response.data)
                    // document.getElementById('teste').innerHTML = response.data
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
                // console.log(response.data)
                formatador(response.data[1])
            })
        } catch (error) {
            console.error(error);
        }

    });
</script>


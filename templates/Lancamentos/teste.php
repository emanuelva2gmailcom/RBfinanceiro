
<!-- link -->
<?php
echo $this->Html->link(
    "Del",
    "#",
    array("class"=>"btn btn-danger delete-btn btn-flat btn-sm", "data-id"=>$post->id)
);
?>

<!--Modal  -->
<a data-target="#ConfirmDelete" role="button" data-toggle="modal" id="trigger"></a>
<div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Deletar Notícia</h4>
            </div>
            <div class="modal-body">
                Deseja realmente apagar este registro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left btn-lg" data-dismiss="modal">Cancelar</button>
                <div id="ajax_button"></div>
            </div>
        </div>
    </div>
</div>

<!--Js  -->
<script type="text/javascript">
    $(".delete-btn").click(function(){
        $("#ajax_button").html("<a href='/admin/posts/delete/"+ $(this).attr("data-id")+"' class='btn btn-danger btn-flat btn-lg'>Confirmar</a>");
        $("#trigger").click();
    });
</script>
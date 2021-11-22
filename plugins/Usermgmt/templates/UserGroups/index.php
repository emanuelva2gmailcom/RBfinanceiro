<div class="cardPAINEL card mt-2">
	<div class="cardheaderDASH card-header">
		<span class="text-white card-title">
			<?php echo __('Todos os Grupos do Usuário');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Adicionar Grupo do Usuário', true), ['action'=>'add'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>
	</div>

	<div class="cardbodyDASH2 card-body p-0">
		<?php echo $this->element('Usermgmt.all_user_groups');?>
	</div>
</div>

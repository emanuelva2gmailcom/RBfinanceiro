<div class="cardPAINEl card mt-2">
	<div class="cardheaderDASH card-header">
		<span class="text-white card-title">
			<?php echo __('E-mails agendados');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('E-mail agendado', true), ['controller'=>'UserEmails', 'action'=>'send'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>

		<span class="card-title float-right mr-2">
			<?php echo $this->Html->link(__('E-mails enviados', true), ['controller'=>'UserEmails', 'action'=>'index'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>
	</div>

	<div class="cardbodyDASH2 card-body p-0">
		<?php echo $this->element('Usermgmt.all_scheduled_emails');?>
	</div>
</div>
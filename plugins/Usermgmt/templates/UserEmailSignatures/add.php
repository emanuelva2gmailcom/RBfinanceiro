<div class="cardPAINEL card mt-2">
	<div class="cardheaderDASH card-header">
		<span class="text-white card-title">
			<?php echo __('Adicionar Assinatura');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Voltar', true), ['action'=>'index'], ['class'=>'btn cancelarADD btn-sm']);?>
		</span>
	</div>

	<div class="cardbodyDASH card-body">
		<?php echo $this->element('Usermgmt.ajax_validation', ['formId'=>'addSignatureForm', 'submitButtonId'=>'addSignatureSubmitBtn']);?>
		<?php echo $this->Form->create($userEmailSignatureEntity, ['id'=>'addSignatureForm']);?>

		<div class="row form-group">
			<label class="col-md-2 col-form-label required"><?php echo __('Signature Name');?></label>
			<div class="col-md-6">
				<?php echo $this->Form->control('UserEmailSignatures.signature_name', ['type'=>'text', 'label'=>false, 'class'=>'form-control']);?>
			</div>
		</div>

		<div class="row form-group">
			<label class="col-md-2 col-form-label"><?php echo __('Email Signature');?></label>
			<div class="col-md-6">
				<?php
				if(strtoupper(DEFAULT_HTML_EDITOR) == 'TINYMCE') {
					echo $this->Tinymce->textarea('UserEmailSignatures.signature', ['type'=>'textarea', 'label'=>false, 'class'=>'form-control'], ['skin'=>'oxide'], 'full');
				}
				else if(strtoupper(DEFAULT_HTML_EDITOR) == 'CKEDITOR') {
					echo $this->Ckeditor->textarea('UserEmailSignatures.signature', ['type'=>'textarea', 'label'=>false, 'class'=>'form-control'], [], 'full');
				}?>
			</div>
		</div>

		<div class="row form-group border-top pt-3">
			<div class="col">
				<?php echo $this->Form->Submit(__('Adicionar Assinatura'), ['class'=>'btn btnADD', 'id'=>'addSignatureSubmitBtn']);?>
			</div>
		</div>

		<?php echo $this->Form->end();?>
	</div>
</div>
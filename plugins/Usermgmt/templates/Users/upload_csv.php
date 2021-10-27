<div class="card">
	<div class="card-header text-white bg-dark">
		<span class="card-title">
			<?php echo __('Adicionar Vários Usuários');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Voltar', true), ['action'=>'index'], ['class'=>'btn btn-secondary btn-sm']);?>
		</span>
	</div>

	<div class="card-body">
		<?php echo $this->Form->create(null, ['novalidate'=>true, 'type'=>'file']);?>

		<div class="form-row align-items-center">
			<div class="col-auto">
				<label class="col-form-label required"><?php echo __('Selecione o arquivo csv');?></label>
			</div>

			<div class="col-auto">
				<?php echo $this->Form->control('csv_file', ['type'=>'file', 'label'=>false, 'style'=>'width:auto;display:inline']);?>
			</div>

			<div class="col-auto">
				<?php echo $this->Form->Submit(__('Envio'), ['class'=>'btn btn-primary btn-sm', 'style'=>'margin-bottom:0']);?>
			</div>
		</div>

		<?php echo $this->Form->end();?>

		<hr/>

		<div>
			<strong style="margin-left:5px;"><?php echo __('Instructions for CSV file');?></strong>
			<br/><br/>

			<ol>
				<li><?php echo __(' primeira linha deve ser o nome dos campos da tabela');?></li>

				<li><?php echo __('Você pode adicionar um ou mais usuários');?></li>

				<li><?php echo __('Deixe em branco para valores vazios');?></li>

				<li>
					<?php echo __('Para o ID do grupo de usuários, o valor do campo deve ser o seguinte');?>
					<?php foreach($userGroups as $key=>$val) {
						echo "<br/><strong>Para o conjunto de ".$val."  ".$key."</strong>";
					}?>
				</li>

				<li><?php echo __('Para vários grupos, defina os ids dos grupos separados por vírgulas, sem espaço para, por exemplo, 1,2');?></li>

				<li>
					<?php echo __('Para gênero, o valor do campo deve estar no seguinte:');?>
					<?php foreach($genders as $key=>$val) {
						echo "<br/><strong>".$key."</strong>";
					}?>
				</li>

				<li><?php echo __('Para aniversário, o formato da data deve ser o formato Ymd, por exemplo, 25/01/1999');?></li>

				<li><a href="<?php echo SITE_URL;?>usermgmt/files/sample_multiple_users.csv" target="_blank"><?php echo __('Exemplo de arquivo CSV');?></a> <?php echo __('para vários usuários');?></li>
			</ol>
		</div>
	</div>
</div>
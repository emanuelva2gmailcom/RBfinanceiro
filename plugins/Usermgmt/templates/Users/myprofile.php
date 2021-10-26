<div class="card">
	<div class="card-header text-white bg-dark">
		<span class="card-title">
			<?php echo __('Meu Perfil');?>
		</span>

		<span class="card-title float-right">
			<?php echo $this->Html->link(__('Editar', true), ['action'=>'editProfile'], ['class'=>'btn btn-secondary btn-sm']);?>
		</span>
	</div>

	<div class="card-body">
		<div class="d-inline-block">
			<table class="table-sm" style="width:auto">
				<tbody>
					<tr>
						<td>
							<div class="profile">
								<img alt="<?php echo $user['first_name'].' '.$user['last_name'];?>" src="<?php echo $this->Image->resize('library/'.IMG_DIR, $user['photo'], ['width'=>200, 'aspect'=>true]);?>">
							</div>
						</td>
						<td><h1><?php echo $user['first_name'].' '.$user['last_name'];?></h1></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('Groupo(s)');?>:</strong></td>
						<td><?php echo $user['user_group_name'];?></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('Nome de Usuário');?>:</strong></td>
						<td><?php echo $user['username'];?></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('E-mail');?>:</strong></td>
						<td><?php echo $user['email'];?></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('Gênero');?>:</strong></td>
						<td><?php echo ucwords($user['gender']);?></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('Aniversário');?>:</strong></td>
						<td><?php echo $this->UserAuth->getFormatDate($user['bday']);?></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('Celular');?>:</strong></td>
						<td><?php echo $user['user_detail']['cellphone'];?></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('Localização');?>:</strong></td>
						<td><?php echo $user['user_detail']['location'];?></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('Status');?>:</strong></td>
						<td><?php echo ($user['is_active']) ? __('Active') : __('Inactive');?></td>
					</tr>

					<tr>
						<td class="text-right"><strong><?php echo __('Ingressou');?></strong></td>
						<td><?php echo $this->UserAuth->getFormatDate($user['created']);?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<style type="text/css">
	.profile img {
		border:1px solid #DFDCDC;
		display:block;
		margin:0;
		padding:5px;
		width:100%;
		max-width:200px;
	}
</style>
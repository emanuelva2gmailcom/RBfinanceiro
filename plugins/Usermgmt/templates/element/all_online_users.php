<div id="updateOnlineIndex">
	<?php echo $this->Search->searchForm('UserActivities', ['legend'=>false, 'updateDivId'=>'updateOnlineIndex']);?>
	<?php echo $this->element('Usermgmt.paginator', ['useAjax'=>true, 'updateDivId'=>'updateOnlineIndex']);?>

	<div class="table-responsive">
		<table class="table table-striped table-bordered table-sm table-hover">
			<thead>
				<tr>
					<th><?php echo __('#');?></th>

					<th><?php echo __('Name');?></th>

					<th><?php echo __('Email');?></th>

					<th><?php echo __('Last URL');?></th>

					<th><?php echo __('Browser');?></th>

					<th><?php echo __('Ip Address');?></th>

					<th><?php echo __('Last Action');?></th>

					<th><?php echo __('Action');?></th>
				</tr>
			</thead>

			<tbody>
				<?php
				if(!empty($users)) {
					$i = $this->UserAuth->getPageStart();

					foreach($users as $row) {
						$i++;

						echo "<tr>";
							echo "<td>".$i."</td>";

							echo "<td>";
								if(empty($row['user_id'])) {
									echo 'Guest';
								} else {
									echo $row['user']['first_name'].' '.$row['user']['last_name'];
								}
							echo "</td>";

							echo "<td>".$row['user']['email']."</td>";

							echo "<td>".$row['last_url']."</td>";

							echo "<td>".$row['user_browser']."</td>";

							echo "<td>".$row['ip_address']."</td>";

							echo "<td>".$this->Time->timeAgoInWords($row['last_action'])."</td>";

							echo "<td>";
								if(!empty($row['user_id']) && $row['user_id'] != 1) {
									echo "<div class='dropdown'>";
										echo "<button class='btn btn-dark btn-sm dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".__('Action')."</button>";

										echo "<div class='dropdown-menu dropdown-menu-right'>";
											echo $this->Form->postLink(__('Sign Out'), ['controller'=>'Users', 'action'=>'logoutUser', $row['user_id'], '?'=>['page'=>$this->UserAuth->getPageNumber()]], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('Are you sure you want to sign out this user?')]);

											echo $this->Form->postLink(__('Inactivate'), ['controller'=>'Users', 'action'=>'setInactive', $row['user_id'], '?'=>['page'=>$this->UserAuth->getPageNumber(), 'return'=>'online_users']], ['escape'=>false, 'class'=>'dropdown-item', 'confirm'=>__('This user will be signed out and will not be able to login again')]);
										echo "</div>";
									echo "</div>";
								}
							echo "</td>";
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan=8><br/>".__('No Records Available')."</td></tr>";
				}?>
			</tbody>
		</table>
	</div>

	<?php
	if(!empty($users)) {
		echo $this->element('Usermgmt.pagination', ['paginationText'=>__('Number of Online Users')]);
	}?>
</div>

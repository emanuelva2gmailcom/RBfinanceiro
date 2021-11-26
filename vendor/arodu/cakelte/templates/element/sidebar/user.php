<?php
  $user2 = $this->UserAuth->getUser();
  $username = $user2['User']['username'];
  $photo = $user2['User']['photo'];
?>

<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
     <img src="<?php echo $this->Image->resize('library/'.IMG_DIR, $photo, ['class'=>'img-circle elevation-2', 'alt'=>'User Image']);?>">
  </div>
  <div class="info">
    <?= $this->Html->link(__($username), ['controller'=>'Users', 'action'=>'myprofile', 'plugin'=>'Usermgmt'], ['class'=>'d-block']); ?>
  </div>
</div>

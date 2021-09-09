<?php 
  $user2 = $this->UserAuth->getUser();
  $username = $user2['User']['username'];
  $photo = $user2['User']['photo'];
?>
<div class="user-panel mt-3 pb-3 mb-3 d-flex" style="overflow: auto;">
  <div class="image">
    <img src="<?php echo $this->Image->resize('library/'.IMG_DIR, $photo, ['class'=>'img-circle elevation-2', 'alt'=>'User Image']);?>">
  </div>
  <div class="info">
    <a href="#" class="d-block"><?= $username ?></a>
  </div>
</div>

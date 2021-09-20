<?php
  $breadcrumb = empty($breadcrumb) ? [] : $breadcrumb;

  if(!empty($home) && $home==true){
    $breadcrumb = array_merge(['Home'=>'/'], $breadcrumb);
  }
?>

<ol class="breadcrumb float-sm-right">
  <?php
    foreach ($breadcrumb as $key => $value) {
      if(is_numeric($key)){
        echo '<li class="breadcrumb-item active" style="color: #E1E7E0;">'.$value.'</li>';
      }else{
        echo '<li class="breadcrumb-item" style="color: #E1E7E0;">'.$this->Html->link($key, $value, ['escape'=>false]).'</li>';
      }
    }
  ?>
</ol>

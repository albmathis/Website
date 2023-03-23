<?php

$dir = '../mathis_albert_website'; 
$files = array_slice(scandir($dir), 2);

function buildTree($files) {
  echo '<ul>';
  foreach($files as $file) {
    echo '<li>';
    if(is_dir($file)) {
      echo $file;
      buildTree(array_slice(scandir($file), 2));
    }
    else {
      echo '<a href="'.$file.'">'.$file.'</a>';
    }
    echo '</li>';
  }
  echo '</ul>';
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Mapa Web</title>
</head>
<body>
  <div id="tree">
    <?php buildTree($files); ?>
  </div>
</body>
</html>
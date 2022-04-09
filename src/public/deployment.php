<?php

$commands = [
  'echo $PWD',
  'whoami',
  'git pull',
  'git status',
  'git submodule sync',
  'git submodule update',
  'git submodule status'
];
$output = '';

foreach ($commands as $command) {
  $tmp = shell_exec($command);
  $output .="<span style='color: #6BE234'></span><span style='color: #729FCF'>{$command}\n</span><br />";
  $output .= htmlentities(trim($tmp))."\n<br \><br \>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Deployment</title>
</head>
<body style="background-color: #000000; color:#FFFFFF;font-weight: bold; padding:0 10px">
  <div style="width: 700px;">
    <div style="float: left;width:350px">
      <p style="color: white;">Deployment script</p>
      <?= $output ?>
    </div>
  </div>
</body>
</html>
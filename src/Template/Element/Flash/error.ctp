<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}

echo $this->Html->alert($message, 'danger') ;
?>
<!--<div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div>-->


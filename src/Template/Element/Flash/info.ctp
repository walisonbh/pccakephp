<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}

echo $this->Html->alert($message, 'info') ;
?>
<!--<div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div>-->

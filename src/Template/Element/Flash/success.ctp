<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}

echo $this->Html->alert($message, 'success');
?>
<!--<div class="message success" onclick="this.classList.add('hidden')"><?= $message ?></div>-->

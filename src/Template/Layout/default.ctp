<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
	<head>
		<?= $this->Html->charset() ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>
			<?= $cakeDescription ?>:
			<?= $this->fetch('title') ?>
		</title>
		<?= $this->Html->meta('icon') ?>
		
		<?= $this->Html->css('cake') ?>

		<?php
		echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
		echo $this->Html->script([
			'https://code.jquery.com/jquery-1.12.4.min.js',
			'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'
		]);
		?>

		<?= $this->fetch('meta') ?>
		<?= $this->fetch('css') ?>
		<?= $this->fetch('script') ?>
	</head>
	<body>
		<nav class="row title-area" data-topbar role="navigation">
			<div class="col-lg-6">
				<h1><?php echo $this->Html->link($this->fetch('title'), ['action' => 'index']) ?></a></h1>
			</div>
			<div id="cake-links" class="col-lg-6">
				<ul class="right">
					<li><a target="_blank" href="http://book.cakephp.org/3.0/">Documentation</a></li>
					<li><a target="_blank" href="http://api.cakephp.org/3.0/">API</a></li>
				</ul>
			</div>
		</nav>
		<?= $this->Flash->render() ?>
		<div class="container clearfix">
			<?= $this->fetch('content') ?>
		</div>
		<footer>
		</footer>
	</body>
</html>

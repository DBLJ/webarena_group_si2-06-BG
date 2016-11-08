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

    <?= $this->Html->css('webarena.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
    <nav class="top-bar">
        <ul class="menu">
            <li class="name">
                <?php echo $this->Html->link('Acceuil', array('controller' => 'Arena', 'action' => '/')); ?>
            </li>
            <li>
             <?php echo $this->Html->link('Vision', array('controller' => 'Arena', 'action' => 'sight')); ?>            
            </li>
            <li>
             <?php echo $this->Html->link('combattant', array('controller' => 'Arena', 'action' => 'fighter')); ?>            
            </li>
            <li>
             <?php echo $this->Html->link('en attente', array('controller' => 'Arena', 'action' => 'sight')); ?>            
            </li>
            <li>
             <?php echo $this->Html->link('en attente', array('controller' => 'Arena', 'action' => 'sight')); ?>
            </li>
        </ul>
    </nav>
    <nav class="login">

    </nav>
    <div class="login_menu">
        
    </div>
    </header>

    <?= $this->Flash->render() ?>
    <div class="container">
        <?= $this->fetch('content') ?>
    </div>
    <footer class="bottom-bar">
    <p> mon nom mes camarades SI2</p>
    </footer>
</body>
</html>

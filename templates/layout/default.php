<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Salary Payments</title>

    <?php echo $this->Html->meta('icon'); ?>

    <?php echo $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']); ?>

    <?php echo $this->fetch('meta'); ?>
    <?php echo $this->fetch('css'); ?>
    <?php echo $this->fetch('script'); ?>
</head>

<body>
    <main class="main">
        <div class="container">
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </main>
</body>
</html>
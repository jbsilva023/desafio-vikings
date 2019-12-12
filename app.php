<?php
$app = new JbSilva\App;
$app->setRenderer(new JbSilva\Rederer\PHPRenderer);

require __DIR__ . '/router.php';

$app->run();





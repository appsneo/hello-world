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

?>

<!DOCTYPE html>

<html lang="ja">
<head>
  <?= $this->Html->charset() ?>
  <meta http-equiv="Pragma" content="no-cache" />
  <meta http-equiv="cache-control" content="no-store" />
  <meta http-equiv="expires" content="0"/>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />
  <meta name="keywords" content="業務管理システム," />
  <meta name="author" content="業務管理システム" />
  <title>
    <?= $this->fetch('title') ?>
  </title>
  <?= $this->Html->meta('icon') ?>
  <?= $this->fetch('meta') ?>

  <link rel="stylesheet" href="/css/reset.css">

  <link rel="stylesheet" href="/css/style.css">

  <link rel="stylesheet" href="/css/sp-slidemenu.css" />

  <link rel="stylesheet" href="/css/jquery-ui-1.10.4.custom.css" />

  <?= $this->fetch('css') ?>

  <script src="/js/jquery1.9.1.js"></script>
  <script src="/js/jquery-migrate-1.2.1.js"></script>

  <?= $this->fetch('script') ?>

  <!--[if lt IE 9]>
  <script src="js/html5.js" type="text/javascript"></script>
  <script src="js/selectivizr-min.js" type="text/javascript"></script>
  <![endif]-->


</head>

<body>
  <?= $this->element('header') ?>

  <div class="container clearfix">
    <?= $this->fetch('content') ?>
  </div>
  <footer>
  </footer>
</body>
</html>

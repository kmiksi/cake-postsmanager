<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html class="bg-teal-gradient">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        echo $this->Html->meta('icon');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        $BASE_URL = rtrim(Router::url('/'), '/');
        echo "<script type='text/javascript'>var BASE_URL='$BASE_URL';</script>";

        echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
        echo $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css');
        echo $this->Html->css('/adminlte/css/AdminLTE.css');
        ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="background-color: transparent">
        
        <div class="form-box" id="login-box">
            <?php
            $flash = $this->Session->flash();
            if (!empty($flash)) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $flash; ?>
                </div>
                <?php
            }
            ?>
            <?php echo $this->fetch('content'); ?>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>

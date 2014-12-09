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

$avatar = $avatars[AuthComponent::user('id') % (count($avatars) - 1)];
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $cakeDescription ?>:
            <?php echo $title_for_layout; ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        //echo $this->Html->css('cake.generic');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        $BASE_URL = rtrim(Router::url('/'), '/');
        echo "<script type='text/javascript'>var BASE_URL='$BASE_URL';</script>";
        ?>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
        echo $this->Html->css('//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css');
        echo $this->Html->css('//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css');
        echo $this->Html->css('/adminlte/css/AdminLTE.css');
        // bootstrap wysihtml5 - text editor
        echo $this->Html->css('/adminlte/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');
        ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo $BASE_URL; ?>/" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                CakePHP Test
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"><?php echo __('Toggle navigation'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="user user-menu">
                            <a href="<?php echo Router::url('/posts/add'); ?>">
                                <i class="fa fa-plus"></i>
                                <?php echo __('Add Post'); ?>
                            </a>
                        </li>
                        <li class="user user-menu">
                            <a href="<?php echo Router::url('/posts'); ?>">
                                <i class="glyphicon glyphicon-list"></i>
                                <?php echo __('All Posts'); ?>
                            </a>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-users"></i>
                                <?php echo __('Users'); ?>
                                <i class="caret"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="slimScrollDiv" style="position: relative; overflow: hidden;">
                                        <ul class="menu" style="overflow: hidden;">
                                            <li>
                                                <a href="<?php echo Router::url('/users'); ?>">
                                                    <i class="glyphicon glyphicon-list success"></i>
                                                    <?php echo __('All users'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Router::url('/users/register'); ?>">
                                                    <i class="fa fa-plus warning"></i>
                                                    <?php echo __('Add user'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Router::url('/users/profile'); ?>">
                                                    <i class="fa fa-user info"></i>
                                                    <?php echo __('Edit your profile'); ?>
                                                </a>
                                            </li>
                                            <?php
                                            if ((int) AuthComponent::user('level') === $ADMIN_LEVEL) {
                                                ?>
                                                <li>
                                                    <a href="<?php echo Router::url('/users/config'); ?>">
                                                        <i class="glyphicon glyphicon-cog danger    "></i>
                                                        <?php echo __('Configurations'); ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo AuthComponent::user('username'); ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $BASE_URL; ?>/adminlte/img/<?php echo $avatar; ?>.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo AuthComponent::user('name'); ?>
                                        <small><?php echo __('Member since Dec. 2014'); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body-->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-flag"></i>
                                        <a href="<?php echo Router::url('/app/lang/eng') ?>">English</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-flag-checkered"></i>
                                        <a href="<?php echo Router::url('/app/lang/por') ?>">Português</a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo Router::url("/users/profile"); ?>" class="btn btn-default btn-flat"><?php echo __('Profile'); ?></a>
                                    </div>
                                    <div class="pull-left">
                                        <a href="<?php echo Router::url("/users/register"); ?>" class="btn btn-default btn-flat"><?php echo __('Add User'); ?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo Router::url("/users/logout"); ?>" class="btn btn-default btn-flat"><?php echo __('Sign out'); ?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $BASE_URL; ?>/adminlte/img/<?php echo $avatar; ?>.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo __('Hello, %s', AuthComponent::user('name')); ?></p>

                            <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> <?php echo __('Online'); ?></a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="<?php echo Router::url('/posts') ?>" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="<?php echo __('Search posts...'); ?>"/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="<?php echo Router::url('/'); ?>">
                                <i class="fa fa-home"></i> <span><?php echo __('Home'); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url('/pages/dashboard'); ?>">
                                <i class="fa fa-dashboard"></i> <span><?php echo __('Dashboard'); ?></span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i>
                                <span><?php echo __('Posts'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Router::url('/posts'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo __('All Posts'); ?></a></li>
                                <li><a href="<?php echo Router::url('/posts/add'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo __('Add Post'); ?></a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span><?php echo __('Users'); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Router::url('/users'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo __('All users'); ?></a></li>
                                <li><a href="<?php echo Router::url('/users/add'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo __('Add user'); ?></a></li>
                                <li><a href="<?php echo Router::url('/users/profile'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo __('Edit your profile'); ?></a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo ucfirst(@$page); ?>
                        <small><?php echo ucfirst($title_for_layout); ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo Router::url('/' . strtolower(@$subpage)); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
                        <li><a href="<?php echo Router::url(array('action' => 'index')); ?>"><?php echo @$subpage; ?></a></li>
                        <li class="active"><?php echo @$page; ?></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="box-body pad">
                                <?php
                                $flash = $this->Session->flash();
                                if (!empty($flash)) {
                                    $message = explode(':', strip_tags($flash), 2);
                                    switch (trim($message[0])) {
                                        case __('Success'):
                                        case __('Info'):
                                        case __('Note'):
                                            ?>
                                            <div class="alert alert-success alert-dismissable">
                                                <i class="fa fa-check"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?php echo '<b>' . $message[0] . '</b>:' . $message[1]; ?>
                                            </div>
                                            <?php
                                            break;
                                        case trim(strip_tags($flash)):
                                            ?>
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-warning"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?php echo $flash; ?>
                                            </div>
                                            <?php
                                            break;
                                        default:
                                            ?>
                                            <div class="alert alert-danger alert-dismissable">
                                                <i class="fa fa-warning"></i>
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <?php echo '<b>' . $message[0] . '</b>:' . $message[1]; ?>
                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php echo $this->fetch('content'); ?>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo $BASE_URL; ?>/adminlte/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo $BASE_URL; ?>/adminlte/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                //bootstrap WYSIHTML5 - text editor
                $("textarea.bootstrap-wysihtml5").wysihtml5();
            });
        </script>
    </body>
</html>

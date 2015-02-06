<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if (Configure::read('debug') == 0):
    throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>

<h4 class="page-header">
    CakePHP
    <small>Using "TurnKey CakePHP" as development environment and "AdminLTE" as front-end framework.</small>
</h4>

<div class="row">
    <div class="col-md-4">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">References</h3>
            </div>
            <div class="box-body">
                <ul>
                    <li><a href="http://www.cakefoundation.org">
                            Cake Software Foundation</a></li>
                    <li>
                        <a href="http://www.cakephp.org">
                            CakePHP website</a>,
                        <a href="http://book.cakephp.org">
                            documentation</a> and
                        <a href="http://api20.cakephp.org">
                            API</a>
                    </li>
                    <li><a href="http://book.cakephp.org/2.0/en/tutorials-and-examples/blog/blog.html">
                            CakePHP 15 minute blog tutorial</a></li>
                    <li><a href="http://www.turnkeylinux.org/cakephp">
                            TurnKey CakePHP release notes</a></li>
                </ul>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-4">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">About</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <h3>Routing configuration</h3>
                <pre>/var/www/cakephp/app/Config/routes.php</pre>

                <h3>View Layout</h3>
                <pre>/var/www/cakephp/app/View/Layouts/default.ctp</pre>

                <h3>View Page</h3>
                <pre>/var/www/cakephp/app/View/Pages/home.ctp</pre>

                <h3>Webroot (css, js, images)</h3>
                <pre>/var/www/cakephp/app/webroot/</pre>

                <br/>
                <h3>And the cherry: MySQL preconfigured to get you started</h3>
                <pre>/var/www/cakephp/app/Config/database.php</pre>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-4">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Validations</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php
                if (Configure::read('debug') > 0):
                    Debugger::checkSecurityKeys();
                endif;
                ?>
                <p id="url-rewriting-warning" style="background-color:#e32; color:#fff; display:none">
                    <?php echo __d('cake_dev', 'URL rewriting is not properly configured on your server.'); ?><br/>
                    <a target="_blank" href="http://book.cakephp.org/2.0/en/installation/advanced-installation.html#apache-and-mod-rewrite-and-htaccess" style="color:#fff;" class="btn btn-danger">Help me configure it</a>
                    <a target="_blank" href="http://book.cakephp.org/2.0/en/development/configuration.html#cakephp-core-configuration" style="color:#fff;" class="btn btn-danger">I don't / can't use URL rewriting</a>
                </p>
                <p>
                    <?php
                    if (version_compare(PHP_VERSION, '5.2.8', '>=')):
                        echo '<span class="notice success">';
                        echo __d('cake_dev', 'Your version of PHP is 5.2.8 or higher.');
                        echo '</span>';
                    else:
                        echo '<span class="notice">';
                        echo __d('cake_dev', 'Your version of PHP is too low. You need PHP 5.2.8 or higher to use CakePHP.');
                        echo '</span>';
                    endif;
                    ?>
                </p>
                <p>
                    <?php
                    if (is_writable(TMP)):
                        echo '<span class="notice success">';
                        echo __d('cake_dev', 'Your tmp directory is writable.');
                        echo '</span>';
                    else:
                        echo '<span class="notice">';
                        echo __d('cake_dev', 'Your tmp directory is NOT writable.');
                        echo '</span>';
                    endif;
                    ?>
                </p>
                <p>
                    <?php
                    $settings = Cache::settings();
                    if (!empty($settings)):
                        echo '<span class="notice success">';
                        echo __d('cake_dev', 'The %s is being used for core caching. To change the config edit APP/Config/core.php ', '<em>' . $settings['engine'] . 'Engine</em>');
                        echo '</span>';
                    else:
                        echo '<span class="notice">';
                        echo __d('cake_dev', 'Your cache is NOT working. Please check the settings in APP/Config/core.php');
                        echo '</span>';
                    endif;
                    ?>
                </p>
                <p>
                    <?php
                    $filePresent = null;
                    if (file_exists(APP . 'Config' . DS . 'database.php')):
                        echo '<span class="notice success">';
                        echo __d('cake_dev', 'Your database configuration file is present.');
                        $filePresent = true;
                        echo '</span>';
                    else:
                        echo '<span class="notice">';
                        echo __d('cake_dev', 'Your database configuration file is NOT present.');
                        echo '<br/>';
                        echo __d('cake_dev', 'Rename APP/Config/database.php.default to APP/Config/database.php');
                        echo '</span>';
                    endif;
                    ?>
                </p>
                <?php
                if (isset($filePresent)):
                    App::uses('ConnectionManager', 'Model');
                    try {
                        $connected = ConnectionManager::getDataSource('default');
                    } catch (Exception $connectionError) {
                        $connected = false;
                    }
                    ?>
                    <p>
                        <?php
                        if ($connected && $connected->isConnected()):
                            echo '<span class="notice success">';
                            echo __d('cake_dev', 'Cake is able to connect to the database.');
                            echo '</span>';
                        else:
                            echo '<span class="notice">';
                            echo __d('cake_dev', 'Cake is NOT able to connect to the database.');
                            echo '<br /><br />';
                            echo $connectionError->getMessage();
                            echo '</span>';
                        endif;
                        ?>
                    </p>
                <?php endif; ?>
                <?php
                App::uses('Validation', 'Utility');
                if (!Validation::alphaNumeric('cakephp')) {
                    echo '<p><span class="notice">';
                    echo __d('cake_dev', 'PCRE has not been compiled with Unicode support.');
                    echo '<br/>';
                    echo __d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
                    echo '</span></p>';
                }
                ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->

</div>

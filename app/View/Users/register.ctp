
<?php if (!empty($page)) { ?>
    <div class="header"><?php echo $page; ?></div>
<?php } else { ?>
    <div class="header"><?php echo $hasUsers ? __("Register New Membership") : __("Register Admin User"); ?></div>
<?php } ?>
<form action="" method="post">
    <div class="body bg-gray">
        <?php if ($hasUsers) { ?>
            <div class="form-group btn-group" data-toogle="buttons">
                <label class="btn btn-default">
                    <input type="radio" name="level" value="1" checked="checked">
                    <?php echo __('Admin'); ?>
                </label>
                <label class="btn btn-default">
                    <input type="radio" name="level" value="2">
                    <?php echo __('User'); ?>
                </label>
            </div>
        <?php } ?>
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="<?php echo __('Full name'); ?>"/>
        </div>
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="<?php echo __('Username'); ?>"/>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="<?php echo __('Password'); ?>"/>
        </div>
        <div class="form-group">
            <input type="password" name="password2" class="form-control" placeholder="<?php echo __('Retype password'); ?>"/>
        </div>
    </div>
    <div class="footer">                    

        <button type="submit" class="btn bg-olive btn-block"><?php echo $hasUsers ? __("Add User") : __("Sign me up"); ?></button>

        <?php if ($hasUsers) { ?>
            <p><a href="<?php echo Router::url('/') ?>" class="text-center btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo __('Go to home'); ?></a></p>
        <?php } ?>
    </div>
</form>

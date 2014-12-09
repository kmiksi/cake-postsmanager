
<div class="header"><?php echo $page; ?></div>
<form action="" method="post">
    <div class="body bg-gray">
        <div class="form-group btn-group" data-toogle="buttons">
            <label class="btn btn-default disabled">
                <input type="radio" name="level" value="1" <?php echo $user['User']['level'] == 1 ? 'checked="checked"' : ''; ?> disabled="disabled"/>
                <?php echo __('Admin'); ?>
            </label>
            <label class="btn btn-default disabled">
                <input type="radio" name="level" value="2" <?php echo $user['User']['level'] != 1 ? 'checked="checked"' : ''; ?> disabled="disabled"/>
                <?php echo __('User'); ?>
            </label>
        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $user['User']['id']; ?>"/>
            <input type="text" name="name" class="form-control" placeholder="<?php echo __('Full name'); ?>" value="<?php echo $user['User']['name']; ?>"/>
        </div>
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="<?php echo __('Username'); ?>" value="<?php echo $user['User']['username']; ?>" disabled="disabled"/>
        </div>
        <!--<div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Current password" value=""/>
        </div>-->
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="<?php echo __('New password'); ?>" value=""/>
        </div>
        <div class="form-group">
            <input type="password" name="password2" class="form-control" placeholder="<?php echo __('Retype new password'); ?>" value=""/>
        </div>
    </div>
    <div class="footer">                    

        <button type="submit" class="btn bg-olive btn-block"><?php echo __('Save'); ?></button>

        <?php if ($hasUsers) { ?>
            <p><a href="<?php echo Router::url('/') ?>" class="text-center btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo __('Go to home'); ?></a></p>
        <?php } ?>
    </div>
</form>

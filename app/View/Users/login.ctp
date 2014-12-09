
<div class="header"><?php echo __('Sign In'); ?></div>
<form action="" method="post">
    <div class="body bg-gray">
        <div class="form-group">
            <input type="text" name="User[username]" class="form-control" placeholder="<?php echo __('Username'); ?>"/>
        </div>
        <div class="form-group">
            <input type="password" name="User[password]" class="form-control" placeholder="<?php echo __('Password'); ?>"/>
        </div>          
        <div class="form-group">
            <input type="checkbox" name="remember_me"/> <?php echo __('Remember me'); ?>
        </div>
    </div>
    <div class="footer">                                                               
        <button type="submit" class="btn bg-olive btn-block"><?php echo __('Sign me in'); ?></button>

        <p><a href="<?php echo Router::url('/'); ?>" class="text-center btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <?php echo __('Go to home'); ?></a></p>
    </div>
</form>

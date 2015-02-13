<div class="col-xs-12">
    <div class="box">
        <div class="box-body responsive">
            <?php if (!empty($page)) { ?>
                <div class="header"><?php echo $page; ?></div>
            <?php } else { ?>
                <div class="header"><?php echo __("Register New Membership"); ?></div>
            <?php } ?>
            <form action="" method="post" style="max-width: 500px">
                <div class="">
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

                    <button type="submit" class="btn bg-olive btn-block"><?php echo __("Add User"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

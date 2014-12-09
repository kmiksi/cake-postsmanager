<div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h3>
                <?php echo __('Posts'); ?>
            </h3>
            <p>
                <?php echo __('Posts timeline'); ?>
            </p>
        </div>
        <div class="icon">
            <i class="ion ion-clipboard"></i>
        </div>
        <a href="<?php echo Router::url('/posts/add'); ?>" class="small-box-footer">
            <?php echo __('Add one'); ?> <i class="fa fa-plus-circle"></i>
        </a>
        <a href="<?php echo Router::url('/posts'); ?>" class="small-box-footer">
            <?php echo __('View All'); ?> <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div><!-- ./col -->
<div class="col-lg-6 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3>
                <?php echo __('Users'); ?>
            </h3>
            <p>
                <?php echo __('User Registrations'); ?>
            </p>
        </div>
        <div class="icon">
            <i class="ion ion-person-add"></i>
        </div>
        <a href="<?php echo Router::url('/users/add'); ?>" class="small-box-footer">
            <?php echo __('Add one'); ?> <i class="fa fa-plus-circle"></i>
        </a>
        <a href="<?php echo Router::url('/users'); ?>" class="small-box-footer">
            <?php echo __('View All'); ?> <i class="fa fa-arrow-circle-right"></i>
        </a>
    </div>
</div><!-- ./col -->
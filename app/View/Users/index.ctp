<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo __('List of users'); ?></h3>
            <div class="box-tools">
                <form action="" method="get">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control input-sm pull-right" style="width: 150px;" placeholder="<?php echo __('Search'); ?>">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="userstable">
                <tr>
                    <th><?php echo __('ID'); ?></th>
                    <th><?php echo __('Username'); ?></th>
                    <th><?php echo __('User full name'); ?></th>
                    <th><?php echo __('Registered'); ?></th>
                    <th><?php echo __('Level'); ?></th>
                    <th></th>
                </tr>
                <?php foreach ($users as $key => $user) { ?>
                    <tr>
                        <td><?php echo $user['User']['id']; ?></td>
                        <td><?php echo $user['User']['username']; ?></td>
                        <td><a href="<?php echo Router::url('/users/profile/' . $user['User']['id']); ?>"><?php echo $user['User']['name']; ?></a></td>
                        <td><?php echo $user['User']['created']; ?></td>
                        <td>
                            <?php if ((int) $user['User']['level'] == $ADMIN_LEVEL) { ?>
                                <span class="label label-primary"><?php echo __('Admin'); ?></span>
                            <?php } else { ?>
                                <span class="label label-success"><?php echo __('User'); ?></span>
                            <?php } ?>
                        </td>
                        <td><a href="<?php echo Router::url('/users/delete/' . $user['User']['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo __('BE CAREFULL!\nDo you want to delete this user and all your posts?'); ?>');"><i class="fa fa-trash-o"></i></a></td>
                    </tr>
                <?php } ?>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>

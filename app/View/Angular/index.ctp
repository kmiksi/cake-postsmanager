<div class="col-xs-12" ng-controller="UserListController">
    <div class="box" style="max-width: 600px;">
        <div class="box-header">
            <h3 class="box-title"><?php echo __('User'); ?> <u>{{editing.User.name}}</u></h3>
            <div class="box-tools pull-right">
                <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div><!-- /.box-header -->
        <form ng-submit="saveUser(editing)">
            <div class="box-body">
                <input type="hidden" ng-model="editing.User.id"/><br/>
                <input class="form-control" placeholder="<?php echo __('Full name'); ?>" ng-model="editing.User.name"/><br/>
                <input ng-if="!editing.User.id" class="form-control" placeholder="<?php echo __('Username'); ?>" ng-model="editing.User.username" /><br ng-if="!editing.User.id"/>
                <input ng-if="editing.User.id" class="form-control" disabled="disabled" ng-model="editing.User.username" /><br ng-if="editing.User.id"/>
                <input type="password" class="form-control" placeholder="<?php echo __('New password'); ?>" ng-model="editing.User.password" /><br/>
                <input type="password" class="form-control" placeholder="<?php echo __('Retype new password'); ?>" ng-model="editing.User.password2" /><br/>
            </div>
            <div class="box-footer">
                <button type="button" ng-if="editing.User.id" ng-click="newUser()" class="btn-link fa fa-plus"> <?php echo __('Register New Membership'); ?></button>
                <button type="submit" ng-if="!editing.User.id" class="btn btn-primary btn-large fa fa-check"> <?php echo __('Register New Membership'); ?></button>
                <button type="submit" ng-if="editing.User.id" class="btn btn-success btn-large fa fa-check"> <?php echo __('Save'); ?></button>
            </div>
        </form>
    </div>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?php echo __('List of users'); ?></h3>
            <div class="box-tools">
                <div class="input-group" title="<?php echo __("order: {{orderProp}}\nTIP: Click under collumn title to change ordering."); ?>">
                    <div class="input-group-btn">
                        <input type="text" class="form-control input-sm pull-right" style="width: 150px;"
                               placeholder="<?php echo __('Search'); ?>" ng-model="querystring" />
                        <div class="pull-right">
                            <button class="btn btn-default fa fa-refresh" ng-click="updateList()"> <?php echo __('Reload list'); ?></button>
                            <a href="<?php echo Router::url('/angular/'); ?>" class="btn btn-default fa fa-refresh"> <?php echo __('Reload page'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="userstable">
                <tr>
                    <th ng-click="orderProp = 'User.id'"><?php echo __('ID'); ?></th>
                    <th ng-click="orderProp = 'User.username'"><?php echo __('Username'); ?></th>
                    <th ng-click="orderProp = 'User.name'"><?php echo __('User full name'); ?></th>
                    <th ng-click="orderProp = 'User.created'"><?php echo __('Registered'); ?></th>
                    <th ng-click="orderProp = 'Level.description'"><?php echo __('Level'); ?></th>
                    <th></th>
                </tr>
                <div>
                    <tr ng-repeat="user in users| filter:querystring | orderBy:orderProp" ng-click="editUser(user)">
                        <td>{{user.User.id}}</td>
                        <td>{{user.User.username}}</td>
                        <td><a href="javascript:void(0)">{{user.User.name}}</a></td>
                        <td>{{user.User.created}}</td>
                        <td><span class="label label-{{user.User.level == 1 ? 'primary' : 'success'}}">{{user.Level.description}}</span></td>
                        <td><button class="btn btn-danger btn-sm" ng-click="deleteUser(user)"><i class="fa fa-trash-o"></i></button></td>
                    </tr>
                </div>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer">
        </div>
    </div><!-- /.box -->
    <div class="btn-toolbar pad">
    </div>
</div><!-- UserListController -->

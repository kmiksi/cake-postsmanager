<div class="col-xs-12">
    <div class="box" ng-controller="UserListController">
        <div class="box-header">
            <h3 class="box-title"><?php echo __('List of users'); ?></h3>
            <div class="box-tools">
                <div class="input-group" title="<?php echo __('order: {{orderProp}}
TIP: Click under collumn title to change ordering.'); ?>">
                    <div class="input-group-btn">
                        <input type="text" class="form-control input-sm pull-right" style="width: 150px;"
                               placeholder="<?php echo __('Search'); ?>" ng-model="querystring" />
                    </div>
                </div>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="userstable">
                <tr>
                    <th ng-click="orderProp='User.id'"><?php echo __('ID'); ?></th>
                    <th ng-click="orderProp='User.username'"><?php echo __('Username'); ?></th>
                    <th ng-click="orderProp='User.name'"><?php echo __('User full name'); ?></th>
                    <th ng-click="orderProp='User.created'"><?php echo __('Registered'); ?></th>
                    <th ng-click="orderProp='Level.description'"><?php echo __('Level'); ?></th>
                    <th></th>
                </tr>
                <div>
                    <tr ng-repeat="user in users| filter:querystring | orderBy:orderProp">
                        <td>{{user.User.id}}</td>
                        <td>{{user.User.username}}</td>
                        <td><a href="<?php echo Router::url('/angular/profile/{{user.User.id}}'); ?>">{{user.User.name}}</a></td>
                        <td>{{user.User.created}}</td>
                        <td><span class="label label-{{user.User.level == 1 ? 'primary' : 'success'}}">{{user.Level.description}}</span></td>
                        <!--<td><a href="<?php echo Router::url('/angular/delete/'); ?>{{user.User.id}}" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo __('BE CAREFULL!\nDo you want to delete this user and all your posts?'); ?>');"><i class="fa fa-trash-o"></i></a></td>-->
                        <td><button class="btn btn-danger btn-sm" ng-click="deleteUser(user.User.id)"><i class="fa fa-trash-o"></i></button></td>
                    </tr>
                </div>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    <div class="btn-toolbar pad">
        <a href="<?php echo Router::url('/angular/'); ?>" class="btn btn-default fa fa-refresh"> <?php echo __('Reload page'); ?></a>
        <a href="<?php echo Router::url('/angular/add'); ?>" class="btn btn-success btn-large fa fa-plus"> <?php echo __('Add user'); ?></a>
        <a href="<?php echo Router::url('/angular/profile'); ?>" class="btn btn-primary btn-large fa fa-credit-card"> <?php echo __('Edit your profile'); ?></a>
    </div>
</div>
<script type="text/javascript">
    "use strict";
    website.controller('UserListController', ['$scope', '$http', function($scope, $http) {
            $scope.updateList = function() {
                $scope.orderProp = 'User.created';
                $http.get('<?php echo Router::url('/angular/get/'); ?>').success(function(data) {
                    $scope.users = data;
                });
            };
            $scope.deleteUser = function(userid) {
                if (confirm('<?php echo __('BE CAREFULL!\nDo you want to delete this user and all your posts?'); ?>')) {
                    $http.get('<?php echo Router::url('/angular/delete/'); ?>' + userid).success(function(data) {
                        alert(data);
                        $scope.updateList();
                    });
                }
            };
            $scope.updateList();
        }]);
</script>

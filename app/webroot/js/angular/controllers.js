"use strict";
websiteApp.controller("UserListController", ['$scope', 'Users', function ($scope, Users) {
        Users.defaultResponse = function (response) {
            alert(response.data);
            $scope.editing = {};
            $scope.updateList();
        };
        Users.defaultResponseFail = function (response) {
            alert(response.data);
            $scope.updateList();
        };
        $scope.updateList = function () {
            $scope.users = []; // prevent mistakes with slow responses
            $scope.orderProp = 'User.created';
            Users.query(function (users) {
                $scope.users = users;
            });
        };
        $scope.deleteUser = function (user) {
            if (confirm('BE CAREFULL!\nDo you want to delete this user and all your posts?')) {
                Users.delete({ids: user.User.id}, {}, Users.defaultResponse, Users.defaultResponse);
            }
        };
        $scope.newUser = function () {
            $scope.editing = {};
        };
        $scope.editUser = function (user) {
            $scope.editing = user;
        };
        $scope.addUser = function (user) {
            Users.add(user, Users.defaultResponse, Users.defaultResponseFail);
        };
        $scope.updateUser = function (user) {
            Users.update(user, Users.defaultResponse, Users.defaultResponseFail);
        };
        $scope.saveUser = function (user) {
            if (!!user && !!user.User) {
                if (!!user.User.id && user.User.id !== '') {
                    $scope.updateUser(user);
                } else {
                    $scope.addUser(user);
                }
            } else {
                alert('Please fill the form!');
            }
        };
        $scope.updateList();
    }]);

//websiteApp.controller('UserListController', ['$scope', '$http', function ($scope, $http) {
//        $scope.url = BASE_URL + '/angular/users';
//        $scope.updateList = function () {
//            $scope.users = []; // prevent mistakes with slow responses
//            $scope.orderProp = 'User.created';
//            $http.get($scope.url)
//                    .success(function (data) {
//                        $scope.users = data;
//                    })
//                    .error(function (data, status, headers) {
//                        alert('ERROR (status ' + status + ')\nSome problem with request:\n' + data);
//                        console.log(headers);
//                    });
//        };
//        $scope.deleteUser = function (userid) {
//            if (confirm('BE CAREFULL!\nDo you want to delete this user and all your posts?')) {
//                $http.delete($scope.url + '/' + userid)
//                        .success(function (data) {
//                            alert(data);
//                            $scope.updateList();
//                        })
//                        .error(function (data, status, headers) {
//                            alert('ERROR (status ' + status + ')\nSome problem with request:\n' + data);
//                            console.log(headers);
//                        });
//            }
//        };
//        $scope.addUser = function () {
//            // under construction
//        };
//        $scope.updateList();
//    }]);

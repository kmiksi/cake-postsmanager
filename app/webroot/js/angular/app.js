'use strict';
// app module
var websiteApp = angular.module('websiteApp', ['ngResource']);

websiteApp.factory("Users", function ($resource) {
    var paramDefaults = {};
    var actions = {
        query: {
            method: "GET",
            isArray: true,
            responseType: 'json'
        },
        add: {
            method: "POST",
            isArray: false,
            responseType: 'json'
        },
        update: {
            method: "PUT",
            isArray: false,
            responseType: 'json'
        },
        delete: {
            method: "DELETE",
            isArray: false,
            responseType: 'json'
        }
    };
    return $resource(BASE_URL + '/angular/users/:ids', paramDefaults, actions);
});

//websiteApp.config(function ($routeProvider) {
//    var routeConfig = {
//        controller: 'UserListController',
//        //templateUrl: 'test.html',
//        resolve: {
//            store: function (todoStorage) {
//                // Get the correct module (API or localStorage).
//                return todoStorage.then(function (module) {
//                    module.get(); // Fetch the todo records in the background.
//                    return module;
//                });
//            }
//        }
//    };
//
//    $routeProvider
//            .when(BASE_URL + '/', routeConfig)
//            .when(BASE_URL + '/:status', routeConfig)
//            .otherwise({
//                redirectTo: BASE_URL + '/'
//            });
//});


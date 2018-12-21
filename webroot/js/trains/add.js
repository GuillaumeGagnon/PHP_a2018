/*
$(document).ready(function () {
    // The path to action from CakePHP is in urlToLinkedListFilter 
    $('#category-station-origin').on('change', function () {
        var type = $(this).val();
        if (type) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'type=' + type,
                success: function (stations) {
                    $select = $('#origin-station');
                    $select.find('option').remove();
                    $.each(stations, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childValue.id + '>' + childValue.name + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#origin-station').html('<option value="">Select Category first</option>');
        }
    });

    $('#category-station-final').on('change', function () {
        var type = $(this).val();
        if (type) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'type=' + type,
                success: function (stations) {
                    $select = $('#final-station');
                    $select.find('option').remove();
                    $.each(stations, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childValue.id + '>' + childValue.name + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#final-station').html('<option value="">Select Category first</option>');
        }
    });
});

*/


// old

//new




var app = angular.module('linkedlists', []);

app.controller('stationTypesControlleur', function ($scope, $http) {
    // l'url vient de add.ctp
    $http.get(urlToLinkedListFilter).then(function (response) {
        
        $scope.stationTypes = response.data;
        $scope.stationTypesFinal = response.data;
    });
});


(function ($) {
    // Get the path to action from CakePHP
    var autoCompleteSource = urlToAutocompleteAction;
    $('#autocomplete').autocomplete({
        source: autoCompleteSource,        
        minLength: 1
    });
})(jQuery);


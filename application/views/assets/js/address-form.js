function shopsTypeaheadSource(query, syncResult) {
    $.ajax({
        url: BASE_URL + 'addresses/shops-autocomplete?q=' + query,
        dataType: 'json',
        success: function(data) {
            suncResult(data);
        }
    });
}

$(function() {

});
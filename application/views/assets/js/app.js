$(function() {
    $('.filter input, .filter select').change(function() {
        let params = yii.getQueryParams(location.href);
        let name = '';
        let $form = $(this).closest('form');
        let names = $.unique($form.find('input, select').map(function() {
            return $(this).attr('name');
        }));
        for (name in params) {
            if (params.hasOwnProperty(name) && $.inArray(name, names) == -1) {
                $form.append($('<input type="hidden" >').attr('name', name).val(params[name]));
            }
        }

        $form.submit();
    });

    $('.btn-group .btn').click(function() {
        if ($(this).prev().is('[type=checkbox]') && !$(this).prev().is(':checked')) {
            $(this).siblings(':checked').removeAttr('checked');
            $(this).prev().attr('checked', true).change();
        }
    })
});

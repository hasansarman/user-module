<script>
    $( document ).ready(function() {
        $('.jsSelectAllAllow').on('click',function (event) {
            event.preventDefault();
            $(this).closest('.permissionGroup').find('.jsAllow').each(function (index, value) {
                $(value).iCheck('check');
            });
        });
        $('.jsSelectAllDeny').on('click',function (event) {
            event.preventDefault();
            $(this).closest('.permissionGroup').find('.jsDeny').each(function (index, value) {
                $(value).iCheck('check');
            });
        });
        $('.jsSelectAllInherit').on('click',function (event) {
            event.preventDefault();
            $(this).closest('.permissionGroup').find('.jsInherit').each(function (index, value) {
                $(value).iCheck('check');
            });
        });

        $('.jsSelectEveryAllAllow').on('click',function (event) {
            event.preventDefault();
            $('.jsAllow').each(function (index, value) {
                $(value).iCheck('check');
            });
        });
        $('.jsSelectEveryAllDeny').on('click',function (event) {
            event.preventDefault();
            $('.jsDeny').each(function (index, value) {
                $(value).iCheck('check');
            });
        });
        $('.jsSelectEveryAllInherit').on('click',function (event) {
            event.preventDefault();
            $('.jsInherit').each(function (index, value) {
                $(value).iCheck('check');
            });
        });
    });
</script>

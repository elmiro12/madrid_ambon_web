<script>
$(document).ready(function() {
    console.log('Page loaded');

    // Force initialize material dashboard
    if (typeof materialKit !== 'undefined') {
        materialKit.initFormExtendedDatetimepickers();
    }

    // Manual floating label activation
    $('.form-control').on('focus', function() {
        $(this).parent().addClass('is-focused');
    }).on('blur', function() {
        $(this).parent().removeClass('is-focused');
        if ($(this).val().length > 0) {
            $(this).parent().addClass('is-filled');
        } else {
            $(this).parent().removeClass('is-filled');
        }
    });

    // Check if input already has value on page load
    $('.form-control').each(function() {
        if ($(this).val().length > 0) {
            $(this).parent().addClass('is-filled');
        }
    });
});
</script>

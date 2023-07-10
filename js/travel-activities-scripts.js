jQuery(document).ready(function($) {
    // Initialize Select2 for the activities dropdown
    $('.travel-package-activities').select2({
        placeholder: 'Select activities',
        width: '100%',
        tags: true,
        tokenSeparators: [','],
        allowClear: true
    });
});

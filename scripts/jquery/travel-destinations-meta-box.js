jQuery(document).ready(function($) {
    // Add destination input field
    $('#add-destination-button').click(function() {
        $('#travel-destinations-container').append('<input type="text" class="travel-destination" name="travel_destinations[]">');
    });
});

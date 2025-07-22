(function($) {
    'use strict';
    
    // Media uploader instance
    let csvMediaUploader = null;
    
    $(document).ready(function() {
        // Toggle data source settings
        $('#sx-data-source').on('change', function() {
            const dataSource = $(this).val();
            
            if (dataSource === 'csv') {
                $('#csv-settings').show();
                $('#post-type-settings').hide();
            } else if (dataSource === 'post_type') {
                $('#csv-settings').hide();
                $('#post-type-settings').show();
            }
        });
        
        // Handle CSV file upload button
        $('#sx-csv-upload-button').on('click', function(e) {
            e.preventDefault();
            
            // If the uploader object has already been created, reopen the dialog
            if (csvMediaUploader) {
                csvMediaUploader.open();
                return;
            }
            
            // Create the media uploader
            csvMediaUploader = wp.media({
                title: sx_admin.title,
                button: {
                    text: sx_admin.button
                },
                library: {
                    type: 'text/csv'  // Filter to only CSV files
                },
                multiple: false
            });
            
            // When a file is selected, get the URL and update the hidden input field
            csvMediaUploader.on('select', function() {
                const attachment = csvMediaUploader.state().get('selection').first().toJSON();
                $('#sx-csv-file-id').val(attachment.id);
                $('#sx-csv-file-url').val(attachment.url);
                
                // Display the selected file name
                $('#sx-selected-csv-file').html('<strong>Selected file:</strong> ' + attachment.filename);
                
                // Display the save button
                $('#sx-save-csv-button').show();
            });
            
            // Open the uploader dialog
            csvMediaUploader.open();
        });
    });
})(jQuery);
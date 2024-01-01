// crypto.js

$(document).ready(function () {
    $('#crypto-form').submit(function (e) {
        e.preventDefault();

        // Extract CSRF token
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Extract the value of the 'operation' attribute from the clicked button
        var operation = $('button:focus').val();

        // Include CSRF token and 'operation' in the data
        var formData = $(this).serializeArray();
        formData.push({ name: "_token", value: csrfToken });
        formData.push({ name: "operation", value: operation });

        // Perform AJAX request to the server
        $.ajax({
            type: 'POST',
            url: '/process',
            data: formData,
            success: function (response) {
                // Update HTML element with the result from the response
                $('#keyShow').val(response.key);
                $('#result').val(response.result);
            },
            error: function (error) {
                console.error('Error:', error.responseJSON);
            }
        });
    });


});

// Function to copy text to clipboard
function copyToClipboard(element) {
    var copyText = $(element);
    copyText.select();
    document.execCommand('copy');
    alert('Text copied to clipboard: ' + copyText.val());
}

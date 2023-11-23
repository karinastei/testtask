//product_form.js
function toggleFields() {
    let selectedType = $("#productType").val();

    // Send the selected type to the PHP script using AJAX
    $.ajax({
        type: 'POST',
        url: 'form_change.php', // Replace with your PHP script URL
        data: { productType: selectedType },
        success: function(response) {
            // Insert the received HTML into a div or directly into the form
            $('#dynamicFields').html(response); // Assuming 'dynamicFields' is a div where you want to inject the form values
        }
    });
}

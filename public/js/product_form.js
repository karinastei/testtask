//product_form.js
function cancel() {
    //kui cpanelis siis "/"?
    window.location.href = "/store";
};

function redirectToForm() {
    window.location.href = "add_product.php";
};

function toggleFields() {
    let selectedType = $("#productType").val();

    // Send the selected type to the PHP script using AJAX
    $.ajax({
        type: 'POST',
        url: 'form_change.php',
        data: {productType: selectedType},
        success: function (response) {
            // Insert the received div into the form
            $('#dynamicFields').html(response);
        }
    });
}

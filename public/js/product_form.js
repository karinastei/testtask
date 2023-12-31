function cancel() {
    window.location.href = "/";
}

function redirectToForm() {
    window.location.href = "add_product.php";
}

function toggleFields() {
    let selectedType = $("#productType").val();

    $.ajax({
        type: 'POST',
        url: 'form_change.php',
        data: {productType: selectedType},
        success: function (response) {
            $('#dynamicFields').html(response);
        }
    });
}

$(document).ready(function () {
    $('#product_form').submit(function (e) {
        // Prevent default form submission
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function (response) {
                if (response.trim() === 'success') {
                    window.location.href = '/';
                } else {
                    $('#notification').html(response);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

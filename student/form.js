$(document).ready(function () {
    $('#admissionForm').on('submit', function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'submit_form.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message);
                    $('#admissionForm')[0].reset();
                    $('#admissionFormContainer').collapse('hide');
                } else {
                    alert(res.message);
                }
                $('button[type=submit]').prop('disabled', false);
            },
            error: function () {
                console.log('Error occurred during form submission');
                alert('There was an error submitting the form.');
                $('button[type=submit]').prop('disabled', false);
            }
        });
    });
});

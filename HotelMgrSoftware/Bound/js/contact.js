$(document).ready(function () {
    $('div.output').hide();
    //bind send message here
    $('#send-message').click(sendMessage);

    $('.alert .close').live('click', function () {
        $('div.output').html('').hide();
    });
});

/* Contact Form */
function checkEmail(email) {
    var check = /^[\w\.\+-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]{2,6}$/;
    if (!check.test(email)) {
        return false;
    }
    return true;
}

function sendMessage() {

    // receive the provided data
    var name = $("input#name").val();
    var email = $("input#email").val();
    var subject = $("input#subject").val();
    var message = $("textarea#message").val();

    // check if all the fields are filled
    if (name == '' || email == '' || subject == '' || message == '') {
        $("div.output").show().html('<div class="alert notice hideit"><p>You must enter all the required fields!</p><span class="close"></span> </div>');
        return false;
    }

    // verify the email address
    if (!checkEmail(email)) {
        $("div.output").show().html('<div class="alert notice hideit"><p>Please enter a valid e-mail address!</p><span class="close"></span> </div>');
        return false;
    }

    // make the AJAX request
    var dataString = $('#contact-form').serialize();
    $.ajax({
        type: "POST",
        url: 'contact.php',
        data: dataString,
        dataType: 'json',
        success: function (data) {
            if (data.success == 0) {
                var errors = '<ul><li>';
                if (data.name_msg != '')
                    errors += data.name_msg + '</li>';
                if (data.email_msg != '')
                    errors += '<li>' + data.email_msg + '</li>';
                if (data.message_msg != '')
                    errors += '<li>' + data.message_msg + '</li>';
                if (data.subject_msg != '')
                    errors += '<li>' + data.subject_msg + '</li>';

                $("div.output").show().html('<div class="alert error hideit"><p>Could not complete your request. See the errors below!</p><p>' + errors + '</p><span class="close"></span> </div>');
            }
            else if (data.success == 1) {

                $("div.output").show().html('<div class="alert success hideit"><p>Your E-Mail has been sent successfully!</p><span class="close"></span> </div>');
            }

        },
        error: function (error) {
            var str = 'Status: ' + error.status + '<br/>Message: ' + error.statusText;
            $("div.output").show().html('<div class="alert error hideit"><p>Could not complete your request at the moment. See the errors below!</p><p>' + str + '</p><span class="close"></span> </div>');
        }
    });

    return false;
}
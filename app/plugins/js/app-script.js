$(document).ready(function(){

	$(document).ready(function() {
        
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        

        $(".file-upload").on('change', function(){
            readURL(this);
        });

        });


//Confirm Passwords
    $("#confirm-password").keyup(function() {

        setTimeout(function(){

            var pass = $('#new-password').val();
            var pass_conf = $('#confirm-password').val();

            if( pass === pass_conf ){

                $("#btn-change").attr("disabled", false);
                $('#conf-message').html('');

            } else {

                $('#conf-message').html('Passwords do not match');

                $("#btn-change").attr("disabled", true);

            }

        }, 100)

    });

    $("#new-password").keyup(function() {

        setTimeout(function(){

            var pass = $('#new-password').val();
            var pass_conf = $('#confirm-password').val();

            if( pass === pass_conf && pass != ''){

                $("#btn-change").attr("disabled", false);

                $('#conf-message').html('');

            } else if( pass != pass_conf && pass_conf != ''){

                $('#conf-message').html('Passwords do not match');

                $("#btn-change").attr("disabled", true);

            }

        }, 100)

    });



//Initialize Select2 Elements
    $('.select2').select2();

// //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    $('[data-toggle="tooltip"]').tooltip();
    
});


function goBack() {
	
  	window.history.back();
}

function closeWindow() {

	close();
}

function reload(){

	location.reload();
}


// Auto expand textArea
    var autoExpand = function (field) {

        // Reset field height
        field.style.height = 'inherit';

        // Get the computed styles for the element
        var computed = window.getComputedStyle(field);

        // Calculate the height
        var height = parseInt(computed.getPropertyValue('border-top-width'), 10)
                     + parseInt(computed.getPropertyValue('padding-top'), 10)
                     + field.scrollHeight
                     + parseInt(computed.getPropertyValue('padding-bottom'), 10)
                     + parseInt(computed.getPropertyValue('border-bottom-width'), 10);

        field.style.height = height + 'px';

    };

    document.addEventListener('input', function (event) {
        if (event.target.tagName.toLowerCase() !== 'textarea') return;
        autoExpand(event.target);
    }, false);
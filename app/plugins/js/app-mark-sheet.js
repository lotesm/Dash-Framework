$(document).ready(function(){

	

    $('#add-marks-form').on('submit', function(form){

        
        $('#add-marks-msg').html('Submiting...')

        $('#btn-save-marks').hide()

        form.preventDefault()


        var form_data = $(this).serialize();

        setTimeout(function(){

            $.ajax({
                url:"app/helpers/mark-sheet/save-marks.php",
                method:"POST",
                data:form_data,
                success:function(data){

                    var result = $.trim( data );

                    if( result === 'done' ){

                        $('#add-marks-msg').html('<b>Done</b>')

                        $('#add-marks-form').trigger("reset");

                    }else{

                        $('#add-marks-msg').html(result)

                    }
                }
            
            });
            
        }, 3000);

        
    })


    $('#edit-marks-form').on('submit', function(form){

        
        $('#edit-marks-msg').html('Editing...')

        $('#btn-edit-marks').hide()

        form.preventDefault()


        var form_data = $(this).serialize();

        setTimeout(function(){

            $.ajax({
                url:"app/helpers/mark-sheet/edit-marks.php",
                method:"POST",
                data:form_data,
                success:function(data){

                    var result = $.trim( data );

                    if( result === 'done' ){

                        $('#edit-marks-msg').html('<b>Done</b>')

                        $('#edit-marks-form').trigger("reset");

                    }else{

                        $('#edit-marks-msg').html(result)

                    }
                }
            
            });
            
        }, 3000);

        
    })
    

    /*
    * Marks Upload Handlers
    *
    */
    $('#upload-marks-form').on('submit', function(e){

        $('#upload-feedback').html('');

        e.preventDefault()

        $('#submit-btn').hide();


        var formdata = new FormData();

        formdata.append('classID', $('#classID').val() );
        formdata.append('subjectID', $('#subjectID').val() );
        formdata.append('term', $('#term').val() );
        formdata.append('year', $('#year').val() );

        formdata.append('file', $('#marks-file')[0].files[0] );

        // console.log(formdata);

        var request = new XMLHttpRequest();

        request.upload.addEventListener('progress', function (e) {

            var file1Size = $('#marks-file')[0].files[0].size;

            if (e.loaded <= file1Size) {
                var percent = Math.round(e.loaded / file1Size * 100);

                $('#progress-bar').width(percent + '%').html('uploading: '+percent + '%');
            } 

            if(e.loaded == e.total){

                $('#progress-bar').width(100 + '%').html('<dfn class="text-center">Completing upload!! please wait...</dfn>');
            }
        });   

        request.open('post', 'app/helpers/mark-sheet/upload-marks.php');
        request.timeout = 45000;
        request.send(formdata);

        request.onreadystatechange = (e) => {

            var response = $.trim(request.responseText);

            $('#upload-feedback').html( response );

            $('#upload-marks-form').trigger("reset");

            $('#submit-btn').show();

        }

    });

    
});

function addMarks( studentID ) {
    

    $.ajax({

        type: 'post',
        url: 'app/helpers/students/get-student.php',
        data: {studentID: studentID},
        success: function(data){

            var obj = $.parseJSON(data);

            
            var result = $.trim( obj['msg'] );

            if( result === 'found' ){

                var names   = obj["names"];
                var classID = obj['classID'];

                $('#studentID').val(studentID);
                $('#classID').val(classID)

                $('#sm-name').html(names)

                $('#add-marks').modal('show');

            }else{

                $('#add-marks').modal('hide')

                $('#error-modal').modal('show')
            }
                                                                            
        }
    
    });

}

function editMarks( studentID ) {

    $.ajax({

        type: 'post',
        url: 'app/helpers/students/get-student-marks.php',
        data: {studentID: studentID},
        success: function(data){

            var obj = $.parseJSON(data);

            
            var result = $.trim( obj['msg'] );

            if( result === 'found' ){

                var names   = obj["names"];
                var classID = obj['classID'];
                var marks   = obj['marks'];
                var remarks = obj['remarks'];

                $('#e-studentID').val(studentID);
                $('#e-classID').val(classID)
                $('#e-marks').val(marks)
                $('#e-r-marks').val(remarks)

                $('#e-sm-name').html(names)

                $('#edit-marks').modal('show');

            }else{

                $('#edit-marks').modal('hide')

                $('#error-modal').modal('show')
            }
                                                                            
        }
    
    });

}


function remarks( studentID ) {

    $.ajax({

        type: 'post',
        url: 'app/helpers/students/get-student-remarks.php',
        data: {studentID: studentID},
        success: function(data){

            var obj = $.parseJSON(data);

            
            var result = $.trim( obj['msg'] );

            if( result === 'found' ){

                var names   = obj["names"];
                var classID = obj['classID'];
                var marks   = obj['marks'];
                var remarks = obj['remarks'];

                $('#studentID').val(studentID);
                $('#classID').val(classID)
                $('#marks').val(marks)
                $('#r-marks').val(remarks)

                $('#sm-name').html(names)

                $('#add-remarks').modal('show');

            }else{

                $('#add-remarks').modal('hide')

                $('#error-modal').modal('show')
            }
                                                                            
        }
    
    });

}


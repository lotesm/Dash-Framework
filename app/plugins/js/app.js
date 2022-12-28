$(document).ready(function(){


    var numbers = /^[-+]?[0-9]+$/;
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,15})+$/;

    var loadview = '<center><img src="public/images/loading.gif"></center>';

    $('#auth-form').on('submit', function(form){

        
        $('#auth-msg').removeClass('alert-danger')
        $('#auth-msg').html('')

        form.preventDefault()

        var username = $('#username').val()
        var password = $('#password').val()


        if( username !== '' && password !== '' ){

            $('#auth-msg').html(loadview)

            var form_data = $(this).serialize();

            setTimeout(function(){

                $.ajax({
                    url:"app/helpers/auth/auth.php",
                    method:"POST",
                    data:form_data,
                    success:function(data){

                        var result = $.trim( data );

                        if(result === 'auth' ){

                            location.href = "index.php"

                        }else{

                            $('#auth-msg').addClass('alert-danger')

                            $('#auth-msg').html(result)

                        }
                    }
                
                });
                
            }, 3000);

        }



    })


    $('#search-form').on('submit', function(form){

        form.preventDefault()

        var search = $('#search').val();

        location.href = 'index.php?view=students&action=manage-students&search=Student&search='+search;
    
    })
 

    $('#ass-submission').submit(function(e) {
        
        e.preventDefault();

        var file = $('#answer-att')[0].files[0];

        if( typeof file === 'undefined'){

            $('#progress-bar').width(100 + '%').html('<dfn><center>Completing submission!! please wait...</center></dfn>');

            var assID   = $('#assID').val();
            var answer  = $('#answer').val();
            var assDir  = $('#assDir').val();

            $.ajax({
                url:"app/helpers/assignments/submit-assignment.php",
                method:"POST",
                data:{assID: assID, answer: answer, assDir: assDir},
                success:function(data){

                    var result = $.trim(data);


                    if(result === 'done'){

                        location.href = 'index.php?view=assignments&action=view-assignment&assignment=' + assID;

                    }else{

                        location.reload();
                    }
                    
                }
            
            });

        }else{

            postAssFile();

        }
        

    });


});

    function filterClass() {

        var filter = $('#select-class').val();

        location.href = 'index.php?view=mark-sheet&class='+filter;
    
    }

    function remarksClassFilter() {

        var filter = $('#select-class').val();

        location.href = 'index.php?view=mark-sheet&action=class-teacher-remarks&class='+filter;
    
    }

    function viewParams() {

        var params = '';
        var parser = document.createElement('a');
        parser.href = window.location;
        var query = parser.search.substring(1);
        var vars = query.split('&');

        for (var i = 0; i < vars.length; i++) {

            var pair = vars[i].split('=');

            if ( decodeURIComponent( pair[0] ) === 'view')

                params = decodeURIComponent( pair[1] );
        }

        if( params === '' )

            params = 'dashboard';

        return params;

    };


    function getActionParams() {

        var params = '';
        var parser = document.createElement('a');
        parser.href = window.location;
        var query = parser.search.substring(1);
        var vars = query.split('&');

        for (var i = 0; i < vars.length; i++) {

            var pair = vars[i].split('=');

            if ( decodeURIComponent( pair[0] ) === 'action')

                params = decodeURIComponent( pair[1] );
        }

        return params;

    };
  

    function postAssFile() {

        var formdata = new FormData();

        formdata.append('assID', $('#assID').val() );
        formdata.append('answer', $('#answer').val() );
        formdata.append('assDir', $('#assDir').val() );

        formdata.append('file', $('#answer-att')[0].files[0] );

        // console.log(formdata);

        var request = new XMLHttpRequest();

        request.upload.addEventListener('progress', function (e) {

            var file1Size = $('#answer-att')[0].files[0].size;

            if (e.loaded <= file1Size) {
                var percent = Math.round(e.loaded / file1Size * 100);

                $('#progress-bar').width(percent + '%').html('uploading: '+percent + '%');
            } 

            if(e.loaded == e.total){

                $('#progress-bar').width(100 + '%').html('<dfn><center>Completing upload!! please wait...</center></dfn>');
            }

        });   

        request.open('post', 'app/helpers/assignments/submit-assignment.php');
        request.timeout = 45000;
        request.send(formdata);

        request.onreadystatechange = (e) => {

            location.href = 'index.php?view=assignments&action=view-assignment&assignment=' + $('#assID').val();

        }
    
    }


    function reply_article( articleID ){

        comment = $('#'+articleID).val();

        if(comment === ''){

            $('#comment-feedback-'+articleID).html('<p class="text-danger">Please type in a comment...!<p>');
            $('#'+articleID).focus();

        } else {
            $('#comment-feedback-'+articleID).html('<p class="text-success" style="font-style: italic;">Commenting...</p>');


            $.ajax({
                url: "theme/app/article.php?action=comment",
                method:"POST",
                data: {articleID: articleID, comment: comment},
                success:function(data){

                    var obj = $.parseJSON(data);
                    feedback = obj["feedback"];

                    var result = $.trim(feedback);

                    if(result === 'done'){

                        comment = obj['comment'];

                        $("#stream-respond-"+articleID).append(comment);
                        $('#'+articleID).val('');

                    }else{

                        $('#comment-feedback').html(result);

                    }
                    $('#comment-feedback-'+articleID).html('');

                }
            });
        }

    }

    function load_replies( articleID ){

        loaded = document.getElementById("stream-respond-"+articleID).childElementCount;

        //alert(articleID);

        $.ajax({
            url: "theme/app/article.php?action=load-comments",
            method:"POST",
            data: {articleID: articleID, loaded: loaded},
            success:function(data){

                var obj = $.parseJSON(data);
                feedback = obj["feedback"];

                var result = $.trim(feedback);


                if( result === 'done'){

                    comment = obj['comment'];

                    $("#stream-respond-"+articleID).append(comment);

                    $('#comment-feedback-'+articleID).html('');

                }else{

                    $('#comment-feedback-'+articleID).html(result);

                }
            }
        });

    }
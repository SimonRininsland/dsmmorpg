$(document).ready(function(){
    $('#sign_up > a').on('click', function(){
        $('#loginbox').hide();
        $('#signupbox').show();
    });

    $('#signinlink').on('click', function(){
        $('#signupbox').hide();
        $('#loginbox').show();
    });
});
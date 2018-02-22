/**
 * JS for Sign in and Sign up
 */

$(document).ready(function(){
    /**
     * switch between sign in and sign up
     */
    $('#sign_up > a').on('click', function(event){
        event.preventDefault();
        event.stopPropagation();
        $('#loginbox').hide();
        $('#signupbox').show();
    });

    $('#signinlink').on('click', function(event){
        event.preventDefault();
        event.stopPropagation();
        $('#signupbox').hide();
        $('#loginbox').show();
    });

    /**
     * sign in and sign up actions
     */
    $('#btn-login').on('click', function(event){
        event.preventDefault();
        event.stopPropagation();

        $.post( "classes/SignInAction.php",
            $( "#loginform" ).serialize()
        ).done(function(data) {
            if(data === '1'){

                $('#login-username').removeClass('invalid');
                // start the game

            } else {
                $('#login-alert').toggle(true);
                $('#login-username').addClass('invalid');
                $('#login-alert').text(data);
            }
        }).fail(function(error) {
            console.log(error);
        });
    });

    /**
     * sign up and sign up actions
     */
    $('#btn-signup').on('click', function(event){
        event.preventDefault();
        event.stopPropagation();

        $.post( "classes/SignInAction.php",
            $( "#signupform" ).serialize()
        ).done(function(data) {
            if(data === '1'){
                location.reload();
                $('#login-username').removeClass('invalid');
            } else {
                $('#signupalert').toggle(true);
                $('#signupalert').text(data);
                $('#login-username').addClass('invalid');
            }
        }).fail(function(error) {
            console.log(error);
        });
    });
});
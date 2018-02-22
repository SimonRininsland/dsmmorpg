/**
 * Game Class to control the Game
 */

/** store username in global var **/
var $username;
var $state;
var $character;

$(document).ready(function(){
    /** get Username **/
    getUsername();

    getCharacter();

    stateController();
});

function stateController(){
    /** first Time Start **/
    if(getCookie())
    $('#game-stage-top').text();
}

function setContent(element){

}

/**
 * getCharacter
 */
function getCharacter() {
    /** get the username **/
    $.post( "classes/GameDealer.php",{
        function: "getCharacter",
        param: getCookie("PHPSESSID")}
    ).done(function(data) {
        // Username is okay
        $username = $('.navbar-top').find('#username').text(data.toString());
    }).fail(function(error) {
        $('#game-alert').toggle(true).text(error.responseText);
    });
}

/**
 * getUsername
 */
function getUsername() {
    /** get the username **/
    $.post( "classes/GameDealer.php",{
            function: "getUserName",
            param: getCookie("PHPSESSID")}
    ).done(function(data) {
        // Username is okay
        $username = $('.navbar-top').find('#username').text(data.toString());
    }).fail(function(error) {
        $('#game-alert').toggle(true).text(error.responseText);
    });
}

/**
 * getCookie
 * @param name
 * @returns {*}
 */
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length === 2) return parts.pop().split(";").shift();
}
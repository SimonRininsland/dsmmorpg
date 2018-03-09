/**
 * Game Class to control the Game
 */

/** store username in global var **/
var $username;
var $state;
/** @todo: get User **/
var $user;
var $characters = [];

var $text = {};
var $textSpeed = 40;

var $landscapesPath = 'resources/images/landscapes/';

/** El. only one select **/
var $gameError = $('#game-alert');
var $textEl = $('#text');
var $screen = $('#screen');

$(document).ready(function(){
    /** get Text **/
    $.getJSON( "resources/Main.json", function(json) {
        $text = json;
    }).done(function(){
        /** get Username **/
        getUsername();
        /** get Character **/
        getCharacter().done(function(){
            /** stateController **/
            stateController();
        });
    });
});

/**
 * stateController
 */
function stateController(){
    /** first Time Start **/
    if($state === 1){
        stateFirstStart();
    } else if($state === 2){
        stateSelectChar();
    }
}

/**
 * choose Char
 */
function stateSelectChar(){
    /** set the Background **/
    setBackground();
}

/**
 * storeCharacter
 * return new Character ID
 */
function storeCharacter(nick, type) {
    /** store the Character **/
    return $.post( "classes/GameDealer.php", {
        function: "storeCharacter",
        param: getCookie("session") + ',' + type + ',' + nick
    });
}

/**
 * setBackground
 */
function setBackground(){
    switch($state) {
        case 1:
            $screen.css('background-image', 'url(' + $landscapesPath + 'screen_mountains.jpg)');
            break;
        case 2:
            $screen.css('background-image', 'url(' + $landscapesPath + 'screen_mountains_night.jpg)');
            break;
        default:
            $screen.css('background-image', 'url(' + $landscapesPath + 'screen_mountains.jpg)');
    }
}

/**
 * getCharacter
 */
function getCharacter() {
    /** get the username **/
    return $.post( "classes/GameDealer.php",{
        function: "getCharacters",
        param: getCookie("session")}
    ).done(function(data) {
        if(data.toString() === '1'){
            $state = 1;
        } else {
            $state = 2;
            $characters = $.parseJSON(data);
            $($characters).each(function(){
                $('.navbar-top').find('#characterName').append(this.name);;
            });
        }
    }).fail(function(error) {
        $gameError.toggle(true).text(error.responseText);
    });
}

/**
 * getUsername
 */
function getUsername() {
    /** get the username **/
    return $.post( "classes/GameDealer.php",{
            function: "getUserName",
            param: getCookie("session")}
    ).done(function(data) {
        // Username is okay
        $username = $('.navbar-top').find('#username').append($.parseJSON(data));
    }).fail(function(error) {
        $gameError.toggle(true).text(error.responseText);
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


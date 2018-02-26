/**
 * Game Class to control the Game
 */

/** store username in global var **/
var $username;
var $state;
var $characters = [];

var $screen = $('#screen');
var $text = {};
var $textEl = $('#text');
var $textSpeed = 40;
var $textDeref = 1;

var $landscapesPath = 'resources/images/landscapes/';

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
    console.log("stateSelectChar");
    /** set the Background **/
    setBackground();
}

/**
 * storeCharacter
 */
function storeCharacter() {
    /** store the Character **/
    return $.post( "classes/GameDealer.php", {
        function: "storeCharacter",
        param: getCookie("session") +',' +$characters.sortOf + ',' + $characters.nick
    }).done(function(data) {
        return true;
    }).fail(function(error) {
        $('#game-alert').toggle(true).text(error.responseText);
        return false;
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
            $characters = data;
        }
    }).fail(function(error) {
        $('#game-alert').toggle(true).text(error.responseText);
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

/**
 * showText
 * @param message
 * @param index
 * @param interval
 * @returns {*}
 */
function showText (message, index, interval) {
    if($textDeref === 1){
        $textDeref = $.Deferred();
        return showTextRek(message, index, interval,$textDeref);
    } else {
        return $.Deferred().promise();
    }

}
function showTextRek (message, index, interval,def) {
    if (index < message.length) {
        $($textEl).append(message[index++]);
        setTimeout(function (){
            showTextRek(message, index, interval,def);
        }, interval);
    } else {
        $textDeref = 1;
        def.resolve();
    }
    return def.promise();
}

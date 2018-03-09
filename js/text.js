/**
 * File to hold all text Functions
 */

/**
 * TextHandler
 * @param preTextState
 * @param messages
 * @param messageIndex
 */

/** @todo: bug in text **/
var messageIndex = 0;
function textHandler(preTextState, messages){
    if(messages.length > messageIndex){
        var thisText = messages[messageIndex].toString();
        showText($text[preTextState][thisText]).done(function(){
            textHandler(preTextState, messages, ++messageIndex);
        });
    } else {
        messageIndex = 0;
    }
}

/**
 * showText
 * @param message
 * @returns {*}
 */
function showText (message) {
    if(typeof($textPartIsDone) === 'undefined'){
        $textPartIsDone = $.Deferred();
        return showTextRek(message, 0, $textSpeed, $textPartIsDone);
    } else {
        return $.Deferred().resolve().promise();
    }
}

/**
 * showTextRek
 * @param message
 * @param index
 * @param interval
 * @param def
 * @returns {*}
 */
function showTextRek (message, index, interval, def) {
    if (index < message.length) {
        if(message[index] === "/"){
            $($textEl).append('</br>');
            index++;
            /** stop actual text if text is manually cleared (for onclick) **/
        } else if ($($textEl).text().length === 0 && index !== 0) {
            index = message.length;
        } else {
            $($textEl).append(message[index++]);
        }
        setTimeout(function (){
            showTextRek(message, index, interval, def);
        }, interval);
    } else {
        $textPartIsDone = undefined;
        def.resolve();
    }
    return def.promise();
}
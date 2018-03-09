$firstPreTextState = 'FirstStart';
$firstTextState = 'Welcome';
$firstTextOrder = ['Welcome', 'Choose', 'Choosed', 'Char-', 'Choosed-sure',
    'Choosed-okay','Choosed-askForNick'];

/**
 * stateFirstStart
 */
function stateFirstStart(){
    /** set the Background **/
    setBackground();

    /** add Chars **/
    $screen.append("<div class='choose-chars' id='Ragnar' data-type='0'></div>" +
        "<div class='choose-chars' id='Lagatha' data-type='1'></div><div class='choose-chars' id='Ivar' data-type='2'></div>");

    /** show Text derefered **/
    textHandler($firstPreTextState, ['Welcome']);

    /** set on click events **/
    $('.choose-chars').on('click', function(){
        var onClickEl = $(this);
        $textEl.text('');

        if (onClickEl.hasClass('selected')){
            /** Character is chosen **/
            textHandler($firstPreTextState, ['Choosed-okay', 'Choosed-askForNick']);
            nickname = prompt($text['FirstStart']['Choosed-askForNick'],onClickEl.attr('id'));
            while ((nickname === null || nickname.length <= 0 )&& onClickEl !== nickname){
                nickname = prompt($text['FirstStart']['Choosed-askForNick'], onClickEl.attr('id'));
            }

            /** check if storing Character is okay **/
            storeCharacter(nickname, onClickEl.data('type')).done(function(charId){
                /** store the character in js Object **/
                $characters.push(new Character(nickname, onClickEl.data('type'), parseInt(JSON.parse(charId))));
                $state = 2;
                location.reload();
            }).fail(function(fail){
                $gameError.toggle(true).text('Something wen\'t wrong with storing Char: '+fail);
            });
        } else {
            /** change char select **/
            /** if i click on the selected char **/
            $('.choose-chars.selected').removeClass('selected');

            /** add select Class on Char **/
            onClickEl.addClass('selected');

            /** Text if you're sure **/
            textHandler($firstPreTextState, ['Choosed', 'Char-'+onClickEl.attr('id'), 'Choosed-sure']);
        }
    });
}

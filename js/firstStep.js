/**
 * stateFirstStart
 */
function stateFirstStart(){
    /** set the Background **/
    setBackground();

    /** add Chars **/
    $screen.append("<div class='choose-chars' id='Ragnar' data-type='Warrior'></div>" +
        "<div class='choose-chars' id='Lagatha' data-type='Assasine'></div><div class='choose-chars' id='Ivar' data-type='Villain'></div>");
    /** set character Icons **/
    $('.choose-chars').each(function(){
        $(this).css('background-image', 'url(resources/images/characters/char-'+$(this).attr('id')+'.png');
    });

    /** show Text derefered**/
    showText($text['FirstStart']['Welcome'], 0, $textSpeed).done( function(){
        $textEl.append('</br>');
        showText($text['FirstStart']['Choose'], 0, $textSpeed).done(function(){
            /** if clicked on Char **/
            $("div[class='choose-chars']").on('click', function(){
                onClickEl = $(this);
                $textEl.text('');
                $('.choose-chars').removeClass('selected');

                /** set character Icons **/
                $('.choose-chars').each(function(){
                    $(this).css('background-image', 'url(resources/images/characters/char-'+$(this).attr('id')+'.png');
                });

                onClickEl.addClass('selected').css('background-image', 'url(resources/images/characters/char-'+onClickEl.attr('id')+'-selected.png');

                showText($text['FirstStart']['Choosed'], 0, $textSpeed).done(function(){
                    showText($text['FirstStart']['Char-'+onClickEl.attr('id')], 0, $textSpeed).done(function(){
                        /** last Text is spoken **/
                        $textEl.append('</br>');
                        showText($text['FirstStart']['Choosed-sure'], 0, $textSpeed).done(function(){

                            $('.choose-chars.selected').on('click', function(event){
                                $('.choose-chars').off('click');
                                $textEl.text('');

                                /** Character is chosen **/
                                showText($text['FirstStart']['Choosed-okay'], 0, $textSpeed).done(function(){
                                    $textEl.append(onClickEl.attr('id'));
                                    $textEl.append('</br>');
                                    nickname = prompt($text['FirstStart']['Choosed-askForNick'], $(this).attr('id'));
                                    $characters.push(new Character(nickname, onClickEl.data('type')));
                                    /** check if storing Character is okay **/
                                    if(storeCharacter() === true){
                                        $state = 2;
                                        stateController();
                                    } else {
                                        $('#game-alert').toggle(true).text('Something wen\'t wrong');
                                    }
                                });
                            });
                        })
                    });
                });
            });
        });
    });
}
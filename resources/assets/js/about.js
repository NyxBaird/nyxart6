$('.sidebarItem').on('click', function(){
    var $target = $(this);

    $('.sidebarItem.active').each(function(key, value){
        $(value).removeClass('active');
    });

    $('#aboutContent > p').each(function(key, value){
        $(value).css('display', 'none');
    });

    if ($target.hasClass('elize')) {
        $('#title').html('About Elize');
        $('#elize').css('display', 'block');
        $target.addClass('active');
    }

    if ($target.hasClass('nyxart')) {
        $('#title').html('About Abysmal Wonderland');
        $('#nyxart').css('display', 'block');
        $target.addClass('active');
    }

    if ($target.hasClass('attrs')) {
        $('#title').html('Attributions');
        $('#attrs').css('display', 'block');
        $target.addClass('active');
    }
});

$('.sidebarItem.elize').click();

//Once the page is done loading
$(document).ready(function(){
    collapseMenu();
    checkForTitleScroll();

    //Look for a link containing our current url
    var $target = $('a[href="' + window.location.href + '"]');

    //If that link exists toggle that link open in the sidebar, else toggle the first link in the sidebar
    if ($target.length)
        $target.parent().toggleClass('active')
            .parent('ul').toggleClass('active')
            .parent().toggleClass('active');
    else
        $('#sidebarContent > ol > li > ul > li').first().toggleClass('active')
            .parents('.year').first().click();
});

$(window).resize(function(){
    checkForTitleScroll();
});

$('.blogLinkLi').click(function(e){
    window.location = $('a', $(e.target)).attr('href');
});

$('#frontendContent').click(function(e){
    if ($('#sidebar').position().left === 0 && !$(e.target).parents('#sidebar').length)
        collapseMenu();
});

$('#menuBurger').click(function(e) {
    e.preventDefault();

    if(this.classList.contains("active") === true)
        collapseMenu();
    else
        expandMenu();
});

$('#sidebarContent .year').on('click', function(){
    if (!$(this).hasClass('active'))
        $('.year.active').first().find('ul').first().toggleClass('active').parent().toggleClass('active');

    $(this).find('ul').first().toggleClass('active').parent().toggleClass('active');
});

function checkForTitleScroll() {
    if ($('#title')[0].offsetLeft + $('#title')[0].offsetWidth > $('#header')[0].offsetWidth - $('#header')[0].offsetHeight && !$('marquee', $('#title')).length) {
        var title = $('#title').html(),
            titleW = $('#title').offsetWidth;

        $('#title').css({width: titleW + 'px'});
        $('#title').html("<marquee align='left' speed='3' style='width: 100%;'>" + title + "</marquee>")
    } else {
        if ($('marquee', $('#title')).length) {
            var $marquee = $('#title').children('marquee').first(),
                title = $marquee.html();
\
            $marquee.remove();
            $('#title').html(title);
        }
    }
}

function collapseMenu(){
    $('#menuBurger').removeClass("active");
    $('#sidebar').animate({left: '-' + ($('#sidebar').width() - 1) + 'px'});
}

function expandMenu(){
    $('#menuBurger').addClass("active");
    $('#sidebar').animate({left: '0'});
}
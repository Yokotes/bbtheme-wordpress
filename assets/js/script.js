$(document).ready(()=> {
    // Website scripts

    // Replacing default search button to custom button
    const searchButton = $('#searchsubmit');
    const searchForm = $('#searchform div');
    const newSearchBtn = $.parseHTML('<button type="submit" class="custom-search-btn"><i class="fas fa-search"></i></button>');

    searchButton.remove();
    searchForm.append(newSearchBtn);

    // Replacing lang switcher to custom icon
    const switchLink = $('[href="#pll_switcher"]');
    const langSwitcher = $('.lang-switch').children().children();
    const newSwitchLink = $.parseHTML('<div class="custom-lang-switch"><i class="fas fa-globe"></i></div>');

    switchLink.remove();
    langSwitcher.prepend(newSwitchLink);

    // Set active class to search input
    const searchInput = $('.widget_search input[type="text"]');

    searchInput.change(function () {
        if ($(this).val() != '')
            $(this).addClass('active')
        else $(this).removeClass('active')
    });

    // Setup burger button and menu
    const burgerBtn = $('.burger-btn');
    const headerMenu = $('.header__menu');

    burgerBtn.click(function() {
        $(this).toggleClass('burger-btn--active');

        if (!headerMenu.attr('style'))
            headerMenu.css({
                'bottom': `-${$('.header__menu').height() + 40}px`,
            })
        else 
            headerMenu.removeAttr('style');
    });
})
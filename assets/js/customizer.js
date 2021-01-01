$(function($) {

    // Header title
    wp.customize('bbtheme-header-title', function(value) {
        value.bind(function(newVal) {
            $('.logo-title__title').html(newVal);
        });
    });

    // Footer copyright
    wp.customize('bbtheme-footer-copy', function(value) {
        value.bind(function(newVal) {
            $('.footer-copy').html(newVal);
        });
    });

    // Footer text
    wp.customize('bbtheme-footer-text', function(value) {
        value.bind(function(newVal) {
            $('.footer-text').html(newVal);
        });
    });
})
$('[data-link]').click(function(){
    document.location.href = $(this).attr('data-link');
});

$('[data-click-content]').click(function(){
    $(this).html($(this).attr('data-click-content'));
    metrika.action($(this).attr('data-target-metrika'))
});
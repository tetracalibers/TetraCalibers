$(function(){
    var checkBox = $('.checkTag');
    checkBox.find('input:checked').parent().addClass('checkedTag');
    checkBox.find('input').on('change', function(){
        $(this).parent().toggleClass('checkedTag');
    });
});

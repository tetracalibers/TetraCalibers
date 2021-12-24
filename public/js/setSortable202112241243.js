$(function(){
    var currentPath = location.pathname;
    var pathParts = currentPath.split("/");
    $(".sortable").sortable();
    $("#saveSort").click(function() {
        var result = $(".sortable").sortable("toArray");
        $.ajax({
            type: 'POST',
            url: '/' + pathParts[1] + "/sort",
            cache: false,
            dataType: 'json',
            headers: {
                'X-Frame-Options': 'SAMEORIGIN',
                'X-Content-Type-Options': 'nosniff',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: JSON.stringify(result)
        }).then(
            function() {
                location.reload();
            },
            function() {
                location.reload();
            }
        );
    });
});

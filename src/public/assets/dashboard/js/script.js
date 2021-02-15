Lang.setFallback('en');

jQuery(function($){

    /*$(".auto-close-alert").fadeTo(5000, 500).slideUp(500, function(){
        $(this).remove();
    });*/

    //filter area
    $('.btn-filter').click(function (e) {
        e.preventDefault();
        $('.filter-area').toggle('.active');
    });

    $('.btn-loader-handle').click(function (e) {
        showLoader();
    });

    //delete table item
    $(document).on('click','.delete',function(e){
        e.preventDefault();

        if (confirm(Lang.get('shared.delete') + ': ' + $(this).data('name')+"?")){

            $.ajax({
                url: $(this).data('url'),
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function( xhr ) {
                    showLoader();
                },
                success: function(response){
                    document.location.reload();
                },
                error:function(response, success, failure) {
                    document.location.reload();
                },
                complete: function () {
                    hideLoader();
                }
            });
        }
    });

});



(function ($) {
    //get path url browser
    let url = window.location.pathname;
    const id = url.substring(url.lastIndexOf('/') + 1);
    // ajax choose color and size
    $('input[name=color]').on('change', handleChangeProductOptions);
    $(window).on('load', loadProductDetailOption);
    function handleChangeProductOptions() {
        let _self = $(this);
        const color = _self.val();
        let pathOptions = '/select-color';
        const urlColor = '?color='+encodeURIComponent( color );
        const urlId = '&id=' + id;
        pathOptions +=urlColor+urlId;
        fetchProductOption(pathOptions, color)
    }
    function loadProductDetailOption() {
        const color = $('.color--picker:checked').val();
        let pathOptions = '/select-color';
        const urlColor = '?color='+encodeURIComponent( color );
        const urlId = '&id=' + id;
        pathOptions +=urlColor+urlId;
        fetchProductOption(pathOptions, color)
    }
    function fetchProductOption(pathOptions, color) {
        $.get(pathOptions, function (data) {
            $('select[name="size"]').empty();
            $('#sku').html(data[0].sku);
            $('#sl').html(data[0].quantity_current);
            $.each(data, function (key, values) {
                $('select[name="size"]').append(
                    '<option value="'+values.size_value+'">'+values.size_value+'</option>'
                );
            });
            $('#selSize').change(function (e) {
                let size = e.target.value;
                $.get('/select-size?size='+ size +'&color='+ encodeURIComponent( color ) +'&id='+ id, function (data) {
                    for(let i = 0; i < data.length;i++){
                        $('#sku').html(data[i].sku);
                        $('#sl').html(data[i].quantity_current);
                    }
                });
            });
        });
    }

})(jQuery);
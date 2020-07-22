(function ($) {
    let url = window.location.pathname;
    const id_gender = url.substring(url.lastIndexOf('/') + 1);
    //    ajax choose supplier
    $('input[name=check_supplier]').on('change', function () {
        let supplie_id = $(this).val();
        $.get('/supplier?supplier='+supplie_id, function (data) {
            if(supplie_id){
                $('#supplier_component').empty();
                $.each(data, function (key, values) {
                    $('#supplier_component').append(
                        ` <div class="col-6 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                                    <a href="/san-pham/${values.product_id}" class="w-100">
                                        <div class="scale__image">
                                            <img style="width:100%;height: 210px;" src="${'/storage/uploads/'+values.product_image}"/>
                                        </div>
                                        <div class="info__products--component mt-2 p-0">
                                            <h5>${values.product_name.slice(0,15)+'. . .'}</h5>
                                            <div class="show__price d-flex">
                                                ${values.promotion_price > 0 ? `<p class="header--price_1">${values.unit_price}<small>đ</small></p><p class="header--price_2">${values.promotion_price}<small>đ</small></p>` : `<p class="header--price_2">${values.unit_price}<small>đ</small></p>`}

                                            </div>
                              </div>
                            </a>
                        </div>`
                    )
                })
            }
        });
    });
    //show all product follow gender
    var dataContainer =  $('.show_component');
    $.ajax({
       type:'GET',
        url:'/show-product-gender/'+id_gender,
        beforeSend: function() {
            // setting a timeout
            $('.show_component').append(`
                <img id="loading" style="width: 220px; height: 220px;position: absolute;z-index: 9999" src="/frontend/images/giphy.gif">
`);
        },
        success: function(data) {
            // $('.show_component').empty();
            $('#pagination_gender').pagination({
                dataSource: data,
                pageSize: 9,
                pageRange:1,
                autoHidePrevious:true,
                autoHideNext:true,
                ajax: {
                    beforeSend: function() {
                        console.log('Loading data from flickr.com ...');
                    }
                },
                callback: function(data, pagination) {
                    // template method of yourself
                    dataContainer.empty();
                    for(let i = 0; i < data.length; i++){
                        $('.show_component').append(
                            `<div class="col-6 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                                    <a href="/san-pham/${data[i].product_id}" class="w-100">
                                        <div class="scale__image">
                                            <img style="width:100%;height: 210px;" src="/storage/uploads/${data[i].product_image}"/>
                                        </div>
                                        <div class="info__products--component mt-2 p-0">
                                           <h5>${data[i].product_name.slice(0,15)+'. . .'}</h5>
                                            <div class="show__price d-flex">
                                                ${data[i].promotion_price > 0 ? `<p class="header--price_1">${data[i].unit_price}<small>đ</small></p><p class="header--price_2">${data[i].promotion_price}<small>đ</small></p>` : `<p class="header--price_2">${data[i].unit_price}<small>đ</small></p>`}
                                           </div>
                                        </div>
                                    </a>
                                </div>`
                        );
                    };
                }
            });
        },
        complete: function() {
            $('#loading').hide();
        },
    });
    //sort follow price
    $('#select_sort').on('change', function (){
        let select_sort = $(this).val();
        $.get('/show-product-gender/'+id_gender+'?sort=' + select_sort, function (data){
            console.log(data)
            if(select_sort != ''){
                $('.show_component').empty();
                $('#pagination_gender').pagination({
                    dataSource: data,
                    pageSize: 9,
                    pageRange:1,
                    autoHidePrevious:true,
                    autoHideNext:true,
                    ajax: {
                        beforeSend: function() {
                            console.log('Loading data from flickr.com ...');
                        }
                    },
                    callback: function(data, pagination) {
                        // template method of yourself
                        dataContainer.empty();
                        for(let i = 0; i < data.length; i++){
                            $('.show_component').append(
                                `<div class="col-6 col-lg-3 col-md-4 col-xl-3 col-xs-6 col-sm-6 product__layout">
                                    <a href="/san-pham/${data[i].product_id}" class="w-100">
                                        <div class="scale__image">
                                            <img style="width:100%;height: 210px;" src="/storage/uploads/${data[i].product_image}"/>
                                        </div>
                                        <div class="info__products--component mt-2 p-0">
                                           <h5>${data[i].product_name.slice(0,15)+'. . .'}</h5>
                                            <div class="show__price d-flex">
                                                ${data[i].promotion_price > 0 ? `<p class="header--price_1">${data[i].unit_price}<small>đ</small></p><p class="header--price_2">${data[i].promotion_price}<small>đ</small></p>` : `<p class="header--price_2">${data[i].unit_price}<small>đ</small></p>`}
                                           </div>
                                        </div>
                                    </a>
                                </div>`
                            );
                        };
                    }
                });
            }
        })
    });
})(jQuery);

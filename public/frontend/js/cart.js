(function ($) {
    let url = window.location.pathname;
    const id = url.substring(url.lastIndexOf('/') + 1);
    //-------------------------------------------------
    $('#add_to_cart').click(addToCart);
    let cart = [];
    if (localStorage.getItem('cart')) {
        cart = JSON.parse(localStorage.getItem('cart'));
        showCart();
    }
    //add cart
    function addToCart() {
        let prodid = id;
        let prodname = $('#prodName').text();
        let prodsku = $('#sku').text();
        let prodcolor = $('#name_color').text();
        let prodsize = $('#size_selected').text();
        let prodprice = parseFloat($('#prodPrice').text());
        let prodimage = $('#prodImage').attr('src');
        let prodqty = $('#input_quantity').attr('value');
        let prodSaleValue = $('#get_sale_value').text();
        let prodSalePrice = $('#get_sale_price').text();

        let item = cart.find(product=> {
            return product.prodID === prodid && product.proSize === prodsize && product.proColor === prodcolor;
        });
        if(!item){
            item = {
                prodID: prodid,
                prodName  :prodname,
                proSKU  :prodsku,
                proColor  :prodcolor,
                proSize  :prodsize,
                prodPrice :prodprice,
                prodImage :prodimage,
                prodQty : parseInt(prodqty),
                prodSaleValue : parseInt(prodSaleValue),
                prodSalePrice : parseInt(prodSalePrice),
                // prodTotalPrice: prodprice * prodqty,
            };
            cart.push(item);
        } else {
            item.prodQty = item.prodQty + parseInt(prodqty);
        }
        saveCart();
        showCart();
    }
    //save cart
    function saveCart() {
        let parsed = JSON.stringify(cart);
        localStorage.setItem('cart', parsed);
    }
    //delete item cart
    function deleteItem(index){
        cart.splice(index,1); // delete item at index
        showCart();
        saveCart();
    };
    //count quantity cart
    function countTotalItem() {
        var total = 0;
        for(let i = 0; i < cart.length; i++){
            total += (Number(cart[i].prodQty));
        }
        return total;
    }
    //count total price cart
    function totalPrice() {
        var sum = 0.0;
        for(let i = 0; i < cart.length; i++){
            if(cart.prodSalePrice != null){
                sum += (Number(cart[i].prodSalePrice) * Number(cart[i].prodQty));
            }else{
                sum += (Number(cart[i].prodPrice) * Number(cart[i].prodQty));
            }
        }
        return sum;
    }
    $('#order_total').attr('value',totalPrice());
    //total price simple product
    function totalPriceSingle() {
        // let value = $('#input_quantitys').val();
        for(let i = 0; i < cart.length; i++){
            return Number(cart[i].prodQty) * Number(cart[i].prodPrice);
        }
    }
    //plus and minius value
    $('.buttons').click(function () {
        var $button = $(this);
        let oldValue = $button.parent().find("input").val();
        let maxAtrribute = $('#input_quantitys').attr('max');
        if ($button.text() == "+") {
            if(oldValue < maxAtrribute){
                var newVal = parseFloat(oldValue) + 1;

            }else{
                alert('Sản phẩm đã vượt tồn kho!');
                return false;
            }
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
                if(newVal < 1){
                    return false
                }
            } else {
                newVal = 1;
            }
        }
       $button.parent().find("input").attr('value',newVal);
    });
    //update cart
    function updateCart() {

    }
    //show cart in page
    function showCart() {
        //each component cart
        $('.carts').empty();
        $('.cart_component').empty();
        $('.show_total_price').empty();
        $('#render_lastcart').empty();
        $.each(cart,  (key, data) => {
            $('.carts').append(
                `<div class="container-fluid d-flex justify-content-between px-0">
                         <div class="header--img-cart">
                            <img class="img_cart" style="width: 60px; height: 60px;" src="${data.prodImage}">
                         </div>
                         <div class="header__info-cart p-2">
                            <h6><strong id="prod_name"></strong></h6>
                            <!--<p class="header&#45;&#45;price_1 my-0">4.000.000 VND</p>-->
                            <p class="header--price_2 my-0" style="font-size: 13px">${data.prodPrice}<small>đ x </small><strong>${data.prodQty}</strong></p>
                            <div class="d-flex">
                                <p style="font-size: 12px;margin-right: 3px">size: ${data.proSize} /</p>
                                <p style="font-size: 12px">màu: ${data.proColor}</p>
                            </div>
                        </div>
                        <div class="header__remove-item">
                            <i itemid="${key}" class="item-cart-del fa fa-trash-o" aria-hidden="true"></i>
                        </div>
                    </div>
                    `
            );
            $('.cart_component').append(
                `<div class="py-3">
                        <div class="row">
                            <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 col-xl-2">
                                <img style="width: 110px; height: 110px;" src="${data.prodImage}"/>
                            </div>
                            <div class="col-md-6 col-lg-5 col-sm-12 col-xs-12 col-xl-5 d-flex align-items-center">
                                <div class="d-flex justify-content-start flex-column">
                                    <div class="">
                                        <h6>${data.prodName}</h6>
                                        <div class="d-flex">
                                            <p class="header--price_1 mb-0 py-1 pr-2">${(data.prodSalePrice != null) ? data.prodSalePrice : ''}</p>
                                            <p class="header--price_2 mb-0">${data.prodPrice}<small> đ </small></p>
                                        </div>
                                        <div class="mb-0 d-flex">
                                            <label> Màu: ${data.proColor} </label>
                     
                                            <label>/ Size:</label>
                                            <div class="border border-secondary rounded text-center mx-2" style="width: 20px; height: 20px;line-height: 20px;">${data.proSize}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-lg-2 col-sm-12 col-xs-12 col-xl-2 d-flex align-items-center">
                                <div class="input_quantity">
                            
                               <div class="quantity d-flex">
                                   <button class="buttons">-</button>
                                   <input id="input_quantitys" style="width: 40px" name="qty" type="number" max="2" min="1" value="${data.prodQty}" readonly="readonly">
                                   <button class="buttons">+</button>
                               </div>
                            </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 col-xl-2 d-flex align-items-center">
                                <div class="header__cart">
                                    <h6><strong>${totalPriceSingle()}</strong></h6>
                                </div>
                            </div>
                            <div class="col-md-1 col-lg-1 col-sm-12 col-xs-12 col-xl-1 d-flex align-items-center">
                               <span itemid="${key}" class="item-cart-del" style="cursor:pointer">xóa</span>
                            </div>
                        </div>
             </div>`
            );
            $('.show_total_price').empty();
            $('.show_total_price').append(` <h5> Tổng Tiền: <strong>${totalPrice()} VND</strong> </h5>`);
            $('#render_lastcart').append(
              `<div class="d-flex justify-content-between p-3">
                 <img src="${data.prodImage}" style="width:50px;height: 50px">
                 <div class="text-right">
                   <p>${data.prodName.slice(0,20)+'. . .'}</p>
                   <small><del></del></small>
                   <span>${data.prodPrice}<small>đ</small></span>
                   <strong><small>X</small> ${data.prodQty}</strong>
                   </div>
              </div>
              <div style="border: 1px dashed #ddd"></div>`
            );
        });

        //each total cart total component
        if(cart.length > 0){
            $('.number_item').empty();
            $('.number_item').append(countTotalItem());
            $('.total_cart').empty();
            $('.total_cart').append(
                `
                         <a href="/checkouts"><button class="btn mb-2 w-100"> Đặt Hàng</button></a>
                         <a href="/cart">
                            <button class="btn w-100"> Xem Giỏ Hàng</button>
                         </a>
                     <strong>Tổng: ${totalPrice()}VND</strong>
                      `
            );
        }else{
            $('.number_item').empty();
            $('.number_item').append(`0`);
            $('.total_cart').empty();
            $('.total_cart').append(`<strong>Giỏ hàng đang trống</strong><i class="fa fa-frown-o" aria-hidden="true"></i>`);
            $('#auto-hide').addClass('invisible');
        }
        //event click delete item
        $('.item-cart-del').on('click', function () {
            const _self = $(this);
            const index = _self.attr('itemid');
            deleteItem(index);
        });
    //    each component cart page
    };

//    API POST checkout bill
//     $(window).on('load',checkoutsBill());
    $('#btn-submit_checkouts').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if(window.localStorage) {
            var fields_cart = JSON.parse(localStorage.getItem('cart'));
            // var arr_cart = [fields_cart];
            var customer_name = $('#order_name').val();
            var customer_mail = $('#order_email').val();
            var customer_phone = $('#order_phone').val();
            var customer_address = $('#order_address').val();
            var customer_payment = $('#order_payment').val();
            var customer_note = $('#order_note').val();
            var customer_total = $('#order_total').val();
            $.post('checkouts',{
                cus_name:customer_name,
                cus_mail:customer_mail,
                cus_phone:customer_phone,
                cus_address:customer_address,
                cus_payment:customer_payment,
                cus_note:customer_note,
                cus_total:customer_total,
                cus_carts:fields_cart
            },function (data) {
                $("#form_checkout").trigger("reset");
                localStorage.removeItem('cart');
            })
        }
    });

})(jQuery);
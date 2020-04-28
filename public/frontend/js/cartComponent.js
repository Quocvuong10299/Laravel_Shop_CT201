// (function ($) {
//     let url = window.location.pathname;
//     const id = url.substring(url.lastIndexOf('/') + 1);
//     //-------------------------------------------------
//     if (localStorage.getItem('cart')) {
//         cart = JSON.parse(localStorage.getItem('cart'));
//         render();
//     }
//     function totalPrice_single() {
//         // var sum = 0.0;
//         for(let i = 0; i < cart.length; i++){
//           return Number(cart[i].prodPrice) * Number(cart[i].prodQty);
//         }
//         // return sum;
//     }
//     function render() {
//         //each component cart
//         $('.cart_component').empty();
//         $.each(cart,  (key, data) => {
//             $('.cart_component').append(
//              `<div class="py-3">
//                         <div class="row">
//                             <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 col-xl-2">
//                                 <img style="width: 110px; height: 110px;" src="${data.prodImage}"/>
//                             </div>
//                             <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 col-xl-6 d-flex align-items-center">
//                                 <div class="d-flex justify-content-start flex-column">
//                                     <div class="">
//                                         <h6>${data.prodName}</h6>
//                                         <div class="d-flex">
//                                             <p class="header--price_1 mb-0 py-1 pr-2">120.000<small> đ </small></p>
//                                             <p class="header--price_2 mb-0">${data.prodPrice}<small> đ </small></p>
//                                         </div>
//                                         <div class="mb-0 d-flex">
//                                             <label> Màu: ${data.proColor} </label>
//
//                                             <label>/ Size:</label>
//                                             <div class="border border-secondary rounded text-center mx-2" style="width: 20px; height: 20px;line-height: 20px;">${data.proSize}</div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                             <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 col-xl-2 d-flex align-items-center">
//                                 <div class="header__cart">
//                                     <input style="width: 100px; height: 30px;" type="number" min="1" value="${data.prodQty}">
//                                 </div>
//                             </div>
//                             <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12 col-xl-2 d-flex align-items-center">
//                                 <div class="header__cart">
//                                     <h6><strong>${totalPrice_single()}VND</strong></h6>
//                                 </div>
//                             </div>
//                         </div>
//              </div>`
//             );
//         });
//
//     };
// })(jQuery);
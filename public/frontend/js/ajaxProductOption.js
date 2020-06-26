(function ($) {
       //get path url browser
       let url = window.location.pathname;
       const id = url.substring(url.lastIndexOf('/') + 1);
       // console.log(url.substring(url.lastIndexOf('/') - 1));
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
           fetchProductOption(pathOptions, color);
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
               $('#size_selected').hide();
               $('#sku').html(data[0].sku);
               $('#name_color').html(data[0].color_name);
               $('#sl').html(data[0].quantity_current);
               $('#input_quantity').attr('max',data[0].quantity_current);
               $('#size_selected').html(data[0].size_value);
               $.each(data, function (key, values) {
                   $('select[name="size"]').append(
                       '<option value="'+values.size_value+'">'+values.size_value+'</option>'
                   );
               });
           });
       }

       $('#selSize').change(function (e) {
           let size = e.target.value;
           const color = $('.color--picker:checked').val();
               $.get('/select-size?size='+ size +'&color='+ encodeURIComponent( color ) +'&id='+ id, function (data) {
               $('#sl').html(data[0].quantity_current);
               $('#sku').html(data[0].sku);
               $('#size_selected').html(data[0].size_value);
               $('#input_quantity').attr('max',data[0].quantity_current);
           });
       });
//    click minus and plus quantity
       $('.button').click(function () {
           var $button = $(this);
           let oldValue = $button.parent().find("input").val();
           let maxAtrribute = $('#input_quantity').attr('max');
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
    //show comment ajax
    window.onload = comments();
    function comments() {
        $.get('/product/comment/'+id ,function (data) {
            var dataContainer =  $('#show_comment');
            $('#pagination').pagination({
                dataSource: data,
                pageSize: 10,
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
                        dataContainer.append(
                            `  <div class="d-flex mb-1 cmt_content">
                                       <div class="avatar d-flex justify-content-center align-items-center">
                                           <strong>${data[i].user_name.slice(0,1).toUpperCase()}</strong>
                                       </div>
                                       <div>
                                           <div class="ml-3 content__comment--component max-270">
                                               <small><strong>${data[i].user_name}</strong></small>
                                               <div class="content__comments">
                                                   <span>${data[i].comment_content}</span>
                                               </div>
                                           </div>
                                           <div class="time__post text-right">
                                               <small class="text-muted"></small>

                                           </div>
                                       </div>
                                   </div>`
                        )
                    }
                }
            })
        })
    }
})(jQuery);

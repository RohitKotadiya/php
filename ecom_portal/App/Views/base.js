       
 $("#viewCart").click(
     function(){
        $.ajax({
             url: '/cybercom/php/ecom_portal/Public/userCart/showCart',
             dataType : "json",

             success : function(cartData) {
                 console.log(cartData);
                 var data = `<tr>
                                 <th scope="col"></th>
                                 <th scope="col">Product</th>
                                 <th scope="col">Price</th>
                                 <th scope="col">Qty</th>
                                 <th scope="col">Total</th>
                                 <th scope="col">Actions</th>
                             </tr>`;
                 for(i in cartData) {
                     var product = cartData[i];
                         data += `<tr>`;
                         data += `<td class='w-25'>`;
                         data += `<img src='../../${product.productImage}' class='img-fluid img-thumbnail' alt='' 
                                         height='100px' width="120px">`;
                         data += `</td>`;
                         data += `<td> ${product.productName} </td>`;
                         data += `<td> ${product.price} </td>`;
                         data += `<td class="qty"><input type='text' max='2' class='form-control' id='input1' value='${product.quantity}'></td>`;
                         data += `<td>${product.price * product.quantity}</td>`;
                         data += `<td> 
                                     <a href="#" class="btn btn-danger btn-sm">
                                     <i class="fa fa-times"> X </i>
                                 </a> </td>`;
                         data += `</tr>`;

                 }
                 $("#cart-data").html(data);
                 $("#cartModal").modal('show');
             }
         })
     }); 

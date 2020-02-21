


function addToCart(pId, userId, price){
    var quant = $("#quantity").val();
    formData = {productId : pId, userId : userId , quantity : quant , productPrice : price};
    $.ajax({
        url: '/cybercom/php/ecom_portal/Public/userCart/addToCart',
        method : "POST",
        dataType : "json",
        data : formData,

        success : function(msg) {
            alert(msg);
        }
    });
}



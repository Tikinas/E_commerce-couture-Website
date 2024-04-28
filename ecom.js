const bar=document.getElementById('bar');
const nav=document.getElementById('navbar');

if (bar) {
    bar.addEventListener('click',()=>{
        nav.classList.add('active')
    })
}
//******* */
const close=document.getElementById('close');
if (close) {
    close.addEventListener('click',()=>{
        nav.classList.remove('active');
    })
}


function increment_quantity($cart_id) {
    var inputQuantityElement = $("#input-quantity-"+$cart_id);
    var newQuantity = parseInt($(inputQuantityElement).val())+1;
    save_to_db($cart_id, newQuantity);
}

function decrement_quantity(cart_id) {
    var inputQuantityElement = $("#input-quantity-"+cart_id);
    if($(inputQuantityElement).val() > 1) 
    {
    var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
    save_to_db(cart_id, newQuantity);
    }
}

function save_to_db(cart_id, new_quantity) {
	var inputQuantityElement = $("#input-quantity-"+cart_id);
    $.ajax({
		url : "ajax.php.php",
		data : "cart_id="+cart_id+"&new_quantity="+new_quantity,
		type : 'post',
		success : function(response) {
			$(inputQuantityElement).val(new_quantity);
		}
	});
}


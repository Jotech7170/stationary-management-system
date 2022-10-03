var checkboxes = document.querySelectorAll(".form-check-input");
var total_buying_prices = 0;

for (var i = 0; i < checkboxes.length; i++) {
    var item = checkboxes[i];
    // var quantityInput = document.getElementById('quantity'+i);
    // console.log(quantityInput);
    var checkboxchecked = checkboxes[i].addEventListener('change',
        function(item) {
            // console.log(item.srcElement.checked);
            if (item.srcElement.checked == true) {
                // console.log(item.srcElement.checked);
                // console.log(item.srcElement.attributes.value.value);
                var inputNumber = item.srcElement.attributes.value.value;
                // var quantity = "quantity"+item.srcElement.attributes.value.value;
                var inputQuantity = document.getElementById('quantity' + inputNumber);
                var inputBuying_price = document.getElementById('buying_price' + inputNumber);
                var inputSelling_price = document.getElementById('selling_price' + inputNumber);
                var inputExpire_date = document.getElementById('expire_date' + inputNumber);

                inputQuantity.setAttribute("required", "");
                inputQuantity.removeAttribute('disabled');

                inputBuying_price.setAttribute("required", "");
                inputBuying_price.removeAttribute('disabled');

                inputSelling_price.setAttribute("required", "");
                inputSelling_price.removeAttribute('disabled');

                inputExpire_date.setAttribute("required", "");
                inputExpire_date.removeAttribute('disabled');

                var total_cost_of_stock = document.getElementById('total_cost_of_stock').value;
                var buying_prices = document.getElementById('buying_price' + inputNumber);

                inputBuying_price.addEventListener('change', function() {
                    var inputval = buying_prices.value;
                    total_buying_prices += parseInt(inputval);
                    // console.log(total_buying_prices);
                    // console.log(total_cost_of_stock);
                    if (total_cost_of_stock == total_buying_prices) {
                        // console.log("Here!");
                        // console.log(total_buying_prices);
                        // console.log(total_cost_of_stock);
                        var create_stock_button = document.getElementById('create_stock_button');
                        create_stock_button.removeAttribute('disabled');
                    } else {
                        // alert("The sum of buying price of all choosen products are either higher or lower than the total cost of the product");
                    }
                });


                // console.log(inputQuantity);
            } else {
                var inputNumber = item.srcElement.attributes.value.value;
                // var quantity = "quantity"+item.srcElement.attributes.value.value;
                var inputQuantity = document.getElementById('quantity' + inputNumber);
                var inputBuying_price = document.getElementById('buying_price' + inputNumber);
                var inputSelling_price = document.getElementById('selling_price' + inputNumber);
                var inputExpire_date = document.getElementById('expire_date' + inputNumber);

                inputQuantity.setAttribute("disabled", "");
                inputBuying_price.setAttribute("disabled", "");
                inputSelling_price.setAttribute("disabled", "");
                inputExpire_date.setAttribute("disabled", "");

                inputQuantity.value = '';
                inputBuying_price.value = '';
                inputSelling_price.value = '';
                inputExpire_date.value = '';
               
                if (total_cost_of_stock == total_buying_prices) {
                    // console.log("Here!");
                    // console.log(total_buying_prices);
                    // console.log(total_cost_of_stock);
                    var create_stock_button = document.getElementById('create_stock_button');
                    create_stock_button.removeAttribute('disabled');
                } else {
                    var create_stock_button = document.getElementById('create_stock_button');
                    create_stock_button.setAttribute('disabled');
                
                    // alert("The sum of buying price of all choosen products are either higher or lower than the total cost of the product");
                }
            }
        }
    );
}


//Validating quantity to sell not to be greater than quantity remaining
var remaining_products = document.getElementById('remaining_products').textContent;

var quantityToSell = document.getElementById('quantity');

quantityToSell.addEventListener('change', function() {
    var quantityToBeSold = document.getElementById('quantity').value;

    if (quantityToBeSold > parseInt(remaining_products)) {
        var selling_button = document.getElementById('selling_button');
        selling_button.style.display = "none";

        var error_message = document.getElementById('error_message');
        error_message.innerHTML = "You have excided the number of items remaining in your stock!";
    } else {
        var selling_button = document.getElementById('selling_button');
        selling_button.style.display = "block";

        var error_message = document.getElementById('error_message');
        error_message.innerHTML = "";
    }
});
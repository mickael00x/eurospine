console.log("Javascript is working");

window.addEventListener("load", function() {
    console.log("Everything is loaded");
    const formHomepage = document.getElementById('form-homepage');
    const checkoutButton = document.querySelector(".custom-checkout-button");
    const toPutInCart = document.querySelectorAll("input.product-checkbox");
    let cartIDs = [];
    let selectedItems = document.querySelector(".item-in-cart");
    let total = 0;

    
    /**
     * 
     * @param {*} element 
     * @param {*} type 
     * @returns 
     */
    function getSiblings(element, type){ 
        let arraySib = []; 
        if ( type == 'prev' ){ 
            while ( element = element.previousSibling ){
                 arraySib.push(element); 
            } 
        } else if ( type == 'next' ) { 
            while ( element = element.nextSibling ){ 
                arraySib.push(element);
            } 
        } 
        return arraySib; 
    }

    /**
     * Retourne le nombre d'item du panier
     * @returns integer
     */
    function getCartSize() {
        return cartIDs.length;
    }

    function updateTotal(value) {
        const totalPrice = document.querySelector('.button-checkout .recap-total');
        total = parseInt(total) + parseInt(value);
        totalPrice.textContent = total + " €";
    }

    function addItem(checkbox) { 
        checkbox.parentElement.classList.add("product-selected");

        let selectedTitle = getSiblings(checkbox, "prev")[2].innerHTML;
        let priceTag = getSiblings(checkbox, "prev")[0];
        
        let title = document.createElement("div");
        title.classList.add("selected-product-title");

        let item = document.createElement("div");
        item.classList.add("items");
        item.classList.add("items-" + checkbox.value);
        
        let newPrice = document.createElement("div");
        newPrice.classList.add("selected-product-price");
        newPrice.innerHTML = priceTag.innerHTML.replace(/\D/g, "");
        newPrice.innerHTML += "€";
        title.innerHTML = selectedTitle;
        item.append(title);
        item.append(newPrice);
        selectedItems.append(item);

        
    }

    /**
     * 
     * @param {*} productID 
     */
    function removeItem(productID) {
        let inputCheckbox = document.querySelector(`input[value='${productID}']`);
        if (inputCheckbox === null) {
            return false;
        }
        inputCheckbox.checked = false;
        inputCheckbox.parentElement.classList.remove("product-selected");
        let index = cartIDs.indexOf(inputCheckbox.value);
        if(index > -1) {
            let selectedItemsInfos = document.querySelector(".items-" + productID);
            selectedItemsInfos.remove();
            cartIDs.splice(index, 1);
        }
        let price = document.querySelector(".items-" + productID + " .selected-product-price");
        price = parseInt(price.innerHTML.replace(/\D/g, ""));
        updateTotal( "-" + price );
    }

    function updateVisibilitySelectionBar() {
        const selectionBar = document.getElementById('customCheckout');
        if (getCartSize() > 0 && selectionBar.classList.contains('custom-checkout-empty'))
            selectionBar.classList.remove('custom-checkout-empty');
        if (getCartSize() === 0 && !selectionBar.classList.contains('custom-checkout-empty'))
            selectionBar.classList.add('custom-checkout-empty');
    
    }

    toPutInCart.forEach(checkbox => {
        checkbox.addEventListener("click", () => {

            let priceTag = getSiblings(checkbox, "prev")[0];
            let price= priceTag.innerHTML.replace(/\D/g, "");
            
            if (checkbox.checked) {
                console.log("checkbox clicked: ", checkbox.value);
                cartIDs.push(checkbox.value);
                
                // page non-member
                if(checkbox.value == '52') {
                    removeItem(15);
                    removeItem(18);
                    removeItem(31);
                    removeItem(34);
                    removeItem(46);
                    removeItem(43);
                    removeItem(49);
                }
                if(checkbox.value == '15') {
                    removeItem(18);
                    removeItem(52);
                }
                if(checkbox.value == '18') {
                    removeItem(15);
                    removeItem(31);
                    removeItem(43);
                    removeItem(49);
                    removeItem(52);
                }
                if(checkbox.value == '31') {
                    removeItem(18);
                    removeItem(34);
                    removeItem(43);
                    removeItem(49);
                    removeItem(52);
                }
                if(checkbox.value == '43') {
                    removeItem(18);
                    removeItem(31);
                    removeItem(46);
                    removeItem(49);
                    removeItem(52);
                }
                if(checkbox.value == '49') {
                    removeItem(18);
                    removeItem(31);
                    removeItem(43);
                    removeItem(52);
                }
                if(checkbox.value == '34') {
                    removeItem(31);
                    removeItem(46);
                    removeItem(52);
                }
                if(checkbox.value == '46') {
                    removeItem(34);
                    removeItem(43);
                    removeItem(52);
                }
                if(checkbox.value == '25') {
                    removeItem(28);
                    removeItem(37);
                    removeItem(55);
                }
                if(checkbox.value == '28') {
                    removeItem(25);
                    removeItem(40);
                    removeItem(55);
                }
                if(checkbox.value == '37') {
                    removeItem(25);
                    removeItem(40);
                    removeItem(55);
                }
                if(checkbox.value == '40') {
                    removeItem(28);
                    removeItem(37);
                }
                if(checkbox.value == '55') {
                    removeItem(25);
                    removeItem(28);
                    removeItem(37);
                }

                //page member 
                
                if(checkbox.value == '51') {
                    removeItem(14);
                    removeItem(17);
                    removeItem(30);
                    removeItem(33);
                    removeItem(42);
                    removeItem(45);
                    removeItem(48);
                }
                if(checkbox.value == '14') {
                    removeItem(17);
                    removeItem(51);
                }
                if(checkbox.value == '17') {
                    removeItem(14);
                    removeItem(30);
                    removeItem(42);
                    removeItem(48);
                    removeItem(51);
                }
                if(checkbox.value == '30') {
                    removeItem(17);
                    removeItem(33);
                    removeItem(42);
                    removeItem(48);
                    removeItem(51);
                }
                if(checkbox.value == '42') {
                    removeItem(17);
                    removeItem(30);
                    removeItem(45);
                    removeItem(48);
                    removeItem(51);
                }
                if(checkbox.value == '33') {
                    removeItem(30);
                    removeItem(45);
                    removeItem(51);
                }
                if(checkbox.value == '45') {
                    removeItem(33);
                    removeItem(42);
                    removeItem(51);
                }
                if(checkbox.value == '48') {
                    removeItem(17);
                    removeItem(30);
                    removeItem(42);
                    removeItem(51);
                }
                if(checkbox.value == '24') {
                    removeItem(27);
                    removeItem(36);
                    removeItem(54);
                }
                if(checkbox.value == '27') {
                    removeItem(24);
                    removeItem(39);
                    removeItem(54);
                }
                if(checkbox.value == '36') {
                    removeItem(24);
                    removeItem(39);
                    removeItem(54);
                }
                if(checkbox.value == '39') {
                    removeItem(27);
                    removeItem(36);
                }
                if(checkbox.value == '54') {
                    removeItem(24);
                    removeItem(27);
                    removeItem(36);
                }

                addItem(checkbox);
                updateTotal(price);
                if(cartIDs !== []) {
                    checkoutButton.href = "/order/?add-to-cart=" + cartIDs + "&empty-cart";
                }
                
            } else {
                //chercher l"index de la valeur dans le tableau 
                const index = cartIDs.indexOf(checkbox.value);
                if(index > -1) {
                    let selectedItemsInfos = document.querySelector(".items-" + checkbox.value);
                    selectedItemsInfos.remove();                   
                    cartIDs.splice(index, 1);
                    if(cartIDs !== []) {
                        checkoutButton.href = "/order/?add-to-cart=" + cartIDs + "&empty-cart";

                    }
                
                updateTotal(-price);
                }
                checkbox.parentElement.classList.remove("product-selected");
                console.log(cartIDs);
            }
            updateVisibilitySelectionBar();   
        })
    })
    

    if (formHomepage !== null) {
        console.log('homepage');
        const inputYes = document.querySelector("#input-homepage-yes");
        const inputNo = document.querySelector("#input-homepage-no");
        const inputText = document.querySelector("#input-validation");
        let invalidAlert = document.querySelector('.invalid-code');
        const buttonSubmit = document.querySelector("#input-button");
        const couponCode = ['EUROSPINE','EUROSPINE20']

        function invalidCode() {
            if (invalidAlert.classList.contains('display-none'))
                invalidAlert.classList.remove('display-none')      
        }

        function hideInvalidCode() {
            if (!invalidAlert.classList.contains('display-none'))
                invalidAlert.classList.add('display-none')
        }

        function formHomepageSubmit(event) {
            event.preventDefault();
            event.stopPropagation();
            let formData = new FormData(formHomepage);
            const code = formData.get('input-validation');
            const member = formData.get('input-homepage');

            if (code === couponCode[0] && member !== null) {
                window.location = "/shop?member=deleguates";
                return;
            }
        
            if (code === couponCode[1] && member !== null) {
                window.location = "/shop?coupon="+couponCode[1];
                return;
            }

            if (code !== '' && couponCode.indexOf(code) === parseInt('-1')) {
                invalidCode();
                return;
            }

            if (member === '1' && code === "") {
                invalidCode();
                return;
            }
           
            window.location = "/shop";
        }


        hideInvalidCode();
        formHomepage.addEventListener('submit', formHomepageSubmit);
        inputText.addEventListener('keyup', (e) => { hideInvalidCode() });
    }

    


    
    // Checkout Field
    // PostCode
    const postCodeFieldLabel = document.querySelector('#billing_postcode_field label');
    if (postCodeFieldLabel && postCodeFieldLabel.classList.contains("screen-reader-text")) {
        postCodeFieldLabel.classList.remove('screen-reader-text');
    }

    // Conditionnal field
    const conditionnalClass = 'wooccm-conditional-child';
    const otherAllergiesInput = document.querySelector('#billing_wooccm16_field input[value="Other"]');
    const dietarySelect = document.querySelector('#billing_wooccm17_field select');
    const otherAllergiesContainer = document.getElementById('billing_wooccm18_field');
    const otherDietaryContainer = document.getElementById('billing_wooccm19_field');

    if (dietarySelect) {
        dietarySelect.addEventListener('change',
            function (event) {
                elem = otherDietaryContainer;
                if (event.target.value === 'Other') {
                    if (elem.classList.contains(conditionnalClass)) {
                        elem.classList.remove(conditionnalClass)
                    }
                } else {
                    if (!elem.classList.contains(conditionnalClass)) {
                        elem.classList.add(conditionnalClass)
                    }
                }
            }
        );
    }
    if (otherAllergiesInput) {
        otherAllergiesInput.addEventListener('change',
            function (event) {
                elem = otherAllergiesContainer;
                if (event.target.checked) {
                    if (elem.classList.contains(conditionnalClass)) {
                        elem.classList.remove(conditionnalClass)
                    }
                } else {
                    if (!elem.classList.contains(conditionnalClass)) {
                        elem.classList.add(conditionnalClass)
                    }
                }
            }
        );
    }


})
/*
 * File:        js/validation.js
 * Team member: LIN Zixi
 * Purpose:     Validates product quantities on the shopping pages, updates
 *              cart subtotals and grand total in real time, and validates
 *              customer details and quantities before submitting an order.
 */

// Helper: format a number like PHP number_format(), e.g. 9998 -> "9,998.00"
function formatMoney(value) {
    return value.toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

// Helper: is the quantity a whole number between min and max?
function isValidQuantity(input) {
    const raw = input.value.trim();
    if (raw === '') {
        return false;
    }

    const qty = Number(raw);
    const min = Number(input.min) || 1;
    const max = Number(input.max);

    return Number.isInteger(qty) && qty >= min && qty <= max;
}

// Validate quantity before submitting "Add to Cart" forms on shopping pages
function setUpAddToCartForms() {
    const forms = document.querySelectorAll('.add-to-cart-form');

    forms.forEach(function (form) {
        const qtyInput = form.querySelector('.qty-input');
        if (!qtyInput) {
            return;
        }

        // Clear any previous custom validation message when the user edits the input
        qtyInput.addEventListener('input', function () {
            qtyInput.setCustomValidity('');
        });

        // Validate quantity when the form is submitted
        form.addEventListener('submit', function (event) {
            if (!isValidQuantity(qtyInput)) {
                const max = Number(qtyInput.max);
                qtyInput.setCustomValidity('Please enter a whole number from 1 to ' + max + '.');
                qtyInput.reportValidity();
                event.preventDefault();
            } else {
                qtyInput.setCustomValidity('');
            }
        });
    });
}

// Recalculate row subtotals and grand total in real time on cart.php
function updateCartTotals() {
    const qtyInputs = document.querySelectorAll('.real-time-qty');
    let grandTotal = 0;

    qtyInputs.forEach(function (input) {
        const productId = input.id.replace('qty-', '');
        const unitPrice = Number(input.dataset.price);
        const subtotalSpan = document.getElementById('subtotal-' + productId);
        let rowSubtotal = 0;

        // Only include valid quantities in the row subtotal and grand total
        if (isValidQuantity(input)) {
            rowSubtotal = unitPrice * Number(input.value.trim());
            grandTotal += rowSubtotal;
        }

        if (subtotalSpan) {
            subtotalSpan.textContent = formatMoney(rowSubtotal);
        }
    });

    const totalSpan = document.getElementById('cart-total');
    if (totalSpan) {
        totalSpan.textContent = formatMoney(grandTotal);
    }
}

// Attach input listeners to all quantity fields in the shopping cart
function setUpCartQuantities() {
    const qtyInputs = document.querySelectorAll('.real-time-qty');

    qtyInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            // Clear custom error message while typing and refresh totals
            input.setCustomValidity('');
            updateCartTotals();
        });
    });
}

// Validate quantities, customer name, and address when clicking "Buy"
function setUpCheckoutForm() {
    const checkoutForm = document.getElementById('checkout-form');
    if (!checkoutForm) {
        return;
    }

    const customerName = document.getElementById('customer-name');
    const address = document.getElementById('address');

    const customerNameContainer = document.getElementById('customer-name-container') 
    const addressContainer = document.getElementById('address-container')

    // Create red <p> elements for inline error messages
    const nameError = document.createElement('p');
    nameError.style.color = 'red';

    const addressError = document.createElement('p');
    addressError.style.color = 'red';

    // Clear inline error messages when the user types again
    if (customerName) {
        customerName.addEventListener('input', function () {
            nameError.innerText = '';
        });
    }
    if (address) {
        address.addEventListener('input', function () {
            addressError.innerText = '';
        });
    }

    checkoutForm.addEventListener('submit', function (e) {
        // Only run validation when the "Buy" button is clicked;
        // do not block "Remove" buttons or Enter-key updates.
        if (!e.submitter || !e.submitter.classList.contains('buy-button')) {
            return;
        }

        // 1. Check all product quantities in the cart
        const qtyInputs = checkoutForm.querySelectorAll('.real-time-qty');
        for (let i = 0; i < qtyInputs.length; i++) {
            const input = qtyInputs[i];
            if (!isValidQuantity(input)) {
                const max = Number(input.max);
                input.setCustomValidity('Please enter a whole number from 1 to ' + max + '.');
                input.reportValidity();
                e.preventDefault();
                return;
            }
            input.setCustomValidity('');
        }

        // 2. Check customer name (trim whitespace and check 50-char limit)
        let nameErrormessage = [];
        const trimmedName = customerName ? customerName.value.trim() : '';
        if (trimmedName === '' || customerName.value == null) {
            nameErrormessage.push('Please enter your name');
        } else if (trimmedName.length > 50) {
            nameErrormessage.push('Name must be 50 characters or fewer');
        }

        // 3. Check address (trim whitespace and check 255-char limit)
        let addressErrormessage = [];
        const trimmedAddress = address ? address.value.trim() : '';
        if (trimmedAddress === '' || address.value == null) {
            addressErrormessage.push('Please enter your address');
        } else if (trimmedAddress.length > 255) {
            addressErrormessage.push('Address must be 255 characters or fewer');
        }

        // Display red error messages under the fields if any check failed
        if (nameErrormessage.length > 0 || addressErrormessage.length > 0) {
            nameError.innerText = nameErrormessage.join(', ');
            customerNameContainer.appendChild(nameError);

            addressError.innerText = addressErrormessage.join(', ');
            addressContainer.appendChild(addressError);

            e.preventDefault();
        } else {
            nameError.innerText = '';
            addressError.innerText = '';
        }
    });
}

// Initialize all validation and real-time calculation handlers
setUpAddToCartForms();
setUpCartQuantities();
setUpCheckoutForm();
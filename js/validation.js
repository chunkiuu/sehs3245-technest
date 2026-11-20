/*
 * File:        js/validation.js
 * Team member: LIN Zixi
 *
 * 
 */
const customerName = document.getElementById("customer-name");
const address = document.getElementById("address");
const checkoutForm = document.getElementById("checkout-form");
const customerNameContainer = document.getElementById("customer-name-container");
const addressContainer = document.getElementById("address-container");
const nameError = document.createElement('p');
nameError.style.color = "red";
const addressError = document.createElement('p');
addressError.style.color = "red";

//validation for the checkout form//
checkoutForm.addEventListener("submit", (e) => {
    let nameErrormessage = [];
    if (customerName.value === "" || customerName.value == null) {
        nameErrormessage.push("Please enter your name");
    }
    let addressErrormessage = [];
    if (address.value === "" || address.value == null) {
        addressErrormessage.push("Please enter your address");
    }
    if (nameErrormessage.length > 0 || addressErrormessage.length > 0) {
        nameError.innerText = nameErrormessage.join(", ");
        customerNameContainer.appendChild(nameError);
        addressError.innerText = addressErrormessage.join(", ");
        addressContainer.appendChild(addressError);
        e.preventDefault();
    }
})
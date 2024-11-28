// Initialize Socket.IO
const socket = io('http://localhost:4000');

// Form Submission Handler
const form = document.getElementById('create-item-form');
form.addEventListener('submit', async function (event) {
    event.preventDefault();

    const itemName = document.getElementById('item-name').value.trim();
    const itemSku = document.getElementById('item-sku').value.trim();
    const itemDescription = document.getElementById('item-description').value.trim();
    const itemPrice = document.getElementById('item-price').value.trim();
    const itemActive = document.getElementById('is_active').value;
    // if (itemName === '') {
    //     alert('Please enter an item name');
    //     return;
    // }

    // Send item to the Laravel API
    try {
        const response = await fetch('/items', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name: itemName, sku:itemSku, description: itemDescription, price: itemPrice, is_active: itemActive, _token: _token }),
        });
        
        // Parse the response JSON
        const data  = await response.json();

        if (data.status) {
            document.getElementById('item-name').value = '';
            document.getElementById('item-sku').value = '';
            document.getElementById('item-description').value = '';
            document.getElementById('item-price').value = '';
            document.getElementById('is_active').value = 1;
        } else {
            alert(data.message);
        }
    } catch (error) {
        alert(error.message);
    }
});
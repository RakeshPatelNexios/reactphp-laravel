// Connect to the Socket server
const socket = io("http://localhost:4000");
const list = document.getElementById('item-list');

// Keep track of the last fetched item's ID
let lastFetchedId = null;

// Fetch existing items from the API
function fetchItems() {
    fetch('/items')
    .then((response) => response.json())
    .then((items) => {
        // Clear the list if it's the first fetch
        if (!lastFetchedId) {
            list.innerHTML = "";
        }

        items.forEach((item) => {
            // Only add items that are new
            if (!lastFetchedId || item.id > lastFetchedId) {
                list.innerHTML += getItemsTemplate(item);

                // Update the last fetched ID
                lastFetchedId = item.id;
            }                    
        });
    });
}

// Fetch initial data
fetchItems();

/*
// Poll for new data every 5 seconds
setInterval(() => {
    fetchItems();
}, 5000);
*/

// Listen for new items via Socket
socket.on("new-item", (item) => {
    list.innerHTML += getItemsTemplate(item);
});

// Create the Items row template
function getItemsTemplate(item) {
    return `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.sku}</td>
                    <td>${item.description}</td>
                    <td>${item.price}</td>
                    <td>${item.is_active ? 'Active' : 'Not Active'}</td>
                </tr>`;
}
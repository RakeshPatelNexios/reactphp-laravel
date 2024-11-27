<!DOCTYPE html>
<html>
<head>
    <title>Item Listings</title>
    <script src="https://cdn.socket.io/4.5.1/socket.io.min.js"></script>
</head>
<body>
    <h1>Real-time Item Listings</h1>
    <ul id="item-list"></ul>

    <script>
        // Connect to the WebSocket server
        const socket = io("http://localhost:4000");

        const list = document.getElementById('item-list');
        let lastFetchedId = null; // Keep track of the last fetched item's ID

        // Fetch existing items from the Laravel API
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

        // Poll for new data every 5 seconds
        // setInterval(() => {
        //     fetchItems();
        // }, 5000);

        // Listen for new items via WebSocket
        socket.on("new-item", (item) => {
            list.innerHTML += getItemsTemplate(item);
        });

        function getItemsTemplate(item) {
            return `
                                            <li>${item.name}</li>
                                            <li>${item.sku}</li>
                                            <li>${item.description}</li>
                                            <li>${item.price}</li>
                                            <li>${item.is_active ? 'Active' : 'Not Active'}</li>
                                            <li>______________________</li>`;
        }
    </script>
</body>
</html>

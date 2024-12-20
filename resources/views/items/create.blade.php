{{--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Item Listing</title>
    <script src="https://cdn.socket.io/4.5.1/socket.io.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        h1, h2 {
            color: #333;
        }
        #item-list {
            margin-top: 20px;
            padding: 0;
            list-style-type: none;
        }
        #item-list li {
            padding: 10px;
            background: #f0f0f0;
            margin: 5px 0;
            border-radius: 5px;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Real-Time Item Listing</h1>
    <h2>Add a New Item</h2>

    <!-- Form for Adding New Item -->
    <form id="create-item-form">
        <input type="text" id="item-name" placeholder="Enter item name" required>
        <br/>
        <input type="text" id="item-sku" placeholder="Enter item sku" required>
        <br/>
        <textarea id="item-description" cols="30" rows="10" placeholder="Enter Description" required></textarea>
        <br/>
        <input type="text" id="item-price" placeholder="Enter item price" required>
        <select id="is_active">
            <option value="1" selected>Active</option>
            <option value="0">Not Active</option>
        </select>
        <br/><br/>
        <button type="submit">Add Item</button>
    </form>

    <script>
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
            const _token = "{{ csrf_token() }}";
            if (itemName === '') {
                alert('Please enter an item name');
                return;
            }

            // Send item to the Laravel API
            try {
                const response = await fetch('/items', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ name: itemName, sku:itemSku, description: itemDescription, price: itemPrice, is_active: itemActive, _token: _token }),
                });

                if (!response.ok) {
                    throw new Error('Failed to create item');
                }

                document.getElementById('item-name').value = '';
                document.getElementById('item-sku').value = '';
                document.getElementById('item-description').value = '';
                document.getElementById('item-price').value = '';
                document.getElementById('is_active').value = 1;
            } catch (error) {
                console.error(error.message);
            }
        });
    </script>
</body>
</html>
--}}

@extends('includes.app')
@section('page-title')
    Create Item
@endsection
@section('section-contents')
    <h1 class="text-center">Create Item</h1>

    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-sm-10 col-12">
            <!-- Form for Adding New Item -->
            <form id="create-item-form">
                <div class="mt-3">
                    <input type="text" id="item-name" class="form-control" placeholder="Enter item name" required>
                </div>
                <div class="mt-3">
                    <input type="text" id="item-sku" class="form-control" placeholder="Enter item sku" required>
                </div>
                <div class="mt-3">
                    <textarea id="item-description" class="form-control" cols="30" rows="10" placeholder="Enter Description" required></textarea>
                </div>
                <div class="mt-3">
                    <input type="text" id="item-price" class="form-control" placeholder="Enter item price" required>
                </div>
                <div class="mt-3">
                    <select id="is_active" class="form-select">
                        <option value="1" selected>Active</option>
                        <option value="0">Not Active</option>
                    </select>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary w-100">Add Item</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.5.1/socket.io.min.js"></script>
    <script src="{{ asset('assets/js/items/create.js') }}"></script>
    <script>
        const _token = "{{ csrf_token() }}";
    </script>
@endsection
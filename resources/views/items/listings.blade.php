@extends('includes.app')
@section('page-title')
    Item Listings
@endsection
@section('section-contents')
    <h1>Items Listings</h1>

    <table class="table mt-3">
        <thead id="item-header">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Sku</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody id="item-list"></tbody>
      </table>

    <script src="https://cdn.socket.io/4.5.1/socket.io.min.js"></script>
    <script src="{{ asset('assets/js/items/listings.js') }}"></script>
@endsection
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name') }} | Task Logs</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <h1>Task Execution Logs</h1>
            <ul id="logs" class="list-group"></ul>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.7.0/socket.io.min.js"></script>
         <!-- <script src="{{ asset('assets/js/custom.js') }}"></script> -->
        <script>
           const ws = new WebSocket('ws://animated-train-r7jqxjgx55xhxvrg-8080.app.github.dev/:8080');

            ws.onopen = () => {
                console.log('WebSocket connection opened');
                ws.send('Hello, TCP server!');
            };

            ws.onmessage = (event) => {
                console.log('Received from TCP server:', event.data);
            };
    </script>
    </body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>List Students</title>
</head>
<body>
    <ul id="student-list"></ul>

    <script>
        const socket = new WebSocket('ws://127.0.0.1:8082');

        // Fetch initial students
        fetch('/students-listings')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('student-list');
                data.forEach(student => {
                    const li = document.createElement('li');
                    li.textContent = student.name;
                    list.appendChild(li);
                });
            });

        // Listen for real-time updates
        socket.onmessage = function (event) {
            const message = JSON.parse(event.data);
            if (message.type === 'new-student') {
                const list = document.getElementById('student-list');
                const li = document.createElement('li');
                li.textContent = message.data.name;
                list.appendChild(li);
            }
        };
    </script>
</body>
</html>

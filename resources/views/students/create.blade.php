<!DOCTYPE html>
<html>
<head>
    <title>Create Student</title>
</head>
<body>
    <form id="student-form">
        @csrf
        <input type="text" id="student-name" placeholder="Enter student name" required>
        <button type="submit">Add Student</button>
    </form>

    <script>
        document.getElementById('student-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const name = document.getElementById('student-name').value;
            const _token = "{{ csrf_token() }}";

            fetch('/student/store', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, _token }),
            }).then(() => {
                document.getElementById('student-name').value = '';
            });
        });
    </script>
</body>
</html>

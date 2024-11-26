const socket = new WebSocket('ws://127.0.0.1:8080');

socket.onopen = () => console.log('Connection established!');
socket.onmessage = (event) => {
    console.log('Received:', event.data);
    const logsList = document.getElementById('logs');
    const logItem = document.createElement('li');
    logItem.className = 'list-group-item';
    logItem.textContent = event.data;
    logsList.prepend(logItem);
};
socket.onerror = (error) => console.error('WebSocket error:', error);
socket.onclose = () => console.log('Connection closed.');

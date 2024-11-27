const express = require("express");
const http = require("http");
const { Server } = require("socket.io");

// Initialize HTTP and WebSocket servers
const app = express();
const server = http.createServer(app);
const io = new Server(server, {
    cors: {
        origin: "*", // Replace this with your frontend's origin
        methods: ["GET", "POST"], // Allowed HTTP methods
    }
,});

// Handle WebSocket connections
io.on("connection", (socket) => {
    console.log("Client connected");

    // Disconnect event
    socket.on("disconnect", () => {
        console.log("Client disconnected");
    });
});

// Listen for incoming data from Laravel
const net = require("net");
const socketServer = net.createServer((socket) => {
    socket.on("data", (data) => {
        const message = JSON.parse(data);
        if (message.event === "new-item") {
            io.emit("new-item", message.data); // Broadcast new item to clients
        }
    });
});

socketServer.listen(3000, () => {
    console.log("Socket.IO server listening on port 3000");
});

server.listen(4000, () => {
    console.log("WebSocket HTTP server running on http://localhost:4000");
});

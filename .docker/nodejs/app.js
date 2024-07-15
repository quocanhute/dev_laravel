
const express = require("express");
const app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});
io.on("connection", (socket) => {

    socket.on('send_message', function (data) {
        let emitName = 'send_message';
        if(data.type === 2){
            emitName = 'send_message_file_upload'
        }
        else if(data.type === 1){
            emitName = 'send_message_image'
        }
        io.emit(emitName, data);
    });
    socket.on('change_chat_status',function (data){
        io.emit('change_chat_status', data);
    })

    //When user dissconnects from server.
    socket.on('disconnect', function () {
        io.emit('exit', { message: socket.nickname });
    });
});

http.listen(81, function () {
    console.log("Listening on 81");
});
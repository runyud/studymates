var express = require('express');
var app = express();
app.use(express.static('public'))
var server = require('http').createServer(app);
var io = require('socket.io').listen(server);
users = [];
connections = [];
subjects = [];

server.listen(process.env.PORT || 3000);
console.log('Server running...');

app.get('/', function(req, res){
    res.sendFile(__dirname
         + '/index.html');
});

io.sockets.on('connection', function(socket){
    connections.push(socket);
    console.log('Connected: %s sockets connected', connections.length);

    // disconnect
    socket.on('disconnect', function(data){
        users.splice(users.indexOf(socket.username), 1);
        subjects.splice(subjects.indexOf(socket.subject), 1);
        updateUsernames();
        updateSubjects();
        connections.splice(connections.indexOf(socket),1);
        console.log('Disconnected: %s sockets connected', connections.length);
    });

    // Send Message
    socket.on('send message', function(data){
        io.sockets.emit('new message', {msg: data, user: socket.username});
    });

    // New User
    socket.on('new user', function(data, callback){
        callback(true);
        socket.username = data;
        users.push(socket.username);
        updateUsernames();
    });

    //new subject
    socket.on('new subject', function(data, callback){
        callback(true);
        socket.subject = data;
        subjects.push(socket.subject);
        updateSubjects();
    });

    function updateUsernames(){
        io.sockets.emit('get users', users);
    }

    function updateSubjects(){
        io.sockets.emit('get subjects', subjects);
    }
});

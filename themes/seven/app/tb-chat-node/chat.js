var app = require('express')()
  , server = require('http').createServer(app)
  , mysql      = require('mysql');

server.listen(2000);
app.listen(2011);

var io = require('socket.io').listen(server);

/*app.configure('development', function(){
  app.use(express.errorHandler());
  app.locals.pretty = true;
});*/


var Globalvars = {
    "users" : [],
    "connection" : null,
    "connectedSockets" : []
}

Globalvars.connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : '',
  'database' : 'tbchat'
});

Globalvars.connection.connect(function(err){
    if(err){
        console.log("mysql connection failed");
    }
});



io.sockets.on('connection', function (socket){
    Globalvars.connectedSockets[socket.id] = socket;

	socket.on('login', function (userData) {
        //console.log(userData.first_name);
        if(ifUserAlreadyExists(userData.id)){
            console.log(userData.first_name + " " + userData.last_name + " already exists");
        }
        else{
            var user = new Object;
            user.id = userData.id;
            user.first_name = userData.first_name;
            user.last_name = userData.last_name;
            //user.image = "https://graph.facebook.com/" + userData.id + "/picture?width=100&height=100";
            //user.status = "available";
            user.socketId = socket.id;

            Globalvars.users.push(user);
        }

        console.log("user joined");
        console.log(Globalvars.users);
        io.sockets.emit('userchannel', Globalvars.users);
    });

    socket.on('message', function (messageData) {
        var message = [];
        message['sender_id'] = messageData.sender_id;
        message['sender_name'] = messageData.sender_name;
        message['receiver_name'] = messageData.receiver_name;
        message['receiver_id'] = messageData.receiver_id;
        message['message_text'] = messageData.message_text;

        Globalvars.connection.query('INSERT INTO messages(sender_id, sender_name, receiver_name, receiver_id, message_text) VALUES ("' +
              messageData.sender_id + '", "' 
            + messageData.sender_name + '", "' 
            + messageData.receiver_name + '", "' 
            + messageData.receiver_id + '", "' 
            + messageData.message_text + '")' , function(err, result) {
            console.log(err);
        });

        receiver = getUserFromId(messageData.receiver_id);
        receiverSocket = Globalvars.connectedSockets[receiver.socketId];
        receiverSocket.emit('message', messageData);
    });

    /* handle disconnect */
    socket.on('disconnect', function() {
        console.log('Got disconnect!');
        console.log("before");
        console.log("Users : " + Globalvars.users.length);
        console.log(Globalvars.connectedSockets);
        var index = Globalvars.connectedSockets.indexOf(socket);
        if (index > -1) {
            Globalvars.connectedSockets.splice(index, 1);
        }

        removeUserUsingSocketId(socket.id);
        console.log("after");
        console.log("Users : " + Globalvars.users.length);
        console.log(Globalvars.connectedSockets);
   });
});


function ifUserAlreadyExists(id){
    for(i = 0; i < Globalvars.users.length; i++){
        if(Globalvars.users[i].id == id){
            return true;
        }
    }

    return false;
}

function getUserUsingSocketId(socketId){
    for(i = 0; i < Globalvars.users.length; i++){
        if(Globalvars.users[i].socketId == socketId){
            return Globalvars.users[i];
        }
    }
}

function removeUserUsingSocketId(socketId){
    for(i = 0; i < Globalvars.users.length; i++){
        if(Globalvars.users[i].socketId == socketId){
            Globalvars.users.splice(i, 1);
            break;
        }
    }
}

function getUserFromId(id){
    for(i = 0; i < Globalvars.users.length; i++){
        if(Globalvars.users[i].id == id){
            return Globalvars.users[i];
        }
    }
}



/* HTTP REQUEST HANDLERS */
app.get('/messages', function(req, res){
    res.header('Access-Control-Allow-Origin', "*");
    res.setHeader('Content-Type', 'application/json');

    Globalvars.connection.query('SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) or (sender_id = ? AND receiver_id = ?) ORDER BY message_time ASC', 
                                                [req.query.my_id, req.query.other_id, req.query.other_id, req.query.my_id] , function(err, rows) {
        console.log(rows);
        console.log(req.query.id);
        if(rows != '' || rows != 'undefined'){
            res.send(JSON.stringify(rows));
        }
        else{
            res.send(JSON.stringify([]));
        }
    });
});

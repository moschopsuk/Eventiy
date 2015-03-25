var express     = require('express');
var app         = express();
var http 	= require('http').Server(app);
var io 		= require('socket.io')(http);
var redis 	= require('redis');
var client 	= redis.createClient();



io.on('connection', function(socket){
	console.log('client Socket open');
});

http.listen(3000, function(){
	console.log('listening on *:3000');
});

const redisClient = redis.createClient()
redisClient.subscribe('post.new');

redisClient.on("message", function(channel, message) {
	var post 		= JSON.parse(message);
	var chan	 	= channel + '.' + post.base.event_id;

	console.log("sending to " + chan);
        io.sockets.emit(chan, message);
});

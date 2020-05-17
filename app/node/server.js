const express = require("express");
const expressApp = express();
const http = require("http");
const https = require("https");
const fs = require("fs");
const option = {
  key: fs.readFileSync("/etc/letsencrypt/live/share-fashion.ga/privkey.pem"),
  cert: fs.readFileSync("/etc/letsencrypt/live/share-fashion.ga/cert.pem"),
  cs: fs.readFileSync("/etc/letsencrypt/live/share-fashion.ga/chain.pem"),
};
const httpServer = http.createServer(expressApp);
const httpsServer = https.createServer(option, expressApp);

// const io = require("socket.io")(httpServer);
const io = require("socket.io")(httpsServer);
const users = {};

io.on("connection", socket => {
  socket.on("send-chat-message", message => {
    socket.broadcast.emit("chat-message", { message: message, name: users[socket.id] });
  });

  socket.on("new-user", name => {
    users[socket.id] = name;
    socket.broadcast.emit("user-connected", name);
  });

  socket.on("disconnect", () => {
    socket.broadcast.emit("user-disconnected", users[socket.id]);
    delete users[socket.id];
  });
});

// httpServer.listen(3000, () => {
//   console.log("listening on *:3000");
// });

httpsServer.listen(3000, () => {
  console.log("listening on *:3000");
});

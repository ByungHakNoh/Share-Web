const app = require("express")();
const http = require("http").createServer(app);
const io = require("socket.io")(http);
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

http.listen(3000, () => {
  console.log("listening on *:3000");
});

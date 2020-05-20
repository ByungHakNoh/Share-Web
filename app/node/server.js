// 서버 구축에 사용할 express 모듈 사용
const express = require("express");
const expressApp = express();
const https = require("https");

// ssl 파일을 찾기 위해 파일 시스템 모듈 사용
const fs = require("fs");

// ssl 적용 -> 기존 아파치 홈페이지에 적용한 letsencrypt로 적용한 키 사용 -> 도메인 이름 사용 가능
const option = {
  key: fs.readFileSync("/etc/letsencrypt/live/share-fashion.ga/privkey.pem"),
  cert: fs.readFileSync("/etc/letsencrypt/live/share-fashion.ga/cert.pem"),
  cs: fs.readFileSync("/etc/letsencrypt/live/share-fashion.ga/chain.pem"),
};

// 서버 포트 설정
const PORT = 3000;
// https socket.io 서버 생성
const httpsServer = https.createServer(option, expressApp);
httpsServer.listen(PORT, () => {
  console.log("listening on *:3000");
});

const io = require("socket.io")(httpsServer);

// 채팅방에 참여한 유저들
const users = {};

io.on("connection", socket => {
  socket.on("send-donation", donation => {
    socket.broadcast.emit("donation", { donation: donation, name: users[socket.id] });
  });

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

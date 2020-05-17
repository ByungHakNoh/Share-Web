const socket = io.connect("https://13.125.99.215:3000");
const messageForm = document.getElementById("messageForm");
const messageInput = document.getElementById("messageInput");
const messageContainer = document.getElementById("messageContainer");

messageInput.addEventListener("focus", function () {
  if (userNickName == "") {
    alert("로그인이 필요합니다");
    this.blur();
  }
});

if (userNickName != "") {
  console.log("yes");
  socket.emit("new-user", userNickName);
}

// 채팅창 form에 리스너 추가
messageForm.addEventListener("submit", event => {
  event.preventDefault();
  // 입력한 채팅을 서버로 보내고 입력란 지우기
  const message = messageInput.value;
  socket.emit("send-chat-message", message);
  messageInput.value = null;
  appendChatDialog(name, message, true);
});

// 서버로 부터 받은 채팅 데이터로 채팅을 보여준다.
socket.on("chat-message", data => {
  appendChatDialog(data.name, data.message, false);
});

socket.on("user-connected", name => {
  if (name != "" || name != null) {
    const message = "가 대화방에 참여했습니다";
    newUserAlert(name, message);
  }
});

socket.on("user-disconnected", name => {
  if (name != "" || name != null) {
    const message = "가 대화방에 나갔습니다";
    newUserAlert(name, message);
  }
});

function appendChatDialog(name, data, isSelf) {
  const nickNameBox = document.createElement("div");
  const messageBox = document.createElement("main");
  const nickName = document.createElement("small");
  const message = document.createElement("p");

  if (isSelf) {
    messageBox.style.cssFloat = "right";
    messageBox.style.backgroundColor = "yellow";
  } else {
    nickName.innerText = name + ":";
  }
  message.innerText = data;
  nickNameBox.append(nickName);
  messageBox.append(message);
  messageContainer.append(nickNameBox);
  messageContainer.append(messageBox);
}

function newUserAlert(name, message) {
  const alertBox = document.createElement("div");
  const alertMessage = document.createElement("small");

  alertMessage.innerText = name + message;
  alertBox.append(alertMessage);
  messageContainer.append(alertBox);
}

const socket = io.connect("https://share-fashion.ga:3000");
const messageForm = document.getElementById("messageForm");
const messageInput = document.getElementById("messageInput");
const messageContainer = document.getElementById("messageContainer");
const donateBtn = document.getElementById("donateBtn");
const overlayBox = document.getElementById("overlayBox");
const overlayText = document.getElementById("overlayText");

// 로그인을 하지 않으면 채팅 칠 수 없도록 구현
messageInput.addEventListener("focus", function () {
  if (userNickName == "") {
    alert("로그인이 필요합니다");
    this.blur();
  }
});

// 채팅창 form에 리스너 추가
messageForm.addEventListener("submit", event => {
  event.preventDefault();
  // 입력한 채팅을 서버로 보내고 입력란 지우기
  const message = messageInput.value;
  socket.emit("send-chat-message", message);
  messageInput.value = null;
  appendMyChat(message);
});

donateBtn.addEventListener("click", () => {
  socket.emit("send-donation", { donation: "1000" });
  overlayText.innerText = `${userNickName}님이 1000원을 후원했습니다`;
  overlayBox.hidden = false;
  setTimeout(() => {
    overlayBox.hidden = true;
  }, 3000);
});

// 새로운 유저가 대화방에 참여하면 서버에 참여한 유저명을 전달
if (userNickName != "") {
  console.log("yes");
  socket.emit("new-user", userNickName);
}

socket.on("donation", data => {
  overlayText.innerText = `${data.name}님이 ${data.donation}을 후원했습니다`;
  overlayBox.hidden = false;
  setTimeout(() => {
    overlayBox.hidden = true;
  }, 3000);
});

// 서버로 부터 받은 채팅 데이터로 채팅을 보여준다.
socket.on("chat-message", data => {
  appendChatDialog(data.name, data.message);
});

// 서버로부터 대화방에 참여한 새로운 유저 이름을 표시
socket.on("user-connected", name => {
  if (name != "" || name != null) {
    const message = "가 대화방에 참여했습니다";
    newUserAlert(name, message);
  }
});

// 유저가 대화방에서 나간다면 나간 유저를 표시
socket.on("user-disconnected", name => {
  if (name != null) {
    const message = "가 대화방에 나갔습니다";
    newUserAlert(name, message);
  }
});

// 대화방에 참가한 다른 사람들의 채팅 박스 생성
function appendChatDialog(name, data) {
  const nickNameBox = document.createElement("div");
  const messageBox = document.createElement("main");
  const nickName = document.createElement("small");
  const message = document.createElement("p");

  nickName.innerText = name + ":";
  message.innerText = data;

  nickNameBox.append(nickName);
  messageBox.append(message);
  messageContainer.append(nickNameBox);
  messageContainer.append(messageBox);
}

// 본인의 채팅 박스 생성
function appendMyChat(data) {
  const parentDiv = document.createElement("div");
  const messageBox = document.createElement("main");
  const message = document.createElement("p");

  message.innerText = data;
  messageBox.style.backgroundColor = "yellow";
  parentDiv.style.textAlign = "end";

  messageBox.append(message);
  parentDiv.append(messageBox);
  messageContainer.append(parentDiv);
}

// 새로운 유저가 참가했을 때 알림 메시지 박스 생성
function newUserAlert(name, message) {
  const alertBox = document.createElement("div");
  const alertMessage = document.createElement("small");

  alertMessage.innerText = name + message;
  alertBox.append(alertMessage);
  messageContainer.append(alertBox);
}

// const socket = io.connect("https://share-fashion.ga:3000");
const socket = io.connect("http://13.125.99.215:3000");
const messageForm = document.getElementById("messageForm");
const messageInput = document.getElementById("messageInput");
const messageContainer = document.getElementById("messageContainer");
const donateBtn = document.getElementById("donateBtn");

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
  appendMyChat(message, "message");
});

donateBtn.addEventListener("click", () => {
  const donationInput = document.getElementById("donationInput");
  const currentMoneyText = document.getElementById("currentMoney");
  const popUpBox = document.getElementById("donationBox");
  const donationValue = parseInt(donationInput.value);
  const currentMoney = parseInt(currentMoneyText.innerText);

  if (donationValue <= currentMoney) {
    socket.emit("send-donation", donationValue);
    donationAlert(userNickName, donationInput.value);
    appendMyChat(donationInput.value, "donation");
    uploadMoneyData(-donationValue);
    closeDonatePopUP(popUpBox);
  } else {
    alert("보유 금액이 부족합니다");
  }
});

// 새로운 유저가 대화방에 참여하면 서버에 참여한 유저명을 전달
if (userNickName != "") {
  socket.emit("new-user", userNickName);
}

socket.on("donation", data => {
  donationAlert(data.name, data.donation);
  appendChatDialog(data.name, data.donation, "donation");
});

// 서버로 부터 받은 채팅 데이터로 채팅을 보여준다.
socket.on("chat-message", data => {
  appendChatDialog(data.name, data.message, "message");
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

function donationAlert(nickName, donationAmount) {
  const overlayBox = document.getElementById("overlayBox");
  const overlayText = document.getElementById("overlayText");

  overlayText.innerHTML = `${nickName}님이 ${donationAmount}원을 후원했습니다`;
  overlayBox.hidden = false;
  setTimeout(() => {
    overlayBox.hidden = true;
  }, 3000);
}

// 대화방에 참가한 다른 사람들의 채팅 박스 생성
function appendChatDialog(name, data, type) {
  const nickNameBox = document.createElement("div");
  const messageBox = document.createElement("main");
  const nickName = document.createElement("small");
  const message = document.createElement("p");

  switch (type) {
    case "message":
      message.innerText = data;
      break;

    case "donation":
      const donationImage = document.createElement("img");
      donationImage.src = "/src/image/img.png";
      message.innerText = `${name}님이 ${data}원을 후원했습니다`;
      messageBox.append(donationImage);
      break;
  }

  nickName.innerText = name + ":";
  // message.innerText = data;

  nickNameBox.append(nickName);
  messageBox.append(message);
  messageContainer.append(nickNameBox);
  messageContainer.append(messageBox);
}

// 본인의 채팅 박스 생성
function appendMyChat(data, type) {
  const parentDiv = document.createElement("div");
  const messageBox = document.createElement("main");
  const message = document.createElement("p");

  switch (type) {
    case "message":
      message.innerText = data;
      break;

    case "donation":
      const donationImage = document.createElement("img");
      donationImage.src = "/src/image/img.png";
      message.innerText = `${data}원을 후원했습니다`;
      messageBox.append(donationImage);
      break;
  }

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

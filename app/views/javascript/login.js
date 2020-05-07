const submitBtn = document.getElementById("submitBtn");
const userID = document.getElementById("userID");
const userIDText = document.getElementById("userIDText");
const password = document.getElementById("password");
const passwordText = document.getElementById("passwordText");

submitBtn.addEventListener("click", event => {
  userIDText.innerText = "";
  passwordText.innerText = "";

  if (userID.value == "") {
    event.preventDefault();
    userID.focus();
    userIDText.innerText = "아이디를 입력해주세요";
  } else if (password.value == "") {
    event.preventDefault();
    password.focus();
    passwordText.innerText = "패스워드를 입력해주세요";
  }
});

// 자바 스크립트 공부 후 추후 수정해야함

// 회원가입 form 관련 자바 스크립트 코드
const registerForm = document.getElementById("registerForm");
const userID = document.getElementById("userID");
const password = document.getElementById("password");
const passwordCheck = document.getElementById("passwordCheck");
const successText = document.getElementById("passwordSuccess");
const failText = document.getElementById("passwordFailed");

registerForm.addEventListener("submit", event => {
  if (!userID.value || !password.value || !passwordCheck.value) {
    event.preventDefault();
    alert("모든 내용을 기입하세요");
  }
});

const writeBtn = document.getElementById("writeBtn");

writeBtn.addEventListener("click", event => {
  if (!isLogin) {
    event.preventDefault();
    alert("로그인이 필요합니다");
  }
});

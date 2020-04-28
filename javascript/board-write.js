// 자바 스크립트 공부 후 추후 수정해야함

// 빈칸 체크 관련
const writeForm = document.getElementById("writeForm");
const title = document.getElementById("title");
const content = document.getElementById("summernote");

writeForm.addEventListener("submit", event => {
  if (!title.value || !content.value) {
    event.preventDefault();
    alert("제목과 내용을 모두 입력해주세요");
  }
});

// summernote 관련
$(document).ready(function () {
  $("#summernote").summernote({
    placeholder: "자유 계시판에 올릴 내용을 입력하세요!",
    minHeight: 700,
    maxHeight: 700,
    focus: true,
    lang: "KO-KR",
  });
});

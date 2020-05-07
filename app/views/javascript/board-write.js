const writeForm = document.getElementById("writeForm");
const title = document.getElementById("title");
const content = document.getElementById("summernote");
const videoInput = document.getElementById("videoInput");

// summernote 실행
$(document).ready(function () {
  $("#summernote").summernote({
    minHeight: 700,
    maxHeight: 700,
    focus: true,
    lang: "KO-KR",
    callbacks: {
      onInit: function () {
        $("#summernote").summernote("code", initContent.substring(1, initContent.length - 1));
      },
    },
  });
});

videoInput.addEventListener("change", function () {
  let range = $("#summernote").summernote("createRange");

  const video = document.createElement("video");
  const videoFile = this.files[0];

  if (videoFile) {
    const fileReader = new FileReader();

    fileReader.addEventListener("load", function () {
      video.src = this.result;
    });
    fileReader.readAsDataURL(videoFile);
  }

  video.setAttribute("controls", "controls");

  range.deleteContents();
  range.insertNode(video);
});

// 빈칸체크하는 리스너 구현
writeForm.addEventListener("submit", event => {
  if (!title.value || !content.value) {
    event.preventDefault();
    alert("제목과 내용을 모두 입력해주세요");
  }
});

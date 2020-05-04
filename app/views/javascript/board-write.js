const writeForm = document.getElementById("writeForm");
const title = document.getElementById("title");
const content = document.getElementById("summernote");

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

// 로컬 동영상 업로드 하는 메소드 (html input[type = 'file']에서 호출함)
function uploadVideo(inputObject) {
  const range = $("#summernote").summernote("createRange");
  const video = document.createElement("video");
  const videoFile = inputObject.files[0];

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
  range.collapse(false);
}

// 빈칸체크하는 리스너 구현
writeForm.addEventListener("submit", event => {
  if (!title.value || !content.value) {
    event.preventDefault();
    alert("제목과 내용을 모두 입력해주세요");
  }
});

// inputVideo.addEventListener("change", function () {
//   const range = $("#summernote").summernote("createRange");
//   const video = document.createElement("video");
//   const videoFile = this.files[0];

//   if (videoFile) {
//     const fileReader = new FileReader();

//     fileReader.addEventListener("load", function () {
//       video.src = this.result;
//     });
//     fileReader.readAsDataURL(videoFile);
//   }

//   video.setAttribute("controls", "controls");

//   range.deleteContents();
//   range.insertNode(video);
//   range.collapse(false);
// });

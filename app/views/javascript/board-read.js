const commentSubmit = document.getElementById("commentSubmit");
const commentTextArea = document.getElementById("comment");
const commentWarning = document.getElementById("commentWarning");

const commentHandleContainer = document.getElementsByClassName("commentHandleContainer");
const replyHandleContainer = document.getElementsByClassName("replyHandleContainer");
// 댓글 쓰기 관련 리스너

commentSubmit.addEventListener("click", event => {
  // 댓글을 입력하지 않고 등록 버튼을 눌렀을 때
  if (!isLogin) {
    event.preventDefault();
    alert("로그인이 필요합니다");
  } else if (!commentTextArea.value) {
    event.preventDefault();
    commentWarning.innerText = "댓글을 입력해보세요";
  }
});

commentTextArea.addEventListener("focus", function () {
  // 로그인을 하지 않았을 때
  if (!isLogin) {
    alert("로그인이 필요합니다");
    this.blur();
  }
});

commentTextArea.addEventListener("input", function () {
  // 댓글을 입력에 따른 경고문 발생 여부
  if (commentTextArea.value) {
    commentWarning.innerText = "";
  } else {
    event.preventDefault();
    commentWarning.innerText = "댓글을 입력해보세요";
  }
});

// 하나의 댓글을 담은 class
Array.from(commentHandleContainer).forEach(function (element) {
  const commentText = element.children[0];
  const modifyCancelBtn = element.children[1];
  const commentModifyBtn = element.children[2];
  const commentModifyForm = element.children[4];
  const modifyTextArea = commentModifyForm.children[0];
  // 댓글이 없는지 체크 추가하기
  const modifySubmit = commentModifyForm.children[1];

  commentModifyBtn.addEventListener("click", function () {
    commentText.hidden = true;
    commentModifyForm.hidden = false;
    modifyCancelBtn.hidden = false;
    this.hidden = true;

    // 수정 요망
    modifyTextArea.innerText = commentText.innerText;
  });

  modifyCancelBtn.addEventListener("click", function () {
    commentText.hidden = false;
    commentModifyForm.hidden = true;
    commentModifyBtn.hidden = false;
    this.hidden = true;
  });
});

// 하나의 답글을 담은 class
Array.from(replyHandleContainer).forEach(function (element) {
  const replyText = element.children[0];
  const modifyCancelBtn = element.children[1];
  const replyModifyBtn = element.children[2];
  const replyModifyForm = element.children[4];
  const modifyTextArea = replyModifyForm.children[0];
  // 댓글이 없는지 체크 추가하기
  const modifySubmit = replyModifyForm.children[1];

  replyModifyBtn.addEventListener("click", function () {
    replyText.hidden = true;
    replyModifyForm.hidden = false;
    modifyCancelBtn.hidden = false;
    this.hidden = true;

    // 수정 요망
    modifyTextArea.innerText = replyText.innerText;
  });

  modifyCancelBtn.addEventListener("click", function () {
    replyText.hidden = false;
    replyModifyForm.hidden = true;
    replyModifyBtn.hidden = false;
    this.hidden = true;
  });
});

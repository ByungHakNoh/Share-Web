let userIDFlag = (passwordFlag = passwordCheckFlag = nickNameFlag = false);

const userIDText = document.getElementById("userIDText");
const passwordText = document.getElementById("passwordText");
const passwordCheckText = document.getElementById("passwordCheckText");
const nickNameText = document.getElementById("nickNameText");

function validate(inputObject) {
  // submit 버튼 활성화 여부
  const submitBtn = document.getElementById("submitBtn");
  const submitBtnText = document.getElementById("submitBtnText");
  submitBtn.disabled = true;
  submitBtnText.innerText = "필수 입력란을 확인해주세요";
  // Memo : html validate(this) 메소드로 넘어온 객체들 중 id값으로 value를 찾는다.
  const id = inputObject.attributes["id"].value;

  // validation 체크
  if (id == "userID") {
    userIDText.innerText = isValid(inputObject.value, "userID");
  } else if (id == "password") {
    passwordText.innerText = isValid(inputObject.value, "password");
    passwordCheckText.innerText = passwordCheck(inputObject.value);
  } else if (id === "passwordCheck") {
    passwordCheckText.innerText = passwordCheck(inputObject.value);
  } else if (id == "nickName") {
    nickNameText.innerText = isValid(inputObject.value, "nickName");
  }

  if (userIDFlag) {
    if (passwordFlag) {
      if (passwordCheckFlag) {
        if (nickNameFlag) {
          submitBtn.disabled = false;
          submitBtnText.innerText = "";
        }
      }
    }
  }
}

function isValid(inputValue, type) {
  let regularExpression, message, returnValue;

  switch (type) {
    case "userID":
      regularExpression = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      returnValue = regularExpression.test(inputValue);
      return doubleCheckID(inputValue, returnValue);

    case "password":
      message = "8~16자 영문 대 소문자, 숫자, 특수문자를 사용하세요";
      regularExpression = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{6,16}/;
      returnValue = regularExpression.test(inputValue);
      passwordFlag = checkSubmitAbled(returnValue, passwordFlag, passwordText);
      // 패스워드는 출력하는 메시지가 다르기 때문에 switch 문 안에서 return 한다.
      return returnValue ? "사용가능한 패스워드입니다" : message;

    case "nickName":
      return nickNameChecK(inputValue);
  }
}

// 수정 해야함
function doubleCheckID(inputValue, returnValue) {
  const userJSONArray = JSON.parse(userList);
  let isDuplicated = false;
  let message;

  for (var i = 0; i < userJSONArray.length; i++) {
    if (inputValue === userJSONArray[i].user_id) {
      isDuplicated = true;
    }
  }

  if (returnValue) {
    if (!isDuplicated) {
      userIDFlag = true;
      message = "사용가능한 아이디입니다";
      userIDText.className = "valid";
    } else {
      userIDFlag = false;
      message = "중복된 아이디입니다";
      userIDText.className = "inValid";
    }
  } else {
    userIDFlag = false;
    message = "이메일 형식으로 아이디를 입력해주세요";
    userIDText.className = "inValid";
  }
  console.log(userList);

  return message;
}

function checkSubmitAbled(returnValue, flag, smallTag) {
  if (returnValue) {
    smallTag.className = "valid";
    flag = true;
  } else {
    smallTag.className = "inValid";
    flag = false;
  }
  return flag;
}

function nickNameChecK(inputValue) {
  nickNameFlag = false;
  nickNameText.className = "inValid";
  const userJSONArray = JSON.parse(userList);
  let isDuplicated = false;
  let message;

  for (var i = 0; i < userJSONArray.length; i++) {
    if (inputValue === userJSONArray[i].nick_name) {
      isDuplicated = true;
    }
  }

  if (inputValue == "") {
    message = "닉네임을 입력해주세요";
  } else {
    if (isDuplicated) {
      message = "중복된 닉네임입니다";
    } else {
      nickNameFlag = true;
      message = "사용가능한 닉네임입니다";
      nickNameText.className = "valid";
    }
  }
  return message;
}

// 패스워드 재확인란에서 패스워드 일치여부를 체크하는 메소드
function passwordCheck() {
  passwordCheckFlag = false;
  passwordCheckText.className = "inValid";
  const password = document.getElementById("password");
  const passwordCheck = document.getElementById("passwordCheck");
  let message;

  if (passwordCheck.value === "") {
    message = "패스워드를 입력해주세요";
  } else {
    if (passwordCheck.value === password.value) {
      passwordCheckFlag = true;
      message = "패스워드가 일치합니다";
      passwordCheckText.className = "valid";
    } else {
      message = "패스워드가 일치하지 않습니다";
    }
  }

  return message;
}

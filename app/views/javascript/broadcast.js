let options, video;

const donatePopUpBtn = document.querySelectorAll("[data-target]");
const donationBoxOverlay = document.getElementById("donationBoxOverlay");
// 충전, 후원 박스의 X 버튼을 가리킨다
const popUpCloseBtn = document.querySelectorAll(".closeBtn");

const rechargePopUpBtn = document.getElementById("rechargePopUpBtn");
const rechargeBox = document.getElementById("rechargeBox");
const rechargeSelectForm = document.getElementById("rechargeSelectForm");

// 후원관련 코드

donatePopUpBtn.forEach(button => {
  const donationBox = document.querySelector(button.dataset.target);
  button.addEventListener("click", () => {
    if (userNickName) {
      openDonatePopUp(donationBox);
    } else {
      alert("로그인이 필요합니다");
    }
  });
});

popUpCloseBtn.forEach(button => {
  var popUpBox = button.closest(".donationBox");
  button.addEventListener("click", () => {
    closeDonatePopUP(popUpBox);
  });
});

rechargePopUpBtn.addEventListener("click", () => {
  rechargeBox.classList.add("active");
});

rechargeSelectForm.addEventListener("submit", event => {
  event.preventDefault();
  const moneyRadioBtn = document.querySelector("input[name='money']:checked");
  let money;
  if (moneyRadioBtn == null) {
    alert("충전 금액을 선택해주세요");
  } else {
    money = moneyRadioBtn.value;
    paymentProcess(money);
  }
});

function openDonatePopUp(donationBox) {
  donationBox.classList.add("active");
  donationBoxOverlay.classList.add("active");
}

function closeDonatePopUP(popUpBox) {
  popUpBox.classList.remove("active");
  if (popUpBox.id == "donationBox") {
    donationBoxOverlay.classList.remove("active");
  }
}

// 카드 결제 관련 코드
function paymentProcess(moneyAmount) {
  var IMP = window.IMP; // 생략가능
  IMP.init("imp60497081"); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

  IMP.request_pay(
    {
      pg: "inicis", // version 1.1.0부터 지원.
      pay_method: "card",
      merchant_uid: "merchant_" + new Date().getTime(),
      name: "주문명:결제테스트",
      amount: moneyAmount,
      m_redirect_url: "https://share-fashion.ga/broadcast/payments/complete",
    },
    function (rsp) {
      if (rsp.success) {
        var msg = "결제가 완료되었습니다.";
        msg += "고유ID : " + rsp.imp_uid;
        msg += "상점 거래ID : " + rsp.merchant_uid;
        msg += "결제 금액 : " + rsp.paid_amount;
        msg += "카드 승인번호 : " + rsp.apply_num;
        uploadMoneyData(moneyAmount);
      } else {
        var msg = "결제에 실패하였습니다.";
        msg += "에러내용 : " + rsp.error_msg;
      }
      alert(msg);
    }
  );
}

function uploadMoneyData(moneyAmount) {
  let resultMoney;
  const currentMoneyText = document.querySelectorAll(".currentMoney");
  currentMoneyText.forEach(node => {
    resultMoney = parseInt(node.innerText) + parseInt(moneyAmount);
    node.innerText = resultMoney;
  });

  console.log(moneyAmount);

  $.ajax({
    url: "/broadcast",
    type: "POST",
    dataType: "text",
    data: {
      nickName: userNickName,
      donationMoney: resultMoney,
    },
    success: function (response) {
      console.log(response);
    },
  });
}

// videojs 옵션
options = {
  autoplay: true,
  muted: true,
};

video = videojs("player", options);

// 카드 결제시 필요 정보 (필수 조건이 아니라 주석처리)
// buyer_email: "iamport@siot.do",
// buyer_name: "구매자이름",
// buyer_tel: "010-1234-5678",
// buyer_addr: "서울특별시 강남구 삼성동",
// buyer_postcode: "123-456",

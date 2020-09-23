// 관리자 페이지 차트 tap 관리
const tabBtns = document.getElementsByClassName("tapBtnContainer");
const tabPanels = document.querySelectorAll(".adminTabPannel");

console.log(tabBtns[0]);

// tab 클릭 시 이벤트
function panelController(panelIndex) {
  // 전체 보기
  if (panelIndex == 0) {
    tabPanels.forEach(function (node) {
      node.style.display = "block";
    });
    // 각 파트만 보기
  } else {
    tabPanels.forEach(function (node) {
      node.style.display = "none";
    });

    tabPanels[panelIndex - 1].style.display = "block";
  }
}

// 구글 차트 사용하기 위한 코드
google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(countryChart);
google.charts.setOnLoadCallback(monthlyVisitorChart);
google.charts.setOnLoadCallback(browserChart);
google.charts.setOnLoadCallback(memberSexRatioChart);

// 차트 보여주는 메소드들 모음
function countryChart() {
  let data = google.visualization.arrayToDataTable(JSON.parse(visitorCountries));

  let options = {
    title: "나라별 접속자 비율",
  };

  let chart = new google.visualization.PieChart(document.getElementById("visitorByCountry"));

  chart.draw(data, options);
}

function monthlyVisitorChart() {
  var data = google.visualization.arrayToDataTable(JSON.parse(monthlyVisitor));

  var options = {
    title: "월별 접속자 수",
  };

  var chart = new google.visualization.LineChart(document.getElementById("monthlyVisitor"));
  chart.draw(data, options);
}

function browserChart() {
  let data = google.visualization.arrayToDataTable(JSON.parse(visitorBrowser));

  let options = {
    title: "브라우저 별 접속자 비율",
  };

  let chart = new google.visualization.PieChart(document.getElementById("browser"));

  chart.draw(data, options);
}

function memberSexRatioChart() {
  let data = google.visualization.arrayToDataTable(JSON.parse(memberSexRatio));

  let options = {
    title: "회원 성비",
  };

  let chart = new google.visualization.PieChart(document.getElementById("sexRatio"));

  chart.draw(data, options);
}

// 관리자 페이지 차트 tap 관리
const tabBtns = document.querySelectorAll(".tapBtnContainer");
const tabPanels = document.querySelectorAll(".adminTabPannel");

console.log(visitorCountries);
console.log(JSON.parse(monthlyVisitor));

// tab 클릭 시 이벤트
function panelController(panelIndex) {
  console.log(panelIndex);
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

// 차트 보여주는 메소드들 모음
function countryChart() {
  let data = google.visualization.arrayToDataTable(JSON.parse(visitorCountries));

  let options = {
    title: "나라별 접속자 수",
  };

  let chart = new google.visualization.PieChart(document.getElementById("visitorByCountry"));

  chart.draw(data, options);
}

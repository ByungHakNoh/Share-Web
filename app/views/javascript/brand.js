let start = 0;
const limit = 4;
let reachMax = false;

document.addEventListener("DOMContentLoaded", () => {
  const options = {
    root: null,
    rootMargins: "0px",
    threshold: 0.5,
  };
  const observer = new IntersectionObserver(handleIntersect, options);
  const footer = document.querySelector("footer");
  observer.observe(footer);
});

function handleIntersect(entries) {
  if (entries[0].isIntersecting) {
    console.log(start);
    console.log(limit);
    getData();
  }
}

function getData() {
  if (!reachMax) {
    $.ajax({
      url: "/brand",
      type: "POST",
      dataType: "text",
      data: {
        start: start,
        limit: limit,
      },
      success: function (response) {
        start += 4;
        const main = document.querySelector("main");
        const brandList = JSON.parse(response)["brandDataByID"];

        brandList.forEach(brand => {
          const figure = document.createElement("figure");
          const brandLink = document.createElement("a");
          const brandImage = document.createElement("img");
          const name = document.createElement("figcaption");
          const averageRate = document.createElement("h4");

          brandLink.href = brand.link;
          brandImage.src = brand.image;
          name.textContent = brand.name;
          averageRate.textContent = "평균 평점 : " + parseFloat(brand.average_rate).toFixed(2);

          brandLink.appendChild(brandImage);
          figure.appendChild(brandLink);
          figure.appendChild(name);
          figure.appendChild(averageRate);

          if (nickName) {
            let rateNumber = 3;
            let isRated = false;
            const ratingRecord = JSON.parse(ratingRecordJSON);
            const firstStar = document.createElement("i");
            const secondStar = document.createElement("i");
            const thirdStar = document.createElement("i");
            const forthStar = document.createElement("i");
            const fifthStar = document.createElement("i");
            const submitBtn = document.createElement("button");
            const stars = [firstStar, secondStar, thirdStar, forthStar, fifthStar];

            // 평점 주기 버튼 추가
            ratingRecord.forEach(record => {
              if (brand.id == record["brand_id"]) {
                isRated = true;
              }
            });

            if (isRated) {
              submitBtn.textContent = "완료";
              submitBtn.disabled = true;
            } else {
              submitBtn.textContent = "평점 주기";
            }

            // 각각의 별에 리스너 추가
            for (let i = 0; i < stars.length; i++) {
              stars[i].className = "fa fa-star";
              stars[i].addEventListener("click", function () {
                rateNumber = i + 1;
                starListener(rateNumber);
              });
            }

            // 초기 별 색 지정
            for (let i = 0; i < 3; i++) {
              stars[i].style.color = "blanchedalmond";
            }

            // 평점 주기 버튼 백그라운드에서 post 메소드 처리하기
            submitBtn.addEventListener("click", function () {
              $.ajax({
                url: "/brand",
                type: "POST",
                dataType: "text",
                data: {
                  id: brand.id,
                  rateNumber: rateNumber,
                  nickName: nickName,
                  totalVotes: brand.total_votes,
                  averageRate: brand.average_rate,
                },
                success: function (response) {
                  averageRate.innerHTML = "평균 평점 : " + response.toFixed(2);
                  submitBtn.innerHTML = "완료";
                  submitBtn.disabled = true;
                },
              });
            });

            // 별들 figure에 추가하기
            stars.forEach(star => {
              figure.appendChild(star);
            });

            figure.appendChild(submitBtn);

            // 별 색상 변경 메소드
            function starListener(rateNumber) {
              stars.forEach(star => {
                star.style.color = "black";
              });

              for (let i = 0; i < rateNumber; i++) {
                stars[i].style.color = "blanchedalmond";
              }
            }
          }
          main.appendChild(figure);
        });
      },
    });
  }
}

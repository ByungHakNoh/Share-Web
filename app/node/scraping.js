const axios = require("axios");
const cheerio = require("cheerio");
const fs = require("fs");
const writeStream = fs.createWriteStream("app/data/FashionNews.csv");

const targetDomain = "https://www.fashionn.com/";
let targetPage;
const pageList = {};

function scrapFashionPage(page) {
  targetPage = `board/list_new.php?page=${page}&table=1006`;

  return axios.get(targetDomain + targetPage).then(response => {
    if (response.status == 200) {
      const $ = cheerio.load(response.data);

      const newsList = {};

      $(".list").each((index, element) => {
        const infoTag = $(element).children("dl").children("dt").children("a");
        const imageTag = $(element).children().first().children("a").first().children();
        const dateTag = $(element).children().last();

        let image = targetDomain + imageTag.attr("src");
        const title = infoTag.attr("title");
        const link = targetDomain + "board/" + infoTag.attr("href");
        const date = dateTag.text().replace(/\s\s+/g, "");

        if (image == targetDomain + "undefined") {
          image = null;
        }

        newsList[index] = { image, title, link, date };
      });
      return newsList;
    }
  });
}

function getScrappedData(page) {
  let nextPage;
  return scrapFashionPage(page).then(data => {
    nextPage = page + 1;
    pageList[page] = data;

    if (nextPage < 5) {
      return getScrappedData(nextPage);
    } else {
      return pageList;
    }
  });
}

getScrappedData(1).then(data => {
  writeStream.write(JSON.stringify(data));
});

// 객체 null 확인 메소드 -> 추후 전체 페이지를 스크렙할 때 사용
function isEmpty(object) {
  return Object.keys(object).length === 0;
}

const closeBtn = document.getElementById("closeBtn");
const cookieContainer = document.getElementById("cookieContainer");

const recentPostBtn = document.getElementById("recentPostBtn");
const viewsPostBtn = document.getElementById("viewsPostBtn");
const recentPostContainer = document.getElementById("recentPostContainer");
const viewsPostContainer = document.getElementById("viewsPostContainer");

closeBtn.addEventListener("click", function () {
  cookieContainer.hidden = true;
});

recentPostBtn.addEventListener("click", function () {
  recentPostContainer.hidden = false;
  viewsPostContainer.hidden = true;
  this.className = "active";
  viewsPostBtn.className = "";
});

viewsPostBtn.addEventListener("click", function () {
  recentPostContainer.hidden = true;
  viewsPostContainer.hidden = false;
  this.className = "active";
  recentPostBtn.className = "";
});

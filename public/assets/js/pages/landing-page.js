$(document).ready(async function () {
    await getSlider();

    //step 1: get DOM
    let nextDom = document.getElementById("next");
    let prevDom = document.getElementById("prev");

    let carouselDom = document.querySelector(".carousel");
    let SliderDom = carouselDom.querySelector(".carousel .list");
    let thumbnailBorderDom = document.querySelector(".carousel .thumbnail");
    let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll(".item");
    let timeDom = document.querySelector(".carousel .time");

    thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
    let timeRunning = 3000;
    let timeAutoNext = 7000;

    nextDom.onclick = function () {
        showSlider("next");
    };

    prevDom.onclick = function () {
        showSlider("prev");
    };
    let runTimeOut;
    let runNextAuto = setTimeout(() => {
        next.click();
    }, timeAutoNext);

    function showSlider(type) {
        let SliderItemsDom = SliderDom.querySelectorAll(
            ".carousel .list .item"
        );
        let thumbnailItemsDom = document.querySelectorAll(
            ".carousel .thumbnail .item"
        );

        if (type === "next") {
            SliderDom.appendChild(SliderItemsDom[0]);
            thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
            carouselDom.classList.add("next");
        } else {
            SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
            thumbnailBorderDom.prepend(
                thumbnailItemsDom[thumbnailItemsDom.length - 1]
            );
            carouselDom.classList.add("prev");
        }
        clearTimeout(runTimeOut);
        runTimeOut = setTimeout(() => {
            carouselDom.classList.remove("next");
            carouselDom.classList.remove("prev");
        }, timeRunning);

        clearTimeout(runNextAuto);
        runNextAuto = setTimeout(() => {
            next.click();
        }, timeAutoNext);
    }
});

async function getSlider() {
    try {
        let { data } = await getRequestData(`${baseL}/api/slider`);

        let list = "";
        let thumbnail = "";
        data.forEach((element) => {
            list += `<div class="item">
              <img src="${baseL}/${element.location}">
              <div class="content">
                  <div class="author">LUNDEV</div>
                  <div class="title">DESIGN SLIDER</div>
                  <div class="topic">ANIMAL</div>
                  <div class="des">
                      <!-- lorem 50 -->
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt minima placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                  </div>
                  <div class="buttons">
                      <button>SEE MORE</button>
                      <button>SUBSCRIBE</button>
                  </div>
              </div>
          </div>`;

            thumbnail += `<div class="item">
              <img src="${baseL}/${element.location}">
              <div class="content">
                  <div class="title">
                      Name Slider
                  </div>
                  <div class="description">
                      Description
                  </div>
              </div>
          </div>`;
        });

        $("#list_slider").append(list);
        $("#thumbnail_slider").append(thumbnail);
    } catch (error) {
        notif("error", "Galat!", error);
    }
}
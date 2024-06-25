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
    let timeRunning = 1000;
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

    $('.banner-title').html(appData.title);
    $('#banner-description').html(appData.description);
});

async function getSlider() {
    try {
        let { data } = await getRequestData(`${baseL}/api/slider`);

        let list = "";
        let thumbnail = "";
        data.forEach((element) => {
            let resource = `<img src="${baseL}/${element.location}">`;
            let src = `${baseL}/${element.location}`;

            if (element.type === "video") {
                resource = `<video src="${baseL}/${element.location}" class="w-full" autoplay loop muted></video>`;
                src = `https://static.vecteezy.com/system/resources/previews/002/162/107/original/camera-video-illustration-hand-drawing-vector.jpg`;
            }

            list += `<div class="item">
              ${resource}
              <div class="content">
                  <div class="title">${element.title}</div>
                  <div class="des">${element.description}</div>
              </div>
          </div>`;

            thumbnail += `<div class="item">
              <img src="${src}">
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

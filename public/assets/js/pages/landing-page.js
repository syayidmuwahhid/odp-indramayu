$(document).ready(async function () {
    await getSlider();
    await getArticle();

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
                    <div class="title mb-2">
                        ${element.title}
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

async function getArticle() {
    try {
        let { data } = await getRequestData(`${baseL}/api/article`);

        let count = 0;
        let html = '';

        data.reverse().forEach((element) => {
            count++;
            if (count > 5) {
                return;
            }

            html += `
            <div class="swiper-slide">

                    <div class="card flex flex-col justify-between h-40 border border-gray-200 rounded-lg overflow-hidden shadow-lg" onclick="window.location.href='${baseL}/article/${element.id}'">
                        <div>
                            <img class="card-img h-28 w-full object-cover cursor-pointer" src="${baseL}/${element.image}" alt="${element.title}" />
                            <div class="card-tags p-2">
                                <a class="tag text-sm bg-orange-200 text-orange-600 rounded-full px-2 py-1" href="${baseL}/article?category=${element.category_name}">${element.category_name}</a>
                            </div>
                            <h4 class="mb-2 mt-5 text-lg font-semibold cursor-pointer text-gray-800">
                                ${element.title}
                            </h4>
                            <p class="text-gray-600">${element.content}</p>
                        </div>
                        <div class="card-content mt-auto">
                            <div class="card-footer mt-6 flex space-x-4 text-gray-500">
                                <span class="inline-flex items-center text-xs">
                                    <svg class="mr-1.5" width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.5 2H11V0.375C11 0.16875 10.8313 0 10.625 0H9.375C9.16875 0 9 0.16875 9 0.375V2H5V0.375C5 0.16875 4.83125 0 4.625 0H3.375C3.16875 0 3 0.16875 3 0.375V2H1.5C0.671875 2 0 2.67188 0 3.5V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V3.5C14 2.67188 13.3281 2 12.5 2ZM12.3125 14.5H1.6875C1.58438 14.5 1.5 14.4156 1.5 14.3125V5H12.5V14.3125C12.5 14.4156 12.4156 14.5 12.3125 14.5Z" fill="#939393" />
                                    </svg>
                                    ${convertDate(element.date)}
                                </span>
                                <span class="inline-flex items-center text-xs">
                                    <svg class="mr-1.5" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.65217 0C3.42496 0 0 3.58065 0 8C0 12.4194 3.42496 16 7.65217 16C11.8794 16 15.3043 12.4194 15.3043 8C15.3043 3.58065 11.8794 0 7.65217 0ZM7.65217 14.4516C4.24264 14.4516 1.48107 11.5645 1.48107 8C1.48107 4.43548 4.24264 1.54839 7.65217 1.54839C11.0617 1.54839 13.8233 4.43548 13.8233 8C13.8233 11.5645 11.0617 14.4516 7.65217 14.4516ZM9.55905 11.0839L6.93941 9.09355C6.84376 9.01935 6.78822 8.90323 6.78822 8.78065V3.48387C6.78822 3.27097 6.95484 3.09677 7.15849 3.09677H8.14586C8.34951 3.09677 8.51613 3.27097 8.51613 3.48387V8.05484L10.5773 9.62258C10.7439 9.74839 10.7778 9.99032 10.6575 10.1645L10.0774 11C9.95708 11.171 9.72567 11.2097 9.55905 11.0839Z" fill="#939393" />
                                    </svg>
                                    10 Min To Read
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;
        });

        $('#artikel_container').append(html);

        // Initialize Swiper after articles have been appended
        // var swiper = new Swiper('.reviews-carousel', {
        //     loop: true,
        //     autoplay: {
        //         delay: 3000,
        //         disableOnInteraction: false,
        //     },
        //     pagination: {
        //         el: '.swiper-pagination',
        //         clickable: true,
        //     },
        // });

    } catch (error) {
        notif("error", "Galat!", error);
    }
}

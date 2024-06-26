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

            let tags = `<div class="flex gap-3">`;
            element.tags.forEach((tag) => {
                tags += `<a href="/article?tag=${tag.name}" class="tag-card">${tag.name}</a>`;
            });
            tags += `</div>`;
        
            let string = element.content.substring(0, 200);


            let parser = new DOMParser();
            let doc = parser.parseFromString(string, "text/html");
            let content = doc.body.textContent || "";
            
            // let content = element.content;
            // let doc = document.createElement("div");

            // doc.innerHTML = content;

            // console.log(doc.innerHTML);

            html += `<div class="swiper-slide">`;
            html += `<div class="mb-8" style="height:600px">`;
            html += `<div class="card flex flex-col justify-between cursor-pointer" onclick="window.location.href='${baseL}/article/${element.id}'">`;
            html += `<div><img class="card-img w-full object-cover" style="height:200px" src="${baseL}/${element.image}" alt="" />`;
            html += `<div class="card-tags"><a class="tag" href="${baseL}/article?category=${element.category_name}">${element.category_name}</a></div>
                        <h3 class="h4 card-title mt-5">${element.title}</h3>
                        <p">${content}...</p>
                    </div>`;
            html += `<div class="card-content">`;
            html += tags;
            html += `<div class="card-footer mt-6 flex justify-between space-x-4">`;
            html += `<span class="inline-flex items-center text-xs text-[#666]">
                        <svg class="mr-1.5" width="14" height="16" viewBox="0 0 14 16"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.5 2H11V0.375C11 0.16875 10.8313 0 10.625 0H9.375C9.16875 0 9 0.16875 9 0.375V2H5V0.375C5 0.16875 4.83125 0 4.625 0H3.375C3.16875 0 3 0.16875 3 0.375V2H1.5C0.671875 2 0 2.67188 0 3.5V14.5C0 15.3281 0.671875 16 1.5 16H12.5C13.3281 16 14 15.3281 14 14.5V3.5C14 2.67188 13.3281 2 12.5 2ZM12.3125 14.5H1.6875C1.58438 14.5 1.5 14.4156 1.5 14.3125V5H12.5V14.3125C12.5 14.4156 12.4156 14.5 12.3125 14.5Z"
                                fill="#939393" />
                        </svg>
                        ${convertDate(element.date)}
                    </span>`;
            html += `<span class="inline-flex items-center text-xs text-[#666]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                            </svg>
                        <p class="pl-1">${element.user_name}</p>
                    </span>`;
            html += `</div>`;
            html += `</div>`;
            html += `</div>`;
            html += `</div>`;
            html += `</div>`;

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

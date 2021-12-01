var state = {
    currentPage: 1,
    nextPage: 2,
    prevPage: 0,
    nextPagePagination: 2,
    prevPagePagination: 0,
    data: [],
    dataFiltered: []
}

var render = {
    renderByData: () => {
        let i = 0;
               
        for (var prop in state.data.ITEMS) {
            let obj = state.data.ITEMS[prop]
            
            let cssClass = '';
            if (i == 1 || i == 4 || i == 8 || i == 11) { 
                cssClass = 'medium'; 
            }
            if (i == 2 || i == 3 || i == 5 || i == 7 || i == 6 || i == 9 || i == 10) { 
                cssClass = 'small-page'; 
            } 
            let datePost;
            if (obj.DATE_ACTIVE_FROM == null) {
                datePost = 'Н/У';
            }else{
                datePost = obj.DATE_ACTIVE_FROM.split(" ")[0];
            }
           
            console.log(datePost);
            $('.main-page-block').append(`
                <div class="main-page-block-wrap ${cssClass}">
                    <div class="about-wrap-img about-wrap-img-position about-wrap-img-margin" style="background: url(${obj.PREVIEW_PICTURE});">
                        <span class="about-span-img">
                            <svg width="26" height="24" viewBox="0 0 26 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M25.4936 4.36572C26.6745 8.04257 25.6862 11.784 23.6036 14.603C22.2289
                                    16.5146 20.586 18.1622 18.9064 19.6026C17.361 21.0522 13.9028 23.9203 12.9861 24C12.1759 23.8439
                                    11.2668 22.9207 10.6236 22.4455C7.00923 19.6768 3.11848 16.3098 1.14569 12.6284C-0.508344
                                    9.09409 -0.511377 4.72262 2.0629 2.01297C5.40087 -1.0195 10.4332 -0.426946 12.9861 2.74122C13.6717
                                    1.84494 14.5148 1.14003 15.5154 0.626539C19.5717 -1.00506 23.7915 0.657499 25.4936 4.36572Z"
                                        fill="white"></path>
                            </svg>
                         </span>
                    </div>
                    <div class="about-wrap-page">
                        <div class="about-wrap-title">
                            <h3 class="page-title">${obj.NAME}</h3>
                        </div>
                        <div class="about-wrap-text">
                            <p class="page-text">
                                ${obj.PREVIEW_TEXT}
                            </p>
                        </div>
        
                        <div class="about-wrap-link">
                            <div class="about-link-wrap">
                                <a href="${obj.URL}">Подробнее</a>
                            </div>
                            <div class="about-link-date">
                                ${datePost}
                            </div>
                        </div>
                    </div>
                </div>`);

            i++;
          }
          $( ".bx-pagination" ).show(); 
    },
    
    renderByDataFiltered: () => {
        let i = 0;
               
        for (var prop in state.dataFiltered.ITEMS) {
            let obj = state.dataFiltered.ITEMS[prop]
            
            let tags = '<div class="ibc-tags">';
            obj.TAGS.forEach(function(item, i, arr) {
                tags = tags + `<div class="ibc-tag-value">${item}</div>`;
            });
            tags = tags + `</div>`;

            
            console.log(tags);

            let cssClass = '';
            if (i == 1 || i == 4 || i == 8 || i == 11) { 
                cssClass = 'medium'; 
            }
            if (i == 2 || i == 3 || i == 5 || i == 7 || i == 6 || i == 9 || i == 10) { 
                cssClass = 'small-page'; 
            } 
            let datePost;
            if (obj.DATE_ACTIVE_FROM == null) {
                datePost = 'Н/У';
            }else{
                datePost = obj.DATE_ACTIVE_FROM.split(" ")[0];
            }
            let likeCssClass = '';
            if (obj.LIKED == 1) {
                likeCssClass = 'ibc-liked';
            }else{
                likeCssClass = '';
            }
            $('.main-page-block').append(`
                <div class="main-page-block-wrap ${cssClass}">
                    <div class="about-wrap-img about-wrap-img-position about-wrap-img-margin" style="background: url(${obj.PREVIEW_PICTURE});">
                         ${tags}
                        <span class="about-span-img ibc-like-article ${likeCssClass}" ibc-data-like-id="${obj.ID}"></span>
                        <!--span class="about-span-img">
                            <svg width="26" height="24" viewBox="0 0 26 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M25.4936 4.36572C26.6745 8.04257 25.6862 11.784 23.6036 14.603C22.2289
                                    16.5146 20.586 18.1622 18.9064 19.6026C17.361 21.0522 13.9028 23.9203 12.9861 24C12.1759 23.8439
                                    11.2668 22.9207 10.6236 22.4455C7.00923 19.6768 3.11848 16.3098 1.14569 12.6284C-0.508344
                                    9.09409 -0.511377 4.72262 2.0629 2.01297C5.40087 -1.0195 10.4332 -0.426946 12.9861 2.74122C13.6717
                                    1.84494 14.5148 1.14003 15.5154 0.626539C19.5717 -1.00506 23.7915 0.657499 25.4936 4.36572Z"
                                        fill="white"></path>
                            </svg>
                             
                         </span-->
                    </div>
                    <div class="about-wrap-page">
                        <div class="about-wrap-title">
                            <h3 class="page-title">${obj.NAME}</h3>
                        </div>
                        <div class="about-wrap-text">
                            <p class="page-text">
                                ${obj.PREVIEW_TEXT}
                            </p>
                        </div>
        
                        <div class="about-wrap-link">
                            <div class="about-link-wrap">
                                <a href="${obj.URL}">Подробнее</a>
                            </div>
                            <div class="about-link-date">
                                ${datePost}
                            </div>
                        </div>
                    </div>
                </div>`);

            i++;
          }
          $( ".bx-pagination" ).hide(); 
    },

    renderNextPagePagination: () => {
        console.log('renderNextPagePagination');
    },
    renderPrevPagePagination: () => {
        console.log('renderPrevPagePagination');
    },
}

setTimeout(() => {
    $(document).ready(function(){


        $( ".ibc-like-article" ).click(function(event) {
            event.preventDefault();
            let id = $(this).attr("ibc-data-like-id");
            let likeBtn = $(this);
            $.ajax({
                url: '/ajax/blog/like.php',
                method: 'post',
                dataType: 'html',
                data: {id: id},
                success: function(data){
                    console.log(JSON.parse(data));
                    likeBtn.addClass('ibc-liked');
                }
            });

        });

        $( ".ibc-bx-pag-prev" ).click(function(event) {
            event.preventDefault();

            if(state.prevPage == state.prevPagePagination){
                render.renderPrevPagePagination();
            }else{
                $.ajax({
                    url: '/ajax/blog/page.php',
                    method: 'post',
                    dataType: 'html',
                    data: {numPage: state.prevPage},
                    success: function(data){
                        state.data = JSON.parse(data);
                        //console.log(state);
                        $( ".main-page-block" ).empty();
                        render.renderByData();
                        $(".ibc-page" ).removeClass("bx-active");
                        $(".ibc-page[ibc-data-pagination="+state.prevPage+"]" ).addClass("bx-active");

                        state.currentPage = state.prevPage;
                        state.nextPage--;
                        state.prevPage--;
                    }
                });
            }

        });

        $( ".ibc-bx-pag-next" ).click(function(event) {
            event.preventDefault();

            if(state.nextPage > state.nextPagePagination){
                render.renderNextPagePagination();
            }else{
                $.ajax({
                    url: '/ajax/blog/page.php',
                    method: 'post',
                    dataType: 'html',
                    data: {numPage: state.nextPage},
                    success: function(data){
                        state.data = JSON.parse(data);
                        //console.log(state);
                        $( ".main-page-block" ).empty();
                        render.renderByData();
                        $(".ibc-page" ).removeClass("bx-active");
                        $(".ibc-page[ibc-data-pagination="+state.nextPage+"]" ).addClass("bx-active");

                        state.currentPage = state.nextPage;
                        state.nextPage++;
                        state.prevPage++;


                    }
                });
            }


        });

        $( ".ibc-page" ).click(function(event) {
            event.preventDefault();
            state.pageBtn = $(this).attr("ibc-data-pagination");
            $.ajax({
                url: '/ajax/blog/page.php',
                method: 'post',
                dataType: 'html',
                data: {numPage: state.pageBtn},
                success: function(data){
                    state.data = JSON.parse(data);
                    //console.log(state);
                    $( ".main-page-block" ).empty();
                    render.renderByData();
                    $(".ibc-page" ).removeClass("bx-active");
                    $(".ibc-page[ibc-data-pagination="+state.pageBtn+"]" ).addClass("bx-active");
                }
            });
        });

        $( ".ibc_search_btn" ).click(function(event) {
            event.preventDefault();

            state.pageSearch = $( ".ibc_search_input" ).val();
            if(state.pageSearch == ""){
                $.ajax({
                    url: '/ajax/blog/page.php',
                    method: 'post',
                    dataType: 'html',
                    data: {numPage: 1},
                    success: function(data){
                        state.data = JSON.parse(data);
                        //console.log(state);
                        $( ".main-page-block" ).empty();
                        render.renderByData();
                        $(".ibc-page" ).removeClass("bx-active");
                        $(".ibc-page[ibc-data-pagination="+1+"]" ).addClass("bx-active");
                    }
                });
            }else{
                $.ajax({
                    url: '/ajax/blog/filter.php',
                    method: 'post',
                    //dataType: 'html',
                    data: {filter: state.pageSearch},
                    success: function(data){
                        state.dataFiltered = JSON.parse(data);
                        console.log(state.data);
                        $( ".main-page-block" ).empty();
                        render.renderByDataFiltered();

                    }
                });
            }
        });

        $( ".ibc-tag-value" ).click(function(event) {
            event.preventDefault();
            console.log('ibc tag!');
            state.pageSearch = $(this).text();
            $.ajax({
                url: '/ajax/blog/filterByTag.php',
                method: 'post',
                //dataType: 'html',
                data: {filter: state.pageSearch},
                success: function(data){
                    state.dataFiltered = JSON.parse(data);
                    console.log(state.data);
                    $( ".main-page-block" ).empty();
                    render.renderByDataFiltered();

                }
            });
        });

    })
}, 0);
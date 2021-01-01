$(document).ready(()=>{
    const postsContainer = $('.posts-container>.row');
    const tabLinks = $('.category-tab');

    function renderPosts(data) {

        let posts = [];

        data.forEach(elem => {
            const post =    `<div class="col-12 col-sm-6 col-md-4">
                                <div class="post custom-shadow">

                                    <!-- Thumbnail -->
                                    <div class="post__thumbnail">
                                        <img src="${elem.thumbnail || ''}" alt="Post thumbnail">
                                    </div>
                                    
                                    <!-- Title -->
                                    <h4 class="post__title">
                                        ${elem.title}
                                    </h4>
                                    
                                    <!-- Link & Date -->
                                    <div class="post__link-date d-flex justify-content-between">
                                        
                                        <!-- Link -->
                                        <a href="${elem.permalink}" class="post__link">Read...</a>
                            
                                        <!-- Date -->
                                        <div class="post__date">
                                            ${elem.date}
                                        </div>
                                    </div>
                                </div>
                            </div>`;

            posts.push($.parseHTML(post)[0]);
        });

        postsContainer.html(posts);
    }

    function sendAJAXRequest(data) {
        $.ajax({
            url: '/wp-admin/admin-ajax.php?action=get_posts',
            data: data,
            success: function (response) {

                // Receiving response from backend side
                const packedResponse = JSON.parse(response);

                // Call render function
                renderPosts(packedResponse);
            }
        });
    }

    tabLinks.click(function(e) {
        e.preventDefault();

        // Check if clicked link already has 'current' class
        if ($(this).hasClass('current')) return false;

        // Add 'current' class to clicked link and remove it from others
        tabLinks.removeClass('current');
        $(this).addClass('current');

        // Pack request data
        const packedData = {
            id: $(this).data('cat'),
            lang: $(this).data('lang'),
        }
        
        // Send AJAX request to backend side
        sendAJAXRequest(packedData);
    });

    const initData = {
        id: $('.category-tab.current').data('cat'),
        lang: $('.category-tab.current').data('lang'),
    }

    sendAJAXRequest(initData);
});
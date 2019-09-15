$(function () {
    //準備請求資料，顯示模態框
    $('div.loading').show();

    $.ajax({
        url: "/ajax_handler.html/",
        type: 'GET',
        data: {},
        success: function (response) {
            var content = response.content;
            $('#content').html(content);

            //請求完成，隱藏模態框
            $('div.loading').hide();
        },
        error: function () {
            $('#content').html('server error...');

            //請求完成，隱藏模態框
            $('div.loading').hide();
        }
    })
});

$(function() {
    $('.js-follow').click(function() {
        const this_obj = $(this);
        const followed_user_id = $(this).data('followed-user-id');
        const follow_id = $(this).data('follow-id');
        cache: false
        if(follow_id) {
            // フォローを取り消し
            $.ajax({
                url: 'follow.php',
                type: 'POST',
                data: {
                    'follow_id': follow_id
                },
                timeout: 10000
            })
                // 取り消し成功
                .done(() => {
                    this_obj.removeClass('follow-btn');
                    this_obj.addClass('profile-btn');
                    this_obj.text('フォローする');
                    this_obj.data('follow-id', null);
                })
                // 取り消し失敗
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        } else {
            // フォローする
            $.ajax({
                url: 'follow.php',
                type: 'POST',
                data: {
                    'followed_user_id': followed_user_id
                },
                timeout: 10000
            })
                // フォロー成功
                .done((data) => {
                    this_obj.removeClass('profile-btn');
                    this_obj.addClass('follow-btn');
                    this_obj.text('フォローを外す');
                    this_obj.data('follow-id', data['follow_id']);
                })
                // フォロー失敗
                .fail((data) => {
                    alert('処理中にエラーが発生しました。');
                    console.log(data);
                });
        }
    })
});
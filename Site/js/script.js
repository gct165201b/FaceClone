
$(document).ready(function() {
    var postCount = 2;
    $('#load-posts').click(function() {
        console.log(this);
        postCount += 2;
        $('.posts').load('./includes/loadpost.php', {
            newPostCount: postCount
        },function() {
            console.log('Data Loaded!');
        });
    });
});


$(document).ready(function() {
    $('#posts').load('loadpost.php', {
        newPostCount: 2
    },function() {
        console.log('Data Loaded!');
    });
});

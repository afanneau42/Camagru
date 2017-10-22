window.onscroll = function() {myFunction()};
    var body = document.querySelector('#body');
    var page = 0;
function myFunction() {
    if (document.body.scrollTop > body.scrollHeight - 1000 || document.documentElement.scrollTop > body.scrollHeight - 1000) {
        console.log("test");
        page += 1;
        var i = 11;
        while (i <= page*10)
        {
            if (document.getElementById("post_card_" + i))
            {
                document.getElementById("post_card_" + i).removeAttribute('class');
                document.getElementById("post_card_" + i).setAttribute('class', 'post_card');
                document.getElementById("post_card_" + i).setAttribute('style', 'animation-name: card_anim;animation-duration: 2.5s;');
            }
            i +=1;
        }
    }
    
}

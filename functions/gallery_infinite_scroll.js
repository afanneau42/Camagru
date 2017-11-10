window.onscroll = function() {myFunction()};
    var page = 0;
function myFunction() {
    if (document.documentElement.scrollTop + window.innerHeight >= document.body.clientHeight - window.innerHeight * 0.1){
        page += 1;
        var i = 13;
        while (i <= page * 3)
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

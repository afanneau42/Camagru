window.onscroll = function() {myFunction()};
    var page = 0;
function myFunction() {
    if (document.documentElement.scrollTop > ((document.documentElement.offsetHeight - document.documentElement.clientHeight) * 0.5)){
        console.log(document.body.scrollTop);
        page += 1;
        var i = 10;
        while (i <= page * 9)
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

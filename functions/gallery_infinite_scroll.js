window.onscroll = function() {myFunction()};
    var page = 0;
function myFunction() {

    console.log(document.body.offsetHeight);
    console.log(document.body.clientHeight);
    if (document.body.scrollTop > ((document.body.offsetHeight - document.body.clientHeight) * 0.8)){
        console.log(document.body.scrollTop);
        page += 1;
        var i = 11;
        while (i <= page * 10)
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

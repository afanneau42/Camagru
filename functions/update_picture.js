function display_new(id, type, uid) {
    var new_d = document.createElement("div");
    var new_a_del = document.createElement("a");
    var new_i = document.createElement("i");
    var new_a_post = document.createElement("a");
    var pic_back = document.createElement("div");

    new_d.setAttribute("class", "picture_history");
    new_d.setAttribute("id", "pic_" + id);
    new_a_del.setAttribute("href", "delete_post.php?id=" + id);
    new_i.setAttribute("class", "fa fa-times fa-2x");
    new_i.setAttribute("aria-hidden", "true");
    
    new_a_del.appendChild(new_i);
    new_d.appendChild(new_a_del);

    new_a_post.setAttribute("href", "post_page.php?id=" + id + "&type=" + type);
    pic_back.setAttribute("class", "picture_background");
    pic_back.setAttribute("style", "background-image: url(ressources/pictures/" + id + type + ");");

    new_a_post.appendChild(pic_back);
    new_d.appendChild(new_a_post);

    document.getElementById("pictures").insertBefore(new_d, document.getElementById("pictures").childNodes[0]);
    
};
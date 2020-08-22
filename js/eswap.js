window.onload = function() {
    function remove(){
        let id = this.getAttribute("data-id");
        if(confirm("Are you sure to delete this item?"))
            ajaxRequest("remove.php","get",{"barter_id":id}, function() {
                window.location.reload();
            }, function() {
                alert("Delete Error");
            });
    }
    function select(value){
        window.location.href="list.php?select_category="+value;
    }
    function barter_card_addclick() {
        let barter_card_list = document.querySelectorAll(".rec-card");
        for (let i = 0; i < barter_card_list.length;i++) {
            let childen_list = barter_card_list[i].querySelectorAll(".rec-avatar,.rec-title,.rec-content");
            for (let j = 0; j < childen_list.length; j++) {
                childen_list[j].onclick =function() {
                    window.location.href = "barter_detail.php?barter_id=" + barter_card_list[i].getAttribute("value");
                } 
            }
        }
    } 
    function query_barters(){
        let category_id = document.getElementById("category_select").value;
        let date_sort = document.getElementById("date_sort_select").value;
        let search_value = document.getElementById("search_input").value;
        if (category_id == "all") {
            ajaxRequest("getbarters.php","get",{"date_sort":date_sort,"like_name":search_value}, function() {
                document.getElementById("card-content").innerHTML = this.responseText;
                barter_card_addclick();
            }, function() {
                alert("Query Error");
            });
        } else {
            ajaxRequest("getbarters.php","get",{"category_id":category_id,"date_sort":date_sort,"like_name":search_value}, function() {
                document.getElementById("card-content").innerHTML = this.responseText;
                barter_card_addclick();
            }, function() {
                alert("Query Error");
            });
        }
    }

    let category_select = document.getElementById("category_select");
    category_select.onchange =  query_barters;

    let date_sort_select = document.getElementById("date_sort_select");
    date_sort_select.onchange = query_barters;

    let search_input = document.getElementById("search_input");
    search_input.onkeyup = query_barters;

    let delete_button = document.querySelectorAll(".delete_button");
    for (let i = 0; i <delete_button.length;i++) {
        delete_button[i].onclick = remove;
    }
    barter_card_addclick();
    
}
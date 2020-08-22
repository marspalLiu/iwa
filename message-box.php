<?php
    session_start();
    include("include/util.inc.php");

    $user_id = $_SESSION["user_id"];

    include("include/html-head.html");
    include("include/banner.php");

    $rows = $db->query("SELECT
        m.*, 
        u1.user_name AS exchange_user_name,
        u2.user_name AS be_exchange_user_name,
        o1.barter_name AS exchange_object_name,
        o2.barter_name AS be_exchanged_object_name
    FROM
        messsages m
    LEFT JOIN users u1 ON m.exchange_user_id = u1.user_id
    LEFT JOIN users u2 ON m.be_exchanged_user_id = u2.user_id
    LEFT JOIN barters o1 ON m.exchange_object_id = o1.barter_id
    LEFT JOIN barters o2 ON m.be_exchanged_object_id = o2.barter_id
    WHERE
        exchange_user_id = ".$db->quote($user_id)."
    OR be_exchanged_user_id = ".$db->quote($user_id)."
    group by exchange_user_id,exchange_object_id,be_exchanged_user_id,be_exchanged_object_id");

?>
    <div class="page-name">
        <span>My message box</span>
    </div>


    <div class="chat-block">
        <div class="chat-contacts">
            <ul>
<?php
                foreach ($rows as $row){
                    $exchange_user_id = $row['exchange_user_id'];
                    $exchanger_name = $row['exchange_user_name'];
                    $exchange_object_id = $row['exchange_object_id'];
                    $exchange_object_name = $row['exchange_object_name'];
                    $be_exchange_user_id = $row['be_exchanged_user_id'];
                    $be_exchange_user_name = $row['be_exchange_user_name'];
                    $be_exchanged_object_id = $row['be_exchanged_object_id'];
                    $be_exchanged_object_name = $row['be_exchanged_object_name'];
                    $message = $row['message'];
                    $type = "";
                    if ($exchange_user_id == $user_id) {
                        # you are exchange_user
                        $type = "exchanger";
                    }else{
                        $type = "beExchanger";
                    }
?>
                <li onclick="openDialog(<?=$exchange_user_id ?>,'<?=$exchanger_name ?>',<?= $exchange_object_id?>,'<?= $exchange_object_name ?>',<?=$be_exchange_user_id?>,'<?=$be_exchange_user_name ?>',<?=$be_exchanged_object_id?>,'<?= $be_exchanged_object_name ?>','<?= $type ?>')">
                    
                    <div class="contact-info">
                        <a href="javascript:void(0);" >
                            <img class="chat-avatar" src="images/1.png" alt="">
                            <span class="chat-name">
                                <?= $type=="exchanger"?$be_exchange_user_name:$exchanger_name ?>
                            </span>
                        </a>
                    </div>
                    <div class="goods-info">
                        <div class="my-good">
                            <a href="javascript:void(0)">
                                <span><?= $type=="exchanger"?$be_exchanged_object_name:$exchange_object_name ?> </span>
                            </a>
                        </div>
                        <img src="images/exchange.png" class="exchange-icon">
                        <div class="his-good">
                            <a href="javascript:void(0)">
                                <span><?= $type=="exchanger"?$exchange_object_name:$be_exchanged_object_name ?></span>
                            </a>
                        </div>
                    </div>
                </li>
<?php
                }
?>    
            </ul>
        </div>
        <!-- <div id="chat-content-default" class="chat-content-default">

        </div> -->
        <div id="chat-content" class="chat-content" style="visibility:hidden">
            <div class="content-header">
                <div class="content-header-goods">
                    <div class="my-goods">
                        <span>My </span>
                        <span>Barter name:<a href="barter_detail.php?barter_id=<?=$exchange_object_id?>"><span id="myObjectName">PC</span></a></span>
                    </div>
                    <div class="his-goods">
                        <span>His/Her </span>
                        <span>Barter name: <a href="barter_detail.php?barter_id=<?=$be_exchanged_object_id?>"><span id="hisObjectName">PC</span></a></span>
                    </div>
                </div>
                <div class="content-header-avatar">
                    <div>
                        <img class="chat-avatar" src="./images/1.png" alt="">
                    </div>
                    <div class="clear-both"></div>
                    <div class="chat-name" id="hisName">
                        Ethan Hawke
                    </div>
                </div>
            </div>
            <div class="content-body" id="content-body">
                <ul id="content-ul">
                </ul>
            </div>
            <div class="content-input">
                <textarea id="message"></textarea>
                <button id="confirm-button" onclick="exchange()" style="visibility:hidden">Confirm Exchange</button>
                <button id="reply-button" onclick="reply()">Send Message</button>
            </div>
        </div>
    </div>

<script>
    let currentObj = {
        exchange_user_id:null,
        exchange_user_name:null,
        exchange_object_id:null,
        exchange_object_name:null,
        be_exchange_user_id:null,
        be_exchange_user_name:null,
        be_exchanged_object_id:null,
        be_exchanged_object_name:null,
        type:null
    }
    function remove_message(e){
        let param={
            be_exchanged_user_id :currentObj.be_exchange_user_id,
            be_exchanged_object_id:currentObj.be_exchanged_object_id,
            exchange_user_id:currentObj.exchange_user_id,
            exchange_object_id:currentObj.exchange_object_id,
        }
        if(confirm("Are you sure to remove this message?"))
            ajaxRequest("remove_message.php","post",param, function() {
                window.location.reload();
            }, function() {
                alert("Remove this message Error");
            });
    }
    function exchange(){
        let param={
            be_exchanged_user_id :currentObj.be_exchange_user_id,
            be_exchanged_object_id:currentObj.be_exchanged_object_id,
            exchange_user_id:currentObj.exchange_user_id,
            exchange_object_id:currentObj.exchange_object_id,
        }
        if(confirm("Are you sure to exchange?"))
            ajaxRequest("exchange.php","post",param, function() {
                window.location.reload();
            }, function() {
                alert("Exchange Error");
            });
    }

    function openDialog(exchange_user_id,exchange_user_name,exchange_object_id,exchange_object_name,be_exchange_user_id,be_exchange_user_name,be_exchanged_object_id,be_exchanged_object_name,type){
        
        currentObj={
            exchange_user_id:exchange_user_id,
            exchange_user_name:exchange_user_name,
            exchange_object_id:exchange_object_id,
            exchange_object_name:exchange_object_name,
            be_exchange_user_id:be_exchange_user_id,
            be_exchange_user_name:be_exchange_user_name,
            be_exchanged_object_id:be_exchanged_object_id,
            be_exchanged_object_name:be_exchanged_object_name,
            type:type
        }

        document.getElementById("chat-content").style.visibility = "visible";
        console.log(be_exchange_user_id)
        console.log(<?= $user_id?>)
        console.log(be_exchange_user_id == "<?= $user_id?>")
        if (be_exchange_user_id == "<?= $user_id?>") {
            document.getElementById("confirm-button").style.visibility = "visible";
        }else{
            document.getElementById("confirm-button").style.visibility = "hidden";
        }

        var myObjectName = document.getElementById("myObjectName");
        var hisObjectName = document.getElementById("hisObjectName");
        var hisName = document.getElementById("hisName");
        if (type == "exchanger") {
            myObjectName.innerText = exchange_object_name;
            hisObjectName.innerText = be_exchanged_object_name;
            hisName.innerText = be_exchange_user_name;
        }else{
            myObjectName.innerText = be_exchanged_object_name;
            hisObjectName.innerText = exchange_object_name;
            hisName.innerText = exchange_user_name;
        }
        ajaxRequest("query-message.php","post",{be_exchanged_user_id:be_exchange_user_id, be_exchanged_object_id:be_exchanged_object_id, exchange_user_id:exchange_user_id, exchange_object_id:exchange_object_id}, function(response) {
            const data = JSON.parse(response.currentTarget.responseText);
            let contentContainer = document.getElementById("content-body");
            contentContainer.removeChild(document.getElementById("content-ul"));
            let contentUl = document.createElement("ul");
            contentUl.setAttribute("id","content-ul");
            for (var i = 0; i < data.length; i++) {
                const item = data[i];
                if (item.send_user_id == <?= $user_id ?>) {
                    // This message is send by your self,render it on the right
                    var liEle = document.createElement("li");
                    let htmlContent ='<div class="right-content">';
                        htmlContent+=   '<img src="./images/user.png">';
                        htmlContent+=   '<div class="clear-both"></div>';
                        htmlContent+=   '<div class="content">';
                        htmlContent+=        '<span>';
                        htmlContent+= item.message;
                        htmlContent+=        '</span>';
                        htmlContent+=   '</div> ';
                        htmlContent+='</div>';
                        htmlContent+=   '<div class="clear-both"></div>';
                    liEle.innerHTML = htmlContent;
                    contentUl.appendChild(liEle);
                }else{
                    var liEle = document.createElement("li");
                    let htmlContent ='<div class="left-content">';
                        htmlContent+=   '<img src="./images/1.png">';
                        htmlContent+=   '<div class="content">';
                        htmlContent+=        '<span>';
                        htmlContent+= item.message;
                        htmlContent+=        '</span>';
                        htmlContent+=   '</div> ';
                        htmlContent+='</div>';
                    liEle.innerHTML = htmlContent;
                    contentUl.appendChild(liEle);
                }
            };
            contentContainer.appendChild(contentUl);
        }, function() {
            alert("Exchange Error");
        });

    }

    function reply(){
        var messageEle = document.getElementById("message")
        let message = messageEle.value;
        if (message == "") {
            alert("You input nothing!");
            return false;
        };
        let param={
            be_exchanged_user_id :currentObj.be_exchange_user_id,
            be_exchanged_object_id:currentObj.be_exchanged_object_id,
            exchange_user_id:currentObj.exchange_user_id,
            exchange_object_id:currentObj.exchange_object_id,
            message:message
        }
        ajaxRequest("reply-action.php","GET",param, function(response) {
        
                var contentUl = document.getElementById("content-ul");
                var liEle = document.createElement("li");
                let htmlContent ='<div class="right-content">';
                    htmlContent+=   '<img src="./images/user.png">';
                    htmlContent+=   '<div class="clear-both"></div>';
                    htmlContent+=   '<div class="content">';
                    htmlContent+=        '<span>';
                    htmlContent+= message;
                    htmlContent+=        '</span>';
                    htmlContent+=   '</div> ';
                    htmlContent+='</div>';
                    htmlContent+=   '<div class="clear-both"></div>';
                liEle.innerHTML = htmlContent;
                contentUl.appendChild(liEle);
                messageEle.value="";
        }, function() {
            alert("Exchange Error");
        });
    }
</script>

<?php
    include("include/html-closing.html");
?>

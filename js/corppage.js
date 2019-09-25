$(document).ready(function() {

    $("#accountBtn").css("background-color","skyblue");
    $("#accountBtn").css("border-radius","4px");
    $("#accountBtn").click(function() {
        $(".col-sm-9 >").remove();
        $(".col-sm-9").append(account_info);
    });

    $("#transBtn").click(function() {
        $("#accountBtn").css("background-color","");
        $(".col-sm-9 >").remove();
        $(".col-sm-9").append(trans_record);
    });

    $("#corpBtn").click(function() {
        $("#accountBtn").css("background-color","");
        $(".col-sm-9 >").remove();
        $(".col-sm-9").append(corp_record);
    });

    $("#walletBtn").click(function() {
        // $("#accountBtn").css("background-color","");
        // $(".col-sm-9 >").remove();
        // $(".col-sm-9").append(wallet);
    });

    $("#investBtn").click(function() {
        // $("#accountBtn").css("background-color","");
        // $(".col-sm-9 >").remove();
        // $(".col-sm-9").append(invest);
    });
});

function deleteAlert(rId,address){
    if(confirm("確定刪除此筆資料?")){
        // window.alert(rId+" : "+address);
        // window.alert(rId+" "+address);
        $.ajax({
             url: "deleteRecord.php",
             type: "GET",
             data:{
                recordNo: rId,
                address: address
             },
             cache:false,
             dataType: "json",
             // contentType: 'application/json; charset=utf-8',
             success: function(data){
                 window.alert(data.status);
                 location.reload();
             },
             error:function(err){
                 window.alert(err.statusText);
                 location.reload();
             }
        });
    }
}

function deleteCorp(rId){
    if(confirm("確定刪除此筆資料?")){
        $.ajax({
             url: "deleteCorpRecord.php",
             type: "GET",
             data:{
                recordNo: rId
             },
             cache:false,
             dataType: "json",
             // contentType: 'application/json; charset=utf-8',
             success: function(data){
                 window.alert(data.status);
                 location.reload();
             },
             error:function(err){
                 window.alert(err.statusText);
                 location.reload();
             }
        });
    }
}

function setPageIndex(currentPage,totalPage){
    for(var i=1;i<=totalPage;i++){
        if(i == currentPage){
            $("#page-"+i).css("background-color","#DDDDDD");
        }
    }
}
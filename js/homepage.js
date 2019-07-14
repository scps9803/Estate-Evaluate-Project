var account_info =
    "<h2>編輯個人資料</h2>"+
    "<form action='/action_page.php'>"+
        "<div class='form-group'>"+
            "<label for='email'>Email:</label>"+
            "<input type='email' class='form-control' id='email' placeholder='輸入 Email' name='email' value='{$account_info.email}'>"+
        "</div>"+
        "<div class='form-group'>"+
            "<label for='name'>用戶名稱:</label>"+
            "<input type='text' class='form-control' id='name' placeholder='輸入用戶名稱' name='name' value='{$account_info.user_name}'>"+
        "</div>"+
        "<div class='form-group'>"+
            "<label for='pwd'>密碼:</label>"+
            "<input type='password' class='form-control' id='pwd' placeholder='輸入密碼' name='pwd'>"+
        "</div>"+
        "<div class='form-group'>"+
            "<label for='pwd_verify'>密碼確認:</label>"+
            "<input type='password' class='form-control' id='pwd_verify' placeholder='再次輸入密碼' name='pwd_verify'>"+
        "</div>"+
        "<div class='checkbox'>"+
            "<label><input type='checkbox' name='remember'> Remember me</label>"+
        "</div>"+
        "<button type='submit' class='btn btn-default'>送出修改</button>"+
    "</form>";
var trans_record =
    "<h2>歷史紀錄</h2>" +
    "<p>The .table-striped class adds zebra-stripes to a table:</p>" +
    "<table class='table table-striped'>" +

    "<thead>" +
    "<tr>" +
    "<th>調查表編號</th>" +
    "<th>段名</th>" +
    "<th>地號</th>" +
    "<th>查看/編輯</th>" +
    "<th>新增時間</th>" +
    "<th>下載報表</th>" +
    "</tr>" +
    "</thead>" +

    "<tbody>" +
    "{foreach from=$record key=k item=row}"+
    "<tr>" +
    "<td>{$row.k.rId}</td>" +
    "<td>{$row.address}</td>" +
    "<td>{}</td>" +
    "<td>{}</td>" +
    "<td>{}</td>" +
    "<td>{}</td>" +
    "</tr>" +
    "{/foreach}" +
    "</tbody>" +
    "</table>" +

    "<div class='align_center'>" +
    "<ul class='pagination'>" +
    "<li><a href='#'>1</a></li>" +
    "<li><a href='#'>2</a></li>" +
    "<li><a href='#'>3</a></li>" +
    "<li><a href='#'>4</a></li>" +
    "<li><a href='#'>5</a></li>" +
    "</ul>" +
    "</div>";

var wallet =
    "<h2>我的錢包</h2>" +
    "<h3>目前餘額: 599</h3>" +
    "<p>The .table-striped class adds zebra-stripes to a table:</p>" +

    "<div class='btn - group'>" +
    "<button type='button' class='btn btn-primary'>儲值</button>" +
    "<button type='button' class='btn btn-primary'>兌現</button>" +
    "</div>" +

    "<table class='table table - striped'>" +
    "<thead>" +
    "<tr>" +
    "<th>訂單編號</th>" +
    "<th>類型</th>" +
    "<th>金額</th>" +
    "<th>交易方式</th>" +
    "<th>交易時間</th>" +
    "</tr>" +
    "</thead>" +
    "<tbody>" +
    "<tr>" +
    "<td>t000001</td>" +
    "<td>儲值</td>" +
    "<td>$300</td>" +
    "<td>信用卡</td>" +
    "<td>2018-12-24 11:21:51.000000</td>" +
    "</tr>" +
    "<tr>" +
    "<td>t000002</td>" +
    "<td>收入</td>" +
    "<td>$150</td>" +
    "<td>系統撥款</td>" +
    "<td>2018-12-25 16:29:51.000000</td>" +
    "</tr>" +

    "</tbody>" +
    "</table>" +

    "<div class='align_center'>" +
    "<ul class='pagination'>" +
    "<li><a href='#'>1</a></li>" +
    "<li><a href='#'>2</a></li>" +
    "<li><a href='#'>3</a></li>" +
    "<li><a href='#'>4</a></li>" +
    "<li><a href='#'>5</a></li>" +
    "</ul>" +
    "</div>"

var invest =
    "<h2>投資現況</h2>" +
    "<h3>資產配置</h3>" +
    "<img src='uploads/piechart.jpg' width=100%>" +
    "<h3>資產總計</h3>" +

    "<table class='table table - striped' border='1'>"+
        "<tr>"+
            "<td class='invest_info'>"+
            "<h4>現金資產: $1,781,729</h4>" +
            "<h4>證券資產: $221,167</h4>" +
            "<h4>淨資產:&nbsp&nbsp&nbsp $123,456</h4>" +
            "<h4>累積獲利: $31,107</h4>" +
            "<h4>總報酬率: 1.56%</h4>" +
            "</td>"+
    "<td id='return_trend'><h4>報酬率走勢圖</h4><img src='uploads/stock.jpg' width='400' class='return_plot'></td>"+
        "</tr>"+
    "</table><hr>"+

    "<h3>庫存明細</h3>" +

//        "<div class='btn - group'>" +
//        "<button type='button' class='btn btn-primary'>儲值</button>" +
//        "<button type='button' class='btn btn-primary'>兌現</button>" +
//        "</div>" +

    "<table class='table table - striped'>" +
    "<thead>" +
    "<tr>" +
    "<th>台股代碼(名稱)</th>" +
    "<th>倉別</th>" +
    "<th>庫存/可交易</th>" +
    "<th>平均成本</th>" +
    "<th>現價</th>" +
    "</tr>" +
    "</thead>" +
    "<tbody>" +
    "<tr>" +
    "<td>2002(中鋼)</td>" +
    "<td>現股</td>" +
    "<td>5張/5張</td>" +
    "<td>23.40</td>" +
    "<td>24.15</td>" +
    "</tr>" +
    "<tr>" +
    "<td>4938(和碩)</td>" +
    "<td>現股</td>" +
    "<td>2張/2張</td>" +
    "<td>74.70</td>" +
    "<td>50.70</td>" +
    "</tr>" +

    "</tbody>" +
    "</table>" +

    "<div class='align_center'>" +
    "<ul class='pagination'>" +
    "<li><a href='#'>1</a></li>" +
    "<li><a href='#'>2</a></li>" +
    "<li><a href='#'>3</a></li>" +
    "<li><a href='#'>4</a></li>" +
    "<li><a href='#'>5</a></li>" +
    "</ul>" +
    "</div>"

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

    $("#walletBtn").click(function() {
        $("#accountBtn").css("background-color","");
        $(".col-sm-9 >").remove();
        $(".col-sm-9").append(wallet);
    });

    $("#investBtn").click(function() {
        $("#accountBtn").css("background-color","");
        $(".col-sm-9 >").remove();
        $(".col-sm-9").append(invest);
    });
});

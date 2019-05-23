var minus_wall_count = [1,1,1,1];
var add_wall_count = [1,1,1,1];
var indoor_divide_count = [1,1,1,1];
var outdoor_wall_decoration_count = [1,1,1,1];
var indoor_wall_decoration_count = [1,1,1,1];
var roof_decoration_count = [1,1,1,1];
var floor_decoration_count = [1,1,1,1];
var ceiling_decoration_count = [1,1,1,1];

function addItemOnclick(id,column,num){
    var itemId = "#"+id+column+"-"+num;

    switch (id) {
        case 'minus-wall-':
            minus_wall_count[column-1] += 1;

            text =
            '<div id="minus-wall-'+column+"-"+minus_wall_count[column-1]+'">'+
                '<span>減牆:</span>'+
                '<select name="minus-wall-num-'+column+"-"+ minus_wall_count[column-1] +'">'+
                    '<option value="" style="display:none;">請選擇面數</option>'+
                    '<option value="">1</option>'+
                    '<option value="">2</option>'+
                    '<option value="">3</option>'+
                    '<option value="">4</option>'+
                '</select>'+
                '<select name="minus-wall-option-'+column+"-"+ minus_wall_count[column-1] +'">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">RC牆</option>'+
                    '<option value="">1B</option>'+
                    '<option value="">1/2B</option>'+
                    '<option value="">檜木造</option>'+
                    '<option value="">其他木造</option>'+
                    '<option value="">竹編牆</option>'+
                '</select>'+
            '</div>';
            break;

        case 'add-wall-':
            add_wall_count[column-1] += 1;

            text =
            '<div id="add-wall-'+column+"-"+ add_wall_count[column-1]+'">'+
                '<span>加牆:</span>'+
                '<select name="add-wall-num-'+column+"-"+ add_wall_count[column-1] +'">'+
                    '<option value="" style="display:none;">請選擇面數</option>'+
                    '<option value="">1</option>'+
                    '<option value="">2</option>'+
                    '<option value="">3</option>'+
                    '<option value="">4</option>'+
                '</select>'+
                '<select name="add-wall-option-'+column+"-"+ add_wall_count[column-1] +'">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">RC牆</option>'+
                    '<option value="">1B</option>'+
                    '<option value="">1/2B</option>'+
                    '<option value="">檜木造</option>'+
                    '<option value="">其他木造</option>'+
                    '<option value="">竹編牆</option>'+
                '</select>'+
            '</div>';
            break;

        case 'indoor-divide-':
            indoor_divide_count[column-1] += 1;

            text =
            '<div id="indoor-divide-'+column+"-"+ indoor_divide_count[column-1]+'">'+
            '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
            '<select class="tiny-select-menu" name="indoor-divide-'+column+"-"+ indoor_divide_count[column-1] +'">'+
                '<option value="" style="display:none;">請選擇材質</option>'+
                '<option value="">RC牆</option>'+
                '<option value="">1B</option>'+
                '<option value="">1/2B</option>'+
                '<option value="">檜木造</option>'+
                '<option value="">其他木造</option>'+
                '<option value="">竹編牆</option>'+
            '</select>'+
            '</div>';
            break;

        case 'outdoor-wall-decoration-':
            outdoor_wall_decoration_count[column-1] += 1;

            text =
            '<div id="outdoor-wall-decoration-'+column+"-"+ outdoor_wall_decoration_count[column-1]+'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '<select name="outdoor-wall-decoration-'+column+"-"+ outdoor_wall_decoration_count[column-1] +'" class="tiny-select-menu">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">石馬</option>'+
                    '<option value="">油漆</option>'+
                    '<option value="">水泥粉刷</option>'+
                '</select>'+
            '</div>';
            break;

        case 'indoor-wall-decoration-':
            indoor_wall_decoration_count[column-1] += 1;

            text =
            '<div id="indoor-wall-decoration-'+column+"-"+ indoor_wall_decoration_count[column-1]+'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '<select name="indoor-wall-decoration-'+column+"-"+ indoor_wall_decoration_count[column-1] +'" class="tiny-select-menu">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">壁磚</option>'+
                    '<option value="">水泥粉刷PVC漆</option>'+
                    '<option value="">水泥粉光</option>'+
                '</select>'+
            '</div>';
            break;

        case 'roof-decoration-':
            roof_decoration_count[column-1] += 1;

            text =
            '<div id="roof-decoration-'+column+"-"+ roof_decoration_count[column-1]+'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '<select name="roof-decoration-'+column+"-"+ roof_decoration_count[column-1] +'" class="tiny-select-menu">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">臺灣瓦</option>'+
                    '<option value="">石棉瓦</option>'+
                    '<option value="">蓋鍍鋅亞鋁板</option>'+
                    '<option value="">平頂防水工程鋪防熱磚</option>'+
                    '<option value="">平頂防水工程</option>'+
                '</select>'+
            '</div>';
            break;

        case 'floor-decoration-':
            floor_decoration_count[column-1] += 1;

            text =
            '<div id="floor-decoration-'+column+"-"+ floor_decoration_count[column-1]+'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '<select name="floor-decoration-'+column+"-"+ floor_decoration_count[column-1] +'" class="tiny-select-menu">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">大理石</option>'+
                    '<option value="">磨石子</option>'+
                    '<option value="">平舖/高架木板</option>'+
                    '<option value="">石馬</option>'+
                    '<option value="">水泥粉刷</option>'+
                '</select>'+
            '</div>';
            break;

        case 'ceiling-decoration-':
            ceiling_decoration_count[column-1] += 1;

            text=
            '<div id="ceiling-decoration-'+column+"-"+ ceiling_decoration_count[column-1] +'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '<select name="ceiling-decoration-'+column+"-"+ ceiling_decoration_count[column-1] +'" class="tiny-select-menu">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">吸音板</option>'+
                    '<option value="">防火板</option>'+
                    '<option value="">石膏板</option>'+
                    '<option value="">麗光板</option>'+
                    '<option value="">PVC鋁輕鋼架</option>'+
                    '<option value="">水泥粉光PVC</option>'+
                    '<option value="">水泥粉光</option>'+
                '</select>'+
            '</div>';
            break;
    }
    $(itemId).append(text);
}

function removeItemOnclick(id,column){

    switch (id) {
        case 'minus-wall-':
            minus_wall_count[column-1] = removeItem(id+column , minus_wall_count[column-1]);
            break;

        case 'add-wall-':
            add_wall_count[column-1] = removeItem(id+column , add_wall_count[column-1]);
            break;

        case 'indoor-divide-':
            indoor_divide_count[column-1] = removeItem(id+column , indoor_divide_count[column-1]);
            break;

        case 'outdoor-wall-decoration-':
            outdoor_wall_decoration_count[column-1] = removeItem(id+column , outdoor_wall_decoration_count[column-1]);
            break;

        case 'indoor-wall-decoration-':
            indoor_wall_decoration_count[column-1] = removeItem(id+column , indoor_wall_decoration_count[column-1]);
            break;

        case 'roof-decoration-':
            roof_decoration_count[column-1] = removeItem(id+column , roof_decoration_count[column-1]);
            break;

        case 'floor-decoration-':
            floor_decoration_count[column-1] = removeItem(id+column , floor_decoration_count[column-1]);
            break;

        case 'ceiling-decoration-':
            ceiling_decoration_count[column-1] = removeItem(id+column , ceiling_decoration_count[column-1]);
            break;
    }
}

function removeItem(id,count){
    // var countVar = id.replace(/-/g,"_") + "count";
    // var itemId = "#"+id+count;
    var itemId = "#"+id+"-"+count;

    if (count > 1) {
        $(itemId).remove();
        count -= 1;
    }
    return count;
}

var isAppend = false;
function compensateFormClick(id){
    var itemId = "#"+id;
    var num = id.substr(-1,1);

    text =
    '<div id="sub-compensate-form-1">'+
    '<input type="radio" name="sub-compensate-form-1" onclick="removeAttic(' + num + ')">一般'+
    '<input type="radio" name="sub-compensate-form-1" onclick="attic(' + num + ')">閣樓板(夾層板)'+
    '</div>';

    if(!isAppend){
        $(itemId).append(text);
        isAppend = true;
    }
}

function attic(num){
    var item = "#attic-" + num + " > input";
    $(item).removeAttr("disabled");
}

function removeAttic(num){
    var item = "#attic-" + num + " > input";
    $(item).attr("disabled","true");
}

function removeSubCompensateForm(id){
    var item = "#"+id;
    var num = id.substr(-1,1);

    $(item).remove();
    removeAttic(num);
    isAppend = false;
}

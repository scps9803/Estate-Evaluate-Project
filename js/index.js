var minus_wall_count = [1,1,1,1];
var add_wall_count = [1,1,1,1];
var indoor_divide_count = [1,1,1,1];
var outdoor_wall_decoration_count = [1,1,1,1];
var indoor_wall_decoration_count = [1,1,1,1];
var roof_decoration_count = [1,1,1,1];
var floor_decoration_count = [1,1,1,1];
var ceiling_decoration_count = [1,1,1,1];
var toilet_equipment_count = [1,1,1,1];

var land_section_count = 1;
var subsection_count = 1;
var land_number_count = 1;
var owner_count = 1;
var hold_ratio_count = 1;
var pId_count = 1;
var address_count = 1;
var telephone_count = 1;
var cellphone_count = 1;

function addItemOnclick(id,column,num){
    var itemId = "#"+id+column+"-"+num;

    switch (id) {
        case 'minus-wall-':
            if(minus_wall_count[column-1] > 1){
                itemId = "#"+id+column+"-"+minus_wall_count[column-1];
            }
            minus_wall_count[column-1] += 1;

            text =
            '<div id="minus-wall-'+column+"-"+minus_wall_count[column-1]+'">'+
                '<span>減牆:&nbsp;</span>'+
                '<select name="minus-wall-num-'+column+"-"+ minus_wall_count[column-1] +'">'+
                    '<option value="" style="display:none;">請選擇面數</option>'+
                    '<option value="">1</option>'+
                    '<option value="">2</option>'+
                    '<option value="">3</option>'+
                    '<option value="">4</option>'+
                '</select>&nbsp;'+
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
            if(add_wall_count[column-1] > 1){
                itemId = "#"+id+column+"-"+add_wall_count[column-1];
            }
            add_wall_count[column-1] += 1;

            text =
            '<div id="add-wall-'+column+"-"+ add_wall_count[column-1]+'">'+
                '<span>加牆:&nbsp;</span>'+
                '<select name="add-wall-num-'+column+"-"+ add_wall_count[column-1] +'">'+
                    '<option value="" style="display:none;">請選擇面數</option>'+
                    '<option value="">1</option>'+
                    '<option value="">2</option>'+
                    '<option value="">3</option>'+
                    '<option value="">4</option>'+
                '</select>&nbsp;'+
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
            if(indoor_divide_count[column-1] > 1){
                itemId = "#"+id+column+"-"+indoor_divide_count[column-1];
            }
            indoor_divide_count[column-1] += 1;

            text =
            '<div id="indoor-divide-'+column+"-"+ indoor_divide_count[column-1]+'">'+
            '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
            '&nbsp;<select class="select-menu" name="indoor-divide-'+column+"-"+ indoor_divide_count[column-1] +'">'+
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
            if(outdoor_wall_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+outdoor_wall_decoration_count[column-1];
            }
            outdoor_wall_decoration_count[column-1] += 1;

            text =
            '<div id="outdoor-wall-decoration-'+column+"-"+ outdoor_wall_decoration_count[column-1]+'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '&nbsp;<select name="outdoor-wall-decoration-'+column+"-"+ outdoor_wall_decoration_count[column-1] +'" class="select-menu">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">石馬</option>'+
                    '<option value="">油漆</option>'+
                    '<option value="">水泥粉刷</option>'+
                '</select>'+
            '</div>';
            break;

        case 'indoor-wall-decoration-':
            if(indoor_wall_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+indoor_wall_decoration_count[column-1];
            }
            indoor_wall_decoration_count[column-1] += 1;

            text =
            '<div id="indoor-wall-decoration-'+column+"-"+ indoor_wall_decoration_count[column-1]+'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '&nbsp;<select name="indoor-wall-decoration-'+column+"-"+ indoor_wall_decoration_count[column-1] +'" class="select-menu">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    '<option value="">壁磚</option>'+
                    '<option value="">水泥粉刷PVC漆</option>'+
                    '<option value="">水泥粉光</option>'+
                '</select>'+
            '</div>';
            break;

        case 'roof-decoration-':
            if(roof_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+roof_decoration_count[column-1];
            }
            roof_decoration_count[column-1] += 1;

            text =
            '<div id="roof-decoration-'+column+"-"+ roof_decoration_count[column-1]+'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '&nbsp;<select name="roof-decoration-'+column+"-"+ roof_decoration_count[column-1] +'" class="select-menu">'+
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
            if(floor_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+floor_decoration_count[column-1];
            }
            floor_decoration_count[column-1] += 1;

            text =
            '<div id="floor-decoration-'+column+"-"+ floor_decoration_count[column-1]+'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '&nbsp;<select name="floor-decoration-'+column+"-"+ floor_decoration_count[column-1] +'" class="select-menu">'+
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
            if(ceiling_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+ceiling_decoration_count[column-1];
            }
            ceiling_decoration_count[column-1] += 1;

            text=
            '<div id="ceiling-decoration-'+column+"-"+ ceiling_decoration_count[column-1] +'">'+
                '<input type="text" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '&nbsp;<select name="ceiling-decoration-'+column+"-"+ ceiling_decoration_count[column-1] +'" class="select-menu">'+
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

        case 'toilet-equipment-':
            if(toilet_equipment_count[column-1] > 1){
                itemId = "#"+id+column+"-"+toilet_equipment_count[column-1];
            }
            toilet_equipment_count[column-1] += 1;

            text =
            '<div class="table-container" id="toilet-equipment-'+column+"-"+toilet_equipment_count[column-1]+'">'+
                '比例:<input type="radio" name="toilet-ratio-'+column+"-"+toilet_equipment_count[column-1]+'">1'+
                '<input type="radio" name="toilet-ratio-'+column+"-"+toilet_equipment_count[column-1]+'">1/2<br>'+
                '型式:<select name="toilet-type-'+column+"-"+toilet_equipment_count[column-1]+'" class="select-menu">'+
                    '<option value="">水泥貼馬賽克</option>'+
                    '<option value="">瓷漆</option>'+
                '</select><br>'+
                '座數:<input type="radio" name="toilet-number-'+column+"-"+toilet_equipment_count[column-1]+'">1~3座<input type="radio" name="toilet-number-'+column+"-"+toilet_equipment_count[column-1]+'">4~6座<input type="radio" name="toilet-number-'+column+"-"+toilet_equipment_count[column-1]+'">7座以上'+
            '</div>';
            break;
    }
    // $(itemId).append(text);
    $(text).insertAfter($(itemId));
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
        case 'toilet-equipment-':
            toilet_equipment_count[column-1] = removeItem(id+column , toilet_equipment_count[column-1]);
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

function checkSameAddressBox(num){
    houseAddress = document.getElementById("houseAddress").value;
    if(document.getElementById("sameAddressBox-"+num).checked){
        document.getElementById("addressText-"+num).value = houseAddress;
    }
    else{
        document.getElementById("addressText-"+num).value = "";
    }
}

function addInfoItemOnclick(id){
    var itemId = "#"+id;

    switch (id) {
        case 'land-section':
            land_section_count += 1;

            text =
            '<div id="land-section-'+land_section_count+'">'+
            '<input type="text" name="land-section-'+land_section_count+'" value="" required><br>'+
            '</div>';
            break;

        case 'subsection':
            subsection_count += 1;

            text =
            '<div id="subsection-'+subsection_count+'">'+
                '<input type="text" name="subsection-'+subsection_count+'" value="" required><br>'+
            '</div>';
            break;

        case 'land-number':
            land_number_count += 1;

            text =
            '<div id="land-number-'+land_number_count+'">'+
                '<input type="text" name="land-number-'+land_number_count+'" value="" required><br>'+
            '</div>';
            break;

        case 'owner':
            owner_count += 1;

            addInfoItemOnclick('hold-ratio');
            addInfoItemOnclick('pId');
            addInfoItemOnclick('address');
            addInfoItemOnclick('telephone');
            addInfoItemOnclick('cellphone');
            text =
            '<div id="owner-'+owner_count+'">'+
                '<input type="text" name="owner-'+owner_count+'" placeholder="所有權人-'+owner_count+'" required><br>'+
            '</div>';
            break;

        case 'hold-ratio':
            hold_ratio_count += 1;

            text =
            '<div id="hold-ratio-'+hold_ratio_count+'">'+
                '<input type="text" name="hold-numerator-'+hold_ratio_count+'" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)" required>'+
                '&nbsp;/&nbsp;<input type="text" name="hold-denominator-'+hold_ratio_count+'" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)" required>'+
            '</div>';
            break;

        case 'pId':
            pId_count += 1;

            text =
            '<div id="pId-'+pId_count+'">'+
                '<input type="text" name="pId-'+pId_count+'" value="" placeholder="所有權人-'+pId_count+'" required>'+
            '</div>';
            break;

        case 'address':
            address_count += 1;

            text =
            '<div id="address-'+address_count+'">'+
                '<input type="checkbox" id="sameAddressBox-'+address_count+'" onclick="checkSameAddressBox('+address_count+')">同房屋門牌'+
                '<input type="text" id="addressText-'+address_count+'" name="addressText-'+address_count+'" value="" class="large-input-size" placeholder="所有權人-'+address_count+'">'+
            '</div>';
            break;

        case 'telephone':
            telephone_count += 1;

            text =
            '<div id="telephone-'+telephone_count+'">'+
                '<input type="tel" name="telephone-'+telephone_count+'" value="" placeholder="所有權人-'+telephone_count+'">'+
            '</div>';
            break;

        case 'cellphone':
            cellphone_count += 1;

            text =
            '<div id="cellphone-'+cellphone_count+'">'+
                '<input type="tel" name="cellphone-'+cellphone_count+'" value="" placeholder="所有權人-'+cellphone_count+'">'+
            '</div>';
            break;
    }
    $(itemId).append(text);
}

function removeInfoItemOnclick(id){
    switch (id) {
        case 'land-section':
            land_section_count = removeItem(id, land_section_count);
            break;
        case 'subsection':
            subsection_count = removeItem(id, subsection_count);
            break;
        case 'land-number':
            land_number_count = removeItem(id, land_number_count);
            break;
        case 'owner':
            removeInfoItemOnclick('hold-ratio');
            removeInfoItemOnclick('pId');
            removeInfoItemOnclick('address');
            removeInfoItemOnclick('telephone');
            removeInfoItemOnclick('cellphone');
            owner_count = removeItem(id, owner_count);
            break;
        case 'hold-ratio':
            hold_ratio_count = removeItem(id, hold_ratio_count);
            break;
        case 'pId':
            pId_count = removeItem(id, pId_count);
            break;
        case 'address':
            address_count = removeItem(id, address_count);
            break;
        case 'telephone':
            telephone_count = removeItem(id, telephone_count);
            break;
        case 'cellphone':
            cellphone_count = removeItem(id, cellphone_count);
            break;
    }
}

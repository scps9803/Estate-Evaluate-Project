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
var land_owner_count = 1;
var hold_ratio_count = 1;
var pId_count = 1;
var address_count = 1;
var telephone_count = 1;
var cellphone_count = 1;

var hold_id_count = 1;
var land_pId_count = 1;
var land_address_count = 1;
var land_telephone_count = 1;
var land_cellphone_count = 1;

var other_item_count = 1;
var calArea_count = 1;
var unit_count = 1;
var auto_remove_count = 1;
var captain_count = 1;
var exit_No_count = 1;
var captain_id_count = 1;
var household_number_count = 1;
var set_household_date_count = 1;
var family_num_count = 1;
var independent_count = 0;

var corp_count = 1;
var submitCheck = false;
var script_number = "";
var deleteNextPage = false;
var nth_OwnerNameList = [];
var corp_category_option = "";
var corp_item_data;
var corp_type_data;

function addItemOnclick(id,column,num){
    var itemId = "#"+id+column+"-"+num;
    var result_option = "";

    switch (id) {
        case 'minus-wall-':
            if(minus_wall_count[column-1] > 1){
                itemId = "#"+id+column+"-"+minus_wall_count[column-1];
            }
            minus_wall_count[column-1] += 1;

            text =
            '<div id="minus-wall-'+column+"-"+minus_wall_count[column-1]+'">'+
                '<span>減牆:&nbsp;</span>'+
                '<select id="minus-wall-num-'+column+"-"+minus_wall_count[column-1]+'" name="minus-wall-num-'+column+"-"+ minus_wall_count[column-1] +'" required="required">'+
                    '<option value="">請選擇面數</option>'+
                    '<option value="1">1</option>'+
                    '<option value="2">2</option>'+
                    '<option value="3">3</option>'+
                    '<option value="4">4</option>'+
                '</select>&nbsp;'+
                // '<input type="hidden" name="test-num-'+column+'">'+
                '<select id="minus-wall-option-'+column+"-"+minus_wall_count[column-1]+'" name="minus-wall-option-'+column+"-"+ minus_wall_count[column-1] +'" class="select-menu" required="required">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    // '<option value="">RC牆</option>'+
                    // '<option value="">1B</option>'+
                    // '<option value="">1/2B</option>'+
                    // '<option value="">檜木造</option>'+
                    // '<option value="">其他木造</option>'+
                    // '<option value="">竹編牆</option>'+
                '</select>'+
            '</div>';
            $(text).insertAfter($(itemId));
            get_building_decoration_option(id+"option-", column, minus_wall_count[column-1], 'add_minus_wall');
            getMinusWallCount(column-1);
            break;

        case 'add-wall-':
            if(add_wall_count[column-1] > 1){
                itemId = "#"+id+column+"-"+add_wall_count[column-1];
            }
            add_wall_count[column-1] += 1;

            text =
            '<div id="add-wall-'+column+"-"+ add_wall_count[column-1]+'">'+
                '<span>加牆:&nbsp;</span>'+
                '<select id="add-wall-num-'+column+"-"+add_wall_count[column-1]+'" name="add-wall-num-'+column+"-"+ add_wall_count[column-1] +'" required="required">'+
                    '<option value="">請選擇面數</option>'+
                    '<option value="1">1</option>'+
                    '<option value="2">2</option>'+
                    '<option value="3">3</option>'+
                    '<option value="4">4</option>'+
                '</select>&nbsp;'+
                '<select id="add-wall-option-'+column+"-"+add_wall_count[column-1]+'" name="add-wall-option-'+column+"-"+ add_wall_count[column-1] +'" class="select-menu" required="required">'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                    // '<option value="">RC牆</option>'+
                    // '<option value="">1B</option>'+
                    // '<option value="">1/2B</option>'+
                    // '<option value="">檜木造</option>'+
                    // '<option value="">其他木造</option>'+
                    // '<option value="">竹編牆</option>'+
                '</select>'+
            '</div>';
            $(text).insertAfter($(itemId));
            get_building_decoration_option(id+"option-", column, add_wall_count[column-1], 'add_minus_wall');
            getAddWallCount(column-1);
            break;

        case 'indoor-divide-':
            if(indoor_divide_count[column-1] > 1){
                itemId = "#"+id+column+"-"+indoor_divide_count[column-1];
            }
            indoor_divide_count[column-1] += 1;

            text =
            '<div id="indoor-divide-'+column+"-"+ indoor_divide_count[column-1]+'">'+
            '<input type="text" id="indoor-divide-numerator-'+column+"-"+indoor_divide_count[column-1]+'" name="indoor-divide-numerator-'+column+"-"+indoor_divide_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'indoor-divide-numerator-'+column+'-'+indoor_divide_count[column-1]+'\')" value="1">/<input type="text" id="indoor-divide-denominator-'+column+"-"+indoor_divide_count[column-1]+'" name="indoor-divide-denominator-'+column+"-"+indoor_divide_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'indoor-divide-denominator-'+column+'-'+indoor_divide_count[column-1]+'\')" value="1">'+
            '&nbsp;<select class="select-menu" id="indoor-divide-option-'+column+"-"+ indoor_divide_count[column-1] +'" name="indoor-divide-option-'+column+"-"+ indoor_divide_count[column-1] +'" required>'+
                '<option value="" style="display:none;">請選擇材質</option>'+
            '</select>'+
            '</div>';
            $(text).insertAfter($(itemId));

            get_building_decoration_option('indoor-divide-option-', column, indoor_divide_count[column-1], 'indoor_divide');
            getIndoorDivideCount(column-1);
            break;

        case 'outdoor-wall-decoration-':
            if(outdoor_wall_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+outdoor_wall_decoration_count[column-1];
            }
            outdoor_wall_decoration_count[column-1] += 1;

            text =
            '<div id="outdoor-wall-decoration-'+column+"-"+ outdoor_wall_decoration_count[column-1]+'">'+
                '<input type="text" id="outdoor-wall-decoration-numerator-'+column+"-"+outdoor_wall_decoration_count[column-1]+'" name="outdoor-wall-decoration-numerator-'+column+"-"+outdoor_wall_decoration_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'outdoor-wall-decoration-numerator-'+column+'-'+outdoor_wall_decoration_count[column-1]+'\')" value="1">/'+
                '<input type="text" id="outdoor-wall-decoration-denominator-'+column+"-"+outdoor_wall_decoration_count[column-1]+'" name="outdoor-wall-decoration-denominator-'+column+"-"+outdoor_wall_decoration_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'outdoor-wall-decoration-denominator-'+column+'-'+outdoor_wall_decoration_count[column-1]+'\')" value="1">'+
                '&nbsp;<select id="outdoor-wall-decoration-option-'+column+"-"+ outdoor_wall_decoration_count[column-1] +'" name="outdoor-wall-decoration-option-'+column+"-"+ outdoor_wall_decoration_count[column-1] +'" class="select-menu" required>'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                '</select>'+
            '</div>';
            $(text).insertAfter($(itemId));

            get_building_decoration_option('outdoor-wall-decoration-option-', column, outdoor_wall_decoration_count[column-1], 'outdoor_wall_decoration');
            getOutdoorWallDecorationCount(column-1);
            break;

        case 'indoor-wall-decoration-':
            if(indoor_wall_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+indoor_wall_decoration_count[column-1];
            }
            indoor_wall_decoration_count[column-1] += 1;

            text =
            '<div id="indoor-wall-decoration-'+column+"-"+ indoor_wall_decoration_count[column-1]+'" style="padding-left:10px;">'+
                '<input type="text" id="indoor-wall-decoration-numerator-'+column+"-"+indoor_wall_decoration_count[column-1]+'" name="indoor-wall-decoration-numerator-'+column+"-"+indoor_wall_decoration_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'indoor-wall-decoration-numerator-'+column+'-'+indoor_wall_decoration_count[column-1]+'\')" value="1">/'+
                '<input type="text" id="indoor-wall-decoration-denominator-'+column+"-"+indoor_wall_decoration_count[column-1]+'" name="indoor-wall-decoration-denominator-'+column+"-"+indoor_wall_decoration_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'indoor-wall-decoration-denominator-'+column+'-'+indoor_wall_decoration_count[column-1]+'\')" value="1">'+
                '&nbsp;<select id="indoor-wall-decoration-option-'+column+"-"+ indoor_wall_decoration_count[column-1] +'" name="indoor-wall-decoration-option-'+column+"-"+ indoor_wall_decoration_count[column-1] +'" class="tiny-select-menu" onchange="autoCompleteIndoorWallType('+column+','+indoor_wall_decoration_count[column-1]+')" required>'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                '</select>&nbsp;'+

                '<select id="indoor-wall-type-'+column+"-"+indoor_wall_decoration_count[column-1]+'" name="indoor-wall-type-'+column+"-"+indoor_wall_decoration_count[column-1]+'">'+
                    '<option value="" style="display:none;">種類</option>'+
                    '<option value="無隔">無隔</option>'+
                    '<option value="有隔">有隔</option>'+
                '</select>'+
            '</div>';
            $(text).insertAfter($(itemId));

            get_building_decoration_option('indoor-wall-decoration-option-', column, indoor_wall_decoration_count[column-1], 'indoor_wall_decoration');
            getIndoorWallDecorationCount(column-1);
            break;

        case 'roof-decoration-':
            if(roof_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+roof_decoration_count[column-1];
            }
            roof_decoration_count[column-1] += 1;

            text =
            '<div id="roof-decoration-'+column+"-"+ roof_decoration_count[column-1]+'">'+
                '<input type="text" id="roof-decoration-numerator-'+column+"-"+ roof_decoration_count[column-1]+'" name="roof-decoration-numerator-'+column+"-"+ roof_decoration_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'roof-decoration-numerator-'+column+'-'+roof_decoration_count[column-1]+'\')" value="1">/'+
                '<input type="text" id="roof-decoration-denominator-'+column+"-"+ roof_decoration_count[column-1]+'" name="roof-decoration-denominator-'+column+"-"+ roof_decoration_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'roof-decoration-denominator-'+column+'-'+roof_decoration_count[column-1]+'\')" value="1">'+
                '&nbsp;<select id="roof-decoration-option-'+column+"-"+ roof_decoration_count[column-1] +'" name="roof-decoration-option-'+column+"-"+ roof_decoration_count[column-1] +'" class="select-menu" required>'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                '</select>'+
            '</div>';
            $(text).insertAfter($(itemId));

            get_building_decoration_option('roof-decoration-option-', column, roof_decoration_count[column-1], 'roof_decoration');
            getRoofDecorationCount(column-1);
            break;

        case 'floor-decoration-':
            if(floor_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+floor_decoration_count[column-1];
            }
            floor_decoration_count[column-1] += 1;

            text =
            '<div id="floor-decoration-'+column+"-"+ floor_decoration_count[column-1]+'">'+
                '<input type="text" id="floor-decoration-numerator-'+column+"-"+ floor_decoration_count[column-1]+'" name="floor-decoration-numerator-'+column+"-"+ floor_decoration_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'floor-decoration-numerator-'+column+'-'+floor_decoration_count[column-1]+'\')" value="1">/'+
                '<input type="text" id="floor-decoration-denominator-'+column+"-"+ floor_decoration_count[column-1]+'" name="floor-decoration-denominator-'+column+"-"+ floor_decoration_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'floor-decoration-denominator-'+column+'-'+floor_decoration_count[column-1]+'\')" value="1">'+
                '&nbsp;<select id="floor-decoration-option-'+column+"-"+ floor_decoration_count[column-1] +'" name="floor-decoration-option-'+column+"-"+ floor_decoration_count[column-1] +'" class="select-menu" required>'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                '</select>'+
            '</div>';
            $(text).insertAfter($(itemId));

            get_building_decoration_option('floor-decoration-option-', column, floor_decoration_count[column-1], 'floor_decoration');
            getFloorDecorationCount(column-1);
            break;

        case 'ceiling-decoration-':
            if(ceiling_decoration_count[column-1] > 1){
                itemId = "#"+id+column+"-"+ceiling_decoration_count[column-1];
            }
            ceiling_decoration_count[column-1] += 1;

            text=
            '<div id="ceiling-decoration-'+column+"-"+ ceiling_decoration_count[column-1] +'">'+
                '<input type="text" id="ceiling-decoration-numerator-'+column+"-"+ ceiling_decoration_count[column-1] +'" name="ceiling-decoration-numerator-'+column+"-"+ ceiling_decoration_count[column-1] +'" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'ceiling-decoration-numerator-'+column+'-'+ceiling_decoration_count[column-1]+'\')" value="1">/'+
                '<input type="text" id="ceiling-decoration-denominator-'+column+"-"+ ceiling_decoration_count[column-1] +'" name="ceiling-decoration-denominator-'+column+"-"+ ceiling_decoration_count[column-1] +'" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,5}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'ceiling-decoration-denominator-'+column+'-'+ceiling_decoration_count[column-1]+'\')" value="1">'+
                '&nbsp;<select id="ceiling-decoration-option-'+column+"-"+ ceiling_decoration_count[column-1] +'" name="ceiling-decoration-option-'+column+"-"+ ceiling_decoration_count[column-1] +'" class="select-menu" required>'+
                    '<option value="" style="display:none;">請選擇材質</option>'+
                '</select>'+
            '</div>';
            $(text).insertAfter($(itemId));

            get_building_decoration_option('ceiling-decoration-option-', column, ceiling_decoration_count[column-1], 'ceiling_decoration');
            getCeilingDecorationCount(column-1);
            break;

        case 'toilet-equipment-':
            if(toilet_equipment_count[column-1] > 1){
                itemId = "#"+id+column+"-"+toilet_equipment_count[column-1];
            }
            toilet_equipment_count[column-1] += 1;

            text =
            '<div class="table-container" id="toilet-equipment-'+column+"-"+toilet_equipment_count[column-1]+'" style="margin-top:15px;">'+
                // '比例:<input type="radio" name="toilet-ratio-'+column+"-"+toilet_equipment_count[column-1]+'" value="1">1'+
                // '<input type="radio" name="toilet-ratio-'+column+"-"+toilet_equipment_count[column-1]+'" value="0.5">1/2<br>'+
                '比例:<select id="toilet-ratio-'+column+"-"+toilet_equipment_count[column-1]+'" name="toilet-ratio-'+column+"-"+toilet_equipment_count[column-1]+'" class="tiny-select-menu" required>'+
                    '<option value="" style="display:none;">請選擇比例</option>'+
                    '<option value="1">1</option>'+
                    '<option value="0.5">1/2</option>'+
                '</select><br>'+
                '型式:<select id="toilet-type-'+column+"-"+toilet_equipment_count[column-1]+'" name="toilet-type-'+column+"-"+toilet_equipment_count[column-1]+'" class="tiny-select-menu" onchange="load_toilet_data('+column+','+toilet_equipment_count[column-1]+')" required>'+
                    // '<option value="">水泥貼馬賽克</option>'+
                    // '<option value="">瓷漆</option>'+
                '</select>&nbsp;'+

                '<select id="toilet-product-'+column+"-"+toilet_equipment_count[column-1]+'" name="toilet-product-'+column+"-"+toilet_equipment_count[column-1]+'">'+
                    '<option value="" style="display:none;">請選擇種類</option>'+
                '</select>'+
                '<br>'+
                // '座數:<input type="radio" name="toilet-number-'+column+"-"+toilet_equipment_count[column-1]+'" value="3">1~3座<input type="radio" name="toilet-number-'+column+"-"+toilet_equipment_count[column-1]+'" value="6">4~6座<input type="radio" name="toilet-number-'+column+"-"+toilet_equipment_count[column-1]+'" value="7">7座以上'+
                '座數:<select id="toilet-number-'+column+"-"+toilet_equipment_count[column-1]+'" name="toilet-number-'+column+"-"+toilet_equipment_count[column-1]+'" class="tiny-select-menu" required>'+
                    '<option value="" style="display:none;">請選擇座數</option>'+
                    '<option value="1">1~3座</option>'+
                    '<option value="2">4~6座</option>'+
                    '<option value="3">7座以上</option>'+
                '</select>';
            '</div>';
            $(text).insertAfter($(itemId));

            get_building_decoration_option('toilet-type-', column, toilet_equipment_count[column-1], 'toilet_equipment');
            getToiletEquipmentCount(column-1);
            break;
    }
    // $(itemId).append(text);
    // $(text).insertAfter($(itemId));
}

function removeItemOnclick(id,column){

    switch (id) {
        case 'minus-wall-':
            minus_wall_count[column-1] = removeItem(id+column , minus_wall_count[column-1]);
            getMinusWallCount(column-1);
            break;

        case 'add-wall-':
            add_wall_count[column-1] = removeItem(id+column , add_wall_count[column-1]);
            getAddWallCount(column-1);
            break;

        case 'indoor-divide-':
            indoor_divide_count[column-1] = removeItem(id+column , indoor_divide_count[column-1]);
            getIndoorDivideCount(column-1);
            break;

        case 'outdoor-wall-decoration-':
            outdoor_wall_decoration_count[column-1] = removeItem(id+column , outdoor_wall_decoration_count[column-1]);
            getOutdoorWallDecorationCount(column-1);
            break;

        case 'indoor-wall-decoration-':
            indoor_wall_decoration_count[column-1] = removeItem(id+column , indoor_wall_decoration_count[column-1]);
            getIndoorWallDecorationCount(column-1);
            break;

        case 'roof-decoration-':
            roof_decoration_count[column-1] = removeItem(id+column , roof_decoration_count[column-1]);
            getRoofDecorationCount(column-1);
            break;

        case 'floor-decoration-':
            floor_decoration_count[column-1] = removeItem(id+column , floor_decoration_count[column-1]);
            getFloorDecorationCount(column-1);
            break;

        case 'ceiling-decoration-':
            ceiling_decoration_count[column-1] = removeItem(id+column , ceiling_decoration_count[column-1]);
            getCeilingDecorationCount(column-1);
            break;
        case 'toilet-equipment-':
            toilet_equipment_count[column-1] = removeItem(id+column , toilet_equipment_count[column-1]);
            getToiletEquipmentCount(column-1);
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
    '<div id="sub-compensate-form-'+num+'">'+
    '<input type="radio" name="sub-compensate-form-'+num+'" value="一般" onclick="removeAttic(' + num + ')" required>一般'+
    '<input type="radio" name="sub-compensate-form-'+num+'" value="閣樓板(夾層板)" onclick="attic(' + num + ')">閣樓板(夾層板)'+
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
    var isAppend = false;

    switch (id) {
        case 'building-land-section':
            land_section_count += 1;

            addInfoItemOnclick('subsection');
            addInfoItemOnclick('land-number');
            text =
            '<div id="building-land-section-'+land_section_count+'">'+
                '<select id="section-'+land_section_count+'" name="land-section-'+land_section_count+'" class="median-select-menu" style="margin-top:6px;" required>'+
                    '<option value="草漯段">草漯段</option>'+
                    '<option value="塔腳段">塔腳段</option>'+
                    '<option value="新坡段">新坡段</option>'+
                    '<option value="樹林子段">樹林子段</option>'+
                '</select>'+
            '</div>';
            getLandSectionCount();
            break;
        
        case 'corp-land-section':
            land_section_count += 1;

            addInfoItemOnclick('subsection');
            addInfoItemOnclick('land-number');
            text =
            '<div id="corp-land-section-'+land_section_count+'">'+
                '<select id="section-'+land_section_count+'" name="land-section-'+land_section_count+'" class="median-select-menu" style="margin-top:6px;" required>'+
                    '<option value="草漯段">草漯段</option>'+
                    '<option value="塔腳段">塔腳段</option>'+
                    '<option value="新坡段">新坡段</option>'+
                    '<option value="樹林子段">樹林子段</option>'+
                '</select>'+
            '</div>';
            getLandSectionCount();
            break;

        case 'subsection':
            subsection_count += 1;

            text =
            '<div id="subsection-'+subsection_count+'" style="margin-top:6px;">'+
                // '<input type="text" name="subsection-'+subsection_count+'" value=""><br>'+
                '<select id="sub_section-'+subsection_count+'" name="subsection-'+subsection_count+'">'+
                    '<option value="">無</option>'+
                    '<option value="新坡小段">新坡小段</option>'+
                    '<option value="過溪子小段">過溪子小段</option>'+
                '</select>'+
            '</div>';
            break;

        case 'land-number':
            land_number_count += 1;
            nth_OwnerNameList.push(new Array([]));

            text =
            '<div id="land-number-'+land_number_count+'">'+
                '<input type="text" id="land-num-'+land_number_count+'" name="land-number-'+land_number_count+'" placeholder="多個地號請用\'、\'分隔" onchange="isLandNumExist(\'corp\','+land_number_count+')" required><br>'+
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
                '<input type="text" class="median-input-size" style="width:75px" name="owner-'+owner_count+'" autocomplete="off" placeholder="手動新增" required>&nbsp;'+
                '<select id="owner-select-'+owner_count+'" style="width:80px" name="owner-select-'+owner_count+'" onchange="autoFillInOwnerName(\'owner\','+owner_count+')">'+
                    '<option value="" style="display:none">請選擇項目</option>'+
                '</select>'+
            '</div>';
            isAppend = true;
            $(itemId).append(text);
            loadOwnerData("owner",owner_count);
            getOwnerCount();
            checkRatioInput('hold-numerator-'+owner_count);
            break;

        case 'land-owner':
            land_owner_count += 1;

            addInfoItemOnclick('hold-id');
            addInfoItemOnclick('land-pId');
            addInfoItemOnclick('land-address');
            addInfoItemOnclick('land-telephone');
            addInfoItemOnclick('land-cellphone');
            text =
            '<div id="land-owner-'+land_owner_count+'">'+
                // '<input type="text" name="land-owner-'+land_owner_count+'" list="land-owner-list-'+land_owner_count+'" autocomplete="off" placeholder="所有權人-'+land_owner_count+'" oninput="getLandOwnerOption('+land_owner_count+')" required><br>'+
                // '<datalist id="land-owner-list-'+land_owner_count+'"></datalist>';
                '<input type="text" class="median-input-size" name="land-owner-'+land_owner_count+'" autocomplete="off" placeholder="手動新增" required>&nbsp;'+
                '<select id="land-owner-select-'+land_owner_count+'" name="land-owner-select-'+land_owner_count+'" onchange="autoFillInOwnerName(\'land-owner\','+land_owner_count+')">'+
                    '<option value="" style="display:none">請選擇項目</option>'+
                '</select>'+
            '</div>';
            isAppend = true;
            $(itemId).append(text);
            loadOwnerData("land-owner",land_owner_count);
            getLandOwnerCount();
            break;

        case 'corp-owner':
            owner_count += 1;

            addInfoItemOnclick('hold-ratio');
            addInfoItemOnclick('pId');
            addInfoItemOnclick('corp-address');
            addInfoItemOnclick('telephone');
            addInfoItemOnclick('cellphone');
            text =
            '<div id="corp-owner-'+owner_count+'">'+
                // '<input type="text" name="corp-owner-'+owner_count+'" placeholder="所有權人-'+owner_count+'" required><br>'+
                '<input type="text" style="width:80px;" name="corp-owner-'+owner_count+'" autocomplete="off" placeholder="手動新增" required>&nbsp;'+
                '<select id="corp-owner-select-'+owner_count+'" name="corp-owner-select-'+owner_count+'" style="width:80px;" onchange="autoFillInOwnerName(\'corp-owner\','+owner_count+')">'+
                    '<option value="" style="display:none">請選擇項目</option>'+
                '</select>'+
            '</div>';
            isAppend = true;
            $(itemId).append(text);
            loadOwnerData("corp-owner",owner_count);
            getOwnerCount();
            break;

        case 'hold-ratio':
            hold_ratio_count += 1;

            text =
            '<div id="hold-ratio-'+hold_ratio_count+'">'+
                '<input type="text" id="hold-numerator-'+hold_ratio_count+'" name="hold-numerator-'+hold_ratio_count+'" class="tiny-input-size" placeholder="輸入" pattern="[0-9]{1,10}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'hold-numerator-'+hold_ratio_count+'\')" required>'+
                '&nbsp;/&nbsp;<input type="text" id="hold-denominator-'+hold_ratio_count+'" name="hold-denominator-'+hold_ratio_count+'" class="tiny-input-size" placeholder="比例" pattern="[0-9]{1,10}" title="請輸入比例數字(不可為0)" onchange="checkRatioInput(\'hold-denominator-'+hold_ratio_count+'\')" required>'+
            '</div>';
            break;

        case 'pId':
            pId_count += 1;

            text =
            '<div id="pId-'+pId_count+'">'+
                '<input type="text" name="pId-'+pId_count+'" value="" placeholder="所有權人-'+pId_count+'">'+
                // '<input type="text" id="hold-id-'+pId_count+'" name="hold-id-'+pId_count+'" value="" placeholder="歸戶號" class="small-input-size" onchange="checkOwner('+pId_count+')" required>'+
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

        case 'corp-address':
            address_count += 1;

            text =
            '<div id="corp-address-'+address_count+'">'+
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
            var current_count = cellphone_count;

            text =
            '<div id="cellphone-'+cellphone_count+'">'+
                '<input type="tel" name="cellphone-'+cellphone_count+'" value="" placeholder="所有權人-'+cellphone_count+'" maxlength="11">'+
            '</div>';
            isAppend = true;
            $(itemId).append(text);

            var item = '#cellphone-'+current_count;
            $(item).on('input', 'input', function(){
                cellphoneListen(current_count);
            });
            break;


        case 'hold-id':
            hold_id_count += 1;

            text =
            '<div id="hold-id-'+hold_id_count+'">'+
                '<input type="text" name="hold-id-'+hold_id_count+'" value="" placeholder="所有權人-'+hold_id_count+'" required>'+
            '</div>';
            break;

        case 'land-pId':
            land_pId_count += 1;

            text =
            '<div id="land-pId-'+land_pId_count+'">'+
                '<input type="text" name="land-pId-'+land_pId_count+'" value="" placeholder="所有權人-'+land_pId_count+'">'+
            '</div>';
            break;

        case 'land-address':
            land_address_count += 1;

            text =
            '<div id="land-address-'+land_address_count+'">'+
                '<input type="text" id="landAddressText-'+land_address_count+'" name="landAddressText-'+land_address_count+'" value="" class="large-input-size" placeholder="所有權人-'+land_address_count+'">'+
            '</div>';
            break;

        case 'land-telephone':
            land_telephone_count += 1;

            text =
            '<div id="land-telephone-'+land_telephone_count+'">'+
                '<input type="tel" name="land-telephone-'+land_telephone_count+'" value="" placeholder="所有權人-'+land_telephone_count+'">'+
            '</div>';
            break;

        case 'land-cellphone':
            land_cellphone_count += 1;
            var current_count = land_cellphone_count;

            text =
            '<div id="land-cellphone-'+land_cellphone_count+'">'+
                '<input type="tel" name="land-cellphone-'+land_cellphone_count+'" value="" placeholder="所有權人-'+land_cellphone_count+'" maxlength="11">'+
            '</div>';
            isAppend = true;
            $(itemId).append(text);

            // var item = '#land-cellphone-'+current_count;
            // $(item).on('input', 'input', function(){
            //     cellphoneListen(current_count);
            // });
            break;

            // 雜項設施
        case 'other-item':
            other_item_count += 1;

            addInfoItemOnclick('calArea');
            addInfoItemOnclick('unit');
            addInfoItemOnclick('auto-remove');
            text =
            '<div id="other-item-'+other_item_count+'">'+
                '<select style="width:150px;" id="other-item-category-'+other_item_count+'" name="other-item-category-'+other_item_count+'" onclick="getSubbuildingCategory('+other_item_count+');this.onclick=null;" onchange="getSubbuildingOption('+other_item_count+')" required>'+
                    '<option value="" style="display:none;">請選擇種類</option>'+
                '</select>&nbsp;'+

                '<select style="width:466px;" id="other-item-option-'+other_item_count+'" name="other-item-'+other_item_count+'" onchange="loadSubbuildingUnit('+other_item_count+')" required>'+
                    '<option value="" style="display:none;">請選擇項目</option>'+
                '</select>&nbsp;'+

                '<select style="width:150px;" id="other-item-type-'+other_item_count+'" name="other-item-type-'+other_item_count+'" required>'+
                    '<option value="" style="display:none;">請選擇室內外</option>'+
                    '<option value="室內">室內</option>'+
                    '<option value="室外">室外</option>'+
                '</select>'+
            '</div>';
            getOtherItemCount();
            break;
        
        case 'fence':
            other_item_count += 1;

            addInfoItemOnclick('calArea');
            addInfoItemOnclick('unit');
            addInfoItemOnclick('auto-remove');
            text =
            '<div id="other-item-'+other_item_count+'">'+
                '<select style="width:150px;" id="other-item-category-'+other_item_count+'" name="other-item-category-'+other_item_count+'" onchange="getSubbuildingOption('+other_item_count+')" required>'+
                    '<option value="" style="display:none;">請選擇種類</option>'+
                    '<option value="圍牆">圍牆</option>'+
                '</select>&nbsp;'+

                '<select style="width:150px;" id="other-item-option-'+other_item_count+'" name="other-item-'+other_item_count+'" onchange="loadSubbuildingUnit('+other_item_count+')" required>'+
                    '<option value="" style="display:none;">請選擇項目</option>'+
                '</select>&nbsp;'+

                '<select style="width:150px;" id="fence-paint-'+other_item_count+'" name="fence-paint-'+other_item_count+'" onclick="getFenceOption('+other_item_count+',\'粉刷\');this.onclick=null;" onchange="loadSubbuildingUnit('+other_item_count+')">'+
                    '<option value="" style="display:none;">請選擇粉刷</option>'+
                '</select>&nbsp;'+

                '<select style="width:150px;" id="fence-pillar-'+other_item_count+'" name="fence-pillar-'+other_item_count+'" onclick="getFenceOption('+other_item_count+',\'加強柱\');this.onclick=null;" onchange="loadSubbuildingUnit('+other_item_count+')">'+
                    '<option value="" style="display:none;">請選擇加強柱</option>'+
                '</select>&nbsp;'+

                '<select style="width:150px;" id="other-item-type-'+other_item_count+'" name="other-item-type-'+other_item_count+'" required>'+
                    '<option value="" style="display:none;">請選擇室內外</option>'+
                    '<option value="室內">室內</option>'+
                    '<option value="室外">室外</option>'+
                '</select>'+
            '</div>';
            itemId = "#other-item";
            getOtherItemCount();
            break;

        case 'calArea':
            calArea_count += 1;

            text =
            '<div id="calArea-'+calArea_count+'" style="margin-top:2px;">'+
                '<input type="text" name="calArea-'+calArea_count+'" class="larger-input-size" placeholder="請輸入面積計算式或數量" title="請輸入面積計算式或數量" required>'+
            '</div>';
            break;

        case 'unit':
            unit_count += 1;

            text =
            '<div id="unit-'+unit_count+'" style="margin-top:8px;">'+
                '<select id="unit-option-'+unit_count+'" name="unit-'+unit_count+'">'+
                    '<option value="">請選擇單位</option>'+
                '</select>'+
            '</div>';
            break;

        case 'auto-remove':
            auto_remove_count += 1;

            text =
            '<div id="auto-remove-'+auto_remove_count+'" style="margin-top:8px;height:22px;">'+
                '<input type="radio" id="auto-remove-yes-'+auto_remove_count+'" name="auto-remove-'+auto_remove_count+'" value="是">是<input type="radio" id="auto-remove-no-'+auto_remove_count+'" name="auto-remove-'+auto_remove_count+'" value="否" required>否'+
            '</div>';
            break;

        case 'captain':
            captain_count += 1;

            addInfoItemOnclick('exit-No');
            addInfoItemOnclick('captain-id');
            addInfoItemOnclick('household-number');
            addInfoItemOnclick('set-household-date');
            addInfoItemOnclick('family-num');
            text =
            '<div id="captain-'+captain_count+'">'+
                '<input type="text" name="captain-'+captain_count+'" required>'+
                // '<input type="checkbox" id="cohabit-'+captain_count+'" name="cohabit-'+captain_count+'">共同生活戶'+
            '</div>';
            getCaptainCount();
            break;

        case 'exit-No':
            exit_No_count += 1;

            text =
            '<div id="exit-No-'+exit_No_count+'">'+
                '<input type="text" value="1" name="exit-No-'+exit_No_count+'" pattern="[0-9]{literal}{1}{/literal}" onclick="cohabitRemind()" onchange="checkExitNoCorrect()" required>'+
            '</div>';
            break;

        case 'captain-id':
            captain_id_count += 1;

            text =
            '<div id="captain-id-'+captain_id_count+'">'+
                '<input type="text" name="captain-id-'+captain_id_count+'" required>'+
            '</div>';
            break;

        case 'household-number':
            household_number_count += 1;

            text =
            '<div id="household-number-'+household_number_count+'">'+
                '<input type="text" name="household-number-'+household_number_count+'" required>'+
            '</div>';
            break;

        case 'set-household-date':
            set_household_date_count += 1;

            text =
            '<div id="set-household-date-'+set_household_date_count+'">'+
                '<input type="date" id="household-date-'+set_household_date_count+'" name="set-household-date-'+set_household_date_count+'" onchange="checkDate(\'household-date-'+set_household_date_count+'\')" required>'+
            '</div>';
            break;

        case 'family-num':
            family_num_count += 1;

            text =
            '<div id="family-num-'+family_num_count+'" class="input-select-align-top">'+
                '<select class="select-menu" name="family-num-'+family_num_count+'" required>'+
                    '<option value="" style="display:none;">請選擇項目</option>'+
                    '<option value="1">1</option>'+
                    '<option value="2">2</option>'+
                    '<option value="3">3</option>'+
                    '<option value="4">4</option>'+
                    '<option value="5">5</option>'+
                    '<option value="6">6</option>'+
                    '<option value="7">7</option>'+
                    '<option value="8">8</option>'+
                    '<option value="9">9</option>'+
                    '<option value="10">10</option>'+
                    '<option value="11">11</option>'+
                    '<option value="12">12</option>'+
                    '<option value="13">13</option>'+
                    '<option value="14">14</option>'+
                    '<option value="15">15</option>'+
                '</select>'+
            '</div>';
            break;
            // 農作物選單
        case 'corp-category':
            corp_count += 1;

            text =
            '<div id="corp-category-'+corp_count+'" style="margin-top:5px">'+
                '<select id="corp-category-option-'+corp_count+'" name="corp-category-'+corp_count+'" style="width:140px;" onchange="load_corp_item_Data('+corp_count+')" onfocus="itemFocus('+corp_count+')" onfocusout="itemOutFocus('+corp_count+')" required>'+
                    '<option value="" style="display:none;">請選擇種類</option>'+
                '</select>'+
            '</div>';
            getCorpCount();
            return text;

        case 'corp-item':
            text =
            '<div id="corp-item-'+corp_count+'" style="margin-top:4px;margin-bottom:5px;height:22px">'+
                '<input id="corp-item-option-'+corp_count+'" name="corp-item-'+corp_count+'" list="corp-item-list-'+corp_count+'" autocomplete="off" style="width:140px;margin:0" placeholder="點擊選擇或搜尋" onchange="load_corp_type_Data('+corp_count+')" onfocus="itemFocus('+corp_count+')" onfocusout="itemOutFocus('+corp_count+')" required></input>' +
            '</div>';
            return text;

        case 'corp-type':
            text =
            '<div id="corp-type-'+corp_count+'" style="margin-top:5px">'+
                '<select id="corp-type-option-'+corp_count+'" name="corp-type-'+corp_count+'" style="width:140px;" onchange="load_corp_unit_Data('+corp_count+')" onfocus="itemFocus('+corp_count+')" onfocusout="itemOutFocus('+corp_count+')" required>'+
                    '<option value="">請選擇規格</option>'+
                '</select>'+
            '</div>';
            return text;

        case 'corp-num':
            text =
            '<div id="corp-num-'+corp_count+'" style="margin-top:4px;margin-bottom:5px;height:22px">'+
                '<input type="text" name="corp-num-'+corp_count+'" title="只能輸入10位以下數字(含小數點)" style="margin:0" placeholder="請輸入數量" onchange="autoCalculateArea('+corp_count+')" onfocus="itemFocus('+corp_count+')" onfocusout="itemOutFocus('+corp_count+')" required>'+
            '</div>';
            return text;

        case 'corp-unit':
            text =
            '<div id="corp-unit-'+corp_count+'" style="margin-top:5px;">'+
                '<select class="" name="corp-unit-'+corp_count+'" onfocus="itemFocus('+corp_count+')" onfocusout="itemOutFocus('+corp_count+')" required>'+
                    '<option value="">請選擇單位</option>'+
                '</select>'+
            '</div>';
            return text;

        case 'corp-area':
            text =
            '<div id="corp-area-'+corp_count+'" style="margin-top:4px;margin-bottom:5px;height:22px">'+
                '<input type="text" name="corp-area-'+corp_count+'" class="large-input-size" placeholder="請輸入種植面積" style="margin:0" onfocus="itemFocus('+corp_count+')" onfocusout="itemOutFocus('+corp_count+')" required>'+
            '</div>';
            return text;

        case 'corp-equal':
            text =
            '<div id="corp-equal-'+corp_count+'" style="margin-top:5px;margin-bottom:0px;height:22px">'+
                '<input type="checkbox" value="" id="corp-equal-check-'+corp_count+'" name="corp-equal-'+corp_count+'" onchange="corpEqual('+corp_count+')" onfocus="itemFocus('+corp_count+')" onfocusout="itemOutFocus('+corp_count+')">比照項目'+
            '</div>';
            return text;

        case 'corp-note':
            text =
            '<div id="corp-note-'+corp_count+'" style="margin-top:4px;margin-bottom:5px;height:22px">'+
                '<input type="text" name="corp-note-'+corp_count+'" class="large-input-size" placeholder="輸入比照物 ex.樹葡萄" style="margin:0" onfocus="itemFocus('+corp_count+')" onfocusout="itemOutFocus('+corp_count+')">'+
            '</div>';
            return text;
    }
    if(!isAppend){
        $(itemId).append(text);
    }
}

function removeInfoItemOnclick(id){
    switch (id) {
        case 'building-land-section':
            removeInfoItemOnclick('subsection');
            removeInfoItemOnclick('land-number');
            land_section_count = removeItem(id, land_section_count);
            remove_nth_OwnerNameList(land_section_count);
            for(var i=1;i<=owner_count;i++){
                loadOwnerData("owner",i);
            }
            // loadOwnerData("owner",owner_count);
            loadOwnerData("land-owner",land_owner_count);
            getLandSectionCount();
            break;
        case 'corp-land-section':
                removeInfoItemOnclick('subsection');
                removeInfoItemOnclick('land-number');
                land_section_count = removeItem(id, land_section_count);
                remove_nth_OwnerNameList(land_section_count);
                for(var i=1;i<=owner_count;i++){
                    loadOwnerData("corp-owner",i);
                }
                // loadOwnerData("corp-owner",owner_count);
                loadOwnerData("land-owner",land_owner_count);
                getLandSectionCount();
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
            getOwnerCount();
            break;
        case 'land-owner':
            removeInfoItemOnclick('hold-id');
            removeInfoItemOnclick('land-pId');
            removeInfoItemOnclick('land-address');
            removeInfoItemOnclick('land-telephone');
            removeInfoItemOnclick('land-cellphone');
            land_owner_count = removeItem(id, land_owner_count);
            getLandOwnerCount();
            break;
        case 'corp-owner':
            removeInfoItemOnclick('hold-ratio');
            removeInfoItemOnclick('pId');
            removeInfoItemOnclick('corp-address');
            removeInfoItemOnclick('telephone');
            removeInfoItemOnclick('cellphone');
            owner_count = removeItem(id, owner_count);
            getOwnerCount();
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
        case 'corp-address':
            address_count = removeItem(id, address_count);
            break;
        case 'telephone':
            telephone_count = removeItem(id, telephone_count);
            break;
        case 'cellphone':
            cellphone_count = removeItem(id, cellphone_count);
            break;

        case 'hold-id':
            hold_id_count = removeItem(id, hold_id_count);
            break;
        case 'land-pId':
            land_pId_count = removeItem(id, land_pId_count);
            break;
        case 'land-address':
            land_address_count = removeItem(id, land_address_count);
            break;
        case 'land-telephone':
            land_telephone_count = removeItem(id, land_telephone_count);
            break;
        case 'land-cellphone':
            land_cellphone_count = removeItem(id, land_cellphone_count);
            break;
            // 雜項設施
        case 'other-item':
            removeInfoItemOnclick('calArea');
            removeInfoItemOnclick('unit');
            removeInfoItemOnclick('auto-remove');
            other_item_count = removeItem(id, other_item_count);
            getOtherItemCount();
            break;
        case 'calArea':
            calArea_count = removeItem(id, calArea_count);
            break;
        case 'unit':
            unit_count = removeItem(id, unit_count);
            break;
        case 'auto-remove':
            auto_remove_count = removeItem(id, auto_remove_count);
            break;
        case 'captain':
            removeInfoItemOnclick('exit-No');
            removeInfoItemOnclick('captain-id');
            removeInfoItemOnclick('household-number');
            removeInfoItemOnclick('set-household-date');
            removeInfoItemOnclick('family-num');
            captain_count = removeItem(id, captain_count);
            getCaptainCount();
            break;
        case 'exit-No':
            exit_No_count = removeItem(id, exit_No_count);
            break;
        case 'captain-id':
            captain_id_count = removeItem(id, captain_id_count);
            break;
        case 'household-number':
            household_number_count = removeItem(id, household_number_count);
            break;
        case 'set-household-date':
            set_household_date_count = removeItem(id, set_household_date_count);
            break;
        case 'family-num':
            family_num_count = removeItem(id, family_num_count);
            break;
        case 'corp-category':
            removeInfoItemOnclick('corp-item');
            removeInfoItemOnclick('corp-type');
            removeInfoItemOnclick('corp-num');
            removeInfoItemOnclick('corp-unit');
            removeInfoItemOnclick('corp-area');
            removeInfoItemOnclick('corp-equal');
            removeInfoItemOnclick('corp-note');
            corp_count = removeItem(id, corp_count);
            getCorpCount();
            break;
        case 'corp-item':
        case 'corp-type':
        case 'corp-num':
        case 'corp-unit':
        case 'corp-area':
        case 'corp-equal':
        case 'corp-note':
            removeItem(id, corp_count);
            break;
    }
}

function remove_nth_OwnerNameList(index){
    console.log(index);
    console.log(nth_OwnerNameList);
    nth_OwnerNameList.slice(index,1);

    for(var i=0;i<nth_OwnerNameList[index].length;i++){
        if(name_option_array.includes(nth_OwnerNameList[index][i])){
            findIndex = name_option_array.indexOf(nth_OwnerNameList[index][i]);
            name_option_array.splice(findIndex,1);
            hold_id_array.splice(findIndex,1);
            address_array.splice(findIndex,1);
            numerator_array.splice(findIndex,1);
            denominator_array.splice(findIndex,1);
        }
    }
    console.log(name_option_array);
    nth_OwnerNameList[index] = [];
    name_option = "";

    // for(var i=0;i<response_json.name.length;i++){
    //     if(!name_option_array.includes(response_json.name[i]) && response_json.name[i]!=""){
    //         name_option_array.push(response_json.name[i]);
    //         hold_id_array.push(response_json.hold_id[i]);
    //         address_array.push(response_json.address[i]);
    //         numerator_array.push(response_json.numerator[i]);
    //         denominator_array.push(response_json.denominator[i]);
    //        //  name_option += "<option value='"+response_json.name[i]+"'>"+response_json.name[i]+"</option>";

    //         nth_OwnerNameList[num-1].push(response_json.name[i]);
    //     }
    //     // name_option += "<option value='"+response_json.name[i]+"'>"+response_json.name[i]+"</option>";
    // }
    console.log(name_option_array);
    for(var i=0;i<name_option_array.length;i++){
       name_option += "<option value='"+name_option_array[i]+"'>"+name_option_array[i]+"</option>";
    }
}

// function checkHouseholdRegistration(hasHousehold){
//     if(hasHousehold){
//         $("#household_count").attr("required","");
//         $("#household_count_lack").attr("required","");
//     }
//     else{
//         $("#household_count").removeAttr("required");
//         $("#household_count_lack").removeAttr("required");
//     }
// }
//
// function checkLegalCertificate(hasCertificate){
//     if(hasCertificate){
//         $("#build-number").attr("required","");
//     }
//     else{
//         $("#build-number").removeAttr("required");
//     }++
// }

function changeRequired(idArray,changeStatus){

    for(var i in idArray){
        var item = "#"+idArray[i]

        if(changeStatus){
            $(item).attr("required","");
        }
        else{
            $(item).removeAttr("required");
        }
    }
}

function setDaughterWall(select_value, num, direction){
    var select_item = select_value+"-"+num;
    var front_value = ['RC-front','1B-front','half_B-front'];
    var behind_value = ['RC-behind','1B-behind','half_B-behind'];
    var left_value = ['RC-left','1B-left','half_B-left'];
    var right_value = ['RC-right','1B-right','half_B-right'];
    var current_direction;

    switch (direction) {
        case 'front':
            current_direction = front_value;
            break;
        case 'behind':
            current_direction = behind_value;
            break;
        case 'left':
            current_direction = left_value;
            break;
        case 'right':
            current_direction = right_value;
            break;
    }

    for(var i=0;i<3;i++){
        // var item = "input[value='"+current_direction[i]+"']";
        var item = document.getElementById(current_direction[i]+"-"+num);

        if(document.getElementById(select_item).checked){
            if(select_value!=current_direction[i]){
                $(item).attr("disabled","true");
            }
        }
        else{
            if(select_value!=current_direction[i]){
                $(item).removeAttr("disabled");
            }
        }
    }
}

function setWindowLevel(id, num){
    var select_item = id+"-"+num;
    var item_array = ["normal-window-level","art-window-level","luxury-window-level"];
    // var value_array = ["普通型","美術型","豪華型"];
    // var current_value = $(select_item).val();

    for(var i=0;i<item_array.length;i++){
        var item = document.getElementById(item_array[i]+"-"+num);

        if(document.getElementById(select_item).checked){
            if(id!=item_array[i]){
                $(item).attr("disabled","true");
            }
        }
        else{
            if(id!=item_array[i]){
                $(item).removeAttr("disabled");
            }
        }
    }
}

function cellphoneListen(num){
    var item = "input[name='cellphone-"+num+"']";

    if($(item).val().length==4){
        $(item).attr("oninput","cellphoneListen("+num+")");
        text = $(item).val()+"-";
        $(item).val(text);
        $(item).attr("oninput","removeCellphoneListen("+num+")");
    }
}

function removeCellphoneListen(num){
    var item = "input[name='cellphone-"+num+"']";

    if($(item).val().length==4){
        text = $(item).val().substr(0,3);
        $(item).val(text);
        $(item).attr("oninput","cellphoneListen("+num+")");
    }
}
// function clearDaughterWall(num){
//     // var itemId = "daughter-wall-front-1"+num;
//     var item = "input[name='daughter-wall-front-1']:checked";
//     $(item).checked = "";
//     window.alert($(item).val());
//     // $(item).removeAttr("checked");
//     // window.alert($(item).checked));
//     // $(itemId).attr("checked",false);
//     // $(item).attr("checked", false);
//     // $("input[name=daughter-wall-front-1]").attr("checked", false);
// }

// function getCount(item){
//     // var item = id+"_count";
//     // return this[item];
//     return this[item];
// }
//
// function house_submit_preview(path){
//     method = "post"; // Set method to post by default, if not specified.
//     params = ["land_section","subsection"];
//
//     // The rest of this code assumes you are not using a library.
//     // It can be made less wordy if you use one.
//     var form = document.createElement("form");
//     form.setAttribute("method", method);
//     form.setAttribute("action", path);
//
//     for(var key in params) {
//         var item = params[key]+"_count";
//         var hiddenField = document.createElement("input");
//         hiddenField.setAttribute("type", "hidden");
//         hiddenField.setAttribute("name", item);
//         window.alert(getCount(item));
//         hiddenField.setAttribute("value", getCount(params[key]));
//
//         form.appendChild(hiddenField);
//     }
//
//     document.body.appendChild(form);    // Not entirely sure if this is necessary
//     form.submit();
// }
function load_electric_data(num){
    var item = "#electric-usage-"+num;
    var item_type = $(item).val();

    if(item_type == ""){
        $("#electric-type-"+num).html("<option value='' style='display:none;'>請選擇種類</option>");
        return;
    }

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'electric_type',
            item_type: item_type
         },
         cache:false,
         dataType: "json",
         async: false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             // window.alert("success");
             // window.alert(data.item_name);
             // $("#electric_type_option").html(1)
             $("#electric-type-"+num).html(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function load_floor_type_data(num,column){
    var item = "#floor-type-"+num;
    var material = $("#building-material-"+num).val();
    var building_type_radio = $("input[name='house-type-"+num+"']");
    var building_type = "";

    for(var i=0;i<building_type_radio.length;i++){
        if(building_type_radio[i].checked) {building_type = building_type_radio[i].value;}
    }

    if(building_type == ""){
        window.alert("請先選擇戶別!");
        document.getElementById("building-material-"+num).selectedIndex = "0";
        return;
    }

    if(material == ""){
        document.getElementById("building-material-"+num).selectedIndex = "0";
        $("#floor-type-"+num).html("<option style=\"display:none;\">請選擇層別</option>")
        return;
    }

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'floor_type',
            material: material,
            building_type: building_type
         },
         cache:false,
         async:false,
         dataType: "json",
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             $(item).html(data.item_name);
         },
         error:function(err){
             // window.alert(err.statusText);
             window.alert("戶別選擇錯誤!請重新選擇!");
             // $(item).html('<option value="" style="display:none;">請選擇層別</option>');
             document.getElementById("building-material-"+num).selectedIndex = "0";
             $("#floor-type-"+num).html("<option style=\"display:none;\">請選擇層別</option>")
         }
    });
}

function load_toilet_data(column,nth){
    var item = "#toilet-type-"+column+"-"+nth;
    var item_name = $(item).val();

    if(item_name == ""){
        // document.getElementById("toilet-product-"+column+"-"+nth).selectedIndex = "0";
        $("#toilet-product-"+column+"-"+nth).html("<option value='' style='display:none';>請選擇種類</option>");
        return;
    }

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'toilet_type',
            item_name: item_name
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             $("#toilet-product-"+column+"-"+nth).html(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function get_building_decoration_option(id,column,count,category){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: category
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             result_option = '<option value="" style="display:none;">請選擇材質</option>'+data.item_name;
             var name = id+column+"-"+count;
             $("select[name='"+name+"']").html(result_option);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

var checkNextPage = false;
function checkNextPageData(page){
    var script_number = "";
    if(document.getElementById("legal").checked){
        script_number = $("#legal").val()+"-"+$("#script-number").val();
    }
    else{
        script_number = $("#illegal").val()+"-"+$("#script-number").val();
    }
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: "check_next_page",
            script_number: script_number,
            page: page
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             if(data.item_name==true){
                 checkNextPage = true;
             }
             else{
                 checkNextPage = false;
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function checkNextPageData2(page,script_number){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: "check_next_page",
            script_number: script_number,
            page: page
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             if(data.item_name==true){
                 checkNextPage = true;
             }
             else{
                 checkNextPage = false;
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function saveDialog(){
    checkExitNo();
    // corpSubmit();
    setShared();
    var page = $("#page").val();
    checkNextPageData(page);
    // var isContinue = window.confirm("是否確定儲存?");
    if(checkNextPage){
        var isContinue = window.confirm("下一頁還有建物資料\n若儲存將捨棄後方資料\n是否確定儲存?");
    }
    else{
        var isContinue = window.confirm("是否確定儲存?");
    }
    var form = document.getElementById('house_form');
    var submitButton = document.getElementById('submitBtn');
    var sendButton = document.getElementById('sendBtn');
    var floorCount = 0;

    if(isContinue==true){
        // $("#house_form").attr("action","sub_building.php");
        // $("#sub-building").append(text);
        $("#action").val("sub_building");
        deleteNextPage = true;
        // window.alert($("#action").val());
        // window.alert($("#section-1").val());
        // sendButton.addEventListener('click', function(){
        //     submitButton.click();
        // });

        // 儲存粉裝資料到陣列
        itemId = ["#minus-wall-num-","#minus-wall-option-","#add-wall-num-","#add-wall-option-"];
        writeToId = ["#minus-wall-count-","#minus-wall-option-","#add-wall-count-","#add-wall-option-"];
        countId = [this.minus_wall_count,this.add_wall_count];

        decoration_itemId = ["#indoor-divide-numerator-","#indoor-divide-denominator-","#indoor-divide-option-","#outdoor-wall-decoration-numerator-","#outdoor-wall-decoration-denominator-","#outdoor-wall-decoration-option-","#indoor-wall-decoration-numerator-","#indoor-wall-decoration-denominator-","#indoor-wall-decoration-option-","#roof-decoration-numerator-","#roof-decoration-denominator-","#roof-decoration-option-","#floor-decoration-numerator-","#floor-decoration-denominator-",
        "#floor-decoration-option-","#ceiling-decoration-numerator-","#ceiling-decoration-denominator-","#ceiling-decoration-option-","#toilet-ratio-","#toilet-type-","#toilet-number-"];
        decoration_writeToId = ["#indoor-divide-numerator-","#indoor-divide-denominator-","#indoor-divide-option-","#outdoor-wall-decoration-numerator-","#outdoor-wall-decoration-denominator-","#outdoor-wall-decoration-option-","#indoor-wall-decoration-numerator-","#indoor-wall-decoration-denominator-","#indoor-wall-decoration-option-","#roof-decoration-numerator-","#roof-decoration-denominator-","#roof-decoration-option-","#floor-decoration-numerator-","#floor-decoration-denominator-",
        "#floor-decoration-option-","#ceiling-decoration-numerator-","#ceiling-decoration-denominator-","#ceiling-decoration-option-","#toilet-ratio-","#toilet-type-","#toilet-number-"];
        decoration_countId = [this.indoor_divide_count,this.outdoor_wall_decoration_count,this.indoor_wall_decoration_count,this.roof_decoration_count,this.floor_decoration_count,this.ceiling_decoration_count,this.toilet_equipment_count];

        // 新增室內牆型別
        $indoor_wall_type = "#indoor-wall-type-";
        // 新增浴廁產地種類
        $toilet_product = "#toilet-product-";

        for(var i=0;i<itemId.length;i++){
            writeDataToOneRow(itemId[i],writeToId[i],countId[Math.floor(i/2)]);
        }

        //粉裝造作
        for(var i=0;i<decoration_itemId.length;i++){
            writeDataToOneRow(decoration_itemId[i],decoration_writeToId[i],decoration_countId[Math.floor(i/3)]);
        }

        writeDataToOneRow($indoor_wall_type,$indoor_wall_type, this.indoor_wall_decoration_count);
        writeDataToOneRow($toilet_product,$toilet_product, this.toilet_equipment_count);
        // 紀錄本頁中有多少筆建物
        for(var i=0;i<4;i++){
            if($("#floor-id-"+(i+1)).val() != ""){
                floorCount++;
            }
        }
        $("#floor-count").val(floorCount);

        $("#submitBtn").click();
    }
    else{
        // $("#action").val("submit");
        // window.alert($("#action").val());
        deleteNextPage = false;
    }

    // value_array = [];
    // for(var i=0;i<captain_count;i++){
    //     if($("#exit-num").val()==1 && captain_count>1){
    //         $("#cohabit-"+(i+1)).val("yes");
    //     }
    //     else{
    //         if(document.getElementById("cohabit-"+(i+1)).checked){
    //             $("#cohabit-"+(i+1)).val("yes");
    //         }
    //         else{
    //             $("#cohabit-"+(i+1)).val("no");
    //         }
    //     }
    //     value_array[i] = $("#cohabit-"+(i+1)).val();
    // }
    // $("#cohabit-judge").val(value_array);

    // itemId = ["#minus-wall-num-","#minus-wall-option-","#add-wall-num-","#add-wall-option-"];
    // writeToId = ["#minus-wall-count-","#minus-wall-option-","#add-wall-count-","#add-wall-option-"];
    // countId = [this.minus_wall_count,this.add_wall_count];
    //
    // decoration_itemId = ["#indoor-divide-numerator-","#indoor-divide-denominator-","#indoor-divide-option-","#outdoor-wall-decoration-numerator-","#outdoor-wall-decoration-denominator-","#outdoor-wall-decoration-option-","#indoor-wall-decoration-numerator-","#indoor-wall-decoration-denominator-","#indoor-wall-decoration-option-","#roof-decoration-numerator-","#roof-decoration-denominator-","#roof-decoration-option-","#floor-decoration-numerator-","#floor-decoration-denominator-",
    // "#floor-decoration-option-","#ceiling-decoration-numerator-","#ceiling-decoration-denominator-","#ceiling-decoration-option-","#toilet-ratio-","#toilet-type-","#toilet-number-"];
    // decoration_writeToId = ["#indoor-divide-numerator-","#indoor-divide-denominator-","#indoor-divide-option-","#outdoor-wall-decoration-numerator-","#outdoor-wall-decoration-denominator-","#outdoor-wall-decoration-option-","#indoor-wall-decoration-numerator-","#indoor-wall-decoration-denominator-","#indoor-wall-decoration-option-","#roof-decoration-numerator-","#roof-decoration-denominator-","#roof-decoration-option-","#floor-decoration-numerator-","#floor-decoration-denominator-",
    // "#floor-decoration-option-","#ceiling-decoration-numerator-","#ceiling-decoration-denominator-","#ceiling-decoration-option-","#toilet-ratio-","#toilet-type-","#toilet-number-"];
    // decoration_countId = [this.indoor_divide_count,this.outdoor_wall_decoration_count,this.indoor_wall_decoration_count,this.roof_decoration_count,this.floor_decoration_count,this.ceiling_decoration_count,this.toilet_equipment_count];
    //
    // // 新增室內牆型別
    // $indoor_wall_type = "#indoor-wall-type-";
    // // 新增浴廁產地種類
    // $toilet_product = "#toilet-product-";
    //
    // for(var i=0;i<itemId.length;i++){
    //     writeDataToOneRow(itemId[i],writeToId[i],countId[Math.floor(i/2)]);
    // }
    //
    // //粉裝造作
    // for(var i=0;i<decoration_itemId.length;i++){
    //     writeDataToOneRow(decoration_itemId[i],decoration_writeToId[i],decoration_countId[Math.floor(i/3)]);
    // }
    //
    // writeDataToOneRow($indoor_wall_type,$indoor_wall_type, this.indoor_wall_decoration_count);
    // writeDataToOneRow($toilet_product,$toilet_product, this.toilet_equipment_count);
}

function onSubmit(){
    var page = $("#page").val();
    // 刪除後方剩餘資料
    if(deleteNextPage){
        deletePageData(page);
    }
}

function writeDataToOneRow(itemId,writeToId,countId){
    console.log("writeDataToOneRow");
    for(var i=0;i<4;i++){
        temp_array = [];
        for(var j=0;j<countId[i];j++){
            var name = itemId+(i+1)+"-"+(j+1);
            // window.alert(name);
            temp_array[j] = $(name).val();
        }
        $(writeToId+(i+1)).val(temp_array);
        if(itemId=="#toilet-product-"){
            // window.alert(temp_array);
            // window.alert(writeToId+(i+1).val());
        }
    }
}

function deletePageData(page){
    var script_number = "";
    if(document.getElementById("legal").checked){
        script_number = $("#legal").val()+"-"+$("#script-number").val();
    }
    else{
        script_number = $("#illegal").val()+"-"+$("#script-number").val();
    }

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: "delete_page_data",
            script_number: script_number,
            page: page
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             // window.alert(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function deletePageData2(page,script_number){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: "delete_page_data",
            script_number: script_number,
            page: page
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             // window.alert(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function changeColumnStatus(column,status){
    var itemId = ["#house-type-","#discard-status-","#pay-form-","#building-material-","#nth-floor-","#total-floor-","#floor-area-","#house-usage-"]

    switch (status) {
        case 'focus':
            if($("#floor-id-"+column).val()!=""){
                for(var i=0;i<itemId.length;i++){
                    $(itemId[i]+column).attr("required","");
                }
            }
            else if($("#floor-id-"+column).val()==""){
                for(var i=0;i<itemId.length;i++){
                    $(itemId[i]+column).removeAttr("required");
                }
            }
            break;
    }
}

function getOwnerCount(){
    $("#owner_count").val(owner_count);
}

function getLandOwnerCount(){
    $("#land_owner_count").val(land_owner_count);
}

function getCaptainCount(){
    $("#captain_count").val(captain_count);
}

function getLandSectionCount(){
    $("#land_section_count").val(land_section_count);
}

function getMinusWallCount(num){
    $("#minus-wall-count-"+(num+1)).val(minus_wall_count[num]);
}

function getAddWallCount(num){
    $("#add-wall-count-"+(num+1)).val(add_wall_count[num]);
}

function getIndoorDivideCount(num){
    $("#indoor-divide-count-"+(num+1)).val(indoor_divide_count[num]);
}

function getOutdoorWallDecorationCount(num){
    $("#outdoor-wall-decoration-count-"+(num+1)).val(outdoor_wall_decoration_count[num]);
}

function getIndoorWallDecorationCount(num){
    $("#indoor-wall-decoration-count-"+(num+1)).val(indoor_wall_decoration_count[num]);
}

function getRoofDecorationCount(num){
    $("#roof-decoration-count-"+(num+1)).val(roof_decoration_count[num]);
}

function getFloorDecorationCount(num){
    $("#floor-decoration-count-"+(num+1)).val(floor_decoration_count[num]);
}

function getCeilingDecorationCount(num){
    $("#ceiling-decoration-count-"+(num+1)).val(ceiling_decoration_count[num]);
}

function getToiletEquipmentCount(num){
    $("#toilet-equipment-count-"+(num+1)).val(toilet_equipment_count[num]);
}

function getOtherItemCount(){
    $("#other-item-count").val(other_item_count);
}

function getCorpCount(){
    $("#corp-count").val(corp_count);
}

// function setRequired(id){
//     var item = id+"1-2";
//     window.alert(item);
//     // window.alert(id+"1-2");
//     // window.alert($(id+"1-2").val());
//     if($(item).val()==""){
//         $(item)[0].focus(function(){
//             $(item).css("background-color","#FFFFCC");
//         });
//         window.alert("fuck");
//     }
// }

function exportExcel(script_number,house_address){
    // $("#msg").html("<h1>Excel報表正在匯出中...<br>請勿關閉視窗...</h1>");
    $("#exportBtn").html("");
    $.post("export_excel.php", {'script_number':script_number, 'house_address':house_address},
    function(){
        $('div.loading').hide();
        window.alert("Excel匯出成功!");
    }).done(function() {
        // alert("請點擊繼續!");
        location.href = "homepage.php";
      })
      .fail(function() {
        alert("Excel匯出失敗!");
    });
    // $.ajax({
    //      url: "export_excel.php",
    //      type: "POST",
    //      data:{
    //         script_number: script_number,
    //         house_address: house_address
    //      },
    //      cache:false,
    //      dataType: "json",
    //      // contentType: 'application/json; charset=utf-8',
    //      success: function(data){
    //          window.alert("Excel匯出成功!");
    //          location.href = "homepage.php";
    //      },
    //      error:function(err){
    //          window.alert(err.statusText);
    //      }
    // });
}

function exportCorpExcel(script_number){
    // $("#msg").html("<h1>Excel報表正在匯出中...<br>請勿關閉視窗...</h1>");
    $("#exportBtn").html("");
    $.post("export_corp_excel.php", {'script_number':script_number},
    function(){
        $('div.loading').hide();
        window.alert("Excel匯出成功!");
    }).done(function() {
        // alert("請點擊繼續!");
        location.href = "homepage.php";
      })
      .fail(function() {
        alert("Excel匯出失敗!");
    });
}

function continueInput(){
    var floorCount = 0;

    for(var i=0;i<4;i++){
        if($("#floor-id-"+(i+1)).val() == ""){
            window.alert("建物表格尚有欄位可填寫\n無法繼續輸入下一頁!");
            return;
        }
        else{
            floorCount++;
        }
    }
    var isContinue = window.confirm("是否繼續輸入建物?");
    if(isContinue == true){
        $("#floor-count").val(floorCount);
        $("#action").val("continue");
        // $("#house_form").attr("action","building_continue.php");

        // 儲存粉裝資料到陣列
        itemId = ["#minus-wall-num-","#minus-wall-option-","#add-wall-num-","#add-wall-option-"];
        writeToId = ["#minus-wall-count-","#minus-wall-option-","#add-wall-count-","#add-wall-option-"];
        countId = [this.minus_wall_count,this.add_wall_count];

        decoration_itemId = ["#indoor-divide-numerator-","#indoor-divide-denominator-","#indoor-divide-option-","#outdoor-wall-decoration-numerator-","#outdoor-wall-decoration-denominator-","#outdoor-wall-decoration-option-","#indoor-wall-decoration-numerator-","#indoor-wall-decoration-denominator-","#indoor-wall-decoration-option-","#roof-decoration-numerator-","#roof-decoration-denominator-","#roof-decoration-option-","#floor-decoration-numerator-","#floor-decoration-denominator-",
        "#floor-decoration-option-","#ceiling-decoration-numerator-","#ceiling-decoration-denominator-","#ceiling-decoration-option-","#toilet-ratio-","#toilet-type-","#toilet-number-"];
        decoration_writeToId = ["#indoor-divide-numerator-","#indoor-divide-denominator-","#indoor-divide-option-","#outdoor-wall-decoration-numerator-","#outdoor-wall-decoration-denominator-","#outdoor-wall-decoration-option-","#indoor-wall-decoration-numerator-","#indoor-wall-decoration-denominator-","#indoor-wall-decoration-option-","#roof-decoration-numerator-","#roof-decoration-denominator-","#roof-decoration-option-","#floor-decoration-numerator-","#floor-decoration-denominator-",
        "#floor-decoration-option-","#ceiling-decoration-numerator-","#ceiling-decoration-denominator-","#ceiling-decoration-option-","#toilet-ratio-","#toilet-type-","#toilet-number-"];
        decoration_countId = [this.indoor_divide_count,this.outdoor_wall_decoration_count,this.indoor_wall_decoration_count,this.roof_decoration_count,this.floor_decoration_count,this.ceiling_decoration_count,this.toilet_equipment_count];

        // 新增室內牆型別
        $indoor_wall_type = "#indoor-wall-type-";
        // 新增浴廁產地種類
        $toilet_product = "#toilet-product-";

        for(var i=0;i<itemId.length;i++){
            writeDataToOneRow(itemId[i],writeToId[i],countId[Math.floor(i/2)]);
        }

        //粉裝造作
        for(var i=0;i<decoration_itemId.length;i++){
            writeDataToOneRow(decoration_itemId[i],decoration_writeToId[i],decoration_countId[Math.floor(i/3)]);
        }

        writeDataToOneRow($indoor_wall_type,$indoor_wall_type, this.indoor_wall_decoration_count);
        writeDataToOneRow($toilet_product,$toilet_product, this.toilet_equipment_count);


        $("#continueBtn").click();
        // window.alert($("#action").val());
    }
}

function setCohabit(num){
    if($("#exit-num").val()==""){
        window.alert("請先選擇出口數!");
        $focused = $(':focus');
        $focused.prop("checked",false);
    }
    else{
        var exit_num = $("#exit-num").val();
        for(var i=0;i<captain_count;i++){
            if(exit_num==1 && captain_count>1){
                $("#cohabit-"+num).val("yes");
            }
            else{
                if(document.getElementById("cohabit-"+num).checked){
                    $("#cohabit-"+num).val("yes");
                }
                else{
                    $("#cohabit-"+num).val("no");
                }
            }
        }
    }
}

function getLandSectionOption(num){
    var item = "#section-"+num;

    if($(item).val().length!=0){
        // window.alert($(item).val());
        $.ajax({
             url: "get_building_decoration_option.php",
             type: "POST",
             data:{
                category: 'land_section',
                str: $(item).val()
             },
             cache:false,
             dataType: "json",
             async:false,
             // contentType: 'application/json; charset=utf-8',
             success: function(data){
                 $("#land-section-list-"+num).html(data.item_name);
             },
             error:function(err){
                 window.alert(err.statusText);
             }
        });
    }
}

// function reloadOwnerData(page,num){
//     name_option = "";
//     name_option_array = [];
//     hold_id_array = [];
//     address_array = [];
//     numerator_array = [];
//     denominator_array = [];

//     for(var i=1;i<=num;i++){
//         isLandNumExist(page,i);
//     }
// }

function isLandNumExist(page,num){
    var item = "#land-num-"+num;
    var section = "#section-"+num;
    var subsection = "#sub_section-"+num;

    numArray = $(item).val().split("、");
    for(var i=0;i<numArray.length;i++){
        $.ajax({
             url: "get_building_decoration_option.php",
             type: "POST",
             data:{
                category: 'land_number',
                section: $(section).val(),
                subsection: $(subsection).val(),
                land_number: numArray[i]
             },
             cache:false,
             dataType: "json",
             async:false,
             // contentType: 'application/json; charset=utf-8',
             success: function(data){
                 if(data.item_name==false){
                     window.alert("輸入地號在資料庫中查無!\n請重新輸入!");
                     $(item).val("");
                 }
                 else{
                     if(i==numArray.length-1){
                         autoCompleteOwnerData(page,num,numArray,$(section).val(),$(subsection).val());
                     }
                 }
             },
             error:function(err){
                 window.alert(err.statusText);
             }
        });
    }
}

function getSubbuildingCategory(num){
    var item = "#other-item-category-"+num;

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'sub_building_category'
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             // window.alert(data.item_name);
             $(item).html(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getSubbuildingOption(num){
    var item = "#other-item-option-"+num;
    var application = $("#other-item-category-"+num).val();
    var unit = "#unit-option-"+num;
    var item_name_option = "";
    var unit_option = "";

    if(application == ""){
        $(item).html("<option value='' style='display:none;'>請選擇項目</option>");
        document.getElementById("other-item-type-"+num).selectedIndex = "0";
        return;
    }

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'sub_building_item',
            application: application
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             // for(var i=0;i<data.item_name.length;i++){
             //     item_name_option += "<option value='"+data.item_name[i]+"'>"+data.item_name[i]+"</option>";
             //     unit_option += "<option value='"+data.unit[i]+"'>"+data.unit[i]+"</option>";
             // }
             $(item).html(data.item_name);
             loadSubbuildingUnit(num);
             // $(item).html(item_name_option);
             // $(unit).html(unit_option)
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getFenceOption(num,type){
    console.log("載入 "+type+" "+num);
    if(type == "粉刷"){
        var item = "#fence-paint-"+num;
    }
    else{
        var item = "#fence-pillar-"+num;
    }

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_fence_option',
            type: type
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             $(item).html(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function loadSubbuildingUnit(num){
    var item = $("#other-item-option-"+num).val();
    var application = $("#other-item-category-"+num).val();
    var unit = "#unit-option-"+num;

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'sub_building_unit',
            application: application,
            item_name: item,
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             $(unit).html(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });

    loadAutoRemove(num);
}

function checkAreaCalText(num){
    var item = "#floor-area-"+num;

    str = $(item).val();
    for(var i=0;i<str.length;i++){
        if(str[i].charCodeAt()>=40 && str[i].charCodeAt()<=57){
            if(str[i].charCodeAt()==44){
                alert("只能輸入數字、小數點、運算符號、括號!");
                break;
            }
        }
        else{
            alert("只能輸入數字、小數點、運算符號、括號!");
            break;
        }
    }
}

function isCohabitNumTrue(cohabit_count,not_cohabit_count,captain_count){
    if((cohabit_count+not_cohabit_count==captain_count) && cohabit_count!=0 && not_cohabit_count!=0){
        return true;
    }
    return false;
}

function checkOwner(num){
    var name = "input[name='land-owner-"+num+"']";
    var hold_id = "input[name='hold-id-"+num+"']";

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'land_lord',
            name: $(name).val(),
            hold_id: $(hold_id).val()
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             if(data.item_name==false){
                 window.alert("名字或歸戶號輸入錯誤!\n請重新輸入!");
                 $(name).val("");
                 $(hold_id).val("");
             }
             else{
                 $("#landAddressText-"+num).val(data.item_name);
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}
function load_corp_category_Data(num){
    var item = "select[name='corp-category-"+num+"']";
    if(corp_category_option == ""){
        $.ajax({
            url: "get_building_decoration_option.php",
            type: "POST",
            data:{
               category: 'corp_category'
            },
            cache:false,
            dataType: "json",
            async: false,
            // contentType: 'application/json; charset=utf-8',
            success: function(data){
                // console.log("load category "+(num-1));
                // $(item).html(data.item_name);
                // load_corp_item_Data(num);
                corp_category_option = data.item_name;
            },
            error:function(err){
                window.alert(err.statusText);
            }
       });
    }
    console.log("load category "+(num-1));
    $(item).html(corp_category_option);
    $(item).selectedIndex = 1;

    // $.ajax({
    //      url: "get_building_decoration_option.php",
    //      type: "POST",
    //      data:{
    //         category: 'corp_category'
    //      },
    //      cache:false,
    //      dataType: "json",
    //      async: false,
    //      // contentType: 'application/json; charset=utf-8',
    //      success: function(data){
    //          console.log("load category "+(num-1));
    //          $(item).html(data.item_name);
    //          load_corp_item_Data(num);
    //      },
    //      error:function(err){
    //          window.alert(err.statusText);
    //      }
    // });
}
function load_corp_item_Data(num){
    let category_select = "select[name='corp-category-"+num+"']";
    let corp_item = "input[name='corp-item-"+num+"']";
    let category = $(category_select).val();
    $(corp_item).val("");
    // $.ajax({
    //      url: "get_building_decoration_option.php",
    //      type: "POST",
    //      data:{
    //         category: 'corp_item',
    //         classfication: classfication
    //      },
    //      cache:false,
    //      dataType: "json",
    //      async: false,
    //      // contentType: 'application/json; charset=utf-8',
    //      success: function(data){
    //          console.log("load corp item "+(num-1));
    //          let datalist = "<datalist id='corp-item-list-"+num+"'>"+data.item_name+"</datalist>";
    //          $(corp_item).html(datalist);
    //         //  load_corp_type_Data(num);
    //      },
    //      error:function(err){
    //          window.alert(err.statusText);
    //      }
    // });

    // let datalist = "<datalist id='corp-item-list-"+num+"'>"+data.item_name+"</datalist>";
    let datalist = "<datalist id='corp-item-list-"+num+"'>";
    for(let i=0;i<corp_item_data.corp_item_data.length;i++){
        if(corp_item_data.corp_item_data[i].category == category){
            for(let j=0;j<corp_item_data.corp_item_data[i].item.length;j++){
                datalist += "<option value='"+corp_item_data.corp_item_data[i].item[j]+"'>"+corp_item_data.corp_item_data[i].item[j]+"</option>";
            }
        }
    }
    datalist += "</datalist>";
    $(corp_item).html(datalist);
}

function load_corp_type_Data(num){
    // var item = "#corp-item-"+num;
    var item = "input[name='corp-item-"+num+"']"
    var corp_item = $(item).val();
    var corp_type = "select[name='corp-type-"+num+"']";
    var corp_type_html = "";

    // $.ajax({
    //      url: "get_building_decoration_option.php",
    //      type: "POST",
    //      data:{
    //         category: 'corp_type',
    //         corp_item: corp_item
    //      },
    //      cache:false,
    //      dataType: "json",
    //      async: false,
    //      // contentType: 'application/json; charset=utf-8',
    //      success: function(data){
    //          console.log("load corp type "+(num-1));
    //          $(corp_type).html(data.item_name);
    //         //  load_corp_unit_Data(num);
    //      },
    //      error:function(err){
    //          window.alert(err.statusText);
    //      }
    // });

    for(let i=0;i<corp_type_data.corp_type_data.length;i++){
        if(corp_type_data.corp_type_data[i].item == corp_item){
            for(let j=0;j<corp_type_data.corp_type_data[i].corp_type.length;j++){
                corp_type_html += "<option value='"+corp_type_data.corp_type_data[i].corp_type[j]+"'>"+corp_type_data.corp_type_data[i].corp_type[j]+"</option>";
            }
        }
    }
    $(corp_type).html(corp_type_html);
    load_corp_unit_Data(num);
}

function load_corp_unit_Data(num){
    // var item = "#corp-item-"+num;
    var item = "input[name='corp-item-"+num+"']"
    var corp_item = $(item).val();
    var corp_type = $("select[name='corp-type-"+num+"']").val();
    var corp_unit = "select[name='corp-unit-"+num+"']";
    var corp_unit_html = "";

    // $.ajax({
    //      url: "get_building_decoration_option.php",
    //      type: "POST",
    //      data:{
    //         category: 'corp_unit',
    //         corp_item: corp_item,
    //         corp_type: corp_type
    //      },
    //      cache:false,
    //      dataType: "json",
    //      async: false,
    //      // contentType: 'application/json; charset=utf-8',
    //      success: function(data){
    //          console.log("load corp unit "+(num-1));
    //          $(corp_unit).html(data.item_name);
    //      },
    //      error:function(err){
    //          window.alert(err.statusText);
    //      }
    // });

    for(let i=0;i<corp_type_data.corp_type_data.length;i++){
        if(corp_type_data.corp_type_data[i].item == corp_item){
            for(let j=0;j<corp_type_data.corp_type_data[i].corp_type.length;j++){
                if(corp_type_data.corp_type_data[i].corp_type[j] == corp_type){
                    corp_unit_html += "<option value='"+corp_type_data.corp_type_data[i].unit[j]+"'>"+corp_type_data.corp_type_data[i].unit[j]+"</option>";
                }
            }
        }
    }
    $(corp_unit).html(corp_unit_html);
}

var isShow = false;
function cohabitRemind(){
    if($("#exit-num").val()==""){
        window.alert("請先選擇出口數!");
        return;
    }
    // if(!isShow){
    //     window.alert("共同出口戶請填相同數字，例如A、B共用出口都填1，C有單獨出口請填2");
    // }
    // isShow = true;
}

function checkExitNo(){
    for(var i=1;i<=captain_count;i++){
        var captain = $("input[name='captain-"+i+"']").val();
        var exitNo = "input[name='exit-No-"+i+"']";
        if(captain != ""){
            // window.alert(captain);
            $(exitNo).attr("required","");
        }
        else{
            $(exitNo).removeAttr("required");
        }
    }
}

function checkExitNoCorrect(){
    var array = [];
    var index = 0;
    var exitNum = $("#exit-num").val();

    for(var i=0;i<exit_No_count;i++){
        var item = "input[name='exit-No-"+(i+1)+"']";
        if(!array.includes($(item).val()) && $(item).val()!=""){
            array.push($(item).val());
        }
    }

    if(array.length>exitNum){
        window.alert("輸入的出口編號錯誤!\n"+exitNum+"個出口不能有"+array.length+"組獨立戶!");
        for(var i=0;i<exit_No_count;i++){
            var item = "input[name='exit-No-"+(i+1)+"']";
            $(item).val("");
        }
    }
}

function getLandOwnerOption(num){
    var item = "input[name='land-owner-"+num+"']";

    if($(item).val().length!=0){
        $.ajax({
             url: "get_building_decoration_option.php",
             type: "POST",
             data:{
                category: 'land_owner',
                str: $(item).val()
             },
             cache:false,
             dataType: "json",
             async:false,
             // contentType: 'application/json; charset=utf-8',
             success: function(data){
                 $("#land-owner-list-"+num).html(data.item_name);
             },
             error:function(err){
                 window.alert(err.statusText);
             }
        });
    }
}

function checkRatioInput(id){
    var item = "#"+id;
    var total_ratio = 0;
    var num = id.substr(id.length-1,1);
    if($(item).val() == "0"){
        window.alert("分子或分母不能為0!");
        $(item).val("");
    }

    if($("#hold-numerator-"+num).val() != "" && $("#hold-denominator-"+num).val() != ""){
        for(var i=1;i<=owner_count;i++){
            var ratio = $("#hold-numerator-"+i).val() / $("#hold-denominator-"+i).val();
            total_ratio += ratio;
        }
    }
    if(!$("#shared")[0].checked){
        if(total_ratio>1){
            window.alert("所有權人輸入比例大於1! 請注意!\n若為公同共有請先勾選下方選項!");
        }
    }
}

function checkFloorType(num){
    // var item = "#floor-type-"+num;
    // window.alert($(item).val());
}

function autoCompleteIndoorWallType(column,num){
    var indoor_divide = "#indoor-divide-option-"+column+"-1";
    var item = "indoor-wall-type-"+column+"-"+num;
    var indoor_wall = "#indoor-wall-decoration-option-"+column+"-"+num;

    if($(indoor_wall).val() == ""){
        document.getElementById(item).selectedIndex = "0";
    }
    else{
        if($(indoor_divide).val() == ""){
            document.getElementById(item).selectedIndex = "1";
        }
        else{
            document.getElementById(item).selectedIndex = "2";
        }
    }
}

var response_json = "";
var name_option = "";
var name_option_array = [];
var hold_id_array = [];
var address_array = [];
var numerator_array = [];
var denominator_array = [];
var option_index = 0;
function autoCompleteOwnerData(page,num,numArray,section,subsection){
    // response_json = "";
    // name_option = "";
    // var item = "#land-owner-list-"+num;
    // var response_json = "";
    // var name_option = "";
    console.log("auto");

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'auto_complete_owner',
            section: section,
            subsection: subsection,
            land_number: numArray
         },
         cache:false,
         dataType: "json",
         async: false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             response_json = data;
             console.log(name_option_array);
             for(var i=0;i<nth_OwnerNameList[num-1].length;i++){
                 if(name_option_array.includes(nth_OwnerNameList[num-1][i])){
                    index = name_option_array.indexOf(nth_OwnerNameList[num-1][i]);
                    name_option_array.splice(index,1);
                    hold_id_array.splice(index,1);
                    address_array.splice(index,1);
                    numerator_array.splice(index,1);
                    denominator_array.splice(index,1);
                 }
             }
             console.log(name_option_array);
             nth_OwnerNameList[num-1] = [];
             name_option = "";

             for(var i=0;i<response_json.name.length;i++){
                 if(!name_option_array.includes(response_json.name[i]) && response_json.name[i]!=""){
                     name_option_array.push(response_json.name[i]);
                     hold_id_array.push(response_json.hold_id[i]);
                     address_array.push(response_json.address[i]);
                     numerator_array.push(response_json.numerator[i]);
                     denominator_array.push(response_json.denominator[i]);
                    //  name_option += "<option value='"+response_json.name[i]+"'>"+response_json.name[i]+"</option>";

                     nth_OwnerNameList[num-1].push(response_json.name[i]);
                 }
                 // name_option += "<option value='"+response_json.name[i]+"'>"+response_json.name[i]+"</option>";
             }
             console.log(name_option_array);
             for(var i=0;i<name_option_array.length;i++){
                name_option += "<option value='"+name_option_array[i]+"'>"+name_option_array[i]+"</option>";
             }
             // if(page=="building"){
             //     for(var i=0;i<num;i++){
             //         loadOwnerData("land-owner",i+1);
             //         loadOwnerData("owner",i+1);
             //     }
             // }
             // else{
             //     for(var i=0;i<num;i++){
             //         loadOwnerData("owner",i+1);
             //         loadOwnerData("land-owner",i+1);
             //         loadOwnerData("corp-owner",i+1);
             //     }
             // }
             var corp_owner = "input[name='corp-owner-1']";
             if(!$(corp_owner).val() && $(corp_owner).val()!= ""){
                //  window.alert("1");
                //  for(var i=0;i<num;i++){
                //      loadOwnerData("land-owner",i+1);
                //      loadOwnerData("owner",i+1);
                //  }
                 for(var i=0;i<owner_count;i++){
                    loadOwnerData("owner",i+1);
                 }
                 loadOwnerData("land-owner",1);
             }
             else{
                //  window.alert("2");
                 for(var i=0;i<owner_count;i++){
                    //  loadOwnerData("land-owner",i+1);
                     loadOwnerData("corp-owner",i+1);
                 }
                 loadOwnerData("land-owner",1);
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function loadOwnerData(id,num){
    // window.alert(name_option);
    // window.alert(id);
    if(id == "land-owner"){
        // $("#land-owner-select-"+num).html(name_option);
        // document.getElementById("land-owner-select-"+num).selectedIndex = num-1;
        // $("input[name='land-owner-"+num+"']").val(response_json.name[num-1]);
        // $("input[name='hold-id-"+num+"']").val(response_json.hold_id[num-1]);
        // $("#landAddressText-"+num).val(response_json.address[num-1]);
        for(var i=1;i<=num;i++){
            $("#land-owner-select-"+i).html(name_option);
            console.log("SELECT "+i);
            document.getElementById("land-owner-select-"+i).selectedIndex = i-1;
            console.log("SELECT "+i+" OK!");
            // $("input[name='land-owner-"+i+"']").val(response_json.name[0]);
            // $("input[name='hold-id-"+i+"']").val(response_json.hold_id[0]);
            // $("#landAddressText-"+i).val(response_json.address[0]);
            $("input[name='land-owner-"+i+"']").val(name_option_array[i-1]);
            $("input[name='hold-id-"+i+"']").val(hold_id_array[i-1]);
            $("#landAddressText-"+i).val(address_array[i-1]);
            $("input[name='hold-numerator-"+i+"']").val(numerator_array[i-1]);
            $("input[name='hold-denominator-"+i+"']").val(denominator_array[i-1]);
        }
    }
    else if(id == "owner"){
        console.log("load "+num);
        console.log(name_option);
        // $("#owner-select-"+num).html(name_option);
        // document.getElementById("owner-select-"+num).selectedIndex = num-1;
        // $("input[name='owner-"+num+"']").val(response_json.name[num-1]);
        // $("#addressText-"+num).val(response_json.address[num-1]);
        for(var i=num;i<=num;i++){
            $("#owner-select-"+i).html(name_option);
            document.getElementById("owner-select-"+i).selectedIndex = i-1;
            $("input[name='owner-"+i+"']").val(name_option_array[i-1]);
            $("#addressText-"+i).val(address_array[i-1]);
            $("input[name='hold-numerator-"+i+"']").val(numerator_array[i-1]);
            $("input[name='hold-denominator-"+i+"']").val(denominator_array[i-1]);
        }
    }
    else{
        // $("#corp-owner-select-"+num).html(name_option);
        // document.getElementById("corp-owner-select-"+num).selectedIndex = num-1;
        // $("input[name='corp-owner-"+num+"']").val(response_json.name[num-1]);
        // $("#addressText-"+num).val(response_json.address[num-1]);
        for(i=num;i<=num;i++){
            $("#corp-owner-select-"+i).html(name_option);
            document.getElementById("corp-owner-select-"+i).selectedIndex = i-1;
            $("input[name='corp-owner-"+i+"']").val(name_option_array[i-1]);
            $("#addressText-"+i).val(address_array[i-1]);
            $("input[name='hold-numerator-"+i+"']").val(numerator_array[i-1]);
            $("input[name='hold-denominator-"+i+"']").val(denominator_array[i-1]);
        }
    }
}

function autoFillInOwnerName(id,num){
    if(id == "land-owner"){
        var item = "#land-owner-select-"+num;
        var name = "input[name='land-owner-"+num+"']";
        var hold_id = "input[name='hold-id-"+num+"']";
        var address = "#landAddressText-"+num;
        var selected = document.getElementById("land-owner-select-"+num).selectedIndex;
    }
    else if(id == "owner"){
        var item = "#owner-select-"+num;
        var name = "input[name='owner-"+num+"']";
        var address = "#addressText-"+num;
        var hold_numerator = "input[name='hold-numerator-"+num+"']";
        var hold_denominator = "input[name='hold-denominator-"+num+"']";
        var selected = document.getElementById("owner-select-"+num).selectedIndex;
    }
    else{
        var item = "#corp-owner-select-"+num;
        var name = "input[name='corp-owner-"+num+"']";
        var address = "#addressText-"+num;
        var hold_numerator = "input[name='hold-numerator-"+num+"']";
        var hold_denominator = "input[name='hold-denominator-"+num+"']";
        var selected = document.getElementById("corp-owner-select-"+num).selectedIndex;
    }

    $(name).text($(item).val());
    $(name).val($(item).val());
    // $(hold_id).val(response_json.hold_id[selected]);
    // $(address).val(response_json.address[selected]);
    $(hold_id).val(hold_id_array[selected]);
    $(address).val(address_array[selected]);
    $(hold_numerator).val(numerator_array[selected]);
    $(hold_denominator).val(denominator_array[selected]);
}

function autoCalculateArea(num){
    var corp_category = "select[name='corp-category-"+num+"']";
    var corp_item = "input[name='corp-item-"+num+"']";
    var corp_type = "select[name='corp-type-"+num+"']";
    var corp_num = "input[name='corp-num-"+num+"']";

    if(!checkCorpArea(num)){
        window.alert("數量格式輸入錯誤!");
        $(corp_num).val("");
        $("input[name='corp-area-"+num+"']").val("");
        return;
    }

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'auto_calculate_area',
            corp_category: $(corp_category).val(),
            corp_item: $(corp_item).val(),
            corp_type: $(corp_type).val(),
            corp_num: $(corp_num).val()
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             // response_json = data;
             // for(var i=0;i<response_json.name.length;i++){
             //     name_option += "<option value='"+response_json.name[i]+"'>"+response_json.name[i]+"</option>";
             // }
             $("input[name='corp-area-"+num+"']").val(data.item_name);
             // window.alert(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function checkCorpArea(num){
    var item = "input[name='corp-num-"+num+"']";

    if($(item).val().length > 10){
        return false;
    }

    str = $(item).val();
    for(var i=0;i<str.length;i++){
        if(str[i].charCodeAt()>58 || str[i].charCodeAt()<48){
            if(str[i].charCodeAt() != 46){
                return false;
            }
        }
    }
    return true;
}

function checkpId(id,num){
    var item = "input[name='"+id+"-"+num+ "']";
    if($(item).val().length!=10){
        window.alert("身分證字號限定10碼!");
        $(item).val("");
    }
}

function emptyAddress(){
    if(document.getElementById("noneAddress").checked){
        if(document.getElementById("legal").checked){
            if($("#script-number").val() == ""){
                window.alert("請先輸入手稿編號!");
                document.getElementById("noneAddress").checked = false;
            }
            else{
                var value = "桃園市"+$("#district").val()+"無門牌";
                $("#houseAddress").val(value);
            }
        }
        else if(document.getElementById("illegal").checked){
            if($("#script-number").val() == ""){
                window.alert("請先輸入手稿編號!");
                document.getElementById("noneAddress").checked = false;
            }
            else{
                var value = "桃園市"+$("#district").val()+"無門牌";
                $("#houseAddress").val(value);
            }
        }
        else{
            window.alert("請先選擇建物合非法狀態!");
            document.getElementById("noneAddress").checked = false;
        }
    }
    else{
        document.getElementById("noneAddress").checked = false;
        $("#houseAddress").val("");
    }
}

function getBuildingMaterialOption(column,num){
    var item = "#building-material-"+column+"-"+num;

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'building_material'
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             $(item).html(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function setDefaultOption(select,clear,num){
    if($("#"+select+"-"+num).val() == ""){
        document.getElementById(clear+"-"+num).selectedIndex = "0";
    }
}

function checkScriptNo(){
    var legal = document.getElementById("legal");
    var illegal = document.getElementById("illegal");
    var script_number = "";
    var table = "";

    if(legal.checked && $("#script-number").val() != ""){
        // window.alert(legal.value);
        if(legal.value == "建合"){
            table = "record";
        }
        else{
            table = "corp_record";
        }
        script_number += legal.value+"-"+$("#script-number").val();
    }
    else if(illegal.checked && $("#script-number").val() != ""){
        // window.alert(illegal.value);
        if(illegal.value == "建非"){
            table = "record";
        }
        else{
            table = "corp_record";
        }
        script_number += illegal.value+"-"+$("#script-number").val();
    }
    else{
        window.alert("請先選擇合非法狀態!");
        $("#script-number").val("");
        return;
    }

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'check_script_No',
            script_number: script_number,
            table: table
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             if(data.item_name == false){
                 window.alert("此手稿編號已存在!\n請重新輸入!");
                 $("#script-number").val("");
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function checkAddress(){
    var address = $("#houseAddress").val();

    // $.ajax({
    //      url: "get_building_decoration_option.php",
    //      type: "POST",
    //      data:{
    //         category: 'check_address',
    //         address: address
    //      },
    //      cache:false,
    //      dataType: "json",
    //      // contentType: 'application/json; charset=utf-8',
    //      success: function(data){
    //          if(data.item_name == false){
    //              window.alert("此地址已存在!\n請重新輸入!");
    //              $("#houseAddress").val("");
    //              document.getElementById("noneAddress").checked = false;
    //          }
    //      },
    //      error:function(err){
    //          window.alert(err.statusText);
    //      }
    // });
}

function checkSubmit(script_number){
    var floorCount = 0;

    if(inputNextPage){
        // $("#house_form").attr("action","building_continue.php");

        for(var i=0;i<4;i++){
            if($("#floor-id-"+(i+1)).val() == ""){
                window.alert("建物表格尚有欄位可填寫\n無法繼續輸入下一頁!");
                return false;
            }
            else{
                floorCount++;
            }
        }
        $("#floor-count").val(floorCount);
        $("#action").val("continue");
        return true;
    }
    else{
        var page = $("#page").val();
        checkNextPageData2(page,script_number);
        if(checkNextPage){
            var isContinue = window.confirm("下一頁還有建物資料\n若儲存將捨棄後方資料\n是否確定儲存?");
        }
        else{
            var isContinue = window.confirm("是否確定儲存?");
        }
        // var isContinue = window.confirm("是否確定儲存?");
        if(isContinue==true){
            if(checkNextPage){
                deletePageData2(page,script_number);
            }

            for(var i=0;i<4;i++){
                if($("#floor-id-"+(i+1)).val() != ""){
                    floorCount++;
                }
            }
            $("#floor-count").val(floorCount);
            $("#action").val("submit");
            return true;
        }
        else{
            return false;
        }
    }
}

function buildingContinue(isContinue){
    if(isContinue){
        inputNextPage = true;
    }
    else{
        inputNextPage = false;
    }
    // 儲存粉裝資料到陣列
    itemId = ["#minus-wall-num-","#minus-wall-option-","#add-wall-num-","#add-wall-option-"];
    writeToId = ["#minus-wall-count-","#minus-wall-option-","#add-wall-count-","#add-wall-option-"];
    countId = [this.minus_wall_count,this.add_wall_count];

    decoration_itemId = ["#indoor-divide-numerator-","#indoor-divide-denominator-","#indoor-divide-option-","#outdoor-wall-decoration-numerator-","#outdoor-wall-decoration-denominator-","#outdoor-wall-decoration-option-","#indoor-wall-decoration-numerator-","#indoor-wall-decoration-denominator-","#indoor-wall-decoration-option-","#roof-decoration-numerator-","#roof-decoration-denominator-","#roof-decoration-option-","#floor-decoration-numerator-","#floor-decoration-denominator-",
    "#floor-decoration-option-","#ceiling-decoration-numerator-","#ceiling-decoration-denominator-","#ceiling-decoration-option-","#toilet-ratio-","#toilet-type-","#toilet-number-"];
    decoration_writeToId = ["#indoor-divide-numerator-","#indoor-divide-denominator-","#indoor-divide-option-","#outdoor-wall-decoration-numerator-","#outdoor-wall-decoration-denominator-","#outdoor-wall-decoration-option-","#indoor-wall-decoration-numerator-","#indoor-wall-decoration-denominator-","#indoor-wall-decoration-option-","#roof-decoration-numerator-","#roof-decoration-denominator-","#roof-decoration-option-","#floor-decoration-numerator-","#floor-decoration-denominator-",
    "#floor-decoration-option-","#ceiling-decoration-numerator-","#ceiling-decoration-denominator-","#ceiling-decoration-option-","#toilet-ratio-","#toilet-type-","#toilet-number-"];
    decoration_countId = [this.indoor_divide_count,this.outdoor_wall_decoration_count,this.indoor_wall_decoration_count,this.roof_decoration_count,this.floor_decoration_count,this.ceiling_decoration_count,this.toilet_equipment_count];

    // 新增室內牆型別
    $indoor_wall_type = "#indoor-wall-type-";
    // 新增浴廁產地種類
    $toilet_product = "#toilet-product-";

    for(var i=0;i<itemId.length;i++){
        writeDataToOneRow(itemId[i],writeToId[i],countId[Math.floor(i/2)]);
    }

    //粉裝造作
    for(var i=0;i<decoration_itemId.length;i++){
        writeDataToOneRow(decoration_itemId[i],decoration_writeToId[i],decoration_countId[Math.floor(i/3)]);
    }

    writeDataToOneRow($indoor_wall_type,$indoor_wall_type, this.indoor_wall_decoration_count);
    writeDataToOneRow($toilet_product,$toilet_product, this.toilet_equipment_count);
    // 紀錄本頁中有多少筆建物
    for(var i=0;i<4;i++){
        if($("#floor-id-"+(i+1)).val() != ""){
            floorCount++;
        }
    }
    $("#floor-count").val(floorCount);
}

function checkDate(id){
    var date = document.getElementById(id);
    var d = new Date;
    var today = new Date(d.getFullYear(), d.getMonth(), d.getDate());
    var reg = /\d+/g;
    var temp = date.value.match (reg);
    var foday = new Date (temp[0], parseInt (temp[1]) - 1, temp[2]);

    if (foday > today){
        window.alert('日期選擇錯誤!請重新選擇!');
        $("#"+id).val("");
    }
}

function corpSubmit(){
    var isContinue = window.confirm("是否確定儲存?");

    if(isContinue==true){
        // var shared = document.getElementById("shared");
        //
        // if(shared.checked){
        //     shared.value = "公同共有";
        // }
        // else{
        //     shared.value = "個別持分";
        // }
        setShared();
        $("#corp-submit-btn").click();
    }
}

function setShared(){
    var shared = document.getElementById("shared");

    if(shared.checked){
        shared.value = "公同共有";
    }
    else{
        shared.value = "個別持分";
    }
}

function corpEqual(num){
    // 紀錄比照
    var item = document.getElementById("corp-equal-check-"+num);

    if(item.checked){
        $("#corp-equal-check-"+num).val("比照");
    }
    else{
        $("#corp-equal-check-"+num).val("");
    }
    // window.alert($("#corp-equal-check-"+num).val());
    // for(var i=1;i<=corp_count;i++){
    //     var isChecked = document.getElementById("corp-equal-check-"+corp_count).checked;
    //     if(isChecked){
    //         $("#corp-equal-check-"+corp_count).val("比照");
    //     }
    //     else{
    //         $("#corp-equal-check-"+corp_count).val("NA");
    //     }
    // }
}

function subBuildingSubmit(){
    var isContinue = window.confirm("是否確定儲存?");

    if(isContinue==true){
        $("#sub-building-submit-btn").click();
    }
}

function subBuildingSkip(){
    checkSub();
    if(checkSubbuilding){
        var isContinue = window.confirm("略過將會刪除已儲存的雜項資料\n是否確定略過?");
    }
    else{
        var isContinue = window.confirm("是否確定略過雜項物?");
    }

    if(isContinue==true){
        deleteSubbuildingData();
        $("#sub-building-skip-btn").click();
    }
}

var checkSubbuilding = false;
function checkSub(){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: "check_subbuilding",
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             if(data.item_name==true){
                 checkSubbuilding = true;
             }
             else{
                 checkSubbuilding = false;
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function deleteSubbuildingData(){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: "delete_subbuilding",
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         // contentType: 'application/json; charset=utf-8',
         success: function(data){

         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getCorpUpdateData(script_number,rId){
    $('div.loading').show();
    $("#script-number").val(rId);
    preLoadCorpItemData();
    preLoadCorpTypeData();
    getCorpLandData(script_number);
    getCorpOwnerData(script_number);
    getCorpLandOwnerData(script_number);
    // getCorpLandData(script_number);
    getCorpData(script_number);
    $('div.loading').hide();
}

function getCorpOwnerData(script_number){
    $.when($.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_corp_owner_data',
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             response_json = data;
             if(response_json.hold_status[0] == "公同共有"){
                $("#shared")[0].checked = true;
             }
             for(var i=0;i<data.name.length;i++){
                 if(i>0){
                     addInfoItemOnclick('corp-owner');
                 }
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    })).then(function(){
        for(var i=0;i<response_json.name.length;i++){
            $("input[name='corp-owner-"+(i+1)+"']").val(response_json.name[i]);
            $("#corp-owner-select-"+(i+1)).val(response_json.name[i]);
            $("#hold-numerator-"+(i+1)).val(response_json.hold_numerator[i]);
            $("#hold-denominator-"+(i+1)).val(response_json.hold_denominator[i]);
            // if(response_json.hold_status[0] == "公同共有"){
            //     $("#shared")[0].checked = true;
            // }
            if(response_json.pId[i].substr(0,2) != "NA"){
                $("input[name='pId-"+(i+1)+"']").val(response_json.pId[i]);
            }
            $("input[name='telephone-"+(i+1)+"']").val(response_json.telephone[i]);
            $("input[name='cellphone-"+(i+1)+"']").val(response_json.cellphone[i]);
            $("#addressText-"+(i+1)).val(response_json.current_address[i]);
        }
    });
}

function getCorpLandOwnerData(script_number){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_corp_land_owner_data',
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             $("input[name='land-owner-1']").val(data.name[0]);
             $("#land-owner-select-1").val(data.name[0]);
             $("input[name='hold-id-1']").val(data.hold_id[0]);
             if(data.pId[0].substr(0,2) != "NA"){
                 $("input[name='land-pId-1']").val(data.pId[0]);
             }
             $("#landAddressText-1").val(data.current_address[0]);
             $("input[name='land-telephone-1']").val(data.telephone[0]);
             $("input[name='land-cellphone-1']").val(data.cellphone[0]);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getCorpLandData(script_number){
    // var land_section_array = [];
    var land_section_array = {"land_section":[]};
    var land_num_array = [];
    // var land_num_array = {"id":[]};
    var index = 0;
    var section_data = ["草漯段","塔腳段","新坡段","樹林子段"];
    var response_json = "";

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_corp_land_data',
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             console.log(data.land_section);
             console.log(data.subsection);
             console.log(data.land_number);
             response_json = data;
             for(var i=0;i<data.land_section.length;i++){
                 var land_number_text = "";
                 if(i>0){
                     addInfoItemOnclick('corp-land-section');
                 }

                 $("#section-"+(i+1)).val(data.land_section[i]);
                 if(data.subsection[i] != ""){
                     $("#sub_section-"+(i+1)).val(data.subsection[i]);
                 }
                 for(var j=0;j<data.land_number[i].length;j++){
                     land_number_text += data.land_number[i][j]
                     if(j != data.land_number[i].length-1){
                         land_number_text += "、";
                     }
                 }
                 $("#land-num-"+(i+1)).val(land_number_text);
                 console.log("loadCorpOwnerData() ",i+1);
                 // isLandNumExist('corp',i+1);
                 loadCorpOwnerData('corp',i+1);
             }
             $("#survey-date").val(data.survey_date[0]);
             $("#district").val(data.district[0]);
             $("#land-use").val(data.land_use[0]);

             // window.alert(data.land_number);
             // $("#land-num-1").val(data.land_number[0]);
             // for(var i=0;i<data.land_number.length;i++){
             //     if(!land_section_array["land_section"].includes(data.land_section[i]) && data.land_section[i]!=""){
             //         land_section_array["land_section"].push(data.land_section[i]);
             //         // land_num_array[index] = data.land_number[i];
             //         // land_num_array.id[index] = data.land_number[i];
             //         // index++;
             //     }
             //     else{
             //         // for(var j=0;j<land_section_array.length;j++){
             //         //     if(data.land_section[i] == land_section_array[j]){
             //         //         land_num_array[j] = data.land_number[i];
             //         //     }
             //         // }
             //     }
             // }

             // window.alert(land_section_array);
             // console.log(land_section_array);
             // var count = 0;
             // var isFind = false;

             // for(var k=0;k<land_section_array.length;k++){
             //     var isFind = false;
             //     if(k>0){
             //         addInfoItemOnclick('land-section');
             //     }
             //
             //     for(var i=0;i<section_data.length;i++){
             //         if(!isFind){
             //             for(var j=0;j<land_section_array.length;j++){
             //                 // window.alert(j+" : "+land_section_array[j]);
             //                 if(section_data[i] == land_section_array[j]){
             //                     console.log(section_data[k]);
             //                     // document.getElementById("section-"+(k+1)).selectedIndex = i;
             //                     $("#section-"+(k+1)).val(section_data[i]);
             //                     // window.alert("相同、"+i+" : "+j+" : "+section_data[i]);
             //                     count++;
             //                     isFind = true;
             //                     // window.alert(k+" : "+section_data[i]);
             //                     break;
             //                 }
             //             }
             //         }
             //     }
             // }

             // $("#survey-date").val(data.survey_date[0]);
             // $("#district").val(data.district[0]);
             // $("#land-use").val(data.land_use[0]);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function loadCorpOwnerData(page,num){
    var item = "#land-num-"+num;
    var section = "#section-"+num;
    var subsection = "#sub_section-"+num;

    numArray = $(item).val().split("、");
    for(var i=0;i<numArray.length;i++){
        autoCompleteOwnerData(page,num,numArray,$(section).val(),$(subsection).val());
    }
}

function getCorpData(script_number){
    var json = "";
    var category_array = ["短期作物","果樹","茶竹","藥用","椰子","柏木","喬木","灌木","蔓性","整型","草本","其他"];
    var corp_category_html = "";
    var corp_item_html = "";
    var corp_type_html = "";
    var corp_num_html = "";
    var corp_unit_html = "";
    var corp_area_html = "";
    var corp_equal_html = "";
    var corp_note_html = "";

    $.when($.ajax({
        url: "get_building_decoration_option.php",
        type: "POST",
        data:{
            category: 'get_corp_data',
            script_number: script_number
        },
        cache:false,
        dataType: "json",
        async:false,
        success: function(data){
            json = data;
            for(var i=1;i<data.category.length;i++){
                corp_category_html = corp_category_html + addInfoItemOnclick('corp-category');
                corp_item_html = corp_item_html + addInfoItemOnclick('corp-item');
                corp_type_html = corp_type_html + addInfoItemOnclick('corp-type');
                corp_num_html = corp_num_html + addInfoItemOnclick('corp-num');
                corp_unit_html = corp_unit_html + addInfoItemOnclick('corp-unit');
                corp_area_html = corp_area_html + addInfoItemOnclick('corp-area');
                corp_equal_html = corp_equal_html + addInfoItemOnclick('corp-equal');
                corp_note_html = corp_note_html + addInfoItemOnclick('corp-note');
            }
            $("#corp-category").append(corp_category_html);
            $("#corp-item").append(corp_item_html);
            $("#corp-type").append(corp_type_html);
            $("#corp-num").append(corp_num_html);
            $("#corp-unit").append(corp_unit_html);
            $("#corp-area").append(corp_area_html);
            $("#corp-equal").append(corp_equal_html);
            $("#corp-note").append(corp_note_html);

            for(var i=0;i<data.category.length;i++){
                load_corp_category_Data(i+1);
                $("#corp-category-option-"+(i+1)).val(data.category[i]);
                console.log("select category "+i);
                load_corp_item_Data(i+1);
                getCorpItem(data,i);
                load_corp_type_Data(i+1);
                getCorpType(data,i);
                $("input[name='corp-num-"+(i+1)+"']").val(data.num[i]);
                $("input[name='corp-area-"+(i+1)+"']").val(data.plant_area_text[i]);
                if(data.equal[i] == "比照"){
                    document.getElementById("corp-equal-check-"+(i+1)).checked = true;
                    document.getElementById("corp-equal-check-"+(i+1)).value = "比照";
                }
                $("input[name='corp-note-"+(i+1)+"']").val(data.note[i]);

                //  for(var j=0;j<category_array.length;j++){
                //      if(data.category[i] == category_array[j]){
                //          // 不alert會有bug
                //          // window.alert(data.category[i]);
                //          // console.log(data.category[i]);

                //          if(i==0){
                //              document.getElementById("corp-category-option-"+(i+1)).selectedIndex = j+1;
                //              console.log("select category "+i);
                //          }
                //          else{
                //              document.getElementById("corp-category-option-"+(i+1)).selectedIndex = j;
                //              console.log("select category "+i);
                //          }
                //          load_corp_item_Data(i+1);
                //          getCorpItem(data,i);
                //          getCorpType(data,i);
                //          $("input[name='corp-num-"+(i+1)+"']").val(data.num[i]);
                //          $("input[name='corp-area-"+(i+1)+"']").val(data.plant_area_text[i]);
                //          if(data.equal[i] == "比照"){
                //              document.getElementById("corp-equal-check-"+(i+1)).checked = true;
                //          }
                //          $("input[name='corp-note-"+(i+1)+"']").val(data.note[i]);
                //          break;
                //      }
                //  }
            }
        },
         error:function(err){
             window.alert(err.statusText);
         }
    })).then(function(){

    });
}

function getCorpItem(json,index){
    var response_json = "";

    // $.when($.ajax({
    //      url: "get_building_decoration_option.php",
    //      type: "POST",
    //      data:{
    //         category: 'get_corp_item',
    //         classfication: json.category[index]
    //      },
    //      cache:false,
    //      dataType: "json",
    //      async:false,
    //      success: function(data){
    //          response_json = data;
    //      },
    //      error:function(err){
    //          window.alert(err.statusText);
    //      }
    // })).then(function(){
    //     for(var i=0;i<json.item.length;i++){
    //         $("#corp-item-option-"+(i+1)).val(json.item[i]);
    //         load_corp_type_Data(i+1);
    //         // for(var j=0;j<response_json.item.length;j++){
    //         //     if(json.item[i] == response_json.item[j]){
    //         //         document.getElementById("corp-item-option-"+(i+1)).selectedIndex = j;
    //         //         // window.alert(i+":"+j);
    //         //         load_corp_type_Data(i+1);
    //         //         break;
    //         //     }
    //         // }
    //     }
    // });
    $("#corp-item-option-"+(index+1)).val(json.item[index]);
}

function getCorpType(json,index){
    var response_json = "";

    // $.when($.ajax({
    //      url: "get_building_decoration_option.php",
    //      type: "POST",
    //      data:{
    //         category: 'get_corp_type',
    //         item: json.item[index]
    //      },
    //      cache:false,
    //      dataType: "json",
    //      async:false,
    //      success: function(data){
    //          response_json = data;
    //          // 資料庫中原本資料的crop_type
    //          // console.log(json.corp_type);
    //          // console.log(response_json.corp_type);
    //      },
    //      error:function(err){
    //          window.alert(err.statusText);
    //      }
    // })).then(function(){
    //     console.log(json.corp_type);
    //     console.log(response_json.corp_type);
    //     for(var i=0;i<json.corp_type.length;i++){
    //         for(var j=0;j<response_json.corp_type.length;j++){
    //             if(json.corp_type[i] == response_json.corp_type[j] && i==index){
    //                 console.log(json.corp_type[i]+"已選");
    //                 document.getElementById("corp-type-option-"+(i+1)).selectedIndex = j;
    //                 break;
    //             }
    //         }
    //     }
    // });
    $("#corp-type-option-"+(index+1)).val(json.corp_type[index]);
}

function getBuildingUpdateData(script_number,legal_status,rId,page){
    $('div.loading').show();
    if(page<=1){
        if(legal_status == "建合"){
            document.getElementById("legal").checked = true;
        }
        else if(legal_status == "建非"){
            document.getElementById("illegal").checked = true;
        }
        $("#script-number").val(rId);

        getSurveyDate(script_number);
        getLandData(script_number);
        getOwnerData(script_number);
        getLandOwnerData(script_number);
        getBuildingData(script_number);
        getResidentData(script_number);
    }
    getMainBuildingData(script_number,page);
}

function getSurveyDate(script_number){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_survey_date',
            script_number: script_number,
            table: 'record'
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             $("#survey-date").val(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getLandData(script_number){
    var section_data = ["草漯段","塔腳段","新坡段","樹林子段"];
    var response_json = "";

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_land_data',
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             console.log(data.land_section);
             console.log(data.subsection);
             console.log(data.land_number);
             response_json = data;
             for(var i=0;i<data.land_section.length;i++){
                 var land_number_text = "";
                 if(i>0){
                     addInfoItemOnclick('building-land-section');
                 }

                 $("#section-"+(i+1)).val(data.land_section[i]);
                 if(data.subsection[i] != ""){
                     $("#sub_section-"+(i+1)).val(data.subsection[i]);
                 }
                 for(var j=0;j<data.land_number[i].length;j++){
                     land_number_text += data.land_number[i][j]
                     if(j != data.land_number[i].length-1){
                         land_number_text += "、";
                     }
                 }
                 $("#land-num-"+(i+1)).val(land_number_text);
                 console.log("loadCorpOwnerData() ",i+1);
                 loadCorpOwnerData('building',i+1);
             }
             $("#district").val(data.district[0]);
             $("#land-use").val(data.land_use[0]);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getOwnerData(script_number){
    $.when($.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_owner_data',
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             response_json = data;
             for(var i=0;i<data.name.length;i++){
                 if(i>0){
                     addInfoItemOnclick('owner');
                 }
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    })).then(function(){
        for(var i=0;i<response_json.name.length;i++){
            $("input[name='owner-"+(i+1)+"']").val(response_json.name[i]);
            $("#owner-select-"+(i+1)).val(response_json.name[i]);
            $("#hold-numerator-"+(i+1)).val(response_json.hold_numerator[i]);
            $("#hold-denominator-"+(i+1)).val(response_json.hold_denominator[i]);
            if(response_json.hold_status[0] == "公同共有"){
                $("#shared")[0].checked = true;
            }
            if(response_json.pId[i].substr(0,2) != "NA"){
                $("input[name='pId-"+(i+1)+"']").val(response_json.pId[i]);
            }
            $("input[name='telephone-"+(i+1)+"']").val(response_json.telephone[i]);
            $("input[name='cellphone-"+(i+1)+"']").val(response_json.cellphone[i]);
            $("#addressText-"+(i+1)).val(response_json.current_address[i]);
        }
    });
}

function getLandOwnerData(script_number){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_land_owner_data',
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             $("input[name='land-owner-1']").val(data.name[0]);
             $("#land-owner-select-1").val(data.name[0]);
             $("input[name='hold-id-1']").val(data.hold_id[0]);
             if(data.pId[0].substr(0,2) != "NA"){
                 $("input[name='land-pId-1']").val(data.pId[0]);
             }
             $("#landAddressText-1").val(data.current_address[0]);
             $("input[name='land-telephone-1']").val(data.telephone[0]);
             $("input[name='land-cellphone-1']").val(data.cellphone[0]);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getBuildingData(script_number){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_building_data',
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             $("#houseAddress").val(data.real_address[0]);
             if(data.real_address[0].indexOf("無門牌")>=0){
                 document.getElementById("noneAddress").checked = true;
             }
             $("input[name='remove_condition']").val(data.remove_condition);
             $("input[name='legal_certificate']").val(data.legal_certificate);
             if(data.build_number != ""){
                 $("#build-number").val(data.build_number);
             }
             $("input[name='build-certificate']").val(data.start_build_certificate);
             if(data.tax_number != ""){
                 $("#tax_number").val(data.tax_number);
             }
             $("#exit-num").val(data.exit_number);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getResidentData(script_number){
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_resident_data',
            script_number: script_number
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             for(var i=0;i<data.captain_name.length;i++){
                 if(i>0){
                     addInfoItemOnclick('captain');
                 }
                 $("input[name='captain-"+(i+1)+"']").val(data.captain_name[i]);
                 $("input[name='captain-id-"+(i+1)+"']").val(data.captain_id[i]);
                 $("input[name='household-number-"+(i+1)+"']").val(data.household_number[i]);
                 $("#household-date-"+(i+1)).val(data.set_household_date[i]);
                 $("select[name='family-num-"+(i+1)+"']").val(data.family_num[i]);
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getMainBuildingData(script_number,page){
    // $('div.loading').show();
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_main_building_data',
            script_number: script_number,
            page: page
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             for(var i=0;i<data.fId.length;i++){
                 var house_type = ["獨立戶","連棟式邊戶","連棟式中間戶"];
                 var house_usage = ["住宅","店鋪","工廠","庫房","其他"];
                 var id = ["house-type-","house-type-edge-","house-type-mid-"];
                 var usage_id = ["house-usage-","house-usage-store-","house-usage-fab-","house-usage-warehouse-","house-usage-other-"];
                 var isOtherUsage = true;
                 for(var j=0;j<house_type.length;j++){
                     if(house_type[j] == data.building_type[i]){
                         $("#"+id[j]+(i+1))[0].checked = true;
                     }
                 }
                 var floor_id = data.fId[i].split("-");
                 var fid = "";
                 for(var j=2;j<floor_id.length;j++){
                     fid += floor_id[j];
                     if(j != floor_id.length-1){
                         fid += "-";
                     }
                 }
                 // $("#floor-id-"+(i+1)).val(data.fId[i].substr(3,data.fId[i].length));
                 $("#floor-id-"+(i+1)).val(fid);
                 if(data.discard_status[i] == "yes"){
                     $("#discard-status-"+(i+1))[0].checked = true;
                 }
                 else{
                     $("#discard-status-no-"+(i+1))[0].checked = true;
                 }

                 if(data.compensate_form[i] == "主建物"){
                     $("#pay-form-"+(i+1))[0].checked = true;
                 }
                 else{
                     $("#pay-form-fix-"+(i+1))[0].checked = true;
                 }

                 for(var j=0;j<house_usage.length;j++){
                     if(house_usage[j] == data.use_type[i]){
                         isOtherUsage = false;
                         $("#"+usage_id[j]+(i+1))[0].checked = true;
                     }
                 }
                 if(isOtherUsage){
                     $("#"+usage_id[4]+(i+1))[0].checked = true;
                     $("#other-house-usage-"+(i+1)).val(data.use_type[i]);
                 }

                 $("#building-material-"+(i+1)).val(data.structure[i]);
                 console.log("構造: "+data.structure[i]);
                 load_floor_type_data(i+1);
                 $("#floor-type-"+(i+1)).val(data.floor_type[i]);
                 $("#nth-floor-"+(i+1)).val(data.nth_floor[i]);
                 $("#total-floor-"+(i+1)).val(data.total_floor[i]);
                 $("#floor-area-"+(i+1)).val(data.floor_area_calculate_text[i]);
                 $("input[name='layer-height-"+(i+1)+"']").val(data.layer_height[i]);
                 console.log("PAGE: "+((page-1)*4+(i+1)));
                 getDecorationData(script_number,"加減牆",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"室內隔牆構造",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"屋外牆粉裝",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"室內牆粉裝",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"屋頂(面)粉裝",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"樓地板粉裝",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"天花板粉裝",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"門窗裝置",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"給水、浴、廁設備",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"電氣設備(包括燈具)",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"其他項目門窗裝置加柵",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"女兒牆",((page-1)*4+(i+1)),page);
                 getDecorationData(script_number,"陽台",((page-1)*4+(i+1)),page);
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
    $('div.loading').hide();
}

function getDecorationData(script_number,category,f_order,page){
    console.log("T: "+category);
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_building_decoration_data',
            script_number: script_number,
            decoration_type: category,
            f_order: f_order,
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             switch (category) {
                 case "加減牆":
                    var minus_count = 0;
                    var add_count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        if(data.item_type[i] == "減牆"){
                            minus_count++;
                            console.log(data.item_type[i]);
                            console.log(data.item_name[i]);
                            console.log("order : "+((f_order-1)%4+1)+"-"+minus_count);
                            if(minus_count>1){
                                addItemOnclick('minus-wall-',((f_order-1)%4+1),minus_count-1);
                            }
                            $("#minus-wall-num-"+((f_order-1)%4+1)+"-"+minus_count).val(data.ratio[i]);
                            $("#minus-wall-option-"+((f_order-1)%4+1)+"-"+minus_count).val(data.item_name[i]);
                        }
                        else if(data.item_type[i] == "加牆"){
                            add_count++;
                            console.log(data.item_type[i]);
                            console.log(data.item_name[i]);
                            console.log("order : "+((f_order-1)%4+1)+"-"+add_count);
                            if(add_count>1){
                                addItemOnclick('add-wall-',((f_order-1)%4+1),add_count-1);
                            }
                            $("#add-wall-num-"+((f_order-1)%4+1)+"-"+add_count).val(data.ratio[i]);
                            $("#add-wall-option-"+((f_order-1)%4+1)+"-"+add_count).val(data.item_name[i]);
                        }
                    }
                    break;
                case "室內隔牆構造":
                    var count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        if(count>1){
                            addItemOnclick('indoor-divide-',((f_order-1)%4+1),count-1);
                        }
                        $("#indoor-divide-numerator-"+((f_order-1)%4+1)+"-"+count).val(data.numerator[i]);
                        $("#indoor-divide-denominator-"+((f_order-1)%4+1)+"-"+count).val(data.denominator[i]);
                        $("#indoor-divide-option-"+((f_order-1)%4+1)+"-"+count).val(data.item_name[i]);
                    }
                    break;
                case "屋外牆粉裝":
                    var count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        if(count>1){
                            addItemOnclick('outdoor-wall-decoration-',((f_order-1)%4+1),count-1);
                        }
                        $("#outdoor-wall-decoration-numerator-"+((f_order-1)%4+1)+"-"+count).val(data.numerator[i]);
                        $("#outdoor-wall-decoration-denominator-"+((f_order-1)%4+1)+"-"+count).val(data.denominator[i]);
                        $("#outdoor-wall-decoration-option-"+((f_order-1)%4+1)+"-"+count).val(data.item_name[i]);
                    }
                    break;
                case "室內牆粉裝":
                    var count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        if(count>1){
                            addItemOnclick('indoor-wall-decoration-',((f_order-1)%4+1),count-1);
                        }
                        $("#indoor-wall-decoration-numerator-"+((f_order-1)%4+1)+"-"+count).val(data.numerator[i]);
                        $("#indoor-wall-decoration-denominator-"+((f_order-1)%4+1)+"-"+count).val(data.denominator[i]);
                        $("#indoor-wall-decoration-option-"+((f_order-1)%4+1)+"-"+count).val(data.item_name[i]);
                        $("#indoor-wall-type-"+((f_order-1)%4+1)+"-"+count).val(data.item_type[i]);
                    }
                    break;
                case "屋頂(面)粉裝":
                    var count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        if(count>1){
                            addItemOnclick('roof-decoration-',((f_order-1)%4+1),count-1);
                        }
                        $("#roof-decoration-numerator-"+((f_order-1)%4+1)+"-"+count).val(data.numerator[i]);
                        $("#roof-decoration-denominator-"+((f_order-1)%4+1)+"-"+count).val(data.denominator[i]);
                        $("#roof-decoration-option-"+((f_order-1)%4+1)+"-"+count).val(data.item_name[i]);
                    }
                    break;
                case "樓地板粉裝":
                    var count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        if(count>1){
                            addItemOnclick('floor-decoration-',((f_order-1)%4+1),count-1);
                        }
                        $("#floor-decoration-numerator-"+((f_order-1)%4+1)+"-"+count).val(data.numerator[i]);
                        $("#floor-decoration-denominator-"+((f_order-1)%4+1)+"-"+count).val(data.denominator[i]);
                        $("#floor-decoration-option-"+((f_order-1)%4+1)+"-"+count).val(data.item_name[i]);
                    }
                    break;
                case "天花板粉裝":
                    var count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        if(count>1){
                            addItemOnclick('ceiling-decoration-',((f_order-1)%4+1),count-1);
                        }
                        $("#ceiling-decoration-numerator-"+((f_order-1)%4+1)+"-"+count).val(data.numerator[i]);
                        $("#ceiling-decoration-denominator-"+((f_order-1)%4+1)+"-"+count).val(data.denominator[i]);
                        $("#ceiling-decoration-option-"+((f_order-1)%4+1)+"-"+count).val(data.item_name[i]);
                    }
                    break;
                case "門窗裝置":
                    var index = 0;
                    var id = ["first-door-","first-window-","second-door-","second-window-"];
                    for(var i=0;i<data.item_name.length;i++){
                        console.log(data.item_name[i]);
                        while(data.ratio[i]>0 && index<4){
                            $("select[name='"+id[index]+((f_order-1)%4+1)+"']").val(data.item_name[i]);
                            data.ratio[i] -= 0.5;
                            index++;
                        }
                    }
                    break;
                case "給水、浴、廁設備":
                    var count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        if(count>1){
                            addItemOnclick('toilet-equipment-',((f_order-1)%4+1),count-1);
                        }
                        $("#toilet-ratio-"+((f_order-1)%4+1)+"-"+count).val(data.ratio[i]);
                        $("#toilet-type-"+((f_order-1)%4+1)+"-"+count).val(data.item_name[i]);
                        load_toilet_data(((f_order-1)%4+1),count);
                        $("#toilet-product-"+((f_order-1)%4+1)+"-"+count).val(data.item_type[i]);
                        $("#toilet-number-"+((f_order-1)%4+1)+"-"+count).val(data.area[i]);
                    }
                    break;
                case "電氣設備(包括燈具)":
                    var count = 0;
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        $("#electric-usage-"+((f_order-1)%4+1)).val(data.item_type[i]);
                        load_electric_data(((f_order-1)%4+1));
                        $("#electric-type-"+((f_order-1)%4+1)).val(data.item_name[i]);
                    }
                    break;
                case "其他項目門窗裝置加柵":
                    var count = 0;
                    var window_level = ["普通型","美術型","豪華型"];
                    var id = ["normal-window-level","art-window-level","luxury-window-level"];
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        for(var j=0;j<window_level.length;j++){
                            if(window_level[j] == data.item_name[i]){
                                $("#"+id[j]+"-"+((f_order-1)%4+1))[0].checked = true;
                                setWindowLevel(id[j],((f_order-1)%4+1));
                            }
                        }
                    }
                    break;
                case "女兒牆":
                    var count = 0;
                    var type = ["前","後","左","右"];
                    var type2 = ["front","behind","left","right"];

                    var daughter_wall = ["RC","1B","1/2B"];
                    var id = ["RC","1B","half_B"];
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        for(var j=0;j<type.length;j++){
                            if(type[j] == data.item_type[i]){
                                for(var k=0;k<daughter_wall.length;k++){
                                    if(daughter_wall[k] == data.item_name[i]){
                                        $("#"+id[k]+"-"+type2[j]+"-"+((f_order-1)%4+1))[0].checked = true;
                                        setDaughterWall(id[k]+"-"+type2[j],(f_order-1)%4+1,type2[j]);
                                    }
                                }
                            }
                        }
                    }
                    break;
                case "陽台":
                    var count = 0;
                    var balcony = ["前","後","左","右"];
                    var id = ["front-balcony","behind-balcony","left-balcony","right-balcony"];
                    for(var i=0;i<data.item_name.length;i++){
                        count++;
                        // console.log(data.item_type[i]);
                        console.log(data.item_name[i]);
                        console.log("order : "+((f_order-1)%4+1)+"-"+count);
                        for(var j=0;j<balcony.length;j++){
                            if(balcony[j] == data.item_type[i]){
                                $("#"+id[j]+"-"+((f_order-1)%4+1))[0].checked = true;
                            }
                        }
                    }
                    break;
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

function getSubBuildingUpdateData(address){
    $('div.loading').show();
    script_number = address;
    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'get_subbuilding_data',
            address: address
         },
         cache:false,
         dataType: "json",
         async:false,
         success: function(data){
             for(var i=0;i<data.item_name.length;i++){
                 console.log(data.item_name[i]);
                 console.log(data.auto_remove[i]);
                 if(data.application[i] != "圍牆"){
                    if(i>0){
                        addInfoItemOnclick('other-item');
                    }
                    getSubbuildingCategory(i+1);
                    this.onclick=null;
                    $("#other-item-category-"+(i+1)).val(data.application[i]);
                    getSubbuildingOption(i+1);
                    $("#other-item-option-"+(i+1)).val(data.item_name[i]);
                    loadSubbuildingUnit(i+1);
                    $("#other-item-type-"+(i+1)).val(data.item_type[i]);
                    $("input[name='calArea-"+(i+1)+"']").val(data.area_calculate_text[i]);
                    $("#unit-option-"+(i+1)).val(data.unit[i]);
                    if(data.auto_remove[i] == "是"){
                        $("#auto-remove-yes-"+(i+1))[0].checked = true;
                    }
                    else{
                        $("#auto-remove-no-"+(i+1))[0].checked = true;
                    }
                 }
                 else if(data.application[i] == "圍牆"){
                    if(i>0){
                        addInfoItemOnclick('fence');
                    }
                    // getSubbuildingCategory(i+1);
                    // this.onclick=null;
                    $("#other-item-category-"+(i+1)).val(data.application[i]);
                    getSubbuildingOption(i+1);
                    $("#other-item-option-"+(i+1)).val(data.item_name[i]);
                    loadSubbuildingUnit(i+1);
                    getFenceData(i+1,address,data.sId[i]);
                    $("#other-item-type-"+(i+1)).val(data.item_type[i]);
                    $("input[name='calArea-"+(i+1)+"']").val(data.area_calculate_text[i]);
                    $("#unit-option-"+(i+1)).val(data.unit[i]);
                    if(data.auto_remove[i] == "是"){
                        $("#auto-remove-yes-"+(i+1))[0].checked = true;
                    }
                    else{
                        $("#auto-remove-no-"+(i+1))[0].checked = true;
                    }
                 }
             }
             $('div.loading').hide();
         },
         error:function(err){
             $('div.loading').hide();
             window.alert(err.statusText);
         }
    });
}

function getFenceData(num,address,sId){
    $.ajax({
        url: "get_building_decoration_option.php",
        type: "POST",
        data:{
           category: 'get_fence_data',
           address: address,
           sId: sId
        },
        cache:false,
        dataType: "json",
        async:false,
        success: function(data){
            getFenceOption(num,'粉刷');
            this.onclick=null;
            getFenceOption(num,'加強柱');
            this.onclick=null;

            for(var i=0;i<data.fence_application.length;i++){
                if(data.fence_application[i] == "粉刷"){
                    console.log("設定粉刷 "+num);
                    $("#fence-paint-"+num).val(data.fence_item[i]);
                }
                else if(data.fence_application[i] == "加強柱"){
                    console.log("設定加強柱 "+num);
                    $("#fence-pillar-"+num).val(data.fence_item[i]);
                }
            }
            console.log(data);
        },
        error:function(err){
            window.alert(err.statusText);
        }
   });
}

function loadAutoRemove(num){
    console.log("loadAutoRemove");
    var application = $("#other-item-category-"+num).val();
    var item_name = $("#other-item-option-"+num).val();
    
    $.ajax({
        url: "get_building_decoration_option.php",
        type: "POST",
        data:{
           category: 'get_auto_remove',
           application: application,
           item_name: item_name
        },
        cache:false,
        dataType: "json",
        async:false,
        success: function(data){
            if(data.item_name == "是"){
                $("#auto-remove-yes-"+num)[0].checked = true;
            }
            else if(data.item_name == "否"){
                $("#auto-remove-no-"+num)[0].checked = true;
            }
        },
        error:function(err){
            window.alert(err.statusText);
        }
   });
}

function addCorpItem(){
    var corp_category_html = addInfoItemOnclick('corp-category');
    var corp_item_html = addInfoItemOnclick('corp-item');
    var corp_type_html = addInfoItemOnclick('corp-type');
    var corp_num_html = addInfoItemOnclick('corp-num');
    var corp_unit_html = addInfoItemOnclick('corp-unit');
    var corp_area_html = addInfoItemOnclick('corp-area');
    var corp_equal_html = addInfoItemOnclick('corp-equal');
    var corp_note_html = addInfoItemOnclick('corp-note');
    $("#corp-category").append(corp_category_html);
    $("#corp-item").append(corp_item_html);
    $("#corp-type").append(corp_type_html);
    $("#corp-num").append(corp_num_html);
    $("#corp-unit").append(corp_unit_html);
    $("#corp-area").append(corp_area_html);
    $("#corp-equal").append(corp_equal_html);
    $("#corp-note").append(corp_note_html);
    load_corp_category_Data(corp_count);
}

function preLoadCorpItemData(){
    $.ajax({
        url: "get_building_decoration_option.php",
        type: "POST",
        data:{
           category: 'pre_load_corp_item'
        },
        cache:false,
        dataType: "json",
        async:false,
        success: function(data){
            corp_item_data = data;
            console.log(corp_item_data);
        },
        error:function(err){
            window.alert(err.statusText);
        }
   });
}

function preLoadCorpTypeData(){
    $.ajax({
        url: "get_building_decoration_option.php",
        type: "POST",
        data:{
           category: 'pre_load_corp_type'
        },
        cache:false,
        dataType: "json",
        async:false,
        success: function(data){
            corp_type_data = data;
            console.log(data);
        },
        error:function(err){
            window.alert(err.statusText);
        }
   });
}

function itemFocus(num){
    // document.querySelectorAll("input[id*='corp-item-']").blur();
    $("#corp-category-"+num).css("background-color", "#ADADAD");
    $("#corp-item-"+num).css("background-color", "#ADADAD");
    $("#corp-type-"+num).css("background-color", "#ADADAD");
    $("#corp-num-"+num).css("background-color", "#ADADAD");
    $("#corp-unit-"+num).css("background-color", "#ADADAD");
    $("#corp-area-"+num).css("background-color", "#ADADAD");
    $("#corp-equal-"+num).css("background-color", "#ADADAD");
    $("#corp-note-"+num).css("background-color", "#ADADAD");
}

function itemOutFocus(num){
    // document.querySelectorAll("input[id*='corp-item-']").blur();
    $("#corp-category-"+num).css("background-color", "");
    $("#corp-item-"+num).css("background-color", "");
    $("#corp-type-"+num).css("background-color", "");
    $("#corp-num-"+num).css("background-color", "");
    $("#corp-unit-"+num).css("background-color", "");
    $("#corp-area-"+num).css("background-color", "");
    $("#corp-equal-"+num).css("background-color", "");
    $("#corp-note-"+num).css("background-color", "");
}

function shareRatio(){
    let isChecked = document.getElementById("shared").checked;
    let numerator = [];
    let denominator = [];

    if(isChecked){
        numerator = $("input[id*='hold-numerator-']");
        denominator = $("input[id*='hold-denominator-']");
        for(let i=0;i<numerator.length;i++){
            numerator[i].value = "1";
            denominator[i].value = "1";
        }
    }
}

$(document).ready(function(){
    $('div.loading').hide();
    getOwnerCount();
    getLandOwnerCount();
    getCaptainCount();
    getLandSectionCount();
    getOtherItemCount();
    getCorpCount();
    for(var i=0;i<4;i++){
        getMinusWallCount(i);
        getAddWallCount(i);
        getIndoorDivideCount(i);
        getOutdoorWallDecorationCount(i);
        getIndoorWallDecorationCount(i);
        getRoofDecorationCount(i);
        getFloorDecorationCount(i);
        getCeilingDecorationCount(i);
        getToiletEquipmentCount(i);
    }
    nth_OwnerNameList.push(new Array([]));
});

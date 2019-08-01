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
var auto_remove_count = 1;
var captain_count = 1;
var captain_id_count = 1;
var household_number_count = 1;
var set_household_date_count = 1;
var family_num_count = 1;
var independent_count = 0;

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
                    '<option value="" style="display:none;">請選擇面數</option>'+
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
                    '<option value="" style="display:none;">請選擇面數</option>'+
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
            '<input type="text" id="indoor-divide-numerator-'+column+"-"+indoor_divide_count[column-1]+'" name="indoor-divide-numerator-'+column+"-"+indoor_divide_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/<input type="text" id="indoor-divide-denominator-'+column+"-"+indoor_divide_count[column-1]+'" name="indoor-divide-denominator-'+column+"-"+indoor_divide_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
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
                '<input type="text" id="outdoor-wall-decoration-numerator-'+column+"-"+outdoor_wall_decoration_count[column-1]+'" name="outdoor-wall-decoration-numerator-'+column+"-"+outdoor_wall_decoration_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/'+
                '<input type="text" id="outdoor-wall-decoration-denominator-'+column+"-"+outdoor_wall_decoration_count[column-1]+'" name="outdoor-wall-decoration-denominator-'+column+"-"+outdoor_wall_decoration_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
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
            '<div id="indoor-wall-decoration-'+column+"-"+ indoor_wall_decoration_count[column-1]+'">'+
                '<input type="text" id="indoor-wall-decoration-numerator-'+column+"-"+indoor_wall_decoration_count[column-1]+'" name="indoor-wall-decoration-numerator-'+column+"-"+indoor_wall_decoration_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/'+
                '<input type="text" id="indoor-wall-decoration-denominator-'+column+"-"+indoor_wall_decoration_count[column-1]+'" name="indoor-wall-decoration-denominator-'+column+"-"+indoor_wall_decoration_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
                '&nbsp;<select id="indoor-wall-decoration-option-'+column+"-"+ indoor_wall_decoration_count[column-1] +'" name="indoor-wall-decoration-option-'+column+"-"+ indoor_wall_decoration_count[column-1] +'" class="tiny-select-menu" required>'+
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
                '<input type="text" id="roof-decoration-numerator-'+column+"-"+ roof_decoration_count[column-1]+'" name="roof-decoration-numerator-'+column+"-"+ roof_decoration_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/'+
                '<input type="text" id="roof-decoration-denominator-'+column+"-"+ roof_decoration_count[column-1]+'" name="roof-decoration-denominator-'+column+"-"+ roof_decoration_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
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
                '<input type="text" id="floor-decoration-numerator-'+column+"-"+ floor_decoration_count[column-1]+'" name="floor-decoration-numerator-'+column+"-"+ floor_decoration_count[column-1]+'" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/'+
                '<input type="text" id="floor-decoration-denominator-'+column+"-"+ floor_decoration_count[column-1]+'" name="floor-decoration-denominator-'+column+"-"+ floor_decoration_count[column-1]+'" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
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
                '<input type="text" id="ceiling-decoration-numerator-'+column+"-"+ ceiling_decoration_count[column-1] +'" name="ceiling-decoration-numerator-'+column+"-"+ ceiling_decoration_count[column-1] +'" class="tiny-input-size" placeholder="輸入" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">/'+
                '<input type="text" id="ceiling-decoration-denominator-'+column+"-"+ ceiling_decoration_count[column-1] +'" name="ceiling-decoration-denominator-'+column+"-"+ ceiling_decoration_count[column-1] +'" class="tiny-input-size" placeholder="比例" pattern="[1-9]{1,5}" title="請輸入比例數字(不可為0)">'+
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
        case 'land-section':
            land_section_count += 1;

            addInfoItemOnclick('subsection');
            addInfoItemOnclick('land-number');
            text =
            '<div id="land-section-'+land_section_count+'">'+
            // '<input type="text" name="land-section-'+land_section_count+'" value="" required><br>'+
            '<input type="text" id="section-'+land_section_count+'" name="land-section-'+land_section_count+'" list="land-section-list-'+land_section_count+'" autocomplete="off" oninput="getLandSectionOption('+land_section_count+')" required><br>'+
            '<datalist id="land-section-list-'+land_section_count+'"></datalist>'+
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

            text =
            '<div id="land-number-'+land_number_count+'">'+
                '<input type="text" id="land-num-'+land_number_count+'" name="land-number-'+land_number_count+'" placeholder="多個地號請用\'、\'分隔" onchange="isLandNumExist('+land_number_count+')" required><br>'+
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
            getOwnerCount();
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
                '<input type="text" name="land-owner-'+land_owner_count+'" placeholder="所有權人-'+land_owner_count+'" required><br>'+
            '</div>';
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
                '<input type="text" name="corp-owner-'+owner_count+'" placeholder="所有權人-'+owner_count+'" required><br>'+
            '</div>';
            getOwnerCount();
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
                '<input type="text" name="land-pId-'+land_pId_count+'" value="" placeholder="所有權人-'+land_pId_count+'" required>'+
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
            addInfoItemOnclick('auto-remove');
            text =
            '<div id="other-item-'+other_item_count+'">'+
                '<select class="small-select-menu" id="other-item-category-'+other_item_count+'" name="other-item-category-'+other_item_count+'" onclick="getSubbuildingCategory('+other_item_count+');this.onclick=null;" onchange="getSubbuildingOption('+other_item_count+')" required>'+
                    '<option value="" style="display:none;">請選擇種類</option>'+
                '</select>&nbsp;'+

                '<select class="select-menu" id="other-item-option-'+other_item_count+'" name="other-item-'+other_item_count+'" required>'+
                    '<option value="" style="display:none;">請選擇項目</option>'+
                '</select>&nbsp;'+

                '<select class="small-select-menu" name="other-item-type-'+other_item_count+'" required>'+
                    '<option value="" style="display:none;">請選擇室內外</option>'+
                    '<option value="室內">室內</option>'+
                    '<option value="室外">室外</option>'+
                '</select>'+
            '</div>';
            getOtherItemCount();
            break;

        case 'calArea':
            calArea_count += 1;

            text =
            '<div id="calArea-'+calArea_count+'">'+
                '<input type="text" name="calArea-'+calArea_count+'" class="larger-input-size" placeholder="請輸入面積計算式或數量" title="請輸入面積計算式或數量" required>'+
            '</div>';
            break;

        case 'auto-remove':
            auto_remove_count += 1;

            text =
            '<div id="auto-remove-'+auto_remove_count+'">'+
                '<input type="radio" name="auto-remove-'+auto_remove_count+'" value="是">是<input type="radio" name="auto-remove-'+auto_remove_count+'" value="否" required>否'+
            '</div>';
            break;

        case 'captain':
            captain_count += 1;

            addInfoItemOnclick('captain-id');
            addInfoItemOnclick('household-number');
            addInfoItemOnclick('set-household-date');
            addInfoItemOnclick('family-num');
            text =
            '<div id="captain-'+captain_count+'">'+
                '<input type="text" name="captain-'+captain_count+'" required>&nbsp;'+
                '<input type="checkbox" id="cohabit-'+captain_count+'" name="cohabit-'+captain_count+'">共同生活戶'+
            '</div>';
            getCaptainCount();
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
                '<input type="date" name="set-household-date-'+set_household_date_count+'" required>'+
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
    }
    if(!isAppend){
        $(itemId).append(text);
    }
}

function removeInfoItemOnclick(id){
    switch (id) {
        case 'land-section':
            removeInfoItemOnclick('subsection');
            removeInfoItemOnclick('land-number');
            land_section_count = removeItem(id, land_section_count);
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
            removeInfoItemOnclick('auto-remove');
            other_item_count = removeItem(id, other_item_count);
            getOtherItemCount();
            break;
        case 'calArea':
            calArea_count = removeItem(id, calArea_count);
            break;
        case 'auto-remove':
            auto_remove_count = removeItem(id, auto_remove_count);
            break;
        case 'captain':
            removeInfoItemOnclick('captain-id');
            removeInfoItemOnclick('household-number');
            removeInfoItemOnclick('set-household-date');
            removeInfoItemOnclick('family-num');
            captain_count = removeItem(id, captain_count);
            getCaptainCount();
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

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'electric_type',
            item_type: item_type
         },
         cache:false,
         dataType: "json",
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

function load_floor_type_data(num){
    var item = "#floor-type-"+num;
    var material = $("#building-material-"+num).val();
    var building_type_radio = $("input[name='house-type-"+num+"']");

    for(var i=0;i<building_type_radio.length;i++){
        if(building_type_radio[i].checked) {building_type = building_type_radio[i].value;}
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
         dataType: "json",
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             $(item).html(data.item_name);
         },
         error:function(err){
             // window.alert(err.statusText);
             window.alert("戶別選擇錯誤!請重新選擇!");
             $(item).html('<option value="" style="display:none;">請選擇層別</option>');
             document.getElementById("building-material-"+num).selectedIndex = "0";
         }
    });
}

function load_toilet_data(column,nth){
    var item = "#toilet-type-"+column+"-"+nth;
    var item_name = $(item).val();

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'toilet_type',
            item_name: item_name
         },
         cache:false,
         dataType: "json",
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

function saveDialog(){
    // text =
    // '<h1>雜項設施</h1>'+
    // '<table border="1">'+
    //     '<tr>'+
    //         '<td>項目</td>'+
    //         '<td>面積</td>'+
    //         '<td>是否自拆</td>'+
    //     '</tr>'+
    //
    //     '<tr>'+
    //         '<td>'+
    //             '<div id="other-item" class="input-align-top">'+
    //                 '<div id="other-item-1">'+
    //                     '<select class="select-menu" name="other-item-1">'+
    //                         '<option value="" style="display:none;">請選擇項目</option>'+
    //                         '<option value="">電柱(RC造)遷移費</option>'+
    //                         '<option value="">窗型冷氣遷移費</option>'+
    //                     '</select>'+
    //                 '</div>'+
    //             '</div>'+
    //             '<button type="button" onclick="addInfoItemOnclick("other-item")">+</button>'+
    //             '<button type="button" onclick="removeInfoItemOnclick("other-item")">-</button>'+
    //         '</td>'+
    //         '<td>'+
    //             '<div id="calArea">'+
    //                 '<div id="calArea-1">'+
    //                     '<input type="text" name="calArea-1" class="larger-input-size" placeholder="請輸入面積計算式" title="請輸入面積計算式">'+
    //                 '</div>'+
    //             '</div>'+
    //         '</td>'+
    //         '<td>'+
    //             '<div id="auto-remove">'+
    //                 '<div id="auto-remove-1">'+
    //                     '<input type="radio" name="auto-remove-1">是<input type="radio" name="auto-remove-1">否'+
    //                 '</div>'+
    //             '</div>'+
    //         '</td>'+
    //     '</tr>'+
    // '</table>';
    // text =
    // '<h1>雜項設施</h1>'+
    // '<table border="1">'+
    //     '<tr>'+
    //         '<td>項目</td>'+
    //         '<td>面積</td>'+
    //         '<td>是否自拆</td>'+
    //     '</tr>'+
    //
    //     '<tr>'+
    //         '<td>'+
    //             '<div id="other-item" class="input-align-top">'+
    //                 '<div id="other-item-1">'+
    //                     '<select class="select-menu" name="other-item-1">'+
    //                         '<option value="" style="display:none;">請選擇項目</option>'+
    //                         '<option value="">電柱(RC造)遷移費</option>'+
    //                         '<option value="">窗型冷氣遷移費</option>'+
    //                     '</select>'+
    //
    //                     '<select class="small-select-menu" name="other-item-type-1">'+
    //                         '<option value="" style="display:none;">請選擇室內外</option>'+
    //                         '<option value="室內">室內</option>'+
    //                         '<option value="室外">室外</option>'+
    //                     '</select>'+
    //                 '</div>'+
    //             '</div>'+
    //             '<button type="button" onclick="addInfoItemOnclick("other-item")">+</button>'+
    //             '<button type="button" onclick="removeInfoItemOnclick("other-item")">-</button>'+
    //         '</td>'+
    //         '<td>'+
    //             '<div id="calArea">'+
    //                 '<div id="calArea-1">'+
    //                     '<input type="text" name="calArea-1" class="larger-input-size" placeholder="請輸入面積計算式" title="請輸入面積計算式">'+
    //                 '</div>'+
    //             '</div>'+
    //         '</td>'+
    //         '<td>'+
    //             '<div id="auto-remove">'+
    //                 '<div id="auto-remove-1">'+
    //                     '<input type="radio" name="auto-remove-1">是<input type="radio" name="auto-remove-1">否'+
    //                 '</div>'+
    //             '</div>'+
    //         '</td>'+
    //     '</tr>'+
    // '</table>';

    var isContinue = window.confirm("是否繼續輸入雜項設施?");
    if(isContinue==true){
        // $("#house_form").attr("action","sub_building.php");
        // $("#sub-building").append(text);
        $("#action").val("sub_building");
        // window.alert($("#action").val());
        // window.alert($("#section-1").val());
    }
    else{
        $("#action").val("submit");
        // window.alert($("#action").val());
    }

    value_array = [];
    for(var i=0;i<captain_count;i++){
        if($("#exit-num").val()==1 && captain_count>1){
            $("#cohabit-"+(i+1)).val("yes");
        }
        else{
            if(document.getElementById("cohabit-"+(i+1)).checked){
                $("#cohabit-"+(i+1)).val("yes");
            }
            else{
                $("#cohabit-"+(i+1)).val("no");
            }
        }
        value_array[i] = $("#cohabit-"+(i+1)).val();
    }
    $("#cohabit-judge").val(value_array);

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
}

function writeDataToOneRow(itemId,writeToId,countId){
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

function changeColumnStatus(column,status){
    var itemId = ["#house-type-","#discard-status-","#pay-form-","#building-material-","#floor-type-","#nth-floor-","#total-floor-","#floor-area-","#house-usage-"]

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
    $("#msg").html("<h1>Excel報表正在匯出中...<br>請勿關閉視窗...</h1>");
    $.post("export_excel.php", {'script_number':script_number, 'house_address':house_address},
    function(){
        window.alert("Excel匯出成功!");
    }).done(function() {
        alert("請點擊繼續!");
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

function continueInput(){
    $("#action").val("continue");
    // window.alert($("#action").val());
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

function isLandNumExist(num){
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
             // contentType: 'application/json; charset=utf-8',
             success: function(data){
                 if(data.item_name==false){
                     window.alert("輸入地號在資料庫中查無!\n請重新輸入!");
                     $(item).val("");
                 }
                 else{
                     // window.alert(data.item_name);
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

    $.ajax({
         url: "get_building_decoration_option.php",
         type: "POST",
         data:{
            category: 'sub_building_item',
            application: application
         },
         cache:false,
         dataType: "json",
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             $(item).html(data.item_name);
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
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
    var name = "input[name='owner-"+num+"']";
    var hold_id = "#hold-id-"+num;
    // window.alert($(name).val());
    // window.alert($(hold_id).val());

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
         // contentType: 'application/json; charset=utf-8',
         success: function(data){
             if(data.item_name==false){
                 window.alert("查無此人或輸入錯誤!\n請重新輸入!");
                 $(name).val("");
                 $(hold_id).val("");
             }
             else{
                 // window.alert(data.item_name);
                 $("#addressText-"+num).val(data.item_name);
             }
         },
         error:function(err){
             window.alert(err.statusText);
         }
    });
}

$(document).ready(function(){
    getOwnerCount();
    getLandOwnerCount();
    getCaptainCount();
    getLandSectionCount();
    getOtherItemCount();
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
});

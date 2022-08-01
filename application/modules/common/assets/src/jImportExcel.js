//------------------------------------------------------------------------------ Import File ------------------------------------------------------------------------------//

//หน้าจอ pop-up
function JSxImportPopUp(poPackdata){

    //ล้างค่า สรุปว่าสามารถนำเข้าได้กี่อัน
    $('#ospTextSummaryImport').text('');
    $('#oahDowloadModifiTemplate').hide();
    $('#obtIMPCheckTemp').hide();

    var tNameModule     = poPackdata.tNameModule.toLowerCase();
    var tTypeModule     = poPackdata.tTypeModule.toLowerCase();
    var tAfterRoute     = poPackdata.tAfterRoute;
    var tFlagClearTmp   = poPackdata.tFlagClearTmp;
    var tDocumentNo     = poPackdata.tDocumentNo;
    var tFrmBchCode     = poPackdata.tFrmBchCode;
    var nSplVatRate     = poPackdata.nSplVatRate;
    var tSplVatCode     = poPackdata.tSplVatCode;
    //tFlagClearTmp = null : ไม่ระบุ
    //tFlagClearTmp = 1 : ล้างค่าทั้งหมด
    //tFlagClearTmp = 2 : ต่อเนื่อง

    //เซตค่า สำหรับ import 
    $('#ohdImportNameModule').val(tNameModule);
    $('#ohdImportAfterRoute').val(tAfterRoute);
    $('#ohdImportTypeModule').val(tTypeModule);
    $('#ohdImportClearTempOrInsCon').val(tFlagClearTmp);
    $('#ohdImportDocumentNo').val(tDocumentNo);
    $('#ohdImportFrmBchCode').val(tFrmBchCode);
    $('#ohdImportSplVatRate').val(nSplVatRate);
    $('#ohdImportSplVatCode').val(tSplVatCode);
    //สั้งให้ pop-up โชว์
    $('#odvModalImportFile').modal('show');
    $('#obtIMPConfirm').hide();

    //ขนาดความกว้างของ pop-up
    if(tTypeModule == 'master'){
        //ถ้าเป็น Type : master
        $('#odvModalImportFile .modal-dialog').css({
            'width' : '80%', 
            'top'   : '5%'
        });
    }else{
        //ถ้าเป็น Type : document
        $('#odvModalImportFile .modal-dialog').css({
            'width' : '800px', 
            'top'   : '20%'
        });
    }

    // Create By : Napat(Jame) 2021/06/15
    // แก้ปัญหาโหลด template แคชไฟล์
    var dDate           = new Date();
    var nDay            = dDate.getDate();
    var nMonth          = dDate.getMonth();
    var nYear           = dDate.getFullYear();
    var nTime           = dDate.getTime();
    var tFormatVersion  = nYear.toString() + nMonth.toString() + nDay.toString() + nTime.toString();

    //ดาวน์โหลดแม่แบบ
    switch (tNameModule){
        case 'branch':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/Branch_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'adjprice':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/AdjustPrice_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'user':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/User_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'product':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/Product_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'pos':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/Pos_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'purchaseorder':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/Purcaseorder_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'purchaseinvoice':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/PurcaseInvoice_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'adjcost':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/AdjustCost_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'adjstock':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/AdjustStock_Template.xlsx?v=' + tFormatVersion;
        break;
        case 'printbarcode':
            var tPathTemplate = $('#ohdBaseUrlUseInJS').val() + 'application/modules/common/assets/template/PrintPriceTags_Template.xlsx?v=1.0.0';
        break;
    }
    $('#odvModalImportFile #oahDowloadTemplate').attr("href",tPathTemplate);

    // Clear ค่า
    var bIsMasterType = $('#ohdImportTypeModule').val() == "master";
    if(bIsMasterType){
        $("#odvModalImportFile .modal-body").css("min-height", "70vh");
        $('#odvContentRenderHTMLImport').html('<div class="xCNImportBefore"><label>'+$('#ohdImportExcel').val()+'</label></div>');
    }else{
        $("#odvModalImportFile .modal-body").removeAttr("style");
        $('#odvContentRenderHTMLImport').html('<div style="text-align: center; margin-top: 50px; margin-bottom: 50px;"><label>'+$('#ohdImportExcel').val()+'</label></div>');
    }
    $('#oetFileNameImport').val('');
    $('#oefFileImportExcel').val('');
}

//Import File
function JSxCheckFileImportFile(poElement, poEvent) {
    try {
        var oFile = $(poElement)[0].files[0];
        if(oFile == undefined){
            $("#oetFileNameImport").val("");
        }else{
            $("#oetFileNameImport").val(oFile.name);
        }
        
    } catch (err) {
        console.log("JSxPromotionStep1SetImportFile Error: ", err);
    }
}

//กดปุ่มยืนยัน
function JSxImportFileExcel(){
    $('#ospTextSummaryImport').text('');

    var tNameFile = $("#oetFileNameImport").val();
    if(tNameFile == '' || tNameFile == null){
        //ไม่พบไฟล์
    }else{
        var bIsMasterType = $('#ohdImportTypeModule').val() == "master";
        if(bIsMasterType){
            JCNxOpenLoading();
            $('#odvContentRenderHTMLImport').html('<div class="xCNImportBefore"><label>กำลังนำเข้าไฟล์...</label></div>');
        }else{
            $('#odvContentRenderHTMLImport').html('<div style="text-align: center; margin-top: 50px; margin-bottom: 50px;"><label>กำลังนำเข้าไฟล์...</label></div>');
        }
        setTimeout(function(){
            JSxWirteImportFile();
        }, 50);
    }
}

function JSxWirteImportFile(evt) {
    var f = $('#oefFileImportExcel')[0].files[0];

    if (f) {
        var r = new FileReader();
        r.onload = e => {
            var contents 	= processExcel(e.target.result);
            var aJSON 		= JSON.parse(contents);
            var tNameModule = $('#ohdImportNameModule').val().toLowerCase();
            switch (tNameModule){
                case 'branch':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if(typeof(aJSON['Branch']) == 'undefined'){
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        JSxFileFailFormat();
                        return;
                    }

                    var aJSONData           = aJSON["Branch"];
                    var nCount              = aJSONData.length;
                    var aNewPackData        = [];
                    var aError              = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount; k++){
                        if(aJSONData[k].length > 0){
                            aNewPackData.push(aJSONData[k]);
                        }
                    }
                    var nCount              = aNewPackData.length;
                    var aJSONData           = aNewPackData;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){

                        //Template_Filed_สาขา
                        if(typeof(aJSONData[j][0]) != 'undefined' || null){
                            if(aJSONData[j][0] == null){
                                aJSONData[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสสาขาไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][0].toString().length > 5){
                                    var tValueOld   = aJSONData[j][0];
                                    aJSONData[j][0] = aJSONData[j][0].toString().substring(0, 5);
                                    aError.push('4','[0]'+'$&รหัสสาขายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสสาขาไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อสาขา
                        if(typeof(aJSONData[j][1]) != 'undefined' || null){
                            if(aJSONData[j][1] == null){
                                aJSONData[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อสาขาไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][1].length > 100){
                                    var tValueOld   = aJSONData[j][1];
                                    aJSONData[j][1] = aJSONData[j][1].substring(0, 100);
                                    aError.push('4','[1]'+'$&ชื่อสาขาเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อสาขาไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_รหัส agency
                        if(typeof(aJSONData[j][2]) != 'undefined' || null){
                            if(aJSONData[j][2] == null){
                                // aJSONData[j][2] = 'N/A';
                                // aError.push('7','[2]'+'$&รหัสตัวแทนขายไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][2].length > 10){
                                    var tValueOld   = aJSONData[j][2];
                                    aJSONData[j][2] = aJSONData[j][2].substring(0, 10);
                                    aError.push('4','[2]'+'$&รหัสตัวแทนขายยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            // aJSONData[j][2] = 'N/A';
                            // aError.push('7','[2]'+'$&รหัสตัวแทนขายไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_รหัส price group
                        if(typeof(aJSONData[j][3]) != 'undefined' || null){
                            if(aJSONData[j][3] == null){
                                aJSONData[j][3] = '';
                            }else{
                                if(aJSONData[j][3].length > 5){
                                    var tValueOld   = aJSONData[j][3];
                                    aJSONData[j][3] = aJSONData[j][3].substring(0, 5);
                                    aError.push('4','[3]'+'$&รหัสกลุ่มราคายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][3] = '';
                        }   

                        if(aError.length > 0){
                            aJSONData[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData[j].push('1','');
                        }
                        ///////////////////////////////////////////// DATATYPE
                    }
                break;
                case 'adjprice':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if(typeof(aJSON['Adjust Price']) == 'undefined'){
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        return;
                    }

                    var aJSONData           = aJSON["Adjust Price"];
                    var nCount              = aJSONData.length;
                    var aNewPackData        = [];
                    var aError              = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount; k++){
                        if(aJSONData[k].length > 0){
                            aNewPackData.push(aJSONData[k]);
                        }
                    }
                    var nCount              = aNewPackData.length;
                    var aJSONData           = aNewPackData;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_ราคา
                        if(typeof(aJSONData[j][2]) != 'undefined' || null){
                            if(aJSONData[j][2] == null){
                                aJSONData[j][2] = '0';
                            }else{
                                var Letters = /^[ก-๛A-Za-z]+$/;
                                var nValue = aJSONData[j][2].toString();
                                var nValue = nValue.replace(" ", "");
                                if(nValue.match(Letters)){
                                    //เอาตัวที่ผิดออก
                                    var tValueOld  = aJSONData[j][2];
                                    aJSONData[j].pop();
                                    aJSONData[j].push(0);
                                    aError.push('3','[2]'+'$&รูปแบบราคาผิด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][2] = '0';
                        }

                        //Template_Filed_รหัสสินค้า
                        if(typeof(aJSONData[j][0]) != 'undefined' || null){
                            if(aJSONData[j][0] == null){
                                aJSONData[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][0].length > 20){
                                    var tValueOld   = aJSONData[j][0];
                                    aJSONData[j][0] = aJSONData[j][0].substring(0, 20);
                                    aError.push('4','[0]'+'$&รหัสสินค้ายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][0] = 'N/A';
                            aError.push('4','[0]'+'$&รหัสสินค้ายาวเกินกำหนด$&'+tValueOld);
                        }

                        //Template_Filed_หน่วยสินค้า
                        if(typeof(aJSONData[j][1]) != 'undefined' || null){
                            if(aJSONData[j][1] == null){
                                aJSONData[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&รหัสหน่วยสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][1].length > 5){
                                    var tValueOld   = aJSONData[j][1];
                                    aJSONData[j][1] = aJSONData[j][1].substring(0, 5);
                                    aError.push('4','[1]'+'$&รหัสหน่วยสินค้ายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][1] = '00000';
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData[j].push('1','');
                        }
                        ///////////////////////////////////////////// DATATYPE
                    }
                break;
                case 'user':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if(typeof(aJSON['User']) == 'undefined'){
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        JSxFileFailFormat();
                        return;
                    }

                    var aJSONData           = aJSON["User"];
                    var nCount              = aJSONData.length;
                    var aNewPackData        = [];
                    var aError              = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount; k++){
                        if(aJSONData[k].length > 0){
                            aNewPackData.push(aJSONData[k]);
                        }
                    }
                    var nCount              = aNewPackData.length;
                    var aJSONData           = aNewPackData;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_รหัสผู้ใช้
                        if(typeof(aJSONData[j][0]) != 'undefined' || null){
                            if(aJSONData[j][0] == null){
                                aJSONData[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสผู้ใช้ไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][0].toString().length > 20){
                                    var tValueOld   = aJSONData[j][0];
                                    aJSONData[j][0] = aJSONData[j][0].toString().substring(0, 20);
                                    aError.push('4','[0]'+'$&รหัสผู้ใช้กินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสผู้ใช้ไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อผู้ใช้
                        if(typeof(aJSONData[j][1]) != 'undefined' || null){
                            if(aJSONData[j][1] == null){
                                aJSONData[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อผู้ใช้ไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][1].length > 100){
                                    var tValueOld   = aJSONData[j][1];
                                    aJSONData[j][1] = aJSONData[j][1].substring(0, 100);
                                    aError.push('4','[1]'+'$&ชื่อผู้ใช้เกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อผู้ใช้ไม่ได้ระบุข้อมูล$&'+'N/A');
                        }
                       
                        //Template_Filed_รหัสสาขา
                        if(typeof(aJSONData[j][2]) != 'undefined' || null){
                            if(aJSONData[j][2] == null){
                                aJSONData[j][2] = '';
                            }else{
                                if(aJSONData[j][2].toString().length > 5){
                                    var tValueOld   = aJSONData[j][2];
                                    aJSONData[j][2] = aJSONData[j][2].toString().substring(0, 5);
                                    aError.push('4','[2]'+'$&รหัสสาขายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][2] = '';
                        }
                 
                        //Template_Filed_กลุ่มสิทธิ
                        if(typeof(aJSONData[j][3]) != 'undefined' || null){
                            if(aJSONData[j][3] == null){
                                aJSONData[j][3] = '';
                            }else{
                                if(aJSONData[j][3].toString().length > 5){
                                    var tValueOld   = aJSONData[j][3];
                                    aJSONData[j][3] = aJSONData[j][3].toString().substring(0, 5);
                                    aError.push('4','[3]'+'$&รหัสกลุ่มสิทธิยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][3] = '';
                        }
                      
                        //Template_Filed_ตัวแทนขาย
                        if(typeof(aJSONData[j][4]) != 'undefined' || null){
                            if(aJSONData[j][4] == null){
                                aJSONData[j][4] = '';
                            }else{
                                if(aJSONData[j][4].length > 10){
                                    var tValueOld   = aJSONData[j][4];
                                    aJSONData[j][4] = aJSONData[j][4].substring(0, 10);
                                    aError.push('4','[4]'+'$&รหัสตัวแทนขายยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][4] = '';
                        }
                      
                        //Template_Filed_กลุ่มธุรกิจ
                        if(typeof(aJSONData[j][5]) != 'undefined' || null){
                            if(aJSONData[j][5] == null){
                                aJSONData[j][5] = '';
                            }else{
                                if(aJSONData[j][5].length > 10){
                                    var tValueOld   = aJSONData[j][5];
                                    aJSONData[j][5] = aJSONData[j][5].substring(0, 10);
                                    aError.push('4','[5]'+'$&รหัสธุรกิจยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][5] = '';
                        }

                        //Template_Filed_ร้านค้า
                        if(typeof(aJSONData[j][6]) != 'undefined' || null){
                            if(aJSONData[j][6] == null){
                                aJSONData[j][6] = '';
                            }else{
                                if(aJSONData[j][6].length > 5){
                                    var tValueOld   = aJSONData[j][6];
                                    aJSONData[j][6] = aJSONData[j][6].substring(0, 5);
                                    aError.push('4','[6]'+'$&รหัสรหัสร้านค้ายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][6] = '';
                        }

                        //Template_Filed_แผนก
                        if(typeof(aJSONData[j][7]) != 'undefined' || null){
                            if(aJSONData[j][7] == null){
                                aJSONData[j][7] = '';
                            }else{
                                if(aJSONData[j][7].length > 5){
                                    var tValueOld   = aJSONData[j][7];
                                    aJSONData[j][7] = aJSONData[j][7].substring(0, 5);
                                    aError.push('4','[7]'+'$&รหัสแผนกยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][7] = '';
                        }

                        //Template_Filed_เบอร์
                        if(typeof(aJSONData[j][8]) != 'undefined' || null){
                            if(aJSONData[j][8] == null){
                                aJSONData[j][8] = '';
                            }else{
                                if(aJSONData[j][8].length > 50){
                                    var tValueOld   = aJSONData[j][8];
                                    aJSONData[j][8] = aJSONData[j][8].substring(0, 50);
                                    aError.push('4','[8]'+'$&เบอร์โทรศัพท์ยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][8] = '';
                        }

                        //Template_Filed_อีเมล์
                        if(typeof(aJSONData[j][9]) != 'undefined' || null){
                            if(aJSONData[j][9] == null){
                                aJSONData[j][9] = '';
                            }else{
                                if(aJSONData[j][9].length > 100){
                                    var tValueOld   = aJSONData[j][9];
                                    aJSONData[j][9] = aJSONData[j][9].substring(0, 100);
                                    aError.push('4','[9]'+'$&อีเมลยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][9] = '';
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData[j].push('1','');
                        }
                        ///////////////////////////////////////////// DATATYPE
                    }
                break;
                case 'pos':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if(typeof(aJSON['Pos']) == 'undefined'){
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        JSxFileFailFormat();
                        return;
                    }

                    var aJSONData           = aJSON["Pos"];
                    var nCount              = aJSONData.length;
                    var aNewPackData        = [];
                    var aError              = [];
                    var aPosType            = [1,2,3,4,5,6];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount; k++){
                        if(aJSONData[k].length > 0){
                            aNewPackData.push(aJSONData[k]);
                        }
                    }
                    var nCount              = aNewPackData.length;
                    var aJSONData           = aNewPackData;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_สาขา
                        if(typeof(aJSONData[j][0]) != 'undefined' || null){
                            if(aJSONData[j][0] == null){
                                aJSONData[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสสาขาไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][0].toString().length > 5){
                                    var tValueOld   = aJSONData[j][0];
                                    aJSONData[j][0] = aJSONData[j][0].toString().substring(0, 5);
                                    aError.push('4','[0]'+'$&รหัสสาขายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสสาขาไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_จุดขาย
                        if(typeof(aJSONData[j][1]) != 'undefined' || null){
                            if(aJSONData[j][1] == null){
                                aJSONData[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&รหัสจุดขายไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][1].toString().length > 5){
                                    var tValueOld   = aJSONData[j][1];
                                    aJSONData[j][1] = aJSONData[j][1].toString().substring(0, 5);
                                    aError.push('4','[1]'+'$&รหัสจุดขายยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&รหัสจุดขายไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อจุดขาย
                        if(typeof(aJSONData[j][2]) != 'undefined' || null){
                            if(aJSONData[j][2] == null){
                                aJSONData[j][2] = 'N/A';
                                aError.push('7','[2]'+'$&ชื่อจุดขายไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData[j][2].length > 100){
                                    var tValueOld   = aJSONData[j][2];
                                    aJSONData[j][2] = aJSONData[j][2].substring(0, 100);
                                    aError.push('4','[2]'+'$&ชื่อจุดขายเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][2] = 'N/A';
                            aError.push('7','[2]'+'$&ชื่อจุดขายไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ประเภทเครื่องจุดขาย
                        if(typeof(aJSONData[j][3]) != 'undefined' || null){
                            if(aJSONData[j][3] == null){
                                aJSONData[j][3] = '1';
                            }else{
                                var Letters = /^[ก-๛A-Za-z]+$/;
                                var nValue = aJSONData[j][3].toString();
                                var nValue = nValue.replace(" ", "");
                                if(nValue.match(Letters)){
                                    //เอาตัวที่ผิดออก
                                    var tValueOld  = aJSONData[j][3];
                                    aJSONData[j].pop();
                                    aJSONData[j].push(1);
                                    aError.push('3','[3]'+'$&รูปแบบประเภทผิด$&'+tValueOld);
                                }
                                
                                if(aJSONData[j][3].length > 1){
                                    var tValueOld   = aJSONData[j][3];
                                    aJSONData[j][3] = aJSONData[j][3].substring(0, 1);
                                    aError.push('4','[3]'+'$&ประเภทจุดขายไม่ถูกต้อง$&'+tValueOld);
                                }

                                if(aPosType.includes(aJSONData[j][3]) != true){
                                    var tValueOld   = aJSONData[j][3];
                                    aJSONData[j][3] = 1;
                                    aError.push('4','[3]'+'$&ประเภทจุดขายไม่ถูกต้อง$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][3] = '1';
                        }

                         //Template_Filed_รหัสลงทะเบียน
                         if(typeof(aJSONData[j][4]) != 'undefined' || null){
                            if(aJSONData[j][4] == null){
                                aJSONData[j][4] = '';
                            }else{
                                if(aJSONData[j][4].length > 20){
                                    var tValueOld   = aJSONData[j][4];
                                    aJSONData[j][4] = aJSONData[j][4].substring(0, 20);
                                    aError.push('4','[4]'+'$&หมายเลขจุดขายเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][4] = '';
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData[j].push('1','');
                        }
                        ///////////////////////////////////////////// DATATYPE
                    }
                break;
                case 'product':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if(typeof(aJSON['Product']) == 'undefined'){
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        JSxFileFailFormat();
                        return;
                    }
                    var aJSONData               = ['[1] Tab : product , [2] Tab : unit , [3] Tab : brand , [4] Tab : type , [5] Tab : model , [6] Tab : product group , [7] Tab : touch group'];
                    //###################################################  Sheet Product
                    var aJSONData_PDT           = aJSON["Product"];
                    var nCount_PDT              = aJSONData_PDT.length;
                    var aNewPackData_PDT        = [];
                    var aError                  = [];
                   
                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount_PDT; k++){
                        if(aJSONData_PDT[k].length > 0){
                            aNewPackData_PDT.push(aJSONData_PDT[k]);
                        }
                    }
                    var nCount              = aNewPackData_PDT.length;
                    var aJSONData_PDT       = aNewPackData_PDT;
                    if(nCount>1001){ //ถ้าสินค้ามีมากกว่า 1 พันรายการ
                        alert('จำนวนรายการเกิน ระบบแนะนำไม่เกินหนึ่งพันรายการ');
                        JSxFileFailFormat();
                        return;
                    }
                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_รหัสสินค้า
                        if(typeof(aJSONData_PDT[j][0]) != 'undefined' || null){
                            if(aJSONData_PDT[j][0] == null){
                                aJSONData_PDT[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_PDT[j][0].toString().length > 20){
                                    var tValueOld   = aJSONData_PDT[j][0];
                                    aJSONData_PDT[j][0] = aJSONData_PDT[j][0].toString().substring(0, 20);
                                    aError.push('4','[0]'+'$&รหัสสินค้ากินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อสินค้า
                        if(typeof(aJSONData_PDT[j][1]) != 'undefined' || null){
                            if(aJSONData_PDT[j][1] == null){
                                aJSONData_PDT[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_PDT[j][1].length > 100){
                                    var tValueOld   = aJSONData_PDT[j][1];
                                    aJSONData_PDT[j][1] = aJSONData_PDT[j][1].substring(0, 100);
                                    aError.push('4','[1]'+'$&ชื่อสินค้าเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                        }
                    
                        //Template_Filed_ชื่อเพิ่มเติม
                        if(typeof(aJSONData_PDT[j][2]) != 'undefined' || null){
                            if(aJSONData_PDT[j][2] == null){
                                aJSONData_PDT[j][2] = '';
                            }else{
                                if(aJSONData_PDT[j][2].toString().length > 30){
                                    var tValueOld   = aJSONData_PDT[j][2];
                                    aJSONData_PDT[j][2] = aJSONData_PDT[j][2].toString().substring(0, 30);
                                    aError.push('4','[2]'+'$&ชื่อเพิ่มเติมยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][2] = '';
                        }
                
                        //Template_Filed_หน่วยสินค้า
                        if(typeof(aJSONData_PDT[j][3]) != 'undefined' || null){
                            if(aJSONData_PDT[j][3] == null){
                                aJSONData_PDT[j][3] = 'N/A';
                                aError.push('7','[3]'+'$&รหัสหน่วยสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_PDT[j][3].length > 5){
                                    var tValueOld   = aJSONData_PDT[j][3];
                                    aJSONData_PDT[j][3] = aJSONData_PDT[j][3].substring(0, 5);
                                    aError.push('4','[3]'+'$&รหัสหน่วยสินค้าเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][3] = 'N/A';
                            aError.push('7','[3]'+'$&รหัสหน่วยสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_เฟกเตอร์
                        if(typeof(aJSONData_PDT[j][4]) != 'undefined' || null){
                            if(aJSONData_PDT[j][4] == null){
                                aJSONData_PDT[j][4] = 0;
                            }else{
                                var Letters = /^[ก-๛A-Za-z]+$/;
                                var nValue = aJSONData_PDT[j][4];
                                if(typeof nValue == 'string'){
                                    aJSONData_PDT[j][4] = 0;
                                    aError.push('3','[4]'+'$&รูปแบบหน่วยผิด$&'+tValueOld);
                                }else{
                                    var nValue = aJSONData_PDT[j][4].toString();;
                                    var nValue = nValue.replace(" ", "");
                                    if(nValue.match(Letters)){
                                        //เอาตัวที่ผิดออก
                                        var tValueOld  = aJSONData_PDT[j][4];
                                        aJSONData_PDT[j][4] = 0;
                                        aError.push('3','[4]'+'$&รูปแบบหน่วยผิด$&'+tValueOld);
                                    }
                                }
                            }
                        }else{
                            aJSONData_PDT[j][4] = 0;
                        }

                        //Template_Filed_บาร์โค้ด
                        if(typeof(aJSONData_PDT[j][5]) != 'undefined' || null){
                            if(aJSONData_PDT[j][5] == null){
                                aJSONData_PDT[j][5] = 'N/A';
                                aError.push('7','[5]'+'$&บาร์โค้ดไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_PDT[j][5].length > 20){
                                    var tValueOld   = aJSONData_PDT[j][5];
                                    aJSONData_PDT[j][5] = aJSONData_PDT[j][5].substring(0, 20);
                                    aError.push('4','[5]'+'$&บาร์โค้ดเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][5] = 'N/A';
                            aError.push('7','[5]'+'$&บาร์โค้ดไม่ได้ระบุข้อมูล$&'+'N/A');
                        }
                    
                        //Template_Filed_แบรนด์
                        if(typeof(aJSONData_PDT[j][6]) != 'undefined' || null){
                            if(aJSONData_PDT[j][6] == null){
                                aJSONData_PDT[j][6] = '';
                            }else{
                                if(aJSONData_PDT[j][6].length > 5){
                                    var tValueOld   = aJSONData_PDT[j][6];
                                    aJSONData_PDT[j][6] = aJSONData_PDT[j][6].substring(0, 5);
                                    aError.push('4','[6]'+'$&แบรนด์ยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][6] = '';
                        }

                        //Template_Filed_ภาษี
                        if(typeof(aJSONData_PDT[j][7]) != 'undefined' || null){
                            if(aJSONData_PDT[j][7] == null){
                                aJSONData_PDT[j][7] = '1';
                            }else{
                                if(aJSONData_PDT[j][7].length > 1){
                                    var tValueOld   = aJSONData_PDT[j][7];
                                    aJSONData_PDT[j][7] = aJSONData_PDT[j][7].substring(0, 1);
                                    aError.push('4','[7]'+'$&ภาษียาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][7] = '1';
                        }

                        //Template_Filed_ประเภทสินค้า
                        if(typeof(aJSONData_PDT[j][8]) != 'undefined' || null){
                            if(aJSONData_PDT[j][8] == null){
                                aJSONData_PDT[j][8] = '';
                            }else{
                                if(aJSONData_PDT[j][8].length > 5){
                                    var tValueOld   = aJSONData_PDT[j][8];
                                    aJSONData_PDT[j][8] = aJSONData_PDT[j][8].substring(0, 5);
                                    aError.push('4','[8]'+'$&รหัสประเภทสินค้ายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][8] = '';
                        }

                        //Template_Filed_รุ่นสินค้า
                        if(typeof(aJSONData_PDT[j][9]) != 'undefined' || null){
                            if(aJSONData_PDT[j][9] == null){
                                aJSONData_PDT[j][9] = '';
                            }else{
                                if(aJSONData_PDT[j][9].length > 5){
                                    var tValueOld   = aJSONData_PDT[j][9];
                                    aJSONData_PDT[j][9] = aJSONData_PDT[j][9].substring(0, 5);
                                    aError.push('4','[9]'+'$&รหัสรุ่นสินค้ายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][9] = '';
                        }

                        //Template_Filed_กลุ่มสินค้า
                        if(typeof(aJSONData_PDT[j][10]) != 'undefined' || null){
                            if(aJSONData_PDT[j][10] == null){
                                aJSONData_PDT[j][10] = '';
                            }else{
                                if(aJSONData_PDT[j][10].length > 5){
                                    var tValueOld   = aJSONData_PDT[j][10];
                                    aJSONData_PDT[j][10] = aJSONData_PDT[j][10].substring(0, 5);
                                    aError.push('4','[10]'+'$&รหัสกลุ่มสินค้ายาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][10] = '';
                        }

                        //Template_Filed_สินค้าทัช
                        if(typeof(aJSONData_PDT[j][11]) != 'undefined' || null){
                            if(aJSONData_PDT[j][11] == null){
                                aJSONData_PDT[j][11] = '';
                            }else{
                                if(aJSONData_PDT[j][11].length > 5){
                                    var tValueOld   = aJSONData_PDT[j][11];
                                    aJSONData_PDT[j][11] = aJSONData_PDT[j][11].substring(0, 5);
                                    aError.push('4','[11]'+'$&รหัสกลุ่มสินค้าด่วนยาวเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PDT[j][11] = '';
                        }

                        aJSONData_PDT[j][12] = '';
                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            // aJSONData_PDT[j].push(aError[0],aError[1]);
                            aJSONData_PDT[j][12] = aError[0];
                            aJSONData_PDT[j][13] = aError[1];
                            aError = [];
                        }else{
                            // aJSONData_PDT[j].push('1','');
                            aJSONData_PDT[j][12] = '1';
                            aJSONData_PDT[j][13] = '';
                        }
                    }       
                    aJSONData_PDT.shift();
                    aJSONData.push(aJSONData_PDT);


                    //###################################################  Sheet UNIT
                    var aJSONData_UNIT              = aJSON["Unit"];
                    var nCount_UNIT                 = aJSONData_UNIT.length;
                    var aNewPackData_UNIT           = [];
                    var aError                      = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount_UNIT; k++){
                        if(aJSONData_UNIT[k].length > 0){
                            aNewPackData_UNIT.push(aJSONData_UNIT[k]);
                        }
                    }
                    var nCount              = aNewPackData_UNIT.length;
                    var aJSONData_UNIT      = aNewPackData_UNIT;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_รหัสหน่วยสินค้า
                        if(typeof(aJSONData_UNIT[j][0]) != 'undefined' || null){
                            if(aJSONData_UNIT[j][0] == null){
                                aJSONData_UNIT[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสหน่วยสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_UNIT[j][0].toString().length > 5){
                                    var tValueOld   = aJSONData_UNIT[j][0];
                                    aJSONData_UNIT[j][0] = aJSONData_UNIT[j][0].toString().substring(0, 5);
                                    aError.push('4','[0]'+'$&รหัสหน่วยสินค้ากินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_UNIT[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสหน่วยสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อหน่วยสินค้า
                        if(typeof(aJSONData_UNIT[j][1]) != 'undefined' || null){
                            if(aJSONData_UNIT[j][1] == null){
                                aJSONData_UNIT[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อหน่วยสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_UNIT[j][1].length > 50){
                                    var tValueOld   = aJSONData_UNIT[j][1];
                                    aJSONData_UNIT[j][1] = aJSONData_UNIT[j][1].substring(0, 50);
                                    aError.push('4','[1]'+'$&ชื่อหน่วยสินค้าเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_UNIT[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อหน่วยสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData_UNIT[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData_UNIT[j].push('1','');
                        }
                    }   
                    aJSONData_UNIT.shift();
                    aJSONData.push(aJSONData_UNIT);

                    //###################################################  Sheet Brand
                    var aJSONData_BRAND             = aJSON["Brand"];
                    var nCount_BRAND                = aJSONData_BRAND.length;
                    var aNewPackData_BRAND          = [];
                    var aError                      = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount_BRAND; k++){
                        if(aJSONData_BRAND[k].length > 0){
                            aNewPackData_BRAND.push(aJSONData_BRAND[k]);
                        }
                    }
                    var nCount               = aNewPackData_BRAND.length;
                    var aJSONData_BRAND      = aNewPackData_BRAND;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_รหัสแบรนด์
                        if(typeof(aJSONData_BRAND[j][0]) != 'undefined' || null){
                            if(aJSONData_BRAND[j][0] == null){
                                aJSONData_BRAND[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสแบรนด์ไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_BRAND[j][0].toString().length > 5){
                                    var tValueOld   = aJSONData_BRAND[j][0];
                                    aJSONData_BRAND[j][0] = aJSONData_BRAND[j][0].toString().substring(0, 5);
                                    aError.push('4','[0]'+'$&รหัสแบรนด์กินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_BRAND[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสแบรนด์ไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อแบรนด์
                        if(typeof(aJSONData_BRAND[j][1]) != 'undefined' || null){
                            if(aJSONData_BRAND[j][1] == null){
                                aJSONData_BRAND[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อแบรนด์ไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_BRAND[j][1].length > 50){
                                    var tValueOld   = aJSONData_BRAND[j][1];
                                    aJSONData_BRAND[j][1] = aJSONData_BRAND[j][1].substring(0, 50);
                                    aError.push('4','[1]'+'$&ชื่อแบรนด์เกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_BRAND[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อแบรนด์ไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData_BRAND[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData_BRAND[j].push('1','');
                        }
                    }   
                    aJSONData_BRAND.shift();
                    aJSONData.push(aJSONData_BRAND);

                    //###################################################  Sheet Type
                    var aJSONData_Type             = aJSON["Type"];
                    var nCount_Type                = aJSONData_Type.length;
                    var aNewPackData_Type          = [];
                    var aError                       = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount_Type; k++){
                        if(aJSONData_Type[k].length > 0){
                            aNewPackData_Type.push(aJSONData_Type[k]);
                        }
                    }
                    var nCount                = aNewPackData_Type.length;
                    var aJSONData_Type      = aNewPackData_Type;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_รหัสประเภท
                        if(typeof(aJSONData_Type[j][0]) != 'undefined' || null){
                            if(aJSONData_Type[j][0] == null){
                                aJSONData_Type[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสประเภทไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_Type[j][0].toString().length > 5){
                                    var tValueOld   = aJSONData_Type[j][0];
                                    aJSONData_Type[j][0] = aJSONData_Type[j][0].toString().substring(0, 5);
                                    aError.push('4','[0]'+'$&รหัสประเภทกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_Type[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสประเภทไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อประเภท
                        if(typeof(aJSONData_Type[j][1]) != 'undefined' || null){
                            if(aJSONData_Type[j][1] == null){
                                aJSONData_Type[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อประเภทไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_Type[j][1].length > 50){
                                    var tValueOld   = aJSONData_Type[j][1];
                                    aJSONData_Type[j][1] = aJSONData_Type[j][1].substring(0, 50);
                                    aError.push('4','[1]'+'$&ชื่อประเภทเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_Type[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อประเภทไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData_Type[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData_Type[j].push('1','');
                        }
                    }   
                    aJSONData_Type.shift();
                    aJSONData.push(aJSONData_Type);

                    //###################################################  Sheet Model
                    var aJSONData_Model             = aJSON["Model"];
                    var nCount_Model                = aJSONData_Model.length;
                    var aNewPackData_Model          = [];
                    var aError                       = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount_Model; k++){
                        if(aJSONData_Model[k].length > 0){
                            aNewPackData_Model.push(aJSONData_Model[k]);
                        }
                    }
                    var nCount                = aNewPackData_Model.length;
                    var aJSONData_Model      = aNewPackData_Model;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_รหัสรุ่น
                        if(typeof(aJSONData_Model[j][0]) != 'undefined' || null){
                            if(aJSONData_Model[j][0] == null){
                                aJSONData_Model[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสรุ่นไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_Model[j][0].toString().length > 5){
                                    var tValueOld   = aJSONData_Model[j][0];
                                    aJSONData_Model[j][0] = aJSONData_Model[j][0].toString().substring(0, 5);
                                    aError.push('4','[0]'+'$&รหัสรุ่นกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_Model[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสรุ่นไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อรุ่น
                        if(typeof(aJSONData_Model[j][1]) != 'undefined' || null){
                            if(aJSONData_Model[j][1] == null){
                                aJSONData_Model[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อรุ่นไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_Model[j][1].length > 50){
                                    var tValueOld   = aJSONData_Model[j][1];
                                    aJSONData_Model[j][1] = aJSONData_Model[j][1].substring(0, 50);
                                    aError.push('4','[1]'+'$&ชื่อรุ่นเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_Model[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อรุ่นไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData_Model[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData_Model[j].push('1','');
                        }
                    }   
                    aJSONData_Model.shift();
                    aJSONData.push(aJSONData_Model);

                    //###################################################  Sheet Product Group
                    var aJSONData_PdtGrp             = aJSON["Product Group"];
                    var nCount_PdtGrp                = aJSONData_PdtGrp.length;
                    var aNewPackData_PdtGrp          = [];
                    var aError                       = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount_PdtGrp; k++){
                        if(aJSONData_PdtGrp[k].length > 0){
                            aNewPackData_PdtGrp.push(aJSONData_PdtGrp[k]);
                        }
                    }
                    var nCount                = aNewPackData_PdtGrp.length;
                    var aJSONData_PdtGrp      = aNewPackData_PdtGrp;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_รหัสกลุ่ม
                        if(typeof(aJSONData_PdtGrp[j][0]) != 'undefined' || null){
                            if(aJSONData_PdtGrp[j][0] == null){
                                aJSONData_PdtGrp[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสกลุ่มไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_PdtGrp[j][0].toString().length > 30){
                                    var tValueOld   = aJSONData_PdtGrp[j][0];
                                    aJSONData_PdtGrp[j][0] = aJSONData_PdtGrp[j][0].toString().substring(0, 30);
                                    aError.push('4','[0]'+'$&รหัสกลุ่มกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PdtGrp[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสกลุ่มไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อกลุ่ม
                        if(typeof(aJSONData_PdtGrp[j][1]) != 'undefined' || null){
                            if(aJSONData_PdtGrp[j][1] == null){
                                aJSONData_PdtGrp[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อกลุ่มไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_PdtGrp[j][1].length > 100){
                                    var tValueOld   = aJSONData_PdtGrp[j][1];
                                    aJSONData_PdtGrp[j][1] = aJSONData_PdtGrp[j][1].substring(0, 100);
                                    aError.push('4','[1]'+'$&ชื่อกลุ่มเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_PdtGrp[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อกลุ่มไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData_PdtGrp[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData_PdtGrp[j].push('1','');
                        }
                    }   
                    aJSONData_PdtGrp.shift();
                    aJSONData.push(aJSONData_PdtGrp);

                    //###################################################  Sheet Touch Group
                    var aJSONData_TGroup             = aJSON["Touch Group"];
                    var nCount_TGroup                = aJSONData_TGroup.length;
                    var aNewPackData_TGroup          = [];
                    var aError                       = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount_TGroup; k++){
                        if(aJSONData_TGroup[k].length > 0){
                            aNewPackData_TGroup.push(aJSONData_TGroup[k]);
                        }
                    }
                    var nCount                = aNewPackData_TGroup.length;
                    var aJSONData_TGroup      = aNewPackData_TGroup;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_รหัสกลุ่ม
                        if(typeof(aJSONData_TGroup[j][0]) != 'undefined' || null){
                            if(aJSONData_TGroup[j][0] == null){
                                aJSONData_TGroup[j][0] = 'N/A';
                                aError.push('7','[0]'+'$&รหัสกลุ่มไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_TGroup[j][0].toString().length > 5){
                                    var tValueOld   = aJSONData_TGroup[j][0];
                                    aJSONData_TGroup[j][0] = aJSONData_TGroup[j][0].toString().substring(0, 5);
                                    aError.push('4','[0]'+'$&รหัสกลุ่มกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_TGroup[j][0] = 'N/A';
                            aError.push('7','[0]'+'$&รหัสกลุ่มไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //Template_Filed_ชื่อกลุ่ม
                        if(typeof(aJSONData_TGroup[j][1]) != 'undefined' || null){
                            if(aJSONData_TGroup[j][1] == null){
                                aJSONData_TGroup[j][1] = 'N/A';
                                aError.push('7','[1]'+'$&ชื่อกลุ่มไม่ได้ระบุข้อมูล$&'+'N/A');
                            }else{
                                if(aJSONData_TGroup[j][1].length > 50){
                                    var tValueOld   = aJSONData_TGroup[j][1];
                                    aJSONData_TGroup[j][1] = aJSONData_TGroup[j][1].substring(0, 50);
                                    aError.push('4','[1]'+'$&ชื่อกลุ่มเกินกำหนด$&'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData_TGroup[j][1] = 'N/A';
                            aError.push('7','[1]'+'$&ชื่อกลุ่มไม่ได้ระบุข้อมูล$&'+'N/A');
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData_TGroup[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData_TGroup[j].push('1','');
                        }
                    }   
                    aJSONData_TGroup.shift();
                    aJSONData.push(aJSONData_TGroup);

                break;
                case 'purchaseorder':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if(typeof(aJSON['Purchase Order']) == 'undefined'){
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        return;
                    }

                    var aJSONData           = aJSON["Purchase Order"];
                    var nCount              = aJSONData.length;
                    var aNewPackData        = [];
                    var aError              = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount; k++){
                        if(aJSONData[k].length > 0){
                            aNewPackData.push(aJSONData[k]);
                        }
                    }
                    var nCount              = aNewPackData.length;
                    var aJSONData           = aNewPackData;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_จำนวน
                        if(typeof(aJSONData[j][3]) != 'undefined' || null){
                            if(aJSONData[j][3] == null){
                                aJSONData[j][3] = '0';
                            }else{
                                var Letters = /^[ก-๛A-Za-z]+$/;
                                var nValue = aJSONData[j][3].toString();
                                var nValue = nValue.replace(" ", "");
                                if(nValue.match(Letters)){
                                    //เอาตัวที่ผิดออก
                                    var tValueOld  = aJSONData[j][3];
                                    aJSONData[j].pop();
                                    aJSONData[j].push(0);
                                    aJSONData[j][3]=0;
                                    aError.push('3','D:'+j+' รูปแบบจำนวนผิดที่ '+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][3] = '0';
                        }


                      //Template_Filed_ราคา
                        if(typeof(aJSONData[j][4]) != 'undefined' || null){
                            if(aJSONData[j][4] == null){
                                aJSONData[j][4] = '0';
                            }else{
                                var Letters = /^[ก-๛A-Za-z]+$/;
                                var nValue = aJSONData[j][4].toString();
                                var nValue = nValue.replace(" ", "");
                                if(nValue.match(Letters)){
                                    //เอาตัวที่ผิดออก
                                    var tValueOld  = aJSONData[j][4];
                                    aJSONData[j].pop();
                                    aJSONData[j].push(0);
                                    aJSONData[j][4]=0;
                                    aError.push('3','E:'+j+' รูปแบบราคาผิดที่ '+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][3] = '0';
                        }

                        //Template_Filed_รหัสสินค้า
                        if(typeof(aJSONData[j][0]) != 'undefined' || null){
                            if(aJSONData[j][0] == null){
                                aJSONData[j][0] = 'N/A';
                                aError.push('7','A:'+j+' รหัสสินค้าไม่ได้ระบุข้อมูล :N/A');
                            }else{
                                if(aJSONData[j][0].length > 20){
                                    var tValueOld   = aJSONData[j][0];
                                    aJSONData[j][0] = aJSONData[j][0].substring(0, 20);
                                    aError.push('4','A:'+j+' รหัสสินค้ายาวเกินกำหนดที่ :'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][0] = 'N/A';
                            aError.push('4','A:'+j+' รหัสสินค้ายาวเกินกำหนดที่ :'+tValueOld);
                        }

                        //Template_Filed_หน่วยสินค้า
                        if(typeof(aJSONData[j][1]) != 'undefined' || null){
                            if(aJSONData[j][1] == null){
                                aJSONData[j][1] = 'N/A';
                                aError.push('7','B:'+j+' รหัสหน่วยสินค้าไม่ได้ระบุข้อมูล :N/A');
                            }else{
                                if(aJSONData[j][1].length > 5){
                                    var tValueOld   = aJSONData[j][1];
                                    aJSONData[j][1] = aJSONData[j][1].substring(0, 5);
                                    aError.push('4','B:'+j+' รหัสหน่วยสินค้ายาวเกินกำหนดที่ :'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][1] = '00000';
                        }



                     //Template_Filed_บาร์โตด
                        if(typeof(aJSONData[j][2]) != 'undefined' || null){
                            if(aJSONData[j][2] == null){
                                aJSONData[j][2] = 'N/A';
                                aError.push('7','C:'+j+' รหัสหน่วยสินค้าไม่ได้ระบุข้อมูล :N/A');
                            }else{
                                if(aJSONData[j][2].length > 25){
                                    var tValueOld   = aJSONData[j][2];
                                    aJSONData[j][2] = aJSONData[j][2].substring(0, 5);
                                    aError.push('4','C:'+j+' รหัสหน่วยสินค้ายาวเกินกำหนดที่ :'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][2] = '00000';
                        }
                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData[j].push('1','');
                        }
                        ///////////////////////////////////////////// DATATYPE
                    }
                break;
                case  'purchaseinvoice' :
                              //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                              if(typeof(aJSON['Purchase Invoice']) == 'undefined'){
                                alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                                return;
                            }
    
                            var aJSONData           = aJSON["Purchase Invoice"];
                            var nCount              = aJSONData.length;
                            var aNewPackData        = [];
                            var aError              = [];
    
                            //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                            for(var k=0; k<nCount; k++){
                                if(aJSONData[k].length > 0){
                                    aNewPackData.push(aJSONData[k]);
                                }
                            }
    
                            var nCount          = aNewPackData.length;
                            var aJSONData       = aNewPackData;
    
                            for(var j=1; j<nCount; j++){
                                var tValueOld = '';
    
                                //Template_Filed_จำนวน
                                if(typeof(aJSONData[j][1]) != 'undefined' || null){
                                    if(aJSONData[j][1] == null){
                                        aJSONData[j][1] = '0';
                                    }else{
                                        var Letters = /^[ก-๛A-Za-z]+$/;
                                        var nValue = aJSONData[j][1].toString();
                                        var nValue = nValue.replace(" ", "");
                                        if(nValue.match(Letters)){
                                            //เอาตัวที่ผิดออก
                                            var tValueOld  = aJSONData[j][1];
                                            aJSONData[j].pop();
                                            aJSONData[j].push(0);
                                            aError.push('3','[1]'+'$&รูปแบบจำนวนผิด$&'+tValueOld);
                                        }
                                    }
                                }else{
                                    aJSONData[j][1] = '0';
                                }
    
                                //Template_Filed_ราคา
                                if(typeof(aJSONData[j][2]) != 'undefined' || null){
                                    if(aJSONData[j][2] == null){
                                        aJSONData[j][2] = '0';
                                    }else{
                                        var Letters = /^[ก-๛A-Za-z]+$/;
                                        var nValue = aJSONData[j][2].toString();
                                        var nValue = nValue.replace(" ", "");
                                        if(nValue.match(Letters)){
                                            //เอาตัวที่ผิดออก
                                            var tValueOld  = aJSONData[j][2];
                                            aJSONData[j].pop();
                                            aJSONData[j].push(0);
                                            aError.push('3','[2]'+'$&รูปแบบราคาผิด$&'+tValueOld);
                                        }
                                    }
                                }else{
                                    aJSONData[j][2] = '0';
                                }
    
                                 //Template_Filed_รหัสสินค้าหรือบาร์โค้ด
                                if(typeof(aJSONData[j][0]) != 'undefined' || null){
                                    if(aJSONData[j][0] == null){
                                        aJSONData[j][0] = 'N/A';
                                        aError.push('7','[0]'+'$&รหัสสินค้าไม่ได้ระบุข้อมูล$&'+'N/A');
                                    }else{
                                        if(aJSONData[j][0].length > 25){
                                            var tValueOld   = aJSONData[j][0];
                                            aJSONData[j][0] = aJSONData[j][0].substring(0, 25);
                                            aError.push('4','[0]'+'$&รหัสสินค้ายาวเกินกำหนด$&'+tValueOld);
                                        }
                                    }
                                }else{
                                    aJSONData[j][0] = 'N/A';
                                    aError.push('4','[0]'+'$&รหัสสินค้ายาวเกินกำหนด$&'+tValueOld);
                                }
    
               
                                //ถ้าผ่านทุกอัน
                                if(aError.length > 0){
                                    aJSONData[j].push(aError[0],aError[1]);
                                    aError = [];
                                }else{
                                    aJSONData[j].push('1','');
                                }
                            }
                break;
                case 'adjcost':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if(typeof(aJSON['Adjust Cost']) == 'undefined'){
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        return;
                    }

                    var aJSONData           = aJSON["Adjust Cost"];
                    var nCount              = aJSONData.length;
                    var aNewPackData        = [];
                    var aError              = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount; k++){
                        if(aJSONData[k].length > 0){
                            aNewPackData.push(aJSONData[k]);
                        }
                    }
                    var nCount              = aNewPackData.length;
                    var aJSONData           = aNewPackData;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=1; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_ราคา
                        if(typeof(aJSONData[j][1]) != 'undefined' || null){
                            if(aJSONData[j][1] == null){
                                aJSONData[j][1] = '0';
                            }else{
                                var Letters = /^[ก-๛A-Za-z]+$/;
                                var nValue = aJSONData[j][1].toString();
                                var nValue = nValue.replace(" ", "");
                                if(nValue.match(Letters)){
                                    //เอาตัวที่ผิดออก
                                    var tValueOld  = aJSONData[j][1];
                                    aJSONData[j].pop();
                                    aJSONData[j].push(0);
                                    aError.push('3','[1]'+'รูปแบบราคาผิด'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][1] = '0';
                        }

                        //Template_Filed_รหัสสินค้า
                        if(typeof(aJSONData[j][0]) != 'undefined' || null){
                            if(aJSONData[j][0] == null){
                                aJSONData[j][0] = 'N/A';
                                aError.push('7','[0]'+'รหัสสินค้าไม่ได้ระบุข้อมูล'+'N/A');
                            }else{
                                if(aJSONData[j][0].length > 20){
                                    var tValueOld   = aJSONData[j][0];
                                    aJSONData[j][0] = aJSONData[j][0].substring(0, 20);
                                    aError.push('4','[0]'+'รหัสสินค้ายาวเกินกำหนด'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][0] = 'N/A';
                            aError.push('4','[0]'+'รหัสสินค้ายาวเกินกำหนด'+tValueOld);
                        }


                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData[j].push('1','');
                        }
                        ///////////////////////////////////////////// DATATYPE
                    }
                break;
                case 'adjstock':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if(typeof(aJSON['Adjust Stock']) == 'undefined'){
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        return;
                    }

                    var aJSONData           = aJSON["Adjust Stock"];
                    var nCount              = aJSONData.length;
                    var aNewPackData        = [];
                    var aError              = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for(var k=0; k<nCount; k++){
                        if(aJSONData[k].length > 0){
                            aNewPackData.push(aJSONData[k]);
                        }
                    }
                    var nCount              = aNewPackData.length;
                    var aJSONData           = aNewPackData;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for(var j=0; j<nCount; j++){
                        var tValueOld = '';

                        //Template_Filed_ราคา
                        if(typeof(aJSONData[j][2]) != 'undefined' || null){
                            if(aJSONData[j][2] == null){
                                aJSONData[j][2] = '0';
                            }else{
                                var Letters = /^[ก-๛A-Za-z]+$/;
                                var nValue = aJSONData[j][2].toString();
                                var nValue = nValue.replace(" ", "");
                                if(nValue.match(Letters)){
                                    //เอาตัวที่ผิดออก
                                    var tValueOld  = aJSONData[j][2];
                                    aJSONData[j].pop();
                                    aJSONData[j].push(2);
                                    aError.push('3','[2]'+'รูปแบบจำนวนผิด'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][2] = '0';
                        }

                        //Template_Filed_รหัสสินค้า
                        if(typeof(aJSONData[j][0]) != 'undefined' || null){
                            if(aJSONData[j][0] == null){
                                aJSONData[j][0] = 'N/A';
                                aError.push('7','[0]'+'รหัสสินค้าไม่ได้ระบุข้อมูล'+'N/A');
                            }else{
                                if(aJSONData[j][0].length > 20){
                                    var tValueOld   = aJSONData[j][0];
                                    aJSONData[j][0] = aJSONData[j][0].substring(0, 20);
                                    aError.push('4','[0]'+'รหัสสินค้ายาวเกินกำหนด'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][0] = 'N/A';
                            aError.push('4','[0]'+'รหัสสินค้ายาวเกินกำหนด'+tValueOld);
                        }


                        //Template_Filed_รหัสบาร์โคด
                        if(typeof(aJSONData[j][1]) != 'undefined' || null){
                            if(aJSONData[j][1] == null){
                                aJSONData[j][1] = 'N/A';
                                aError.push('7','[1]'+'รหัสบาร์โคดไม่ได้ระบุข้อมูล'+'N/A');
                            }else{
                                if(aJSONData[j][1].length > 25){
                                    var tValueOld   = aJSONData[j][1];
                                    aJSONData[j][1] = aJSONData[j][1].substring(0, 25);
                                    aError.push('4','[1]'+'รหัสบาร์โคดยาวเกินกำหนด'+tValueOld);
                                }
                            }
                        }else{
                            aJSONData[j][1] = 'N/A';
                            aError.push('4','[1]'+'รหัสบาร์โคดยาวเกินกำหนด'+tValueOld);
                        }

                        //ถ้าผ่านทุกอัน
                        if(aError.length > 0){
                            aJSONData[j].push(aError[0],aError[1]);
                            aError = [];
                        }else{
                            aJSONData[j].push('1','');
                        }
                        ///////////////////////////////////////////// DATATYPE
                    }
                break;
                case 'printbarcode':
                    //ตรวจสอบชื่อชิทว่าถูกต้องไหม
                    if (typeof(aJSON['Print Price Tags']) == 'undefined') {
                        alert('รูปแบบเอกสารไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
                        return;
                    }

                    var aJSONData = aJSON["Print Price Tags"];
                    var nCount = aJSONData.length;
                    var aNewPackData = [];
                    var aError = [];

                    //ตรวจสอบ excel cell ที่มันเป็นค่าว่าง
                    for (var k = 0; k < nCount; k++) {
                        if (aJSONData[k].length > 0) {
                            aNewPackData.push(aJSONData[k]);
                        }
                    }
                    var nCount = aNewPackData.length;
                    var aJSONData = aNewPackData;

                    //ในลูปนี้จะเช็ค 2 step status 3:เช็ค MaxLen ,status 4:เช็ค DataType
                    for (var j = 1; j < nCount; j++) {
                        var tValueOld = '';

                        //Template_Filed_บาร์โค้ด
                        if (typeof(aJSONData[j][0]) != 'undefined' || null) {
                            if (aJSONData[j][0] == null) {
                                aJSONData[j][0] = 'N/A';
                                aError.push('7', '[0]' + 'บาร์โค้ดไม่ได้ระบุข้อมูล' + 'N/A');
                            } else {
                                if (aJSONData[j][0].length > 25) {
                                    var tValueOld = aJSONData[j][0];
                                    aJSONData[j][0] = aJSONData[j][0].substring(0, 25);
                                    aError.push('4', '[0]' + 'บาร์โค้ดยาวเกินกำหนด');
                                }
                            }
                        } else {
                            aJSONData[j][0] = 'N/A';
                            aError.push('4', '[0]' + 'บาร์โค้ดยาวเกินกำหนด');
                        }

                        //Template_Filed_จำนวน
                        if (typeof(aJSONData[j][1]) != 'undefined' || null) {
                            if (aJSONData[j][1] == null) {
                                aJSONData[j][1] = '0';
                            } else {
                                var Letters = /^[ก-๛A-Za-z]+$/;
                                var nValue = aJSONData[j][1].toString();
                                var nValue = nValue.replace(" ", "");
                                if (nValue.match(Letters)) {
                                    //เอาตัวที่ผิดออก
                                    var tValueOld = aJSONData[j][1];
                                    aJSONData[j].pop();
                                    aJSONData[j].push(0);
                                    aError.push('3', '[1]' + 'รูปแบบจำนวนผิด');
                                }
                            }
                        } else {
                            aJSONData[j][1] = '0';
                        }
                        //ถ้าผ่านทุกอัน
                        if (aError.length > 0) {
                            aJSONData[j].push(aError[0], aError[1]);
                            aError = [];
                        } else {
                            aJSONData[j].push('1', '');
                        }
                        ///////////////////////////////////////////// DATATYPE
                    }
                break;
            }


            // ถ้า = 1 จะมี pop-up แจ้งเตือนว่า ข้อมูลทั้งหมด
            // ถ้าเป็นเอกสาร ต้องเเจ้งเตือนว่า ข้อมูลทั้งหมดใน Tmp จะถูกเคลียร์ 
            var tTypeModule     = $('#ohdImportTypeModule').val();
            var tFlagClearTmp   = $('#ohdImportClearTempOrInsCon').val();
            var tImportDocumentNo = $('#ohdImportDocumentNo').val();
            var tImportFrmBchCode = $('#ohdImportFrmBchCode').val();
            var tImportSplVatRate = $('#ohdImportSplVatRate').val();
            var tImportSplVatCode = $('#ohdImportSplVatCode').val();
            
            console.log(aJSONData);
            if(tTypeModule == 'document' && tFlagClearTmp == 1){
                $('#odvModalImportFile').modal('hide');

                setTimeout(function(){ 
                    $('#odvModalDialogClearData').modal('show'); 
                }, 1000);

                $('#obtConfirmDeleteBeforeInsert').off();
                $('#obtConfirmDeleteBeforeInsert').on("click", function() {
                    JSxProcessImportExcel(aJSONData,tNameModule,tTypeModule,tFlagClearTmp,tImportDocumentNo,tImportFrmBchCode,tImportSplVatRate,tImportSplVatCode);
                });
            }else{
                JSxProcessImportExcel(aJSONData,tNameModule,tTypeModule,tFlagClearTmp,tImportDocumentNo,tImportFrmBchCode,tImportSplVatRate,tImportSplVatCode);
            }

        }
        r.readAsBinaryString(f);
    } else {
        console.log("Failed to load file");
    }
}

function processExcel(data) {
    var workbook = XLSX.read(data, {
        type: 'binary'
    });

    var firstSheet = workbook.SheetNames[0];
    var data = to_json(workbook);
    return data
};

function to_json(workbook) {
    var result = {};
    workbook.SheetNames.forEach(function(sheetName) {
        var roa = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName], {
            header: 1
        });
        if (roa.length) result[sheetName] = roa;
    });
    return JSON.stringify(result, 2, 2);
};

//ฟังก์ชั่นสำหรับ import excel -> controller -> modal
function JSxProcessImportExcel(aJSONData,tNameModule,tTypeModule,tFlagClearTmp,tImportDocumentNo,tImportFrmBchCode,tImportSplVatRate,tImportSplVatCode){
    $.ajax({
        type		: "POST",
        url			: "ImportFileExcel",
        data		: {  'aPackdata' : aJSONData , 
                         'tNameModule' : tNameModule ,
                         'tTypeModule' :tTypeModule , 
                         'tFlagClearTmp' : tFlagClearTmp ,
                         'tImportDocumentNo' : tImportDocumentNo ,
                         'tImportFrmBchCode' : tImportFrmBchCode,
                         'tImportSplVatRate' : tImportSplVatRate ,
                         'tImportSplVatCode' : tImportSplVatCode ,
                        },
        async       : false,
        success	: function (aResult) {
            // console.log(aResult);
            if($('#ohdImportTypeModule').val().toString() == "master"){
                //ถ้าเป็นหน้าจอมาสเตอร์ จะโหลด HTML มา
                var tRouteMaster = $('#ohdImportAfterRoute').val();
                JSxRenderHTMLForImport(tNameModule,tRouteMaster);
                if(tNameModule=='product'){
                    JSxIMPUploadFileTmp();
                    $('#obtIMPCheckTemp').show();
                }
            }else{
                //ถ้าเป็นเอกสาร จะรับมาเป็น nextFunc
                $('#odvModalImportFile').modal('hide');
                setTimeout(function () {
                    var tNextFunc = $('#ohdImportAfterRoute').val();
                    if(tNextFunc!=''){
                        return window[tNextFunc](aResult);
                    }
                }, 500);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('ERROR');
            JCNxCloseLoading();
        }
    });
}

//ไฟล์ผิด รุปแบบผิดพลาด
function JSxFileFailFormat(){
    JCNxCloseLoading();
    $('#odvContentRenderHTMLImport').html('<div class="xCNImportBefore"><label>'+$('#ohdImportExcel').val()+'</label></div>');
}

//---------------------------------------------------------------------------- END Import File ---------------------------------------------------------------------------//

// $('#odvModalImportFile').modal('show');
// JSxRenderHTMLForImport('','productPageImportDataTable');
// $('#odvModalImportFile .modal-dialog').css({
//     'width' : '80%', 
//     'top'   : '5%'
// });
function JSxRenderHTMLForImport(ptNameModule,ptRouteMaster){
    $.ajax({
        type		: "POST",
        url			: ptRouteMaster,
        data		: {},
        async       : false,
        success	: function (tHTML){
            $('#odvContentRenderHTMLImport').html(tHTML);   // นำ DataTable มาวางทับ
            $('#obtIMPConfirm').show();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('JSxRenderHTMLForImport ERROR');
            JCNxCloseLoading();
        }
    });
}


//กดตรวจสอบ
$('#obtIMPCheckTemp').off();
$('#obtIMPCheckTemp').on('click',function(){
    JSxPDTImportCheckData();
});


//ย้ายจากข้อมูล Tmp ลง Master
function JSxPDTImportCheckData(){

    $.ajax({
        type    : "POST",
        url     : "pdtReCheckPdtBarDup",
        cache   : false,
        timeout : 0,
        success : function(oResult){
            var aReturn = JSON.parse(oResult);
            if(aReturn['rtCode']=='1'){
                JSxRenderHTMLForImport('','productPageImportDataTable');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            JCNxResponseError(jqXHR, textStatus, errorThrown);
        }
    });

}


function JSxIMPUploadFileTmp(){
    let formData = new FormData()
    var oFile = $('#oefFileImportExcel').prop('files')[0];
    formData.append('oFile', oFile);

    $.ajax({
        url: 'pdtUploadExcelPhp',
        method: 'POST',
        contentType: false,
        processData: false,
        data: formData,
        success: function(res){
             console.log('successfully');
            var aReturn = JSON.parse(res);
            if(aReturn['rtCode']=='1'){
            JSxIMPModifiExcelPdtErr();
            }
        },
        error: function(){
            console.log('error')
        }
    });

}


function JSxIMPModifiExcelPdtErr(){
    $.ajax({
        url: 'pdtModifiExcelPdtErr',
        method: 'POST',
        success: function(res){
            console.log(res);
            var aReturn = JSON.parse(res);
            if(aReturn['rtCode']=='1'){
             $('#oahDowloadModifiTemplate').attr('href',aReturn['rtDesc']);
             $('#oahDowloadModifiTemplate').show();
            }
        },
        error: function(){
            console.log('error')
        }
    });

}
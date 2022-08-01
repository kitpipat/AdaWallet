/**
 * Functionality : Display message from Rabbit MQ
 * Parameters : Object format
 * Creator : 22/02/2019 piya
 * Last Modified : -
 * Return : status
 * Return Type : string
 // MQ Message Config
    var poDocConfig = {
        tLangCode: tLangCode,
        tUsrBchCode: tUsrBchCode,
        tUsrApv: tUsrApv,
        tDocNo: tDocNo,
        tPrefix: tPrefix,
        tStaDelMQ: tStaDelMQ,
        tStaApv: tStaApv,
        tQName: tQName
    };

    // RabbitMQ STOMP Config
    var poMqConfig = {
        host: 'ws://202.44.55.94:15674/ws',
        username: 'Pandora_PPT1',
        password: 'Pandora_PPT1',
        vHost: 'Pandora_PPT1'
    };

    // Update Status Delete Qname
    var poUpdateStaDelQnameParams = {
        ptDocTableName : "TFNTCrdTopUpHD",
        ptDocFieldDocNo: "FTCthDocNo",
        ptDocFieldStaApv: "FTCthStaPrcDoc",
        ptDocFieldStaDelMQ: "",
        ptDocStaDelMQ: "1",
        ptDocNo : tDocNo
    };

    // Callback function
    CallPageEdit, CallPageList
*/
function FSxCMNRabbitMQMessage(poDocConfig, poRabbitMQConfig, poUpdateStaDelQnameParams, poCallback) {
    console.log('poDocConfig: ', poDocConfig);
    console.log('poRabbitMQConfig: ', poRabbitMQConfig);
    console.log('poUpdateStaDelQnameParams: ', poUpdateStaDelQnameParams);
    console.log('poCallback: ', poCallback);
    // Delete Queue Name Parameter
    var poDelQnameParams = {
        "ptPrefixQueueName": poDocConfig.tPrefix,
        "ptBchCode": "",
        "ptDocNo": poDocConfig.tDocNo,
        "ptUsrCode": poDocConfig.tUsrApv,
        "ptDocConfig": JSON.stringify(poDocConfig)
    };

    var tDialogHeader = $('#ohdSystemIsInProgress').val();
    var tProgress = '0';
    var tButtonLabel = $('#ohdHideProcessProgress').val();
    var tButtonLabelDone = $('#ohdHideProcessProgressDone').val();
    // console.log('Session: ', sessionStorage.getItem(poDocConfig.tQName));
    var tProgressBreak = sessionStorage.getItem(poDocConfig.tQName) == null ? '0' : sessionStorage.getItem(poDocConfig.tQName);
    if (poDocConfig['tProgress'] != undefined && (poDocConfig['tProgress']=="Bar" || poDocConfig['tProgress']=="BarDoc")) {

    }else {
      FSxCMNSetMsgInfoMessageDialog(tDialogHeader, 'กำลังประมวลผล...', tButtonLabel, tProgressBreak, '');
    }
    sessionStorage.setItem('StaFalseCout',0);

    oGetResponse = setInterval(function() {
        $.ajax({
            url: 'GetMassageQueue',
            type: 'POST',
            data: {
                tDocConfig: JSON.stringify(poDocConfig),
                tQName: poDocConfig.tQName
            },
            success:function(res){
                try {
                    /*if(res.trim() == false || res.trim() == 'false'){
                        console.log('CASE 1 รูปแบบโครงสร้างไม่ถูกต้อง')
                    }else if(res.trim() != '100'){
                        console.log('CASE 2 รอรับระหว่าง 1 - 99')
                        FSxCMNSetMsgInfoMessageDialog(tDialogHeader, res.trim(), tButtonLabel, res.trim(), '');
                        sessionStorage.setItem(poDocConfig.tQName, res.trim());
                    }else if(res.trim() == '100') {
                        console.log('CASE 3 ครบ 100')
                        FSMSxGStopCalling();
                        $('#odvModalInfoMessage button').text(tButtonLabelDone);
                        tProgress = res.trim();
                        FSxCMNRabbitMQDeleteQname(poDelQnameParams);
                        FSxCMNRabbitMQUpdateStaDeleteQname(poUpdateStaDelQnameParams);

                        //เมื่อ 100% ให้ปิด modal เลย
                        //Added By Napat(Jame) 31/03/63
                        setTimeout(function(){
                            $('#odvModalInfoMessage').modal('hide');
                            var tCallbackPageEdit = poCallback.tCallPageEdit + "('" + poDocConfig.tDocNo + "');";
                            eval(tCallbackPageEdit);
                        }, 1000);
                    }*/
                    if(res.trim() == 'Fail'){
                        FSMSxGStopCalling();
                        FSMxGCheckDocHdStaPrc(poUpdateStaDelQnameParams,poCallback,2);
                    }
                    if(res.trim() == false || res.trim() == 'false'){
                        // delay(3000);
                       var nStaFlaseCount = sessionStorage.getItem('StaFalseCout');
                       console.log('False Round '+nStaFlaseCount);
                       nStaFlaseCount++;
                        sessionStorage.setItem('StaFalseCout',nStaFlaseCount);
                        if(nStaFlaseCount>=5){
                            FSMSxGStopCalling();

                            FSMxGCheckDocHdStaPrc(poUpdateStaDelQnameParams,poCallback,1);
                           
                        }
                        if (poDocConfig['tProgress'] != undefined && (poDocConfig['tProgress']=="Bar" || poDocConfig['tProgress']=="BarDoc")) {
                            FSMSxGStopCalling();
                            JSvCallPageSpaEdit();
                        }
                    }else if(res.trim() != 'end'){
                      if (poDocConfig['tProgress'] != undefined && (poDocConfig['tProgress']=="Bar" || poDocConfig['tProgress']=="BarDoc")) {
                        var aResult =  JSON.parse(res);
                        var tProg = "";


                        if (poDocConfig['tProgress']=="Bar") {
                          if (res['rtSyncStaPrc']==2) {
                              tProg+='<span class="label label-danger">Error</span>';
                          }else {
                              tProg+='<div class="progress-bar" role="progressbar" style="width: '+aResult['rnSynProgress']+'%;" aria-valuenow="'+aResult['rnSynProgress']+'" aria-valuemin="0" aria-valuemax="100">'+aResult['rnSynProgress']+'%</div>';
                          }
                          $("#otdAUD"+aResult['rtSynTable']+"").html(tProg);
                        }else {
                          if (aResult['rtStaPrc']=="1") {
                            $("#otdAUDDoc"+aResult['rtDocNo']+"").html("สำเร็จ");
                          }else {
                            $("#otdAUDDoc"+aResult['rtDocNo']+"").html("ไม่สำเร็จ");
                          }

                        }
                      }else {
                        FSxCMNSetMsgInfoMessageDialog(tDialogHeader, res.trim(), tButtonLabel, res.trim(), '');
                        sessionStorage.setItem(poDocConfig.tQName, res.trim());
                      }

                    }

                    if (res.trim() == '100' || res.trim() == 'end') {
                        FSMSxGStopCalling();
                        $('#odvModalInfoMessage button').text(tButtonLabelDone);
                        tProgress = res.trim();

                        FSxCMNRabbitMQDeleteQname(poDelQnameParams);
                        if(poUpdateStaDelQnameParams['ptDocFieldStaDelMQ'] != ''){
                            FSxCMNRabbitMQUpdateStaDeleteQname(poUpdateStaDelQnameParams);
                        }

                        // เมื่อ 100% ให้ปิด modal เลย
                        // Added By Napat(Jame) 31/03/63
                        setTimeout(function(){
                            $('#odvModalInfoMessage').modal('hide');
                            var tCallbackPageEdit = poCallback.tCallPageEdit + "('" + poDocConfig.tDocNo + "');";
                            eval(tCallbackPageEdit);
                        }, 1000);
                    }

                } catch (err) {
                    console.log("Listening rabbit mq server: ", err);
                }
            }
        });

    }, 1000); // 10000 milliseconds = 10 seconds


    // Close Popup Event
    $('#odvModalInfoMessage button').unbind('click');
    $('#odvModalInfoMessage button').bind('click', function () {
        FSMSxGStopCalling();
        console.log('tProgressBreak: ', sessionStorage.getItem(poDocConfig.tQName));
        var tProgressBreak = sessionStorage.getItem(poDocConfig.tQName);
        if (tProgressBreak == '100') {
            sessionStorage.removeItem(poDocConfig.tQName);
            var tCallbackPageEdit = poCallback.tCallPageEdit + "('" + poDocConfig.tDocNo + "');";
            eval(tCallbackPageEdit);
        } else {
          if (poDocConfig['tProgress'] != undefined && (poDocConfig['tProgress']=="Bar" || poDocConfig['tProgress']=="BarDoc" )) {
          }else {
            var tCallbackPageList = poCallback.tCallPageList + "('');";
            eval(tCallbackPageList);
          }

        }
    });



}

function FSMSxGStopCalling() {
    clearInterval(oGetResponse);
}


// 25/08/2020 Napat(Jame) เลิกใช้ฟังค์ชั่น
// function FSxCMNRabbitMQMessageTestForTwx(poDocConfig, poRabbitMQConfig, poUpdateStaDelQnameParams, poCallback) {
//     console.log('poDocConfig: ', poDocConfig);
//     console.log('poRabbitMQConfig: ', poRabbitMQConfig);
//     console.log('poUpdateStaDelQnameParams: ', poUpdateStaDelQnameParams);
//     console.log('poCallback: ', poCallback);
//     // Delete Queue Name Parameter
//     var poDelQnameParams = {
//         "ptPrefixQueueName": poDocConfig.tPrefix,
//         "ptBchCode": "",
//         "ptDocNo": poDocConfig.tDocNo,
//         "ptUsrCode": poDocConfig.tUsrApv
//     };

//     var tDialogHeader = $('#ohdSystemIsInProgress').val();
//     var tProgress = '0';
//     var tButtonLabel = $('#ohdHideProcessProgress').val();
//     console.log('Session: ', sessionStorage.getItem(poDocConfig.tQName));
//     var tProgressBreak = sessionStorage.getItem(poDocConfig.tQName) == null ? '0' : sessionStorage.getItem(poDocConfig.tQName);
//     FSxCMNSetMsgInfoMessageDialog(tDialogHeader, 'กำลังประมวลผล...', tButtonLabel, tProgressBreak, '');
//     // Listening rabbit mq server
//     var oClient = Stomp.client(poRabbitMQConfig.host);
//     // oClient.debug = (res) => {};
//     // var oClient = Stomp.client('ws://' + window.location.hostname + ':15674/ws');
//     var on_connect = function (x) {
//         oClient.subscribe(poDocConfig.tQName, function (res) {
//             // oClient.subscribe("/exchange/ResCardNew", function (res) {
//             try {
//                 console.log("Data: ", res);
//                 // var oData = JSON.parse(res.body);
//                 FSxCMNSetMsgInfoMessageDialog(tDialogHeader, res.body, tButtonLabel, res.body, '');

//                 sessionStorage.setItem(poDocConfig.tQName, res.body);

//                 console.log(res.body == '100');
//                 if (res.body == '100') {
//                     tProgress = res.body;
//                     oClient.disconnect();

//                     console.log("Delete Q");

//                     FSxCMNRabbitMQDeleteQname(poDelQnameParams);
//                     FSxCMNRabbitMQUpdateStaDeleteQname(poUpdateStaDelQnameParams);

//                     //เมื่อ 100% ให้ปิด modal เลย
//                     //Added By Napat(Jame) 31/03/63
//                     setTimeout(function(){
//                         $('#odvModalInfoMessage').modal('hide');
//                         var tCallbackPageEdit = poCallback.tCallPageEdit + "('" + poDocConfig.tDocNo + "');";
//                         eval(tCallbackPageEdit);
//                     }, 1000);
//                 }
//                 // oClient.send(tQName, {"content-type": "text/plain"}, res.body);
//             } catch (err) {
//                 console.log("Listening rabbit mq server: ", err);
//             }
//         });
//     };
//     var on_error = function () {
//         console.log('error');
//     };

//     // Close Popup Event
//     $('#odvModalInfoMessage button').unbind('click');
//     $('#odvModalInfoMessage button').bind('click', function () {
//         console.log('tProgressBreak: ', sessionStorage.getItem(poDocConfig.tQName));
//         var tProgressBreak = sessionStorage.getItem(poDocConfig.tQName);
//         if (tProgressBreak == '100') {
//             var tCallbackPageEdit = poCallback.tCallPageEdit + "('" + poDocConfig.tDocNo + "');";
//             eval(tCallbackPageEdit);
//         } else {
//             oClient.disconnect();
//             sessionStorage.removeItem(poDocConfig.tQName);
//             var tCallbackPageList = poCallback.tCallPageList + "('');";
//             eval(tCallbackPageList);
//         }
//     });

//     oClient.connect(poRabbitMQConfig.username, poRabbitMQConfig.password, on_connect, on_error, poRabbitMQConfig.vHost);
// }

/**
 * Functionality : Delete queue chanel by name
 * Parameters : Object format
 * Creator : 22/02/2019 piya
 * Last Modified : -
 * Return : status
 * Return Type : string
 {
    "ptPrefixQueueName" : "",
    "ptBchCode" : "",
    "ptDocNo" : "",
    "ptUsrCode" : ""
}
*/
function FSxCMNRabbitMQDeleteQname(poParams) {
    $.ajax({
        type: "POST",
        url: 'RabbitMQDeleteQname',
        cache: false,
        data: {
            tPrefixQname: poParams.ptPrefixQueueName,
            ptDocNo: poParams.ptDocNo,
            ptUsrCode: poParams.ptUsrCode,
            ptBchCode: poParams.ptBchCode,
            tDelQnameParam: poParams.ptDocConfig
        },
        dataType: "JSON",
        success: function (tResult) {
            console.log(tResult);
        },
        timeout: 3000,
        error: function (err) {
            console.log(err);
        }
    });
}

/**
 * Functionality : Delete queue chanel by name
 * Parameters : Object format
 * Creator : 22/02/2019 piya
 * Last Modified : -
 * Return : status
 * Return Type : string
 {
    "ptDocTableName" : "",
    "ptDocFieldDocNo" : "",
    "ptDocFieldStaApv" : "",
    "ptDocFieldStaDelMQ" : "",
    "ptDocStaDelMQ" : "",
    "ptDocNo" : ""
}
*/
function FSxCMNRabbitMQUpdateStaDeleteQname(poParams) {

    $.ajax({
        type: "POST",
        url: 'RabbitMQUpdateStaDeleteQname',
        cache: false,
        data: {
            ptDocTableName: poParams.ptDocTableName,
            ptDocFieldDocNo: poParams.ptDocFieldDocNo,
            ptDocFieldStaApv: poParams.ptDocFieldStaApv,
            ptDocFieldStaDelMQ: poParams.ptDocFieldStaDelMQ,
            ptDocStaDelMQ: poParams.ptDocStaDelMQ,
            ptDocNo: poParams.ptDocNo
        },
        dataType: "JSON",
        success: function (tResult) {
            console.log(tResult);
        },
        timeout: 3000,
        error: function (err) {
            console.log(err);
        }
    });
}




function FSMxGCheckDocHdStaPrc(poParams,poCallback,nType){
    $.ajax({
        type: "POST",
        url: 'RabbitMQCheckDocHdStaPrc',
        cache: false,
        data: {
            ptDocTableName: poParams.ptDocTableName,
            ptDocFieldDocNo: poParams.ptDocFieldDocNo,
            ptDocFieldStaApv: poParams.ptDocFieldStaApv,
            ptDocFieldStaDelMQ: poParams.ptDocFieldStaDelMQ,
            ptDocStaDelMQ: poParams.ptDocStaDelMQ,
            ptDocNo: poParams.ptDocNo
        },
        dataType: "JSON",
        success: function (tResult) {
            // console.log(tResult);
            $('#odvModalInfoMessage').modal('hide');
            if(tResult['rtCode']=='2'){
                if(nType==1){
                    var tMassage = '<p class="text-left"> '+$('#ohdTextAlterRabbitMQWaring').val()+' </p>';
                }else{
                    var tMassage = '<p class="text-left"> เกิดข้อผิดพลาด กรุณาติดต่อผู้ดูแลระบบ </p>';
                }
                FSvCMNSetMsgWarningDialog(tMassage);
                var tCallbackPageList = poCallback.tCallPageList + "('');";
                eval(tCallbackPageList);
            }else if(tResult['rtCode']=='1'){
                var tCallbackPageList = poCallback.tCallPageList + "('');";
                eval(tCallbackPageList);
            }else{
                FSvCMNSetMsgWarningDialog(tResult['rtDesc']);
            }
        },
        timeout: 3000,
        error: function (err) {
            console.log(err);
        }
    });
}
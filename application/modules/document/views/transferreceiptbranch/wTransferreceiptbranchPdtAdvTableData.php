<style>
    .xCNBTNPrimeryDisChgPlus{
        border-radius: 50%;
        float: left;
        width: 20px;
        height: 20px;
        line-height: 20px;
        background-color: #1eb32a;
        text-align: center;
        margin-top: 6px;
        /* margin-right: -15px; */
        font-size: 22px;
        color: #ffffff;
        cursor: pointer;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        -o-border-radius: 50%;
    }
</style>
<div class="col-md-12">
    <div class="table-responsive xCNTablescroll">
        <input type="text" class="xCNHide" id="ohdBrowseDataPdtCode" value="">
        <input type="text" class="xCNHide" id="ohdBrowseDataPunCode" value="">
        <input type="text" class="xCNHide" id="ohdEditInlinePdtCode" value="<?php echo $tTBIPdtCode;?>">
        <input type="text" class="xCNHide" id="ohdEditInlinePunCode" value="<?php echo $tTBIPunCode;?>">
        <table id="otbTbxDocPdtAdvTableList" class="table xWPdtTableFont">
            <thead>
                <tr class="xCNCenter">
                    <th nowrap><?php echo language('document/document/document','tDocChoose')?></th>
                    <th nowrap><?php echo language('document/document/document','tDocNumber')?></th>
                    <?php foreach($aColumnShow as $HeaderColKey => $HeaderColVal):?>
                        <th  title="<?php echo iconv_substr($HeaderColVal->FTShwNameUsr, 0,30,"UTF-8");?>">
                            <?php echo iconv_substr($HeaderColVal->FTShwNameUsr, 0,30, "UTF-8");?>
                        </th>
                    <?php endforeach;?>
                    <th nowrap class="xCNTextBold xPIImportDT" style="display:none"><?php echo language('document/purchaseorder/purchaseorder','tPOLabelFrmInfoOthRemark')?></th>
                    <th nowrap class="xCNPIBeHideMQSS"><?php echo language('document/document/document','tDocDelete');?></th>
                </tr>
            </thead>
            <tbody id="odvTBodyPIPdtAdvTableList">
                <?php
                    if($aDataDocDTTemp['rtCode'] == 1):
                    foreach($aDataDocDTTemp['raItems'] as $DataTableKey => $aDataTableVal):

                        $nKey = $aDataTableVal['FNXtdSeqNo'];
                        $tUnixPdtCodeRow = $aDataTableVal['FTPdtCode'].$aDataTableVal['FTXtdBarCode'];
                        $tUnixPdtCodeRow = str_replace(' ', '', $tUnixPdtCodeRow);
                        $tUnixPdtCodeRow = preg_replace('/[^a-z0-9\_\- ]/i', '', $tUnixPdtCodeRow);
                ?>
                        <tr class="otr<?=$tUnixPdtCodeRow;?> xWPdtItem xWPdtItemList<?=$nKey?>"
                            data-index="<?php echo $aDataTableVal['rtRowID'];?>"
                            data-docno="<?php echo $aDataTableVal['FTXthDocNo'];?>"
                            data-pdtcode="<?php echo $aDataTableVal['FTPdtCode'];?>"
                            data-pdtname="<?php echo $aDataTableVal['FTXtdPdtName'];?>"
                            data-puncode="<?php echo $aDataTableVal['FTPunCode'];?>"
                            data-qty="<?php echo $aDataTableVal['FCXtdQty'];?>"
                            data-setprice="<?php echo number_format($aDataTableVal['FCXtdSetPrice'],2);?>"
                            data-stadis=""
                            data-netafhd="<?php echo number_format(0,2);?>"
                            data-alwvat="<?php echo $aDataTableVal['FTXtdVatType'];?>"
                            data-vat="<?php echo $aDataTableVal['FCXtdVatRate']?>"
                            data-net="<?php echo number_format($aDataTableVal['FCXtdNet'],2);?>"
                            data-key="<?=$nKey?>"
                            data-seqno="<?=$nKey?>"
                            style="background-color: rgb(255, 255, 255);"
                        >
                            <td nowrap align="center">
                                <label class="fancy-checkbox">
                                    <input id="ocbListItem<?=$nKey?>" type="checkbox" class="ocbListItem" name="ocbListItem[]" onclick="FSxTBISelectMulDel(this)">
                                    <span class="ospListItem">&nbsp;</span>
                                </label>
                            </td>
                            <td nowrap align="center"><?=$aDataTableVal['rtRowID']?></td>
                            <td nowrap><?=$aDataTableVal['FTPdtCode'];?></td>
                            <td nowrap><?=$aDataTableVal['FTXtdPdtName'];?></td>
                            <td nowrap><?=$aDataTableVal['FTXtdBarCode'];?></td>
                            <td nowrap><?=$aDataTableVal['FTPunName'];?></td>
                            <td class="otdQty" align="right">
                                <div class="xWEditInLine<?=$nKey?>">
                                <?php if( $aDataTableVal['FTTmpStatus'] != 5 ){ ?>
                                    <input type="text" class="xCNQty form-control xCNInputNumericWithDecimal xCNPdtEditInLine text-right xWValueEditInLine<?=$nKey?> xWShowInLine<?=$nKey?> " id="ohdQty<?=$nKey?>" name="ohdQty<?=$nKey?>" data-seq="<?=$nKey?>" maxlength="10" value="<?=str_replace(",","",number_format($aDataTableVal['FCXtdQty'],$nOptDecimalShow));?>" autocomplete="off">
                                    <?php }else{ ?>
                                    <?php
                                        if( (empty($tTBIStaApv) && $tTBIStaDoc != 3) ){
                                            $tClassName = 'xCNTextLink';
                                            $tIconEdit = " <img class='xCNIconTable' src=".base_url('application/modules/common/assets/images/icons/edit.png')." title='Edit'>";
                                        }else{
                                            $tClassName = 'xCNTextLink';
                                            $tIconEdit  = "";
                                        }
                                        $aOptionFashion = array(
                                        'tDocumentBranch'     => $aDataTableVal['FTBchCode'],
                                        'tDocumentNumber'     => $aDataTableVal['FTXthDocNo'],
                                        'tDocumentProduct'    => $aDataTableVal['FTPdtCode'],
                                        'tDocumentDocKey'     => 'TCNTPdtTbiHD',
                                        'nDTSeq'              => $aDataTableVal['FNXtdSeqNo'],
                                        'tDTBarCode'          => $aDataTableVal['FTXtdBarCode'],
                                        'tDTPunCode'          => $aDataTableVal['FTPunCode'],
                                        'tNextFunc'           => 'FSvTBIPDTEditPdtIntoTableDT',
                                        'tSpcControl'         => 0,                    //0:??????????????? //1:???????????????????????????????????????????????????????????? //2:?????????????????????????????????????????????????????? //3:?????????????????????????????????
                                        'tStaEdit'            => ( $tTBIStaApv == '1' || $tTBIStaDoc == '3' ? '2' : '1' )
                                        );
                                        // $aOption = json_encode($aOptionFashion);
                                    ?>
                                    <label class="<?=$tClassName?> xCNPdtFont xWShowInLine" 
                                        tDocumentBranch="<?=$aOptionFashion['tDocumentBranch']?>" 
                                        tDocumentNumber="<?=$aOptionFashion['tDocumentNumber']?>"  
                                        tDocumentProduct="<?=$aOptionFashion['tDocumentProduct']?>"  
                                        tDocumentDocKey="<?=$aOptionFashion['tDocumentDocKey']?>"  
                                        nDTSeq="<?=$aOptionFashion['nDTSeq']?>"  
                                        tDTBarCode="<?=$aOptionFashion['tDTBarCode']?>"  
                                        tDTPunCode="<?=$aOptionFashion['tDTPunCode']?>"  
                                        tNextFunc="<?=$aOptionFashion['tNextFunc']?>"  
                                        tSpcControl="<?=$aOptionFashion['tSpcControl']?>"  
                                        tStaEdit="<?=$aOptionFashion['tStaEdit']?>"  
                                       onclick='JSxUpdateProductSerialandFashion(this)' ><span class="xCNQtyFhn"><?=number_format($aDataTableVal['FCXtdQty'],$nOptDecimalShow)?></span> <?=$tIconEdit?></label>
                                    <input type="hidden" class="xCNQty form-control xCNInputNumericWithDecimal xCNPdtEditInLine text-right xWValueEditInLine<?=$nKey?> xWShowInLine<?=$nKey?> " id="ohdQty<?=$nKey?>" name="ohdQty<?=$nKey?>" data-seq="<?=$nKey?>" maxlength="10" value="<?=str_replace(",","",number_format($aDataTableVal['FCXtdQty'],$nOptDecimalShow));?>" autocomplete="off">
                                    <?php } ?>
                                </div>
                            </td>

                     
                            <!-- <td nowrap class="text-right">
                                <span id="ospGrandTotal<?=$nKey?>"><?=number_format($aDataTableVal['FCXtdNet'],2);?></span>
                                <span id="ospnetAfterHD<?=$nKey?>" style="display: none;"><?=number_format(0,2);?></span>
                            </td> -->


                            <td nowrap="" class="text-center xCNPIBeHideMQSS">
                                <label class="xCNTextLink">
                                    <img class="xCNIconTable" src="application/modules/common/assets/images/icons/delete.png" title="Remove" onclick="JSnTBIDelPdtInDTTempSingle(this)">
                                </label>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                     else:
                    ?>
                    <tr><td class="text-center xCNTextDetail2 xWTbxTextNotfoundDataPdtTable" colspan="100%"><?php echo language('common/main/main','tCMNNotFoundData')?></td></tr>
                <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
<?php if($aDataDocDTTemp['rnAllPage'] > 1) : ?>
    <!-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <p><?php echo language('common/main/main','tResultTotalRecord')?> <?php echo $aDataDocDTTemp['rnAllRow']?> <?php echo language('common/main/main','tRecord')?> <?php echo language('common/main/main','tCurrentPage')?> <?php echo $aDataDocDTTemp['rnCurrentPage']?> / <?php echo $aDataDocDTTemp['rnAllPage']?></p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="xWPagePIPdt btn-toolbar pull-right">
            <?php if($nPage == 1){ $tDisabledLeft = 'disabled'; }else{ $tDisabledLeft = '-';} ?>
            <button onclick="JSvPIPDTDocDTTempClickPage('previous')" class="btn btn-white btn-sm" <?php echo $tDisabledLeft ?>>
                <i class="fa fa-chevron-left f-s-14 t-plus-1"></i>
            </button>
            <?php for($i=max($nPage-2, 1); $i<=max(0, min($aDataDocDTTemp['rnAllPage'],$nPage+2)); $i++){?>
                <?php
                    if($nPage == $i){
                        $tActive = 'active';
                        $tDisPageNumber = 'disabled';
                    }else{
                        $tActive = '';
                        $tDisPageNumber = '';
                    }
                ?>
                <button onclick="JSvPIPDTDocDTTempClickPage('<?php echo $i?>')" type="button" class="btn xCNBTNNumPagenation <?php echo $tActive ?>" <?php echo $tDisPageNumber ?>><?php echo $i?></button>
            <?php } ?>
            <?php if($nPage >= $aDataDocDTTemp['rnAllPage']){  $tDisabledRight = 'disabled'; }else{  $tDisabledRight = '-';  } ?>
            <button onclick="JSvPIPDTDocDTTempClickPage('next')" class="btn btn-white btn-sm" <?php echo $tDisabledRight ?>>
                <i class="fa fa-chevron-right f-s-14 t-plus-1"></i>
            </button>
        </div>
    </div> -->
<?php endif;?>

<!-- ============================================ Modal Confirm Delete Documet Detail Dis ============================================ -->
    <div id="odvPIModalConfirmDeleteDTDis" class="modal fade" style="z-index: 7000;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header xCNModalHead">
                    <label class="xCNTextModalHeard"><?= language('common/main/main', 'tPIMsgNotificationChangeData') ?></label>
                </div>
                <div class="modal-body">
                    <label><?php echo language('document/purchaseinvoice/purchaseinvoice','tPIMsgTextNotificationChangeData');?></label>
                </div>
                <div class="modal-footer">
                    <button id="obtPIConfirmDeleteDTDis" type="button"  class="btn xCNBTNPrimery"  data-dismiss="modal"><?php echo language('common/main/main', 'tModalConfirm');?></button>
                    <button id="obtPICancelDeleteDTDis" type="button" class="btn xCNBTNDefult"  data-dismiss="modal"><?php echo language('common/main/main', '??????????????????');?></button>
                </div>
            </div>
        </div>
    </div>
<!-- ================================================================================================================================= -->

<!--??????????????????????????????????????????-->
<div id="odvModalDiscount" class="modal fade" tabindex="-1" role="dialog" style="max-width: 1500px; margin: 1.75rem auto; width: 85%;">
    <div class="modal-dialog" style="width: 100%;">
        <div class="modal-content">
            <!--?????????????????????-->
            <div class="modal-header">
                <h5 class="xCNHeardModal modal-title" style="display:inline-block">??????????????????/??????????????? ?????????????????????</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <!--??????????????????????????????-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="btn-group pull-right" style="margin-bottom: 20px; width: 300px;">
                            <button
                                type="button"
                                id="obtAddDisChg"
                                class="btn xCNBTNPrimery pull-right"
                                onclick="JCNvAddDisChgRow()"
                                style="width: 100%;"><?=language('document/purchaseinvoice/purchaseinvoice','tPIMDAddEditDisChg') ?></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="table-responsive" style="min-height: 300px; max-height: 300px; overflow-y: scroll;">
                            <table id="otbDisChgDataDocHDList" class="table">
                                <thead>
                                    <tr class="xCNCenter">
                                        <th class="xCNTextBold"><?=language('document/purchaseinvoice/purchaseinvoice','tPIsequence')?></th>
                                        <th class="xCNTextBold"><?=language('document/purchaseinvoice/purchaseinvoice','tPIBeforereducing')?></th>
                                        <th class="xCNTextBold"><?=language('document/purchaseinvoice/purchaseinvoice','tPIValuereducingcharging')?></th>
                                        <th class="xCNTextBold"><?=language('document/purchaseinvoice/purchaseinvoice','tPIAfterReducing')?></th>
                                        <th class="xCNTextBold"><?=language('document/purchaseinvoice/purchaseinvoice','tPIType')?></th>
                                        <th class="xCNTextBold"><?=language('document/purchaseinvoice/purchaseinvoice','tPIDiscountcharge')?></th>
                                        <th class="xCNTextBold"><?=language('document/purchaseinvoice/purchaseinvoice','tPITBDelete')?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="otrDisChgHDNotFound"><td class="text-center xCNTextDetail2" colspan='100%'><?=language('common/main/main','tCMNNotFoundData')?></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--????????????????????????????????????????????????????????????-->
            <div class="modal-footer">
                <button type="button" class="btn xCNBTNDefult" data-dismiss="modal"><?=language('common/main/main','tCancel');?></button>
                <button onclick="JSxDisChgSave()" type="button" class="btn xCNBTNPrimery"><?=language('common/main/main','tCMNOK');?></button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo  base_url('application/modules/common/assets/js/jquery.mask.js')?>"></script>
<script src="<?php echo  base_url('application/modules/common/assets/src/jFormValidate.js')?>"></script>
<?php  include("script/jTransferReceiptbranchDataTable.php");?>

<script>

    $( document ).ready(function() {
        JSxAddScollBarInTablePdt();
        JSxRendercalculate();
        JSxEditQtyAndPrice();
        if($('#ohdTBIStaApv').val()==1){
            $('.xCNBTNPrimeryDisChgPlus').hide();
            $(".xCNIconTable").addClass("xCNDocDisabled");
            $(".xCNIconTable").attr("onclick", "").unbind("click");
            $('.xCNPdtEditInLine').attr('readonly',true);
            $('#obtPIBrowseSupplier').attr('disabled',true);
            $('.ocbListItem').attr('disabled',true);
        }

    });

    // Next Func ????????? Browse PDT Center
    function  FSvTBXNextFuncB4SelPDT(ptPdtData){
        var aPackData = JSON.parse(ptPdtData);
        console.log('Event Scan',aPackData);
        for(var i=0;i<aPackData.length;i++){
            var aNewPackData = JSON.stringify(aPackData[i]);
            var aNewPackData = "["+aNewPackData+"]";
            FSvTBIAddPdtIntoDocDTTempScan(aNewPackData);   // Append HMTL
            FSvTBIPDTAddPdtIntoTableDT(aNewPackData);   // Insert Database

            if((i+1)==aPackData.length){
                var oOptionForFashion = {
                    'bListItemAll'  : false,
                    'tSpcControl'  : 0,
                    'tNextFunc' : 'FSvTBIPDTAddPdtIntoTableDT'
                }
                JSxCheckProductSerialandFashion(aPackData,oOptionForFashion,'insert');
            }

        }

         
    }




    // Create By: Napat(Jame) 17/05/2021
    function FSvTBIPDTAddPdtIntoTableDT_PDTSerialorFashion(ptPdtDataFhn){
        console.log(ptPdtDataFhn);
            var aData = JSON.parse(ptPdtDataFhn);
            var ptXthDocNoSend = "";
            if ( $("#ohdTBIRoute").val() == "docTBIEventEdit" ) {
                ptXthDocNoSend = $("#oetTBIDocNo").val();
            }

            var tOptionAddPdt = $('#ocmTBIptionAddPdt').val();
            $.ajax({
                type: "POST",
                url: "docTBIEventAddPdtIntoDTFhnTemp",
                data: {
                    'tTBIDocNo'         : ptXthDocNoSend,
                    'tTBIPdtDataFhn'    : ptPdtDataFhn,
                    'tTBIBCH'           : $('#oetTBIBchCode').val(),
                    'tTBIType'          : 'PDT',
                    'nEvent'            : 1,
                    'tOptionAddPdt'     : tOptionAddPdt
                },
                cache: false,
                timeout: 0,
                success: function(oResult) {
                    if( aData['nStaLastSeq'] == '1' ){ //???????????????????????????????????????????????????????????????????????????????????????????????????????????? Table 
                        JSvTBILoadPdtDataTableHtml(1);
                    }
                },  
                error: function(jqXHR, textStatus, errorThrown) {
                    JCNxResponseError(jqXHR, textStatus, errorThrown);
                }
            });

    }



// Create By: Nattakit(Nale) 24/05/2021
function FSvTBIPDTEditPdtIntoTableDT_PDTSerialorFashion(ptPdtDataFhn){
    console.log(ptPdtDataFhn);
    var aData = JSON.parse(ptPdtDataFhn);
  var ptXthDocNoSend = "";
  if ( $("#ohdTBIRoute").val() == "docTBIEventEdit" ) {
      ptXthDocNoSend = $("#oetTBIDocNo").val();
  }
  var tOptionAddPdt = $('#ocmTBIptionAddPdt').val();
  $.ajax({
      type: "POST",
      url: "docTBIEventAddPdtIntoDTFhnTemp",
      data: {
          'tTBIDocNo'         : ptXthDocNoSend,
          'tTBIPdtDataFhn'    : ptPdtDataFhn,
          'tTBIBCH'           : $('#oetTBIBchCode').val(),
          'tTBIType'          : 'PDT',
          'nEvent'           : 2,
          'tOptionAddPdt'    : tOptionAddPdt
      },
      cache: false,
      timeout: 0,
      success: function(oResult) {
          if( aData['nStaLastSeq'] == '1' ){ //???????????????????????????????????????????????????????????????????????????????????????????????????????????? Table 
            JSvTBILoadPdtDataTableHtml(1);
          }
      },  
      error: function(jqXHR, textStatus, errorThrown) {
          JCNxResponseError(jqXHR, textStatus, errorThrown);
      }
  });

}


    // Append PDT
    function FSvTBIAddPdtIntoDocDTTempScan(ptPdtData){
        JCNxCloseLoading();
        var aPackData = JSON.parse(ptPdtData);
        var tCheckIteminTableClass = $('#otbTbxDocPdtAdvTableList tbody tr td').hasClass('xWTbxTextNotfoundDataPdtTable');

        if(tCheckIteminTableClass == true){
            $('#otbTbxDocPdtAdvTableList tbody').html('');
            var nKey    = 1;
        }else{
            var nKey    = parseInt($('#otbTbxDocPdtAdvTableList tr:last').attr('data-seqno')) + parseInt(1);
        }

        var nLen    = aPackData.length;
        var tHTML   = '';

        for(var i=0; i<nLen; i++){
            var oData           = aPackData[i];
            var oResult         = oData.packData;
            oResult.NetAfHD     = (oResult.NetAfHD == '' || oResult.NetAfHD === undefined ? 0 : oResult.NetAfHD);
            oResult.Qty         = (oResult.Qty == '' || oResult.Qty === undefined ? 1 : oResult.Qty);
            oResult.Net         = (oResult.Net == '' || oResult.Net === undefined ? oResult.Price : oResult.Net);
            oResult.tDisChgTxt  = (oResult.tDisChgTxt == '' || oResult.tDisChgTxt === undefined ? '' : oResult.tDisChgTxt);

            var tPdtforSys      = oResult.PDTSpc;          //????????????????????????????????????
            var tBarCode        = oResult.Barcode;          //????????????????????????
            var tProductCode    = oResult.PDTCode;          //??????????????????????????????
            var tProductName    = oResult.PDTName;          //??????????????????????????????
            var tPunCode        = oResult.PUNCode;          //???????????????????????????
            var tUnitName       = oResult.PUNName;          //?????????????????????????????????????????????
            var nPrice          = (parseFloat(accounting.unformat(oResult.Price))).toFixed(2);                                      //????????????
            var nAlwDiscount    = (oResult.AlwDis == '' || oResult.AlwDis === undefined ? 2 : oResult.AlwDis);           //??????????????????????????????????????????
            var nAlwVat         = (oResult.AlwVat == '' || oResult.AlwVat === undefined ? 0 : oResult.AlwVat);           //????????????????????????????????????????????????
            var nVat            = (parseFloat($('#ohdTbxVatRate').val())).toFixed(2);                               //???????????????????????????????????????????????????
            var nQty            = parseInt(oResult.Qty);             //???????????????
            var nNetAfHD        = (parseFloat(oResult.NetAfHD)).toFixed(2);
            var cNet            = (parseFloat(oResult.Net)).toFixed(2);
            var tDisChgTxt      = oResult.tDisChgTxt;
            var tUnixPdtCodeRow = tProductCode.toString()+tBarCode.toString();
            var tUnixPdtCodeRow = tUnixPdtCodeRow.replace(/\./g,' ').replace(/[ ,]+/g, "").replaceAll("[-+.^:,]","");

            var tDuplicate = $('#otbTbxDocPdtAdvTableList tbody tr').hasClass('otr'+tUnixPdtCodeRow);
            var InfoOthReAddPdt = $('#ocmTBIptionAddPdt').val();

            if(tDuplicate == true && InfoOthReAddPdt==1){
                //???????????????????????????????????? ?????????????????? Qty +1
                var nValOld     = $('.otr'+tUnixPdtCodeRow).find('.xCNQty').val();
                var nNewValue   = parseInt(nValOld) + parseInt(1);
                $('.otr'+tUnixPdtCodeRow).find('.xCNQty').val(nNewValue);
                $('.otr'+tUnixPdtCodeRow).find('.xCNQtyFhn').text(nNewValue.toFixed(2));
                
                var nGrandOld   = $('.otr'+tUnixPdtCodeRow).find('.xCNPrice').val();
                var nGrand      = parseInt(nNewValue) * parseFloat(nGrandOld);
                var nSeqOld     = $('.otr'+tUnixPdtCodeRow).find('.xCNPrice').attr('data-seq');
                $('#ospGrandTotal'+nSeqOld).text(numberWithCommas(nGrand.toFixed(2)));
            }else{
                //????????????????????????????????????????????? ????????????????????????????????????????????????
                if(nAlwDiscount == 1){ //???????????????????????????
                    var oAlwDis = ' <div class="xWPIDisChgDTForm">';
                    oAlwDis += '<button class="xCNBTNPrimeryDisChgPlus" onclick="JCNvPICallModalDisChagDT(this)" type="button">+</button>'; //JCNvDisChgCallModalDT(this)
                    oAlwDis += '<label class="xWDisChgDTTmp" style="padding-left: 5px;padding-top: 3px;" id="xWDisChgDTTmp'+nKey+'">'+tDisChgTxt+'</label>';
                    oAlwDis += '</div>';
                }else{
                    var oAlwDis = '?????????????????????????????????????????????????????????';
                }

                //????????????
                // var oPrice = '<div class="xWEditInLine'+nKey+'">';
                //     oPrice += '<input ';
                //     oPrice += 'type="text" ';
                //     oPrice += 'class="xCNPrice form-control xCNInputNumericWithDecimal xCNPdtEditInLine text-right xWValueEditInLine'+nKey+' "';
                //     oPrice += 'id="ohdPrice'+nKey+'" ';
                //     oPrice += 'name="ohdPrice'+nKey+'" ';
                //     oPrice += 'maxlength="10" ';
                //     oPrice += 'data-alwdis='+nAlwDiscount+' ';
                //     oPrice += 'data-seq='+nKey+' ';
                //     oPrice += 'value="'+nPrice+'"';
                //     oPrice += 'autocomplete="off" >';
                //     oPrice += '</div>';

                //???????????????
                if(tPdtforSys!='FH'){

                    var oQty = '<div class="xWEditInLine'+nKey+'">';
                        oQty += '<input ';
                        oQty += 'type="text" ';
                        oQty += 'class="xCNQty form-control xCNInputNumericWithDecimal xCNPdtEditInLine text-right xWValueEditInLine'+nKey+' xWShowInLine'+nKey+' "';
                        oQty += 'id="ohdQty'+nKey+'" ';
                        oQty += 'name="ohdQty'+nKey+'" ';
                        oQty += 'data-seq='+nKey+' ';
                        oQty += 'maxlength="10" ';
                        oQty += 'value="'+nQty+'"';
                        oQty += 'autocomplete="off" >';
                        oQty += '</div>';

                }else{
                        var tClassName = 'xCNTextLink';
                        var tIconEdit = " <img class='xCNIconTable' src='<?=base_url('application/modules/common/assets/images/icons/edit.png')?>' title='Edit'>";
                        var  aOptionFashion   = {
                            'tDocumentBranch' : $('#oetTBIBchCode').val(),
                            'tDocumentNumber' : $('#oetTBIDocNo').val(),
                            'tDocumentProduct' : tProductCode,
                            'tDocumentDocKey' : 'TCNTPdtTbiHD',
                            'nDTSeq' : nKey,
                            'tDTBarCode' : tBarCode,
                            'tDTPunCode' : tPunCode,
                            'tNextFunc' : 'FSvTBIPDTEditPdtIntoTableDT',
                            'tSpcControl' : 0 ,
                            'tStaEdit' : 1
                    }      
            //    var aNewPackData =  JSON.stringify(aOptionFashion);
            //    var aNewPackData = 'JSxUpdateProductSerialandFashion('+aNewPackData+')';
               var  oQty = '<div class="xWEditInLine'+nKey+'">';      
                    oQty +='<label class="'+tClassName+' xCNPdtFont xWShowInLine"';
                    oQty +=' tDocumentBranch="'+aOptionFashion.tDocumentBranch+'" ';
                    oQty +=' tDocumentNumber="'+aOptionFashion.tDocumentNumber+'"  ';
                    oQty +=' tDocumentProduct="'+aOptionFashion.tDocumentProduct+'"  ';
                    oQty +=' tDocumentDocKey="'+aOptionFashion.tDocumentDocKey+'"  ';
                    oQty +=' nDTSeq="'+aOptionFashion.nDTSeq+'"  ';
                    oQty +=' tDTBarCode="'+aOptionFashion.tDTBarCode+'"  ';
                    oQty +=' tDTPunCode="'+aOptionFashion.tDTPunCode+'"  ';
                    oQty +=' tNextFunc="'+aOptionFashion.tNextFunc+'"  ';
                    oQty +=' tSpcControl="'+aOptionFashion.tSpcControl+'"  ';
                    oQty +=' tStaEdit="'+aOptionFashion.tStaEdit+'"  ' ;
                    oQty +=' onclick="JSxUpdateProductSerialandFashion(this)" ><span class="xCNQtyFhn">'+nQty.toFixed(2)+'</span> '+tIconEdit+'</label>';
                    oQty += '<input  style="display:none" ';
                    oQty += 'type="text" ';
                    oQty += 'class="xCNQty form-control xCNInputNumericWithDecimal xCNPdtEditInLine text-right xWValueEditInLine'+nKey+' xWShowInLine'+nKey+' "';
                    oQty += 'id="ohdQty'+nKey+'" ';
                    oQty += 'name="ohdQty'+nKey+'" ';
                    oQty += 'data-seq='+nKey+' ';
                    oQty += 'maxlength="10" ';
                    oQty += 'value="'+nQty+'"';
                    oQty += 'autocomplete="off" >';
                    oQty += '</div>';
              }
      
                tHTML += '<tr class="otr'+tUnixPdtCodeRow+' xWPdtItem xWPdtItemList'+nKey+'"';
                tHTML += '  data-index="'+nKey+'"';
                tHTML += '  data-alwvat="'+nAlwVat+'"';
                tHTML += '  data-vat="'+nVat+'"';
                tHTML += '  data-seqno="'+nKey+'"';
                tHTML += '  data-key="'+nKey+'"';
                tHTML += '  data-pdtcode="'+tProductCode+'"';
                // tHTML += '  data-puncode="'+tProductCode+'"';
                tHTML += '  data-seqno="'+nKey+'"';
                tHTML += '  data-setprice="'+nPrice+'"';
                tHTML += '  data-qty="'+nQty+'"';
                tHTML += '  data-netafhd="'+nNetAfHD+'"';
                tHTML += '  data-net="'+cNet+'"';
                tHTML += '  data-stadis="'+nAlwDiscount+'"';

                tHTML += '>';
                tHTML += '<td align="center">';
                tHTML += '  <label class="fancy-checkbox">';
                tHTML += '      <input id="ocbListItem'+nKey+'" type="checkbox" class="ocbListItem" name="ocbListItem[]" onclick="FSxTBISelectMulDel(this)">';
                tHTML += '      <span class="ospListItem">&nbsp;</span>';
                tHTML += '  </label>';
                tHTML += '</td>';
                tHTML += '<td align="center">'+nKey+'</td>';
                tHTML += '<td>'+tProductCode+'</td>';
                tHTML += '<td>'+tProductName+'</td>';
                tHTML += '<td>'+tBarCode+'</td>';
                tHTML += '<td>'+tUnitName+'</td>';
                tHTML += '<td class="otdQty text-right" >'+oQty+'</td>';
                tHTML += '';
                // tHTML += '<td class="otdPrice">'+oPrice+'</td>';
                // tHTML += '<td>'+oAlwDis+'</td>';
                // tHTML += '<td class="text-right"><span id="ospGrandTotal'+nKey+'">'+cNet+'</span>';
                // tHTML += '    <span id="ospnetAfterHD'+nKey+'" style="display: none;">'+nNetAfHD+'</span>';
                // tHTML += '</td>';
                // if($('#ohdPIStaImport').val()==1){
                // tHTML += '<td class="xPIImportDT"> </td>';
                // }
                tHTML += '<td nowrap class="text-center xCNPIBeHideMQSS">';
                tHTML += '  <label class="xCNTextLink">';
                tHTML += '      <img class="xCNIconTable" src="application/modules/common/assets/images/icons/delete.png" title="Remove" onclick="JSnTBIDelPdtInDTTempSingle(this)">';
                tHTML += '  </label>';
                tHTML += '</td>';
                tHTML += '</tr>';
                nKey++;

            }
        }

        //??????????????????????????????
        $('#otbTbxDocPdtAdvTableList tbody').append(tHTML);

        JSxAddScollBarInTablePdt();
        JSxRendercalculate();
        JSxEditQtyAndPrice();

    }


    function FSxTBISelectMulDel(ptElm){

        let tTbxDocNo    = $('#oetTBIDocNo').val();
        let tTbxSeqNo    = $(ptElm).parents('.xWPdtItem').data('key');
        let tTbxPdtCode  = $(ptElm).parents('.xWPdtItem').data('pdtcode');
        let tTbxBarCode  = $(ptElm).parents('.xWPdtItem').data('barcode');
        // alert(1111);
        $(ptElm).prop('checked', true);
        let oLocalItemDTTemp    = localStorage.getItem("TBI_LocalItemDataDelDtTemp");
        let oDataObj            = [];
        if(oLocalItemDTTemp){
            oDataObj    = JSON.parse(oLocalItemDTTemp);
        }
        let aArrayConvert   = [JSON.parse(localStorage.getItem("TBI_LocalItemDataDelDtTemp"))];
        console.log(aArrayConvert);
        if(aArrayConvert == '' || aArrayConvert == null){
            oDataObj.push({
                'tDocNo'    : tTbxDocNo,
                'tSeqNo'    : tTbxSeqNo,
                'tPdtCode'  : tTbxPdtCode,
                'tBarCode'  : tTbxBarCode,
            });
            localStorage.setItem("TBI_LocalItemDataDelDtTemp",JSON.stringify(oDataObj));
            JSxTBITextInModalDelPdtDtTemp();
        }else{
            var aReturnRepeat   = JStTBIFindObjectByKey(aArrayConvert[0],'tSeqNo',tTbxSeqNo);
            // console.log(tTbxSeqNo);
            // console.log(aReturnRepeat);
            if(aReturnRepeat == 'None' ){
                //??????????????????????????????????????????
                oDataObj.push({
                    'tDocNo'    : tTbxDocNo,
                    'tSeqNo'    : tTbxSeqNo,
                    'tPdtCode'  : tTbxPdtCode,
                    'tBarCode'  : tTbxBarCode,
                    // 'tPunCode'  : tSOPunCode,
                });
                localStorage.setItem("TBI_LocalItemDataDelDtTemp",JSON.stringify(oDataObj));
                JSxTBITextInModalDelPdtDtTemp();
            }else if(aReturnRepeat == 'Dupilcate'){
                localStorage.removeItem("TBI_LocalItemDataDelDtTemp");
                $(ptElm).prop('checked', false);
                var nLength = aArrayConvert[0].length;
                for($i=0; $i<nLength; $i++){
                    if(aArrayConvert[0][$i].tSeqNo == tTbxSeqNo){
                        delete aArrayConvert[0][$i];
                    }
                }
                var aNewarraydata   = [];
                for($i=0; $i<nLength; $i++){
                    if(aArrayConvert[0][$i] != undefined){
                        aNewarraydata.push(aArrayConvert[0][$i]);
                    }
                }
                localStorage.setItem("TBI_LocalItemDataDelDtTemp",JSON.stringify(aNewarraydata));
                JSxTBITextInModalDelPdtDtTemp();
            }
        }
        JSxTBIShowButtonDelMutiDtTemp();
    }

    function JSxAddScollBarInTablePdt(){
        $('#otbTbxDocPdtAdvTableList >tbody >tr').css('background-color','#ffffff');
        var rowCount = $('#otbTbxDocPdtAdvTableList >tbody >tr').length;
        if(rowCount >= 2){
            $('#otbTbxDocPdtAdvTableList >tbody >tr').last().css('background-color','rgb(226, 243, 255)');

        }
        // alert(rowCount);
        if(rowCount >= 7){
            $('.xCNTablescroll').css('height','450px');
            $('.xWShowInLine' + rowCount).focus();
            // $('#otbTbxDocPdtAdvTableList').height()
            $('.xCNTablescroll').scrollTop($('#otbTbxDocPdtAdvTableList').height());
            $('html, body').animate({
             scrollTop: ($("#oetTbiInsertBarcode").offset().top)-80
         }, 0);
        }


      
            $('#oetTbiInsertBarcode').focus();
        
    }

    //????????????????????????????????? ????????? ????????????
    function JSxEditQtyAndPrice(){
        $('.xCNPdtEditInLine').click(function(){
            $(this).focus().select();
        });

        $('.xCNPdtEditInLine').off().on('change keyup',function(e){
            if(e.type === 'change' || e.keyCode === 13){
                console.log(e.type);
                var nSeq    = $(this).attr('data-seq');
                var nQty    = $('.xWPdtItemList'+nSeq).attr('data-qty');
                var cPrice  = $('.xWPdtItemList'+nSeq).attr('data-setprice');

                // ?????????????????????????????????????????????
                var tDisChgDTTmp = $('#xWDisChgDTTmp'+nSeq).text().replace(/,/g, '');
                if(tDisChgDTTmp == ''){
                    JSxGetDisChgList(nSeq,0);
                    $(':input:eq(' + ($(':input').index(this) + 1) +')').focus().select();
                }else{
                    // ????????????/???????????????
                    $('#odvPIModalConfirmDeleteDTDis').modal({
                        backdrop: 'static',
                        show: true
                    });

                    //????????????????????????????????????????????????????????????
                    $('#odvPIModalConfirmDeleteDTDis #obtTbxConfirmDeleteDTDis').off('click');
                    $('#odvPIModalConfirmDeleteDTDis #obtTbxConfirmDeleteDTDis').on('click',function(){
                        JSxGetDisChgList(nSeq,1);
                        $(':input:eq(' + ($(':input').index(this) + 1) +')').focus().select();
                    });

                    //?????????????????????????????????????????????????????????????????????
                    $('#odvPIModalConfirmDeleteDTDis #obtTbxCancelDeleteDTDis').off('click');
                    $('#odvPIModalConfirmDeleteDTDis #obtTbxCancelDeleteDTDis').on('click',function(){
                        // $('.modal-backdrop').remove();
                        e.preventDefault();
                        nQty    = nQty.replace(/,/g, '');
                        cPrice  = cPrice.replace(/,/g, '');
                        $('#ohdQty'+nSeq).val(parseFloat(nQty).toFixed(2));
                        $('#ohdPrice'+nSeq).val(parseFloat(cPrice).toFixed(2));
                    });
                }
            }
        });
    }

    // ptStaDelDis = 1 ?????? DTDis
    // ptStaDelDis = 0 ??????????????? DTDis
    function JSxGetDisChgList(pnSeq,pnStaDelDis){
  
        var tChgDT      = $('#xWDisChgDTTmp'+pnSeq).text().replace(/,/g, '');
        var cPrice      = $('#ohdPrice'+pnSeq).val();
        var nQty        = $('#ohdQty'+pnSeq).val();
        var cResult     = parseFloat(cPrice * nQty);

        // Fixed ???????????????????????????????????? 2 ?????????????????????
        $('#ohdPrice'+pnSeq).val(parseFloat(cPrice).toFixed(2));

        // Update Value
        $('#ospGrandTotal'+pnSeq).text(numberWithCommas(parseFloat(cResult).toFixed(2)));
        $('.xWPdtItemList'+pnSeq).attr('data-qty',nQty);
        $('.xWPdtItemList'+pnSeq).attr('data-setprice',parseFloat(cPrice).toFixed(2));
        $('.xWPdtItemList'+pnSeq).attr('data-net',parseFloat(cResult).toFixed(2));

        if(pnStaDelDis == 1){
            $('#xWDisChgDTTmp'+pnSeq).text('');
        }

        // ??????????????????????????????????????????????????? ????????????????????? NetAfHD
        if($('#olbPIDisChgHD').text() == ''){
            $('#ospnetAfterHD'+pnSeq).text(parseFloat(cResult).toFixed(2));
            $('.xWPdtItemList'+pnSeq).attr('data-netafhd',parseFloat(cResult).toFixed(2));
        }

        JSxRendercalculate();

        var tTbxDocNo        = $("#oetTBIDocNo").val();
        var tTbxBchCode      = $("#oetTBIBchCode").val();
        if(pnSeq!=undefined){
        $.ajax({
            type: "POST",
            url: "docTBIEventEditInline",
            data:{
                'tBchCode'      : tTbxBchCode,
                'tDocNo'        : tTbxDocNo,
                'nSeqNo'        : pnSeq,
                'nQty'          : nQty,
                'cPrice'        : cPrice,
                'cNet'          : cResult,
                'nStaDelDis'    : pnStaDelDis,
            },
            catch: false,
            timeout: 0,
            success: function (oResult){


            },
            error: function (jqXHR, textStatus, errorThrown) {
                // JCNxResponseError(jqXHR, textStatus, errorThrown);
                // JSxGetDisChgList(pnSeq,pnStaDelDis);
            }
        });
       }
    }

    //????????????????????????????????????????????????????????????????????? DT
    function JSxRendercalculate(){

        var nTotal                  = 0;
        var nTotal_alwDiscount      = 0;

        $(".xCNPrice").each(function(e) {
            var nSeq   = $(this).attr('data-seq');
            var nValue = $('#ospGrandTotal'+nSeq).text();
            var nValue = nValue.replace(/,/g, '');

            nTotal = parseFloat(nTotal) + parseFloat(nValue);

            if($(this).attr('data-alwdis') == 1){
                nTotal_alwDiscount = parseFloat(nTotal_alwDiscount) + parseFloat(nValue);
            };
        });

        //????????????????????????????????????
        $('#olbPISumFCXtdNet').text(numberWithCommas(parseFloat(nTotal).toFixed(2)));

        //???????????????????????????????????? ????????????????????????????????????
        $('#olbPISumFCXtdNetAlwDis').val(nTotal_alwDiscount);

        //???????????????????????????????????????
        var tChgHD          = $('#ohdPIHiddenDisChgHD').text().replace(/,/g, '');
        var nNewDiscount    = 0;
        if(tChgHD != '' && tChgHD != null){ //?????????????????????????????????????????????
            var aChgHD      = tChgHD.split(",");
            var nNetAlwDis  = $('#olbPISumFCXtdNetAlwDis').val();

            for(var i=0; i<aChgHD.length; i++){
                // console.log('??????????????????????????????????????????????????????????????????????????? : ' + nNetAlwDis);
                if(aChgHD[i] != '' && aChgHD[i] != null){
                    if(aChgHD[i].search("%") == -1){
                        //?????????????????? = ?????????????????????????????????????????????
                        var nVal        = aChgHD[i];
                        var nCal        = (parseFloat(nNetAlwDis) + parseFloat(nVal));
                        nNewDiscount    = parseFloat(nCal);
                        nNetAlwDis      = nNewDiscount;
                        nNewDiscount    = 0;
                    }else{
                        //????????? = ???????????????????????????????????? %
                        var nPercent    = aChgHD[i];
                        var nPercent    = nPercent.replace("%", "");
                        var tCondition  = nPercent.substr(0, 1);
                        var nValPercent = Math.abs(nPercent);
                        if(tCondition == '-'){
                            var nCal        = parseFloat(nNetAlwDis) - ((parseFloat(nNetAlwDis) * nValPercent) / 100);
                            if(nCal == 0){
                                var nCal        = -nNetAlwDis;
                            }else{
                                var nCal        = nCal;
                            }
                        }else if(tCondition == '+'){
                            var nCal        = parseFloat(nNetAlwDis) + ((parseFloat(nNetAlwDis) * nValPercent) / 100);
                        }
                        nNewDiscount    = parseFloat(nCal);
                        nNetAlwDis      = nNewDiscount;
                        nNewDiscount    = 0;
                    }
                }
            }
            var nDiscount = (nNetAlwDis - parseFloat($('#olbPISumFCXtdNetAlwDis').val()));
            $('#olbPISumFCXtdAmt').text(numberWithCommas(parseFloat(nDiscount).toFixed(2)));

            //Prorate
            JSxProrate();
        }

        //???????????????????????????
        JSxCalculateVat();

        //????????????????????????????????????/???????????????
        // var tTypeVat = $('#ocmPIFrmSplInfoVatInOrEx').val();
        // if(tTypeVat == 1){
        //     // ???????????????????????????
        //     var nTotalFisrt = $('#olbPISumFCXtdNet').text().replace(/,/g, '');
        //     var nDiscount   = $('#olbPISumFCXtdAmt').text().replace(/,/g, '');
        //     var nVat        = $('#olbPISumFCXtdVat').text().replace(/,/g, '');
        //     var nResult     = (parseFloat(Math.abs(nTotalFisrt))+parseFloat(nDiscount)) - parseFloat(nVat);
        // }else if(tTypeVat == 2){
        //     // ??????????????????????????????
        //     var nTotalFisrt = $('#olbPISumFCXtdNet').text().replace(/,/g, '');
        //     var nDiscount   = $('#olbPISumFCXtdAmt').text().replace(/,/g, '');
        //     var nResult     = parseFloat(Math.abs(nTotalFisrt))+parseFloat(nDiscount);
        // }

        var nTotalFisrt = $('#olbPISumFCXtdNet').text().replace(/,/g, '');
        var nDiscount   = $('#olbPISumFCXtdAmt').text().replace(/,/g, '');
        var nResult     = parseFloat(Math.abs(nTotalFisrt))+parseFloat(nDiscount);
        $('#olbPISumFCXtdNetAfHD').text(numberWithCommas(parseFloat(nResult).toFixed(2)));

        //???????????????????????????
        JSxCalculateVat();
    }

    function JSxProrate(){
        var pnSumDiscount       = $('#olbPISumFCXtdAmt').text().replace(/,/g, '');
        var pnSum               = $('#olbPISumFCXtdNetAlwDis').val().replace(/,/g, '');
        var length              = $(".xCNPrice").length;
        var nSumProrate         = 0;
        var nDifferenceProrate  = 0;

        $(".xCNPrice").each(function(index,e) {
            var nSeq    = $(this).attr('data-seq');
            var alwdis  = $(this).attr('data-alwdis');
            var nValue  = $('#ospGrandTotal'+nSeq).text();
            var nValue  = parseFloat(nValue.replace(/,/g, ''));
            var nProrate = (pnSumDiscount * nValue) / pnSum;
            var netAfterHD = 0 ;
            if(alwdis==1){
                nSumProrate     = parseFloat(nSumProrate) + parseFloat(nProrate);
                if(index === (length - 1)){
                    nDifferenceProrate = pnSumDiscount - nSumProrate;
                    nProrate = nProrate + nDifferenceProrate;
                    netAfterHD =  nValue + nProrate;
                }else{
                    nProrate = nProrate;
                    netAfterHD =  nValue + nProrate;
                }

                $('#ospnetAfterHD'+nSeq).text(numberWithCommas(parseFloat(nValue+nProrate).toFixed(2)));
            }
        });
    }

    //???????????????????????????
    $('#ocmPIFrmSplInfoVatInOrEx').change(function (){ JSxRendercalculate(); });
    function JSxCalculateVat(){
        var nPIDecimalShow = $('#ohdPIDecimalShow').val();
        var tVatList  = '';
        var aVat      = [];
        $('#otbTbxDocPdtAdvTableList tbody tr').each(function(){
            var nAlwVat  = $(this).attr('data-alwvat');
            var nVat     = parseFloat($(this).attr('data-vat'));
            var nKey     = $(this).attr('data-seqno');
            var tTypeVat = $('#ocmPIFrmSplInfoVatInOrEx').val();

            if(nAlwVat == 1){
                //?????????????????????????????? VAT
                if(tTypeVat == 1){
                    // ??????????????????????????? tSoot = net - ((net * 100) / (100 + rate));
                    var net       = parseFloat($('#ospnetAfterHD'+nKey).text().replace(/,/g, ''));
                    var nTotalVat = net - (net * 100 / (100 + nVat));
                    var nResult   = parseFloat(nTotalVat).toFixed(nPIDecimalShow);
                }else if(tTypeVat == 2){
                    // ?????????????????????????????? tSoot = net - (net * (100 + 7) / 100) - net;
                    var net       = parseFloat($('#ospnetAfterHD'+nKey).text().replace(/,/g, ''));
                    var nTotalVat = (net * (100 + nVat) / 100) - net;
                    var nResult   = parseFloat(nTotalVat).toFixed(nPIDecimalShow);
                }

                var oVat = { VAT: nVat , VALUE: nResult };
                aVat.push(oVat);
            }
        });

        //?????????????????????????????? array ????????????
        aVat.sort(function (a, b) {
            return a.VAT - b.VAT;
        });

        //???????????????????????? array ???????????? vat ?????????
        var nVATStart       = 0;
        var nSumValueVat    = 0;
        var aSumVat         = [];
        for(var i=0; i<aVat.length; i++){
            if(nVATStart == aVat[i].VAT){
                nSumValueVat = nSumValueVat + parseFloat(aVat[i].VALUE);
                aSumVat.pop();
            }else{
                nSumValueVat = 0;
                nSumValueVat = nSumValueVat + parseFloat(aVat[i].VALUE);
                nVATStart    = aVat[i].VAT;
            }

            var oSum = { VAT: nVATStart , VALUE: nSumValueVat };
            aSumVat.push(oSum);
        }

        // var PIVatRate =  parseFloat($('#ohdPIVatRate').val());
        // var PICmpRetInOrEx = $('#ohdPICmpRetInOrEx').val();
        // var cSumFCXtdNetAfHD  = parseFloat($('#olbPISumFCXtdNetAfHD').text().replace(/,/g, ''));
        // var nSumVatHD = cSumFCXtdNetAfHD - ((cSumFCXtdNetAfHD * 100)/(100 + PIVatRate));

        //????????? VAT ?????????????????????????????????
        var nSumVatHD = parseFloat($('#ohdSumFCXtdVat').val());
        var nSumVat = 0;
        var nCount  = 1;
        for(var j=0; j<aSumVat.length; j++){
            var tVatRate    = aSumVat[j].VAT;
            if(nCount != aSumVat.length){
                var tSumVat     = parseFloat(aSumVat[j].VALUE).toFixed(nPIDecimalShow) == 0 ? '0.00' : parseFloat(aSumVat[j].VALUE).toFixed(nPIDecimalShow);
            }else{
                var tSumVat     = (aSumVat[j].VALUE - nSumVat).toFixed(nPIDecimalShow);
            }
            tVatList    += '<li class="list-group-item"><label class="pull-left">'+ tVatRate + '%</label><label class="pull-right">' + numberWithCommas(parseFloat(tSumVat).toFixed(nPIDecimalShow)) + '</label><div class="clearfix"></div></li>';
            nSumVat += parseFloat(aSumVat[j].VALUE);
            nCount++;
        }

        $('#oulPIDataListVat').html(tVatList);

        //???????????????????????????????????????????????????????????????
        $('#olbPIVatSum').text(numberWithCommas(parseFloat(nSumVat).toFixed(nPIDecimalShow)));

        //???????????????????????????????????????????????????????????????
        $('#olbPISumFCXtdVat').text(numberWithCommas(parseFloat(nSumVat).toFixed(nPIDecimalShow)));
        $('#ohdSumFCXtdVat').val(nSumVat.toFixed(nPIDecimalShow));

        //?????????????????????????????????
        var tTypeVat = $('#ocmPIFrmSplInfoVatInOrEx').val();
        if(tTypeVat == 1){ //?????????????????????????????????
            var nTotal          = parseFloat($('#olbPISumFCXtdNetAfHD').text().replace(/,/g, ''));
            var nVat            = parseFloat($('#olbPISumFCXtdVat').text().replace(/,/g, ''));
            var nResultTotal    = parseFloat(nTotal);
        }else if(tTypeVat == 2){ //????????????????????????????????????
            var nTotal          = parseFloat($('#olbPISumFCXtdNetAfHD').text().replace(/,/g, ''));
            var nVat            = parseFloat($('#olbPISumFCXtdVat').text().replace(/,/g, ''));
            var nResultTotal    = parseFloat(nTotal) + parseFloat(nVat);
        }

        //????????????????????????????????????????????????????????????
        $('#olbPICalFCXphGrand').text(numberWithCommas(parseFloat(nResultTotal).toFixed(2)));

        //?????????????????????????????????????????? ???????????????????????????
        var tTextTotal  = $('#olbPICalFCXphGrand').text().replace(/,/g, '');
        var tThaibath 	= ArabicNumberToText(tTextTotal);
        $('#odvPIDataTextBath').text(tThaibath);
    }

    //???????????????????????????????????? comma ??????????????????
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }

    //Save Discount And Chage Footer HD (???????????????????????????)
    function JCNvPIMngDocDisChagHD(event){
        var nStaSession = 1;
        if (typeof nStaSession !== "undefined" && nStaSession == 1) {
            var oPIDisChgParams = {
                DisChgType: 'disChgHD'
            };
            JSxTBXOpenDisChgPanel(oPIDisChgParams);
        }else{
            JCNxShowMsgSessionExpired();
        }
    }

    //Modal ????????????????????????????????? HD
    function JCNLoadPanelDisChagHD(){
        $('#odvModalDiscount').modal({backdrop: 'static', keyboard: false})
        $('#odvModalDiscount').modal('show');
    }

    //?????????????????????????????????
    function JCNvAddDisChgRow(){
        var tDuplicate = $('#otrPIDisChgHDNotFound tbody tr').hasClass('otrPIDisChgHDNotFound');
        if(tDuplicate == true){
            //?????????????????????
            $('#otrPIDisChgHDNotFound tbody').html('');
        }

        //????????????????????????
        var nKey = parseInt($('#otrPIDisChgHDNotFound tbody tr').length) + parseInt(1);

        //???????????????????????????????????? ????????????????????????????????????
        var nRowCount   = $('.xWDiscountChgTrTag').length;
        if(nRowCount > 0){
            var oLastRow   = $('.xWDiscountChgTrTag').last();
            var nNetAlwDis = oLastRow.find('td label.xCNDisChgAfterDisChg').text();
        }else{
            var nNetAlwDis = ($('#olbPISumFCXtdNetAlwDis').val() == 0) ? '0.00' : $('#olbPISumFCXtdNetAlwDis').val();
        }

        var     tSelectTypeDiscount =  '<td nowrap style="padding-left: 5px !important;">';
                tSelectTypeDiscount += '<div class="form-group" style="margin-bottom: 0px !important;">';
                tSelectTypeDiscount += '<select class="dischgselectpicker form-control xCNDisChgType" onchange="JSxCalculateDiscountChg(this);">';
                tSelectTypeDiscount += '<option value="1"><?=language('common/main/main', '???????????????'); ?></option>';
                tSelectTypeDiscount += '<option value="2"><?=language('common/main/main', '?????? %'); ?></option>';
                tSelectTypeDiscount += '<option value="3"><?=language('common/main/main', '????????????????????????'); ?></option>';
                tSelectTypeDiscount += '<option value="4"><?=language('common/main/main', '??????????????? %'); ?></option>';
                tSelectTypeDiscount += '</select>';
                tSelectTypeDiscount += '</div>';
                tSelectTypeDiscount += '</td>';

        var     tDiscount =  '<td nowrap style="padding-left: 5px !important;">';
                tDiscount += '<div class="form-group" style="margin-bottom: 0px !important;">';
                tDiscount += '<input class="form-control xCNInputNumericWithDecimal xCNDisChgNum" onchange="JSxCalculateDiscountChg(this);" onkeyup="javascript:if(event.keyCode==13) JSxCalculateDiscountChg(this);" type="text">';
                tDiscount += '</div>';
                tDiscount += '</td>';

        var     tHTML = '';
                tHTML += '<tr class="xWDiscountChgTrTag" >';
                tHTML += '<td>'+nKey+'</td>';
                tHTML += '<td class="text-right"><label class="xCNBeforeDisChg">'+numberWithCommas(parseFloat(nNetAlwDis).toFixed(2))+'</label></td>';
                tHTML += '<td class="text-right"><label class="xCNDisChgValue">'+'0.00'+'</label></td>';
                tHTML += '<td class="text-right"><label class="xCNDisChgAfterDisChg">'+'0.00'+'</label></td>';
                tHTML += tSelectTypeDiscount;
                tHTML += tDiscount;
                tHTML += '<td nowrap="" class="text-center">';
                tHTML += '<label class="xCNTextLink">';
                tHTML += '<img class="xCNIconTable xWDisChgRemoveIcon" src="<?=base_url('application/modules/common/assets/images/icons/delete.png')?>" title="Remove" onclick="JSxRemoveDiscountRow(this)">';
                tHTML += '</label>';
                tHTML += '</td>';
                tHTML += '</tr>';
        $('#otbDisChgDataDocHDList tbody').append(tHTML);
        JSxCalculateDiscountChg();
    }

    //????????????????????????
    function JSxRemoveDiscountRow(elem){

    }

    //??????????????????????????????
    function JSxCalculateDiscountChg(){
        $('.xWDiscountChgTrTag').each(function(index){

            var cBeforeDisChg = $('#olbPISumFCXtdNetAlwDis').val();
            $(this).find('td label.xCNBeforeDisChg').first().text(accounting.formatNumber(cBeforeDisChg, 2, ','));

            var cCalc;
            var nDisChgType         = $(this).find('td select.xCNDisChgType').val();
            var cDisChgNum          = $(this).find('td input.xCNDisChgNum').val();
            var cDisChgBeforeDisChg = accounting.unformat($(this).find('td label.xCNBeforeDisChg').text());
            var cDisChgValue        = $(this).find('td label.xCNDisChgValue').text();
            var cDisChgAfterDisChg  = $(this).find('td label.xCNDisChgAfterDisChg').text();

            if(nDisChgType == 1){ // ???????????????
                cCalc = parseFloat(cDisChgBeforeDisChg) - parseFloat(cDisChgNum);
                $(this).find('td label.xCNDisChgValue').text(accounting.formatNumber(cDisChgNum, 2, ','));
            }

            if(nDisChgType == 2){ // ?????? %
                var cDisChgPercent  = (cDisChgBeforeDisChg * parseFloat(cDisChgNum)) / 100;
                cCalc = parseFloat(cDisChgBeforeDisChg) - cDisChgPercent;
                $(this).find('td label.xCNDisChgValue').text(accounting.formatNumber(cDisChgPercent, 2, ','));
            }

            if(nDisChgType == 3){ // ????????????????????????
                cCalc = parseFloat(cDisChgBeforeDisChg) + parseFloat(cDisChgNum);
                $(this).find('td label.xCNDisChgValue').text(accounting.formatNumber(cDisChgNum, 2, ','));
            }

            if(nDisChgType == 4){ // ??????????????? %
                var cDisChgPercent = (parseFloat(cDisChgBeforeDisChg) * parseFloat(cDisChgNum)) / 100;
                cCalc = parseFloat(cDisChgBeforeDisChg) + cDisChgPercent;
                $(this).find('td label.xCNDisChgValue').text(accounting.formatNumber(cDisChgPercent, 2, ','));
            }

            $(this).find('td label.xCNDisChgAfterDisChg').text(accounting.formatNumber(cCalc, 2, ','));
            $(this).next().find('td label.xCNBeforeDisChg').text(accounting.formatNumber(cCalc, 2, ','));
        });
    }

    //Function: Set Data Value End Of Bile
    function JSxTBXSetFooterEndOfBill(poParams){
        /* ================================================= Left End Of Bill ================================================= */
        var tTextBath   = poParams.tTextBath;
        $('#odvPIDataTextBath').text(tTextBath);

        // ?????????????????? vat
        var aVatItems   = poParams.aEndOfBillVat.aItems;
        var tVatList    = "";
        if(aVatItems.length > 0){
            for(var i = 0; i < aVatItems.length; i++){
                var tVatRate = parseFloat(aVatItems[i]['FCXtdVatRate']).toFixed(0);
                var tSumVat = parseFloat(aVatItems[i]['FCXtdVat']).toFixed(0) == 0 ? '0.00' : parseFloat(aVatItems[i]['FCXtdVat']).toFixed(<?php echo $nOptDecimalShow?>);
                var tSumVat = parseFloat(aVatItems[i]['FCXtdVat']).toFixed(<?php echo $nOptDecimalShow;?>) == 0 ? '0.00' : parseFloat(aVatItems[i]['FCXtdVat']).toFixed(<?php echo $nOptDecimalShow?>);
                tVatList += '<li class="list-group-item"><label class="pull-left">'+ tVatRate + '%</label><label class="pull-right">' + numberWithCommas(parseFloat(tSumVat).toFixed(<?=$nOptDecimalShow?>)) + '</label><div class="clearfix"></div></li>';
            }
        }else{
            tVatList += '<li class="list-group-item"><label class="pull-left">0%</label><label class="pull-right">0.00</label><div class="clearfix"></div></li>';
        }

        $('#oulPIDataListVat').html(tVatList);

        // ???????????????????????????????????????????????????????????????
        var cSumVat     = poParams.aEndOfBillVat.cVatSum;
        $('#olbPIVatSum').text(cSumVat);
        /* ==================================================================================================================== */

        /* ================================================= Right End Of Bill ================================================ */
        var cCalFCXphGrand      = poParams.aEndOfBillCal.cCalFCXphGrand;
        var cSumFCXtdAmt        = poParams.aEndOfBillCal.cSumFCXtdAmt;
        var cSumFCXtdNet        = poParams.aEndOfBillCal.cSumFCXtdNet;
        var cSumFCXtdNetAfHD    = poParams.aEndOfBillCal.cSumFCXtdNetAfHD;
        var cSumFCXtdVat        = poParams.aEndOfBillCal.cSumFCXtdVat;
        var tDisChgTxt          = poParams.aEndOfBillCal.tDisChgTxt;

        // var tTypeVat = $('#ocmPIFrmSplInfoVatInOrEx').val();
        // if(tTypeVat == 1){ //?????????????????????????????????
        //     cNewSumFCXtdNetAfHD = cSumFCXtdNetAfHD.replace(/,/g, '') - cSumFCXtdVat.replace(/,/g, '')
        // }else{ //????????????????????????????????????
        //     cNewSumFCXtdNetAfHD = cSumFCXtdNetAfHD.replace(/,/g, '');
        // }

        if(tDisChgTxt == '' || tDisChgTxt == null){
            //console.log('NULL');
        }else{
            var tTextDisChg    = '';
            var aExplode       = tDisChgTxt.split(",");
            for(var i=0; i<aExplode.length; i++){
                if(aExplode[i].indexOf("%") != '-1'){
                    tTextDisChg += aExplode[i] + ',';
                }else{
                    tTextDisChg += accounting.formatNumber(aExplode[i], 2, ',') + ',';
                }

                //????????????????????????????????????????????????????????? comma ?????????
                if(i == aExplode.length - 1 ){
                    tTextDisChg = tTextDisChg.substring(tTextDisChg.length-1,-1);
                }
            }
        }

        // ????????????????????????????????????
        $('#olbPISumFCXtdNet').text(cSumFCXtdNet);
        // ??????/???????????????
        $('#olbPISumFCXtdAmt').text(cSumFCXtdAmt);
        // ????????????????????????????????????/???????????????
        $('#olbPISumFCXtdNetAfHD').text(accounting.formatNumber(cSumFCXtdNetAfHD, 2, ','));
        // ???????????????????????????????????????????????????????????????
        $('#olbPISumFCXtdVat').text(cSumFCXtdVat);
        $('#ohdSumFCXtdVat').val(cSumFCXtdVat.replace(",", ""));
        // ????????????????????????????????????????????????????????????
        $('#olbPICalFCXphGrand').text(cCalFCXphGrand);
        //?????????????????????/??????????????? ?????????????????????
        $('#olbPIDisChgHD').text(tTextDisChg);
        $('#ohdPIHiddenDisChgHD').val(tDisChgTxt);
        /* ==================================================================================================================== */
    }

    $(document).on("keypress", 'form', function (e) {
        var code = e.keyCode || e.which;
        if (code == 13) {
            e.preventDefault();
            return false;
        }
    });



    //????????????????????????????????????????????????????????????
    function JSxTBITextInModalDelPdtDtTemp(){
        var aArrayConvert   = [JSON.parse(localStorage.getItem("TBI_LocalItemDataDelDtTemp"))];
        // alert(1111122);
        console.log(aArrayConvert);
        if (aArrayConvert[0] == null || aArrayConvert[0] == ""){
        }else{
            var tTBITextDocNo   = "";
            var tTBITextSeqNo   = "";
            var tTBITextPdtCode = "";
            var tTBITextPunCode = "";
            $.each(aArrayConvert[0],function(nKey,aValue){
                tTBITextDocNo    += aValue.tDocNo;
                tTBITextDocNo    += " , ";

                tTBITextSeqNo    += aValue.tSeqNo;
                tTBITextSeqNo    += " , ";

                tTBITextPdtCode  += aValue.tPdtCode;
                tTBITextPdtCode  += " , ";

                tTBITextPunCode  += aValue.tPunCode;
                tTBITextPunCode  += " , ";
            });
            $('#odvTBIModalDelPdtInDTTempMultiple #ospTextConfirmDelMultiple').text($('#oetTextComfirmDeleteMulti').val());
            $('#odvTBIModalDelPdtInDTTempMultiple #ohdConfirmTBIDocNoDelete').val(tTBITextDocNo);
            $('#odvTBIModalDelPdtInDTTempMultiple #ohdConfirmTBISeqNoDelete').val(tTBITextSeqNo);
            $('#odvTBIModalDelPdtInDTTempMultiple #ohdConfirmTBIPdtCodeDelete').val(tTBITextPdtCode);
            $('#odvTBIModalDelPdtInDTTempMultiple #ohdConfirmTBIPunCodeDelete').val(tTBITextPunCode);
        }
    }      

    //??????????????? KEY
    function JStTBIFindObjectByKey(array, key, value) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][key] === value) {
                return "Dupilcate";
            }
        }
        return "None";
    }


</script>

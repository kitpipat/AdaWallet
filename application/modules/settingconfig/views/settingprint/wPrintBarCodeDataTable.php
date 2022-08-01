<!-- <div class="row"> -->
<style>
    /* .table>tbody>tr>td,
    .table>thead>tr>th {
        border: 0 !important
    } */
</style>
<!-- <div class="col-md-12"> -->
<div class="table-responsive" style="background-color: white;">
    <table class="table" id="otbPBPdtTemp">
        <thead class="xCNPanelHeadColor">
            <tr>
                <th class="xCNTextBold" style="width:2%;color:white !important;vertical-align: middle;">
                    <label class="fancy-checkbox">
                        <input id="ocbListItemAll" checked type="checkbox" class="ocbListItemAll" name="ocbListItemAll[]" onchange="">
                        <span></span>
                    </label>
                </th>
                <th class="xCNTextBold xCNTextDetail1 text-center" style="width:7%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtCode') ?></th>
                <th class="xCNTextBold xCNTextDetail1 text-center" style="width:25%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtName') ?></th>
                <th class="xCNTextBold xCNTextDetail1 text-center" style="width:10%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtUnit') ?></th>
                <?php if ($tPlbCode == 'L003') { ?>
                    <th class="xCNTextBold xCNTextDetail1 text-center" style="width:10%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'แบรนด์') ?></th>
                <?php } ?>
                <th class="xCNTextBold xCNTextDetail1 text-center" style="width:10%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtBarCode') ?></th>
                <th class="xCNTextBold xCNTextDetail1 text-center" style="width:10%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtBarPdgRegNo') ?></th>
                <th class="xCNTextBold xCNTextDetail1 text-center" style="width:6%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtPrice') ?></th>
                <th class="xCNTextBold xCNTextDetail1 text-center" style="width:7%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtPriceType') ?></th>
                <th class="xCNTextBold xCNTextDetail1 text-center" style="width:7%; color:white !important;vertical-align: middle;"><?php echo language('product/settingprinter/settingprinter', 'tLPRTTotalPrint') ?></th>

                <?php if ($bSeleteImport == 1) { ?>
                    <th class="xCNTextBold xCNTextDetail1 text-center" style="width:10%; color:white !important;"><?php echo "หมายเหตุ"; ?></th>
                <?php } ?>

            </tr>
        </thead>
        <tbody id="odvPBCList">
            <?php if ($aDataList['rtCode'] == 1) : ?>
                <?php foreach ($aDataList['raItems'] as $key => $aValue) { ?>
                    <?php
                    $FTTmpRemark = '';
                    $aRemark =  explode("$&", $aValue['rtPrnBarImpDesc']);
                    if ($aRemark[0] !== 'undefined') {
                        if ($aRemark[0] == '' || $aRemark[0] == null) {
                            $FTTmpRemark = '';
                        } else {
                            if (strpos($aRemark[0], "[") !== -1) {
                                $aRemarkIndex = explode("[", $aRemark[0]);
                                $aRemarkIndex =   explode("]", $aRemarkIndex[1]);
                                $FTTmpRemark = $aRemarkIndex[1];
                                // switch ($aRemarkIndex[0]) {
                                //     case '0':
                                //         $FTBchCode = $aRemark[2];
                                //         $FTTmpRemark = $aRemark[1];
                                //         break;
                                //     case '1':
                                //         $FTBchName = $aRemark[2];
                                //         $FTTmpRemark = $aRemark[1];
                                //         break;
                                //     case '2':
                                //         $FTAgnCode = $aRemark[2];
                                //         $FTAgnName = 'N/A';
                                //         $FTTmpRemark = $aRemark[1];
                                //         break;
                                //     case '3':
                                //         $FTPplCode = $aRemark[2];
                                //         $FTPplName = 'N/A';
                                //         $FTTmpRemark = $aRemark[1];
                                //         break;
                                // }
                            }
                        }
                    }

                    if ($aValue['rtPrnBarStaImport'] != 1) {
                        $tDisCheck = 'disabled';
                        $tClassChkMQ = '';
                    } else {
                        $tDisCheck = '';
                        $tClassChkMQ = 'xWCheckMQ';
                    }
                    ?>
                    <tr>
                        <td class="xCNTextBold" style="width:5%;color:white !important;">
                            <label class="fancy-checkbox">
                                <?php if ($aValue['rtPrnBarStaSelect'] == 1) {
                                    $tChecked = 'checked';
                                } else {
                                    $tChecked = '';
                                }

                                ?>
                                <input type="checkbox" <?php echo $tDisCheck; ?> <?php echo $tChecked; ?> class="ocbListItem <?php echo $tClassChkMQ;  ?>" data-key="<?php echo $key; ?>" data-pdtcode="<?php echo $aValue['rtPrnBarCode']; ?>" data-barcode="<?php echo $aValue['rtPrnBarBarCode']; ?>">
                                <span>&nbsp;</span>
                            </label>
                        </td>
                        <td class="text-left"><?php echo $aValue['rtPrnBarCode']; ?></td>
                        <td class="text-left"><?php echo $aValue['rtPrnBarName']; ?></td>
                        <?php $tPunName = $aValue['rtPrnBarContentUnit']; ?>
                        <td class="text-left"><?php echo $tPunName; ?></td>
                        <?php if ($tPlbCode == 'L003') { ?>
                            <td class="text-left"><?php echo $aValue['rtPrnBarPbnDesc']; ?></td>
                        <?php } ?>
                        <td class="text-left"><?php echo $aValue['rtPrnBarBarCode']; ?></td>
                        <td class="text-left"><?php echo $aValue['rtPrnBarPriceType']; ?></td>
                        <td class="text-right"><?php echo number_format($aValue['rtPrnBarPrice'], 2); ?></td>
                        <td class="text-left">ราคาปกติ</td>
                        <td><input type="text" onchange="JSvPriBarEditInLineQTYPrint($(this).val(),'<?php echo $aValue['rtPrnBarCode']; ?>','<?php echo $aValue['rtPrnBarBarCode']; ?>')" value="<?php echo $aValue['rtPrnBarQTY']; ?>" class="form-control text-right xCNInputNumericWithoutDecimal  xCNPdtEditInLine xCNInputWithoutSpc xCNValueMon">
                            <?php if ($bSeleteImport == 1) { ?>
                        <td class="text-left" style="color: red !important; font-weight:bold;"><?php echo  $FTTmpRemark; ?></td>
                    <?php } ?>
                    </td>

                    </tr>
                <?php } ?>
            <?php else : ?>
                <tr>
                    <td class='text-center xCNTextDetail2 xCNTextNotfoundDataPdtTable' colspan='8'><?php echo language('product/settingprinter/settingprinter', 'tLPRTNotFoundData') ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- </div> -->
<!-- </div> -->
<div class="row">
    <!-- เปลี่ยน -->
    <div class="col-md-6">
        <p><?= language('common/main/main', 'tResultTotalRecord') ?> <?= $aDataList['rnAllRow'] ?> <?= language('common/main/main', 'tRecord') ?> <?= language('common/main/main', 'tCurrentPage') ?> <?= $aDataList['rnCurrentPage'] ?> / <?= $aDataList['rnAllPage'] ?></p>
    </div>
    <!-- เปลี่ยน -->
    <div class="col-md-6">
        <div class="xWPagePriBar btn-toolbar pull-right">
            <!-- เปลี่ยนชื่อ Class เป็นของเรื่องนั้นๆ -->
            <?php if ($nPage == 1) {
                $tDisabledLeft = 'disabled';
            } else {
                $tDisabledLeft = '-';
            } ?>
            <button onclick="JSvPriBarClickPage('previous','<?php echo $tPlbCode; ?>')" class="btn btn-white btn-sm" <?php echo $tDisabledLeft ?>>
                <!-- เปลี่ยนชื่อ Onclick เป็นของเรื่องนั้นๆ -->
                <i class="fa fa-chevron-left f-s-14 t-plus-1"></i>
            </button>
            <?php for ($i = max($nPage - 2, 1); $i <= max(0, min($aDataList['rnAllPage'], $nPage + 2)); $i++) { ?>
                <!-- เปลี่ยนชื่อ Parameter Loop เป็นของเรื่องนั้นๆ -->
                <?php
                if ($nPage == $i) {
                    $tActive = 'active';
                    $tDisPageNumber = 'disabled';
                } else {
                    $tActive = '';
                    $tDisPageNumber = '';
                }
                ?>
                <!-- เปลี่ยนชื่อ Onclick เป็นของเรื่องนั้นๆ -->
                <button onclick="JSvPriBarClickPage('<?php echo $i ?>','<?php echo $tPlbCode; ?>')" type="button" class="btn xCNBTNNumPagenation <?php echo $tActive ?>" <?php echo $tDisPageNumber ?>><?php echo $i ?></button>
            <?php } ?>
            <?php if ($nPage >= $aDataList['rnAllPage']) {
                $tDisabledRight = 'disabled';
            } else {
                $tDisabledRight = '-';
            } ?>
            <button onclick="JSvPriBarClickPage('next','<?php echo $tPlbCode; ?>')" class="btn btn-white btn-sm" <?php echo $tDisabledRight ?>>
                <!-- เปลี่ยนชื่อ Onclick เป็นของเรื่องนั้นๆ -->
                <i class="fa fa-chevron-right f-s-14 t-plus-1"></i>
            </button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        if ($('#otbPBPdtTemp tbody tr td').hasClass('xCNTextNotfoundDataPdtTable') != true) { //มีสินค้าในตาราง
            $('#oetShowDataTableProduct').prop('disabled', true);
            $('.xWDisBtnMQ').prop('disabled', false);
        } else {
            $('#oetShowDataTableProduct').prop('disabled', false);
            $('.xWDisBtnMQ').prop('disabled', true);
        }
    });

    $('#ocbListItemAll').click(function() {
        $('.xWCheckMQ').prop('checked', this.checked);
        JSvPriBarUpdateCheckedAll(this.checked);
    });

    function JSvPriBarEditInLineQTYPrint(pnValue, ptPdtCode, ptPdtBarCode) {
        try {
            $.ajax({
                type: "POST",
                url: "PrintBarCodeUpdateEditInLine",
                data: {
                    nValue: pnValue,
                    tPdtCode: ptPdtCode,
                    tPdtBarCode: ptPdtBarCode
                },
                cache: false,
                Timeout: 5000,
                success: function(tResult) {},
                error: function(jqXHR, textStatus, errorThrown) {
                    JCNxResponseError(jqXHR, textStatus, errorThrown);
                }
            });
        } catch (err) {
            console.log('JSvPriBarEditInLineQTYPrint Error: ', err);
        }

    }


    function JSvPriBarUpdateCheckedAll(pbChecked) {

        $.ajax({
            type: "POST",
            url: "PrintBarCodeUpdateCheckedAll",
            data: {
                bCheckedAll: pbChecked,
            },
            cache: false,
            Timeout: 5000,
            success: function(tResult) {},
            error: function(jqXHR, textStatus, errorThrown) {
                JCNxResponseError(jqXHR, textStatus, errorThrown);
            }
        });
    }


    $('.xWCheckMQ').click(function() {
        if ($('.xWCheckMQ:checked').length == $('.xWCheckMQ').length) {
            $('#ocbListItemAll').prop('checked', true);
        } else {
            $('#ocbListItemAll').prop('checked', false);
        }

        if ($(this).is(":checked")) {
            var tValueChecked = 'true';
            var tPdtCode = $(this).attr('data-pdtcode');
            var tBarCode = $(this).attr('data-barcode');
        } else {
            var tValueChecked = 'false';
            var tPdtCode = $(this).attr('data-pdtcode');
            var tBarCode = $(this).attr('data-barcode');
        }

        $.ajax({
            type: "POST",
            url: "PrintBarCodeUpdateChecked",
            data: {
                tValueChecked: tValueChecked,
                tPdtCode: tPdtCode,
                tBarCode: tBarCode
            },
            cache: false,
            Timeout: 5000,
            success: function(tResult) {},
            error: function(jqXHR, textStatus, errorThrown) {
                JCNxResponseError(jqXHR, textStatus, errorThrown);
            }
        });

    });
</script>
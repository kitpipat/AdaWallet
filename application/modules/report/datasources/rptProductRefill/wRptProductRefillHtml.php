<?php

    $aDataReport    = $aDataViewRpt['aDataReport'];
    $aDataTextRef   = $aDataViewRpt['aDataTextRef'];
    $aDataFilter    = $aDataViewRpt['aDataFilter'];

?>



<style>
    .xCNFooterRpt {
        border-bottom: 7px double #ddd;
    }
    .table thead th,
    .table>thead>tr>th,
    .table tbody tr,
    .table>tbody>tr>td {
        border: 0px transparent !important;
    }

    .table>thead:first-child>tr:first-child>td,
    .table>thead:first-child>tr:first-child>th {
        border-top: 1px solid black !important;
        border-bottom: 0px transparent !important;
        /*border-bottom : 1px solid black !important;
        background-color: #CFE2F3 !important;*/
    }

    .table>thead:first-child>tr:first-child>td:nth-child(1),
    .table>thead:first-child>tr:first-child>th:nth-child(1),
    .table>thead:first-child>tr:first-child>td:nth-child(2),
    .table>thead:first-child>tr:first-child>th:nth-child(2),
    .table>thead:first-child>tr:first-child>td:nth-child(3),
    .table>thead:first-child>tr:first-child>th:nth-child(3) {
        border-bottom: 1px dashed #ccc !important;
    }

    .table>thead:first-child>tr:last-child>td,
    .table>thead:first-child>tr:last-child>th {
        /*border-top: 1px solid black !important;*/
        border-bottom: 1px solid black !important;
        /*background-color: #CFE2F3 !important;*/
    }

    .table>tbody>tr.xCNTrSubFooter {
        border-top: 1px solid black !important;
        border-bottom: 1px solid black !important;
        /*background-color: #CFE2F3 !important;*/
    }

    .table>tbody>tr.xCNTrFooter {
        border-top: 1px solid black !important;
        /*background-color: #CFE2F3 !important;*/
        border-bottom: 6px double black !important;
    }

    .table>tbody>tr.xCNRptLastPdtList>td:nth-child(3),
    .table>tbody>tr.xCNRptLastPdtList>td:nth-child(4),
    .table>tbody>tr.xCNRptLastPdtList>td:nth-child(5),
    .table>tbody>tr.xCNRptLastPdtList>td:nth-child(6),
    .table>tbody>tr.xCNRptLastPdtList>td:nth-child(7) {
        border: 0px solid black !important;
        border-bottom: 1px dashed #ccc !important;
    }

    .table tbody tr.xCNRptLastGroupTr,
    .table>tbody>tr.xCNRptLastGroupTr>td {
        border: 0px solid black !important;
        border-bottom: 1px dashed #ccc !important;
    }

    .table tbody tr.xCNHeaderGroup, .table>tbody>tr.xCNHeaderGroup>td {
        /* color: #232C3D !important; */
        font-size: 18px !important;
        font-weight: 600;
    }

    .table tbody tr.xCNRptSumFooterTrTop,
    .table>tbody>tr.xCNRptSumFooterTrTop>td {
        border: 0px solid black !important;
        border-top: 1px solid black !important;
    }

    .table tbody tr.xCNRptSumFooterTrBottom,
    .table>tbody>tr.xCNRptSumFooterTrBottom>td {
        border: 0px solid black !important;
        border-bottom: 1px solid black !important;
    }

    .table>tfoot>tr {
        border-top: 1px solid black !important;
        border-bottom: 6px double black !important;
    }

    .xWRptProductFillData>td:first-child {
        text-indent: 40px;
    }

    /*แนวนอน*/
    /* @media print{@page {size: landscape}} */
    /*แนวตั้ง*/
    @media print {
        @page {
            size: portrait
        }
    }
</style>



<div id="odvRptProductTransferHtml">
    <div class="container-fluid xCNLayOutRptHtml">
        <div class="xCNHeaderReport">
            <div class="row">
                <?php include 'application\modules\report\datasources\Address\wRptAddress.php'; ?>
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                    <div class="text-center">
                        <label class="xCNRptTitle"><?php echo $aDataTextRef['tTitleReport']; ?></label>
                    </div>

                    <!-- ============================ ฟิวเตอร์ข้อมูล สาขา ============================ -->
                    <div class="report-filter">
                        <?php if ((isset($aDataFilter['tDocDateFrom']) && !empty($aDataFilter['tDocDateFrom'])) && (isset($aDataFilter['tDocDateTo']) && !empty($aDataFilter['tDocDateTo']))) : ?>
                            <!-- ============================ ฟิวเตอร์ข้อมูล วันที่สร้างเอกสาร ============================ -->
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="text-center xCNRptFilter">
                                        <label><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptDateFrom']; ?> : </span> <?php echo date('d/m/Y',strtotime($aDataFilter['tDocDateFrom'])); ?></label>
                                        <label><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptDateTo']; ?> : </span> <?php echo date('d/m/Y',strtotime($aDataFilter['tDocDateTo'])); ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ((isset($aDataFilter['tBchCodeFrom']) && !empty($aDataFilter['tBchCodeFrom'])) && (isset($aDataFilter['tBchCodeTo']) && !empty($aDataFilter['tBchCodeTo']))) { ?>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="text-center">
                                        <label class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptBchFrom']?> : </label>   <label><?=$aDataFilter['tBchNameFrom'];?></label>&nbsp;
                                        <label class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptBchTo']?> : </label>     <label><?=$aDataFilter['tBchNameTo']; ?></label>
                                    </div>
                                </div>
                            </div>
                        <?php }; ?>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
                        <div class="text-right">
                            <?php date_default_timezone_set('Asia/Bangkok'); ?>
                            <label class="xCNRptDataPrint"><?php echo $aDataTextRef['tDatePrint'].' '.date('d/m/Y').' '.$aDataTextRef['tTimePrint'].' '.date('H:i:s');?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="xCNContentReport">
            <div id="odvRptTableAdvance" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-left xCNRptColumnHeader" width="20%"><?php echo $aDataTextRef['tRptProductRefillDocNo']; ?></th>
                            <th class="text-left xCNRptColumnHeader" width="17%"><?php echo $aDataTextRef['tRptProductRefillDate']; ?></th>
                            <th class="text-left xCNRptColumnHeader" colspan="1" width="13%"></th>
                            <th class="text-left xCNRptColumnHeader" colspan="7" width="50%"></th>
                        </tr>
                        <tr>
                            <th class="text-left xCNRptColumnHeader"><?php echo $aDataTextRef['tRptRowNumber']; ?></th>
                            <th class="text-left xCNRptColumnHeader" colspan="2"><?php echo $aDataTextRef['tRptProductRefillName']; ?></th>
                            <th class="text-left xCNRptColumnHeader"><?php echo $aDataTextRef['tRptProductRefillChannelgroup']; ?></th>
                            <th class="text-left xCNRptColumnHeader"><?php echo $aDataTextRef['tRptProductRefillfloor']; ?></th>
                            <th class="text-left xCNRptColumnHeader"><?php echo $aDataTextRef['tRptProductRefillspiral']; ?></th>
                            <th class="text-right xCNRptColumnHeader"><?php echo $aDataTextRef['tRptProductRefillAmounttofill']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($aDataReport['aRptData']) && !empty($aDataReport['aRptData'])) { ?>
                            <?php foreach ($aDataReport['aRptData'] AS $nKey => $aValue) {  ?>

                                <?php
                                    $tRptGtpBchCode = "";
                                    $tRptGtpShpCode = "";
                                    $tRptGtpWahCode = "";
                                    $tRptGtpDocNo   = "";

                                    $nCountBchCode  = 0;
                                    $nCountShpCode  = 0;
                                    $nCountWahCode  = 0;
                                    $nCountDocNo    = 0;
                                ?>

                                <?php
                                    $tRptFTXshDocNo     = $aValue['FTXthDocNo']; //รหัสเอกสาร
                                    $tRptFDXthDocDate   = date('Y-m-d',strtotime($aValue["FDXthDocDate"]));  //วันที่เอกสาร

                                    $tRptBchCode        = $aValue["FTBchCode"];  //รหัสสาขา
                                    $tRptBchName        = $aValue["FTBchName"];  //ชื่อสาขา

                                    $tRptShpCode        = $aValue['FTXthShopTo']; //รหัสร้านค้า
                                    $tRptShpName        = $aValue['FTShpName'];  //ชื่อร้านค้า

                                    $tRptWahFrm         = $aValue['FTXthWhFrm'];  //จากรหัสคลัง
                                    $tRptWahNameFrm     = $aValue['FTWahNameFrm']; // จากชื่อคลัง

                                    $tRptWahTo          = $aValue['FTXthWhTo']; //ถึงรหัสคลัง
                                    $tRptWahNameTo      = $aValue['FTWahNameTo']; //ถึงชื่อคลัง

                                    $tRptPdtCode        = $aValue['FTPdtCode']; //รหัสสินค้า
                                    $tPdtName           = $aValue['FTPdtName']; //ชื่อสินค้า
                                    $tRptCabSeq         = $aValue['FNCabSeq'];
                                    $tRptCabName        = $aValue['FTCabName'];  //ชื่อตู้

                                    $tRptLayCol         = $aValue['FNLayCol'];
                                    $tRptLayRow         = $aValue['FNLayRow'];

                                    $nGroupMember       = $aValue["FNRptGroupMember"];
                                    $nRowPartID         = $aValue["FNRowPartID"];

                                    $tCreateBy          = $aValue['FTUsrName'];  //ผู้เติม

                                    $tRptFCXtdQty       = number_format($aValue["FCXtdQty"],2); //จำนวนเต็ม
                                    $tRptFCXtdQty_SubTotal  = number_format($aValue["FCXtdQty_SubTotal"],2);


                                    //Groupping  Branch
                                    if($aValue['FNRowPartIDBch'] == 1){
                                        if(isset($tRptBchCode) && !empty($tRptBchCode)){
                                            $tTextBrachName  = $aDataTextRef['tRptBranch'].' '.$aValue["FTBchName"];
                                        }else{
                                            $tTextBrachName = $aDataTextRef['tRptNotFoundBranch'];
                                        }

                                        //เส้น Group
                                        if ($nRowPartID == $nGroupMember) {
                                            echo "<tr><td class='xCNRptGrouPing' colspan='8' style='border-top: dashed 1px #333 !important;'></td></tr>";
                                        }

                                        $aGrouppingDataBch  = array($tTextBrachName);
                                        echo "<tr>";
                                        for ($i = 0; $i < FCNnHSizeOf($aGrouppingDataBch); $i++) {
                                            if (strval($aGrouppingDataBch[$i]) != "N") {
                                                echo "<td class='xCNRptGrouPing text-left' style='padding: 5px;' colspan='8'>" . $aGrouppingDataBch[$i] . "</td>";
                                            } else {
                                                echo "<td></td>";
                                            }
                                        }
                                        echo "<tr>";
                                        $tRptGtpBchCode = $tRptBchCode;
                                        $nCountBchCode + 1;


                                    }


                                    //Groupping  Shop
                                    if($aValue['FNRowPartIDShp'] == 1){
                                        if(isset($tRptShpCode) && !empty($tRptShpCode)){
                                            $tTextShopName  = $aDataTextRef['tRptshop'].' '.$aValue["FTShpName"];
                                        }else{
                                            $tTextShopName = $aDataTextRef['tRptNotFoundShop'];
                                        }
                                        $aGrouppingDataShp  = array($tTextShopName);
                                        echo "<tr>";
                                        for ($i = 0; $i < FCNnHSizeOf($aGrouppingDataShp); $i++) {
                                            if (strval($aGrouppingDataShp[$i]) != "N") {
                                                echo "<td class='xCNRptGrouPing text-left' style='padding: 5px;' colspan='8'>" .$aGrouppingDataShp[$i] . "</td>";
                                            } else {
                                                echo "<td></td>";
                                            }
                                        }
                                        echo "<tr>";
                                        $tRptGtpShpCode = $tRptShpCode;
                                        $nCountShpCode + 1;
                                    }

                                     if($aValue['FNRowPartIDDoc'] == 1){
                                        $tNameWahFrm  = $aDataTextRef['tRptFrom'].' '.$aValue['FTWahNameFrm'];  //จากคลัง
                                        $tNameWahTo   = $aDataTextRef['tRptTo'].' '.$aValue['FTWahNameTo']; //ถึงคลัง
                                        $tUsrName     = $aDataTextRef['tRptFill'].' '.$aValue['FTUsrName'];

                                        $aGrouppingDataDocNo  = array($tRptFTXshDocNo, $tRptFDXthDocDate, $tNameWahFrm, $tNameWahTo, $tUsrName);
                                        echo "<tr class='xCNHeaderGroup'>";
                                            for($i = 0;$i<FCNnHSizeOf($aGrouppingDataDocNo);$i++){
                                                if($aGrouppingDataDocNo[$i] !== 'N'){
                                                    echo "<td nowrap style='padding: 5px;'>".$aGrouppingDataDocNo[$i]."</td>";
                                                }else{
                                                    echo "<td></td>";
                                                }
                                            }
                                        echo "</tr>";
                                    }


                                ?>

                                <tr class="xWRptProductFillData">
                                    <td class="text-left xCNRptDetail"><?php echo $aValue['FNRowPartID'].'   '.$aValue['FTPdtCode']; ?></td>
                                    <td class="text-left xCNRptDetail"><?php echo $aValue['FTPdtName']; ?></td>
                                    <td class="text-left xCNRptDetail"></td>
                                    <td class="text-left xCNRptDetail"><?php echo $aValue['FTCabName'];?></td>
                                    <td class="text-left xCNRptDetail"><?php echo $aValue["FNLayRow"];?></td>
                                    <td class="text-left xCNRptDetail"><?php echo $aValue["FNLayCol"];?></td>
                                    <td class="text-right xCNRptDetail"><?php echo $tRptFCXtdQty;?></td>
                                </tr>



                            <?php  } ?>
                        <?php }else { ?>
                            <tr><td class='text-center xCNTextDetail2' colspan='100%'><?php echo $aDataTextRef['tRptAdjStkNoData'];?></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if ((isset($aDataFilter['tWahNameFrom']) && !empty($aDataFilter['tWahNameFrom'])) && (isset($aDataFilter['tWahNameTo']) && !empty($aDataFilter['tWahNameTo']))
                        || (isset($aDataFilter['tMerCodeFrom']) && !empty($aDataFilter['tMerCodeFrom'])) && (isset($aDataFilter['tMerCodeTo']) && !empty($aDataFilter['tMerCodeTo']))
                        || (isset($aDataFilter['tShpCodeFrom']) && !empty($aDataFilter['tShpCodeFrom'])) && (isset($aDataFilter['tShpCodeTo']) && !empty($aDataFilter['tShpCodeTo']))
                        || (isset($aDataFilter['tPosCodeFrom']) && !empty($aDataFilter['tPosCodeFrom'])) && (isset($aDataFilter['tPosCodeTo']) && !empty($aDataFilter['tPosCodeTo']))
                        || (isset($aDataFilter['tWahCodeFrom']) && !empty($aDataFilter['tWahCodeFrom'])) && (isset($aDataFilter['tWahCodeTo']) && !empty($aDataFilter['tWahCodeTo']))
                        || (isset($aDataFilter['tBchCodeSelect']))
                        || (isset($aDataFilter['tMerCodeSelect']))
                        || (isset($aDataFilter['tShpCodeSelect']))
                        || (isset($aDataFilter['tPosCodeSelect']))
                        || (isset($aDataFilter['tWahCodeSelect']))
                        ){ ?>
            <div class="xCNRptFilterTitle">
                <div class="text-left">
                    <label class="xCNTextConsOth"><?=$aDataTextRef['tRptConditionInReport'];?></label>
                </div>
            </div>
            <?php } ;?>

            <!-- ============================ ฟิวเตอร์ข้อมูล สาขา ============================ -->
            <?php if (isset($aDataFilter['tBchCodeSelect']) && !empty($aDataFilter['tBchCodeSelect'])) : ?>
                <div class="xCNRptFilterBox">
                    <div class="xCNRptFilter">
                        <label class="xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptBchFrom']; ?> : </span> <?php echo ($aDataFilter['bBchStaSelectAll']) ? $aDataTextRef['tRptAll'] : $aDataFilter['tBchNameSelect']; ?></label>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ============================ ฟิวเตอร์ข้อมูล กลุ่มธุรกิจ ============================ -->
            <?php if ((isset($aDataFilter['tMerCodeFrom']) && !empty($aDataFilter['tMerCodeFrom'])) && (isset($aDataFilter['tMerCodeTo']) && !empty($aDataFilter['tMerCodeTo']))) : ?>
                <div class="xCNRptFilterBox">
                    <div class="text-left xCNRptFilter">
                        <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjMerChantFrom'].' : </span>'.$aDataFilter['tMerNameFrom'];?></label>
                        <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjMerChantTo'].' : </span>'.$aDataFilter['tMerNameTo'];?></label>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($aDataFilter['tMerCodeSelect']) && !empty($aDataFilter['tMerCodeSelect'])) : ?>
                <div class="xCNRptFilterBox">
                    <div class="xCNRptFilter">
                        <label class="xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptMerFrom']; ?> : </span> <?php echo ($aDataFilter['bMerStaSelectAll']) ? $aDataTextRef['tRptAll'] : $aDataFilter['tMerNameSelect']; ?></label>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ============================ ฟิวเตอร์ข้อมูล ร้านค้า ============================ -->
            <?php if ((isset($aDataFilter['tShpCodeFrom']) && !empty($aDataFilter['tShpCodeFrom'])) && (isset($aDataFilter['tShpCodeTo']) && !empty($aDataFilter['tShpCodeTo']))) : ?>
                <div class="xCNRptFilterBox">
                    <div class="text-left xCNRptFilter">
                        <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjShopFrom'].' : </span>'.$aDataFilter['tShpNameFrom'];?></label>
                        <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjShopTo'].' : </span>'.$aDataFilter['tShpNameTo'];?></label>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($aDataFilter['tShpCodeSelect']) && !empty($aDataFilter['tShpCodeSelect'])) : ?>
                <div class="xCNRptFilterBox">
                    <div class="xCNRptFilter">
                        <label class="xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptShopFrom']; ?> : </span> <?php echo ($aDataFilter['bShpStaSelectAll']) ? $aDataTextRef['tRptAll'] : $aDataFilter['tShpNameSelect']; ?></label>
                    </div>
                </div>
            <?php endif; ?>

            <!-- ============================ ฟิวเตอร์ข้อมูล จุดขาย ============================ -->
            <?php if ((isset($aDataFilter['tPosCodeFrom']) && !empty($aDataFilter['tPosCodeFrom'])) && (isset($aDataFilter['tPosCodeTo']) && !empty($aDataFilter['tPosCodeTo']))) : ?>
                <div class="xCNRptFilterBox">
                        <div class="text-left xCNRptFilter">
                            <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjPosFrom'].' : </span>'.$aDataFilter['tPosCodeFrom'];?></label>
                            <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjPosTo'].' : </span>'.$aDataFilter['tPosCodeTo'];?></label>
                        </div>
                    </div>
            <?php endif; ?>
            <?php if (isset($aDataFilter['tPosCodeSelect']) && !empty($aDataFilter['tPosCodeSelect'])) : ?>
                <div class="xCNRptFilterBox">
                    <div class="xCNRptFilter">
                        <label class="xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptPosFrom']; ?> : </span> <?php echo ($aDataFilter['bPosStaSelectAll']) ? $aDataTextRef['tRptAll'] : $aDataFilter['tPosCodeSelect']; ?></label>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ((isset($aDataFilter['tWahCodeFrom']) && !empty($aDataFilter['tWahCodeFrom'])) && (isset($aDataFilter['tWahCodeTo']) && !empty($aDataFilter['tWahCodeTo']))) : ?>
                <div class="xCNRptFilterBox">
                    <div class="text-left xCNRptFilter">
                        <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjWahFrom'].' : </span>'.$aDataFilter['tWahNameFrom'];?></label>
                        <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjWahTo'].' : </span>'.$aDataFilter['tWahNameTo'];?></label>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($aDataFilter['tWahCodeSelect']) && !empty($aDataFilter['tWahCodeSelect'])) : ?>
                <div class="xCNRptFilterBox">
                    <div class="xCNRptFilter">
                        <label class="xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptAdjWahFrom']; ?> : </span> <?php echo ($aDataFilter['bWahStaSelectAll']) ? $aDataTextRef['tRptAll'] : $aDataFilter['tWahNameSelect']; ?></label>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="xCNFooterPageRpt">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="text-right">
                        <?php if($aDataReport["aPagination"]["nTotalPage"] > 0):?>
                            <label class="xCNRptLabel"><?php echo $aDataReport["aPagination"]["nDisplayPage"].' / '.$aDataReport["aPagination"]["nTotalPage"]; ?></label>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $aCompanyInfo       = $aDataViewRpt['aCompanyInfo'];
    $aDataFilter        = $aDataViewRpt['aDataFilter'];
    $aDataTextRef       = $aDataViewRpt['aDataTextRef'];
    $aDataReport        = $aDataViewRpt['aDataReport'];
    $nOptDecimalShow    = $aDataViewRpt['nOptDecimalShow'];
?>
<style>
    .xCNFooterRpt {
        border-bottom : 7px double #ddd;
    }

    .table thead th, .table>thead>tr>th, .table tbody tr, .table>tbody>tr>td {
        border: 0px transparent !important;
    }

    .table>thead:first-child>tr:first-child>td, .table>thead:first-child>tr:first-child>th {
        border-top: 1px solid black !important;
        border-bottom: dashed 1px #333 !important;
    }


    .xWRptMovePosVDData>td:first-child{
        text-indent: 40px;
    }

    /*แนวนอน*/
    @media print{@page {
        size: A4 landscape;
        margin: 5mm 5mm 5mm 5mm;
    }}
</style>
<div id="odvRptMovePosVDHtml">
    <div class="container-fluid xCNLayOutRptHtml">
        <div class="xCNHeaderReport">

            <div class="row">
                <?php include 'application\modules\report\datasources\Address\wRptAddress.php'; ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="text-center">
                                <label class="xCNRptTitle"><?php echo @$aDataTextRef['tTitleReport'];?></label>
                            </div>
                        </div>
                    </div>

                    <?php if ((isset($aDataFilter['tBchCodeFrom']) && !empty($aDataFilter['tBchCodeFrom'])) && (isset($aDataFilter['tBchCodeTo']) && !empty($aDataFilter['tBchCodeTo']))) { ?>
                        <!-- ============================ ฟิวเตอร์ข้อมูล สาขา ============================ -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="text-center">
                                    <label class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptBchFrom']?> : </label> <label><?= $aDataFilter['tBchNameFrom'];?></label>&nbsp;
                                    <label class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptBchTo']?> : </label> <label><?= $aDataFilter['tBchNameTo'];?></label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ((isset($aDataFilter['tMonth']) && !empty($aDataFilter['tMonth']))){ ?>
                        <!-- ============================ ฟิวเตอร์ข้อมูล เดือน ============================ -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="text-center">
                                    <?php
                                        $tTextMonth = 'tRptMonth'.ltrim($aDataFilter['tMonth'],0);
                                    ?>
                                    <label class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptMonth']?></label> <label><?=$aDataTextRef[$tTextMonth];?></label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ((isset($aDataFilter['tYear']) && !empty($aDataFilter['tYear']))){ ?>
                        <!-- ============================ ฟิวเตอร์ข้อมูล ปี ============================ -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="text-center">
                                    <label class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptYear']?></label> <label><?=$aDataFilter['tYear'];?></label>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 table-responsive">
                    <div class="text-right">
                        <label class="xCNRptDataPrint"><?php echo $aDataTextRef['tDatePrint'].' '.date('d/m/Y').' '.$aDataTextRef['tTimePrint'].' '.date('H:i:s');?></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="xCNContentReport">
            <div id="odvRptTableAdvance" class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                           <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRPC15TBBchCode');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRPC15TBBchName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptPDTWahCode');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptPDTWahName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tFTBarCode');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptPdtCode');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptPdtName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tFTFhnRefCode');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptSbdDepName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptSbdClsName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptSbdSeaName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tFTFabName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptSbdClrName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tRptSbdPszName');?></th>
                            <th nowrap class="text-left xCNRptColumnHeader"><?php echo language('report/report/report','tFTPmoName');?></th>
                            <th nowrap class="text-center xCNRptColumnHeader"><?php echo language('report/report/report','tRptDoc');?></th>
                            <th nowrap class="text-center xCNRptColumnHeader"><?php echo language('report/report/report','tRptDate');?></th>
                            <th nowrap class="text-right xCNRptColumnHeader"><?php echo language('report/report/report','tRptBringF');?></th>
                            <th nowrap class="text-right xCNRptColumnHeader"><?php echo language('report/report/report','tRptIn');?></th>
                            <th nowrap class="text-right xCNRptColumnHeader"><?php echo language('report/report/report','tRptEx');?></th>
                            <th nowrap class="text-right xCNRptColumnHeader"><?php echo language('report/report/report','tRptSale');?></th>
                            <th nowrap class="text-right xCNRptColumnHeader"><?php echo language('report/report/report','tRptAdjud');?></th>
                            <th nowrap class="text-right xCNRptColumnHeader"><?php echo language('report/report/report','tRptInven');?></th>
                        </tr>
            
                    </thead>
                    <tbody>
                        <?php if(isset($aDataReport['aRptData']) && !empty($aDataReport['aRptData'])):?>
                            <?php
                                // Set ตัวแปร SumSubFooter และ ตัวแปร SumFooter
                                $tRptGtpBchCode = "";
                                $tRptGtpWahCode = "";
                                $nCountBchCode  = 0;
                                $nCountWahCode  = 0;
                            ?>
                            <?php foreach ($aDataReport['aRptData'] as $nKey=>$aValue){ ?>
                                <?php
                                    // Step 1 เตรียม Parameter สำหรับการ Groupping
                                    $nStkQtySale = $aValue["FCStkQtySaleDN"];
                                    $nStkQtyCN = $aValue["FCStkQtyCN"];
                                    $nStkQtySale = $nStkQtySale - $nStkQtyCN;

                                    $cFCStkQtyMonEnd = empty($aValue['FCStkQtyMonEnd']) ? 0 : $aValue['FCStkQtyMonEnd'];
                                    $cFCStkQtyIn = empty($aValue['FCStkQtyIn']) ? 0 : $aValue['FCStkQtyIn'];
                                    $cFCStkQtyOut = empty($aValue['FCStkQtyOut']) ? 0 : $aValue['FCStkQtyOut'];
                                    $cFCStkQtyAdj = empty($aValue['FCStkQtyAdj']) ? 0 : $aValue['FCStkQtyAdj'];
                                    $cFCStkQtyBal = empty($aValue['FCStkQtyBal']) ? 0 : $aValue['FCStkQtyBal'];
                                   
                                ?>
                              <tr>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTBchCode']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTBchName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTWahCode']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTWahName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTBarCode']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTPdtCode']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTPdtName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTFhnRefCode']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTDepName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTClsName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTSeaName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTFabName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php if(!empty($aValue['FTClrRmk'])){ echo '('.$aValue['FTClrRmk'].') '; } echo $aValue['FTClrName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTPszName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTPmoName']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo $aValue['FTStkDocNo']; ?></td>
                                    <td nowrap class="text-left xCNRptDetail"><?php echo date("d/m/Y H:i:s", strtotime($aValue['FDStkDate'])); ?></td>
                                    <td nowrap class="text-right xCNRptDetail"><?php echo number_format($cFCStkQtyMonEnd,$nOptDecimalShow); ?></td>
                                    <td nowrap class="text-right xCNRptDetail"><?php echo number_format($cFCStkQtyIn,$nOptDecimalShow); ?></td>
                                    <td nowrap class="text-right xCNRptDetail"><?php echo number_format($cFCStkQtyOut,$nOptDecimalShow); ?></td>
                                    <td nowrap class="text-right xCNRptDetail"><?php echo number_format(($nStkQtySale*-1),$nOptDecimalShow); ?></td>
                                    <td nowrap class="text-right xCNRptDetail"><?php echo number_format($cFCStkQtyAdj,$nOptDecimalShow); ?></td>
                                    <td nowrap class="text-right xCNRptDetail"><?php echo number_format($cFCStkQtyBal,$nOptDecimalShow); ?></td>
                                </tr>
                                <?php

                                    $nFCStkQtyMonEnd = $aValue["FCStkQtyMonEnd_Footer"];
                                    $nFCStkQtyIn = $aValue["FCStkQtyIn_Footer"];
                                    $nFCStkQtyOut = $aValue["FCStkQtyOut_Footer"];
                                    $nFCStkQtySale = $aValue["FCStkQtySale_Footer"]*-1;
                                    $nFCStkQtyAdj = $aValue["FCStkQtyAdj_Footer"];
                                    $nFCStkQtyBal = $aValue["FCStkQtyBal_Footer"];


                                    $paFooterSumData = array(
                                        $aDataTextRef['tRptTotalFooter'],
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        'N',
                                        number_format($nFCStkQtyMonEnd,$nOptDecimalShow),
                                        number_format($nFCStkQtyIn,$nOptDecimalShow),
                                        number_format($nFCStkQtyOut,$nOptDecimalShow),
                                        number_format($nFCStkQtySale,$nOptDecimalShow),
                                        number_format($nFCStkQtyAdj,$nOptDecimalShow),
                                        number_format($nFCStkQtyBal,$nOptDecimalShow)
                                    );
                                ?>
                            <?php } ?>
                            <?php
                                // Step 6 : สั่ง Summary Footer
                                $nPageNo = $aDataReport["aPagination"]["nDisplayPage"];
                                $nTotalPage = $aDataReport["aPagination"]["nTotalPage"];
                                FCNtHRPTSumFooter($nPageNo, $nTotalPage, $paFooterSumData);
                            ?>
                        <?php else:?>
                            <tr><td class='text-center xCNTextDetail2' colspan='100%'><?php echo $aDataTextRef['tRptAdjStkNoData'];?></td></tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>

            <?php if ((isset($aDataFilter['tPdtCodeFrom']) && !empty($aDataFilter['tPdtCodeFrom'])) && (isset($aDataFilter['tPdtCodeTo']) && !empty($aDataFilter['tPdtCodeTo']))
                    || (isset($aDataFilter['tWahCodeFrom']) && !empty($aDataFilter['tWahCodeFrom'])) && (isset($aDataFilter['tWahCodeTo']) && !empty($aDataFilter['tWahCodeTo']))
                    || (isset($aDataFilter['tMerCodeFrom']) && !empty($aDataFilter['tMerCodeFrom'])) && (isset($aDataFilter['tMerCodeTo']) && !empty($aDataFilter['tMerCodeTo']))
                    || (isset($aDataFilter['tShpCodeFrom']) && !empty($aDataFilter['tShpCodeFrom'])) && (isset($aDataFilter['tShpCodeTo']) && !empty($aDataFilter['tShpCodeTo']))
                    || (isset($aDataFilter['tPosCodeFrom']) && !empty($aDataFilter['tPosCodeFrom'])) && (isset($aDataFilter['tPosCodeTo']) && !empty($aDataFilter['tPosCodeTo']))
                    || (isset($aDataFilter['tBchCodeSelect']))
                    || (isset($aDataFilter['tMerCodeSelect']))
                    || (isset($aDataFilter['tShpCodeSelect']))
                    || (isset($aDataFilter['tPosCodeSelect']))
                    || (isset($aDataFilter['tWahCodeSelect']))
                    ) { ?>
                <div class="xCNRptFilterTitle">
                    <div class="text-left">
                        <label class="xCNTextConsOth"><?=$aDataTextRef['tRptConditionInReport'];?></label>
                    </div>
                </div>
            <?php }; ?>

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

            <!-- ============================ ฟิวเตอร์ข้อมูล คลังสินค้า ============================ -->
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

            <?php if ((isset($aDataFilter['tPdtCodeFrom']) && !empty($aDataFilter['tPdtCodeFrom'])) && (isset($aDataFilter['tPdtCodeTo']) && !empty($aDataFilter['tPdtCodeTo']))) : ?>
                <!-- ============================ ฟิวเตอร์ข้อมูล สินค้า ============================ -->
                <div class="xCNRptFilterBox">
                    <div class="text-left xCNRptFilter">
                        <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tPdtCodeFrom'].' : </span>'.$aDataFilter['tPdtNameFrom'];?></label>
                        <label class="xCNRptLabel xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tPdtCodeTo'].' : </span>'.$aDataFilter['tPdtNameTo'];?></label>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($aDataFilter['tPdtCodeSelect']) && !empty($aDataFilter['tPdtCodeSelect'])) : ?>
                <div class="xCNRptFilterBox">
                    <div class="xCNRptFilter">
                        <label class="xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tPdtCodeFrom']; ?> : </span> <?php echo ($aDataFilter['bPdtStaSelectAll']) ? $aDataTextRef['tRptAll'] : $aDataFilter['tPdtNameSelect']; ?></label>
                    </div>
                </div>
            <?php endif; ?>

            <?php if( isset($aDataFilter['tPdtStaActive']) && !empty($aDataFilter['tPdtStaActive'])  ){ ?>
                <!-- ============================ ฟิวเตอร์ข้อมูล สถานะเคลื่อนไหว ============================ -->
                <div class="xCNRptFilterBox">
                    <div class="xCNRptFilter">
                        <label class="xCNRptDisplayBlock"><span class="xCNRptFilterHead"><?php echo $aDataTextRef['tRptTitlePdtMoving']; ?> : </span> <?php echo $aDataTextRef['tRptPdtMoving'.$aDataFilter['tPdtStaActive']]?></label>
                    </div>
                </div>
            <?php } ?>


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
<script>
    $(document).ready(function(){
        var oFilterLabel = $('.report-filter .text-left label:first-child');
        var nMaxWidth = 0;
        oFilterLabel.each(function(index){
            var nLabelWidth = $(this).outerWidth();
            if(nLabelWidth > nMaxWidth){
                nMaxWidth = nLabelWidth;
            }
        });
        $('.report-filter .text-left label:first-child').width(nMaxWidth + 50);
    });
</script>

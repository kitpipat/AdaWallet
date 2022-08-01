<div id="odvSrvPriMainMenu" class="main-menu">
    <div class="xCNMrgNavMenu">
        <div class="row xCNavRow" style="width:inherit;">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <ol id="oliMenuNav" class="breadcrumb">
                    <?php FCNxHADDfavorite('PrintBarCode/0/0'); ?>
                    <li id="oliSrvPriTitle" class="xCNLinkClick" style="cursor:pointer" onclick="JSvCallPagePriBar()"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPrintPrice') ?></li>
                </ol>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right p-r-0">
                <div class="demo-button xCNBtngroup" style="width:100%;">
                    <div id="odvBtnAddEdit">
                        <div class="demo-button xCNBtngroup" style="width:100%;">
                            <button type="submit" class="btn  xCNBTNPrimery xWDisBtnMQ" onclick="JSvPriBarSendMQ()"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPrint') ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="xCNMenuCump xCNSrvPriBrowseLine" id="odvMenuCump">&nbsp;</div>
<div class="main-content">
    <div class="">
        <form class="contact100-form validate-form" action="javascript:void(0)" method="post" enctype="multipart/form-data" autocorrect="off" autocapitalize="off" autocomplete="off" id="ofmPrintBarCodeForm" name="ofmPrintBarCodeForm">
            <input type="text" class="xCNHide" id="oetDepositApvCodeUsrLogin" name="oetDepositApvCodeUsrLogin" maxlength="20" value="<?php echo $this->session->userdata('tSesUsername'); ?>">
            <input type="text" class="xCNHide" id="ohdLangEdit" name="ohdLangEdit" maxlength="1" value="<?php echo $this->session->userdata("tLangEdit"); ?>">
            <button style="display:none" type="submit" id="obtDepositSubmit" onclick="JSxDepositValidateForm();"></button>

            <div class="row">
                <!--Panel เงื่อนไข-->
                <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <!--Section : เงื่อนไข-->
                    <div class="panel panel-default" style="margin-bottom: 25px;">
                        <div id="odvHeadStatus" class="panel-heading xCNPanelHeadColor" role="tab" style="padding-top:10px;padding-bottom:10px;">
                            <label class="xCNTextDetail1"><?php echo language('product/settingprinter/settingprinter', 'tLPRTSetFilter') ?></label>
                            <a class="xCNMenuplus" role="button" data-toggle="collapse" href="#odvDataPromotion" aria-expanded="true">
                                <i class="fa fa-plus xCNPlus"></i>
                            </a>
                        </div>
                        <div id="odvDataPromotion" class="panel-collapse collapse in" role="tabpanel">
                            <div class="panel-body xCNPDModlue">
                                <div class="form-group">
                                    <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTReport') ?></label>
                                    <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarSheet' name='oetPrnBarSheet'>
                                    <select class="form-control" name="ocbPrnBarSheet" id="ocbPrnBarSheet" onchange="JSxSelectSheetPrint()">
                                        <option value=""><?php echo language('product/settingprinter/settingprinter', 'tLPRTChooseDoc') ?></option>
                                        <option value="Promotion"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPromotion') ?></option>
                                        <option value="PriceAdjustmentSale"><?php echo language('product/settingprinter/settingprinter', 'tLPRTProAdjus') ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTDocDateFrom') ?></label>
                                            <div class="input-group">
                                                <input type="text" id="oetPrnBarXthDocDateFrom" readonly class="form-control xCNDatePicker   xCNInputMaskDate" name="oetPrnBarXthDocDateFrom" value="" placeholder="YYYY-MM-DD">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarXthDocDateFrom" type="button" class="btn xCNBtnDateTime">
                                                        <img src="<?= base_url() . '/application/modules/common/assets/images/icons/icons8-Calendar-100.png' ?>">
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTDocDateTo') ?></label>
                                            <div class="input-group">
                                                <input type="text" id="oetPrnBarXthDocDateTo" readonly class="form-control xCNDatePicker   xCNInputMaskDate" name="oetPrnBarXthDocDateTo" value="" placeholder="YYYY-MM-DD">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarXthDocDateTo" type="button" class="btn xCNBtnDateTime">
                                                        <img src="<?= base_url() . '/application/modules/common/assets/images/icons/icons8-Calendar-100.png' ?>">
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTDocNoFrom') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowseRptNoFromCode' name='oetPrnBarBrowseRptNoFromCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowseRptNoFromName" name="oetPrnBarBrowseRptNoFromName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowseRptNoFrom" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTDocNoTo') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowseRptNoToCode' name='oetPrnBarBrowseRptNoToCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowseRptNoToName" name="oetPrnBarBrowseRptNoToName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowseRptNoTo" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-width: 0 0 1px;border-style: solid; border-color: #ddd;"></div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtFrom') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtFromCode' name='oetPrnBarBrowsePdtFromCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtFromName" name="oetPrnBarBrowsePdtFromName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtFrom" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtTo') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtToCode' name='oetPrnBarBrowsePdtToCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtToName" name="oetPrnBarBrowsePdtToName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtTo" type="button" class="btn xCNBtnDateTime">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTGrpFrom') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtGrpFromCode' name='oetPrnBarBrowsePdtGrpFromCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtGrpFromName" name="oetPrnBarBrowsePdtGrpFromName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtGrpFrom" type="button" class="btn xCNBtnDateTime">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTGrpTo') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtGrpToCode' name='oetPrnBarBrowsePdtGrpToCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtGrpToName" name="oetPrnBarBrowsePdtGrpToName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtGrpTo" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtTypeFrom') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtTypeFromCode' name='oetPrnBarBrowsePdtTypeFromCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtTypeFromName" name="oetPrnBarBrowsePdtTypeFromName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtTypeFrom" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPdtTypeTo') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtTypeToCode' name='oetPrnBarBrowsePdtTypeToCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtTypeToName" name="oetPrnBarBrowsePdtTypeToName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtTypeTo" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTBrandFrom') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtBrandFromCode' name='oetPrnBarBrowsePdtBrandFromCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtBrandFromName" name="oetPrnBarBrowsePdtBrandFromName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtBrandFrom" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTBrandTo') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtBrandToCode' name='oetPrnBarBrowsePdtBrandToCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtBrandToName" name="oetPrnBarBrowsePdtBrandToName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtBrandTo" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTModelFrom') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtModelFromCode' name='oetPrnBarBrowsePdtModelFromCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtModelFromName" name="oetPrnBarBrowsePdtModelFromName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtModelFrom" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTModelTo') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarBrowsePdtModelToCode' name='oetPrnBarBrowsePdtModelToCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate " readonly id="oetPrnBarBrowsePdtModelToName" name="oetPrnBarBrowsePdtModelToName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarBrowsePdtModelTo" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>






                                <div class="form-group">
                                    <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTCategory1') ?></label>
                                    <div class="input-group">
                                        <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarPdtDepartCode' name='oetPrnBarPdtDepartCode'>
                                        <input type="text" class="form-control  xCNInputMaskDate " id="oetPrnBarPdtDepartName" readonly name="oetPrnBarPdtDepartName" value="" placeholder="ทั้งหมด">
                                        <span class="input-group-btn">
                                            <button id="obtPrnBarPdtDepartBrows" type="button" class="btn xCNBtnDateTime ">
                                                <img class="xCNIconFind"> </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTCategory2') ?></label>
                                    <div class="input-group">
                                        <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarPdtClassCode' name='oetPrnBarPdtClassCode'>
                                        <input type="text" class="form-control  xCNInputMaskDate " id="oetPrnBarPdtClassName" readonly name="oetPrnBarPdtClassName" value="" placeholder="ทั้งหมด">
                                        <span class="input-group-btn">
                                            <button id="obtPrnBarPdtClassBrows" type="button" class="btn xCNBtnDateTime ">
                                                <img class="xCNIconFind"> </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTCategory3') ?></label>
                                    <div class="input-group">
                                        <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarPdtSubClassCode' name='oetPrnBarPdtSubClassCode'>
                                        <input type="text" class="form-control  xCNInputMaskDate " id="oetPrnBarPdtSubClassName" readonly name="oetPrnBarPdtSubClassName" value="" placeholder="ทั้งหมด">
                                        <span class="input-group-btn">
                                            <button id="obtPrnBarPdtSubClassBrows" type="button" class="btn xCNBtnDateTime ">
                                                <img class="xCNIconFind"> </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTCategory4') ?></label>
                                    <div class="input-group">
                                        <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarPdtGroupCode' name='oetPrnBarPdtGroupCode'>
                                        <input type="text" class="form-control  xCNInputMaskDate " id="oetPrnBarPdtGroupName" readonly name="oetPrnBarPdtGroupName" value="" placeholder="ทั้งหมด">
                                        <span class="input-group-btn">
                                            <button id="obtPrnBarPdtGroupBrows" type="button" class="btn xCNBtnDateTime ">
                                                <img class="xCNIconFind"> </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTCategory5') ?></label>
                                    <div class="input-group">
                                        <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarPdtComLinesCode' name='oetPrnBarPdtComLinesCode'>
                                        <input type="text" class="form-control  xCNInputMaskDate " id="oetPrnBarPdtComLinesName" readonly name="oetPrnBarPdtComLinesName" value="" placeholder="ทั้งหมด">
                                        <span class="input-group-btn">
                                            <button id="obtPrnBarPdtComLinesBrows" type="button" class="btn xCNBtnDateTime ">
                                                <img class="xCNIconFind"> </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTTotalList') ?></label>
                                    <div class="from-group">
                                        <input type="text" class="form-control xCNInputNumericWithoutDecimal text-right" maxlength="6" id="oetPrnBarTotalPrint" name="oetPrnBarTotalPrint" value="1">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            <div class="row">
                                                <button type="button" id="odvEventImportFilePRT" class="btn xCNBTNImportFile"><?= language('common/main/main', 'tImport') ?></button>
                                        
                                            </div>
                                        </div>
                                        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8  text-right">
                                            <div class="row">
                                                <button onclick="JSvCallPagePriBar()" id="oetClearShowDataTableProduct" class="btn xCNBTNDefult xCNBTNDefult2Btn" type="button">ล้างข้อมูล</button>
                                                <button onclick="JSvPriBarDataTable()" id="oetShowDataTableProduct" class="btn xCNBTNPrimery" type="button">แสดงรายการสินค้า</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--Panel ตารางฝั่งขวา-->
                <div class=" col-xs-12 col-sm-8 col-md-8 col-lg-8" id="odvRightPanal">
                    <div class="panel panel-default xCNDepositCashContainer" style="margin-bottom: 25px;">
                        <div id="odvHeadGeneralInfo" class="panel-heading xCNPanelHeadColor" role="tab" style="padding-top:10px;padding-bottom:10px;">
                            <label class="xCNTextDetail1"><?php echo language('product/settingprinter/settingprinter', 'tLPRTPrintTerms') ?></label>
                            <div style="position: absolute;right: 15px;top:-5px;">

                                <!-- <button type="button" class="xCNBTNPrimeryCusPlus" data-toggle="modal" data-target="#odvDepositPopupCashAdd">+</button> -->

                            </div>

                        </div>

                        <!-- เงื่อนไขการพิมพ์ -->
                        <div class="panel-collapse collapse in" role="tabpanel">
                            <div class="panel-body xCNPDModlue">
                                <!-- <div id="odvDepositCashDataTable"></div> -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPTitle') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarPrnLableCode' name='oetPrnBarPrnLableCode'>
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarPrnLableCodeRef' name='oetPrnBarPrnLableCodeRef'>
                                                <input type="text" class="form-control  xCNInputMaskDate" readonly id="oetPrnBarPrnLableName" name="oetPrnBarPrnLableName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarPrnLableBrowse" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tSPTitle') ?></label>
                                            <div class="input-group">
                                                <input type='text' class='form-control xCNHide xWRptAllInput' id='oetPrnBarPrnSrvCode' name='oetPrnBarPrnSrvCode'>
                                                <input type="text" class="form-control  xCNInputMaskDate" readonly id="oetPrnBarPrnSrvName" name="oetPrnBarPrnSrvName" value="" placeholder="ทั้งหมด">
                                                <span class="input-group-btn">
                                                    <button id="obtPrnBarPrnSrvBrowse" type="button" class="btn xCNBtnDateTime ">
                                                        <img class="xCNIconFind"> </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="panel panel-default xCNDepositCashContainer" style="margin-bottom: 25px;">
                        <div class="panel-body xCNPDModlue">
                            <label class="xCNLabelFrm"><?php echo language('product/settingprinter/settingprinter', 'tLPRTSeachProductData') ?></label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control xCNInpuTXOthoutSingleQuote" type="text" id="oetSearchAllDocumentPrint" name="oetSearchAllDocumentPrint" placeholder="<?php echo language('document/conditionredeem/conditionredeem', 'tRDHFillTextSearch') ?>" autocomplete="off">
                                    <span class="input-group-btn">
                                        <button id="obtSerchAllDocumentPrint" type="button" class="btn xCNBtnDateTime"><img class="xCNIconSearch"></button>
                                    </span>
                                </div>
                            </div>

                            <div id="odvDataPagePrintBarCode"></div>
                            
                        </div>
                    </div>

                </div>
        </form>

    </div>
</div>



<div id="odvPRNModalSendPrint" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header xCNModalHead">
                <label class="xCNTextModalHeard">ยืนยันการสั่งพิมพ์</label>
            </div>
            <div class="modal-body">
                <span id="ospTextSendPrint" class="xCNTextModal" style="display: inline-block; word-break:break-all"></span>
            </div>
            <div class="modal-footer">
                <button id="osmConfirmSendPrint" class="btn xCNBTNPrimery xCNBTNPrimery2Btn" type="button"><?php echo language('common/main/main', 'tModalConfirm') ?></button>
                <button class="btn xCNBTNDefult xCNBTNDefult2Btn" type="button" data-dismiss="modal"><?php echo language('common/main/main', 'tModalCancel') ?></button>
            </div>
        </div>
    </div>
</div>


<div id="odvPRNModalAlertPrint" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header xCNModalHead">
                <label class="xCNTextModalHeard">แจ้งเตือน</label>
            </div>
            <div class="modal-body">
                <span id="ospTextAlertPrint" class="xCNTextModal" style="display: inline-block; word-break:break-all"></span>
            </div>
            <div class="modal-footer">
                <!-- <button id="osmConfirmAlertPrint" class="btn xCNBTNPrimery xCNBTNPrimery2Btn" type="button"><?php echo language('common/main/main', 'tModalConfirm') ?></button> -->
                <button class="btn xCNBTNDefult xCNBTNDefult2Btn" type="button" data-dismiss="modal"><?php echo language('common/main/main', 'tModalCancel') ?></button>
            </div>
        </div>
    </div>
</div>

<div id="odvModalBodyBrowse" class="modal-body xCNModalBodyAdd">
</div>



<script>
    $(document).ready(function() {
        JSxCheckPinMenuClose(); /*Check เปิดปิด Menu ตาม Pin*/
        $('.selectpicker').selectpicker();

        $('.xCNDatePicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: false,
            immediateUpdates: false,
        });

        $('#obtPrnBarXthDocDateFrom').click(function() {
            event.preventDefault();
            $('#oetPrnBarXthDocDateFrom').datepicker('show');
        });

        $('#obtPrnBarXthDocDateTo').click(function() {
            event.preventDefault();
            $('#oetPrnBarXthDocDateTo').datepicker('show');
        });



        if ($('#ocbPrnBarSheet').val() != '') {
            $('#obtPrnBarXthDocDateFrom').prop('disabled', false);
            $('#obtPrnBarXthDocDateTo').prop('disabled', false);
            $('#obtPrnBarBrowseRptNoFrom').prop('disabled', false);
            $('#obtPrnBarBrowseRptNoTo').prop('disabled', false);
            $('#oetPrnBarXthDocDateFrom').prop('disabled', false);
            $('#oetPrnBarXthDocDateTo').prop('disabled', false);

            // $('#oetPrnBarXthDocDateFrom').val('');
            // $('#oetPrnBarXthDocDateTo').val('');
            // $('#oetPrnBarBrowseRptNoFromCode').val('');
            // $('#oetPrnBarBrowseRptNoFromName').val('');
            // $('#oetPrnBarBrowseRptNoToCode').val('');
            // $('#oetPrnBarBrowseRptNoToName').val('');
        } else {
            $('#obtPrnBarXthDocDateFrom').prop('disabled', true);
            $('#obtPrnBarXthDocDateTo').prop('disabled', true);
            $('#obtPrnBarBrowseRptNoFrom').prop('disabled', true);
            $('#obtPrnBarBrowseRptNoTo').prop('disabled', true);
            $('#oetPrnBarXthDocDateFrom').prop('disabled', true);
            $('#oetPrnBarXthDocDateTo').prop('disabled', true);
        }

        JSvPriBarDataTableFirstLap();
    });

    function JSvPriBarDataTableFirstLap(pnPage, ptPlbCode) {
        try {
            var nPageCurrent = pnPage;
            var tPlbCode = ptPlbCode;
            if (nPageCurrent == undefined || nPageCurrent == '') {
                nPageCurrent = '1';
            }
            if (tPlbCode == undefined || tPlbCode == '') {
                tPlbCode = '1';
            }
            JCNxOpenLoading();
            $.ajax({
                type: "POST",
                url: "PrintBarCodeDataTable",
                data: {
                    nPageCurrent: nPageCurrent,
                    tPlbCode: tPlbCode,
                    tPrnBarSheet: $('#ocbPrnBarSheet').val(),
                    tPrnBarXthDocDateFrom: $('#oetPrnBarXthDocDateFrom').val(),
                    tPrnBarXthDocDateTo: $('#oetPrnBarXthDocDateTo').val(),
                    tPrnBarBrowseRptNoFromCode: $('#oetPrnBarBrowseRptNoFromCode').val(),
                    tPrnBarBrowseRptNoToCode: $('#oetPrnBarBrowseRptNoToCode').val(),
                    tPrnBarBrowsePdtFromCode: $('#oetPrnBarBrowsePdtFromCode').val(),
                    tPrnBarBrowsePdtToCode: $('#oetPrnBarBrowsePdtToCode').val(),
                    tPrnBarBrowsePdtGrpFromCode: $('#oetPrnBarBrowsePdtGrpFromCode').val(),
                    tPrnBarBrowsePdtGrpToCode: $('#oetPrnBarBrowsePdtGrpToCode').val(),
                    tPrnBarBrowsePdtTypeFromCode: $('#oetPrnBarBrowsePdtTypeFromCode').val(),
                    tPrnBarBrowsePdtTypeToCode: $('#oetPrnBarBrowsePdtTypeToCode').val(),
                    tPrnBarBrowsePdtBrandFromCode: $('#oetPrnBarBrowsePdtBrandFromCode').val(),
                    tPrnBarBrowsePdtBrandToCode: $('#oetPrnBarBrowsePdtBrandToCode').val(),
                    tPrnBarBrowsePdtModelFromCode: $('#oetPrnBarBrowsePdtModelFromCode').val(),
                    tPrnBarBrowsePdtModelToCode: $('#oetPrnBarBrowsePdtModelToCode').val(),
                    tPrnBarPdtDepartCode: $('#oetPrnBarPdtDepartCode').val(),
                    tPrnBarPdtClassCode: $('#oetPrnBarPdtClassCode').val(),
                    tPrnBarPdtSubClassCode: $('#oetPrnBarPdtSubClassCode').val(),
                    tPrnBarPdtGroupCode: $('#oetPrnBarPdtGroupCode').val(),
                    tPrnBarPdtComLinesCode: $('#oetPrnBarPdtComLinesCode').val(),
                    tPrnBarTotalPrint: $('#oetPrnBarTotalPrint').val(),
                    // aData: $("#ofmPrintBarCodeForm").serialize()
                },
                cache: false,
                Timeout: 5000,
                success: function(tResult) {
                    if (tResult != "") {
                        $('#odvDataPagePrintBarCode').html(tResult);
                    }
                    JCNxCloseLoading();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    JCNxResponseError(jqXHR, textStatus, errorThrown);
                }
            });
        } catch (err) {
            console.log('JSvPriBarDataTable Error: ', err);
        }
    };

    function JSxSelectSheetPrint() {
        var tPrnBarSheet = $('#ocbPrnBarSheet').val();
        $('#oetPrnBarSheet').val(tPrnBarSheet)

        if ($('#ocbPrnBarSheet').val() != '') {
            $('#obtPrnBarXthDocDateFrom').prop('disabled', false);
            $('#obtPrnBarXthDocDateTo').prop('disabled', false);
            $('#obtPrnBarBrowseRptNoFrom').prop('disabled', false);
            $('#obtPrnBarBrowseRptNoTo').prop('disabled', false);
            $('#oetPrnBarXthDocDateFrom').prop('disabled', false);
            $('#oetPrnBarXthDocDateTo').prop('disabled', false);

            // $('#oetPrnBarXthDocDateFrom').val('');
            // $('#oetPrnBarXthDocDateTo').val('');
            // $('#oetPrnBarBrowseRptNoFromCode').val('');
            // $('#oetPrnBarBrowseRptNoFromName').val('');
            // $('#oetPrnBarBrowseRptNoToCode').val('');
            // $('#oetPrnBarBrowseRptNoToName').val('');
        } else {
            $('#obtPrnBarXthDocDateFrom').prop('disabled', true);
            $('#obtPrnBarXthDocDateTo').prop('disabled', true);
            $('#obtPrnBarBrowseRptNoFrom').prop('disabled', true);
            $('#obtPrnBarBrowseRptNoTo').prop('disabled', true);
            $('#oetPrnBarXthDocDateFrom').prop('disabled', true);
            $('#oetPrnBarXthDocDateTo').prop('disabled', true);
        }
    }


    $('#obtSerchAllDocumentPrint').click(function() {
        JSvPriBarCallDataTable(1);
    });

    // Create By : Napat(Jame) 23/03/2022
    function JSvPriBarCallDataTable(pnPage){
        try {
            var nPageCurrent = pnPage;
            if (nPageCurrent == undefined || nPageCurrent == '') {
                nPageCurrent = '1';
            }
            JCNxOpenLoading();
            $.ajax({
                type: "POST",
                url: "PrintBarCodeDataTableSearch",
                data: {
                    tSearchAll      : $('#oetSearchAllDocumentPrint').val().trim(),
                    nPageCurrent    : nPageCurrent,
                },
                cache: false,
                Timeout: 0,
                success: function(tResult) {
                    if (tResult != "") {
                        $('#odvDataPagePrintBarCode').html(tResult);
                    }
                    JCNxCloseLoading();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    JCNxResponseError(jqXHR, textStatus, errorThrown);
                }
            });
        } catch (err) {
            console.log('JSvPriBarDataTable Error: ', err);
        }
    }

    /**
     * Functionality : Call Produc Data List
     * Parameters : Ajax Success Event
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : view
     * Return Type : view
     */
    function JSvPriBarDataTable(pnPage, ptPlbCode) {
        try {
            var tPrnBarSheet = $('#ocbPrnBarSheet').val();
            var tPrnBarXthDocDateFrom = $('#oetPrnBarXthDocDateFrom').val();
            var tPrnBarXthDocDateTo = $('#oetPrnBarXthDocDateTo').val();
            var tPrnBarBrowseRptNoFromCode = $('#oetPrnBarBrowseRptNoFromCode').val();
            var tPrnBarBrowseRptNoToCode = $('#oetPrnBarBrowseRptNoToCode').val();
            var tPrnBarBrowsePdtFromCode = $('#oetPrnBarBrowsePdtFromCode').val();
            var tPrnBarBrowsePdtToCode = $('#oetPrnBarBrowsePdtToCode').val();
            var tPrnBarBrowsePdtGrpFromCode = $('#oetPrnBarBrowsePdtGrpFromCode').val();
            var tPrnBarBrowsePdtGrpToCode = $('#oetPrnBarBrowsePdtGrpToCode').val();
            var tPrnBarBrowsePdtTypeFromCode = $('#oetPrnBarBrowsePdtTypeFromCode').val();
            var tPrnBarBrowsePdtTypeToCode = $('#oetPrnBarBrowsePdtTypeToCode').val();
            var tPrnBarBrowsePdtBrandFromCode = $('#oetPrnBarBrowsePdtBrandFromCode').val();
            var tPrnBarBrowsePdtBrandToCode = $('#oetPrnBarBrowsePdtBrandToCode').val();
            var tPrnBarBrowsePdtModelFromCode = $('#oetPrnBarBrowsePdtModelFromCode').val();
            var tPrnBarBrowsePdtModelToCode = $('#oetPrnBarBrowsePdtModelToCode').val();
            var tPrnBarPdtDepartCode = $('#oetPrnBarPdtDepartCode').val();
            var tPrnBarPdtClassCode = $('#oetPrnBarPdtClassCode').val();
            var tPrnBarPdtSubClassCode = $('#oetPrnBarPdtSubClassCode').val();
            var tPrnBarPdtGroupCode = $('#oetPrnBarPdtGroupCode').val();
            var tPrnBarPdtComLinesCode = $('#oetPrnBarPdtComLinesCode').val();
            var tPrnBarTotalPrint = $('#oetPrnBarTotalPrint').val();
            var tPrnBarLableCodeRef = $('#oetPrnBarPrnLableCodeRef').val()

            if (pnPage == 0) {
                var bLoadTable = true
            } else {
                if (tPrnBarSheet != '' || tPrnBarXthDocDateFrom != '' || tPrnBarXthDocDateTo != '' || tPrnBarBrowseRptNoFromCode != '' || tPrnBarBrowseRptNoToCode != '' ||
                    tPrnBarBrowsePdtFromCode != '' ||
                    tPrnBarBrowsePdtToCode != '' ||
                    tPrnBarBrowsePdtGrpFromCode != '' ||
                    tPrnBarBrowsePdtGrpToCode != '' ||
                    tPrnBarBrowsePdtTypeFromCode != '' ||
                    tPrnBarBrowsePdtTypeToCode != '' ||
                    tPrnBarBrowsePdtBrandFromCode != '' ||
                    tPrnBarBrowsePdtBrandToCode != '' ||
                    tPrnBarBrowsePdtModelFromCode != '' ||
                    tPrnBarBrowsePdtModelToCode != '' ||
                    tPrnBarPdtDepartCode != '' ||
                    tPrnBarPdtClassCode != '' ||
                    tPrnBarPdtSubClassCode != '' ||
                    tPrnBarPdtGroupCode != '' ||
                    tPrnBarPdtComLinesCode != '' || tPrnBarLableCodeRef != '') {
                    var bLoadTable = true
                } else {
                    var bLoadTable = false
                    var tTextConfrimAlertPrint = 'กรุณาเลือกเงื่อนไขการกรอง'
                    $('#odvPRNModalAlertPrint #ospTextAlertPrint').html(tTextConfrimAlertPrint);
                    $('#odvPRNModalAlertPrint').modal('show');
                }
            }

            if (bLoadTable == true) {
                var nPageCurrent = pnPage;
                var tPlbCode = ptPlbCode;

                if (pnPage == 0) {
                    bSeleteImport = 1
                } else {
                    bSeleteImport = 0
                }

                if (nPageCurrent == undefined || nPageCurrent == '' || nPageCurrent == 0) {
                    nPageCurrent = '1';
                }
                if (tPlbCode == undefined || tPlbCode == '') {
                    // tPlbCode = '1';
                    tPlbCode = tPrnBarLableCodeRef;
                }

                JCNxOpenLoading();
                $.ajax({
                    type: "POST",
                    url: "PrintBarCodeDataTable",
                    data: {
                        nPageCurrent: nPageCurrent,
                        tPlbCode: tPlbCode,
                        tPrnBarSheet: $('#ocbPrnBarSheet').val(),
                        tPrnBarXthDocDateFrom: $('#oetPrnBarXthDocDateFrom').val(),
                        tPrnBarXthDocDateTo: $('#oetPrnBarXthDocDateTo').val(),
                        tPrnBarBrowseRptNoFromCode: $('#oetPrnBarBrowseRptNoFromCode').val(),
                        tPrnBarBrowseRptNoToCode: $('#oetPrnBarBrowseRptNoToCode').val(),
                        tPrnBarBrowsePdtFromCode: $('#oetPrnBarBrowsePdtFromCode').val(),
                        tPrnBarBrowsePdtToCode: $('#oetPrnBarBrowsePdtToCode').val(),
                        tPrnBarBrowsePdtGrpFromCode: $('#oetPrnBarBrowsePdtGrpFromCode').val(),
                        tPrnBarBrowsePdtGrpToCode: $('#oetPrnBarBrowsePdtGrpToCode').val(),
                        tPrnBarBrowsePdtTypeFromCode: $('#oetPrnBarBrowsePdtTypeFromCode').val(),
                        tPrnBarBrowsePdtTypeToCode: $('#oetPrnBarBrowsePdtTypeToCode').val(),
                        tPrnBarBrowsePdtBrandFromCode: $('#oetPrnBarBrowsePdtBrandFromCode').val(),
                        tPrnBarBrowsePdtBrandToCode: $('#oetPrnBarBrowsePdtBrandToCode').val(),
                        tPrnBarBrowsePdtModelFromCode: $('#oetPrnBarBrowsePdtModelFromCode').val(),
                        tPrnBarBrowsePdtModelToCode: $('#oetPrnBarBrowsePdtModelToCode').val(),
                        tPrnBarPdtDepartCode: $('#oetPrnBarPdtDepartCode').val(),
                        tPrnBarPdtClassCode: $('#oetPrnBarPdtClassCode').val(),
                        tPrnBarPdtSubClassCode: $('#oetPrnBarPdtSubClassCode').val(),
                        tPrnBarPdtGroupCode: $('#oetPrnBarPdtGroupCode').val(),
                        tPrnBarPdtComLinesCode: $('#oetPrnBarPdtComLinesCode').val(),
                        tPrnBarTotalPrint: $('#oetPrnBarTotalPrint').val(),
                        bSeleteImport: bSeleteImport
                        // aData: $("#ofmPrintBarCodeForm").serialize()
                    },
                    cache: false,
                    Timeout: 5000,
                    success: function(tResult) {
                        // console.log(tResult)
                        if (tResult != "") {
                            $('#odvDataPagePrintBarCode').html(tResult);
                        }
                        JCNxCloseLoading();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        JCNxResponseError(jqXHR, textStatus, errorThrown);
                    }
                });

            }



        } catch (err) {
            console.log('JSvPriBarDataTable Error: ', err);
        }
    }

    var nLangEdits = <?php echo $this->session->userdata("tLangEdit") ?>;


    // Browse Event Product
    $('#obtPrnBarBrowsePdtFrom').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oBarPrnProductFromOption = undefined;
            oBarPrnProductFromOption = oPrnBarProductOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtFromCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtFromName',
                'tNextFuncName': 'JSxBarPrnConsNextFuncBrowsePdt',
                'aArgReturn': ['FTPdtCode', 'FTPdtName']
            });
            JCNxBrowseData('oBarPrnProductFromOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });
    $('#obtPrnBarBrowsePdtTo').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oBarPrnProductToOption = undefined;
            oBarPrnProductToOption = oPrnBarProductOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtToCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtToName',
                'tNextFuncName': 'JSxBarPrnConsNextFuncBrowsePdt',
                'aArgReturn': ['FTPdtCode', 'FTPdtName']

            });
            JCNxBrowseData('oBarPrnProductToOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });



    // Browse Product Option
    var oPrnBarProductOption = function(poReturnInputPdt) {
        let tPdtInputReturnCode = poReturnInputPdt.tReturnInputCode;
        let tPdtInputReturnName = poReturnInputPdt.tReturnInputName;
        let tPdtNextFuncName = poReturnInputPdt.tNextFuncName;
        let aPdtArgReturn = poReturnInputPdt.aArgReturn;
        let tCondition = '';
        var tSesUsrLevel = '<?= $this->session->userdata('tSesUsrLevel') ?>'

        tCondition = " ";

        // let tBchCodeSess = $('#oetRptBchCodeSelect').val();
        // let tAgnCode = $('#oetSpcAgncyCode').val();
        // let tBchcode = tBchCodeSess.replace(/,/g, "','");
        var tBchcode = '<?php echo $this->session->userdata("tSesUsrBchCode") ?>';
        var tAgnCode = '<?php echo $this->session->userdata("tSesUsrAgnCode") ?>';
        // var tBchcode = tBchCodeSess.replace(/,/g, "','");
        if (tSesUsrLevel != 'HQ') {
            tCondition += " AND ((TCNMPdtSpcBch.FTAgnCode = '" + tAgnCode + "')	OR TCNMPdtSpcBch.FTBchCode IN ('" + tBchcode + "') ";
            tCondition += " OR (ISNULL(TCNMPdtSpcBch.FTBchCode,'') = '' AND TCNMPdtSpcBch.FTAgnCode = '" + tAgnCode + "'	)";
            tCondition += " OR ISNULL(TCNMPdtSpcBch.FTAgnCode,'') = '' )";
        }
        let oPdtOptionReturn = {
            Title: ["product/product/product", "tPDTTitle"],
            Table: {
                Master: "TCNMPdt",
                PK: "FTPdtCode"
            },
            Join: {
                Table: ["TCNMPdt_L", 'TCNMPdtSpcBch'],
                On: [
                    'TCNMPdt.FTPdtCode = TCNMPdt_L.FTPdtCode AND TCNMPdt_L.FNLngID = ' + nLangEdits,
                    'TCNMPdtSpcBch.FTPdtCode = TCNMPdt.FTPdtCode'
                ]
            },
            Where: {
                Condition: [tCondition]
            },
            GrideView: {
                ColumnPathLang: 'product/product/product',
                ColumnKeyLang: ['tPDTCode', 'tPDTName'],
                DataColumns: ['TCNMPdt.FTPdtCode', 'TCNMPdt_L.FTPdtName'],
                DataColumnsFormat: ['', ''],
                ColumnsSize: ['15%', '75%'],
                Perpage: 10,
                WidthModal: 50,
                OrderBy: ['TCNMPdt.FDCreateOn DESC'],
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPdtInputReturnCode, "TCNMPdt.FTPdtCode"],
                Text: [tPdtInputReturnName, "TCNMPdt_L.FTPdtName"]
            },
            NextFunc: {
                FuncName: tPdtNextFuncName,
                ArgReturn: aPdtArgReturn
            },
            RouteAddNew: 'product',
            BrowseLev: 1,
            // DebugSQL: true
        };
        return oPdtOptionReturn;
    }

    // Functionality : Next Function Product And Check Data
    // Parameter : Event Next Func Modal
    // Create : 28/12/2021 Worakorn
    // Return : Clear Velues Data
    // Return Type : -
    function JSxBarPrnConsNextFuncBrowsePdt(poDataNextFunc) {
        if (typeof(poDataNextFunc) != 'undefined' && poDataNextFunc != "NULL") {
            var aDataNextFunc = JSON.parse(poDataNextFunc);
            tPdtCode = aDataNextFunc[0];
            tPdtName = aDataNextFunc[1];
        }

        // ประกาศตัวแปร สินค้า
        var tPrnBarCodeFrom, tPrnBarNameFrom, tPrnBarCodeTo, tPrnBarNameTo
        tPrnBarCodeFrom = $('#oetPrnBarBrowsePdtFromCode').val();
        tPrnBarNameFrom = $('#oetPrnBarBrowsePdtFromName').val();
        tPrnBarCodeTo = $('#oetPrnBarBrowsePdtToCode').val();
        tPrnBarNameTo = $('#oetPrnBarBrowsePdtToNameF').val();

        // เช็คข้อมูลถ้ามีการ Browse จากสินค้า ให้ default ถึงร้านค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarCodeFrom) !== 'undefined' && tPrnBarCodeFrom != "") && (typeof(tPrnBarCodeTo) !== 'undefined' && tPrnBarCodeTo == "")) {
            $('#oetPrnBarBrowsePdtToCode').val(tPdtCode);
            $('#oetPrnBarBrowsePdtToName').val(tPdtName);
        }

        // เช็คข้อมูลถ้ามีการ Browse ถึงร้านค้า default จากสินค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarCodeTo) !== 'undefined' && tPrnBarCodeTo != "") && (typeof(tPrnBarCodeFrom) !== 'undefined' && tPrnBarCodeFrom == "")) {
            $('#oetPrnBarBrowsePdtFromCode').val(tPdtCode);
            $('#oetPrnBarBrowsePdtFromName').val(tPdtName);
        }

    }


    // Browse Event ProductGroup
    $('#obtPrnBarBrowsePdtGrpFrom').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtGrpOptionFrom = undefined;
            oPrnBarPdtGrpOptionFrom = oPrnBarPdtGrpOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtGrpFromCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtGrpFromName',
                'tNextFuncName': 'JSxPrnBarConsNextFuncBrowsePdtGrp',
                'aArgReturn': ['FTPgpChain', 'FTPgpName']
            });
            JCNxBrowseData('oPrnBarPdtGrpOptionFrom');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });
    $('#obtPrnBarBrowsePdtGrpTo').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtGrpOptionTo = undefined;
            oPrnBarPdtGrpOptionTo = oPrnBarPdtGrpOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtGrpToCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtGrpToName',
                'tNextFuncName': 'JSxPrnBarConsNextFuncBrowsePdtGrp',
                'aArgReturn': ['FTPgpChain', 'FTPgpName']
            });
            JCNxBrowseData('oPrnBarPdtGrpOptionTo');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });


    // Option Product Group Option
    var oPrnBarPdtGrpOption = function(poReturnInputPgp) {
        let tPgpNextFuncName = poReturnInputPgp.tNextFuncName;
        let aPgpArgReturn = poReturnInputPgp.aArgReturn;
        let tPgpInputReturnCode = poReturnInputPgp.tReturnInputCode;
        let tPgpInputReturnName = poReturnInputPgp.tReturnInputName;
        let oPgpOptionReturn = {
            Title: ['product/pdtgroup/pdtgroup', 'tPGPTitle'],
            Table: {
                Master: 'TCNMPdtGrp',
                PK: 'FTPgpChain'
            },
            Join: {
                Table: ['TCNMPdtGrp_L'],
                On: ['TCNMPdtGrp_L.FTPgpChain = TCNMPdtGrp.FTPgpChain AND TCNMPdtGrp_L.FNLngID = ' + nLangEdits]
            },
            GrideView: {
                ColumnPathLang: 'company/branch/branch',
                ColumnKeyLang: ['tBCHCode', 'tBCHName'],
                ColumnsSize: ['15%', '75%'],
                WidthModal: 50,
                DataColumns: ['TCNMPdtGrp.FTPgpChain', 'TCNMPdtGrp_L.FTPgpName'],
                DataColumnsFormat: ['', ''],
                Perpage: 10,
                OrderBy: ['TCNMPdtGrp.FDCreateOn DESC'],
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPgpInputReturnCode, "TCNMPdtGrp.FTPgpChain"],
                Text: [tPgpInputReturnName, "TCNMPdtGrp_L.FTPgpName"]
            },
            NextFunc: {
                FuncName: tPgpNextFuncName,
                ArgReturn: aPgpArgReturn
            },
        };
        return oPgpOptionReturn;
    }

    // Functionality : Next Function ProductGroup And Check Data 
    // Parameter : Event Next Func Modal
    // Create : 28/12/2021 Worakorn
    // Return : Clear Velues Data
    // Return Type : -
    function JSxPrnBarConsNextFuncBrowsePdtGrp(poDataNextFunc) {

        if (typeof(poDataNextFunc) != 'undefined' && poDataNextFunc != "NULL") {
            var aDataNextFunc = JSON.parse(poDataNextFunc);
            tPdtGrpCode = aDataNextFunc[0];
            tPdtGrpName = aDataNextFunc[1];
        }

        // ประกาศตัวแปร กลุ่มสินค้า
        var tPrnBarGrpCodeFrom, tPrnBarGrpNameFrom, tPrnBarGrpCodeTo, tPrnBarGrpNameTo
        tPrnBarGrpCodeFrom = $('#oetPrnBarBrowsePdtGrpFromCode').val();
        tPrnBarGrpNameFrom = $('#oetPrnBarBrowsePdtGrpFromName').val();
        tPrnBarGrpCodeTo = $('#oetPrnBarBrowsePdtGrpToCode').val();
        tPrnBarGrpNameTo = $('#oetPrnBarBrowsePdtGrpToName').val();

        // เช็คข้อมูลถ้ามีการ Browse จากกลุ่มสินค้า ให้ default ถึงกลุ่มสินค้า เป็นข้อมูลเดียวกัน 
        if ((typeof(tPrnBarGrpCodeFrom) !== 'undefined' && tPrnBarGrpCodeFrom != "") && (typeof(tPrnBarGrpCodeTo) !== 'undefined' && tPrnBarGrpCodeTo == "")) {
            $('#oetPrnBarBrowsePdtGrpToCode').val(tPdtGrpCode);
            $('#oetPrnBarBrowsePdtGrpToName').val(tPdtGrpName);
        }

        // เช็คข้อมูลถ้ามีการ Browse ถึงกลุ่มสินค้า default จากกลุ่มสินค้า เป็นข้อมูลเดียวกัน 
        if ((typeof(tPrnBarGrpCodeTo) !== 'undefined' && tPrnBarGrpCodeTo != "") && (typeof(tPrnBarGrpCodeFrom) !== 'undefined' && tPrnBarGrpCodeFrom == "")) {
            $('#oetPrnBarBrowsePdtGrpFromCode').val(tPdtGrpCode);
            $('#oetPrnBarBrowsePdtGrpFromName').val(tPdtGrpName);
        }

        //uncheckbox parameter[1] : id - by wat
        // JSxUncheckinCheckbox('oetRptPdtGrpCodeTo');
    }


    // Browse Event ProductType
    $('#obtPrnBarBrowsePdtTypeFrom').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtTypeOptionFrom = undefined;
            oPrnBarPdtTypeOptionFrom = oPrnBarPdtTypeOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtTypeFromCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtTypeFromName',
                'tNextFuncName': 'JSxPrnBarConsNextFuncBrowsePdtType',
                'aArgReturn': ['FTPtyCode', 'FTPtyName']

            });
            JCNxBrowseData('oPrnBarPdtTypeOptionFrom');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });
    $('#obtPrnBarBrowsePdtTypeTo').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtTypeOptionTo = undefined;
            oPrnBarPdtTypeOptionTo = oPrnBarPdtTypeOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtTypeToCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtTypeToName',
                'tNextFuncName': 'JSxPrnBarConsNextFuncBrowsePdtType',
                'aArgReturn': ['FTPtyCode', 'FTPtyName']
            });
            JCNxBrowseData('oPrnBarPdtTypeOptionTo');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });


    // Browse Product Type Option
    var oPrnBarPdtTypeOption = function(poReturnInputPty) {
        let tPtyInputReturnCode = poReturnInputPty.tReturnInputCode;
        let tPtyInputReturnName = poReturnInputPty.tReturnInputName;
        let tPtyNextFuncName = poReturnInputPty.tNextFuncName;
        let aPtyArgReturn = poReturnInputPty.aArgReturn;
        let tCondition = '';
        // let tAgnCode = $('#oetSpcAgncyCode').val();
        var tSesAgnCode = '<?php echo $this->session->userdata("tSesUsrAgnCode") ?>';
        if (tSesAgnCode != '' && tSesAgnCode != undefined) {
            tCondition += " AND TCNMPdtType.FTAgnCode = '" + tSesAgnCode + "' ";
        }

        let oPtyOptionReturn = {
            Title: ['product/pdttype/pdttype', 'tPTYTitle'],
            Table: {
                Master: 'TCNMPdtType',
                PK: 'FTPtyCode'
            },
            Join: {
                Table: ['TCNMPdtType_L'],
                On: ['TCNMPdtType_L.FTPtyCode = TCNMPdtType.FTPtyCode AND TCNMPdtType_L.FNLngID = ' + nLangEdits]
            },
            Where: {
                Condition: [tCondition]
            },
            GrideView: {
                ColumnPathLang: 'company/branch/branch',
                ColumnKeyLang: ['tBCHCode', 'tBCHName'],
                ColumnsSize: ['15%', '75%'],
                WidthModal: 50,
                DataColumns: ['TCNMPdtType.FTPtyCode', 'TCNMPdtType_L.FTPtyName'],
                DataColumnsFormat: ['', ''],
                Perpage: 10,
                OrderBy: ['TCNMPdtType.FDCreateOn DESC'],
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPtyInputReturnCode, "TCNMPdtType.FTPtyCode"],
                Text: [tPtyInputReturnName, "TCNMPdtType_L.FTPtyName"]
            },
            NextFunc: {
                FuncName: tPtyNextFuncName,
                ArgReturn: aPtyArgReturn
            },
            RouteAddNew: 'pdttype',
            BrowseLev: 1
        };
        return oPtyOptionReturn;
    }

    // Functionality : Next Function ProductType And Check Data
    // Parameter : Event Next Func Modal
    // Create : 28/12/2021 Worakorn
    // Return : Clear Velues Data
    // Return Type : -
    function JSxPrnBarConsNextFuncBrowsePdtType(poDataNextFunc) {

        if (typeof(poDataNextFunc) != 'undefined' && poDataNextFunc != "NULL") {
            let aDataNextFunc = JSON.parse(poDataNextFunc);
            tPdtTypeCode = aDataNextFunc[0];
            tPdtTypeName = aDataNextFunc[1];
        }

        // ประกาศตัวแปร ประเภทสินค้า
        var tPrnBarTypeCodeFrom, tPrnBarTypeNameFrom, tPrnBarTypeCodeTo, tPrnBarTypeNameTo
        tPrnBarTypeCodeFrom = $('#oetPrnBarBrowsePdtTypeFromCode').val();
        tPrnBarTypeNameFrom = $('#oetPrnBarBrowsePdtTypeFromName').val();
        tPrnBarTypeCodeTo = $('#oetPrnBarBrowsePdtTypeToCode').val();
        tPrnBarTypeNameTo = $('#oetPrnBarBrowsePdtTypeToName').val();

        // เช็คข้อมูลถ้ามีการ Browse จากประเภทสินค้า ให้ default ถึงประเภทสินค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarTypeCodeFrom) !== 'undefined' && tPrnBarTypeCodeFrom != "") && (typeof(tPrnBarTypeCodeTo) !== 'undefined' && tPrnBarTypeCodeTo == "")) {
            $('#oetPrnBarBrowsePdtTypeToCode').val(tPdtTypeCode);
            $('#oetPrnBarBrowsePdtTypeToName').val(tPdtTypeName);
        }

        // เช็คข้อมูลถ้ามีการ Browse ถึงประเภทสินค้า default จากประเภทสินค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarTypeCodeTo) !== 'undefined' && tPrnBarTypeCodeTo != "") && (typeof(tPrnBarTypeCodeFrom) !== 'undefined' && tPrnBarTypeCodeFrom == "")) {
            $('#oetPrnBarBrowsePdtTypeFromCode').val(tPdtTypeCode);
            $('#oetPrnBarBrowsePdtTypeFromName').val(tPdtTypeName);
        }

        //uncheckbox parameter[1] : id - by wat
        // JSxUncheckinCheckbox('oetRptPdtTypeCodeTo');a

    }


    // จากยี่ห้อ
    $('#obtPrnBarBrowsePdtBrandFrom').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarBrandOptionFrom = undefined;
            oPrnBarBrandOptionFrom = oPrnBarBrandOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtBrandFromCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtBrandFromName',
                'tNextFuncName': 'JSxPrnBarConsNextFuncBrowsePdtBrand',
                'aArgReturn': ['FTPbnCode', 'FTPbnName']
            });
            JCNxBrowseData('oPrnBarBrandOptionFrom');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });
    // ถึงยี่ห้อ
    $('#obtPrnBarBrowsePdtBrandTo').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarBrandOptionTo = undefined;
            oPrnBarBrandOptionTo = oPrnBarBrandOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtBrandToCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtBrandToName',
                'tNextFuncName': 'JSxPrnBarConsNextFuncBrowsePdtBrand',
                'aArgReturn': ['FTPbnCode', 'FTPbnName']
            });
            JCNxBrowseData('oPrnBarBrandOptionTo');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });

    var oPrnBarBrandOption = function(poReturnInputBrand) {
        var tSesAgnCode = '<?php echo $this->session->userdata("tSesUsrAgnCode") ?>';
        if (tSesAgnCode != '') {
            tWhereAngCode = 'AND TCNMPdtBrand.FTAgnCode = ' + tSesAgnCode;
        } else {
            tWhereAngCode = '';
        }

        let tPbnNextFuncName = poReturnInputBrand.tNextFuncName;
        let aPbnArgReturn = poReturnInputBrand.aArgReturn;
        let tPbnInputReturnCode = poReturnInputBrand.tReturnInputCode;
        let tPbnInputReturnName = poReturnInputBrand.tReturnInputName;
        let oPbnOptionReturn = {
            Title: ['product/pdtbrand/pdtbrand', 'tPBNTitle'],
            Table: {
                Master: 'TCNMPdtBrand',
                PK: 'FTPbnCode'
            },
            Join: {
                Table: ['TCNMPdtBrand_L'],
                On: [
                    'TCNMPdtBrand.FTPbnCode = TCNMPdtBrand_L.FTPbnCode AND TCNMPdtBrand_L.FNLngID = ' + nLangEdits
                ]
            },
            Where: {
                Condition: [tWhereAngCode]
            },
            GrideView: {
                ColumnPathLang: 'product/pdtbrand/pdtbrand',
                ColumnKeyLang: ['tPBNFrmPbnCode', 'tPBNFrmPbnName'],
                ColumnsSize: ['15%', '90%'],
                WidthModal: 50,
                DataColumns: ['TCNMPdtBrand.FTPbnCode', 'TCNMPdtBrand_L.FTPbnName'],
                DataColumnsFormat: ['', ''],
                Perpage: 10,
                OrderBy: ['TCNMPdtBrand.FDCreateOn DESC'],
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPbnInputReturnCode, "TCNMPdtBrand.FTPbnCode"],
                Text: [tPbnInputReturnName, "TCNMPdtBrand_L.FTPbnName"]
            },
            NextFunc: {
                FuncName: tPbnNextFuncName,
                ArgReturn: aPbnArgReturn
            },
        };
        return oPbnOptionReturn;
    }

    // Functionality : Next Function ProductBrand And Check Data
    // Parameter : Event Next Func Modal
    // Create : 28/12/2021 Worakorn
    // Return : Clear Velues Data
    // Return Type : -
    function JSxPrnBarConsNextFuncBrowsePdtBrand(poDataNextFunc) {

        if (typeof(poDataNextFunc) != 'undefined' && poDataNextFunc != "NULL") {
            let aDataNextFunc = JSON.parse(poDataNextFunc);
            tPdtBrandCode = aDataNextFunc[0];
            tPdtBrandName = aDataNextFunc[1];
        }


        // ประกาศตัวแปร ประเภทสินค้า
        var tPrnBarBrandCodeFrom, tPrnBarBrandNameFrom, tPrnBarBrandCodeTo, tPrnBarBrandNameTo
        tPrnBarBrandCodeFrom = $('#oetPrnBarBrowsePdtBrandFromCode').val();
        tPrnBarBrandNameFrom = $('#oetPrnBarBrowsePdtBrandFromName').val();
        tPrnBarBrandCodeTo = $('#oetPrnBarBrowsePdtBrandToCode').val();
        tPrnBarBrandNameTo = $('#oetPrnBarBrowsePdtBrandToName').val();

        // เช็คข้อมูลถ้ามีการ Browse จากประเภทสินค้า ให้ default ถึงประเภทสินค้า เป็นข้อมูลเดียวกัน
        if ((Brandof(tPrnBarBrandCodeFrom) !== 'undefined' && tPrnBarBrandCodeFrom != "") && (Brandof(tPrnBarBrandCodeTo) !== 'undefined' && tPrnBarBrandCodeTo == "")) {
            $('#oetPrnBarBrowsePdtBrandToCode').val(tPdtBrandCode);
            $('#oetPrnBarBrowsePdtBrandToName').val(tPdtBrandName);
        }

        // เช็คข้อมูลถ้ามีการ Browse ถึงประเภทสินค้า default จากประเภทสินค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarBrandCodeTo) !== 'undefined' && tPrnBarBrandCodeTo != "") && (typeof(tPrnBarBrandCodeFrom) !== 'undefined' && tPrnBarBrandCodeFrom == "")) {
            $('#oetPrnBarBrowsePdtBrandFromCode').val(tPdtBrandCode);
            $('#oetPrnBarBrowsePdtBrandFromName').val(tPdtBrandName);
        }

        //uncheckbox parameter[1] : id - by wat
        // JSxUncheckinCheckbox('oetRptPdtTypeCodeTo');a

    }


    // จากรุ่น
    $('#obtPrnBarBrowsePdtModelFrom').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarModelOptionFrom = undefined;
            oPrnBarModelOptionFrom = oPrnBarModelOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtModelFromCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtModelFromName',
                'tNextFuncName': 'JSxPrnBarConsNextFuncBrowsePdtModel',
                'aArgReturn': ['FTPmoCode', 'FTPmoName']
            });
            JCNxBrowseData('oPrnBarModelOptionFrom');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });

    // ถึงรุ่น
    $('#obtPrnBarBrowsePdtModelTo').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarModelOptionTo = undefined;
            oPrnBarModelOptionTo = oPrnBarModelOption({
                'tReturnInputCode': 'oetPrnBarBrowsePdtModelToCode',
                'tReturnInputName': 'oetPrnBarBrowsePdtModelToName',
                'tNextFuncName': 'JSxPrnBarConsNextFuncBrowsePdtModel',
                'aArgReturn': ['FTPmoCode', 'FTPmoName']
            });
            JCNxBrowseData('oPrnBarModelOptionTo');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });





    var oPrnBarModelOption = function(poReturnInputModel) {
        var tSesAgnCode = '<?php echo $this->session->userdata("tSesUsrAgnCode") ?>';
        if (tSesAgnCode != '') {
            tWhereAngCode = 'AND TCNMPdtModel.FTAgnCode = ' + tSesAgnCode;
        } else {
            tWhereAngCode = '';
        }

        let tPmoNextFuncName = poReturnInputModel.tNextFuncName;
        let aPmoArgReturn = poReturnInputModel.aArgReturn;
        let tPmoInputReturnCode = poReturnInputModel.tReturnInputCode;
        let tPmoInputReturnName = poReturnInputModel.tReturnInputName;
        let oRptModelOption = {
            Title: ['product/pdtmodel/pdtmodel', 'tPMOTitle'],
            Table: {
                Master: 'TCNMPdtModel',
                PK: 'FTPmoCode'
            },
            Join: {
                Table: ['TCNMPdtModel_L'],
                On: [
                    'TCNMPdtModel.FTPmoCode = TCNMPdtModel_L.FTPmoCode AND TCNMPdtModel_L.FNLngID = ' + nLangEdits
                ]
            },
            Where: {
                Condition: [tWhereAngCode]
            },
            GrideView: {
                ColumnPathLang: 'product/pdtmodel/pdtmodel',
                ColumnKeyLang: ['tPMOFrmPmoCode', 'tPMOFrmPmoName'],
                ColumnsSize: ['15%', '90%'],
                WidthModal: 50,
                DataColumns: ['TCNMPdtModel.FTPmoCode', 'TCNMPdtModel_L.FTPmoName'],
                DataColumnsFormat: ['', ''],
                Perpage: 10,
                OrderBy: ['TCNMPdtModel.FDCreateOn DESC'],
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPmoInputReturnCode, "TCNMPdtModel.FTPmoCode"],
                Text: [tPmoInputReturnName, "TCNMPdtModel_L.FTPmoName"]
            },
            NextFunc: {
                FuncName: tPmoNextFuncName,
                ArgReturn: aPmoArgReturn
            },
        };
        return oRptModelOption;
    }

    // Functionality : Next Function ProductModel And Check Data
    // Parameter : Event Next Func Modal
    // Create : 28/12/2021 Worakorn
    // Return : Clear Velues Data
    // Return Type : -
    function JSxPrnBarConsNextFuncBrowsePdtModel(poDataNextFunc) {

        if (typeof(poDataNextFunc) != 'undefined' && poDataNextFunc != "NULL") {
            let aDataNextFunc = JSON.parse(poDataNextFunc);
            tPdtModelCode = aDataNextFunc[0];
            tPdtModelName = aDataNextFunc[1];
        }

        // ประกาศตัวแปร ประเภทสินค้า
        var tPrnBarModelCodeFrom, tPrnBarModelNameFrom, tPrnBarModelCodeTo, tPrnBarModelNameTo
        tPrnBarModelCodeFrom = $('#oetPrnBarBrowsePdtModelFromCode').val();
        tPrnBarModelNameFrom = $('#oetPrnBarBrowsePdtModelFromName').val();
        tPrnBarModelCodeTo = $('#oetPrnBarBrowsePdtModelToCode').val();
        tPrnBarModelNameTo = $('#oetPrnBarBrowsePdtModelToName').val();

        // เช็คข้อมูลถ้ามีการ Browse จากประเภทสินค้า ให้ default ถึงประเภทสินค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarModelCodeFrom) !== 'undefined' && tPrnBarModelCodeFrom != "") && (typeof(tPrnBarModelCodeTo) !== 'undefined' && tPrnBarModelCodeTo == "")) {
            $('#oetPrnBarBrowsePdtModelToCode').val(tPdtModelCode);
            $('#oetPrnBarBrowsePdtModelToName').val(tPdtModelName);
        }

        // เช็คข้อมูลถ้ามีการ Browse ถึงประเภทสินค้า default จากประเภทสินค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarModelCodeTo) !== 'undefined' && tPrnBarModelCodeTo != "") && (typeof(tPrnBarModelCodeFrom) !== 'undefined' && tPrnBarModelCodeFrom == "")) {
            $('#oetPrnBarBrowsePdtModelFromCode').val(tPdtModelCode);
            $('#oetPrnBarBrowsePdtModelFromName').val(tPdtModelName);
        }

        //uncheckbox parameter[1] : id - by wat
        // JSxUncheckinCheckbox('oetRptPdtTypeCodeTo');a

    }

    // Click Browse Product Depart
    $('#obtPrnBarPdtDepartBrows').click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtDepartBrowsOption = oPrnBarCatProductBrows({
                'tReturnInputCode': 'oetPrnBarPdtDepartCode',
                'tReturnInputName': 'oetPrnBarPdtDepartName',
                'nCatLevel': 1,
                'tCatParent': ''
                // 'tNextFuncName': ''
            });
            JCNxBrowseData('oPrnBarPdtDepartBrowsOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });
    // Click Browse Product Class
    $('#obtPrnBarPdtClassBrows').click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtClassBrowsOption = oPrnBarCatProductBrows({
                'tReturnInputCode': 'oetPrnBarPdtClassCode',
                'tReturnInputName': 'oetPrnBarPdtClassName',
                'nCatLevel': 2,
                'tCatParent': 'oetPrnBarPdtDepartCode'
                // 'tNextFuncName': ''
            });
            JCNxBrowseData('oPrnBarPdtClassBrowsOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });
    // Click Browse Product Sub Class
    $('#obtPrnBarPdtSubClassBrows').click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtSubClassBrowsOption = oPrnBarCatProductBrows({
                'tReturnInputCode': 'oetPrnBarPdtSubClassCode',
                'tReturnInputName': 'oetPrnBarPdtSubClassName',
                'nCatLevel': 3,
                'tCatParent': 'oetPrnBarPdtClassCode'
                // 'tNextFuncName': ''
            });
            JCNxBrowseData('oPrnBarPdtSubClassBrowsOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });
    // Click Browse Product Sub Class
    $('#obtPrnBarPdtGroupBrows').click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtGroupBrowsOption = oPrnBarCatProductBrows({
                'tReturnInputCode': 'oetPrnBarPdtGroupCode',
                'tReturnInputName': 'oetPrnBarPdtGroupName',
                'nCatLevel': 4,
                'tCatParent': 'oetPrnBarPdtSubClassCode'
                // 'tNextFuncName': ''
            });
            JCNxBrowseData('oPrnBarPdtGroupBrowsOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });

    // Click Browse Product Sub Class
    $('#obtPrnBarPdtComLinesBrows').click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPdtComLinesBrowsOption = oPrnBarCatProductBrows({
                'tReturnInputCode': 'oetPrnBarPdtComLinesCode',
                'tReturnInputName': 'oetPrnBarPdtComLinesName',
                'nCatLevel': 5,
                'tCatParent': 'oetPrnBarPdtGroupCode'
                // 'tNextFuncName': ''
            });
            JCNxBrowseData('oPrnBarPdtComLinesBrowsOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });

    // Option Browse Category
    // Create By :Worakorn 29/12/2021
    var oPrnBarCatProductBrows = function(poReturnInput) {
        var tInputReturnCode = poReturnInput.tReturnInputCode;
        var tInputReturnName = poReturnInput.tReturnInputName;
        var nCatLevel = poReturnInput.nCatLevel;
        var tCatParent = $('#' + poReturnInput.tCatParent).val();
        var tSesUsrAgnCode = '<?= $this->session->userdata("tSesUsrAgnCode") ?>';
        var tLabelCode = '';
        var tLabelName = '';
        var tLabelTitle = '';

        switch (nCatLevel) {
            case 2:
                tLabelTitle = 'tFhnPdtClass';
                tLabelCode = 'tFhnPdtClassCode';
                tLabelName = 'tFhnPdtClassName';
                break;
            case 3:
                tLabelTitle = 'tFhnPdtSubClass';
                tLabelCode = 'tFhnPdtSubClassCode';
                tLabelName = 'tFhnPdtSubClassName';
                break;
            case 4:
                tLabelTitle = 'tFhnPdtGroup';
                tLabelCode = 'tFhnPdtGroupCode';
                tLabelName = 'tFhnPdtGroupName';
                break;
            case 5:
                tLabelTitle = 'tFhnPdtComLines';
                tLabelCode = 'tFhnPdtComLinesCode';
                tLabelName = 'tFhnPdtComLinesName';
                break;
            default:
                tLabelTitle = 'tFhnPdtDepart';
                tLabelCode = 'tFhnPdtDepartCode';
                tLabelName = 'tFhnPdtDepartName';
        }

        var tConditionWhere = '';
        if (tSesUsrAgnCode != '') {
            tConditionWhere += " AND ( TCNMPdtCatInfo.FTAgnCode = '" + tSesUsrAgnCode + "' OR ISNULL(TCNMPdtCatInfo.FTAgnCode,'') = '' )   ";
        }

        tConditionWhere += " AND TCNMPdtCatInfo.FNCatLevel = " + nCatLevel + " ";
        tConditionWhere += " AND TCNMPdtCatInfo.FTCatStaUse = '1' ";


        var oOptionReturn = {
            Title: ['product/product/product', tLabelTitle],
            Table: {
                Master: 'TCNMPdtCatInfo',
                PK: 'FTCatCode'
            },
            Join: {
                Table: ['TCNMPdtCatInfo_L'],
                On: [
                    'TCNMPdtCatInfo.FTCatCode = TCNMPdtCatInfo_L.FTCatCode AND TCNMPdtCatInfo.FNCatLevel = TCNMPdtCatInfo_L.FNCatLevel AND TCNMPdtCatInfo_L.FNLngID = ' + nLangEdits,
                ]
            },
            Where: {
                Condition: [tConditionWhere]
            },
            GrideView: {
                ColumnPathLang: 'product/product/product',
                ColumnKeyLang: [tLabelCode, tLabelName],
                ColumnsSize: ['20%', '80%'],
                DataColumns: ['TCNMPdtCatInfo.FTCatCode', 'TCNMPdtCatInfo_L.FTCatName'],
                DataColumnsFormat: ['', ''],
                // DisabledColumns: [2],
                WidthModal: 50,
                Perpage: 10,
                OrderBy: ['TCNMPdtCatInfo.FDCreateOn'],
                SourceOrder: "DESC"
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tInputReturnCode, "TCNMPdtCatInfo.FTCatCode"],
                Text: [tInputReturnName, "TCNMPdtCatInfo_L.FTCatName"],
            },
            // NextFunc: {
            //     FuncName: 'JSxCatCheckBrowseLevel',
            //     ArgReturn: ['FTCatCode', 'FTCatName']
            // },
            // RouteAddNew: 'productNoSaleEvent',
            BrowseLev: 1
        }
        return oOptionReturn;
    }



    // Click
    $('#obtPrnBarPrnLableBrowse').click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPrnLableBrowsOption = oPrnBarPrnLableBrowse({
                'tReturnInputCode': 'oetPrnBarPrnLableCode',
                'tReturnInputName': 'oetPrnBarPrnLableName',
            });
            JCNxBrowseData('oPrnBarPrnLableBrowsOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });
    // Click
    $('#obtPrnBarPrnSrvBrowse').click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            window.oPrnBarPrnSrvBrowsOption = oPrnBarPrnSrvBrowse({
                'tReturnInputCode': 'oetPrnBarPrnSrvCode',
                'tReturnInputName': 'oetPrnBarPrnSrvName',
            });
            JCNxBrowseData('oPrnBarPrnSrvBrowsOption');
        } else {
            JCNxShowMsgSessionExpired();
        }
    });


    var oPrnBarPrnLableBrowse = function(poReturnInputModel) {
        let tPrnLabInputReturnCode = poReturnInputModel.tReturnInputCode;
        let tPrnLabInputReturnName = poReturnInputModel.tReturnInputName;
        let oPrnBarPrnLableOption = {
            Title: ['product/pdtmodel/pdtmodel', 'รูปแบบการพิมพ์'],
            Table: {
                Master: 'TCNMPrnLabel',
                PK: 'FTPlbCode'
            },
            Join: {
                Table: ['TCNMPrnLabel_L'],
                On: [
                    'TCNMPrnLabel.FTPlbCode = TCNMPrnLabel_L.FTPlbCode AND TCNMPrnLabel_L.FNLngID = ' + nLangEdits
                ]
            },
            Where: {
                Condition: ["AND FTPlbStaUse = 1  "]
            },
            GrideView: {
                ColumnPathLang: 'product/pdtmodel/pdtmodel',
                ColumnKeyLang: ['รหัสรูปแบบการพิมพ์', 'ชื่อรูปแบบการพิมพ์', 'อ้างอิงรูปแบบ'],
                ColumnsSize: ['15%', '70%', '15%'],
                WidthModal: 50,
                DataColumns: ['TCNMPrnLabel.FTPlbCode', 'TCNMPrnLabel_L.FTPblName', 'TCNMPrnLabel.FTLblCode'],
                DataColumnsFormat: ['', '', ''],
                Perpage: 10,
                OrderBy: ['TCNMPrnLabel.FDCreateOn DESC'],
            },
            NextFunc: {
                FuncName: 'JSaPrnBarPrnLableFormat',
                ArgReturn: ['FTLblCode']
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPrnLabInputReturnCode, "TCNMPrnLabel.FTPlbCode"],
                Text: [tPrnLabInputReturnName, "TCNMPrnLabel_L.FTPblName"]
            },
        };
        return oPrnBarPrnLableOption;
    }

    function JSaPrnBarPrnLableFormat(paData) {
        if (typeof(paData) != 'undefined' && paData != "NULL") {
            var aDataNextFunc = JSON.parse(paData);
            var nPage = 1;
            tPlbCode = aDataNextFunc[0];
            $('#oetPrnBarPrnLableCodeRef').val(aDataNextFunc[0])
            JSvPriBarDataTable(nPage, tPlbCode)
        }
    }

    var oPrnBarPrnSrvBrowse = function(poReturnInputModel) {
        let tPrnSrvInputReturnCode = poReturnInputModel.tReturnInputCode;
        let tPrnSrvInputReturnName = poReturnInputModel.tReturnInputName;
        let oPrnBarPrnSrvOption = {
            Title: ['product/pdtmodel/pdtmodel', 'ปริ้นเตอร์เซิฟเวอร์'],
            Table: {
                Master: 'TCNMPrnServer',
                PK: 'FTSrvCode'
            },
            Join: {
                Table: ['TCNMPrnServer_L'],
                On: [
                    'TCNMPrnServer.FTSrvCode = TCNMPrnServer_L.FTSrvCode AND TCNMPrnServer_L.FNLngID = ' + nLangEdits
                ]
            },
            Where: {
                Condition: ["AND FTSrvStaUse = 1  "]
            },
            GrideView: {
                ColumnPathLang: 'product/pdtmodel/pdtmodel',
                ColumnKeyLang: ['รหัสปริ้นเตอร์เซิฟเวอร์', 'ชื่อปริ้นเตอร์เซิฟเวอร์'],
                ColumnsSize: ['15%', '90%'],
                WidthModal: 50,
                DataColumns: ['TCNMPrnServer.FTSrvCode', 'TCNMPrnServer_L.FTSrvName'],
                DataColumnsFormat: ['', ''],
                Perpage: 10,
                OrderBy: ['TCNMPrnServer.FDCreateOn DESC'],
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPrnSrvInputReturnCode, "TCNMPrnServer.FTSrvCode"],
                Text: [tPrnSrvInputReturnName, "TCNMPrnServer_L.FTSrvName"]
            },
        };
        return oPrnBarPrnSrvOption;
    }



    // จากเลขที่เอกสาร
    $('#obtPrnBarBrowseRptNoFrom').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            // alert($('#oetPrnBarSheet').val())
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            if ($('#oetPrnBarSheet').val() == 'Promotion') {
                window.oPrnBarRptNoOptionFrom = undefined;
                oPrnBarRptNoOptionFrom = oPrnBarRptNoOption({
                    'tReturnInputCode': 'oetPrnBarBrowseRptNoFromCode',
                    'tReturnInputName': 'oetPrnBarBrowseRptNoFromName',
                    'tNextFuncName': 'JSxPrnBarConsNextFuncBrowseRptNo',
                    'aArgReturn': ['FTPmhDocNo', 'FTPmhDocNo']
                });
                JCNxBrowseData('oPrnBarRptNoOptionFrom');
            } else if ($('#oetPrnBarSheet').val() == 'PriceAdjustmentSale') {
                window.oPrnBarRptNoOptionFrom = undefined;
                oPrnBarRptNoOptionFrom = oPrnBarRptNoAdOption({
                    'tReturnInputCode': 'oetPrnBarBrowseRptNoFromCode',
                    'tReturnInputName': 'oetPrnBarBrowseRptNoFromName',
                    'tNextFuncName': 'JSxPrnBarConsNextFuncBrowseRptNo',
                    'aArgReturn': ['FTXphDocNo', 'FTXphDocNo']
                });
                JCNxBrowseData('oPrnBarRptNoOptionFrom');
            }
        } else {
            JCNxShowMsgSessionExpired();
        }
    });

    // ถึงเลขที่เอกสาร
    $('#obtPrnBarBrowseRptNoTo').unbind().click(function() {
        var nStaSession = JCNxFuncChkSessionExpired();
        if (typeof(nStaSession) !== 'undefined' && nStaSession == 1) {
            JSxCheckPinMenuClose(); // Hidden Pin Menu
            if ($('#oetPrnBarSheet').val() == 'Promotion') {
                window.oPrnBarRptNoOptionTo = undefined;
                oPrnBarRptNoOptionTo = oPrnBarRptNoOption({
                    'tReturnInputCode': 'oetPrnBarBrowseRptNoToCode',
                    'tReturnInputName': 'oetPrnBarBrowseRptNoToName',
                    'tNextFuncName': 'JSxPrnBarConsNextFuncBrowseRptNo',
                    'aArgReturn': ['FTPmhDocNo', 'FTPmhDocNo']
                });
                JCNxBrowseData('oPrnBarRptNoOptionTo');
            } else if ($('#oetPrnBarSheet').val() == 'PriceAdjustmentSale') {
                window.oPrnBarRptNoOptionTo = undefined;
                oPrnBarRptNoOptionTo = oPrnBarRptNoAdOption({
                    'tReturnInputCode': 'oetPrnBarBrowseRptNoToCode',
                    'tReturnInputName': 'oetPrnBarBrowseRptNoToName',
                    'tNextFuncName': 'JSxPrnBarConsNextFuncBrowseRptNo',
                    'aArgReturn': ['FTXphDocNo', 'FTXphDocNo']
                });
                JCNxBrowseData('oPrnBarRptNoOptionTo');
            }
        } else {
            JCNxShowMsgSessionExpired();
        }
    });

    var oPrnBarRptNoOption = function(poReturnInputModel) {
        // var tSesAgnCode = '<?php echo $this->session->userdata("tSesUsrAgnCode") ?>';
        // if (tSesAgnCode != '') {
        //     tWhereAngCode = 'AND TCNMPdtModel.FTAgnCode = ' + tSesAgnCode;
        // } else {
        //     tWhereAngCode = '';
        // }
        var tDocDateFrom = $('#oetPrnBarXthDocDateFrom').val();
        var tDocDateTo = $('#oetPrnBarXthDocDateTo').val();

        if (tDocDateFrom != '' && tDocDateTo != '') {
            tWhere = " AND TCNTPdtPmtHD.FDCreateOn BETWEEN " + "'" + tDocDateFrom + " 00:00:00.000'" + " AND " + "'" + tDocDateTo + " 23:59:59.000'"
        } else {
            tWhere = ''
        }



        let tPmoNextFuncName = poReturnInputModel.tNextFuncName;
        let aPmoArgReturn = poReturnInputModel.aArgReturn;
        let tPmoInputReturnCode = poReturnInputModel.tReturnInputCode;
        let tPmoInputReturnName = poReturnInputModel.tReturnInputName;
        let oRptModelOption = {
            Title: ['document/document/document', 'tDocNo'],
            Table: {
                Master: 'TCNTPdtPmtHD',
                PK: 'FTPmhDocNo'
            },
            Join: {
                Table: ['TCNMBranch_L'],
                On: [
                    'TCNTPdtPmtHD.FTBchCode = TCNMBranch_L.FTBchCode AND TCNMBranch_L.FNLngID = ' + nLangEdits
                ]
            },
            Where: {
                Condition: ['AND FTPmhStaApv = 1 ' + tWhere]
            },

            GrideView: {
                ColumnPathLang: 'document/document/document',
                ColumnKeyLang: ['สาขา', 'tDocNo', 'วันที่เอกสาร'],
                ColumnsSize: ['20%', '60%', '20%'],
                WidthModal: 50,
                DataColumns: ['TCNMBranch_L.FTBchName', 'TCNTPdtPmtHD.FTPmhDocNo', 'TCNTPdtPmtHD.FDCreateOn'],
                DataColumnsFormat: ['', '', ''],
                Perpage: 10,
                OrderBy: ['TCNTPdtPmtHD.FDCreateOn DESC'],
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPmoInputReturnCode, "TCNTPdtPmtHD.FTPmhDocNo"],
                Text: [tPmoInputReturnName, "TCNTPdtPmtHD.FTPmhDocNo"]
            },
            NextFunc: {
                FuncName: tPmoNextFuncName,
                ArgReturn: aPmoArgReturn
            },
        };
        return oRptModelOption;
    }



    var oPrnBarRptNoAdOption = function(poReturnInputModel) {
        // var tSesAgnCode = '<?php echo $this->session->userdata("tSesUsrAgnCode") ?>';
        // if (tSesAgnCode != '') {
        //     tWhereAngCode = 'AND TCNMPdtModel.FTAgnCode = ' + tSesAgnCode;
        // } else {
        //     tWhereAngCode = '';
        // }
        var tDocDateFrom = $('#oetPrnBarXthDocDateFrom').val();
        var tDocDateTo = $('#oetPrnBarXthDocDateTo').val();

        if (tDocDateFrom != '' && tDocDateTo != '') {
            tWhere = "AND TCNTPdtAdjPriHD.FDXphDocDate BETWEEN " + "'" + tDocDateFrom + " 00:00:00.000'" + " AND " + "'" + tDocDateTo + " 23:59:59.000'"
        } else {
            tWhere = ''
        }

        let tPmoNextFuncName = poReturnInputModel.tNextFuncName;
        let aPmoArgReturn = poReturnInputModel.aArgReturn;
        let tPmoInputReturnCode = poReturnInputModel.tReturnInputCode;
        let tPmoInputReturnName = poReturnInputModel.tReturnInputName;
        let oRptModelOption = {
            Title: ['document/document/document', 'tDocNo'],
            Table: {
                Master: 'TCNTPdtAdjPriHD',
                PK: 'FTXphDocNo'
            },
            Join: {
                Table: ['TCNMBranch_L'],
                On: [
                    'TCNTPdtAdjPriHD.FTBchCode = TCNMBranch_L.FTBchCode AND TCNMBranch_L.FNLngID = ' + nLangEdits
                ]
            },
            Where: {
                Condition: ['AND FTXphStaApv = 1 ' + tWhere]
            },
            GrideView: {
                ColumnPathLang: 'document/document/document',
                ColumnKeyLang: ['สาขา', 'tDocNo', 'วันที่เอกสาร'],
                ColumnsSize: ['20%', '60%', '20%'],
                WidthModal: 50,
                DataColumns: ['TCNMBranch_L.FTBchName', 'TCNTPdtAdjPriHD.FTXphDocNo', 'TCNTPdtAdjPriHD.FDXphDocDate'],
                DataColumnsFormat: ['', '', ''],
                Perpage: 10,
                OrderBy: ['TCNTPdtAdjPriHD.FDCreateOn DESC'],
            },
            CallBack: {
                ReturnType: 'S',
                Value: [tPmoInputReturnCode, "TCNTPdtAdjPriHD.FTXphDocNo"],
                Text: [tPmoInputReturnName, "TCNTPdtAdjPriHD.FTXphDocNo"]
            },
            NextFunc: {
                FuncName: tPmoNextFuncName,
                ArgReturn: aPmoArgReturn
            },
        };
        return oRptModelOption;
    }

    // Functionality : Next Function Promotion And Check Data
    // Parameter : Event Next Func Modal
    // Create : 28/12/2021 Worakorn
    // Return : Clear Velues Data
    // Return Type : -
    function JSxPrnBarConsNextFuncBrowseRptNo(poDataNextFunc) {

        if (typeof(poDataNextFunc) != 'undefined' && poDataNextFunc != "NULL") {
            let aDataNextFunc = JSON.parse(poDataNextFunc);
            tPdtProCode = aDataNextFunc[0];
            tPdtProName = aDataNextFunc[1];
        }

        // ประกาศตัวแปร ประเภทสินค้า
        var tPrnBarProCodeFrom, tPrnBarProNameFrom, tPrnBarProCodeTo, tPrnBarProNameTo
        tPrnBarProCodeFrom = $('#oetPrnBarBrowseRptNoFromCode').val();
        tPrnBarProNameFrom = $('#oetPrnBarBrowseRptNoFromName').val();
        tPrnBarProCodeTo = $('#oetPrnBarBrowseRptNoToCode').val();
        tPrnBarProNameTo = $('#oetPrnBarBrowseRptNoToName').val();

        // เช็คข้อมูลถ้ามีการ Browse จากประเภทสินค้า ให้ default ถึงประเภทสินค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarProCodeFrom) !== 'undefined' && tPrnBarProCodeFrom != "") && (typeof(tPrnBarProCodeTo) !== 'undefined' && tPrnBarProCodeTo == "")) {
            $('#oetPrnBarBrowseRptNoToCode').val(tPdtProCode);
            $('#oetPrnBarBrowseRptNoToName').val(tPdtProName);
        }

        // เช็คข้อมูลถ้ามีการ Browse ถึงประเภทสินค้า default จากประเภทสินค้า เป็นข้อมูลเดียวกัน
        if ((typeof(tPrnBarProCodeTo) !== 'undefined' && tPrnBarProCodeTo != "") && (typeof(tPrnBarProCodeFrom) !== 'undefined' && tPrnBarProCodeFrom == "")) {
            $('#oetPrnBarBrowseRptNoFromCode').val(tPdtProCode);
            $('#oetPrnBarBrowseRptNoFromName').val(tPdtProName);
        }

        //uncheckbox parameter[1] : id - by wat
        // JSxUncheckinCheckbox('oetRptPdtTypeCodeTo');a

    }


    /**
     * Functionality : Pagenation changed
     * Parameters : -
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : view
     * Return Type : view
     */
    function JSvPriBarClickPage(ptPage, ptLblCode) {
        try {
            var nPageCurrent = '';
            var tPblCode = ptLblCode;
            var nPageNew;
            switch (ptPage) {
                case 'next': //กดปุ่ม Next
                    $('.xWBtnNext').addClass('disabled');
                    nPageOld = $('.xWPagePriBar .active').text(); // Get เลขก่อนหน้า
                    nPageNew = parseInt(nPageOld, 10) + 1; // +1 จำนวน
                    nPageCurrent = nPageNew;
                    break;
                case 'previous': //กดปุ่ม Previous
                    nPageOld = $('.xWPagePriBar .active').text(); // Get เลขก่อนหน้า
                    nPageNew = parseInt(nPageOld, 10) - 1; // -1 จำนวน
                    nPageCurrent = nPageNew;
                    break;
                default:
                    nPageCurrent = ptPage;
            }
            JSvPriBarCallDataTable(nPageCurrent);
        } catch (err) {
            console.log('JSvPriBarClickPage Error: ', err);
        }
    }


    $('body').on("keypress", '.xCNInputNumericWithoutDecimal', function(event) {
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        InputId = event.target.id;
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });



    function JSvPriBarSendMQ() {
        try {
            var tPrnBarPrnLableCode = $('#oetPrnBarPrnLableCode').val();
            var tPrnBarPrnSrvCode = $('#oetPrnBarPrnSrvCode').val();
            var tTextConfrimSendPrint = 'ยืนยันการสั่งพิมพ์'
            $('#odvPRNModalSendPrint #ospTextSendPrint').html(tTextConfrimSendPrint);
            $('#odvPRNModalSendPrint').modal('show');
            $('#odvPRNModalSendPrint #osmConfirmSendPrint').unbind().click(function() {
                JCNxOpenLoading();
                $.ajax({
                    type: "POST",
                    url: "PrintBarCodeMQProcess",
                    data: {
                        tPrnBarPrnLableCode: tPrnBarPrnLableCode,
                        tPrnBarPrnSrvCode: tPrnBarPrnSrvCode,
                    },
                    cache: false,
                    Timeout: 5000,
                    success: function(tResult) {
                        // JSvCallPagePriBar();
                        JCNxCloseLoading();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        JCNxResponseError(jqXHR, textStatus, errorThrown);
                    }
                });
                $('#odvPRNModalSendPrint').modal('hide');
            });
        } catch (err) {
            console.log('JSvPriBarDataTable Error: ', err);
        }
    }

    function JSvCallPagePriBar() {
        $.ajax({
            type: "POST",
            url: "PrintBarCode/0/0",
            data: {},
            cache: false,
            Timeout: 5000,
            success: function(tView) {
                //console.log(tView);
                $(window).scrollTop(0);
                $('.odvMainContent').html(tView);

                // Chk Status Favorite
                // JSxChkStaDisFavorite(tURL);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                JCNxResponseError(jqXHR, textStatus, errorThrown);
            }
        });
    }



    //supawat 03/07/2020
    //กดนำเข้า จะวิ่งไป Modal popup ที่ center
    $('#odvEventImportFilePRT').click(function() {


        if ($('#oetPrnBarPrnLableCode').val() != '') {
            var tNameModule = 'printbarcode';
            var tTypeModule = 'document';
            var tAfterRoute = 'JSxImportExcelCallback';
            var tFlagClearTmp = '1' // null = ไม่สนใจ 1 = ลบหมดเเล้วเพิ่มใหม่ 2 = เพิ่มต่อเนื่อง

            var aPackdata = {
                'tNameModule': tNameModule,
                'tTypeModule': tTypeModule,
                'tAfterRoute': tAfterRoute,
                'tFlagClearTmp': tFlagClearTmp,
                'tLblCode': $('#oetPrnBarPrnLableCodeRef').val()
            };
            JSxImportPopUp(aPackdata);
        } else {
            var tTextConfrimAlertPrint = 'กรุณาเลือกรูปแบบการพิมพ์ก่อน';
            $('#odvPRNModalAlertPrint #ospTextAlertPrint').html(tTextConfrimAlertPrint);
            $('#odvPRNModalAlertPrint').modal('show');
        }
    });

    function JSxImportExcelCallback() {
        setTimeout(function() {
            JSvPriBarDataTable(0, '');
        }, 50);
    }
</script>
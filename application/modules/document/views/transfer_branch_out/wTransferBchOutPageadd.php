<style>
    fieldset.scheduler-border {
        border      : 1px groove #ffffffa1 !important;
        padding     : 0 20px 20px 20px !important;
        margin      : 0 0 10px 0 !important;
    }

    legend.scheduler-border {
        text-align      : left !important;
        width           : auto;
        padding         : 0 5px;
        border-bottom   : none;
        font-weight     : bold;
    }

	.xCNBTNPrimeryCusPlus {
		border-radius: 50%;
		float: right;
		width: 30px;
		height: 30px;
		line-height: 30px;
		background-color: #179BFD;
		text-align: center;
		margin-top: 8px;
		/* margin-right: -15px; */
		font-size: 29px;
		color: #ffffff;
		cursor: pointer;
		-webkit-border-radius: 50%;
		-moz-border-radius: 50%;
		-ms-border-radius: 50%;
		-o-border-radius: 50%;
	}
	/* .fancy-checkbox {
		display: inline-block;
		font-weight: normal;
		width: 120px;
	} */
	.xCNTransferBchOutTotalLabel {
		background-color: #f5f5f5;
		padding: 5px 10px;
		color: #232C3D !important;
		font-weight: 900;
	}
	.xCNTransferBchOutLabel {
		padding: 5px 10px;
		color: #232C3D !important;
		font-weight: 900;
	}
	.xCNTransferBchOutLabelFullWidth{
		width: 100%;
	}
	.xCNTransferBchOutLabelWidth{
		width: 260px;
	}
</style>

<?php
	if ($aResult['rtCode'] == "1") { // Edit
		$tBchCode = $aResult['raItems']['FTBchCode'];
		$tBchName = $aResult['raItems']['FTBchName'];
		$tDocNo = $aResult['raItems']['FTXthDocNo'];
		$tDocDate = $aResult['raItems']['FDXthDocDate'];
		$tDocTime = $aResult['raItems']['FTXthDocTime'];

		$tVATInOrEx = $aResult['raItems']['FTXthVATInOrEx'];
		$tRefExt = $aResult['raItems']['FTXthRefExt'];
		$tRefExtDate = $aResult['raItems']['FDXthRefExtDate'];
		$tRefInt = $aResult['raItems']['FTXthRefInt'];
		$tRefIntDate = $aResult['raItems']['FDXthRefIntDate'];
		$cTotal = $aResult['raItems']['FCXthTotal'];
		$cVat = $aResult['raItems']['FCXthVat'];
		$cVatable = $aResult['raItems']['FCXthVatable'];
		$tStaPrcStk = $aResult['raItems']['FTXthStaPrcStk'];
		$tStaRef = $aResult['raItems']['FNXthStaRef'];

		$tDptCode = $aResult['raItems']['FTDptCode'];

		$tSpnCode = $aResult['raItems']['FTSpnCode'];

		$tRsnCode = $aResult['raItems']['FTRsnCode'];
		$tRsnName = $aResult['raItems']['FTRsnName'];

		$tCreateByCode = $aResult['raItems']['FTCreateBy'];
		$tCreateByName = $aResult['raItems']['FTCreateByName'];

		$tUsrApvCode = $aResult['raItems']['FTXthApvCode'];
		$tUsrApvName = $aResult['raItems']['FTXthApvName'];

		$tStaDoc = $aResult['raItems']['FTXthStaDoc'];
		$tStaApv = $aResult['raItems']['FTXthStaApv'];
		$tUsrKeyCode = $aResult['raItems']['FTUsrCode']; // ????????????????????? Key
		$tStaDelMQ = $aResult['raItems']['FTXthStaDelMQ'];
		$nStaDocAct = $aResult['raItems']['FNXthStaDocAct'];
		$nDocPrint = $aResult['raItems']['FNXthDocPrint'];
		$tRmk = $aResult['raItems']['FTXthRmk'];

		$tCtrName = $aResult['raItems']['FTXthCtrName'];
		$tTnfDate = $aResult['raItems']['FDXthTnfDate'];
		$tRefTnfID = $aResult['raItems']['FTXthRefTnfID'];
		$tRefVehID = $aResult['raItems']['FTXthRefVehID'];
		$tQtyAndTypeUnit = $aResult['raItems']['FTXthQtyAndTypeUnit'];
		$nShipAdd = $aResult['raItems']['FNXthShipAdd'];

		$tViaCode = $aResult['raItems']['FTViaCode'];
		$tViaName = $aResult['raItems']['FTViaName'];

		$tRoute = "docTransferBchOutEventEdit";

		$tUserBchCodeFrom = $aResult['raItems']['FTXthBchFrm'];
		$tUserBchNameFrom = $aResult['raItems']['FTXthBchFrmName'];
		$tUserMchCodeFrom = $aResult['raItems']['FTXthMerchantFrm'];
		$tUserMchNameFrom = $aResult['raItems']['FTXthMerchantFrmName'];
		$tUserShpCodeFrom = $aResult['raItems']['FTXthShopFrm'];
		$tUserShpNameFrom = $aResult['raItems']['FTXthShopFrmName'];
		$tUserWahCodeFrom = $aResult['raItems']['FTXthWhFrm'];
		$tUserWahNameFrom = $aResult['raItems']['FTXthWhFrmName'];

		$tUserBchCodeTo = $aResult['raItems']['FTXthBchTo'];
		$tUserBchNameTo = $aResult['raItems']['FTXthBchToName'];
		$tUserWahCodeTo = $aResult['raItems']['FTXthWhTo'];
		$tUserWahNameTo = $aResult['raItems']['FTXthWhToName'];

	} else { // New
		$tUserLevel = $this->session->userdata('tSesUsrLevel');
		$tBchCode = $this->session->userdata("tSesUsrBchCodeDefault");
		$tBchName = $this->session->userdata("tSesUsrBchNameDefault");
		$tDocNo = "";
		$tDocDate = date('Y-m-d');
		$tDocTime = date('H:i');

		$tVATInOrEx = "";
		$tRefExt = "";
		$tRefExtDate = "";
		$tRefInt = "";
		$tRefIntDate = "";
		$cTotal = 0;
		$cVat = 0;
		$cVatable = 0;
		$tStaPrcStk = "";
		$tStaRef = "0";

		$tDptCode = "";

		$tSpnCode = "";

		$tRsnCode = "";
		$tRsnName = "";

		$tCreateByCode =  $this->session->userdata('tSesUsername');
		$tCreateByName = $this->session->userdata('tSesUsrUsername');

		$tUsrApvCode = "";
		$tUsrApvName = "";

		$tStaDoc = "";
		$tStaApv = "";
		$tUsrKeyCode = $this->session->userdata('tSesUsername'); // ????????????????????? Key
		$tStaDelMQ = "";
		$nStaDocAct = 1;
		$nDocPrint = 0;
		$tRmk = "";

		$tCtrName = "";
		$tTnfDate = "";
		$tRefTnfID = "";
		$tRefVehID = "";
		$tQtyAndTypeUnit = "";
		$nShipAdd = "";

		$tViaCode = "";
		$tViaName = "";

		$tRoute = "docTransferBchOutEventAdd";

		$tUserBchCodeFrom = $this->session->userdata('tSesUsrBchCodeDefault');
		$tUserBchNameFrom = $this->session->userdata('tSesUsrBchNameDefault');
		$tUserMchCodeFrom = $this->session->userdata('tSesUsrMerCode');
		$tUserMchNameFrom = $this->session->userdata('tSesUsrMerName');
		$tUserShpCodeFrom = $this->session->userdata('tSesUsrShpCodeDefault');
		$tUserShpNameFrom = $this->session->userdata('tSesUsrShpNameDefault');
		$tUserWahCodeFrom = $this->session->userdata('tSesUsrWahCode');
		$tUserWahNameFrom = $this->session->userdata('tSesUsrWahName');

		$tUserBchCodeTo = "";
		$tUserBchNameTo = "";
		$tUserWahCodeTo = "";
		$tUserWahNameTo = "";

		// if ($this->session->userdata('tSesUsrLevel') == 'HQ') {
		// 	$tUserBchCodeFrom = $tBchCompCode;
		// 	$tUserBchNameFrom = $tBchCompName;
		// }
		// if ($this->session->userdata('tSesUsrLevel') == 'BCH') {
			// $tUserBchCodeFrom = $this->session->userdata('tSesUsrBchCodeDefault');
			// $tUserBchNameFrom = $this->session->userdata('tSesUsrBchNameDefault');
		// }
		// if ($this->session->userdata('tSesUsrLevel') == 'SHP') {
			// $tUserBchCodeFrom = $this->session->userdata('tSesUsrBchCode');
			// $tUserBchNameFrom = $this->session->userdata('tSesUsrBchName');

			// $tUserMchCodeFrom = $this->session->userdata('tSesUsrMerCode');
			// $tUserMchNameFrom = $this->session->userdata('tSesUsrMerName');

			// $tUserShpCodeFrom = $this->session->userdata('tSesUsrShpCodeDefault');
			// $tUserShpNameFrom = $this->session->userdata('tSesUsrShpNameDefault');

			// $tUserWahCodeFrom = $this->session->userdata('tSesUsrWahCode');
			// $tUserWahNameFrom = $this->session->userdata('tSesUsrWahName');
		// }
	}

	$nLangEdit = $this->session->userdata("tLangEdit");
	$tUsrApv = $this->session->userdata("tSesUsername");
	$tUserLoginLevel = $this->session->userdata("tSesUsrLevel");
	$bIsAddPage = empty($tDocNo) ? true : false;
	$bIsApv = empty($tStaApv) ? false : true;
	$bIsCancel = ($tStaDoc == "3") ? true : false;
	$bIsApvOrCancel = ($bIsApv || $bIsCancel);
	$bIsMultiBch = $this->session->userdata("nSesUsrBchCount") > 1;
	$bIsShpEnabled = FCNbGetIsShpEnabled();

	$aCompanyInfo  = FCNaGetCompanyForDocument();
?>

<script>
	var nLangEdit = '<?php echo $nLangEdit; ?>';
	var tUsrApv = '<?php echo $tUsrApv; ?>';
	var tUserLoginLevel = '<?php echo $tUserLoginLevel; ?>';
	var bIsAddPage = <?php echo ($bIsAddPage) ? 'true' : 'false'; ?>;
	var bIsApv = <?php echo ($bIsApv) ? 'true' : 'false'; ?>;
	var bIsCancel = <?php echo ($bIsCancel) ? 'true' : 'false'; ?>;
	var bIsApvOrCancel = <?php echo ($bIsApvOrCancel) ? 'true' : 'false'; ?>;
	var tStaApv = '<?php echo $tStaApv; ?>';
	var bIsMultiBch = <?php echo ($bIsMultiBch) ? 'true' : 'false'; ?>;
	var bIsShpEnabled = <?php echo ($bIsShpEnabled) ? 'true' : 'false'; ?>;
</script>

<form class="contact100-form validate-form" action="javascript:void(0)" method="post" enctype="multipart/form-data" autocorrect="off" autocapitalize="off" autocomplete="off" id="ofmTransferBchOutForm">
    <input type="hidden" id="ohdTransferBchOutVatRate" name="ohdTransferBchOutVatRate" value="<?php echo $aCompanyInfo['cVatRate']; ?>">
	<input type="hidden" id="ohdTransferBchOutVatInOrEx" name="ohdTransferBchOutVatInOrEx" value="<?php echo $aCompanyInfo['tCmpRetInOrEx']; ?>">
	<input type="hidden" id="ohdTransferBchOutBchLogin" name="ohdTransferBchOutBchLogin" value="<?php echo $tBchCode; ?>">
	<input type="hidden" id="ohdTransferBchOutStaApv" name="ohdTransferBchOutStaApv" value="<?php echo $tStaApv; ?>">
	<input type="hidden" id="ohdTransferBchOutStaDelMQ" name="ohdTransferBchOutStaDelMQ" value="<?php echo $tStaDelMQ; ?>">
	<input type="text" class="xCNHide" id="oetTransferBchOutApvCodeUsrLogin" name="oetTransferBchOutApvCodeUsrLogin" maxlength="20" value="<?php echo $this->session->userdata('tSesUsername'); ?>">
	<input type="text" class="xCNHide" id="ohdLangEdit" name="ohdLangEdit" maxlength="1" value="<?php echo $this->session->userdata("tLangEdit"); ?>">
	<input type="hidden" id="ohdTBRoute" name="ohdTBRoute" value="<?php echo $tRoute; ?>">
	<button style="display:none" type="submit" id="obtTransferBchOutSubmit" onclick="JSxTransferBchOutValidateForm();"></button>

	<div class="row">
		<div class="col-md-3">
			<!--Section : ????????????????????????????????????????????????-->
			<div class="panel panel-default" style="margin-bottom: 25px;">
				<div class="panel-heading xCNPanelHeadColor" role="tab" style="padding-top:10px;padding-bottom:10px;">
					<label class="xCNTextDetail1"><?= language('document/transfer_branch_out/transfer_branch_out', 'tStatus'); ?></label>
					<a class="xCNMenuplus <?php echo ($bIsAddPage)?'collapsed':''; ?>" role="button" data-toggle="collapse" href="#odvTransferBchOutDocDetailPanel" aria-expanded="true">
						<i class="fa fa-plus xCNPlus"></i>
					</a>
				</div>
				<div id="odvTransferBchOutDocDetailPanel" class="panel-collapse collapse <?php echo ($bIsAddPage)?'':'in'; ?>" role="tabpanel">
					<div class="panel-body xCNPDModlue">
						<div class="form-group xCNHide" style="text-align: right;">
							<label class="xCNTitleFrom "><?= language('document/transfer_branch_out/transfer_branch_out', 'tApproved'); ?></label>
						</div>
						<input type="hidden" value="0" id="ohdCheckTFWSubmitByButton" name="ohdCheckTFWSubmitByButton">
						<input type="hidden" value="0" id="ohdCheckTFWClearValidate" name="ohdCheckTFWClearValidate">
						<label class="xCNLabelFrm"><span style="color:red">*</span><?= language('document/transfer_branch_out/transfer_branch_out', 'tDocNo'); ?></label>
						<?php if ($bIsAddPage) { ?>
							<div class="form-group" id="odvTransferBchOutAutoGenCode">
								<div class="validate-input">
									<label class="fancy-checkbox">
										<input type="checkbox" id="ocbTransferBchOutAutoGenCode" name="ocbTransferBchOutAutoGenCode" checked="true" value="1">
										<span><?= language('document/transfer_branch_out/transfer_branch_out', 'tAutoGenCode'); ?></span>
									</label>
								</div>
							</div>
							<div class="form-group" id="odvPunCodeForm">
								<input
								type="text"
								class="form-control xCNInputWithoutSpcNotThai"
								maxlength="20"
								id="oetTransferBchOutDocNo"
								name="oetTransferBchOutDocNo"
								data-is-created="<?php  ?>"
								placeholder="<?= language('document/transfer_branch_out/transfer_branch_out', 'tDocNo') ?>"
								value="<?php  ?>"
								data-validate-required="<?= language('document/transfer_branch_out/transfer_branch_out', 'tDocNoRequired') ?>"
								data-validate-dublicateCode="<?= language('document/transfer_branch_out/transfer_branch_out', 'tDocNoDuplicate') ?>"
								disabled readonly>
								<input type="hidden" value="2" id="ohdCheckDuplicateTFW" name="ohdCheckDuplicateTFW">
							</div>
						<?php } else { ?>
							<div class="form-group" id="odvPunCodeForm">
								<div class="validate-input">
									<input type="text" class="form-control xCNInputWithoutSpcNotThai xCNApvOrCanCelDisabled" maxlength="20" id="oetTransferBchOutDocNo" name="oetTransferBchOutDocNo" data-is-created="<?php  ?>" placeholder="<?= language('document/transfer_branch_out/transfer_branch_out', 'tTFWDocNo') ?>" value="<?php echo $tDocNo; ?>" readonly onfocus="this.blur()">
								</div>
							</div>
						<?php } ?>

						<div class="form-group">
							<label class="xCNLabelFrm"><span style="color:red">*</span><?= language('document/transfer_branch_out/transfer_branch_out', 'tDocDate'); ?></label>
							<div class="input-group">
								<input type="text" class="form-control xCNDatePicker xCNInputMaskDate xCNApvOrCanCelDisabled" id="oetTransferBchOutDocDate" name="oetTransferBchOutDocDate" value="<?= $tDocDate; ?>" data-validate-required="<?= language('document/transfer_branch_out/transfer_branch_out', 'tTFWPlsEnterDocDate'); ?>">
								<span class="input-group-btn">
									<button id="obtXthDocDate" type="button" class="btn xCNBtnDateTime xCNApvOrCanCelDisabled">
										<img src="<?= base_url() . '/application/modules/common/assets/images/icons/icons8-Calendar-100.png' ?>">
									</button>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="xCNLabelFrm"><span style="color:red">*</span><?= language('document/transfer_branch_out/transfer_branch_out', 'tDocTime'); ?></label>
							<div class="input-group">
								<input type="text" class="form-control xCNTimePicker xCNApvOrCanCelDisabled" id="oetTransferBchOutDocTime" name="oetTransferBchOutDocTime" value="<?= $tDocTime; ?>" data-validate-required="<?= language('document/transfer_branch_out/transfer_branch_out', 'tTFWPlsEnterDocTime'); ?>">
								<span class="input-group-btn">
									<button id="obtXthDocTime" type="button" class="btn xCNBtnDateTime xCNApvOrCanCelDisabled">
										<img src="<?= base_url() . '/application/modules/common/assets/images/icons/icons8-Calendar-100.png' ?>">
									</button>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="xCNLabelFrm"><?= language('document/transfer_branch_out/transfer_branch_out', 'tCreateBy'); ?></label>
							</div>
							<div class="col-md-6 text-right">
								<input type="text" class="xCNHide" id="oetCreateBy" name="oetCreateBy" value="<?= $tCreateByCode ?>">
								<label><?= $tCreateByName ?></label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="xCNLabelFrm"><?= language('document/transfer_branch_out/transfer_branch_out', 'tTBStaDoc'); ?></label>
							</div>
							<div class="col-md-6 text-right">
								<label><?= language('document/transfer_branch_out/transfer_branch_out', 'tStaDoc' . $tStaDoc); ?></label>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label class="xCNLabelFrm"><?= language('document/transfer_branch_out/transfer_branch_out', 'tTBStaApv'); ?></label>
							</div>
							<div class="col-md-6 text-right">
								<label><?= language('document/transfer_branch_out/transfer_branch_out', 'tStaApv' . $tStaApv); ?></label>
							</div>
						</div>
						<?php if ($tDocNo != '') { ?>
							<div class="row">
								<div class="col-md-6">
									<label class="xCNLabelFrm"><?= language('document/transfer_branch_out/transfer_branch_out', 'tApvBy'); ?></label>
								</div>
								<div class="col-md-6 text-right">
									<input type="text" class="xCNHide" id="oetXthApvCode" name="oetXthApvCode" maxlength="20" value="<?= $tUsrApvCode ?>">
									<label><?= $tUsrApvName != '' ? $tUsrApvName : language('document/transfer_branch_out/transfer_branch_out', 'tStaDoc'); ?></label>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<!--Section : ?????????????????????????????????????????? -->
			<div class="panel panel-default" style="margin-bottom: 25px;">
				<div class="panel-heading xCNPanelHeadColor" role="tab" style="padding-top:10px;padding-bottom:10px;">
					<label class="xCNTextDetail1"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????'); ?></label>
					<a class="xCNMenuplus" role="button" data-toggle="collapse" href="#odvTransferBchOutDocConditionPanel" aria-expanded="true">
						<i class="fa fa-plus xCNPlus"></i>
					</a>
				</div>
				<div id="odvTransferBchOutDocConditionPanel" class="panel-collapse collapse in" role="tabpanel">
					<div class="panel-body xCNPDModlue">

						<div class="row">
							<div class="col-md-12">
								<!-- ???????????????????????????????????? -->
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', 'tTBBchCreate'); ?></label>
									<div class="input-group">
										<input
										type="text"
										class="input100 xCNHide"
										id="oetTransferBchOutBchCode"
										name="oetTransferBchOutBchCode"
										maxlength="5"
										value="<?php echo $tBchCode; ?>">
										<input
										class="form-control xWPointerEventNone"
										type="text"
										id="oetTransferBchOutBchName"
										name="oetTransferBchOutBchName"
										value="<?php echo $tBchName; ?>"
										readonly>
										<span class="input-group-btn xWConditionSearchPdt">
											<button id="obtTransferBchOutBrowseBch" type="button" class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled" 
											<?php 
												if($tRoute != "docTransferBchOutEventAdd"){
														echo 'disabled';
												}
											?>
											>
												<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/find-24.png'?>">
											</button>
										</span>
									</div>
								</div>
								<!-- ???????????????????????????????????? -->
							</div>
						</div>

						<!-- ?????????????????? -->
						<fieldset class="scheduler-border">
							<legend class="scheduler-border"><?=language('document/transferreceiptbranch/transferreceiptbranch','tTBIOrigin');?></legend>

							<!-- ????????????????????????????????????????????? -->
							<!-- <div class="form-group <?php if(!FCNbGetIsShpEnabled()) : echo 'xCNHide';  endif;?>">
								<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????????????????'); ?></label>
								<div class="input-group">
									<input
									type="text"
									class="input100 xCNHide xCNApvOrCanCelDisabled"
									id="oetTransferBchOutXthMerchantFrmCode"
									name="oetTransferBchOutXthMerchantFrmCode"
									maxlength="5"
									value="<?php echo $tUserMchCodeFrom; ?>">
									<input
									class="form-control xWPointerEventNone xCNApvOrCanCelDisabled"
									type="text" id="oetTransferBchOutXthMerchantFrmName"
									name="oetTransferBchOutXthMerchantFrmName"
									value="<?php echo $tUserMchNameFrom; ?>"
									readonly
									data-validate-required="<?php echo language('document/transfer_branch_out/transfer_branch_out', 'tTBWahNameStartRequired'); ?>">
									<span class="input-group-btn xWConditionSearchPdt">
										<button id="obtTransferBchOutBrowseMerFrom" type="button" class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled">
											<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/find-24.png'?>">
										</button>
									</span>
								</div>
								<input
								type="text"
								class="input100 xCNHide"
								id="oetTransferBchOutWahInShopCode"
								name="oetTransferBchOutWahInShopCode"
								maxlength="5"
								value="<?php echo $tUserWahCodeFrom; ?>">
							</div> -->
							<!-- ????????????????????????????????????????????? -->

							<!-- ????????????????????? -->
							<div class="form-group">
								<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????'); ?></label>
								<div class="input-group">
									<input
									type="text"
									class="input100 xCNHide xCNApvOrCanCelDisabled xFhnBchCodeShw"
									id="oetTransferBchOutXthBchFrmCode"
									name="oetTransferBchOutXthBchFrmCode"
									maxlength="5"
									value="<?php echo $tUserBchCodeFrom; ?>">
									<input
									class="form-control xWPointerEventNone xCNApvOrCanCelDisabled"
									type="text" id="oetTransferBchOutXthBchFrmName"
									name="oetTransferBchOutXthBchFrmName"
									value="<?php echo $tUserBchNameFrom; ?>"
									readonly
									data-validate-required="<?php echo language('document/transfer_branch_out/transfer_branch_out', 'tTBWahNameStartRequired'); ?>">
									<span class="input-group-btn xWConditionSearchPdt">
										<button id="obtTransferBchOutBrowseBchFrom" type="button" class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled">
											<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/find-24.png'?>">
										</button>
									</span>
								</div>
							</div>

							<!-- ?????????????????????????????? -->
							<!-- <div class="form-group">
								<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '?????????????????????'); ?></label>
								<div class="input-group">
									<input
									class="form-control xCNHide xCNApvOrCanCelDisabled"
									id="oetTransferBchOutXthShopFrmCode"
									name="oetTransferBchOutXthShopFrmCode"
									maxlength="5"
									value="<?php echo $tUserShpCodeFrom; ?>">
									<input
									type="text"
									class="form-control xWPointerEventNone xCNApvOrCanCelDisabled"
									id="oetTransferBchOutXthShopFrmName"
									name="oetTransferBchOutXthShopFrmName"
									value="<?php echo $tUserShpNameFrom; ?>"
									readonly>
									<span class="xWConDisDocument input-group-btn">
										<button id="obtTransferBchOutBrowseShpFrom" type="button" class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled"><img class="xCNIconFind"></button>
									</span>
								</div>
							</div> -->

							<!-- ????????????????????? -->
							<div class="form-group">
								<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '??????????????????????????????'); ?></label>
								<div class="input-group">
									<input
									type="text"
									class="input100 xCNHide xCNApvOrCanCelDisabled xFhnWahCodeShw"
									id="oetTransferBchOutXthWhFrmCode"
									name="oetTransferBchOutXthWhFrmCode"
									maxlength="5"
									value="<?php echo $tUserWahCodeFrom; ?>">
									<input
									class="form-control xWPointerEventNone xCNApvOrCanCelDisabled"
									type="text"
									id="oetTransferBchOutXthWhFrmName"
									name="oetTransferBchOutXthWhFrmName"
									value="<?php echo $tUserWahNameFrom; ?>"
									readonly
									data-validate-required="<?php echo language('document/transfer_branch_out/transfer_branch_out', 'tTBPlsEnterWah'); ?>">
									<span class="input-group-btn xWConditionSearchPdt">
										<button id="obtTransferBchOutBrowseWahFrom" type="button" class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled">
											<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/find-24.png'?>">
										</button>
									</span>
								</div>
							</div>
						</fieldset>

						<!-- ????????????????????? -->
						<fieldset class="scheduler-border">
							<legend class="scheduler-border"><?=language('document/transferreceiptbranch/transferreceiptbranch','tTBITo');?></legend>

							<!-- ????????????????????? -->
							<div class="form-group">
								<label class="xCNLabelFrm"><?php echo language('document/transferreceiptbranch/transferreceiptbranch', 'tTBIBranch'); ?></label>
								<div class="input-group">
									<input
									class="form-control xCNHide xCNApvOrCanCelDisabled"
									id="oetTransferBchOutXthBchToCode"
									name="oetTransferBchOutXthBchToCode"
									maxlength="5"
									value="<?php echo $tUserBchCodeTo; ?>">
									<input
									class="form-control xWPointerEventNone xCNApvOrCanCelDisabled"
									type="text"
									id="oetTransferBchOutXthBchToName"
									name="oetTransferBchOutXthBchToName"
									value="<?php echo $tUserBchNameTo; ?>"
									readonly
									data-validate-required="<?php echo language('document/transfer_branch_out/transfer_branch_out', 'tTBPlsEnterBch'); ?>">
									<span class="xWConditionSearchPdt input-group-btn">
										<button id="obtTransferBchOutBrowseBchTo" type="button" class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled">
											<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/find-24.png'?>">
										</button>
									</span>
								</div>
							</div>

							<!-- ????????????????????? -->
							<div class="form-group">
								<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '??????????????????????????????'); ?></label>
								<div class="input-group">
									<input
									type="text"
									class="input100 xCNHide xCNApvOrCanCelDisabled"
									id="oetTransferBchOutXthWhToCode"
									name="oetTransferBchOutXthWhToCode"
									maxlength="5"
									value="<?php echo $tUserWahCodeTo; ?>">
									<input
									class="form-control xWPointerEventNone xCNApvOrCanCelDisabled"
									type="text"
									id="oetTransferBchOutXthWhToName"
									name="oetTransferBchOutXthWhToName"
									value="<?php echo $tUserWahNameTo; ?>"
									readonly
									data-validate-required="<?php echo language('document/transfer_branch_out/transfer_branch_out', 'tTBPlsEnterWah'); ?>">
									<span class="input-group-btn xWConditionSearchPdt">
										<button id="obtTransferBchOutBrowseWahTo" type="button" class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled">
											<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/find-24.png'?>">
										</button>
									</span>
								</div>
							</div>
						</fieldset>

					</div>
				</div>
			</div>

			<!--Section : ??????????????????????????????????????? -->
			<div class="panel panel-default" style="margin-bottom: 25px;">
				<div class="panel-heading xCNPanelHeadColor" role="tab" style="padding-top:10px;padding-bottom:10px;">
					<label class="xCNTextDetail1"><?php echo language('document/transfer_branch_out/transfer_branch_out', '???????????????????????????????????????'); ?></label>
					<a class="xCNMenuplus" role="button" data-toggle="collapse" href="#odvTransferBchOutDocReferPanel" aria-expanded="true">
						<i class="fa fa-plus xCNPlus"></i>
					</a>
				</div>
				<div id="odvTransferBchOutDocReferPanel" class="panel-collapse collapse in" role="tabpanel">
					<div class="panel-body xCNPDModlue">
						<!-- ??????????????????????????????????????????????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '?????????????????????????????????????????????????????????'); ?></label>
									<input type="text" class="form-control xCNInputWithoutSpc xCNApvOrCanCelDisabled" id="oetTransferBchOutXthRefExt" name="oetTransferBchOutXthRefExt" maxlength="20" value="<?php echo $tRefExt; ?>">
								</div>
							</div>
						</div>
						<!-- ?????????????????????????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '?????????????????? ????????????????????????????????????'); ?></label>
									<div class="input-group">
										<input type="text" class="form-control xCNDatePicker xCNInputMaskDate xCNApvOrCanCelDisabled" id="oetTransferBchOutXthRefExtDate" name="oetTransferBchOutXthRefExtDate" value="<?php echo $tRefExtDate; ?>">
										<span class="input-group-btn">
											<button id="obtTransferBchOutXthRefExtDate" type="button" class="btn xCNBtnDateTime xCNApvOrCanCelDisabled">
												<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/icons8-Calendar-100.png'?>">
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
						<!-- ?????????????????????????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '??????????????????????????????????????????????????????'); ?></label>
									<input type="text" class="form-control xCNInputWithoutSpc xCNApvOrCanCelDisabled" id="oetTransferBchOutXthRefInt" name="oetTransferBchOutXthRefInt" maxlength="20" value="<?php echo $tRefInt; ?>">
								</div>
							</div>
						</div>
						<!-- ??????????????????????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '?????????????????? ?????????????????????????????????'); ?></label>
									<div class="input-group">
										<input type="text" class="form-control xCNDatePicker xCNInputMaskDate xCNApvOrCanCelDisabled" id="oetTransferBchOutXthRefIntDate" name="oetTransferBchOutXthRefIntDate" value="<?php echo $tRefIntDate; ?>">
										<span class="input-group-btn">
											<button id="obtTransferBchOutXthRefIntDate" type="button" class="btn xCNBtnDateTime xCNApvOrCanCelDisabled">
												<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/icons8-Calendar-100.png'?>">
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--Section : ???????????????????????? -->
			<div class="panel panel-default" style="margin-bottom: 25px;">
				<div class="panel-heading xCNPanelHeadColor" role="tab" style="padding-top:10px;padding-bottom:10px;">
					<label class="xCNTextDetail1"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????'); ?></label>
					<a class="xCNMenuplus collapsed" role="button" data-toggle="collapse" href="#odvTransferBchOutDeliveryPanel" aria-expanded="true">
						<i class="fa fa-plus xCNPlus"></i>
					</a>
				</div>
				<div id="odvTransferBchOutDeliveryPanel" class="panel-collapse collapse" role="tabpanel">
					<div class="panel-body xCNPDModlue">

						<!-- ??????????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '???????????????????????????????????????'); ?></label>
									<input type="text" class="form-control xCNInputWithoutSpc xCNApvOrCanCelDisabled" maxlength="100" id="oetTransferBchOutXthCtrName" name="oetTransferBchOutXthCtrName" value="<?php echo $tCtrName; ?>">
								</div>
							</div>
						</div>
						<!-- ??????????????????????????????????????? -->

						<!-- ????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '?????????????????????????????????'); ?></label>
									<div class="input-group">
										<input type="text" class="form-control xCNDatePicker xCNInputMaskDate xCNApvOrCanCelDisabled" id="oetTransferBchOutXthTnfDate" name="oetTransferBchOutXthTnfDate" value="<?php echo $tTnfDate; ?>">
										<span class="input-group-btn">
											<button id="obtTransferBchOutXthTnfDate" type="button" class="btn xCNBtnDateTime xCNApvOrCanCelDisabled">
												<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/icons8-Calendar-100.png'?>">
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
						<!-- ????????????????????????????????? -->

						<!-- ???????????????????????????????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????????????????????????????????????????'); ?></label>
									<input type="text" class="form-control xCNInputWithoutSpc xCNApvOrCanCelDisabled" maxlength="100" id="oetTransferBchOutXthRefTnfID" name="oetTransferBchOutXthRefTnfID" value="<?php echo $tRefTnfID; ?>">
								</div>
							</div>
						</div>
						<!-- ???????????????????????????????????????????????????????????? -->

						<!-- ?????????????????????????????????????????????????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '??????????????????????????????????????????????????????????????????????????????'); ?></label>
									<input type="text" class="form-control xCNInputWithoutSpc xCNApvOrCanCelDisabled" maxlength="100" id="oetTransferBchOutXthRefVehID" name="oetTransferBchOutXthRefVehID" value="<?php echo $tRefVehID; ?>">
								</div>
							</div>
						</div>
						<!-- ?????????????????????????????????????????????????????????????????????????????? -->

						<!-- ???????????????????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????????????????'); ?></label>
									<input type="text" class="form-control xCNInputWithoutSpc xCNApvOrCanCelDisabled" maxlength="100" id="oetTransferBchOutXthQtyAndTypeUnit" name="oetTransferBchOutXthQtyAndTypeUnit" value="<?php echo $tQtyAndTypeUnit; ?>">
								</div>
							</div>
						</div>
						<!-- ???????????????????????????????????? -->

						<!-- ???????????????????????? -->
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????'); ?></label>
									<div class="input-group">
										<input
										class="form-control xWPointerEventNone xCNApvOrCanCelDisabled"
										type="text"
										id="oetTransferBchOutShipViaName"
										name="oetTransferBchOutShipViaName"
										value="<?php echo $tViaName; ?>"
										readonly>
										<input
										type="text"
										class="input100 xCNHide xCNApvOrCanCelDisabled"
										id="oetTransferBchOutShipViaCode"
										name="oetTransferBchOutShipViaCode"
										value="<?php echo $tViaCode; ?>">
										<span class="input-group-btn">
											<button id="obtTransferBchOutBrowseShipVia" type="button" class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled">
												<img src="<?php echo  base_url().'application/modules/common/assets/images/icons/find-24.png'?>">
											</button>
										</span>
									</div>
								</div>
							</div>
						</div>
						<!-- ???????????????????????? -->

						<!-- ????????????????????????????????????????????????????????? -->
						<!-- <div class="row">
							<div class="col-md-12">
								<input tyle="text" class="xCNHide" id="ohdTransferBchOutXthShipAdd" name="ohdTransferBchOutXthShipAdd" value="">
								<button type="button" id="obtTBBrowseShipAdd" class="btn btn-primary <?php
									if($tRoute=="TBXEventAdd"){
										echo " xWConditionSearchPdt disabled";
									}else{

									}
								?>" style="font-size: 17px;"><?php echo language('document/transfer_branch_out/transfer_branch_out', '?????????????????????????????????????????????????????????'); ?></button>
							</div>
						</div> -->
						<!-- ????????????????????????????????????????????????????????? -->
					</div>
				</div>
			</div>

			<!--Section : ???????????????-->
			<div class="panel panel-default" style="margin-bottom: 60px;">
				<div id="odvHeadAllow" class="panel-heading xCNPanelHeadColor" role="tab" style="padding-top:10px;padding-bottom:10px;">
					<label class="xCNTextDetail1"><?php echo language('document/transfer_branch_out/transfer_branch_out', 'tOther'); ?></label>
					<a class="xCNMenuplus collapsed" role="button" data-toggle="collapse" href="#odvOther" aria-expanded="true">
						<i class="fa fa-plus xCNPlus"></i>
					</a>
				</div>
				<div id="odvOther" class="panel-collapse collapse" role="tabpanel">
					<div class="panel-body xCNPDModlue">
						<!-- ?????????????????? -->
                        <div class="form-group">
                            <label class="xCNLabelFrm"><?= language('document/transfer_branch_out/transfer_branch_out', '??????????????????'); ?></label>
                            <div class="input-group">
								<input
								name="oetTransferBchOutRsnName"
								id="oetTransferBchOutRsnName"
								class="form-control xWPointerEventNone xCNApvOrCanCelDisabled"
								value="<?=$tRsnName?>"
								type="text"
								readonly
                                placeholder="<?= language('document/transfer_branch_out/transfer_branch_out', '??????????????????') ?>">
								<input
								name="oetTransferBchOutRsnCode"
								id="oetTransferBchOutRsnCode"
								value="<?=$tRsnCode?>"
								class="form-control xCNHide xCNApvOrCanCelDisabled"
								type="text">
                                <span class="input-group-btn">
                                    <button class="btn xCNBtnBrowseAddOn xCNApvOrCanCelDisabled" id="obtTransferBchOutBrowseReason" type="button">
                                        <img src="<?= base_url() . '/application/modules/common/assets/images/icons/find-24.png' ?>">
                                    </button>
                                </span>
                            </div>
						</div>
						<!-- ?????????????????? -->

						<!-- ???????????????????????? -->
						<div class="form-group">
							<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????'); ?></label>
							<textarea class="form-control xCNInputWithoutSpc xCNApvOrCanCelDisabled" id="otaTransferBchOutXthRmk" name="otaTransferBchOutXthRmk" maxlength="200"><?php echo $tRmk; ?></textarea>
						</div>
						<!-- ???????????????????????? -->

						<!-- ?????????????????????????????? -->
						<div class="form-group">
							<label class="fancy-checkbox">
								<input
								class="xCNApvOrCanCelDisabled"
								type="checkbox"
								value="1"
								<?php echo ($nStaDocAct == 1)?'checked':''; ?>
								id="ocbTransferBchOutXthStaDocAct"
								name="ocbTransferBchOutXthStaDocAct"
								maxlength="1">
								<span>&nbsp;</span>
								<span class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '??????????????????????????????'); ?></span>
							</label>
						</div>
						<!-- ?????????????????????????????? -->

						<!-- ???????????????????????????????????? -->
						<div class="form-group">
							<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????????????????'); ?></label>
							<select class="selectpicker form-control xCNApvOrCanCelDisabled" id="ostTransferBchOutXthStaRef" name="ostTransferBchOutXthStaRef" maxlength="1">
								<option value="0" <?php echo ($tStaRef == "0")?'checked':''; ?>><?php echo language('document/transfer_branch_out/transfer_branch_out', '???????????????????????????????????????'); ?></option>
								<option value="1" <?php echo ($tStaRef == "1")?'checked':''; ?>><?php echo language('document/transfer_branch_out/transfer_branch_out', '??????????????????????????????????????????'); ?></option>
								<option value="2" <?php echo ($tStaRef == "2")?'checked':''; ?>><?php echo language('document/transfer_branch_out/transfer_branch_out', '??????????????????????????????????????????'); ?></option>
							</select>
						</div>
						<!-- ???????????????????????????????????? -->

						<!-- ?????????????????????????????????????????????????????? -->
						<div class="form-group">
							<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '??????????????????????????????????????????????????????'); ?></label>
							<input readonly type="text" class="form-control xCNInputWithoutSpc xCNApvOrCanCelDisabled" maxlength="100" id="oetTransferBchOutXthDocPrint" name="oetTransferBchOutXthDocPrint" maxlength="1" value="">
						</div>
						<!-- ?????????????????????????????????????????????????????? -->

						<!-- ????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? * ????????????????????????????????????????????????????????? -->
						<div class="form-group">
							<label class="xCNLabelFrm"><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? * ?????????????????????????????????????????????????????????'); ?></label>
							<select class="selectpicker form-control xCNApvOrCanCelDisabled" id="ocmTransferBchOutOptionAddPdt" name="ocmTransferBchOutOptionAddPdt">
								<option value="1" selected><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????????????????????????????????????????'); ?></option>
								<option value="2" ><?php echo language('document/transfer_branch_out/transfer_branch_out', '????????????????????????????????????'); ?></option>
							</select>
						</div>
						<!-- ????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? * ????????????????????????????????????????????????????????? -->
					</div>
				</div>
			</div>
		</div>

		<!--Panel ????????????????????????????????????-->
		<div class="col-md-9" id="odvRightPanal">
			<div class="panel panel-default xCNTransferBchOutPdtContainer" style="margin-bottom: 25px;">

				<!-- ???????????????????????????????????? -->
				<div class="panel-collapse collapse in" role="tabpanel">
					<div class="panel-body xCNPDModlue">

						<!-- Options ????????????????????????????????????-->
						<div class="row p-t-10">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<div class="form-group">
									<div class="input-group">
										<input type="text" class="form-control" maxlength="100" id="oetTransferBchOutPdtSearchAll" name="oetTransferBchOutPdtSearchAll" onkeyup="Javascript:if(event.keyCode==13) JSxTransferBchOutGetPdtInTmp(1, true)" placeholder="<?=language('document/purchaseinvoice/purchaseinvoice','tPIFrmFilterTablePdt')?>" style="display: block;">
										<input type="text" class="form-control" maxlength="100" id="oetScanPdtHTML" name="oetScanPdtHTML" onkeyup="Javascript:if(event.keyCode==13) JSvTBScanPdtHTML()" placeholder="??????????????????????????????" style="display: none;" data-validate="??????????????????????????????????????????????????????">
										<span class="input-group-btn">
											<div id="odvMngTableList" class="xCNDropDrownGroup input-group-append">
												<button id="oimMngPdtIconSearch" type="button" class="btn xCNBTNMngTable xCNBtnDocSchAndScan" onclick="JSxTransferBchOutGetPdtInTmp(1, true)" style="display: inline-block;">
													<img src="<?php echo  base_url('application/modules/common/assets/images/icons/search-24.png'); ?>" style="width:20px;">
												</button>
												<button id="oimMngPdtIconScan" type="button" class="btn xCNBTNMngTable xCNBtnDocSchAndScan" style="display: none;" onclick="JSvTBScanPdtHTML()">
													<img class="oimMngPdtIconScan" src="<?php echo  base_url('application/modules/common/assets/images/icons/scanner.png'); ?>" style="width:20px;">
												</button>

												<!-- <button type="button" class="btn xCNDocDrpDwn xCNBtnDocSchAndScan" data-toggle="dropdown" aria-expanded="false">
													<i class="fa fa-chevron-down f-s-14 t-plus-1" style="font-size: 12px;"></i>
												</button>
												<ul class="dropdown-menu" role="menu">
													<li>
														<a id="oliMngPdtSearch"><label>?????????????????????????????????</label></a>
														<a id="oliMngPdtScan">??????????????????????????????</a>
													</li>
												</ul> -->

											</div>
										</span>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-right">
								<!-- <div id="odvTransferBchOutMngAdvTableList" class="btn-group xCNDropDrownGroup">
									<button onclick="JSxTransferBchOutPdtColumnControl()" type="button" class="btn xCNBTNMngTable <?php echo (!$bIsApvOrCancel)?'m-r-20':''; ?> xCNTransferBchOutColumnControl"><?=language('common/main/main', 'tModalAdvTable') ?></button>
								</div> -->
								<?php //if(!$bIsApvOrCancel) { ?>
									<div id="odvTransferBchOutMngDelPdtInTableDT" class="btn-group xCNDropDrownGroup">
										<button type="button" class="btn xCNBTNMngTable" data-toggle="dropdown">
											<?=language('common/main/main','tCMNOption')?> <span class="caret"></span>
										</button>
										<ul class="dropdown-menu" role="menu">
											<li id="oliTransferBchOutPdtBtnDeleteMulti" class="disabled">
												<a data-toggle="modal"  data-target="#odvTbxModalDelPdtInDTTempMultiple"><?=language('common/main/main','tDelAll')?></a>
											</li>
										</ul>
									</div>
								<?php //} ?>
							</div>
							<?php //if(!$bIsApvOrCancel) { ?>

								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-right">
											<!--????????????????????????????????????????????????-->
											<div class="form-group">
												<input type="text" class="form-control xCNPdtEditInLine" id="oetTboInsertBarcode"  autocomplete="off" name="oetTboInsertBarcode" maxlength="50" value="" onkeypress="Javascript:if(event.keyCode==13) JSxSearchFromBarcode(event,this);"  placeholder="????????????????????????????????????????????????????????????????????? ???????????? ??????????????????????????????" >
											</div>
								</div>


								<div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
									<div class="form-group">
										<div style="position: absolute;right: 15px;">
											<button type="button" class="xCNBTNPrimeryPlus xCNTransferBchOutBtnBrowsePdt" onclick="JCNvTransferBchOutBrowsePdt()">+</button>
										</div>
									</div>
								</div>
							<?php //} ?>
						</div>

						<div id="odvTransferBchOutPdtDataTable"></div>
					</div>
				</div>
			</div>

			<!-- <div class="panel panel-default xCNTransferBchOutFootTotalContainer" style="margin-bottom: 25px;"> -->
				<!-- ?????????????????????????????? -->
				<!-- <div class="panel-collapse collapse in" role="tabpanel">
					<div class="panel-body xCNPDModlue">
						<style>
							#odvSORowDataEndOfBill .panel-heading{
								padding-top: 10px !important;
								padding-bottom: 10px !important;
							}
							#odvSORowDataEndOfBill .panel-body{
								padding-top: 0px !important;
								padding-bottom: 0px !important;
							}
							#odvSORowDataEndOfBill .list-group-item {
								padding-left: 0px !important;
								padding-right: 0px !important;
								border: 0px solid #ddd;
							}
							.mark-font, .panel-default > .panel-heading.mark-font{
								color: #232C3D !important;
								font-weight: 900;
							}
						</style>
						<div class="row p-t-10" id="odvSORowDataEndOfBill">
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										<div class="pull-left mark-font">?????????????????????????????????????????????</div>
										<div class="pull-right mark-font">?????????????????????</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-body">
										<ul class="list-group" id="oulTransferBchOutDataListVat"></ul>
									</div>
									<div class="panel-heading">
										<label class="pull-left mark-font">???????????????????????????????????????????????????????????????</label>
										<label class="pull-right mark-font" id="olbTransferBchOutVatSum">0.00</label>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
								<div class="panel panel-default">
									<div class="panel-body">
										<ul class="list-group">
											<li class="list-group-item">
												<label class="pull-left mark-font">????????????????????????????????????</label>
												<label class="pull-right mark-font" id="olbTransferBchOutSumFCXtdNet">0.00</label>
												<div class="clearfix"></div>
											</li>
											<li class="list-group-item">
												<label class="pull-left">???????????????????????????????????????????????????????????????</label>
												<label class="pull-right" id="olbTransferBchOutSumFCXtdVat">0.00</label>
												<div class="clearfix"></div>
											</li>
											<li class="list-group-item">
												<label class="pull-left">??????????????????????????????????????? </label>
												<label class="pull-left" style="margin-left: 5px;" id="olbSODisChgHD"></label>
												<label class="pull-right" id="olbTransferBchOutSumFCXtdNetWithoutVate">0.00</label>
												<div class="clearfix"></div>
											</li>
										</ul>
									</div>
									<div class="panel-heading">
										<label class="pull-left mark-font">????????????????????????????????????????????????????????????</label>
										<label class="pull-right mark-font" id="olbTransferBchOutCalFCXphGrand">0.00</label>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> -->
			<!-- </div> -->

		</div>
	</div>
</form>

<?php if(!$bIsApvOrCancel) { ?>
	<!-- Begin Approve Doc -->
	<div class="modal fade xCNModalApprove" id="odvTransferBchOutPopupApv">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="xCNHeardModal modal-title" style="display:inline-block"><?php echo language('common/main/main', 'tApproveTheDocument'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><?php echo language('common/main/main', 'tMainApproveStatus'); ?></p>
					<ul>
						<li><?php echo language('common/main/main', 'tMainApproveStatus1'); ?></li>
						<li><?php echo language('common/main/main', 'tMainApproveStatus2'); ?></li>
						<li><?php echo language('common/main/main', 'tMainApproveStatus3'); ?></li>
						<li><?php echo language('common/main/main', 'tMainApproveStatus4'); ?></li>
					</ul>
					<p><?php echo language('common/main/main', 'tMainApproveStatus5'); ?></p>
					<p><strong><?php echo language('common/main/main', 'tMainApproveStatus6'); ?></strong></p>
				</div>
				<div class="modal-footer">
					<button onclick="JSvTransferBchOutApprove(true)" type="button" class="btn xCNBTNPrimery">
						<?php echo language('common/main/main', 'tModalConfirm'); ?>
					</button>
					<button type="button" class="btn xCNBTNDefult" data-dismiss="modal">
						<?php echo language('common/main/main', 'tModalCancel'); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Approve Doc -->

	<!-- Begin Cancel Doc -->
	<div class="modal fade" id="odvTransferBchOutPopupCancel">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header xCNModalHead">
					<label class="xCNTextModalHeard"><?php echo language('document/document/document', 'tDocDocumentCancel') ?></label>
				</div>
				<div class="modal-body">
					<p id="obpMsgApv"><?php echo language('document/document/document', 'tDocCancelText1') ?></p>
					<p><strong><?php echo language('document/document/document', 'tDocCancelText2') ?></strong></p>
				</div>
				<div class="modal-footer">
					<button onclick="JSvTransferBchOutCancel(true)" type="button" class="btn xCNBTNPrimery">
						<?php echo language('common/main/main', 'tModalConfirm'); ?>
					</button>
					<button type="button" class="btn xCNBTNDefult" data-dismiss="modal">
						<?php echo language('common/main/main', 'tModalCancel'); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Cancel Doc -->
<?php } ?>

<!-- Begin Pdt Column Control Panel -->
<div class="modal fade" id="odvTransferBchOutPdtColumnControlPanel" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="xCNHeardModal modal-title" style="display:inline-block"><?php echo language('common/main/main', 'tModalAdvTable'); ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="odvTransferBchOutPdtColummControlDetail">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn xCNBTNDefult" data-dismiss="modal"><?php echo language('common/main/main', 'tModalAdvClose'); ?></button>
				<button type="button" class="btn xCNBTNPrimery" onclick="JSxTransferBchOutUpdatePdtColumn()"><?php echo language('common/main/main', 'tModalAdvSave'); ?></button>
			</div>
		</div>
	</div>
</div>
<!-- End Add Cash Panel -->

<!-- Modal -->
<div class="modal fade" id="odvTBPopupCancel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header xCNModalHead">
				<label class="xCNTextModalHeard"><?=language('document/producttransferbranch/producttransferbranch','tTBPMsgCancel')?></label>
			</div>
			<div class="modal-body">
                <p id="obpMsgApv"><?=language('document/producttransferbranch/producttransferbranch','tTBPMsgDocProcess')?></p>
                <p><strong><?=language('document/producttransferbranch/producttransferbranch','tTBPMsgCanCancel')?></strong></p>
			</div>
			<div class="modal-footer">
                <button onclick="JSnTBCancel(true)" type="button" class="btn xCNBTNPrimery">
					<?=language('common/main/main', 'tModalConfirm'); ?>
				</button>
				<button type="button" class="btn xCNBTNDefult" data-dismiss="modal">
					<?=language('common/main/main', 'tModalCancel'); ?>
				</button>
			</div>
		</div>
	</div>
</div>

<!-- ======================================================================== Modal ????????????????????????????????????????????? ======================================================================== -->
<div id="odvTbxModalPDTNotFound" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="xCNHeardModal modal-title" style="display:inline-block"><?=language('common/main/main', 'tMessageAlert')?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>??????????????????????????????????????????????????? ????????????????????????????????????????????????????????????</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn xCNBTNPrimery" data-dismiss="modal" onclick="JSxNotFoundClose();" >
                        <?php echo language('common/main/main', 'tModalConfirm'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>


	
<!-- ============================================================================================================================================================================= -->

<div id="odvTbxModalPDTMoreOne" class="modal fade">
        <div class="modal-dialog" role="document" style="width: 85%; margin: 1.75rem auto;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <label class="xCNTextModalHeard" style="font-weight: bold; font-size: 20px;">????????????????????????????????????????????????</label>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right">
                            <button class="btn xCNBTNPrimery xCNBTNPrimery2Btn" onclick="JCNxConfirmPDTMoreOne(1)" data-dismiss="modal">???????????????</button>
                            <button class="btn xCNBTNDefult xCNBTNDefult2Btn" onclick="JCNxConfirmPDTMoreOne(2)" data-dismiss="modal">?????????</button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <table class="table table-striped xCNTablePDTMoreOne">
                        <thead>
                            <tr>
                                <th class="xCNTextBold" style="text-align:center; width:120px;"><?=language('common/main/main', 'tModalcodePDT')?></th>
                                <th class="xCNTextBold" style="text-align:center; width:160px;"><?=language('common/main/main', 'tModalnamePDT')?></th>
                                <th class="xCNTextBold" style="text-align:center; width:120px;"><?=language('common/main/main', 'tModalPriceUnit')?></th>
                                <th class="xCNTextBold" style="text-align:center; width:160px;"><?=language('common/main/main', 'tModalbarcodePDT')?></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- ============================================================================================================================================================================= -->

<!-- ============================================================== View Modal Delete Product In DT DocTemp Multiple  ============================================================ -->
<div id="odvTbxModalDelPdtInDTTempMultiple" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header xCNModalHead">
                    <label class="xCNTextModalHeard"><?php echo language('common/main/main','tModalDelete')?></label>
                </div>
                <div class="modal-body">
                    <span id="ospTextConfirmDelMultiple" class="xCNTextModal" style="display: inline-block; word-break:break-all"></span>
                    <input type="hidden" id="ohdConfirmPIDocNoDelete"   name="ohdConfirmPIDocNoDelete">
                    <input type="hidden" id="ohdConfirmPISeqNoDelete"   name="ohdConfirmPISeqNoDelete">
                    <input type="hidden" id="ohdConfirmPIPdtCodeDelete" name="ohdConfirmPIPdtCodeDelete">
                    <input type="hidden" id="ohdConfirmPIPunCodeDelete" name="ohdConfirmPIPunCodeDelete">

                </div>
                <div class="modal-footer">
                    <button id="osmConfirmDelMultiple" class="btn xCNBTNPrimery xCNBTNPrimery2Btn" type="button"><?php echo language('common/main/main', 'tModalConfirm')?></button>
                    <button class="btn xCNBTNDefult xCNBTNDefult2Btn" type="button"  data-dismiss="modal"><?php echo language('common/main/main', 'tModalCancel')?></button>
                </div>
            </div>
        </div>
    </div>
<!-- ============================================================================================================================================================================= -->



<?php include('script/jTransferBchOutPageadd.php') ?>
<script src="<?php echo  base_url('application/modules/common/assets/src/jFormValidate.js')?>"></script>
<script>
    function JSxNotFoundClose(){
        $('#oetTboInsertBarcode').focus();
    }

	//?????????????????????????????????????????????
	function  JSxSearchFromBarcode(e,elem){
        var tValue = $(elem).val();
        // if($('#oetPIFrmSplCode').val() != ""){
            JSxCheckPinMenuClose();
            if(tValue.length === 0){
            }else{
                $('#oetTboInsertBarcode').attr('readonly',true);
                JCNSearchBarcodePdt(tValue);
                $('#oetTboInsertBarcode').val('');
            }
        // }else{
        //     $('#odvPIModalPleseselectCustomer').modal('show');
        //     $('#oetTboInsertBarcode').val('');
        // }
        e.preventDefault();
    }

	//???????????????????????????????????????
	function JCNSearchBarcodePdt(ptTextScan){

        var tWhereCondition = "";

        $.ajax({
            type : "POST",
            url : "BrowseDataPDTTableCallView",
            data :{
                Qualitysearch   : [],
                ReturnType  : "M",
                aPriceType  : ["Cost","tCN_Cost","Company","1"],
                // aPriceType  : ['Price4Cst',tPISplCode],
                NextFunc    : "",
                SelectTier  : ["Barcode"],
                SPL: "",
                BCH: $("#oetTransferBchOutXthBchFrmCode").val(),
                MER: $('#oetTransferBchOutXthMerchantFrmCode').val(),
                SHP: $('#oetTransferBchOutXthShopFrmCode').val(),
                Where       : [tWhereCondition],
                tTextScan   : ptTextScan,
            },
            catch : false,
            timeout : 0,
            success : function (tResult){
				// localStorage.removeItem('TBX_LocalItemDataDelDtTemp');
                JCNxCloseLoading();
                $('#ohdTbxObjPdtFhnCallBack').val(tResult);
                var oText = JSON.parse(tResult);
                console.log('Event Scan',oText);
                if(oText == '800'){
                    $('#oetTboInsertBarcode').attr('readonly',false);
                    $('#odvTbxModalPDTNotFound').modal('show');
                    $('#oetTboInsertBarcode').val('');
                }else{
                    // ??????????????????????????????????????????????????????????????????
                    if(oText.length > 1){
                        $('#odvTbxModalPDTMoreOne').modal('show');
                        $('#odvTbxModalPDTMoreOne .xCNTablePDTMoreOne tbody').html('');

                        for(i=0; i<oText.length; i++){
                            var aNewReturn      = JSON.stringify(oText[i]);
                            var tTest = "["+aNewReturn+"]";
                            var oEncodePackData = window.btoa(unescape(encodeURIComponent(tTest)));
                            var tHTML = "<tr class='xCNColumnPDTMoreOne"+i+" xCNColumnPDTMoreOne' data-information='"+oEncodePackData+"' style='cursor: pointer;'>";
                                tHTML += "<td>"+oText[i].pnPdtCode+"</td>";
                                tHTML += "<td>"+oText[i].packData.PDTName+"</td>";
                                tHTML += "<td>"+oText[i].packData.PUNName+"</td>";
                                tHTML += "<td>"+oText[i].ptBarCode+"</td>";
                                tHTML += "</tr>";
                            $('#odvTbxModalPDTMoreOne .xCNTablePDTMoreOne tbody').append(tHTML);
                        }

                        //?????????????????????????????????
                        $('.xCNColumnPDTMoreOne').off();

                        //????????????????????????????????????
                        $('.xCNColumnPDTMoreOne').on('dblclick',function(e){
                            $('#odvTbxModalPDTMoreOne').modal('hide');
                            var tJSON = decodeURIComponent(escape(window.atob($(this).attr('data-information'))));
                            FSvTBXAddPdtIntoDocDTTempScan(tJSON); //Client
                            JSvTransferBchOutInsertPdtToTemp(tJSON); //Server
                            // var oPIObjPdtFhnCallBack =  $('#ohdTbxObjPdtFhnCallBack').val();
                            var oJSONPdt = JSON.parse(tJSON);
                            var oOptionForFashion = {
                                    'bListItemAll'  : false,
                                    'tSpcControl'  : 0,
                                    'tNextFunc' : 'JSvTransferBchOutInsertPdtToTemp'
                                }
                                JSxCheckProductSerialandFashion(oJSONPdt,oOptionForFashion,'insert');

                        });

                        //??????????????????????????????
                        $('.xCNColumnPDTMoreOne').on('click',function(e){
                            //??????????????????????????????????????????????????????????????????
                            $('.xCNColumnPDTMoreOne').removeClass('xCNActivePDT');
                            $('.xCNColumnPDTMoreOne').children().attr('style', 'background-color:transparent !important; color:#232C3D !important;');
                            // $('.xCNColumnPDTMoreOne').children(':last-child').css('text-align','right');
                            $(this).addClass('xCNActivePDT');
                            $(this).children().attr('style', 'background-color:#179bfd !important; color:#FFF !important;');
                            // $(this).children().last().css('text-align','right');
                        });

                    }else{
                        //??????????????????????????????
                        var aNewReturn  = JSON.stringify(oText);
                        console.log('aNewReturn: '+aNewReturn);
                        FSvTBXAddPdtIntoDocDTTempScan(aNewReturn); //Client
                        JSvTransferBchOutInsertPdtToTemp(aNewReturn); //Server
               
                        var oOptionForFashion = {
                                'bListItemAll'  : false,
                                'tSpcControl'  : 0,
                                'tNextFunc' : 'JSvTransferBchOutInsertPdtToTemp'
                            }
                    JSxCheckProductSerialandFashion(oText,oOptionForFashion,'insert');
                    }
                }
            },
            error: function (jqXHR,textStatus,errorThrown){
                JCNSearchBarcodePdt(ptTextScan);
            }
        });
    }



    //????????????????????????????????? ???????????????????????????????????????????????????????????????
    function JCNxConfirmPDTMoreOne($ptType){
        if($ptType == 1){
            $("#odvTbxModalPDTMoreOne .xCNTablePDTMoreOne tbody .xCNActivePDT").each(function( index ) {
                var tJSON = decodeURIComponent(escape(window.atob($(this).attr('data-information'))));
                FSvTBXAddPdtIntoDocDTTempScan(tJSON);
                JSvTransferBchOutInsertPdtToTemp(tJSON);
   
                var oJSONPdt = JSON.parse(tJSON);
                var oOptionForFashion = {
                                    'bListItemAll'  : false,
                                    'tSpcControl'  : 0,
                                    'tNextFunc' : 'JSvTransferBchOutInsertPdtToTemp'
                                }
             JSxCheckProductSerialandFashion(oJSONPdt,oOptionForFashion,'insert');
            });
        }else{
            $('#oetTboInsertBarcode').attr('readonly',false);
            $('#oetTboInsertBarcode').val('');
        }
    }


	
	//Function : ?????????????????????????????????????????? ?????? Table ???????????? Client
	//Create : 2018-08-28 Krit(Copter)
	function JSvTransferBchOutInsertPdtToTemp(pjPdtData) {
			var nStaSession = JCNxFuncChkSessionExpired();
			if (typeof nStaSession !== "undefined" && nStaSession == 1) {
				pnXthVATInOrEx = 2;

				console.log(pjPdtData);

				// JCNxOpenLoading();
				var ptXthDocNoSend = "";
				if ($("#ohdTBRoute").val() == "docTransferBchOutEventEdit") {
				ptXthDocNoSend = $("#oetTransferBchOutDocNo").val();
				}

				$('#oetTboInsertBarcode').attr('readonly',false);
            	$('#oetTboInsertBarcode').val('');

				$.ajax({
				type: "POST",
				url: "docTransferBchOutInsertPdtToTmp",
				data: {
					ptBchCode        : $("#oetTransferBchOutBchCode").val(),
					ptXthDocNo          : ptXthDocNoSend,
					pnXthVATInOrEx      : pnXthVATInOrEx,
					tPdtData             : pjPdtData,
					pnTBOptionAddPdt    : $("#ocmTransferBchOutOptionAddPdt").val()
				},
				cache: false,
				timeout: 0,
				success: function (oResult) {
					// console.log(oResult);
					// JSvTBLoadPdtDataTableHtml();
					// var aResult = JSON.parse(oResult);
                    // if(aResult['nStaEvent']==1){
                        // JCNxCloseLoading();
                    // }

				},
				error: function (jqXHR, textStatus, errorThrown) {
					JCNxResponseError(jqXHR, textStatus, errorThrown);
				}
				});
			} else {
				JCNxShowMsgSessionExpired();
			}
	}





</script>
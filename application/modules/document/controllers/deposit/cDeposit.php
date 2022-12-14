<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cDeposit extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('company/company/mCompany');
        $this->load->model('document/deposit/mDeposit');
        $this->load->model('payment/rate/mRate');
        $this->load->model('company/vatrate/mVatRate');
        $this->load->model('company/branch/mBranch');
        $this->load->model('company/shop/mShop');
        $this->load->model('authen/login/mLogin');
    }

    public function index($nBrowseType, $tBrowseOption)
    {
        $aData['nBrowseType'] = $nBrowseType;
        $aData['tBrowseOption'] = $tBrowseOption;
        $aData['aAlwEvent'] = FCNaHCheckAlwFunc('deposit/0/0');
        $aData['vBtnSave'] = FCNaHBtnSaveActiveHTML('deposit/0/0');
        $aData['nOptDecimalShow'] = FCNxHGetOptionDecimalShow();
        $aData['nOptDecimalSave'] = FCNxHGetOptionDecimalSave();
        $this->load->view('document/deposit/wDeposit', $aData);
    }

    /**
     * Functionality : Main Page List
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : List Page
     * Return Type : View
     */
    public function FSxCDepositList()
    {
        $nLangResort = $this->session->userdata("tLangID");
        $nLangEdit = $this->session->userdata("tLangEdit");
        $aData = array(
            'FTBchCode'    => $this->session->userdata("tSesUsrBchCode"),
            'FTShpCode'    => '',
            'nPage' => 1,
            'nRow' => 20,
            'FNLngID' => $nLangEdit,
            'tSearchAll' => ''
        );

        $aBchData = $this->mBranch->FSnMBCHList($aData);
        $aShpData = $this->mShop->FSaMSHPList($aData);
        $aDataMaster = array(
            'aBchData' => $aBchData,
            'aShpData' => $aShpData
        );

        $this->load->view('document/deposit/wDepositList', $aDataMaster);
    }

    /**
     * Functionality : Get HD Table List
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : HD Table List
     * Return Type : View
     */
    public function FSxCDepositDataTable()
    {
        $tAdvanceSearchData = $this->input->post('oAdvanceSearch');
        $nPage = $this->input->post('nPageCurrent');
        $aAlwEvent = FCNaHCheckAlwFunc('deposit/0/0');
        $nOptDecimalShow = FCNxHGetOptionDecimalShow();



        if ($nPage == '' || $nPage == null) {
            $nPage = 1;
        } else {
            $nPage = $this->input->post('nPageCurrent');
        }

        $nLangResort = $this->session->userdata("tLangID");
        $nLangEdit = $this->session->userdata("tLangEdit");
        $aData = array(
            'FNLngID' => $nLangEdit,
            'nPage' => $nPage,
            'nRow' => 10,
            'aAdvanceSearch' => json_decode($tAdvanceSearchData, true)
        );

        $aResList = $this->mDeposit->FSaMHDList($aData);
        $aGenTable = array(
            'aAlwEvent' => $aAlwEvent,
            'aDataList' => $aResList,
            'nPage' => $nPage,
            'nOptDecimalShow' => $nOptDecimalShow
        );

        $this->load->view('document/deposit/wDepositDatatable', $aGenTable);
    }

    /**
     * Functionality : Add Page
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Add Page
     * Return Type : View
     */
    public function FSxCDepositAddPage()
    {
        $tUserSessionID = $this->session->userdata('tSesSessionID');

        $aInfoWhere = array(
            "tBchCode" => $this->input->post("tBchCode"),
            "FTXthDocKey" => "TCNTPdtAdjStkHD"
        );
        $this->mDeposit->FSxMDeleteDoctemForNewEvent($aInfoWhere);

        $aClearInTmpParams = [
            'tUserSessionID' => $tUserSessionID,
            'tDocKey' => 'TFNTBnkDplHD'
        ];
        $this->mDeposit->FSxMClearInTmp($aClearInTmpParams);

        $nOptDecimalShow = FCNxHGetOptionDecimalShow();
        $nOptDocSave = FCNnHGetOptionDocSave();
        $nOptScanSku = FCNnHGetOptionScanSku();
        // $nLangResort = $this->session->userdata("tLangID");
        $nLangEdit = $this->session->userdata("tLangEdit");

        $aDataWhere  = array(
            'FNLngID' => $nLangEdit
        );

        $tAPIReq = "";
        $tMethodReq = "GET";
        $aResList = $this->mCompany->FSaMCMPList($tAPIReq, $tMethodReq, $aDataWhere);

        if ($aResList['rtCode'] == '1') {
            $tBchCode = $aResList['raItems']['rtCmpBchCode'];
            $tCompCode = $aResList['raItems']['rtCmpCode'];
            $tCmpRteCode = $aResList['raItems']['rtCmpRteCode'];
            $tVatCode = $aResList['raItems']['rtVatCodeUse'];
            $aVatRate = FCNoHCallVatlist($tVatCode);
            if (FCNnHSizeOf($aVatRate) != 0) {
                $cVatRate = $aVatRate['FCVatRate'][0];
            } else {
                $cVatRate = "";
            }

            $aDataRate = array(
                'FTRteCode' => $tCmpRteCode,
                'FNLngID' => $nLangEdit
            );

            $aResultRte = $this->mRate->FSaMRTESearchByID($aDataRate);
            $cXthRteFac = $aResultRte['raItems']['rcRteRate'];
        } else {
            $tBchCode = "";
            $tCompCode = "";
            $tCmpRteCode = "";
            $tVatCode = "";
            $cVatRate = "";
            $cXthRteFac = "";
        }

        $tUsrLogin = $this->session->userdata('tSesUsername');
        $tDptCode = FCNnDOCGetDepartmentByUser($tUsrLogin);

        $aDataShp  = array(
            'FNLngID'   => $nLangEdit,
            'tUsrLogin' => $tUsrLogin
        );
        $aDataUserGroup = $this->mDeposit->FStTFWGetShpCodeForUsrLogin($aDataShp);

        if ($aDataUserGroup == '') {
            $tBchCode = '';
            $tBchName = '';
            $tMchCode = '';
            $tMchName = '';
            $tShpCodeStart = "";
            $tShpNameStart = "";
            $tShpCodeEnd = "";
            $tShpNameEnd = "";
            $tWahCodeStart = "";
            $tWahNameStart = "";
            $tWahCodeEnd = "";
            $tWahNameEnd = "";
            $tShpTypeStart = "";
        } else {
            $tShpTypeStart = $aDataUserGroup["FTShpType"];
            // ???????????? user ???????????????????????????????????????????????????????????????????????????
            if ($aDataUserGroup["FTBchCode"] == '') {
                // ????????????????????? ????????? Get Option Def
                $tBchCode = '';
                $tBchName = '';
            } else {
                $tBchCode = $aDataUserGroup["FTBchCode"];
                $tBchName = $aDataUserGroup["FTBchName"];
            }
            // ???????????? user ???????????????????????????????????????????????????????????????????????????
            $tMchCode = $aDataUserGroup["FTMerCode"];
            $tMchName = $aDataUserGroup["FTMerName"];
            // ???????????? user ????????????????????????????????????????????????????????????????????????????????????
            if ($aDataUserGroup["FTShpCode"] == '') {
                // ????????????????????? ????????? Get Option Def
                $tShpCodeStart = "";
                $tShpNameStart = "";
                $tShpCodeEnd = "";
                $tShpNameEnd = "";
                $tWahCodeStart = "";
                $tWahNameStart = "";
                $tWahCodeEnd = "";
                $tWahNameEnd = "";
            } else {
                $tShpCodeStart      = $aDataUserGroup["FTShpCode"];
                $tShpNameStart      = $aDataUserGroup["FTShpName"];
                $tShpCodeEnd        = "";
                $tShpNameEnd        = "";
                $tWahCodeStart      = $aDataUserGroup["FTWahCode"];
                $tWahNameStart      = $aDataUserGroup["FTWahName"];
                $tWahCodeEnd        = "";
                $tWahNameEnd        = "";
            }
        }

        $aDataAdd = array(
            'aResult'           =>  array('rtCode' => '99'),
            'aResultOrdDT'      =>  array('rtCode' => '99'),
            'nOptDecimalShow'   =>  $nOptDecimalShow,
            'nOptScanSku'       =>  $nOptScanSku,
            'nOptDocSave'       =>  $nOptDocSave,
            'tCmpRteCode'       =>  $tCmpRteCode,
            'tVatCode'          =>  $tVatCode,
            'cVatRate'          =>  $cVatRate,
            'cXthRteFac'        =>  $cXthRteFac,
            'tDptCode'          =>  $tDptCode,
            'tMchCode'          =>  $tMchCode,
            'tMchName'          =>  $tMchName,
            'tShpCodeStart'     =>  $tShpCodeStart,
            'tShpNameStart'     =>  $tShpNameStart,
            'tShpTypeStart'     =>  $tShpTypeStart,
            'tShpCodeEnd'       =>  $tShpCodeEnd,
            'tShpNameEnd'       =>  $tShpNameEnd,
            'tWahCodeStart'     =>  $tWahCodeStart,
            'tWahNameStart'     =>  $tWahNameStart,
            'tWahCodeEnd'       =>  $tWahCodeEnd,
            'tWahNameEnd'       =>  $tWahNameEnd,
            'tCompCode'         =>  $tCompCode,
            'tBchCode'          =>  $tBchCode,
            'tBchName'          =>  $tBchName,
            'tBchCompCode'      =>  FCNtGetBchInComp(),
            'tBchCompName'      =>  FCNtGetBchNameInComp()
        );
        $this->load->view('document/deposit/wDepositPageadd', $aDataAdd);
    }

    /**
     * Functionality : Add Event
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Status
     * Return Type : Array
     */
    public function FSaCDepositAddEvent()
    {
        try {
            $tUserSessionID = $this->session->userdata('tSesSessionID');
            $tUserLoginCode = $this->session->userdata('tSesUsername');
            $tDocDate = $this->input->post('oetDepositDocDate') . " " . $this->input->post('oetDepositDocTime');

            $aCalInTmpParams = [
                'tUserSessionID' => $tUserSessionID,
                'tDocKey' => 'TFNTBnkDplHD'
            ];
            $CalInTemp = $this->mDeposit->FSxMCalInTmp($aCalInTmpParams);

            $aDataMaster = array(
                'tIsAutoGenCode' => $this->input->post('ocbDepositAutoGenCode'),
                'FTBchCode' => $this->input->post('oetDepositBchCode'),
                'FTBdhDocNo' => $this->input->post('oetDepositDocNo'),
                'FTBdtCode' => $this->input->post('oetDepositTypeCode'), // ???????????????????????????????????????????????????
                'FDBdhDate' => $tDocDate,
                'FTMerCode' => $this->input->post('oetDepositMchCode'),
                'FTShpCode' => $this->input->post('oetDepositShpCode'),
                'FTUsrCode' => $tUserLoginCode, // ???????????????????????????
                'FTBdhUsrSender' => $this->input->post('oetDepositUsrCode'), // ????????????????????????
                'FTBdhUsrApv' => '', // ??????????????????????????????
                'FTBbkCode' => $this->input->post('oetDepositAccountCodeTo'), // ???????????????????????????????????????
                'FTBdhRefExt' => $this->input->post('oetDepositBdhRefExt'), // ????????????????????? ???????????????????????????????????? ??????????????????
                'FDBdhRefExtDate' => $this->input->post('oetDepositBdhRefExtDate'), // ????????????????????? ???????????????????????????????????? ??????????????????
                'FCBdhTotCash' => floatval($CalInTemp['FCBddRefAmtCashTotal']), // ?????????????????????????????????(Cal in DT)
                'FCBdhTotCheque' => floatval($CalInTemp['FCBddRefAmtChequeTotal']), // ???????????????????????????????????????
                'FCBdhTotChqChg' => 0, // ???????????????????????????????????????-???????????????
                'FCBdhTotChqVat' => 0, // ???????????????????????????????????????-????????????
                'FCBdhTotal' => floatval($CalInTemp['FCBddRefAmtTotal']), // ????????????????????????????????????(Cal in DT)
                'FTBdhRmk' => $this->input->post('otaDepositBdhRmk'), // ????????????????????????
                'FTBdhStaDoc' => '1', // ??????????????? ??????????????????  1:?????????????????????, 2:??????????????????????????????, 3:??????????????????
                'FTBdhStaApv' => '', // ??????????????? ????????????????????? ?????????????????? ????????????:????????????????????????, 1:????????????????????????????????? 
                'FNBdhStaDocAct' => $this->input->post('ocbDepositBdhStaDocAct'), // ??????????????? ?????????????????????????????? 0:NonActive, 1:Active
                'FDLastUpdOn' => date('Y-m-d'),
                'FTLastUpdBy' => $tUserLoginCode,
                'FDCreateOn' => date('Y-m-d'),
                'FTCreateBy' => $tUserLoginCode,
            );

            $this->db->trans_begin();

            // Setup Doc No.
            if ($aDataMaster['tIsAutoGenCode'] == '1') { // Check Auto Gen Reason Code?
                // Call Auto Gencode Helper
                $aStoreParam = array(
                    "tTblName" => 'TFNTBnkDplHD',
                    "tDocType" => 7,
                    "tBchCode" => $aDataMaster["FTBchCode"],
                    "tShpCode" => "",
                    "tPosCode" => "",
                    "dDocDate" => date("Y-m-d")
                );
                $aAutogen = FCNaHAUTGenDocNo($aStoreParam);
                $aDataMaster['FTBdhDocNo'] = $aAutogen[0]["FTXxhDocNo"];

                // Auto Gen Reason Code
                /* $aGenCode = FCNaHGenCodeV5('TFNTBnkDplHD', '7');
                if ($aGenCode['rtCode'] == '1') {
                    $aDataMaster['FTBdhDocNo'] = $aGenCode['rtBdhDocNo'];
                } */
            }

            $this->mDeposit->FSaMAddUpdateHD($aDataMaster);

            $aUpdateDocNoInTmpParams = [
                'tDocNo' => $aDataMaster['FTBdhDocNo'],
                'tDocKey' => 'TFNTBnkDplHD',
                'tUserSessionID' => $tUserSessionID
            ];
            $this->mDeposit->FSaMUpdateDocNoInTmp($aUpdateDocNoInTmpParams); // Update DocNo ????????????????????? Doctemp

            $aTempToDTParams = [
                'tDocNo' => $aDataMaster['FTBdhDocNo'],
                'tBchCode' => $aDataMaster['FTBchCode'],
                'tDocKey' => 'TFNTBnkDplHD',
                'tUserSessionID' => $tUserSessionID,
                'tUserLoginCode' => $tUserLoginCode
            ];
            $this->mDeposit->FSaMTempToDT($aTempToDTParams); // ????????????????????????????????????????????? Temp to DT

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $aReturn = array(
                    'nStaEvent'    => '900',
                    'tStaMessg'    => "Unsucess Add"
                );
            } else {
                $this->db->trans_commit();
                $aReturn = array(
                    'nStaCallBack' => $this->session->userdata('tBtnSaveStaActive'),
                    'tCodeReturn' => $aDataMaster['FTBdhDocNo'],
                    'nStaEvent'    => '1',
                    'tStaMessg' => 'Success Add'
                );
            }

            $this->output->set_content_type('application/json')->set_output(json_encode($aReturn));
        } catch (Exception $Error) {
            echo $Error;
        }
    }

    /**
     * Functionality : Edit Page
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Edit Page
     * Return Type : View
     */
    public function FSvCDepositEditPage()
    {
        $tDocNo = $this->input->post('tDocNo');
        $nLangEdit = $this->session->userdata("tLangEdit");
        $nLangResort = $this->session->userdata("tLangID");
        $aLangHave = FCNaHGetAllLangByTable('TFNMRate_L');
        // $tUsrLogin = $this->session->userdata('tSesUsername');
        $tUserSessionID = $this->session->userdata("tSesSessionID");
        $tUserLevel = $this->session->userdata('tSesUsrLevel');
        // $tBchCodeLogin = $tUserLevel == 'HQ' ? FCNtGetBchInComp() : $this->session->userdata("tSesUsrBchCode");

        $aAlwEvent = FCNaHCheckAlwFunc('deposit/0/0'); // Access Control
        // Get Option Show Decimal
        $nOptDecimalShow = FCNxHGetOptionDecimalShow();
        // Get Option Scan SKU
        $nOptDocSave = FCNnHGetOptionDocSave();
        //Get Option Scan SKU
        $nOptScanSku = FCNnHGetOptionScanSku();

        // Lang ????????????

        $nLangHave = FCNnHSizeOf($aLangHave);
        if ($nLangHave > 1) {
            if ($nLangEdit != '') {
                $nLangEdit = $nLangEdit;
            } else {
                $nLangEdit = $nLangResort;
            }
        } else {
            if (@$aLangHave[0]->nLangList == '') {
                $nLangEdit = '1';
            } else {
                $nLangEdit = $aLangHave[0]->nLangList;
            }
        }

        // Get Data
        $aGetHDParams = array(
            'tDocNo' => $tDocNo,
            'nLngID' => $nLangEdit,
            'tDocKey' => 'TFNTBnkDplHD',
        );
        $aResult = $this->mDeposit->FSaMGetHD($aGetHDParams); // Data TFNTBnkDplHD

        $aDTToTempParams = [
            'tDocNo' => $tDocNo,
            'tDocKey' => 'TFNTBnkDplHD',
            'tBchCode' => isset($aResult['raItems']['FTBchCode']) ? $aResult['raItems']['FTBchCode'] : '',
            'tUserSessionID' => $tUserSessionID,
            'nLngID' => $nLangEdit
        ];
        $this->mDeposit->FSaMDTToTemp($aDTToTempParams);

        $aDataEdit = array(
            'nOptDecimalShow' => $nOptDecimalShow,
            'nOptDocSave' => $nOptDocSave,
            'nOptScanSku' => $nOptScanSku,
            'aResult' => $aResult,
            'aAlwEvent' => $aAlwEvent,
            'tBchCompCode' => FCNtGetBchInComp(),
            'tBchCompName' => FCNtGetBchNameInComp()
        );
        $this->load->view('document/deposit/wDepositPageadd', $aDataEdit);
    }

    /**
     * Functionality : Edit Event
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Status
     * Return Type : Array
     */
    public function FSaCDepositEditEvent()
    {
        try {
            $tUserSessionID = $this->session->userdata('tSesSessionID');
            $tUserLoginCode = $this->session->userdata('tSesUsername');
            $tDocDate = $this->input->post('oetDepositDocDate') . " " . $this->input->post('oetDepositDocTime');

            $aCalInTmpParams = [
                'tUserSessionID' => $tUserSessionID,
                'tDocKey' => 'TFNTBnkDplHD'
            ];
            $CalInTemp = $this->mDeposit->FSxMCalInTmp($aCalInTmpParams);

            $aDataMaster = array(
                'tIsAutoGenCode' => $this->input->post('ocbDepositAutoGenCode'),
                'FTBchCode' => $this->input->post('oetDepositBchCode'),
                'FTBdhDocNo' => $this->input->post('oetDepositDocNo'),
                'FTBdtCode' => $this->input->post('oetDepositTypeCode'), // ???????????????????????????????????????????????????
                'FDBdhDate' => $tDocDate,
                'FTMerCode' => $this->input->post('oetDepositMchCode'),
                'FTShpCode' => $this->input->post('oetDepositShpCode'),
                'FTUsrCode' => $tUserLoginCode, // ???????????????????????????
                'FTBdhUsrSender' => $this->input->post('oetDepositUsrCode'), // ????????????????????????
                'FTBdhUsrApv' => '', // ??????????????????????????????
                'FTBbkCode' => $this->input->post('oetDepositAccountCodeTo'), // ???????????????????????????????????????
                'FTBdhRefExt' => $this->input->post('oetDepositBdhRefExt'), // ????????????????????? ???????????????????????????????????? ??????????????????
                'FDBdhRefExtDate' => $this->input->post('oetDepositBdhRefExtDate'), // ????????????????????? ???????????????????????????????????? ??????????????????
                'FCBdhTotCash' => floatval($CalInTemp['FCBddRefAmtCashTotal']), // ?????????????????????????????????(Cal in DT)
                'FCBdhTotCheque' => floatval($CalInTemp['FCBddRefAmtChequeTotal']), // ???????????????????????????????????????
                'FCBdhTotChqChg' => 0, // ???????????????????????????????????????-???????????????
                'FCBdhTotChqVat' => 0, // ???????????????????????????????????????-????????????
                'FCBdhTotal' => floatval($CalInTemp['FCBddRefAmtTotal']), // ????????????????????????????????????(Cal in DT)
                'FTBdhRmk' => $this->input->post('otaDepositBdhRmk'), // ????????????????????????
                'FTBdhStaDoc' => '1', // ??????????????? ??????????????????  1:?????????????????????, 2:??????????????????????????????, 3:??????????????????
                'FTBdhStaApv' => '', // ??????????????? ????????????????????? ?????????????????? ????????????:????????????????????????, 1:????????????????????????????????? 
                'FNBdhStaDocAct' => $this->input->post('ocbDepositBdhStaDocAct'), // ??????????????? ?????????????????????????????? 0:NonActive, 1:Active
                'FDLastUpdOn' => date('Y-m-d'),
                'FTLastUpdBy' => $tUserLoginCode,
                'FDCreateOn' => date('Y-m-d'),
                'FTCreateBy' => $tUserLoginCode,
            );
            
            $this->db->trans_begin();

            $this->mDeposit->FSaMAddUpdateHD($aDataMaster);

            $aUpdateDocNoInTmpParams = [
                'tDocNo' => $aDataMaster['FTBdhDocNo'],
                'tDocKey' => 'TFNTBnkDplHD',
                'tUserSessionID' => $tUserSessionID
            ];
            $this->mDeposit->FSaMUpdateDocNoInTmp($aUpdateDocNoInTmpParams); // Update DocNo ????????????????????? Doctemp

            $aTempToDTParams = [
                'tDocNo' => $aDataMaster['FTBdhDocNo'],
                'tBchCode' => $aDataMaster['FTBchCode'],
                'tDocKey' => 'TFNTBnkDplHD',
                'tUserSessionID' => $tUserSessionID,
                'tUserLoginCode' => $tUserLoginCode
            ];
            $this->mDeposit->FSaMTempToDT($aTempToDTParams); // ????????????????????????????????????????????? Temp to DT

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $aReturn = array(
                    'nStaEvent'    => '900',
                    'tStaMessg'    => "Unsucess Add"
                );
            } else {
                $this->db->trans_commit();
                $aReturn = array(
                    'nStaCallBack' => $this->session->userdata('tBtnSaveStaActive'),
                    'tCodeReturn' => $aDataMaster['FTBdhDocNo'],
                    'nStaEvent'    => '1',
                    'tStaMessg' => 'Success Add'
                );
            }

            $this->output->set_content_type('application/json')->set_output(json_encode($aReturn));
        } catch (Exception $Error) {
            echo $Error;
        }
    }

    /**
     * Functionality : Check Doc No. Duplicate
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Status
     * Return Type : String
     */
    public function FStCDepositUniqueValidate()
    {
        $aStatus = ['bStatus' => false];

        if ($this->input->is_ajax_request()) { // Request check
            $tDepositDocCode = $this->input->post('tDepositCode');
            $bIsDocNoDup = $this->mDeposit->FSbMCheckDuplicate($tDepositDocCode);

            if ($bIsDocNoDup) { // If have record
                $aStatus['bStatus'] = true;
            }
        } else {
            echo 'Method Not Allowed';
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($aStatus));
    }

    /**
     * Functionality : Cancel Document
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Status
     * Return Type : String
     */
    public function FStCDepositDocCancel()
    {

        $tDocNo = $this->input->post('tDocNo');

        $this->db->trans_begin();

        $aDocCancelParams = array(
            'tDocNo' => $tDocNo,
        );
        $aStaCancel = $this->mDeposit->FSaMDocCancel($aDocCancelParams);

        if ($aStaCancel['rtCode'] == 1) {
            $this->db->trans_commit();
            $aCancel = array(
                'nSta' => 1,
                'tMsg' => "Cancel Success",
            );
        } else {
            $this->db->trans_rollback();
            $aCancel = array(
                'nSta' => 2,
                'tMsg' => "Cancel Fail",
            );
        }
        echo json_encode($aCancel);
    }

    /**
     * Functionality : Approve Document
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Status
     * Return Type : String
     */
    public function FStCDepositDocApprove()
    {

        $tDocNo  = $this->input->post('tDocNo');
        // $tStaApv = $this->input->post('tStaApv');
        $tDocType = $this->input->post('tDocType');
        $tUsrBchCode = FCNtGetBchInComp();

        $this->db->trans_begin();

        $aDocApproveParams = array(
            'tDocNo' => $tDocNo,
            'tApvCode' => $this->session->userdata('tSesUsername')
        );
        $this->mDeposit->FSaMDocApprove($aDocApproveParams);

        try {
            $aMQParams = [
                "queueName" => "BR_QTransfer".$tUsrBchCode,
                "params" => [
                    "ptFunction" => "BankDepositSlip", // ???????????? Function
                    "ptSource" => "BCH.AdaStoreBack", // ??????????????????
                    "ptDest" => "BCH.MQ_Rcv", // ?????????????????????
                    "ptFilter" => $tUsrBchCode, // ??????????????????????????????????????????
                    "ptData" => [
                        "ptFTBchCode" => $tUsrBchCode, // Branchcode
                        "ptFTBdhDocNo" => $tDocNo, // ????????????????????????????????????
                    ]
                ]
            ];
            FCNxCallRabbitMQ($aMQParams);

            $this->db->trans_commit();
        } catch (\ErrorException $err) {

            $this->db->trans_rollback();
            $aReturn = array(
                'nStaEvent' => '900',
                'tStaMessg' => language('common/main/main', 'tApproveFail')
            );
            $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($aReturn));
        }
    }

    /**
     * Functionality : Delete Document
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Status
     * Return Type : String
     */
    public function FStDepositDeleteDoc()
    {

        $tDocNo = $this->input->post('tDocNo');

        $this->db->trans_begin();

        $aDelMasterParams = [
            'tDocNo' => trim($tDocNo)
        ];
        $this->mDeposit->FSaMDelMaster($aDelMasterParams);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $aStatus = array(
                'rtCode' => '905',
                'rtDesc' => 'Cannot Delete Item.',
            );
        } else {
            $this->db->trans_commit();
            $aStatus = array(
                'rtCode' => '1',
                'rtDesc' => 'Delete Complete.',
            );
        }
        $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($aStatus));
    }

    /**
     * Functionality : Delete Multiple Document
     * Parameters : -
     * Creator : 04/02/2020 piya
     * Last Modified : -
     * Return : Status
     * Return Type : String
     */
    public function FStDepositDeleteMultiDoc()
    {
        $aDocNo = $this->input->post('aDocNo');

        $this->db->trans_begin();

        foreach ($aDocNo as $aItem) {
            $aDelMasterParams = [
                'tDocNo' => trim($aItem)
            ];
            $this->mDeposit->FSaMDelMaster($aDelMasterParams);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $aStatus = array(
                'rtCode' => '905',
                'rtDesc' => 'Cannot Delete Item.',
            );
        } else {
            $this->db->trans_commit();
            $aStatus = array(
                'rtCode' => '1',
                'rtDesc' => 'Delete Complete.',
            );
        }
        $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($aStatus));
    }
}

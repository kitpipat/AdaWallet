<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'libraries/rabbitmq/vendor/autoload.php');
require_once(APPPATH . 'config/rabbitmq.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Printbarcode_Controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settingconfig/settingprint/Printbarcode_Model');
        date_default_timezone_set("Asia/Bangkok");
    }

    /**
     * Functionality : Main page for Print BarCode
     * Parameters : $nLabPriBrowseType, $tLabPriBrowseOption
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : -
     * Return Type : -
     */
    public function index($nLabPriBrowseType, $tLabPriBrowseOption)
    {
        $aDataConfigView    = [
            'nLabPriBrowseType'     => $nLabPriBrowseType,
            'tLabPriBrowseOption'   => $tLabPriBrowseOption,
            // 'aAlwEvent'             => FCNaHCheckAlwFunc('settingprint/0/0'),
            'aAlwEvent'             => ['tAutStaFull' => 1, 'tAutStaAdd' => 1, 'tAutStaEdit' => 1],
            'vBtnSave'              => FCNaHBtnSaveActiveHTML('settingprint/0/0'),
            'nOptDecimalShow'       => FCNxHGetOptionDecimalShow(),
            'nOptDecimalSave'       => FCNxHGetOptionDecimalSave()
        ];
        $this->load->view('settingconfig/settingprint/wPrintBarCodePage', $aDataConfigView);
    }

    /**
     * Functionality : Function Call DataTables Printer BarCode
     * Parameters : Ajax and Function Parameter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : String View
     * Return Type : View
     */
    public function FSvPriBarDataList()
    {
        $nPage      = $this->input->post('nPageCurrent');
        $tSearchAll = $this->input->post('tSearchAll');
        $tPlbCode      = $this->input->post('tPlbCode');
        $bSeleteImport      = $this->input->post('bSeleteImport');

        if ($nPage == '' || $nPage == null) {
            $nPage = 1;
        } else {
            $nPage = $this->input->post('nPageCurrent');
        }


        // if ($tPlbCode == '' || $tPlbCode == null) {
        //     $tPlbCode = 1;
        // } else {
        //     $tPlbCode = $this->input->post('tPlbCode');
        // }

        if (!$tSearchAll) {
            $tSearchAll = '';
        }
        //Lang ภาษา
        $nLangResort    = $this->session->userdata("tLangID");
        $nLangEdit      = $this->session->userdata("tLangEdit");


        $aDataWhere = array(
            'tPrnBarSheet'       => $this->input->post('tPrnBarSheet'),
            'tPrnBarXthDocDateFrom' => $this->input->post('tPrnBarXthDocDateFrom'),
            'tPrnBarXthDocDateTo'   => $this->input->post('tPrnBarXthDocDateTo'),
            'tPrnBarBrowseRptNoFromCode' => $this->input->post('tPrnBarBrowseRptNoFromCode'),
            'tPrnBarBrowseRptNoToCode'   => $this->input->post('tPrnBarBrowseRptNoToCode'),
            'tPrnBarBrowsePdtFromCode'  => $this->input->post('tPrnBarBrowsePdtFromCode'),
            'tPrnBarBrowsePdtToCode'   => $this->input->post('tPrnBarBrowsePdtToCode'),
            'tPrnBarBrowsePdtGrpFromCode' => $this->input->post('tPrnBarBrowsePdtGrpFromCode'),
            'tPrnBarBrowsePdtGrpToCode'  => $this->input->post('tPrnBarBrowsePdtGrpToCode'),
            'tPrnBarBrowsePdtTypeFromCode'  => $this->input->post('tPrnBarBrowsePdtTypeFromCode'),
            'tPrnBarBrowsePdtTypeToCode' => $this->input->post('tPrnBarBrowsePdtTypeToCode'),
            'tPrnBarBrowsePdtBrandFromCode' => $this->input->post('tPrnBarBrowsePdtBrandFromCode'),
            'tPrnBarBrowsePdtBrandToCode' => $this->input->post('tPrnBarBrowsePdtBrandToCode'),
            'tPrnBarBrowsePdtModelFromCode' => $this->input->post('tPrnBarBrowsePdtModelFromCode'),
            'tPrnBarBrowsePdtModelToCode' => $this->input->post('tPrnBarBrowsePdtModelToCode'),
            'tPrnBarPdtDepartCode'  => $this->input->post('tPrnBarPdtDepartCode'),
            'tPrnBarPdtClassCode' => $this->input->post('tPrnBarPdtClassCode'),
            'tPrnBarPdtSubClassCode' => $this->input->post('tPrnBarPdtSubClassCode'),
            'tPrnBarPdtGroupCode' => $this->input->post('tPrnBarPdtGroupCode'),
            'tPrnBarPdtComLinesCode' => $this->input->post('tPrnBarPdtComLinesCode'),
            'tPrnBarTotalPrint'  => $this->input->post('tPrnBarTotalPrint'),
            'tPrnBarPlbCode' => $tPlbCode
        );

        $aData  = array(
            'nPage'         => $nPage,
            'nRow'          => 20,
            'FNLngID'       => $nLangEdit,
            'tSearchAll'    => $tSearchAll,
            'tSesAgnCode'   => $this->session->userdata("tSesUsrAgnCode"),
            'aDataWhere' => $aDataWhere,
            'bSeleteImport' => $bSeleteImport
        );


        $aResList = $this->Printbarcode_Model->FSaMPriBarList($aData);



        $aGenTable = array(
            'aDataList' => $aResList,
            'nPage' => $nPage,
            'tSearchAll' => $tSearchAll,
            'tPlbCode'         => $tPlbCode,
            'bSeleteImport' => $bSeleteImport
        );
        $this->load->view('settingconfig/settingprint/wPrintBarCodeDataTable', $aGenTable);
    }


    public function FSvPriDataTableSearch()
    {
        $nPage      = $this->input->post('nPageCurrent');
        $tSearchAll = $this->input->post('tSearchAll');
        $tPlbCode      = $this->input->post('tPlbCode');
        $bSeleteImport      = $this->input->post('bSeleteImport');

        if ($nPage == '' || $nPage == null) {
            $nPage = 1;
        } else {
            $nPage = $this->input->post('nPageCurrent');
        }
        if (!$tSearchAll) {
            $tSearchAll = '';
        }
        //Lang ภาษา
        $nLangResort    = $this->session->userdata("tLangID");
        $nLangEdit      = $this->session->userdata("tLangEdit");


        $aData  = array(
            'nPage'         => $nPage,
            'nRow'          => 20,
            'FNLngID'       => $nLangEdit,
            'tSearchAll'    => $tSearchAll,
            'tSesAgnCode'   => $this->session->userdata("tSesUsrAgnCode"),
            'bSeleteImport' => $bSeleteImport
        );


        $aResList = $this->Printbarcode_Model->FSaMPriBarListSearch($aData);


        $aGenTable = array(
            'aDataList' => $aResList,
            'nPage' => $nPage,
            'tSearchAll' => $tSearchAll,
            'tPlbCode'         => $tPlbCode,
            'bSeleteImport' => $bSeleteImport
        );
        $this->load->view('settingconfig/settingprint/wPrintBarCodeDataTable', $aGenTable);
    }



    /**
     * Functionality : Function Edit In Line Printer BarCode
     * Parameters : Ajax 
     * Creator : 10/01/2022 Worakorn
     * Last Modified : -
     * Return : -
     * Return Type : -
     */
    function FSvPriBarUpdateEditInLine()
    {
        $nValue = $this->input->post('nValue');
        $tPdtCode = $this->input->post('tPdtCode');
        $tPdtBarCode = $this->input->post('tPdtBarCode');

        $this->Printbarcode_Model->FSaMPriBarUpdateEditInLine($nValue, $tPdtCode, $tPdtBarCode);
    }


    /**
     * Functionality : Function Update Checked All Printer BarCode
     * Parameters : Ajax 
     * Creator : 10/01/2022 Worakorn
     * Last Modified : -
     * Return : -
     * Return Type : -
     */
    function FSvPriBarUpdateCheckedAll()
    {
        $bCheckedAll = $this->input->post('bCheckedAll');

        $this->Printbarcode_Model->FSaMPriBarUpdateCheckedAll($bCheckedAll);
    }



    /**
     * Functionality : Function Update Checked Printer BarCode
     * Parameters : Ajax 
     * Creator : 10/01/2022 Worakorn
     * Last Modified : -
     * Return : -
     * Return Type : -
     */
    function FSvPriBarUpdateChecked()
    {
        $tValueChecked = $this->input->post('tValueChecked');
        $tPdtCode = $this->input->post('tPdtCode');
        $tBarCode = $this->input->post('tBarCode');

        $this->Printbarcode_Model->FSaMPriBarUpdateChecked($tValueChecked, $tPdtCode, $tBarCode);
    }


    /**
     * Functionality : Function MQ Process BarCode
     * Parameters : Ajax 
     * Creator : 10/01/2022 Worakorn
     * Last Modified : -
     * Return : -
     * Return Type : -
     */
    function FSvPriBarMQProcess()
    {
        $tPrnBarPrnLableCode = $this->input->post('tPrnBarPrnLableCode');
        $tPrnBarPrnSrvCode = $this->input->post('tPrnBarPrnSrvCode');

        $this->Printbarcode_Model->FSaMPriBarUpdateLableCode($tPrnBarPrnLableCode);

        $aData =  $this->Printbarcode_Model->FSaMPriBarListDataMQ();

        $aMQParams = [
            "queueName" => $tPrnBarPrnSrvCode,
            "tVhostType" => "MQ",
            "params" => [
                'ptFunction' => 'PrintLabel',
                'ptSource' => 'AdaStoreBack',
                'ptDest' => 'AdaBarPrintSrv',
                'ptFilter' => $this->session->userdata('tSesSessionID'),
                'ptData' => json_encode($aData['raItems']),
                'pnPage' => 1,
                'pnTotalPage' => 1

            ]
        ];
        // echo "<pre>";print_r($aMQParams);echo "</pre>";exit;

        $tQueueName = (isset($aMQParams['queueName'])) ? $aMQParams['queueName'] : '';
        $aParams = (isset($aMQParams['params'])) ? $aMQParams['params'] : [];

        $oConnection = new AMQPStreamConnection(MQ_PRINT_HOST, MQ_PRINT_PORT, MQ_PRINT_USER, MQ_PRINT_PASS, MQ_PRINT_VHOST);
        $oChannel = $oConnection->channel();
        $oChannel->queue_declare($tQueueName, false, true, false, false);
        $oMessage = new AMQPMessage(json_encode($aParams));
        $oChannel->basic_publish($oMessage, "", $tQueueName);
        $oChannel->close();
        $oConnection->close();
        return 1;
    }


    public function FSaCPRIImportDataTable()
    {
        $this->load->view('settingconfig/settingprint/wPrintBarCodeImportDataTable');
    }

    public function FSaCPRIGetDataImport()
    {
        $aDataSearch = array(
            'nPageNumber'    => ($this->input->post('nPageNumber') == 0) ? 1 : $this->input->post('nPageNumber'),
            'nLangEdit'        => $this->session->userdata("tLangEdit"),
            'tTableKey'        => 'TCNMBranch',
            'tSessionID'    => $this->session->userdata("tSesSessionID"),
            'tTextSearch'    => $this->input->post('tSearch')
        );
        $aGetData                     = $this->Printbarcode_Model->FSaMPRIGetTempData($aDataSearch);
        $data['draw']                 = ($this->input->post('nPageNumber') == 0) ? 1 : $this->input->post('nPageNumber');
        $data['recordsTotal']         = $aGetData['numrow'];
        $data['recordsFiltered']     = $aGetData['numrow'];
        $data['data']                 = $aGetData;
        $data['error']                 = array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function FSaCPRIImportDelete()
    {
        $aDataMaster = array(
            'FNTmpSeq'         => $this->input->post('FNTmpSeq'),
            'tTableKey'        => 'TCNMBranch',
            'tSessionID'    => $this->session->userdata("tSesSessionID")
        );
        $aResDel   = $this->Printbarcode_Model->FSaMPRIImportDelete($aDataMaster);

        //validate ข้อมูลซ้ำในตาราง Tmp
        $tBchCode = $this->input->post('FTBchCode');
        if (is_array($tBchCode)) {
            foreach ($tBchCode as $tValue) {
                $aValidateData = array(
                    'tUserSessionID'    => $this->session->userdata("tSesSessionID"),
                    'tFieldName'        => 'FTBchCode',
                    'tFieldValue'        => $tValue
                );
                FCNnMasTmpChkInlineCodeDupInTemp($aValidateData);
            }
        } else {
            $aValidateData = array(
                'tUserSessionID'    => $this->session->userdata("tSesSessionID"),
                'tFieldName'        => 'FTBchCode',
                'tFieldValue'        => $tBchCode
            );
            FCNnMasTmpChkInlineCodeDupInTemp($aValidateData);
        }

        //ให้มันวิ่งเข้าไปหาในตารางจริงอีกรอบ
        $aValidateData = array(
            'tUserSessionID'    => $this->session->userdata("tSesSessionID"),
            'tFieldName'        => 'FTBchCode',
            'tTableName'        => 'TCNMBranch'
        );
        FCNnMasTmpChkCodeDupInDB($aValidateData);

        echo json_encode($aResDel);
    }

    // ย้ายรายการจาก Temp ไปยัง Master
    public function FSaCPRIImportMove2Master()
    {

        $tTypeCaseDuplicate = $this->input->post('tTypeCaseDuplicate');

        $aDataMaster = array(
            'nLangEdit'                => $this->session->userdata("tLangEdit"),
            'tTableKey'                => 'TCNMBranch',
            'tSessionID'            => $this->session->userdata("tSesSessionID"),
            'dDateOn'                => date('Y-m-d H:i:s'),
            'dBchDateStart'            => date('Y-m-d'),
            'dBchDateStop'            => date('Y-m-d', strtotime('+1 year')),
            'tUserBy'                => $this->session->userdata("tSesUsername"),
            'tTypeCaseDuplicate'     => $this->input->post('tTypeCaseDuplicate')
        );

        $this->db->trans_begin();

        $aResult =     $this->Printbarcode_Model->FSaMPRIImportMove2Master($aDataMaster);
        $this->Printbarcode_Model->FSaMPRIImportMove2MasterAndInsWah($aDataMaster);
        $this->Printbarcode_Model->FSaMPRIImportMove2MasterAndReplaceOrInsert($aDataMaster);
        $this->Printbarcode_Model->FSaMPRIImportMove2MasterDeleteTemp($aDataMaster);

        // Update Session Branch
        if ($this->session->userdata('tSesUsrLevel') != "HQ") {
            $tSesUserCode  =  $this->session->userdata('tSesUserCode');
            $aDataUsrGroup         = $this->mLogin->FSaMLOGGetDataUserLoginGroup($tSesUserCode);
            $tUsrBchCodeMulti     = $this->mLogin->FStMLOGMakeArrayToString($aDataUsrGroup, 'FTBchCode', 'value');
            $tUsrBchNameMulti     = $this->mLogin->FStMLOGMakeArrayToString($aDataUsrGroup, 'FTBchName', 'value');
            $nUsrBchCount        = $this->mLogin->FStMLOGMakeArrayToString($aDataUsrGroup, 'FTBchCode', 'counts');
            $this->session->set_userdata("tSesUsrBchCodeMulti", $tUsrBchCodeMulti);
            $this->session->set_userdata("tSesUsrBchNameMulti", $tUsrBchNameMulti);
            $this->session->set_userdata("nSesUsrBchCount", $nUsrBchCount);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $aReturnToHTML = array(
                'tCode'     => '99',
                'tDesc'     => 'Error'
            );
        } else {
            $this->db->trans_commit();
            $aReturnToHTML = $aResult;
        }

        echo json_encode($aReturnToHTML);
    }

    //หาจำนวนทั้งหมดออกมาโชว์
    public function FSaCPRIImportGetItemAll()
    {
        $aResult  = $this->Printbarcode_Model->FSaMPRIGetTempDataAtAll();
        echo json_encode($aResult);
    }
}

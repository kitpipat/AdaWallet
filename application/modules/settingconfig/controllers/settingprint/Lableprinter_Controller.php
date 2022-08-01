<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lableprinter_Controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('settingconfig/settingprint/Lableprinter_Model');
        date_default_timezone_set("Asia/Bangkok");
    }

    /**
     * Functionality : Main page for Lable Printer
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
        $this->load->view('settingconfig/settingprint/wLablePrinter', $aDataConfigView);
    }

    /**
     * Functionality : Function Call Lable Printer Page List
     * Parameters : Ajax and Function Parameter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : String View
     * Return Type : View
     */
    public function FSvLabPriListPage()
    {
        $aDataConfigView    = ['aAlwEvent'             => ['tAutStaFull' => 1, 'tAutStaAdd' => 1, 'tAutStaEdit' => 1]];
        $this->load->view('settingconfig/settingprint/wLablePrinterList', $aDataConfigView);
    }

    /**
     * Functionality : Function Call DataTables Lable Printer
     * Parameters : Ajax and Function Parameter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : String View
     * Return Type : View
     */
    public function FSvLabPriDataList()
    {
        $nPage      = $this->input->post('nPageCurrent');
        $tSearchAll = $this->input->post('tSearchAll');
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
            'nRow'          => 10,
            'FNLngID'       => $nLangEdit,
            'tSearchAll'    => $tSearchAll,
            'tSesAgnCode'   => $this->session->userdata("tSesUsrAgnCode"),
        );


        $aResList = $this->Lableprinter_Model->FSaMLabPriList($aData);

        $aGenTable = array(
            'aDataList' => $aResList,
            'nPage' => $nPage,
            'tSearchAll' => $tSearchAll
        );
        $this->load->view('settingconfig/settingprint/wLablePrinterDataTable', $aGenTable);
    }

    /**
     * Functionality : Function CallPage Lable Printer Add
     * Parameters : Ajax and Function Parameter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : String View
     * Return Type : View
     */
    public function FSvLabPriAddPage()
    {

        $nLangResort    = $this->session->userdata("tLangID");
        $nLangEdit      = $this->session->userdata("tLangEdit");


        $aData  = array(
            'FNLngID'   => $nLangEdit,

        );
        $tAPIReq        = "";
        $tMethodReq     = "GET";
        $aDataAdd = array(
            'aResult'   => array(
                'rtCode' => '99',
                'tSesAgnCode'   => $this->session->userdata("tSesUsrAgnCode"),
                'tSesAgnName'   => $this->session->userdata("tSesUsrAgnName")
            )
        );

        $this->load->view('settingconfig/settingprint/wLablePrinterAdd', $aDataAdd);
    }

    /**
     * Functionality : Function CallPage Lable Printer Edit
     * Parameters : Ajax and Function Parameter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : String View
     * Return Type : View
     */
    public function FSvLabPriEditPage()
    {

        $tLabPriCode       = $this->input->post('tLabPriCode');
        $nLangResort    = $this->session->userdata("tLangID");
        $nLangEdit      = $this->session->userdata("tLangEdit");


        $aData  = array(
            'FTLabPriCode' => $tLabPriCode,
            'FNLngID'   => $nLangEdit
        );


        $aLabPriData       = $this->Lableprinter_Model->FSaMLabPriSearchByID($aData);
        $aDataEdit      = array('aResult' => $aLabPriData);
        $this->load->view('settingconfig/settingprint/wLablePrinterAdd', $aDataEdit);
    }

    /**
     * Functionality : Event Add Lable Printer
     * Parameters : Ajax and Function Parameter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Status Add Event
     * Return Type : String
     */
    public function FSaLabPriAddEvent()
    {
        try {
            $aDataMaster = array(
                'tIsAutoGenCode' => $this->input->post('ocbLabPriAutoGenCode'),
                'FTLabPriCode'   => $this->input->post('oetLabPriCode'),
                'FTLabPriRmk'    => $this->input->post('otaLabPriRemark'),
                'FTLabPriName'   => $this->input->post('oetLabPriName'),
                'FTLastUpdBy'    => $this->session->userdata('tSesUsername'),
                'FDLastUpdOn'    => date('Y-m-d H:i:s'),
                'FTCreateBy'     => $this->session->userdata('tSesUsername'),
                'FDCreateOn'     => date('Y-m-d H:i:s'),
                'FNLngID'        => $this->session->userdata("tLangEdit"),
                'FTLabPriStaUse'       => (!empty($this->input->post('ocbLabPriStatusUse'))) ? 1 : 2,
                'FTLblCode'   => $this->input->post('oetLableFormatCode'),
                // 'FTSppCode'   => $this->input->post('oetPortPrnCode'),
                // 'FTAgnCode'  => $this->input->post('oetCstAgnCode')
            );

            if ($aDataMaster['tIsAutoGenCode'] == '1') { // Check Auto Gen Lable Printer Code?
                // Auto Gen Lable Printer Code
                $aStoreParam = array(
                    "tTblName"    => 'TCNMPrnLabel',
                    "tDocType"    => 0,
                    "tBchCode"    => "",
                    "tShpCode"    => "",
                    "tPosCode"    => "",
                    "dDocDate"    => date("Y-m-d")
                );
                $aAutogen   = FCNaHAUTGenDocNo($aStoreParam);
                $aDataMaster['FTLabPriCode']   = $aAutogen[0]["FTXxhDocNo"];
            }

            $oCountDup  = $this->Lableprinter_Model->FSoMLabPriCheckDuplicate($aDataMaster['FTLabPriCode']);
            $nStaDup    = $oCountDup[0]->counts;

            if ($nStaDup == 0) {
                $this->db->trans_begin();
                $aStaLabPriMaster  = $this->Lableprinter_Model->FSaMLabPriAddUpdateMaster($aDataMaster);
                $aStaLabPriLang    = $this->Lableprinter_Model->FSaMLabPriAddUpdateLang($aDataMaster);
                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    $aReturn = array(
                        'nStaEvent'    => '900',
                        'tStaMessg'    => "Unsucess Add Event"
                    );
                } else {
                    $this->db->trans_commit();
                    $aReturn = array(
                        'nStaCallBack'    => 1,
                        'tCodeReturn'    => $aDataMaster['FTLabPriCode'],
                        'nStaEvent'        => '1',
                        'tStaMessg'        => 'Success Add Event'
                    );
                }
            } else {
                $aReturn = array(
                    'nStaEvent'    => '801',
                    'tStaMessg'    => "Data Code Duplicate"
                );
            }
            echo json_encode($aReturn);
        } catch (Exception $Error) {
            echo $Error;
        }
    }

    /**
     * Functionality : Event Edit Lable Printer
     * Parameters : Ajax and Function Parameter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Status Add Event
     * Return Type : String
     */
    public function FSaLabPriEditEvent()
    {
        try {
            $aDataMaster = array(
                'FTLabPriCode'  => $this->input->post('oetLabPriCode'),
                'FTLabPriRmk'   => $this->input->post('otaLabPriRemark'),
                'FTLabPriName'  => $this->input->post('oetLabPriName'),
                'FTLastUpdBy'   => $this->session->userdata('tSesUsername'),
                'FDLastUpdOn'   => date('Y-m-d H:i:s'),
                'FTCreateBy'    => $this->session->userdata('tSesUsername'),
                'FDCreateOn'    => date('Y-m-d H:i:s'),
                'FNLngID'       => $this->session->userdata("tLangEdit"),
                'FTLabPriStaUse'       => (!empty($this->input->post('ocbLabPriStatusUse'))) ? 1 : 2,
                'FTLblCode'   => $this->input->post('oetLableFormatCode'),
                // 'FTSppCode'   => $this->input->post('oetPortPrnCode'),
                // 'FTAgnCode'  => $this->input->post('oetCstAgnCode')
            );

            $this->db->trans_begin();
            $aStaLabPriMaster  = $this->Lableprinter_Model->FSaMLabPriAddUpdateMaster($aDataMaster);
            $aStaLabPriLang    = $this->Lableprinter_Model->FSaMLabPriAddUpdateLang($aDataMaster);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $aReturn = array(
                    'nStaEvent'    => '900',
                    'tStaMessg'    => "Unsucess Add Event"
                );
            } else {
                $this->db->trans_commit();
                $aReturn = array(
                    'nStaCallBack'    => 1,
                    'tCodeReturn'    => $aDataMaster['FTLabPriCode'],
                    'nStaEvent'        => '1',
                    'tStaMessg'        => 'Success Add Event'
                );
            }
            echo json_encode($aReturn);
        } catch (Exception $Error) {
            echo $Error;
        }
    }

    /**
     * Functionality : Event Delete Lable Printer
     * Parameters : Ajax and Function Parameter
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Status Delete Event
     * Return Type : String
     */
    public function FSaLabPriDeleteEvent()
    {
        $tIDCode = $this->input->post('tIDCode');
        $aDataMaster = array(
            'FTLabPriCode' => $tIDCode
        );

        $aResDel = $this->Lableprinter_Model->FSnMLabPriDel($aDataMaster);
        $aReturn = array(
            'nStaEvent' => $aResDel['rtCode'],
            'tStaMessg' => $aResDel['rtDesc']
        );
        echo json_encode($aReturn);
    }

    /**
     * Functionality : Vatrate unique check
     * Parameters : $tSelect "LabPricode"
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Check status true or false
     * Return Type : String 
     */
    public function FStLabPriUniqueValidate($tSelect = '')
    {

        if ($this->input->is_ajax_request()) { // Request check
            if ($tSelect == 'LabPriCode') {

                $tLabPriCode = $this->input->post('tLabPriCode');
                $oCustomerGroup = $this->Lableprinter_Model->FSoMLabPriCheckDuplicate($tLabPriCode);

                $tStatus = 'false';
                if ($oCustomerGroup[0]->counts > 0) { // If have record
                    $tStatus = 'true';
                }
                echo $tStatus;

                return;
            }
            echo 'Param not match.';
        } else {
            echo 'Method Not Allowed';
        }
    }

    //Functionality : Function Event Multi Delete
    //Parameters : Ajax Function Delete Lable Printer
    //Creator : 14/06/2018 wasin
    //Last Modified : -
    //Return : Status Event Delete And Status Call Back Event
    //Return Type : object
    public function FSoLabPriDeleteMulti()
    {
        $tLabPriCode = $this->input->post('tLabPriCode');

        $aLabPriCode = json_decode($tLabPriCode);
        foreach ($aLabPriCode as $oLabPriCode) {
            $aLabPri = ['FTLabPriCode' => $oLabPriCode];
            $this->Lableprinter_Model->FSnMLabPriDel($aLabPri);
        }
        echo json_encode($aLabPriCode);
    }

    /**
     * Functionality : Delete vat rate
     * Parameters : -
     * Creator : 20/12/2021 Worakorn
     * Last Modified : -
     * Return : Vat code
     * Return Type : Object
     */
    public function FSoLabPriDelete()
    {
        $tLabPriCode = $this->input->post('tLabPriCode');

        $aLabPri = ['FTLabPriCode' => $tLabPriCode];
        $this->Lableprinter_Model->FSnMLabPriDel($aLabPri);
        echo json_encode($tLabPriCode);
    }



    public function FSaLabPriEventExportJson()
    {

        $tLabPriCode =    $this->input->post('tLabPriCode');


        foreach (json_decode($tLabPriCode, true) as $aVal) {
            $tLabPriCodeTest[] = $aVal['nCode'];
        }

        $tLabPriCodeRePlace1 = implode(",",$tLabPriCodeTest);

        // $tLabPriCodeRePlace1 =   str_replace(array('[', ']'), '', $tLabPriCode);
        // $tLabPriCodeRePlace2 =   str_replace('"', "'", $tLabPriCodeRePlace1);
        $tLabPriCodeRePlace2 =   str_replace(",", "','", $tLabPriCodeRePlace1);

        $aLabPriData = $this->Lableprinter_Model->FSaMLabPriGetDataExport($tLabPriCodeRePlace2);
        $aLabelFmtData = $this->Lableprinter_Model->FSaMLabPriGetDataExportLabelFmt($tLabPriCodeRePlace2);
        $aLabelFmtLData = $this->Lableprinter_Model->FSaMLabPriGetDataExportLabelFmtL($tLabPriCodeRePlace2);
        $aPrnLabelData = $this->Lableprinter_Model->FSaMLabPriGetDataExportPrnLabel($tLabPriCodeRePlace2);
        $aPrnLabelLData = $this->Lableprinter_Model->FSaMLabPriGetDataExportPrnLabelL($tLabPriCodeRePlace2);


        $aUrlObject = $this->Lableprinter_Model->FSaMLabPriGetDataUrlObjectExport();
        $aUrlObjectLogin = $this->Lableprinter_Model->FSaMLabPriGetDataUrlObjectLoginExport();





        if (!empty($aLabPriData)) {

            //Set Export Data
            $aParamExport = array(
                'poaTCNSLabelFmt' =>  $aLabelFmtData['raItems'],
                'poaTCNSLabelFmt_L' =>  $aLabelFmtLData['raItems'],
                'poaTCNMPrnLabel' =>  $aPrnLabelData['raItems'],
                'poaTCNMPrnLabel_L' =>  $aPrnLabelLData['raItems'],
                'poaTCNTUrlObject' =>  $aUrlObject['raItems'],
                'poaTCNTUrlObjectLogin' => $aUrlObjectLogin['raItems']
            );
        } else {
            $aParamExport = array();
        }

        //Export Data
        // if (!empty($aParamExport)) {
        //     header('Content-type: application/json');
        //     header('Content-disposition: attachment; filename=Setting_Printer.json');
        echo json_encode($aParamExport);
        // }
        // exit();
    }
}

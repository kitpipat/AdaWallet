<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Bangkok');

class Adawallet_controller extends MX_Controller 
{
     /**
     * System Language
     * @var int
     */
    public $nLngID;
    public $tPublicAPI       = 'https://dev.ada-soft.com:44340/API/AdaWallet/API2Wallet/V5/Card';
    public $tPaymentAPI      = 'https://dev.ada-soft.com:44340/AdaPayment/AdaQR/v1/ada_genqr';
    public $tKeyAPI          = 'X-Api-Key'; //Key ของ API บน 94
    public $tValueAPI        = '12345678-1111-1111-1111-123456789410'; //Value ของ API บน 94
    public $tLineOA          = '@677trvja';
    // public $tQrcode          = '';

    public function __construct()
    {
        parent::__construct();
        
         //session set lang
        $CI = &get_instance();
        if ($CI->input->get('lang') and ($CI->input->get('lang') == 'th' || $CI->input->get('lang') == 'en')) {
            $CI->session->set_userdata('language', $CI->input->get('lang'));
            $this->session->set_userdata("lang", $CI->input->get('lang'));
        }

        $this->load->helper('date');
        $this->load->model('Adawallet_model');
        
    }

    public function index() {
        $this->load->view('adawallet/wRegister.php');
    }

    public function FSaCADWRegister() {

        $dformat = "%Y-%m-%d";
        $this->nLngID = FCNaHGetLangEdit();

        $tUrlCheckRegis = $this->tPublicAPI.'/Register';
        $tUrlCheckBalance = $this->tPublicAPI.'/CardSpotCheck';

        $aAPIKey    = array(
            'tKey'      => $this->tKeyAPI,
            'tValue'    => $this->tValueAPI
        );

        $adata  = array (
            'ptCstLineID' => $_POST['ptCstLineID'],
            'ptCstTel' => $_POST['ptCstTel'],
            'ptOAID' => $this->tLineOA
        );

        // print_r($adata);
        $aResultRegis  = FCNaHCallAPIBasic($tUrlCheckRegis,'POST',$adata,$aAPIKey);
        // print_r($aResultRegis);

        $adatacheck = array (
            'ptCrdCode' => '',
            'ptCstLineID' => $_POST['ptCstLineID'],
            'ptOAID' => $this->tLineOA,
            'ptDocDate' => @mdate($dformat) , 
            'pnTop' => '1',
            'pnLngID' => $this->nLngID,
        );

        // print_r($adatacheck);

        if($aResultRegis['rtCode'] == "1"){
            $aResultCheckInfo  = FCNaHCallAPIBasic($tUrlCheckBalance,'POST',$adatacheck,$aAPIKey);
        }

        echo json_encode($aResultCheckInfo);
        // print_r($aResultCheckInfo);
    }

    public function FSaCADWShowBalance() {
        
        $this->load->view('adawallet/wCheckBalance.php',);
    }

    public function FSaCADWCheckBalance() {

        $dformat = "%Y-%m-%d";
        $this->nLngID = FCNaHGetLangEdit();
        $tUrlCheckBalance = $this->tPublicAPI.'/CardSpotCheck';
        // $tLineID = '';

        $aAPIKey    = array(
            'tKey'      => $this->tKeyAPI,
            'tValue'    => $this->tValueAPI
        );

        $adatacheck = array (
            'ptCrdCode' => '',
            'ptCstLineID' => $_POST['ptCstLineID'],
            'ptOAID' => $this->tLineOA,
            'ptDocDate' => @mdate($dformat) , 
            'pnTop' => '1',
            'pnLngID' => $this->nLngID,
        );

        $aResultCheckInfo  = FCNaHCallAPIBasic($tUrlCheckBalance,'POST',$adatacheck,$aAPIKey);
        echo json_encode($aResultCheckInfo);
        
    }

    public function FSaCADWGenQR() {
        $aQuery = $this->Adawallet_model->FSxMADWRcvSpc();
        $dformat = "YmdHis";
        $tUrlGenQRCode = $this->tPaymentAPI;

        $adata  = array (
            'QRMode' => $aQuery[9]->FTSysStaUsrValue,
            'PromptPayID' => $aQuery[5]->FTSysStaUsrValue,
            'REF2' => $_POST['pnREF2'],
            'QR_Width' => '200',
            'QR_Height' => '200',
            'Resp_Lang' => 'THA',
            'MerchantID' => $aQuery[4]->FTSysStaUsrValue,
            'MerchantRef' => $aQuery[10]->FTSysStaUsrValue,
            'InvoiceID' => $_POST['ptInvoiceID'],
            'InvoiceDate' => date($dformat),
            'InvoiceAmt' => $_POST['ptAmount'],
            'TerminalID' => '00001',
            'BranchID' => '00001',
            'StoreID' => '00001',
            'Prefix' => $aQuery[6]->FTSysStaUsrValue,
            'Suffix' => ''
        );

        // print_r($adata); 

        $aResultQRCode  = FCNaHCallAPIBasic($tUrlGenQRCode,'POST',$adata);
        $aResultQRCode['ptInvoiceDate'] = $adata['InvoiceDate'];
        // $this->tQrcode = $aResultQRCode['QRStrImg'];
        echo json_encode($aResultQRCode);
        
    }


    public function FSaCADWTopup(){
        $aQuery = $this->Adawallet_model->FSxMADWRcvSpc();
        $tUrlTopup = $this->tPublicAPI.'/CardTopup';

        $aAPIKey    = array(
            'tKey'      => $this->tKeyAPI,
            'tValue'    => $this->tValueAPI
        );

        $adata = array(
            'ptCstLineID'=> $_POST['ptCstLineID'],
            'ptOAID'=> $this->tLineOA,
            'ptAmount'=> $_POST['ptAmount'],
            'ptPosCode'=> '00001',
            'ptBchCode'=> '00001',
            'ptInvoiceID'=> $_POST['ptInvoiceID'],
            'ptInvoiceDate'=> $_POST['ptInvoiceDate'],
            'ptMerchantID'=> $aQuery[4]->FTSysStaUsrValue,
            'ptMerchantRef'=> $aQuery[10]->FTSysStaUsrValue,
            'ptPrefix'=> $aQuery[6]->FTSysStaUsrValue,
            'ptSuffix'=> '',
            'ptLanguage'=> 'THA',
            'ptURL'=> $aQuery[11]->FTSysStaUsrValue,
            'pnTimeout'=> $aQuery[3]->FTSysStaUsrValue,
            'pnTimeQuery'=> $aQuery[2]->FTSysStaUsrValue,
        );

        // print_r($adata); 

        $aResultTopup  = FCNaHCallAPIBasic($tUrlTopup,'POST',$adata,$aAPIKey);
        $aResultTopup['ptOAID'] = $adata['ptOAID'];
        $aResultTopup['ptCstLineID'] = $adata['ptCstLineID'];
        $aResultTopup['ptAmount'] = $adata['ptAmount'];
        $aResultTopup['ptInvoiceID'] = $adata['ptInvoiceID'];
        echo json_encode($aResultTopup);
        
    }

    public function FSaCADWPayment() {
        $this->load->view('adawallet/wPayment.php',);
    }

    public function FSaCADWEventPayment() {

        $dformat = "%Y-%m-%d";
        $this->nLngID = FCNaHGetLangEdit();
        $tUrlCheckBalance = $this->tPublicAPI.'/CardSpotCheck';

        $aAPIKey    = array(
            'tKey'      => $this->tKeyAPI,
            'tValue'    => $this->tValueAPI
        );

        $adatacheck = array (
            'ptCrdCode' => '',
            'ptCstLineID' => $_POST['ptCstLineID'],
            'ptOAID' => $this->tLineOA,
            'ptDocDate' => @mdate($dformat) , 
            'pnTop' => '1',
            'pnLngID' => $this->nLngID,
        );

        $aResultCheckInfo  = FCNaHCallAPIBasic($tUrlCheckBalance,'POST',$adatacheck,$aAPIKey);
        echo json_encode($aResultCheckInfo);
    }


    public function FSaCADWRefund() {
        $this->load->view('adawallet/wRefund.php');
    }

    public function FSaCADWShowRefund() {

        $dformat = "%Y-%m-%d";
        $this->nLngID = FCNaHGetLangEdit();
        $tUrlCheckBalance = $this->tPublicAPI.'/CardSpotCheck';

        $aAPIKey    = array(
            'tKey'      => $this->tKeyAPI,
            'tValue'    => $this->tValueAPI
        );

        $adatacheck = array (
            'ptCrdCode' => '',
            'ptCstLineID' => $_POST['ptCstLineID'],
            'ptOAID' => $this->tLineOA,
            'ptDocDate' => @mdate($dformat) , 
            'pnTop' => '1',
            'pnLngID' => $this->nLngID,
        );

        $aResultCheckInfo  = FCNaHCallAPIBasic($tUrlCheckBalance,'POST',$adatacheck,$aAPIKey);
        echo json_encode($aResultCheckInfo);
    }

    public function FSaCADWEventRefund() {

        $tUrlCheckBalance = $this->tPublicAPI.'/ReturnTopup';

        $aAPIKey    = array(
            'tKey'      => $this->tKeyAPI,
            'tValue'    => $this->tValueAPI
        );

        $adata = array (
            'ptCstLineID'=> $_POST['ptCstLineID'],
            'ptOAID'=> $this->tLineOA,
            'ptAmount'=> $_POST['ptAmount'],
            'ptPosCode'=> '00001',
            'ptBchCode'=> '00001',
            'ptInvoiceID'=> $_POST['ptInvoiceID']
        );

        $aResultRefund  = FCNaHCallAPIBasic($tUrlCheckBalance,'POST',$adata,$aAPIKey);
        echo json_encode($aResultRefund);

    }

}
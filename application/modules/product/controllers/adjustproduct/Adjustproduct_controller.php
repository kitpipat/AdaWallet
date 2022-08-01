<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

class Adjustproduct_controller extends MX_Controller {

    public function __construct(){
        parent::__construct ();
        $this->load->model('product/adjustproduct/Adjustproduct_model');
        date_default_timezone_set("Asia/Bangkok");
    }

    public function index(){
        $nMsgResp   = array('title'=>"Product Brand");
        $isXHR      = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) === 'XMLHTTPREQUEST';
        if(!$isXHR){
            $this->load->view ( 'common/wHeader', $nMsgResp);
            $this->load->view ( 'common/wTopBar', array ('nMsgResp'=>$nMsgResp));
            $this->load->view ( 'common/wMenu', array ('nMsgResp'=>$nMsgResp));
        }

        $vBtnSave = FCNaHBtnSaveActiveHTML('product/0/0'); //Load Html ของปุ่ม Save ที่เก็บ Session ปัจจุบัน
        $aAlwEventAdjPdt	    = FCNaHCheckAlwFunc('product/0/0');
        $this->load->view('product/adjustproduct/wAdjustProduct', array (
            'nMsgResp'          => $nMsgResp,
            'vBtnSave'          => $vBtnSave,
            'aAlwEventAdjPdt'   => $aAlwEventAdjPdt
        ));
    }

    //Functionality : Function Call Product Promotion Brand Page List
    //Parameters : Ajax and Function Parameter
    //Creator : 22/06/2021 Nattakit(Nale)
    //Return : String View
    //Return Type : View
    public function FSvCAJPPageFrom(){
        $aAlwEventAdjPdt	    = FCNaHCheckAlwFunc('product/0/0');
        $this->load->view('product/adjustproduct/wAdjustProductPageFrom', array(
            'aAlwEventPdtBrand' => $aAlwEventAdjPdt
        ));
    }

    //Functionality : Function Call DataTables Product Brand
    //Parameters : Ajax Call View DataTable
    //Creator : 22/06/2021 Nattakit(Nale)
    //Return : String View
    //Return Type : View
    public function FSaCAJPDumpDataToTemp(){
        try{
            $nLangEdit      = $this->session->userdata("tLangEdit");
            $aSearchAll = array(
                'tAJPAgnCode' => $this->input->post('oetAJPAgnCode'),
                'tAJPBchCode' => $this->input->post('oetAJPBchCode'),
                'tAJPPdtCodeFrom' => $this->input->post('oetAJPPdtCodeFrom'),
                'tAJPPdtCodeTo' => $this->input->post('oetAJPPdtCodeTo'),
                'tAJPPgpCode' => $this->input->post('oetAJPPgpCode'),
                'tAJPPbnCode' => $this->input->post('oetAJPPbnCode'),
                'tAJPPmoCode' => $this->input->post('oetAJPPmoCode'),
                'tAJPPtyCode' => $this->input->post('oetAJPPtyCode'),
                'tFhnPdtDepartCode' => $this->input->post('oetFhnPdtDepartCode'),
                'tFhnPdtClassCode' => $this->input->post('oetFhnPdtClassCode'),
                'tFhnPdtSubClassCode' => $this->input->post('oetFhnPdtSubClassCode'),
                'tFhnPdtGroupCode' => $this->input->post('oetFhnPdtGroupCode'),
                'tFhnPdtComLinesCode' => $this->input->post('oetFhnPdtComLinesCode'),
                'tFhnPdtSeasonCode' => $this->input->post('oetFhnPdtSeasonCode'),
                'tFhnPdtFabricCode' => $this->input->post('oetFhnPdtFabricCode'),
                'tFhnPdtSizeCode' => $this->input->post('oetFhnPdtSizeCode'),
                'tFhnPdtColorCode' => $this->input->post('oetFhnPdtColorCode'),
                'tmAJPStaAlwPoHQ' => $this->input->post('ocmAJPStaAlwPoHQ'),
            );
  
            $aConditionAdjustProduct = array(
                'tAJPSelectTable' => $this->input->post('ocmAJPSelectTable'),
                'tAJPSelectField' => $this->input->post('ocmAJPSelectField'),
                'tAJPSelectValue' => $this->input->post('ocmAJPSelectValue'),
            );

            $aData  = array(
                'FNLngID'       => $nLangEdit,
                'aSearchAll'    => $aSearchAll,
                'aConditionAdjustProduct' => $aConditionAdjustProduct,
                'tSesAgnCode'   => $aSearchAll['tAJPAgnCode'],
            );

            $aPdtDataList           = $this->Adjustproduct_model->FSaMAJPDumpDataToTemp($aData);

            echo json_encode($aPdtDataList);
        }catch(Exception $Error){
            echo $Error;
        }
    }
    


    //Functionality : Function Call DataTables Product Brand
    //Parameters : Ajax Call View DataTable
    //Creator : 22/06/2021 Nattakit(Nale)
    //Return : String View
    //Return Type : View
    public function FSvCAJPDataTable(){
        try{

      
            $nPage          = ($this->input->post('nPageCurrent') == '' || null)? 1 : $this->input->post('nPageCurrent');   // Check Number Page
            $nLangResort    = $this->session->userdata("tLangID");
            $nLangEdit      = $this->session->userdata("tLangEdit");
            
            $nPagePDTAll = $this->input->post('nPagePDTAll');
            $aConditionAdjustProduct = array(
                'tAJPSelectTable' => $this->input->post('ocmAJPSelectTable'),
                'tAJPSelectField' => $this->input->post('ocmAJPSelectField'),
                'tAJPSelectValue' => $this->input->post('ocmAJPSelectValue'),
            );
   
            $aData  = array(
                'nPage'         => $nPage,
                'nRow'          => 50,
                'FNLngID'       => $nLangEdit,
                'nPagePDTAll'   =>  $nPagePDTAll
            );

            $aPdtDataList           = $this->Adjustproduct_model->FSaMAJPGetDataTable($aData);
            
            $aAlwEventPdtBrand	    = FCNaHCheckAlwFunc('product/0/0');
            $aGenTable  = array(
                'aPdtDataList'      => $aPdtDataList,
                'aConditionAdjustProduct' => $aConditionAdjustProduct,
                'nPage'             => $nPage,
            );
            $this->load->view('product/adjustproduct/wAdjustProductDataTable',$aGenTable);
        }catch(Exception $Error){
            echo $Error;
        }
    }

    //Functionality : Function Call DataTables Product Brand
    //Parameters : Ajax Call View DataTable
    //Creator : 22/06/2021 Nattakit(Nale)
    //Return : String View
    //Return Type : View
   public function FSaCAJPEventEditRowIDInTemp(){


       $nRowID =  $this->input->post('nRowID');
       $nStaAlwSet =  $this->input->post('nStaAlwSet');

       $aParamData = array(
           'FNRowID' => $nRowID,
           'FTStaAlwSet' => $nStaAlwSet,
       );

       $aPdtUpdateTemp = $this->Adjustproduct_model->FSaMAJPEventEditRowIDInTemp($aParamData);

       echo json_encode($aPdtUpdateTemp);
   }

    //Functionality : Function Call DataTables Product Brand
    //Parameters : Ajax Call View DataTable
    //Creator : 22/06/2021 Nattakit(Nale)
    //Return : String View
    //Return Type : View
   public function FSaCAJPEventUpdate(){
    try{

        if(!empty($this->input->post('tAJPSelectValue'))){
            $tAJPSelectValue = $this->input->post('tAJPSelectValue');
        }else{
            $tAJPSelectValue = 'NULL';
        }
        $aConditionAdjustProduct = array(
            'tAJPSelectTable' => $this->input->post('tAJPSelectTable'),
            'tAJPSelectField' => $this->input->post('tAJPSelectField'),
            'tAJPSelectValue' => $tAJPSelectValue,
        );

        $aDataTableOnJoin = array(
            'TCNMPdt' =>"", //รหัสสินค้า
            'TCNMPdtPackSize' => "AND PDT.FTPunCode = ADJTMP.FTPunCode ", //หาหน่วย
            'TCNMPdtBar' => 'AND PDT.FTPunCode = ADJTMP.FTPunCode AND PDT.FTBarCode = ADJTMP.FTBarCode',  //หาบาร์โค้ด
            'TFHMPdtColorSize' => 'AND PDT.FTFhnRefCode = ADJTMP.FTFhnRefCode AND PDT.FNFhnSeq = ADJTMP.FNFhnSeq',  //หาบาร์โค้ด
        );

        $aParamData = array(
            'tTable' => $aConditionAdjustProduct['tAJPSelectTable'],
            'tField' => $aConditionAdjustProduct['tAJPSelectField'],
            'tValue' => $aConditionAdjustProduct['tAJPSelectValue'],
            'tOnJoin' => $aDataTableOnJoin[$aConditionAdjustProduct['tAJPSelectTable']]
        );

        $aPdtUpdateTemp = $this->Adjustproduct_model->FSaMAJPEventUpdate($aParamData);

        echo json_encode($aPdtUpdateTemp);
    }catch(Exception $Error){
        echo $Error;
    }
   }


    //Functionality : Function Call DataTables Product Brand
    //Parameters : Ajax Call View DataTable
    //Creator : 22/06/2021 Nattakit(Nale)
    //Return : String View
    //Return Type : View
   public function FSaCAJPExportData(){

        $tUserSesstionID = $this->session->userdata("tSesSessionID");
        $tCodeText = language('product/product/product','tAdjPdtCode');
        $tNameText = language('product/product/product','tAdjPdtName');
        $aDataParam = array(
            'tFileName' => 'AdjustProductionList_'.date('Ymd'),
            'aHeader'   => array(
                                    language('product/product/product','tAdjPdtOrdNo'),
                                     $tCodeText.language('product/product/product','tAdjPdtBranch'),
                                     $tNameText.language('product/product/product','tAdjPdtBranch'),
                                     $tCodeText.language('product/product/product','tAdjPdtProduct'),
                                     $tNameText.language('product/product/product','tAdjPdtProduct'),
                                     $tCodeText.language('product/product/product','tAdjPdtUnit'),
                                     $tNameText.language('product/product/product','tAdjPdtUnit'),
                                     language('product/product/product','tAdjPdtBarCode'),
                                     $tCodeText.language('product/product/product','tAdjPdtType'),
                                     $tNameText.language('product/product/product','tAdjPdtType'),
                                     $tCodeText.language('product/product/product','tAdjPdtGroup'),
                                     $tNameText.language('product/product/product','tAdjPdtGroup'),
                                     $tCodeText.language('product/product/product','tAdjPdtBrand'),
                                     $tNameText.language('product/product/product','tAdjPdtBrand'),
                                     $tCodeText.language('product/product/product','tAdjPdtModel'),
                                     $tNameText.language('product/product/product','tAdjPdtModel'),
                                ),
            'tQuery'    => "SELECT
                                ROW_NUMBER () OVER (ORDER BY ADJTMP.FNRowID DESC) AS FNRowID,
                                ADJTMP.FTBchCode,
                                ADJTMP.FTBchName,
                                ADJTMP.FTPdtCode,
                                ADJTMP.FTPdtName,
                                ADJTMP.FTPunCode,
                                ADJTMP.FTPunName,
                                ADJTMP.FTBarCode,
                                ADJTMP.FTPtyCode,
                                ADJTMP.FTPtyName,
                                ADJTMP.FTPgpChain,
                                ADJTMP.FTPgpName,
                                ADJTMP.FTPbnCode,
                                ADJTMP.FTPbnName,
                                ADJTMP.FTPmoCode,
                                ADJTMP.FTPmoName
                            FROM
                                TCNMAdjPdtTmp ADJTMP WITH (NOLOCK)
                            WHERE 1=1
                            AND ADJTMP.FTStaAlwSet = '1'
                            AND ADJTMP.FTSessionID = '$tUserSesstionID' ",
        );
        FCNxEXCExportByQuery($aDataParam);
        // FCNxEXCExportByTable($aDataParam);
        // FCNxEXCExportByArray($aDataParam);
   }


       //Functionality : Function Call DataTables Product Brand
    //Parameters : Ajax Call View DataTable
    //Creator : 22/06/2021 Nattakit(Nale)
    //Return : String View
    //Return Type : View
    public function FSaCAJPExportDataFhn(){

        $tUserSesstionID = $this->session->userdata("tSesSessionID");
        $tCodeText = language('product/product/product','tAdjPdtCode');
        $tNameText = language('product/product/product','tAdjPdtName');
        $aDataParam = array(
            'tFileName' => 'AdjustProductionList_'.date('Ymd'),
            'aHeader'   => array(
                                    language('product/product/product','tFhnPdtDataTableRefCode'),
                                    language('product/product/product','tPdtSreachType1'),
                                    language('product/product/product','tPdtSreachType3'),
                                    language('product/product/product','tFhnPdtName'),
                                    language('product/product/product','tFhnPdtDataTableColorName'),
                                    language('product/product/product','tAdjPdtFilBrand'),
                                    language('product/product/product','tFhnPdtDepart'),
                                    language('product/product/product','tFhnPdtClass'),
                                    language('product/product/product','tFhnPdtSubClass'),
                                    language('product/product/product','tFhnPdtGroup'),
                                    language('product/product/product','tFhnPdtComLines'),
                                    language('product/product/product','tPDTViewPackPriRet'),
                                    language('product/product/product','tFhnPdtStart'),
                                    language('product/product/product','tFhnPdtMod'),
                                    language('product/product/product','tFhnPdtDataTableFabricName'),
                                    language('product/product/product','tFhnPdtGender'),
                                    language('product/product/product','tAdjPdtFilModel'),
                                    language('product/product/product','tFhnPdtDataTableSeason'),
                                    language('product/product/product','tAdjPdtUnit'),
                                    language('product/product/product','tFhnPdtDataTableSize'),
                                    language('product/product/product','tFhnPdtDataTableColorCode'),
                                    language('product/product/product','tPDTCostStd'),
                                    language('product/product/product','tPDTCostOth'),
                                ),
            'tQuery'    => "SELECT
                                ADJTMP.FTFhnRefCode,
                                ADJTMP.FTPdtCode,
                                ADJTMP.FTBarCode,
                                ADJTMP.FTPdtName,
                                ADJTMP.FTClrName,
                                ADJTMP.FTPbnName,
                                ADJTMP.FTDepName,
                                ADJTMP.FTClsName,
                                ADJTMP.FTSclName,
                                ADJTMP.FTFhnPgpName,
                                ADJTMP.FTCmlName,
                                ADJTMP.FCXsdSalePrice,
                                convert(VARCHAR,ADJTMP.FDFhnStart,  103) AS FDFhnStart,
                                ADJTMP.FTFhnModNo,
                                ADJTMP.FTFabName,
                                CASE 
                                WHEN ADJTMP.FTFhnGender= '1' THEN 'MEN' 
                                WHEN ADJTMP.FTFhnGender= '2' THEN 'WOMEN' 
                                WHEN ADJTMP.FTFhnGender= '3' THEN 'UNSEX' 
                                END AS FTFhnGender,
                                ADJTMP.FTPmoName,
                                ADJTMP.FTSeaName,
                                ADJTMP.FTPunName,
                                ADJTMP.FTPszName,
                                ADJTMP.FTClrCode,
                                ADJTMP.FCFhnCostStd,
                                ADJTMP.FCFhnCostOth
                            FROM
                                TCNMAdjPdtTmp ADJTMP WITH (NOLOCK)
                            WHERE 1=1
                            AND ADJTMP.FTStaAlwSet = '1'
                            AND ADJTMP.FTSessionID = '$tUserSesstionID' ",
        );
        FCNxEXCExportByQuery($aDataParam);
        // FCNxEXCExportByTable($aDataParam);
        // FCNxEXCExportByArray($aDataParam);
   }

}
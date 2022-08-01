<script>
    /**
    * Functionality : เปลี่ยนหน้า pagenation
    * Parameters : -
    * Creator : 09/07/2019 Piya
    * Return : View
    * Return Type : View
    */
   function JSvSMLKAdjStaTempDataTableClickPage(ptPage) {
       var nPageCurrent = "";
       switch (ptPage) {
           case "next": //กดปุ่ม Next
               $(".xWBtnNext").addClass("disabled");
               nPageOld = $(".xWPage .active").text(); // Get เลขก่อนหน้า
               nPageNew = parseInt(nPageOld, 10) + 1; // +1 จำนวน
               nPageCurrent = nPageNew;
               break;
           case "previous": //กดปุ่ม Previous
               nPageOld = $(".xWPage .active").text(); // Get เลขก่อนหน้า
               nPageNew = parseInt(nPageOld, 10) - 1; // -1 จำนวน
               nPageCurrent = nPageNew;
               break;
           default:
               nPageCurrent = ptPage;
       }
       JSvCallPageCreditNotePdtDataTable(nPageCurrent);
   }
</script>

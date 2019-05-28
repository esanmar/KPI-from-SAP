<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
define("EW_DEFAULT_LOCALE", "es_ES", TRUE);
@setlocale(LC_ALL, EW_DEFAULT_LOCALE);
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "ircioinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$ircio_list = new circio_list();
$Page =& $ircio_list;

// Page init
$ircio_list->Page_Init();

// Page main
$ircio_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($ircio->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var ircio_list = new ew_Page("ircio_list");

// page properties
ircio_list.PageID = "list"; // page ID
ircio_list.FormID = "firciolist"; // form ID
var EW_PAGE_ID = ircio_list.PageID; // for backward compatibility

// extend page with ValidateForm function
ircio_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
ircio_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
ircio_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
ircio_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($ircio->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$ircio_list->lTotalRecs = $ircio->SelectRecordCount();
	} else {
		if ($rs = $ircio_list->LoadRecordset())
			$ircio_list->lTotalRecs = $rs->RecordCount();
	}
	$ircio_list->lStartRec = 1;
	if ($ircio_list->lDisplayRecs <= 0 || ($ircio->Export <> "" && $ircio->ExportAll)) // Display all records
		$ircio_list->lDisplayRecs = $ircio_list->lTotalRecs;
	if (!($ircio->Export <> "" && $ircio->ExportAll))
		$ircio_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $ircio_list->LoadRecordset($ircio_list->lStartRec-1, $ircio_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $ircio->TableCaption() ?>
<?php if ($ircio->Export == "" && $ircio->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $ircio_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $ircio_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $ircio_list->ExportWordUrl ?>"><?php echo $Language->Phrase("ExportToWord") ?></a>
<?php } ?>
</span></p>
<?php if ($ircio->Export == "" && $ircio->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(ircio_list);" style="text-decoration: none;"><img id="ircio_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="ircio_list_SearchPanel">
<form name="firciolistsrch" id="firciolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="ircio">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $ircio_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="irciosrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$ircio_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($ircio->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($ircio->CurrentAction <> "gridadd" && $ircio->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($ircio_list->Pager)) $ircio_list->Pager = new cPrevNextPager($ircio_list->lStartRec, $ircio_list->lDisplayRecs, $ircio_list->lTotalRecs) ?>
<?php if ($ircio_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($ircio_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $ircio_list->PageUrl() ?>start=<?php echo $ircio_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($ircio_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $ircio_list->PageUrl() ?>start=<?php echo $ircio_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $ircio_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($ircio_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $ircio_list->PageUrl() ?>start=<?php echo $ircio_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($ircio_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $ircio_list->PageUrl() ?>start=<?php echo $ircio_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ircio_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ircio_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ircio_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ircio_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($ircio_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($ircio->CurrentAction <> "gridadd" && $ircio->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<a href="<?php echo $ircio_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($ircio_list->lTotalRecs > 0) { ?>
<a href="<?php echo $ircio_list->GridEditUrl ?>"><?php echo $Language->Phrase("GridEditLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($ircio->CurrentAction == "gridedit") { ?>
<a href="" onclick="f=document.firciolist;if(ircio_list.ValidateForm(f))f.submit();return false;"><?php echo $Language->Phrase("GridSaveLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $ircio_list->PageUrl() ?>a=cancel"><?php echo $Language->Phrase("GridCancelLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="firciolist" id="firciolist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="ircio">
<div id="gmp_ircio" class="ewGridMiddlePanel">
<?php if ($ircio_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $ircio->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$ircio_list->RenderListOptions();

// Render list options (header, left)
$ircio_list->ListOptions->Render("header", "left");
?>
<?php if ($ircio->cabecera->Visible) { // cabecera ?>
	<?php if ($ircio->SortUrl($ircio->cabecera) == "") { ?>
		<td><?php echo $ircio->cabecera->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->cabecera) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->cabecera->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->cabecera->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->cabecera->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->orden->Visible) { // orden ?>
	<?php if ($ircio->SortUrl($ircio->orden) == "") { ?>
		<td><?php echo $ircio->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->orden->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->orden->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->op->Visible) { // op ?>
	<?php if ($ircio->SortUrl($ircio->op) == "") { ?>
		<td><?php echo $ircio->op->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->op) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->op->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->op->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->op->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->puesto->Visible) { // puesto ?>
	<?php if ($ircio->SortUrl($ircio->puesto) == "") { ?>
		<td><?php echo $ircio->puesto->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->puesto) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->puesto->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->puesto->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->puesto->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->contrato->Visible) { // contrato ?>
	<?php if ($ircio->SortUrl($ircio->contrato) == "") { ?>
		<td><?php echo $ircio->contrato->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->contrato) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->contrato->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->contrato->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->contrato->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->fechacrea->Visible) { // fechacrea ?>
	<?php if ($ircio->SortUrl($ircio->fechacrea) == "") { ?>
		<td><?php echo $ircio->fechacrea->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->fechacrea) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->fechacrea->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->fechacrea->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->fechacrea->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->horacrea->Visible) { // horacrea ?>
	<?php if ($ircio->SortUrl($ircio->horacrea) == "") { ?>
		<td><?php echo $ircio->horacrea->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->horacrea) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->horacrea->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->horacrea->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->horacrea->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->fechafin->Visible) { // fechafin ?>
	<?php if ($ircio->SortUrl($ircio->fechafin) == "") { ?>
		<td><?php echo $ircio->fechafin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->fechafin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->fechafin->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->fechafin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->fechafin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->horafin->Visible) { // horafin ?>
	<?php if ($ircio->SortUrl($ircio->horafin) == "") { ?>
		<td><?php echo $ircio->horafin->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->horafin) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->horafin->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->horafin->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->horafin->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($ircio->material->Visible) { // material ?>
	<?php if ($ircio->SortUrl($ircio->material) == "") { ?>
		<td><?php echo $ircio->material->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $ircio->SortUrl($ircio->material) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $ircio->material->FldCaption() ?></td><td style="width: 10px;"><?php if ($ircio->material->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($ircio->material->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$ircio_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($ircio->ExportAll && $ircio->Export <> "") {
	$ircio_list->lStopRec = $ircio_list->lTotalRecs;
} else {
	$ircio_list->lStopRec = $ircio_list->lStartRec + $ircio_list->lDisplayRecs - 1; // Set the last record to display
}
$ircio_list->lRecCount = $ircio_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $ircio_list->lStartRec > 1)
		$rs->Move($ircio_list->lStartRec - 1);
}

// Initialize aggregate
$ircio->RowType = EW_ROWTYPE_AGGREGATEINIT;
$ircio_list->RenderRow();
$ircio_list->lRowCnt = 0;
$ircio_list->lEditRowCnt = 0;
if ($ircio->CurrentAction == "edit")
	$ircio_list->lRowIndex = 1;
if ($ircio->CurrentAction == "gridedit")
	$ircio_list->lRowIndex = 0;
while (($ircio->CurrentAction == "gridadd" || !$rs->EOF) &&
	$ircio_list->lRecCount < $ircio_list->lStopRec) {
	$ircio_list->lRecCount++;
	if (intval($ircio_list->lRecCount) >= intval($ircio_list->lStartRec)) {
		$ircio_list->lRowCnt++;
		if ($ircio->CurrentAction == "gridadd" || $ircio->CurrentAction == "gridedit")
			$ircio_list->lRowIndex++;

	// Init row class and style
	$ircio->CssClass = "";
	$ircio->CssStyle = "";
	$ircio->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($ircio->CurrentAction == "gridadd") {
		$ircio_list->LoadDefaultValues(); // Load default values
	} else {
		$ircio_list->LoadRowValues($rs); // Load row values
	}
	$ircio->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($ircio->CurrentAction == "edit") {
		if ($ircio_list->CheckInlineEditKey() && $ircio_list->lEditRowCnt == 0) { // Inline edit
			$ircio->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($ircio->CurrentAction == "gridedit") { // Grid edit
		$ircio->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($ircio->RowType == EW_ROWTYPE_EDIT && $ircio->EventCancelled) { // Update failed
		if ($ircio->CurrentAction == "edit")
			$ircio_list->RestoreFormValues(); // Restore form values
		if ($ircio->CurrentAction == "gridedit")
			$ircio_list->RestoreCurrentRowFormValues($ircio_list->lRowIndex); // Restore form values
	}
	if ($ircio->RowType == EW_ROWTYPE_EDIT) // Edit row
		$ircio_list->lEditRowCnt++;
	if ($ircio->RowType == EW_ROWTYPE_ADD || $ircio->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$ircio->RowAttrs = array_merge($ircio->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$ircio->CssClass = "ewTableEditRow";
	}

	// Render row
	$ircio_list->RenderRow();

	// Render list options
	$ircio_list->RenderListOptions();
?>
	<tr<?php echo $ircio->RowAttributes() ?>>
<?php

// Render list options (body, left)
$ircio_list->ListOptions->Render("body", "left");
?>
	<?php if ($ircio->cabecera->Visible) { // cabecera ?>
		<td<?php echo $ircio->cabecera->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ircio_list->lRowIndex ?>_cabecera" id="x<?php echo $ircio_list->lRowIndex ?>_cabecera" title="<?php echo $ircio->cabecera->FldTitle() ?>" size="30" maxlength="200" value="<?php echo $ircio->cabecera->EditValue ?>"<?php echo $ircio->cabecera->EditAttributes() ?>>
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->cabecera->ViewAttributes() ?>><?php echo $ircio->cabecera->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->orden->Visible) { // orden ?>
		<td<?php echo $ircio->orden->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $ircio->orden->ViewAttributes() ?>><?php echo $ircio->orden->EditValue ?></div><input type="hidden" name="x<?php echo $ircio_list->lRowIndex ?>_orden" id="x<?php echo $ircio_list->lRowIndex ?>_orden" value="<?php echo ew_HtmlEncode($ircio->orden->CurrentValue) ?>">
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->orden->ViewAttributes() ?>><?php echo $ircio->orden->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->op->Visible) { // op ?>
		<td<?php echo $ircio->op->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $ircio->op->ViewAttributes() ?>><?php echo $ircio->op->EditValue ?></div><input type="hidden" name="x<?php echo $ircio_list->lRowIndex ?>_op" id="x<?php echo $ircio_list->lRowIndex ?>_op" value="<?php echo ew_HtmlEncode($ircio->op->CurrentValue) ?>">
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->op->ViewAttributes() ?>><?php echo $ircio->op->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->puesto->Visible) { // puesto ?>
		<td<?php echo $ircio->puesto->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ircio_list->lRowIndex ?>_puesto" id="x<?php echo $ircio_list->lRowIndex ?>_puesto" title="<?php echo $ircio->puesto->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->puesto->EditValue ?>"<?php echo $ircio->puesto->EditAttributes() ?>>
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->puesto->ViewAttributes() ?>><?php echo $ircio->puesto->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->contrato->Visible) { // contrato ?>
		<td<?php echo $ircio->contrato->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ircio_list->lRowIndex ?>_contrato" id="x<?php echo $ircio_list->lRowIndex ?>_contrato" title="<?php echo $ircio->contrato->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->contrato->EditValue ?>"<?php echo $ircio->contrato->EditAttributes() ?>>
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->contrato->ViewAttributes() ?>><?php echo $ircio->contrato->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->fechacrea->Visible) { // fechacrea ?>
		<td<?php echo $ircio->fechacrea->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ircio_list->lRowIndex ?>_fechacrea" id="x<?php echo $ircio_list->lRowIndex ?>_fechacrea" title="<?php echo $ircio->fechacrea->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->fechacrea->EditValue ?>"<?php echo $ircio->fechacrea->EditAttributes() ?>>
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->fechacrea->ViewAttributes() ?>><?php echo $ircio->fechacrea->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->horacrea->Visible) { // horacrea ?>
		<td<?php echo $ircio->horacrea->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ircio_list->lRowIndex ?>_horacrea" id="x<?php echo $ircio_list->lRowIndex ?>_horacrea" title="<?php echo $ircio->horacrea->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->horacrea->EditValue ?>"<?php echo $ircio->horacrea->EditAttributes() ?>>
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->horacrea->ViewAttributes() ?>><?php echo $ircio->horacrea->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->fechafin->Visible) { // fechafin ?>
		<td<?php echo $ircio->fechafin->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ircio_list->lRowIndex ?>_fechafin" id="x<?php echo $ircio_list->lRowIndex ?>_fechafin" title="<?php echo $ircio->fechafin->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->fechafin->EditValue ?>"<?php echo $ircio->fechafin->EditAttributes() ?>>
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->fechafin->ViewAttributes() ?>><?php echo $ircio->fechafin->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->horafin->Visible) { // horafin ?>
		<td<?php echo $ircio->horafin->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ircio_list->lRowIndex ?>_horafin" id="x<?php echo $ircio_list->lRowIndex ?>_horafin" title="<?php echo $ircio->horafin->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->horafin->EditValue ?>"<?php echo $ircio->horafin->EditAttributes() ?>>
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->horafin->ViewAttributes() ?>><?php echo $ircio->horafin->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ircio->material->Visible) { // material ?>
		<td<?php echo $ircio->material->CellAttributes() ?>>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $ircio_list->lRowIndex ?>_material" id="x<?php echo $ircio_list->lRowIndex ?>_material" title="<?php echo $ircio->material->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $ircio->material->EditValue ?>"<?php echo $ircio->material->EditAttributes() ?>>
<?php } ?>
<?php if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $ircio->material->ViewAttributes() ?>><?php echo $ircio->material->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ircio_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($ircio->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($ircio->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($ircio->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $ircio_list->lRowIndex ?>">
<?php } ?>
<?php if ($ircio->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $ircio_list->lRowIndex ?>">
<?php echo $ircio_list->sMultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</td></tr></table>
<?php if ($ircio->Export == "" && $ircio->CurrentAction == "") { ?>
<?php } ?>
<?php if ($ircio->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$ircio_list->Page_Terminate();
?>
<?php

//
// Page class
//
class circio_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'ircio';

	// Page object name
	var $PageObjName = 'ircio_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $ircio;
		if ($ircio->UseTokenInUrl) $PageUrl .= "t=" . $ircio->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $ircio;
		if ($ircio->UseTokenInUrl) {
			if ($objForm)
				return ($ircio->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($ircio->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function circio_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (ircio)
		$GLOBALS["ircio"] = new circio();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["ircio"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "irciodelete.php";
		$this->MultiUpdateUrl = "ircioupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'ircio', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $ircio;

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$ircio->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$ircio->Export = $_POST["exporttype"];
		} else {
			$ircio->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $ircio->Export; // Get export parameter, used in header
		$gsExportFile = $ircio->TableVar; // Get export file, used in header
		if (in_array($ircio->Export, array("html", "email", "excel", "word")))
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
		if ($ircio->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel;charset=utf-8');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($ircio->Export == "word") {
			header('Content-Type: application/vnd.ms-word;charset=utf-8');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.doc');
		}

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 50;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $ircio;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$ircio->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($ircio->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($ircio->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($ircio->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$ircio->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($ircio->CurrentAction == "gridupdate" || $ircio->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if (($ircio->CurrentAction == "update" || $ircio->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$ircio->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($ircio->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $ircio->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 50; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$ircio->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$ircio->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$ircio->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $ircio->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$ircio->setSessionWhere($sFilter);
		$ircio->CurrentFilter = "";

		// Export data only
		if (in_array($ircio->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($ircio->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $ircio;
		$ircio->setKey("orden", ""); // Clear inline edit key
		$ircio->setKey("op", ""); // Clear inline edit key
		$ircio->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $ircio;
		$bInlineEdit = TRUE;
		if (@$_GET["orden"] <> "") {
			$ircio->orden->setQueryStringValue($_GET["orden"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if (@$_GET["op"] <> "") {
			$ircio->op->setQueryStringValue($_GET["op"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$ircio->setKey("orden", $ircio->orden->CurrentValue); // Set up inline edit key
				$ircio->setKey("op", $ircio->op->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $ircio;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$ircio->SendEmail = TRUE; // Send email on update success
				$bInlineUpdate = $this->EditRow(); // Update record
			} else {
				$bInlineUpdate = FALSE;
			}
		}
		if ($bInlineUpdate) { // Update success
			$this->setMessage($Language->Phrase("UpdateSuccess")); // Set success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getMessage() == "")
				$this->setMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$ircio->EventCancelled = TRUE; // Cancel event
			$ircio->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $ircio;

		//CheckInlineEditKey = True
		if (strval($ircio->getKey("orden")) <> strval($ircio->orden->CurrentValue))
			return FALSE;
		if (strval($ircio->getKey("op")) <> strval($ircio->op->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $ircio;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$ircio->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $ircio->SQL();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));

		// Update all rows based on key
		while ($sThisKey <> "") {

			// Load all values and keys
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$bGridUpdate = FALSE; // Form error, reset action
				$this->setMessage($gsFormError);
			} else {
				if ($this->SetupKeyValues($sThisKey)) { // Set up key values
					$ircio->SendEmail = FALSE; // Do not send email on update success
					$bGridUpdate = $this->EditRow(); // Update this row
				} else {
					$bGridUpdate = FALSE; // update failed
				}
			}
			if ($bGridUpdate) {
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			} else {
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		if ($bGridUpdate) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}
			$this->setMessage($Language->Phrase("UpdateSuccess")); // Set update success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getMessage() == "")
				$this->setMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$ircio->EventCancelled = TRUE; // Set event cancelled
			$ircio->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $ircio;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $ircio->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		global $ircio;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 2) {
			$ircio->orden->setFormValue($arrKeyFlds[0]);
			$ircio->op->setFormValue($arrKeyFlds[1]);
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $ircio;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($ircio->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($ircio->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 2) {
				if (strval($arrKeyFlds[0]) == strval($ircio->orden->CurrentValue) && 
				strval($arrKeyFlds[1]) == strval($ircio->op->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $ircio;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $ircio->cabecera, FALSE); // cabecera
		$this->BuildSearchSql($sWhere, $ircio->orden, FALSE); // orden
		$this->BuildSearchSql($sWhere, $ircio->op, FALSE); // op
		$this->BuildSearchSql($sWhere, $ircio->puesto, FALSE); // puesto
		$this->BuildSearchSql($sWhere, $ircio->contrato, FALSE); // contrato
		$this->BuildSearchSql($sWhere, $ircio->fechacrea, FALSE); // fechacrea
		$this->BuildSearchSql($sWhere, $ircio->horacrea, FALSE); // horacrea
		$this->BuildSearchSql($sWhere, $ircio->fechafin, FALSE); // fechafin
		$this->BuildSearchSql($sWhere, $ircio->horafin, FALSE); // horafin
		$this->BuildSearchSql($sWhere, $ircio->material, FALSE); // material

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($ircio->cabecera); // cabecera
			$this->SetSearchParm($ircio->orden); // orden
			$this->SetSearchParm($ircio->op); // op
			$this->SetSearchParm($ircio->puesto); // puesto
			$this->SetSearchParm($ircio->contrato); // contrato
			$this->SetSearchParm($ircio->fechacrea); // fechacrea
			$this->SetSearchParm($ircio->horacrea); // horacrea
			$this->SetSearchParm($ircio->fechafin); // fechafin
			$this->SetSearchParm($ircio->horafin); // horafin
			$this->SetSearchParm($ircio->material); // material
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $ircio;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$ircio->setAdvancedSearch("x_$FldParm", $FldVal);
		$ircio->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$ircio->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$ircio->setAdvancedSearch("y_$FldParm", $FldVal2);
		$ircio->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $ircio;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $ircio->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $ircio->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $ircio->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $ircio->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $ircio->GetAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $ircio;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$ircio->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $ircio;
		$ircio->setAdvancedSearch("x_cabecera", "");
		$ircio->setAdvancedSearch("z_cabecera", "");
		$ircio->setAdvancedSearch("y_cabecera", "");
		$ircio->setAdvancedSearch("x_orden", "");
		$ircio->setAdvancedSearch("z_orden", "");
		$ircio->setAdvancedSearch("y_orden", "");
		$ircio->setAdvancedSearch("x_op", "");
		$ircio->setAdvancedSearch("z_op", "");
		$ircio->setAdvancedSearch("y_op", "");
		$ircio->setAdvancedSearch("x_puesto", "");
		$ircio->setAdvancedSearch("z_puesto", "");
		$ircio->setAdvancedSearch("y_puesto", "");
		$ircio->setAdvancedSearch("x_contrato", "");
		$ircio->setAdvancedSearch("z_contrato", "");
		$ircio->setAdvancedSearch("y_contrato", "");
		$ircio->setAdvancedSearch("x_fechacrea", "");
		$ircio->setAdvancedSearch("z_fechacrea", "");
		$ircio->setAdvancedSearch("y_fechacrea", "");
		$ircio->setAdvancedSearch("x_horacrea", "");
		$ircio->setAdvancedSearch("z_horacrea", "");
		$ircio->setAdvancedSearch("y_horacrea", "");
		$ircio->setAdvancedSearch("x_fechafin", "");
		$ircio->setAdvancedSearch("z_fechafin", "");
		$ircio->setAdvancedSearch("y_fechafin", "");
		$ircio->setAdvancedSearch("x_horafin", "");
		$ircio->setAdvancedSearch("z_horafin", "");
		$ircio->setAdvancedSearch("y_horafin", "");
		$ircio->setAdvancedSearch("x_material", "");
		$ircio->setAdvancedSearch("z_material", "");
		$ircio->setAdvancedSearch("y_material", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $ircio;
		$bRestore = TRUE;
		if (@$_GET["x_cabecera"] <> "") $bRestore = FALSE;
		if (@$_GET["y_cabecera"] <> "") $bRestore = FALSE;
		if (@$_GET["x_orden"] <> "") $bRestore = FALSE;
		if (@$_GET["y_orden"] <> "") $bRestore = FALSE;
		if (@$_GET["x_op"] <> "") $bRestore = FALSE;
		if (@$_GET["y_op"] <> "") $bRestore = FALSE;
		if (@$_GET["x_puesto"] <> "") $bRestore = FALSE;
		if (@$_GET["y_puesto"] <> "") $bRestore = FALSE;
		if (@$_GET["x_contrato"] <> "") $bRestore = FALSE;
		if (@$_GET["y_contrato"] <> "") $bRestore = FALSE;
		if (@$_GET["x_fechacrea"] <> "") $bRestore = FALSE;
		if (@$_GET["y_fechacrea"] <> "") $bRestore = FALSE;
		if (@$_GET["x_horacrea"] <> "") $bRestore = FALSE;
		if (@$_GET["y_horacrea"] <> "") $bRestore = FALSE;
		if (@$_GET["x_fechafin"] <> "") $bRestore = FALSE;
		if (@$_GET["y_fechafin"] <> "") $bRestore = FALSE;
		if (@$_GET["x_horafin"] <> "") $bRestore = FALSE;
		if (@$_GET["y_horafin"] <> "") $bRestore = FALSE;
		if (@$_GET["x_material"] <> "") $bRestore = FALSE;
		if (@$_GET["y_material"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($ircio->cabecera);
			$this->GetSearchParm($ircio->orden);
			$this->GetSearchParm($ircio->op);
			$this->GetSearchParm($ircio->puesto);
			$this->GetSearchParm($ircio->contrato);
			$this->GetSearchParm($ircio->fechacrea);
			$this->GetSearchParm($ircio->horacrea);
			$this->GetSearchParm($ircio->fechafin);
			$this->GetSearchParm($ircio->horafin);
			$this->GetSearchParm($ircio->material);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $ircio;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$ircio->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$ircio->CurrentOrderType = @$_GET["ordertype"];
			$ircio->UpdateSort($ircio->cabecera); // cabecera
			$ircio->UpdateSort($ircio->orden); // orden
			$ircio->UpdateSort($ircio->op); // op
			$ircio->UpdateSort($ircio->puesto); // puesto
			$ircio->UpdateSort($ircio->contrato); // contrato
			$ircio->UpdateSort($ircio->fechacrea); // fechacrea
			$ircio->UpdateSort($ircio->horacrea); // horacrea
			$ircio->UpdateSort($ircio->fechafin); // fechafin
			$ircio->UpdateSort($ircio->horafin); // horafin
			$ircio->UpdateSort($ircio->material); // material
			$ircio->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $ircio;
		$sOrderBy = $ircio->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($ircio->SqlOrderBy() <> "") {
				$sOrderBy = $ircio->SqlOrderBy();
				$ircio->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $ircio;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$ircio->setSessionOrderBy($sOrderBy);
				$ircio->cabecera->setSort("");
				$ircio->orden->setSort("");
				$ircio->op->setSort("");
				$ircio->puesto->setSort("");
				$ircio->contrato->setSort("");
				$ircio->fechacrea->setSort("");
				$ircio->horacrea->setSort("");
				$ircio->fechafin->setSort("");
				$ircio->horafin->setSort("");
				$ircio->material->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$ircio->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $ircio;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($ircio->Export <> "" ||
			$ircio->CurrentAction == "gridadd" ||
			$ircio->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $ircio;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($ircio->CurrentAction == "edit" && $ircio->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.firciolist;if(ircio_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			return;
		}

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<span class=\"ewSeparator\">&nbsp;|&nbsp;</span>";
			$oListOpt->Body .= "<a class=\"ewInlineLink\" href=\"" . $this->InlineEditUrl . "#" . $this->PageObjName . "_row_" . $this->lRowCnt . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		if ($ircio->CurrentAction == "gridedit")
			$this->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->lRowIndex . "_key\" id=\"k" . $this->lRowIndex . "_key\" value=\"" . $ircio->orden->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $ircio->op->CurrentValue . "\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $ircio;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $ircio;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$ircio->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$ircio->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $ircio->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$ircio->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$ircio->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$ircio->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $ircio;

		// Load search values
		// cabecera

		$ircio->cabecera->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_cabecera"]);
		$ircio->cabecera->AdvancedSearch->SearchOperator = @$_GET["z_cabecera"];
		$ircio->cabecera->AdvancedSearch->SearchCondition = @$_GET["v_cabecera"];
		$ircio->cabecera->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_cabecera"]);
		$ircio->cabecera->AdvancedSearch->SearchOperator2 = @$_GET["w_cabecera"];

		// orden
		$ircio->orden->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_orden"]);
		$ircio->orden->AdvancedSearch->SearchOperator = @$_GET["z_orden"];
		$ircio->orden->AdvancedSearch->SearchCondition = @$_GET["v_orden"];
		$ircio->orden->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_orden"]);
		$ircio->orden->AdvancedSearch->SearchOperator2 = @$_GET["w_orden"];

		// op
		$ircio->op->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_op"]);
		$ircio->op->AdvancedSearch->SearchOperator = @$_GET["z_op"];
		$ircio->op->AdvancedSearch->SearchCondition = @$_GET["v_op"];
		$ircio->op->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_op"]);
		$ircio->op->AdvancedSearch->SearchOperator2 = @$_GET["w_op"];

		// puesto
		$ircio->puesto->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_puesto"]);
		$ircio->puesto->AdvancedSearch->SearchOperator = @$_GET["z_puesto"];
		$ircio->puesto->AdvancedSearch->SearchCondition = @$_GET["v_puesto"];
		$ircio->puesto->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_puesto"]);
		$ircio->puesto->AdvancedSearch->SearchOperator2 = @$_GET["w_puesto"];

		// contrato
		$ircio->contrato->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_contrato"]);
		$ircio->contrato->AdvancedSearch->SearchOperator = @$_GET["z_contrato"];
		$ircio->contrato->AdvancedSearch->SearchCondition = @$_GET["v_contrato"];
		$ircio->contrato->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_contrato"]);
		$ircio->contrato->AdvancedSearch->SearchOperator2 = @$_GET["w_contrato"];

		// fechacrea
		$ircio->fechacrea->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_fechacrea"]);
		$ircio->fechacrea->AdvancedSearch->SearchOperator = @$_GET["z_fechacrea"];
		$ircio->fechacrea->AdvancedSearch->SearchCondition = @$_GET["v_fechacrea"];
		$ircio->fechacrea->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_fechacrea"]);
		$ircio->fechacrea->AdvancedSearch->SearchOperator2 = @$_GET["w_fechacrea"];

		// horacrea
		$ircio->horacrea->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_horacrea"]);
		$ircio->horacrea->AdvancedSearch->SearchOperator = @$_GET["z_horacrea"];
		$ircio->horacrea->AdvancedSearch->SearchCondition = @$_GET["v_horacrea"];
		$ircio->horacrea->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_horacrea"]);
		$ircio->horacrea->AdvancedSearch->SearchOperator2 = @$_GET["w_horacrea"];

		// fechafin
		$ircio->fechafin->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_fechafin"]);
		$ircio->fechafin->AdvancedSearch->SearchOperator = @$_GET["z_fechafin"];
		$ircio->fechafin->AdvancedSearch->SearchCondition = @$_GET["v_fechafin"];
		$ircio->fechafin->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_fechafin"]);
		$ircio->fechafin->AdvancedSearch->SearchOperator2 = @$_GET["w_fechafin"];

		// horafin
		$ircio->horafin->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_horafin"]);
		$ircio->horafin->AdvancedSearch->SearchOperator = @$_GET["z_horafin"];
		$ircio->horafin->AdvancedSearch->SearchCondition = @$_GET["v_horafin"];
		$ircio->horafin->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_horafin"]);
		$ircio->horafin->AdvancedSearch->SearchOperator2 = @$_GET["w_horafin"];

		// material
		$ircio->material->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_material"]);
		$ircio->material->AdvancedSearch->SearchOperator = @$_GET["z_material"];
		$ircio->material->AdvancedSearch->SearchCondition = @$_GET["v_material"];
		$ircio->material->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_material"]);
		$ircio->material->AdvancedSearch->SearchOperator2 = @$_GET["w_material"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $ircio;
		$ircio->cabecera->setFormValue($objForm->GetValue("x_cabecera"));
		$ircio->orden->setFormValue($objForm->GetValue("x_orden"));
		$ircio->op->setFormValue($objForm->GetValue("x_op"));
		$ircio->puesto->setFormValue($objForm->GetValue("x_puesto"));
		$ircio->contrato->setFormValue($objForm->GetValue("x_contrato"));
		$ircio->fechacrea->setFormValue($objForm->GetValue("x_fechacrea"));
		$ircio->horacrea->setFormValue($objForm->GetValue("x_horacrea"));
		$ircio->fechafin->setFormValue($objForm->GetValue("x_fechafin"));
		$ircio->horafin->setFormValue($objForm->GetValue("x_horafin"));
		$ircio->material->setFormValue($objForm->GetValue("x_material"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $ircio;
		$ircio->cabecera->CurrentValue = $ircio->cabecera->FormValue;
		$ircio->orden->CurrentValue = $ircio->orden->FormValue;
		$ircio->op->CurrentValue = $ircio->op->FormValue;
		$ircio->puesto->CurrentValue = $ircio->puesto->FormValue;
		$ircio->contrato->CurrentValue = $ircio->contrato->FormValue;
		$ircio->fechacrea->CurrentValue = $ircio->fechacrea->FormValue;
		$ircio->horacrea->CurrentValue = $ircio->horacrea->FormValue;
		$ircio->fechafin->CurrentValue = $ircio->fechafin->FormValue;
		$ircio->horafin->CurrentValue = $ircio->horafin->FormValue;
		$ircio->material->CurrentValue = $ircio->material->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $ircio;

		// Call Recordset Selecting event
		$ircio->Recordset_Selecting($ircio->CurrentFilter);

		// Load List page SQL
		$sSql = $ircio->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$ircio->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $ircio;
		$sFilter = $ircio->KeyFilter();

		// Call Row Selecting event
		$ircio->Row_Selecting($sFilter);

		// Load SQL based on filter
		$ircio->CurrentFilter = $sFilter;
		$sSql = $ircio->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$ircio->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $ircio;
		$ircio->cabecera->setDbValue($rs->fields('cabecera'));
		$ircio->orden->setDbValue($rs->fields('orden'));
		$ircio->op->setDbValue($rs->fields('op'));
		$ircio->puesto->setDbValue($rs->fields('puesto'));
		$ircio->contrato->setDbValue($rs->fields('contrato'));
		$ircio->fechacrea->setDbValue($rs->fields('fechacrea'));
		$ircio->horacrea->setDbValue($rs->fields('horacrea'));
		$ircio->fechafin->setDbValue($rs->fields('fechafin'));
		$ircio->horafin->setDbValue($rs->fields('horafin'));
		$ircio->material->setDbValue($rs->fields('material'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $ircio;

		// Initialize URLs
		$this->ViewUrl = $ircio->ViewUrl();
		$this->EditUrl = $ircio->EditUrl();
		$this->InlineEditUrl = $ircio->InlineEditUrl();
		$this->CopyUrl = $ircio->CopyUrl();
		$this->InlineCopyUrl = $ircio->InlineCopyUrl();
		$this->DeleteUrl = $ircio->DeleteUrl();

		// Call Row_Rendering event
		$ircio->Row_Rendering();

		// Common render codes for all row types
		// cabecera

		$ircio->cabecera->CellCssStyle = ""; $ircio->cabecera->CellCssClass = "";
		$ircio->cabecera->CellAttrs = array(); $ircio->cabecera->ViewAttrs = array(); $ircio->cabecera->EditAttrs = array();

		// orden
		$ircio->orden->CellCssStyle = ""; $ircio->orden->CellCssClass = "";
		$ircio->orden->CellAttrs = array(); $ircio->orden->ViewAttrs = array(); $ircio->orden->EditAttrs = array();

		// op
		$ircio->op->CellCssStyle = ""; $ircio->op->CellCssClass = "";
		$ircio->op->CellAttrs = array(); $ircio->op->ViewAttrs = array(); $ircio->op->EditAttrs = array();

		// puesto
		$ircio->puesto->CellCssStyle = ""; $ircio->puesto->CellCssClass = "";
		$ircio->puesto->CellAttrs = array(); $ircio->puesto->ViewAttrs = array(); $ircio->puesto->EditAttrs = array();

		// contrato
		$ircio->contrato->CellCssStyle = ""; $ircio->contrato->CellCssClass = "";
		$ircio->contrato->CellAttrs = array(); $ircio->contrato->ViewAttrs = array(); $ircio->contrato->EditAttrs = array();

		// fechacrea
		$ircio->fechacrea->CellCssStyle = ""; $ircio->fechacrea->CellCssClass = "";
		$ircio->fechacrea->CellAttrs = array(); $ircio->fechacrea->ViewAttrs = array(); $ircio->fechacrea->EditAttrs = array();

		// horacrea
		$ircio->horacrea->CellCssStyle = ""; $ircio->horacrea->CellCssClass = "";
		$ircio->horacrea->CellAttrs = array(); $ircio->horacrea->ViewAttrs = array(); $ircio->horacrea->EditAttrs = array();

		// fechafin
		$ircio->fechafin->CellCssStyle = ""; $ircio->fechafin->CellCssClass = "";
		$ircio->fechafin->CellAttrs = array(); $ircio->fechafin->ViewAttrs = array(); $ircio->fechafin->EditAttrs = array();

		// horafin
		$ircio->horafin->CellCssStyle = ""; $ircio->horafin->CellCssClass = "";
		$ircio->horafin->CellAttrs = array(); $ircio->horafin->ViewAttrs = array(); $ircio->horafin->EditAttrs = array();

		// material
		$ircio->material->CellCssStyle = ""; $ircio->material->CellCssClass = "";
		$ircio->material->CellAttrs = array(); $ircio->material->ViewAttrs = array(); $ircio->material->EditAttrs = array();
		if ($ircio->RowType == EW_ROWTYPE_VIEW) { // View row

			// cabecera
			$ircio->cabecera->ViewValue = $ircio->cabecera->CurrentValue;
			$ircio->cabecera->CssStyle = "";
			$ircio->cabecera->CssClass = "";
			$ircio->cabecera->ViewCustomAttributes = "";

			// orden
			$ircio->orden->ViewValue = $ircio->orden->CurrentValue;
			$ircio->orden->CssStyle = "";
			$ircio->orden->CssClass = "";
			$ircio->orden->ViewCustomAttributes = "";

			// op
			$ircio->op->ViewValue = $ircio->op->CurrentValue;
			$ircio->op->CssStyle = "";
			$ircio->op->CssClass = "";
			$ircio->op->ViewCustomAttributes = "";

			// puesto
			$ircio->puesto->ViewValue = $ircio->puesto->CurrentValue;
			$ircio->puesto->CssStyle = "";
			$ircio->puesto->CssClass = "";
			$ircio->puesto->ViewCustomAttributes = "";

			// contrato
			$ircio->contrato->ViewValue = $ircio->contrato->CurrentValue;
			$ircio->contrato->CssStyle = "";
			$ircio->contrato->CssClass = "";
			$ircio->contrato->ViewCustomAttributes = "";

			// fechacrea
			$ircio->fechacrea->ViewValue = $ircio->fechacrea->CurrentValue;
			$ircio->fechacrea->CssStyle = "";
			$ircio->fechacrea->CssClass = "";
			$ircio->fechacrea->ViewCustomAttributes = "";

			// horacrea
			$ircio->horacrea->ViewValue = $ircio->horacrea->CurrentValue;
			$ircio->horacrea->CssStyle = "";
			$ircio->horacrea->CssClass = "";
			$ircio->horacrea->ViewCustomAttributes = "";

			// fechafin
			$ircio->fechafin->ViewValue = $ircio->fechafin->CurrentValue;
			$ircio->fechafin->CssStyle = "";
			$ircio->fechafin->CssClass = "";
			$ircio->fechafin->ViewCustomAttributes = "";

			// horafin
			$ircio->horafin->ViewValue = $ircio->horafin->CurrentValue;
			$ircio->horafin->CssStyle = "";
			$ircio->horafin->CssClass = "";
			$ircio->horafin->ViewCustomAttributes = "";

			// material
			$ircio->material->ViewValue = $ircio->material->CurrentValue;
			$ircio->material->CssStyle = "";
			$ircio->material->CssClass = "";
			$ircio->material->ViewCustomAttributes = "";

			// cabecera
			$ircio->cabecera->HrefValue = "";
			$ircio->cabecera->TooltipValue = "";

			// orden
			$ircio->orden->HrefValue = "";
			$ircio->orden->TooltipValue = "";

			// op
			$ircio->op->HrefValue = "";
			$ircio->op->TooltipValue = "";

			// puesto
			$ircio->puesto->HrefValue = "";
			$ircio->puesto->TooltipValue = "";

			// contrato
			$ircio->contrato->HrefValue = "";
			$ircio->contrato->TooltipValue = "";

			// fechacrea
			$ircio->fechacrea->HrefValue = "";
			$ircio->fechacrea->TooltipValue = "";

			// horacrea
			$ircio->horacrea->HrefValue = "";
			$ircio->horacrea->TooltipValue = "";

			// fechafin
			$ircio->fechafin->HrefValue = "";
			$ircio->fechafin->TooltipValue = "";

			// horafin
			$ircio->horafin->HrefValue = "";
			$ircio->horafin->TooltipValue = "";

			// material
			$ircio->material->HrefValue = "";
			$ircio->material->TooltipValue = "";
		} elseif ($ircio->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// cabecera
			$ircio->cabecera->EditCustomAttributes = "";
			$ircio->cabecera->EditValue = ew_HtmlEncode($ircio->cabecera->CurrentValue);

			// orden
			$ircio->orden->EditCustomAttributes = "";
			$ircio->orden->EditValue = $ircio->orden->CurrentValue;
			$ircio->orden->CssStyle = "";
			$ircio->orden->CssClass = "";
			$ircio->orden->ViewCustomAttributes = "";

			// op
			$ircio->op->EditCustomAttributes = "";
			$ircio->op->EditValue = $ircio->op->CurrentValue;
			$ircio->op->CssStyle = "";
			$ircio->op->CssClass = "";
			$ircio->op->ViewCustomAttributes = "";

			// puesto
			$ircio->puesto->EditCustomAttributes = "";
			$ircio->puesto->EditValue = ew_HtmlEncode($ircio->puesto->CurrentValue);

			// contrato
			$ircio->contrato->EditCustomAttributes = "";
			$ircio->contrato->EditValue = ew_HtmlEncode($ircio->contrato->CurrentValue);

			// fechacrea
			$ircio->fechacrea->EditCustomAttributes = "";
			$ircio->fechacrea->EditValue = ew_HtmlEncode($ircio->fechacrea->CurrentValue);

			// horacrea
			$ircio->horacrea->EditCustomAttributes = "";
			$ircio->horacrea->EditValue = ew_HtmlEncode($ircio->horacrea->CurrentValue);

			// fechafin
			$ircio->fechafin->EditCustomAttributes = "";
			$ircio->fechafin->EditValue = ew_HtmlEncode($ircio->fechafin->CurrentValue);

			// horafin
			$ircio->horafin->EditCustomAttributes = "";
			$ircio->horafin->EditValue = ew_HtmlEncode($ircio->horafin->CurrentValue);

			// material
			$ircio->material->EditCustomAttributes = "";
			$ircio->material->EditValue = ew_HtmlEncode($ircio->material->CurrentValue);

			// Edit refer script
			// cabecera

			$ircio->cabecera->HrefValue = "";

			// orden
			$ircio->orden->HrefValue = "";

			// op
			$ircio->op->HrefValue = "";

			// puesto
			$ircio->puesto->HrefValue = "";

			// contrato
			$ircio->contrato->HrefValue = "";

			// fechacrea
			$ircio->fechacrea->HrefValue = "";

			// horacrea
			$ircio->horacrea->HrefValue = "";

			// fechafin
			$ircio->fechafin->HrefValue = "";

			// horafin
			$ircio->horafin->HrefValue = "";

			// material
			$ircio->material->HrefValue = "";
		}

		// Call Row Rendered event
		if ($ircio->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$ircio->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $ircio;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $ircio;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $ircio;
		$sFilter = $ircio->KeyFilter();
		$ircio->CurrentFilter = $sFilter;
		$sSql = $ircio->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// cabecera
			$ircio->cabecera->SetDbValueDef($rsnew, $ircio->cabecera->CurrentValue, NULL, FALSE);

			// orden
			// op
			// puesto

			$ircio->puesto->SetDbValueDef($rsnew, $ircio->puesto->CurrentValue, NULL, FALSE);

			// contrato
			$ircio->contrato->SetDbValueDef($rsnew, $ircio->contrato->CurrentValue, NULL, FALSE);

			// fechacrea
			$ircio->fechacrea->SetDbValueDef($rsnew, $ircio->fechacrea->CurrentValue, NULL, FALSE);

			// horacrea
			$ircio->horacrea->SetDbValueDef($rsnew, $ircio->horacrea->CurrentValue, NULL, FALSE);

			// fechafin
			$ircio->fechafin->SetDbValueDef($rsnew, $ircio->fechafin->CurrentValue, NULL, FALSE);

			// horafin
			$ircio->horafin->SetDbValueDef($rsnew, $ircio->horafin->CurrentValue, NULL, FALSE);

			// material
			$ircio->material->SetDbValueDef($rsnew, $ircio->material->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $ircio->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($ircio->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($ircio->CancelMessage <> "") {
					$this->setMessage($ircio->CancelMessage);
					$ircio->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$ircio->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $ircio;
		$ircio->cabecera->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_cabecera");
		$ircio->cabecera->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_cabecera");
		$ircio->cabecera->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_cabecera");
		$ircio->orden->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_orden");
		$ircio->orden->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_orden");
		$ircio->orden->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_orden");
		$ircio->op->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_op");
		$ircio->op->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_op");
		$ircio->op->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_op");
		$ircio->puesto->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_puesto");
		$ircio->puesto->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_puesto");
		$ircio->puesto->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_puesto");
		$ircio->contrato->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_contrato");
		$ircio->contrato->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_contrato");
		$ircio->contrato->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_contrato");
		$ircio->fechacrea->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_fechacrea");
		$ircio->fechacrea->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_fechacrea");
		$ircio->fechacrea->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_fechacrea");
		$ircio->horacrea->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_horacrea");
		$ircio->horacrea->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_horacrea");
		$ircio->horacrea->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_horacrea");
		$ircio->fechafin->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_fechafin");
		$ircio->fechafin->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_fechafin");
		$ircio->fechafin->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_fechafin");
		$ircio->horafin->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_horafin");
		$ircio->horafin->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_horafin");
		$ircio->horafin->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_horafin");
		$ircio->material->AdvancedSearch->SearchValue = $ircio->getAdvancedSearch("x_material");
		$ircio->material->AdvancedSearch->SearchOperator = $ircio->getAdvancedSearch("z_material");
		$ircio->material->AdvancedSearch->SearchValue2 = $ircio->getAdvancedSearch("y_material");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $ircio;
		$utf8 = TRUE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $ircio->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($ircio->ExportAll) {
			$this->lDisplayRecs = $this->lTotalRecs;
			$this->lStopRec = $this->lTotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->lDisplayRecs < 0) {
				$this->lStopRec = $this->lTotalRecs;
			} else {
				$this->lStopRec = $this->lStartRec + $this->lDisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->lStartRec-1, $this->lDisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		if ($ircio->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($ircio, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($ircio->cabecera);
				$ExportDoc->ExportCaption($ircio->orden);
				$ExportDoc->ExportCaption($ircio->op);
				$ExportDoc->ExportCaption($ircio->puesto);
				$ExportDoc->ExportCaption($ircio->contrato);
				$ExportDoc->ExportCaption($ircio->fechacrea);
				$ExportDoc->ExportCaption($ircio->horacrea);
				$ExportDoc->ExportCaption($ircio->fechafin);
				$ExportDoc->ExportCaption($ircio->horafin);
				$ExportDoc->ExportCaption($ircio->material);
				$ExportDoc->EndExportRow();
			}
		}

		// Move to first record
		$this->lRecCnt = $this->lStartRec - 1;
		if (!$rs->EOF) {
			$rs->MoveFirst();
			if (!$bSelectLimit && $this->lStartRec > 1)
				$rs->Move($this->lStartRec - 1);
		}
		while (!$rs->EOF && $this->lRecCnt < $this->lStopRec) {
			$this->lRecCnt++;
			if (intval($this->lRecCnt) >= intval($this->lStartRec)) {
				$this->LoadRowValues($rs);

				// Render row
				$ircio->CssClass = "";
				$ircio->CssStyle = "";
				$ircio->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($ircio->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('cabecera', $ircio->cabecera->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('orden', $ircio->orden->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('op', $ircio->op->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('puesto', $ircio->puesto->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('contrato', $ircio->contrato->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('fechacrea', $ircio->fechacrea->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('horacrea', $ircio->horacrea->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('fechafin', $ircio->fechafin->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('horafin', $ircio->horafin->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
					$XmlDoc->AddField('material', $ircio->material->ExportValue($ircio->Export, $ircio->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($ircio->cabecera);
					$ExportDoc->ExportField($ircio->orden);
					$ExportDoc->ExportField($ircio->op);
					$ExportDoc->ExportField($ircio->puesto);
					$ExportDoc->ExportField($ircio->contrato);
					$ExportDoc->ExportField($ircio->fechacrea);
					$ExportDoc->ExportField($ircio->horacrea);
					$ExportDoc->ExportField($ircio->fechafin);
					$ExportDoc->ExportField($ircio->horafin);
					$ExportDoc->ExportField($ircio->material);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($ircio->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($ircio->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($ircio->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($ircio->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($ircio->ExportReturnUrl());
		} else {
			echo $ExportDoc->Text;
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>

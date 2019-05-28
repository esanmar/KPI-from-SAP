<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
define("EW_DEFAULT_LOCALE", "es_ES", TRUE);
@setlocale(LC_ALL, EW_DEFAULT_LOCALE);
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "contadoresinfo.php" ?>
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
$contadores_list = new ccontadores_list();
$Page =& $contadores_list;

// Page init
$contadores_list->Page_Init();

// Page main
$contadores_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($contadores->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var contadores_list = new ew_Page("contadores_list");

// page properties
contadores_list.PageID = "list"; // page ID
contadores_list.FormID = "fcontadoreslist"; // form ID
var EW_PAGE_ID = contadores_list.PageID; // for backward compatibility

// extend page with ValidateForm function
contadores_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_op"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->op->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_objetivo"];
		if (elm && !ew_CheckNumber(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->objetivo->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_op2"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->op2->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_orden"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($contadores->orden->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
contadores_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
contadores_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
contadores_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($contadores->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$contadores_list->lTotalRecs = $contadores->SelectRecordCount();
	} else {
		if ($rs = $contadores_list->LoadRecordset())
			$contadores_list->lTotalRecs = $rs->RecordCount();
	}
	$contadores_list->lStartRec = 1;
	if ($contadores_list->lDisplayRecs <= 0 || ($contadores->Export <> "" && $contadores->ExportAll)) // Display all records
		$contadores_list->lDisplayRecs = $contadores_list->lTotalRecs;
	if (!($contadores->Export <> "" && $contadores->ExportAll))
		$contadores_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $contadores_list->LoadRecordset($contadores_list->lStartRec-1, $contadores_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $contadores->TableCaption() ?>
<?php if ($contadores->Export == "" && $contadores->CurrentAction == "") { ?>
&nbsp;&nbsp;<a href="<?php echo $contadores_list->ExportPrintUrl ?>"><?php echo $Language->Phrase("PrinterFriendly") ?></a>
&nbsp;&nbsp;<a href="<?php echo $contadores_list->ExportExcelUrl ?>"><?php echo $Language->Phrase("ExportToExcel") ?></a>
&nbsp;&nbsp;<a href="<?php echo $contadores_list->ExportWordUrl ?>"><?php echo $Language->Phrase("ExportToWord") ?></a>
<?php } ?>
</span></p>
<?php if ($contadores->Export == "" && $contadores->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(contadores_list);" style="text-decoration: none;"><img id="contadores_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="contadores_list_SearchPanel">
<form name="fcontadoreslistsrch" id="fcontadoreslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="contadores">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $contadores_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="contadoressrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$contadores_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($contadores->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($contadores->CurrentAction <> "gridadd" && $contadores->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($contadores_list->Pager)) $contadores_list->Pager = new cPrevNextPager($contadores_list->lStartRec, $contadores_list->lDisplayRecs, $contadores_list->lTotalRecs) ?>
<?php if ($contadores_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($contadores_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $contadores_list->PageUrl() ?>start=<?php echo $contadores_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($contadores_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $contadores_list->PageUrl() ?>start=<?php echo $contadores_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $contadores_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($contadores_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $contadores_list->PageUrl() ?>start=<?php echo $contadores_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($contadores_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $contadores_list->PageUrl() ?>start=<?php echo $contadores_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contadores_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contadores_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contadores_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contadores_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($contadores_list->sSrchWhere == "0=101") { ?>
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
<?php if ($contadores->CurrentAction <> "gridadd" && $contadores->CurrentAction <> "gridedit") { // Not grid add/edit mode ?>
<a href="<?php echo $contadores_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php if ($contadores_list->lTotalRecs > 0) { ?>
<a href="<?php echo $contadores_list->GridEditUrl ?>"><?php echo $Language->Phrase("GridEditLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } else { // Grid add/edit mode ?>
<?php if ($contadores->CurrentAction == "gridedit") { ?>
<a href="" onclick="f=document.fcontadoreslist;if(contadores_list.ValidateForm(f))f.submit();return false;"><?php echo $Language->Phrase("GridSaveLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $contadores_list->PageUrl() ?>a=cancel"><?php echo $Language->Phrase("GridCancelLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="fcontadoreslist" id="fcontadoreslist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="contadores">
<div id="gmp_contadores" class="ewGridMiddlePanel">
<?php if ($contadores_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $contadores->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$contadores_list->RenderListOptions();

// Render list options (header, left)
$contadores_list->ListOptions->Render("header", "left");
?>
<?php if ($contadores->id->Visible) { // id ?>
	<?php if ($contadores->SortUrl($contadores->id) == "") { ?>
		<td><?php echo $contadores->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->op->Visible) { // op ?>
	<?php if ($contadores->SortUrl($contadores->op) == "") { ?>
		<td><?php echo $contadores->op->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->op) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->op->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->op->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->op->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->zona->Visible) { // zona ?>
	<?php if ($contadores->SortUrl($contadores->zona) == "") { ?>
		<td><?php echo $contadores->zona->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->zona) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->zona->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->zona->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->zona->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->descripcion->Visible) { // descripcion ?>
	<?php if ($contadores->SortUrl($contadores->descripcion) == "") { ?>
		<td><?php echo $contadores->descripcion->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->descripcion) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->descripcion->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->descripcion->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->descripcion->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->programa->Visible) { // programa ?>
	<?php if ($contadores->SortUrl($contadores->programa) == "") { ?>
		<td><?php echo $contadores->programa->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->programa) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->programa->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->programa->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->programa->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->diahasta->Visible) { // diahasta ?>
	<?php if ($contadores->SortUrl($contadores->diahasta) == "") { ?>
		<td><?php echo $contadores->diahasta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->diahasta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->diahasta->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->diahasta->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->diahasta->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->objetivo->Visible) { // objetivo ?>
	<?php if ($contadores->SortUrl($contadores->objetivo) == "") { ?>
		<td><?php echo $contadores->objetivo->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->objetivo) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->objetivo->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->objetivo->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->objetivo->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->op2->Visible) { // op2 ?>
	<?php if ($contadores->SortUrl($contadores->op2) == "") { ?>
		<td><?php echo $contadores->op2->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->op2) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->op2->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->op2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->op2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->horahasta->Visible) { // horahasta ?>
	<?php if ($contadores->SortUrl($contadores->horahasta) == "") { ?>
		<td><?php echo $contadores->horahasta->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->horahasta) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->horahasta->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->horahasta->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->horahasta->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->material->Visible) { // material ?>
	<?php if ($contadores->SortUrl($contadores->material) == "") { ?>
		<td><?php echo $contadores->material->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->material) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->material->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->material->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->material->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($contadores->orden->Visible) { // orden ?>
	<?php if ($contadores->SortUrl($contadores->orden) == "") { ?>
		<td><?php echo $contadores->orden->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $contadores->SortUrl($contadores->orden) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $contadores->orden->FldCaption() ?></td><td style="width: 10px;"><?php if ($contadores->orden->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($contadores->orden->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$contadores_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($contadores->ExportAll && $contadores->Export <> "") {
	$contadores_list->lStopRec = $contadores_list->lTotalRecs;
} else {
	$contadores_list->lStopRec = $contadores_list->lStartRec + $contadores_list->lDisplayRecs - 1; // Set the last record to display
}
$contadores_list->lRecCount = $contadores_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $contadores_list->lStartRec > 1)
		$rs->Move($contadores_list->lStartRec - 1);
}

// Initialize aggregate
$contadores->RowType = EW_ROWTYPE_AGGREGATEINIT;
$contadores_list->RenderRow();
$contadores_list->lRowCnt = 0;
$contadores_list->lEditRowCnt = 0;
if ($contadores->CurrentAction == "edit")
	$contadores_list->lRowIndex = 1;
if ($contadores->CurrentAction == "gridedit")
	$contadores_list->lRowIndex = 0;
while (($contadores->CurrentAction == "gridadd" || !$rs->EOF) &&
	$contadores_list->lRecCount < $contadores_list->lStopRec) {
	$contadores_list->lRecCount++;
	if (intval($contadores_list->lRecCount) >= intval($contadores_list->lStartRec)) {
		$contadores_list->lRowCnt++;
		if ($contadores->CurrentAction == "gridadd" || $contadores->CurrentAction == "gridedit")
			$contadores_list->lRowIndex++;

	// Init row class and style
	$contadores->CssClass = "";
	$contadores->CssStyle = "";
	$contadores->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($contadores->CurrentAction == "gridadd") {
		$contadores_list->LoadDefaultValues(); // Load default values
	} else {
		$contadores_list->LoadRowValues($rs); // Load row values
	}
	$contadores->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($contadores->CurrentAction == "edit") {
		if ($contadores_list->CheckInlineEditKey() && $contadores_list->lEditRowCnt == 0) { // Inline edit
			$contadores->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($contadores->CurrentAction == "gridedit") { // Grid edit
		$contadores->RowType = EW_ROWTYPE_EDIT; // Render edit
	}
	if ($contadores->RowType == EW_ROWTYPE_EDIT && $contadores->EventCancelled) { // Update failed
		if ($contadores->CurrentAction == "edit")
			$contadores_list->RestoreFormValues(); // Restore form values
		if ($contadores->CurrentAction == "gridedit")
			$contadores_list->RestoreCurrentRowFormValues($contadores_list->lRowIndex); // Restore form values
	}
	if ($contadores->RowType == EW_ROWTYPE_EDIT) // Edit row
		$contadores_list->lEditRowCnt++;
	if ($contadores->RowType == EW_ROWTYPE_ADD || $contadores->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$contadores->RowAttrs = array_merge($contadores->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$contadores->CssClass = "ewTableEditRow";
	}

	// Render row
	$contadores_list->RenderRow();

	// Render list options
	$contadores_list->RenderListOptions();
?>
	<tr<?php echo $contadores->RowAttributes() ?>>
<?php

// Render list options (body, left)
$contadores_list->ListOptions->Render("body", "left");
?>
	<?php if ($contadores->id->Visible) { // id ?>
		<td<?php echo $contadores->id->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $contadores->id->ViewAttributes() ?>><?php echo $contadores->id->EditValue ?></div><input type="hidden" name="x<?php echo $contadores_list->lRowIndex ?>_id" id="x<?php echo $contadores_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($contadores->id->CurrentValue) ?>">
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->id->ViewAttributes() ?>><?php echo $contadores->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->op->Visible) { // op ?>
		<td<?php echo $contadores->op->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_op" id="x<?php echo $contadores_list->lRowIndex ?>_op" title="<?php echo $contadores->op->FldTitle() ?>" size="30" value="<?php echo $contadores->op->EditValue ?>"<?php echo $contadores->op->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->op->ViewAttributes() ?>><?php echo $contadores->op->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->zona->Visible) { // zona ?>
		<td<?php echo $contadores->zona->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_zona" id="x<?php echo $contadores_list->lRowIndex ?>_zona" title="<?php echo $contadores->zona->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->zona->EditValue ?>"<?php echo $contadores->zona->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->zona->ViewAttributes() ?>><?php echo $contadores->zona->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->descripcion->Visible) { // descripcion ?>
		<td<?php echo $contadores->descripcion->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_descripcion" id="x<?php echo $contadores_list->lRowIndex ?>_descripcion" title="<?php echo $contadores->descripcion->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $contadores->descripcion->EditValue ?>"<?php echo $contadores->descripcion->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->descripcion->ViewAttributes() ?>><?php echo $contadores->descripcion->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->programa->Visible) { // programa ?>
		<td<?php echo $contadores->programa->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_programa" id="x<?php echo $contadores_list->lRowIndex ?>_programa" title="<?php echo $contadores->programa->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->programa->EditValue ?>"<?php echo $contadores->programa->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->programa->ViewAttributes() ?>><?php echo $contadores->programa->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->diahasta->Visible) { // diahasta ?>
		<td<?php echo $contadores->diahasta->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<select id="x<?php echo $contadores_list->lRowIndex ?>_diahasta" name="x<?php echo $contadores_list->lRowIndex ?>_diahasta" title="<?php echo $contadores->diahasta->FldTitle() ?>"<?php echo $contadores->diahasta->EditAttributes() ?>>
<?php
if (is_array($contadores->diahasta->EditValue)) {
	$arwrk = $contadores->diahasta->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($contadores->diahasta->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->diahasta->ViewAttributes() ?>><?php echo $contadores->diahasta->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->objetivo->Visible) { // objetivo ?>
		<td<?php echo $contadores->objetivo->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_objetivo" id="x<?php echo $contadores_list->lRowIndex ?>_objetivo" title="<?php echo $contadores->objetivo->FldTitle() ?>" size="30" value="<?php echo $contadores->objetivo->EditValue ?>"<?php echo $contadores->objetivo->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->objetivo->ViewAttributes() ?>><?php echo $contadores->objetivo->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->op2->Visible) { // op2 ?>
		<td<?php echo $contadores->op2->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_op2" id="x<?php echo $contadores_list->lRowIndex ?>_op2" title="<?php echo $contadores->op2->FldTitle() ?>" size="30" value="<?php echo $contadores->op2->EditValue ?>"<?php echo $contadores->op2->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->op2->ViewAttributes() ?>><?php echo $contadores->op2->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->horahasta->Visible) { // horahasta ?>
		<td<?php echo $contadores->horahasta->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_horahasta" id="x<?php echo $contadores_list->lRowIndex ?>_horahasta" title="<?php echo $contadores->horahasta->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->horahasta->EditValue ?>"<?php echo $contadores->horahasta->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->horahasta->ViewAttributes() ?>><?php echo $contadores->horahasta->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->material->Visible) { // material ?>
		<td<?php echo $contadores->material->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_material" id="x<?php echo $contadores_list->lRowIndex ?>_material" title="<?php echo $contadores->material->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $contadores->material->EditValue ?>"<?php echo $contadores->material->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->material->ViewAttributes() ?>><?php echo $contadores->material->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contadores->orden->Visible) { // orden ?>
		<td<?php echo $contadores->orden->CellAttributes() ?>>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $contadores_list->lRowIndex ?>_orden" id="x<?php echo $contadores_list->lRowIndex ?>_orden" title="<?php echo $contadores->orden->FldTitle() ?>" size="30" value="<?php echo $contadores->orden->EditValue ?>"<?php echo $contadores->orden->EditAttributes() ?>>
<?php } ?>
<?php if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $contadores->orden->ViewAttributes() ?>><?php echo $contadores->orden->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contadores_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($contadores->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($contadores->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($contadores->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $contadores_list->lRowIndex ?>">
<?php } ?>
<?php if ($contadores->CurrentAction == "gridedit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="key_count" id="key_count" value="<?php echo $contadores_list->lRowIndex ?>">
<?php echo $contadores_list->sMultiSelectKey ?>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
</td></tr></table>
<?php if ($contadores->Export == "" && $contadores->CurrentAction == "") { ?>
<?php } ?>
<?php if ($contadores->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$contadores_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccontadores_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'contadores';

	// Page object name
	var $PageObjName = 'contadores_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $contadores;
		if ($contadores->UseTokenInUrl) $PageUrl .= "t=" . $contadores->TableVar . "&"; // Add page token
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
		global $objForm, $contadores;
		if ($contadores->UseTokenInUrl) {
			if ($objForm)
				return ($contadores->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($contadores->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccontadores_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (contadores)
		$GLOBALS["contadores"] = new ccontadores();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["contadores"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "contadoresdelete.php";
		$this->MultiUpdateUrl = "contadoresupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'contadores', TRUE);

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
		global $contadores;

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$contadores->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$contadores->Export = $_POST["exporttype"];
		} else {
			$contadores->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $contadores->Export; // Get export parameter, used in header
		$gsExportFile = $contadores->TableVar; // Get export file, used in header
		if (in_array($contadores->Export, array("html", "email", "excel", "word")))
			echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
		if ($contadores->Export == "excel") {
			header('Content-Type: application/vnd.ms-excel;charset=utf-8');
			header('Content-Disposition: attachment; filename=' . $gsExportFile .'.xls');
		}
		if ($contadores->Export == "word") {
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
		global $objForm, $Language, $gsSearchError, $Security, $contadores;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$contadores->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($contadores->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to grid edit mode
				if ($contadores->CurrentAction == "gridedit")
					$this->GridEditMode();

				// Switch to inline edit mode
				if ($contadores->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$contadores->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Update
					if (($contadores->CurrentAction == "gridupdate" || $contadores->CurrentAction == "gridoverwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridedit")
						$this->GridUpdate();

					// Inline Update
					if (($contadores->CurrentAction == "update" || $contadores->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
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
			$contadores->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($contadores->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $contadores->getRecordsPerPage(); // Restore from Session
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
		$contadores->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$contadores->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$contadores->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $contadores->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$contadores->setSessionWhere($sFilter);
		$contadores->CurrentFilter = "";

		// Export data only
		if (in_array($contadores->Export, array("html","word","excel","xml","csv","email"))) {
			$this->ExportData();
			if ($contadores->Export <> "email")
				$this->Page_Terminate(); // Terminate response
			exit();
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $contadores;
		$contadores->setKey("id", ""); // Clear inline edit key
		$contadores->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $contadores;
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$contadores->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$contadores->setKey("id", $contadores->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $contadores;
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
				$contadores->SendEmail = TRUE; // Send email on update success
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
			$contadores->EventCancelled = TRUE; // Cancel event
			$contadores->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $contadores;

		//CheckInlineEditKey = True
		if (strval($contadores->getKey("id")) <> strval($contadores->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Perform update to grid
	function GridUpdate() {
		global $conn, $Language, $objForm, $gsFormError, $contadores;
		$rowindex = 1;
		$bGridUpdate = TRUE;

		// Begin transaction
		$conn->BeginTrans();

		// Get old recordset
		$contadores->CurrentFilter = $this->BuildKeyFilter();
		$sSql = $contadores->SQL();
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
					$contadores->SendEmail = FALSE; // Do not send email on update success
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
			$contadores->EventCancelled = TRUE; // Set event cancelled
			$contadores->CurrentAction = "gridedit"; // Stay in Grid Edit mode
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm, $contadores;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $contadores->KeyFilter();
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
		global $contadores;
		$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $key);
		if (count($arrKeyFlds) >= 1) {
			$contadores->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($contadores->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm, $contadores;

		// Get row based on current index
		$objForm->Index = $idx;
		if ($contadores->CurrentAction == "gridadd")
			$this->LoadFormValues(); // Load form values
		if ($contadores->CurrentAction == "gridedit") {
			$sKey = strval($objForm->GetValue("k_key"));
			$arrKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, $sKey);
			if (count($arrKeyFlds) >= 1) {
				if (strval($arrKeyFlds[0]) == strval($contadores->id->CurrentValue)) {
					$this->LoadFormValues(); // Load form values
				}
			}
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $contadores;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $contadores->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $contadores->op, FALSE); // op
		$this->BuildSearchSql($sWhere, $contadores->zona, FALSE); // zona
		$this->BuildSearchSql($sWhere, $contadores->descripcion, FALSE); // descripcion
		$this->BuildSearchSql($sWhere, $contadores->programa, FALSE); // programa
		$this->BuildSearchSql($sWhere, $contadores->diahasta, FALSE); // diahasta
		$this->BuildSearchSql($sWhere, $contadores->objetivo, FALSE); // objetivo
		$this->BuildSearchSql($sWhere, $contadores->op2, FALSE); // op2
		$this->BuildSearchSql($sWhere, $contadores->horahasta, FALSE); // horahasta
		$this->BuildSearchSql($sWhere, $contadores->material, FALSE); // material
		$this->BuildSearchSql($sWhere, $contadores->orden, FALSE); // orden

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($contadores->id); // id
			$this->SetSearchParm($contadores->op); // op
			$this->SetSearchParm($contadores->zona); // zona
			$this->SetSearchParm($contadores->descripcion); // descripcion
			$this->SetSearchParm($contadores->programa); // programa
			$this->SetSearchParm($contadores->diahasta); // diahasta
			$this->SetSearchParm($contadores->objetivo); // objetivo
			$this->SetSearchParm($contadores->op2); // op2
			$this->SetSearchParm($contadores->horahasta); // horahasta
			$this->SetSearchParm($contadores->material); // material
			$this->SetSearchParm($contadores->orden); // orden
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
		global $contadores;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$contadores->setAdvancedSearch("x_$FldParm", $FldVal);
		$contadores->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$contadores->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$contadores->setAdvancedSearch("y_$FldParm", $FldVal2);
		$contadores->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $contadores;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $contadores->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $contadores->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $contadores->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $contadores->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $contadores->GetAdvancedSearch("w_$FldParm");
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
		global $contadores;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$contadores->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $contadores;
		$contadores->setAdvancedSearch("x_id", "");
		$contadores->setAdvancedSearch("z_id", "");
		$contadores->setAdvancedSearch("y_id", "");
		$contadores->setAdvancedSearch("x_op", "");
		$contadores->setAdvancedSearch("z_op", "");
		$contadores->setAdvancedSearch("y_op", "");
		$contadores->setAdvancedSearch("x_zona", "");
		$contadores->setAdvancedSearch("z_zona", "");
		$contadores->setAdvancedSearch("y_zona", "");
		$contadores->setAdvancedSearch("x_descripcion", "");
		$contadores->setAdvancedSearch("z_descripcion", "");
		$contadores->setAdvancedSearch("y_descripcion", "");
		$contadores->setAdvancedSearch("x_programa", "");
		$contadores->setAdvancedSearch("z_programa", "");
		$contadores->setAdvancedSearch("y_programa", "");
		$contadores->setAdvancedSearch("x_diahasta", "");
		$contadores->setAdvancedSearch("z_diahasta", "");
		$contadores->setAdvancedSearch("y_diahasta", "");
		$contadores->setAdvancedSearch("x_objetivo", "");
		$contadores->setAdvancedSearch("x_op2", "");
		$contadores->setAdvancedSearch("z_op2", "");
		$contadores->setAdvancedSearch("y_op2", "");
		$contadores->setAdvancedSearch("x_horahasta", "");
		$contadores->setAdvancedSearch("z_horahasta", "");
		$contadores->setAdvancedSearch("y_horahasta", "");
		$contadores->setAdvancedSearch("x_material", "");
		$contadores->setAdvancedSearch("z_material", "");
		$contadores->setAdvancedSearch("y_material", "");
		$contadores->setAdvancedSearch("x_orden", "");
		$contadores->setAdvancedSearch("z_orden", "");
		$contadores->setAdvancedSearch("y_orden", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $contadores;
		$bRestore = TRUE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["y_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_op"] <> "") $bRestore = FALSE;
		if (@$_GET["y_op"] <> "") $bRestore = FALSE;
		if (@$_GET["x_zona"] <> "") $bRestore = FALSE;
		if (@$_GET["y_zona"] <> "") $bRestore = FALSE;
		if (@$_GET["x_descripcion"] <> "") $bRestore = FALSE;
		if (@$_GET["y_descripcion"] <> "") $bRestore = FALSE;
		if (@$_GET["x_programa"] <> "") $bRestore = FALSE;
		if (@$_GET["y_programa"] <> "") $bRestore = FALSE;
		if (@$_GET["x_diahasta"] <> "") $bRestore = FALSE;
		if (@$_GET["y_diahasta"] <> "") $bRestore = FALSE;
		if (@$_GET["x_objetivo"] <> "") $bRestore = FALSE;
		if (@$_GET["x_op2"] <> "") $bRestore = FALSE;
		if (@$_GET["y_op2"] <> "") $bRestore = FALSE;
		if (@$_GET["x_horahasta"] <> "") $bRestore = FALSE;
		if (@$_GET["y_horahasta"] <> "") $bRestore = FALSE;
		if (@$_GET["x_material"] <> "") $bRestore = FALSE;
		if (@$_GET["y_material"] <> "") $bRestore = FALSE;
		if (@$_GET["x_orden"] <> "") $bRestore = FALSE;
		if (@$_GET["y_orden"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($contadores->id);
			$this->GetSearchParm($contadores->op);
			$this->GetSearchParm($contadores->zona);
			$this->GetSearchParm($contadores->descripcion);
			$this->GetSearchParm($contadores->programa);
			$this->GetSearchParm($contadores->diahasta);
			$this->GetSearchParm($contadores->objetivo);
			$this->GetSearchParm($contadores->op2);
			$this->GetSearchParm($contadores->horahasta);
			$this->GetSearchParm($contadores->material);
			$this->GetSearchParm($contadores->orden);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $contadores;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$contadores->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$contadores->CurrentOrderType = @$_GET["ordertype"];
			$contadores->UpdateSort($contadores->id); // id
			$contadores->UpdateSort($contadores->op); // op
			$contadores->UpdateSort($contadores->zona); // zona
			$contadores->UpdateSort($contadores->descripcion); // descripcion
			$contadores->UpdateSort($contadores->programa); // programa
			$contadores->UpdateSort($contadores->diahasta); // diahasta
			$contadores->UpdateSort($contadores->objetivo); // objetivo
			$contadores->UpdateSort($contadores->op2); // op2
			$contadores->UpdateSort($contadores->horahasta); // horahasta
			$contadores->UpdateSort($contadores->material); // material
			$contadores->UpdateSort($contadores->orden); // orden
			$contadores->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $contadores;
		$sOrderBy = $contadores->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($contadores->SqlOrderBy() <> "") {
				$sOrderBy = $contadores->SqlOrderBy();
				$contadores->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $contadores;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$contadores->setSessionOrderBy($sOrderBy);
				$contadores->id->setSort("");
				$contadores->op->setSort("");
				$contadores->zona->setSort("");
				$contadores->descripcion->setSort("");
				$contadores->programa->setSort("");
				$contadores->diahasta->setSort("");
				$contadores->objetivo->setSort("");
				$contadores->op2->setSort("");
				$contadores->horahasta->setSort("");
				$contadores->material->setSort("");
				$contadores->orden->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$contadores->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $contadores;

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
		if ($contadores->Export <> "" ||
			$contadores->CurrentAction == "gridadd" ||
			$contadores->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $contadores;
		$this->ListOptions->LoadDefault();

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($contadores->CurrentAction == "edit" && $contadores->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.fcontadoreslist;if(contadores_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
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
		if ($contadores->CurrentAction == "gridedit")
			$this->sMultiSelectKey .= "<input type=\"hidden\" name=\"k" . $this->lRowIndex . "_key\" id=\"k" . $this->lRowIndex . "_key\" value=\"" . $contadores->id->CurrentValue . "\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $contadores;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $contadores;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$contadores->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$contadores->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $contadores->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$contadores->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$contadores->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$contadores->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $contadores;

		// Load search values
		// id

		$contadores->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$contadores->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];
		$contadores->id->AdvancedSearch->SearchCondition = @$_GET["v_id"];
		$contadores->id->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_id"]);
		$contadores->id->AdvancedSearch->SearchOperator2 = @$_GET["w_id"];

		// op
		$contadores->op->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_op"]);
		$contadores->op->AdvancedSearch->SearchOperator = @$_GET["z_op"];
		$contadores->op->AdvancedSearch->SearchCondition = @$_GET["v_op"];
		$contadores->op->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_op"]);
		$contadores->op->AdvancedSearch->SearchOperator2 = @$_GET["w_op"];

		// zona
		$contadores->zona->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_zona"]);
		$contadores->zona->AdvancedSearch->SearchOperator = @$_GET["z_zona"];
		$contadores->zona->AdvancedSearch->SearchCondition = @$_GET["v_zona"];
		$contadores->zona->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_zona"]);
		$contadores->zona->AdvancedSearch->SearchOperator2 = @$_GET["w_zona"];

		// descripcion
		$contadores->descripcion->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_descripcion"]);
		$contadores->descripcion->AdvancedSearch->SearchOperator = @$_GET["z_descripcion"];
		$contadores->descripcion->AdvancedSearch->SearchCondition = @$_GET["v_descripcion"];
		$contadores->descripcion->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_descripcion"]);
		$contadores->descripcion->AdvancedSearch->SearchOperator2 = @$_GET["w_descripcion"];

		// programa
		$contadores->programa->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_programa"]);
		$contadores->programa->AdvancedSearch->SearchOperator = @$_GET["z_programa"];
		$contadores->programa->AdvancedSearch->SearchCondition = @$_GET["v_programa"];
		$contadores->programa->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_programa"]);
		$contadores->programa->AdvancedSearch->SearchOperator2 = @$_GET["w_programa"];

		// diahasta
		$contadores->diahasta->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_diahasta"]);
		$contadores->diahasta->AdvancedSearch->SearchOperator = @$_GET["z_diahasta"];
		$contadores->diahasta->AdvancedSearch->SearchCondition = @$_GET["v_diahasta"];
		$contadores->diahasta->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_diahasta"]);
		$contadores->diahasta->AdvancedSearch->SearchOperator2 = @$_GET["w_diahasta"];

		// objetivo
		$contadores->objetivo->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_objetivo"]);
		$contadores->objetivo->AdvancedSearch->SearchOperator = @$_GET["z_objetivo"];

		// op2
		$contadores->op2->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_op2"]);
		$contadores->op2->AdvancedSearch->SearchOperator = @$_GET["z_op2"];
		$contadores->op2->AdvancedSearch->SearchCondition = @$_GET["v_op2"];
		$contadores->op2->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_op2"]);
		$contadores->op2->AdvancedSearch->SearchOperator2 = @$_GET["w_op2"];

		// horahasta
		$contadores->horahasta->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_horahasta"]);
		$contadores->horahasta->AdvancedSearch->SearchOperator = @$_GET["z_horahasta"];
		$contadores->horahasta->AdvancedSearch->SearchCondition = @$_GET["v_horahasta"];
		$contadores->horahasta->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_horahasta"]);
		$contadores->horahasta->AdvancedSearch->SearchOperator2 = @$_GET["w_horahasta"];

		// material
		$contadores->material->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_material"]);
		$contadores->material->AdvancedSearch->SearchOperator = @$_GET["z_material"];
		$contadores->material->AdvancedSearch->SearchCondition = @$_GET["v_material"];
		$contadores->material->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_material"]);
		$contadores->material->AdvancedSearch->SearchOperator2 = @$_GET["w_material"];

		// orden
		$contadores->orden->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_orden"]);
		$contadores->orden->AdvancedSearch->SearchOperator = @$_GET["z_orden"];
		$contadores->orden->AdvancedSearch->SearchCondition = @$_GET["v_orden"];
		$contadores->orden->AdvancedSearch->SearchValue2 = ew_StripSlashes(@$_GET["y_orden"]);
		$contadores->orden->AdvancedSearch->SearchOperator2 = @$_GET["w_orden"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $contadores;
		$contadores->id->setFormValue($objForm->GetValue("x_id"));
		$contadores->op->setFormValue($objForm->GetValue("x_op"));
		$contadores->zona->setFormValue($objForm->GetValue("x_zona"));
		$contadores->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		$contadores->programa->setFormValue($objForm->GetValue("x_programa"));
		$contadores->diahasta->setFormValue($objForm->GetValue("x_diahasta"));
		$contadores->objetivo->setFormValue($objForm->GetValue("x_objetivo"));
		$contadores->op2->setFormValue($objForm->GetValue("x_op2"));
		$contadores->horahasta->setFormValue($objForm->GetValue("x_horahasta"));
		$contadores->material->setFormValue($objForm->GetValue("x_material"));
		$contadores->orden->setFormValue($objForm->GetValue("x_orden"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $contadores;
		$contadores->id->CurrentValue = $contadores->id->FormValue;
		$contadores->op->CurrentValue = $contadores->op->FormValue;
		$contadores->zona->CurrentValue = $contadores->zona->FormValue;
		$contadores->descripcion->CurrentValue = $contadores->descripcion->FormValue;
		$contadores->programa->CurrentValue = $contadores->programa->FormValue;
		$contadores->diahasta->CurrentValue = $contadores->diahasta->FormValue;
		$contadores->objetivo->CurrentValue = $contadores->objetivo->FormValue;
		$contadores->op2->CurrentValue = $contadores->op2->FormValue;
		$contadores->horahasta->CurrentValue = $contadores->horahasta->FormValue;
		$contadores->material->CurrentValue = $contadores->material->FormValue;
		$contadores->orden->CurrentValue = $contadores->orden->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $contadores;

		// Call Recordset Selecting event
		$contadores->Recordset_Selecting($contadores->CurrentFilter);

		// Load List page SQL
		$sSql = $contadores->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$contadores->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $contadores;
		$sFilter = $contadores->KeyFilter();

		// Call Row Selecting event
		$contadores->Row_Selecting($sFilter);

		// Load SQL based on filter
		$contadores->CurrentFilter = $sFilter;
		$sSql = $contadores->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$contadores->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $contadores;
		$contadores->id->setDbValue($rs->fields('id'));
		$contadores->op->setDbValue($rs->fields('op'));
		$contadores->zona->setDbValue($rs->fields('zona'));
		$contadores->descripcion->setDbValue($rs->fields('descripcion'));
		$contadores->programa->setDbValue($rs->fields('programa'));
		$contadores->diahasta->setDbValue($rs->fields('diahasta'));
		$contadores->objetivo->setDbValue($rs->fields('objetivo'));
		$contadores->op2->setDbValue($rs->fields('op2'));
		$contadores->horahasta->setDbValue($rs->fields('horahasta'));
		$contadores->material->setDbValue($rs->fields('material'));
		$contadores->orden->setDbValue($rs->fields('orden'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $contadores;

		// Initialize URLs
		$this->ViewUrl = $contadores->ViewUrl();
		$this->EditUrl = $contadores->EditUrl();
		$this->InlineEditUrl = $contadores->InlineEditUrl();
		$this->CopyUrl = $contadores->CopyUrl();
		$this->InlineCopyUrl = $contadores->InlineCopyUrl();
		$this->DeleteUrl = $contadores->DeleteUrl();

		// Call Row_Rendering event
		$contadores->Row_Rendering();

		// Common render codes for all row types
		// id

		$contadores->id->CellCssStyle = ""; $contadores->id->CellCssClass = "";
		$contadores->id->CellAttrs = array(); $contadores->id->ViewAttrs = array(); $contadores->id->EditAttrs = array();

		// op
		$contadores->op->CellCssStyle = ""; $contadores->op->CellCssClass = "";
		$contadores->op->CellAttrs = array(); $contadores->op->ViewAttrs = array(); $contadores->op->EditAttrs = array();

		// zona
		$contadores->zona->CellCssStyle = ""; $contadores->zona->CellCssClass = "";
		$contadores->zona->CellAttrs = array(); $contadores->zona->ViewAttrs = array(); $contadores->zona->EditAttrs = array();

		// descripcion
		$contadores->descripcion->CellCssStyle = ""; $contadores->descripcion->CellCssClass = "";
		$contadores->descripcion->CellAttrs = array(); $contadores->descripcion->ViewAttrs = array(); $contadores->descripcion->EditAttrs = array();

		// programa
		$contadores->programa->CellCssStyle = ""; $contadores->programa->CellCssClass = "";
		$contadores->programa->CellAttrs = array(); $contadores->programa->ViewAttrs = array(); $contadores->programa->EditAttrs = array();

		// diahasta
		$contadores->diahasta->CellCssStyle = ""; $contadores->diahasta->CellCssClass = "";
		$contadores->diahasta->CellAttrs = array(); $contadores->diahasta->ViewAttrs = array(); $contadores->diahasta->EditAttrs = array();

		// objetivo
		$contadores->objetivo->CellCssStyle = ""; $contadores->objetivo->CellCssClass = "";
		$contadores->objetivo->CellAttrs = array(); $contadores->objetivo->ViewAttrs = array(); $contadores->objetivo->EditAttrs = array();

		// op2
		$contadores->op2->CellCssStyle = ""; $contadores->op2->CellCssClass = "";
		$contadores->op2->CellAttrs = array(); $contadores->op2->ViewAttrs = array(); $contadores->op2->EditAttrs = array();

		// horahasta
		$contadores->horahasta->CellCssStyle = ""; $contadores->horahasta->CellCssClass = "";
		$contadores->horahasta->CellAttrs = array(); $contadores->horahasta->ViewAttrs = array(); $contadores->horahasta->EditAttrs = array();

		// material
		$contadores->material->CellCssStyle = ""; $contadores->material->CellCssClass = "";
		$contadores->material->CellAttrs = array(); $contadores->material->ViewAttrs = array(); $contadores->material->EditAttrs = array();

		// orden
		$contadores->orden->CellCssStyle = ""; $contadores->orden->CellCssClass = "";
		$contadores->orden->CellAttrs = array(); $contadores->orden->ViewAttrs = array(); $contadores->orden->EditAttrs = array();
		if ($contadores->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$contadores->id->ViewValue = $contadores->id->CurrentValue;
			$contadores->id->CssStyle = "";
			$contadores->id->CssClass = "";
			$contadores->id->ViewCustomAttributes = "";

			// op
			$contadores->op->ViewValue = $contadores->op->CurrentValue;
			$contadores->op->CssStyle = "";
			$contadores->op->CssClass = "";
			$contadores->op->ViewCustomAttributes = "";

			// zona
			$contadores->zona->ViewValue = $contadores->zona->CurrentValue;
			$contadores->zona->CssStyle = "";
			$contadores->zona->CssClass = "";
			$contadores->zona->ViewCustomAttributes = "";

			// descripcion
			$contadores->descripcion->ViewValue = $contadores->descripcion->CurrentValue;
			$contadores->descripcion->CssStyle = "";
			$contadores->descripcion->CssClass = "";
			$contadores->descripcion->ViewCustomAttributes = "";

			// programa
			$contadores->programa->ViewValue = $contadores->programa->CurrentValue;
			$contadores->programa->CssStyle = "";
			$contadores->programa->CssClass = "";
			$contadores->programa->ViewCustomAttributes = "";

			// diahasta
			if (strval($contadores->diahasta->CurrentValue) <> "") {
				switch ($contadores->diahasta->CurrentValue) {
					case "Lunes":
						$contadores->diahasta->ViewValue = "Lunes";
						break;
					case "Martes":
						$contadores->diahasta->ViewValue = "Martes";
						break;
					case "Miercoles":
						$contadores->diahasta->ViewValue = "Miercoles";
						break;
					case "Jueves":
						$contadores->diahasta->ViewValue = "Jueves";
						break;
					case "Viernes":
						$contadores->diahasta->ViewValue = "Viernes";
						break;
					case "Sabado":
						$contadores->diahasta->ViewValue = "Sabado";
						break;
					case "Domingo":
						$contadores->diahasta->ViewValue = "Domingo";
						break;
					default:
						$contadores->diahasta->ViewValue = $contadores->diahasta->CurrentValue;
				}
			} else {
				$contadores->diahasta->ViewValue = NULL;
			}
			$contadores->diahasta->CssStyle = "";
			$contadores->diahasta->CssClass = "";
			$contadores->diahasta->ViewCustomAttributes = "";

			// objetivo
			$contadores->objetivo->ViewValue = $contadores->objetivo->CurrentValue;
			$contadores->objetivo->CssStyle = "";
			$contadores->objetivo->CssClass = "";
			$contadores->objetivo->ViewCustomAttributes = "";

			// op2
			$contadores->op2->ViewValue = $contadores->op2->CurrentValue;
			$contadores->op2->CssStyle = "";
			$contadores->op2->CssClass = "";
			$contadores->op2->ViewCustomAttributes = "";

			// horahasta
			$contadores->horahasta->ViewValue = $contadores->horahasta->CurrentValue;
			$contadores->horahasta->CssStyle = "";
			$contadores->horahasta->CssClass = "";
			$contadores->horahasta->ViewCustomAttributes = "";

			// material
			$contadores->material->ViewValue = $contadores->material->CurrentValue;
			$contadores->material->CssStyle = "";
			$contadores->material->CssClass = "";
			$contadores->material->ViewCustomAttributes = "";

			// orden
			$contadores->orden->ViewValue = $contadores->orden->CurrentValue;
			$contadores->orden->CssStyle = "";
			$contadores->orden->CssClass = "";
			$contadores->orden->ViewCustomAttributes = "";

			// id
			$contadores->id->HrefValue = "";
			$contadores->id->TooltipValue = "";

			// op
			$contadores->op->HrefValue = "";
			$contadores->op->TooltipValue = "";

			// zona
			$contadores->zona->HrefValue = "";
			$contadores->zona->TooltipValue = "";

			// descripcion
			$contadores->descripcion->HrefValue = "";
			$contadores->descripcion->TooltipValue = "";

			// programa
			$contadores->programa->HrefValue = "";
			$contadores->programa->TooltipValue = "";

			// diahasta
			$contadores->diahasta->HrefValue = "";
			$contadores->diahasta->TooltipValue = "";

			// objetivo
			$contadores->objetivo->HrefValue = "";
			$contadores->objetivo->TooltipValue = "";

			// op2
			$contadores->op2->HrefValue = "";
			$contadores->op2->TooltipValue = "";

			// horahasta
			$contadores->horahasta->HrefValue = "";
			$contadores->horahasta->TooltipValue = "";

			// material
			$contadores->material->HrefValue = "";
			$contadores->material->TooltipValue = "";

			// orden
			$contadores->orden->HrefValue = "";
			$contadores->orden->TooltipValue = "";
		} elseif ($contadores->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$contadores->id->EditCustomAttributes = "";
			$contadores->id->EditValue = $contadores->id->CurrentValue;
			$contadores->id->CssStyle = "";
			$contadores->id->CssClass = "";
			$contadores->id->ViewCustomAttributes = "";

			// op
			$contadores->op->EditCustomAttributes = "";
			$contadores->op->EditValue = ew_HtmlEncode($contadores->op->CurrentValue);

			// zona
			$contadores->zona->EditCustomAttributes = "";
			$contadores->zona->EditValue = ew_HtmlEncode($contadores->zona->CurrentValue);

			// descripcion
			$contadores->descripcion->EditCustomAttributes = "";
			$contadores->descripcion->EditValue = ew_HtmlEncode($contadores->descripcion->CurrentValue);

			// programa
			$contadores->programa->EditCustomAttributes = "";
			$contadores->programa->EditValue = ew_HtmlEncode($contadores->programa->CurrentValue);

			// diahasta
			$contadores->diahasta->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("Lunes", "Lunes");
			$arwrk[] = array("Martes", "Martes");
			$arwrk[] = array("Miercoles", "Miercoles");
			$arwrk[] = array("Jueves", "Jueves");
			$arwrk[] = array("Viernes", "Viernes");
			$arwrk[] = array("Sabado", "Sabado");
			$arwrk[] = array("Domingo", "Domingo");
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$contadores->diahasta->EditValue = $arwrk;

			// objetivo
			$contadores->objetivo->EditCustomAttributes = "";
			$contadores->objetivo->EditValue = ew_HtmlEncode($contadores->objetivo->CurrentValue);

			// op2
			$contadores->op2->EditCustomAttributes = "";
			$contadores->op2->EditValue = ew_HtmlEncode($contadores->op2->CurrentValue);

			// horahasta
			$contadores->horahasta->EditCustomAttributes = "";
			$contadores->horahasta->EditValue = ew_HtmlEncode($contadores->horahasta->CurrentValue);

			// material
			$contadores->material->EditCustomAttributes = "";
			$contadores->material->EditValue = ew_HtmlEncode($contadores->material->CurrentValue);

			// orden
			$contadores->orden->EditCustomAttributes = "";
			$contadores->orden->EditValue = ew_HtmlEncode($contadores->orden->CurrentValue);

			// Edit refer script
			// id

			$contadores->id->HrefValue = "";

			// op
			$contadores->op->HrefValue = "";

			// zona
			$contadores->zona->HrefValue = "";

			// descripcion
			$contadores->descripcion->HrefValue = "";

			// programa
			$contadores->programa->HrefValue = "";

			// diahasta
			$contadores->diahasta->HrefValue = "";

			// objetivo
			$contadores->objetivo->HrefValue = "";

			// op2
			$contadores->op2->HrefValue = "";

			// horahasta
			$contadores->horahasta->HrefValue = "";

			// material
			$contadores->material->HrefValue = "";

			// orden
			$contadores->orden->HrefValue = "";
		}

		// Call Row Rendered event
		if ($contadores->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$contadores->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $contadores;

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
		global $Language, $gsFormError, $contadores;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($contadores->op->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $contadores->op->FldErrMsg();
		}
		if (!ew_CheckNumber($contadores->objetivo->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $contadores->objetivo->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->op2->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $contadores->op2->FldErrMsg();
		}
		if (!ew_CheckInteger($contadores->orden->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $contadores->orden->FldErrMsg();
		}

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
		global $conn, $Security, $Language, $contadores;
		$sFilter = $contadores->KeyFilter();
		$contadores->CurrentFilter = $sFilter;
		$sSql = $contadores->SQL();
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

			// op
			$contadores->op->SetDbValueDef($rsnew, $contadores->op->CurrentValue, NULL, FALSE);

			// zona
			$contadores->zona->SetDbValueDef($rsnew, $contadores->zona->CurrentValue, NULL, FALSE);

			// descripcion
			$contadores->descripcion->SetDbValueDef($rsnew, $contadores->descripcion->CurrentValue, NULL, FALSE);

			// programa
			$contadores->programa->SetDbValueDef($rsnew, $contadores->programa->CurrentValue, "", FALSE);

			// diahasta
			$contadores->diahasta->SetDbValueDef($rsnew, $contadores->diahasta->CurrentValue, NULL, FALSE);

			// objetivo
			$contadores->objetivo->SetDbValueDef($rsnew, $contadores->objetivo->CurrentValue, NULL, FALSE);

			// op2
			$contadores->op2->SetDbValueDef($rsnew, $contadores->op2->CurrentValue, NULL, FALSE);

			// horahasta
			$contadores->horahasta->SetDbValueDef($rsnew, $contadores->horahasta->CurrentValue, NULL, FALSE);

			// material
			$contadores->material->SetDbValueDef($rsnew, $contadores->material->CurrentValue, NULL, FALSE);

			// orden
			$contadores->orden->SetDbValueDef($rsnew, $contadores->orden->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $contadores->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($contadores->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($contadores->CancelMessage <> "") {
					$this->setMessage($contadores->CancelMessage);
					$contadores->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$contadores->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $contadores;
		$contadores->id->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_id");
		$contadores->id->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_id");
		$contadores->id->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_id");
		$contadores->op->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_op");
		$contadores->op->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_op");
		$contadores->op->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_op");
		$contadores->zona->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_zona");
		$contadores->zona->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_zona");
		$contadores->zona->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_zona");
		$contadores->descripcion->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_descripcion");
		$contadores->descripcion->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_descripcion");
		$contadores->descripcion->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_descripcion");
		$contadores->programa->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_programa");
		$contadores->programa->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_programa");
		$contadores->programa->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_programa");
		$contadores->diahasta->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_diahasta");
		$contadores->diahasta->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_diahasta");
		$contadores->diahasta->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_diahasta");
		$contadores->objetivo->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_objetivo");
		$contadores->op2->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_op2");
		$contadores->op2->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_op2");
		$contadores->op2->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_op2");
		$contadores->horahasta->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_horahasta");
		$contadores->horahasta->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_horahasta");
		$contadores->horahasta->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_horahasta");
		$contadores->material->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_material");
		$contadores->material->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_material");
		$contadores->material->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_material");
		$contadores->orden->AdvancedSearch->SearchValue = $contadores->getAdvancedSearch("x_orden");
		$contadores->orden->AdvancedSearch->SearchOperator = $contadores->getAdvancedSearch("z_orden");
		$contadores->orden->AdvancedSearch->SearchValue2 = $contadores->getAdvancedSearch("y_orden");
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email format
	function ExportData() {
		global $contadores;
		$utf8 = TRUE;
		$bSelectLimit = EW_SELECT_LIMIT;

		// Load recordset
		if ($bSelectLimit) {
			$this->lTotalRecs = $contadores->SelectRecordCount();
		} else {
			if ($rs = $this->LoadRecordset())
				$this->lTotalRecs = $rs->RecordCount();
		}
		$this->lStartRec = 1;

		// Export all
		if ($contadores->ExportAll) {
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
		if ($contadores->Export == "xml") {
			$XmlDoc = new cXMLDocument(EW_XML_ENCODING);
			$XmlDoc->AddRoot();
		} else {
			$ExportDoc = new cExportDocument($contadores, "h");
			$ExportDoc->ExportHeader();
			if ($ExportDoc->Horizontal) { // Horizontal format, write header
				$ExportDoc->BeginExportRow();
				$ExportDoc->ExportCaption($contadores->id);
				$ExportDoc->ExportCaption($contadores->op);
				$ExportDoc->ExportCaption($contadores->zona);
				$ExportDoc->ExportCaption($contadores->descripcion);
				$ExportDoc->ExportCaption($contadores->programa);
				$ExportDoc->ExportCaption($contadores->diahasta);
				$ExportDoc->ExportCaption($contadores->objetivo);
				$ExportDoc->ExportCaption($contadores->op2);
				$ExportDoc->ExportCaption($contadores->horahasta);
				$ExportDoc->ExportCaption($contadores->material);
				$ExportDoc->ExportCaption($contadores->orden);
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
				$contadores->CssClass = "";
				$contadores->CssStyle = "";
				$contadores->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->RenderRow();
				if ($contadores->Export == "xml") {
					$XmlDoc->AddRow();
					$XmlDoc->AddField('id', $contadores->id->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('op', $contadores->op->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('zona', $contadores->zona->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('descripcion', $contadores->descripcion->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('programa', $contadores->programa->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('diahasta', $contadores->diahasta->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('objetivo', $contadores->objetivo->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('op2', $contadores->op2->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('horahasta', $contadores->horahasta->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('material', $contadores->material->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
					$XmlDoc->AddField('orden', $contadores->orden->ExportValue($contadores->Export, $contadores->ExportOriginalValue));
				} else {
					$ExportDoc->BeginExportRow(TRUE); // Allow CSS styles if enabled
					$ExportDoc->ExportField($contadores->id);
					$ExportDoc->ExportField($contadores->op);
					$ExportDoc->ExportField($contadores->zona);
					$ExportDoc->ExportField($contadores->descripcion);
					$ExportDoc->ExportField($contadores->programa);
					$ExportDoc->ExportField($contadores->diahasta);
					$ExportDoc->ExportField($contadores->objetivo);
					$ExportDoc->ExportField($contadores->op2);
					$ExportDoc->ExportField($contadores->horahasta);
					$ExportDoc->ExportField($contadores->material);
					$ExportDoc->ExportField($contadores->orden);
					$ExportDoc->EndExportRow();
				}
			}
			$rs->MoveNext();
		}
		if ($contadores->Export <> "xml")
			$ExportDoc->ExportFooter();

		// Close recordset
		$rs->Close();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write BOM if utf-8
		if ($utf8 && !in_array($contadores->Export, array("email", "xml")))
			echo "\xEF\xBB\xBF";

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		if ($contadores->Export == "xml") {
			header("Content-Type: text/xml");
			echo $XmlDoc->XML();
		} elseif ($contadores->Export == "email") {
			$this->ExportEmail($ExportDoc->Text);
			$this->Page_Terminate($contadores->ExportReturnUrl());
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

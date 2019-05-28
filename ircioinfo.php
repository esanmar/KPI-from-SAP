<?php

// Global variable for table object
$ircio = NULL;

//
// Table class for ircio
//
class circio {
	var $TableVar = 'ircio';
	var $TableName = 'ircio';
	var $TableType = 'TABLE';
	var $cabecera;
	var $orden;
	var $op;
	var $puesto;
	var $contrato;
	var $fechacrea;
	var $horacrea;
	var $fechafin;
	var $horafin;
	var $material;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function circio() {
		global $Language;

		// cabecera
		$this->cabecera = new cField('ircio', 'ircio', 'x_cabecera', 'cabecera', '`cabecera`', 200, -1, FALSE, '`cabecera`', FALSE);
		$this->fields['cabecera'] =& $this->cabecera;

		// orden
		$this->orden = new cField('ircio', 'ircio', 'x_orden', 'orden', '`orden`', 200, -1, FALSE, '`orden`', FALSE);
		$this->fields['orden'] =& $this->orden;

		// op
		$this->op = new cField('ircio', 'ircio', 'x_op', 'op', '`op`', 200, -1, FALSE, '`op`', FALSE);
		$this->fields['op'] =& $this->op;

		// puesto
		$this->puesto = new cField('ircio', 'ircio', 'x_puesto', 'puesto', '`puesto`', 200, -1, FALSE, '`puesto`', FALSE);
		$this->fields['puesto'] =& $this->puesto;

		// contrato
		$this->contrato = new cField('ircio', 'ircio', 'x_contrato', 'contrato', '`contrato`', 200, -1, FALSE, '`contrato`', FALSE);
		$this->fields['contrato'] =& $this->contrato;

		// fechacrea
		$this->fechacrea = new cField('ircio', 'ircio', 'x_fechacrea', 'fechacrea', '`fechacrea`', 200, -1, FALSE, '`fechacrea`', FALSE);
		$this->fields['fechacrea'] =& $this->fechacrea;

		// horacrea
		$this->horacrea = new cField('ircio', 'ircio', 'x_horacrea', 'horacrea', '`horacrea`', 200, -1, FALSE, '`horacrea`', FALSE);
		$this->fields['horacrea'] =& $this->horacrea;

		// fechafin
		$this->fechafin = new cField('ircio', 'ircio', 'x_fechafin', 'fechafin', '`fechafin`', 200, -1, FALSE, '`fechafin`', FALSE);
		$this->fields['fechafin'] =& $this->fechafin;

		// horafin
		$this->horafin = new cField('ircio', 'ircio', 'x_horafin', 'horafin', '`horafin`', 200, -1, FALSE, '`horafin`', FALSE);
		$this->fields['horafin'] =& $this->horafin;

		// material
		$this->material = new cField('ircio', 'ircio', 'x_material', 'material', '`material`', 200, -1, FALSE, '`material`', FALSE);
		$this->fields['material'] =& $this->material;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "ircio_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`ircio`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere = "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return ;
			case "edit":
			case "update":
				return ;
			case "delete":
				return ;
			case "view":
				return ;
			case "search":
				return ;
			default:
				return ;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `ircio` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `ircio` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `ircio` WHERE ";
		$SQL .= ew_QuotedName('orden') . '=' . ew_QuotedValue($rs['orden'], $this->orden->FldDataType) . ' AND ';
		$SQL .= ew_QuotedName('op') . '=' . ew_QuotedValue($rs['op'], $this->op->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`orden` = '@orden@' AND `op` = '@op@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		$sKeyFilter = str_replace("@orden@", ew_AdjustSql($this->orden->CurrentValue), $sKeyFilter); // Replace key value
		$sKeyFilter = str_replace("@op@", ew_AdjustSql($this->op->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "irciolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "irciolist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("ircioview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "ircioadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("ircioedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("ircioadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("irciodelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->orden->CurrentValue)) {
			$sUrl .= "orden=" . urlencode($this->orden->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		if (!is_null($this->op->CurrentValue)) {
			$sUrl .= "&op=" . urlencode($this->op->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=ircio" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->cabecera->setDbValue($rs->fields('cabecera'));
		$this->orden->setDbValue($rs->fields('orden'));
		$this->op->setDbValue($rs->fields('op'));
		$this->puesto->setDbValue($rs->fields('puesto'));
		$this->contrato->setDbValue($rs->fields('contrato'));
		$this->fechacrea->setDbValue($rs->fields('fechacrea'));
		$this->horacrea->setDbValue($rs->fields('horacrea'));
		$this->fechafin->setDbValue($rs->fields('fechafin'));
		$this->horafin->setDbValue($rs->fields('horafin'));
		$this->material->setDbValue($rs->fields('material'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// cabecera

		$this->cabecera->CellCssStyle = ""; $this->cabecera->CellCssClass = "";
		$this->cabecera->CellAttrs = array(); $this->cabecera->ViewAttrs = array(); $this->cabecera->EditAttrs = array();

		// orden
		$this->orden->CellCssStyle = ""; $this->orden->CellCssClass = "";
		$this->orden->CellAttrs = array(); $this->orden->ViewAttrs = array(); $this->orden->EditAttrs = array();

		// op
		$this->op->CellCssStyle = ""; $this->op->CellCssClass = "";
		$this->op->CellAttrs = array(); $this->op->ViewAttrs = array(); $this->op->EditAttrs = array();

		// puesto
		$this->puesto->CellCssStyle = ""; $this->puesto->CellCssClass = "";
		$this->puesto->CellAttrs = array(); $this->puesto->ViewAttrs = array(); $this->puesto->EditAttrs = array();

		// contrato
		$this->contrato->CellCssStyle = ""; $this->contrato->CellCssClass = "";
		$this->contrato->CellAttrs = array(); $this->contrato->ViewAttrs = array(); $this->contrato->EditAttrs = array();

		// fechacrea
		$this->fechacrea->CellCssStyle = ""; $this->fechacrea->CellCssClass = "";
		$this->fechacrea->CellAttrs = array(); $this->fechacrea->ViewAttrs = array(); $this->fechacrea->EditAttrs = array();

		// horacrea
		$this->horacrea->CellCssStyle = ""; $this->horacrea->CellCssClass = "";
		$this->horacrea->CellAttrs = array(); $this->horacrea->ViewAttrs = array(); $this->horacrea->EditAttrs = array();

		// fechafin
		$this->fechafin->CellCssStyle = ""; $this->fechafin->CellCssClass = "";
		$this->fechafin->CellAttrs = array(); $this->fechafin->ViewAttrs = array(); $this->fechafin->EditAttrs = array();

		// horafin
		$this->horafin->CellCssStyle = ""; $this->horafin->CellCssClass = "";
		$this->horafin->CellAttrs = array(); $this->horafin->ViewAttrs = array(); $this->horafin->EditAttrs = array();

		// material
		$this->material->CellCssStyle = ""; $this->material->CellCssClass = "";
		$this->material->CellAttrs = array(); $this->material->ViewAttrs = array(); $this->material->EditAttrs = array();

		// cabecera
		$this->cabecera->ViewValue = $this->cabecera->CurrentValue;
		$this->cabecera->CssStyle = "";
		$this->cabecera->CssClass = "";
		$this->cabecera->ViewCustomAttributes = "";

		// orden
		$this->orden->ViewValue = $this->orden->CurrentValue;
		$this->orden->CssStyle = "";
		$this->orden->CssClass = "";
		$this->orden->ViewCustomAttributes = "";

		// op
		$this->op->ViewValue = $this->op->CurrentValue;
		$this->op->CssStyle = "";
		$this->op->CssClass = "";
		$this->op->ViewCustomAttributes = "";

		// puesto
		$this->puesto->ViewValue = $this->puesto->CurrentValue;
		$this->puesto->CssStyle = "";
		$this->puesto->CssClass = "";
		$this->puesto->ViewCustomAttributes = "";

		// contrato
		$this->contrato->ViewValue = $this->contrato->CurrentValue;
		$this->contrato->CssStyle = "";
		$this->contrato->CssClass = "";
		$this->contrato->ViewCustomAttributes = "";

		// fechacrea
		$this->fechacrea->ViewValue = $this->fechacrea->CurrentValue;
		$this->fechacrea->CssStyle = "";
		$this->fechacrea->CssClass = "";
		$this->fechacrea->ViewCustomAttributes = "";

		// horacrea
		$this->horacrea->ViewValue = $this->horacrea->CurrentValue;
		$this->horacrea->CssStyle = "";
		$this->horacrea->CssClass = "";
		$this->horacrea->ViewCustomAttributes = "";

		// fechafin
		$this->fechafin->ViewValue = $this->fechafin->CurrentValue;
		$this->fechafin->CssStyle = "";
		$this->fechafin->CssClass = "";
		$this->fechafin->ViewCustomAttributes = "";

		// horafin
		$this->horafin->ViewValue = $this->horafin->CurrentValue;
		$this->horafin->CssStyle = "";
		$this->horafin->CssClass = "";
		$this->horafin->ViewCustomAttributes = "";

		// material
		$this->material->ViewValue = $this->material->CurrentValue;
		$this->material->CssStyle = "";
		$this->material->CssClass = "";
		$this->material->ViewCustomAttributes = "";

		// cabecera
		$this->cabecera->HrefValue = "";
		$this->cabecera->TooltipValue = "";

		// orden
		$this->orden->HrefValue = "";
		$this->orden->TooltipValue = "";

		// op
		$this->op->HrefValue = "";
		$this->op->TooltipValue = "";

		// puesto
		$this->puesto->HrefValue = "";
		$this->puesto->TooltipValue = "";

		// contrato
		$this->contrato->HrefValue = "";
		$this->contrato->TooltipValue = "";

		// fechacrea
		$this->fechacrea->HrefValue = "";
		$this->fechacrea->TooltipValue = "";

		// horacrea
		$this->horacrea->HrefValue = "";
		$this->horacrea->TooltipValue = "";

		// fechafin
		$this->fechafin->HrefValue = "";
		$this->fechafin->TooltipValue = "";

		// horafin
		$this->horafin->HrefValue = "";
		$this->horafin->TooltipValue = "";

		// material
		$this->material->HrefValue = "";
		$this->material->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>

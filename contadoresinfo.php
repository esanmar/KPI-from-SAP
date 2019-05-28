<?php

// Global variable for table object
$contadores = NULL;

//
// Table class for contadores
//
class ccontadores {
	var $TableVar = 'contadores';
	var $TableName = 'contadores';
	var $TableType = 'TABLE';
	var $id;
	var $op;
	var $zona;
	var $descripcion;
	var $programa;
	var $diahasta;
	var $objetivo;
	var $op2;
	var $horahasta;
	var $material;
	var $orden;
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
	function ccontadores() {
		global $Language;

		// id
		$this->id = new cField('contadores', 'contadores', 'x_id', 'id', '`id`', 3, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// op
		$this->op = new cField('contadores', 'contadores', 'x_op', 'op', '`op`', 3, -1, FALSE, '`op`', FALSE);
		$this->op->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['op'] =& $this->op;

		// zona
		$this->zona = new cField('contadores', 'contadores', 'x_zona', 'zona', '`zona`', 200, -1, FALSE, '`zona`', FALSE);
		$this->fields['zona'] =& $this->zona;

		// descripcion
		$this->descripcion = new cField('contadores', 'contadores', 'x_descripcion', 'descripcion', '`descripcion`', 200, -1, FALSE, '`descripcion`', FALSE);
		$this->fields['descripcion'] =& $this->descripcion;

		// programa
		$this->programa = new cField('contadores', 'contadores', 'x_programa', 'programa', '`programa`', 200, -1, FALSE, '`programa`', FALSE);
		$this->fields['programa'] =& $this->programa;

		// diahasta
		$this->diahasta = new cField('contadores', 'contadores', 'x_diahasta', 'diahasta', '`diahasta`', 200, -1, FALSE, '`diahasta`', FALSE);
		$this->fields['diahasta'] =& $this->diahasta;

		// objetivo
		$this->objetivo = new cField('contadores', 'contadores', 'x_objetivo', 'objetivo', '`objetivo`', 131, -1, FALSE, '`objetivo`', FALSE);
		$this->objetivo->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['objetivo'] =& $this->objetivo;

		// op2
		$this->op2 = new cField('contadores', 'contadores', 'x_op2', 'op2', '`op2`', 3, -1, FALSE, '`op2`', FALSE);
		$this->op2->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['op2'] =& $this->op2;

		// horahasta
		$this->horahasta = new cField('contadores', 'contadores', 'x_horahasta', 'horahasta', '`horahasta`', 200, -1, FALSE, '`horahasta`', FALSE);
		$this->fields['horahasta'] =& $this->horahasta;

		// material
		$this->material = new cField('contadores', 'contadores', 'x_material', 'material', '`material`', 200, -1, FALSE, '`material`', FALSE);
		$this->fields['material'] =& $this->material;

		// orden
		$this->orden = new cField('contadores', 'contadores', 'x_orden', 'orden', '`orden`', 3, -1, FALSE, '`orden`', FALSE);
		$this->orden->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['orden'] =& $this->orden;
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
		return "contadores_Highlight";
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
		return "`contadores`";
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
		return "INSERT INTO `contadores` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `contadores` SET ";
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
		$SQL = "DELETE FROM `contadores` WHERE ";
		$SQL .= ew_QuotedName('id') . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "contadoreslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "contadoreslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("contadoresview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "contadoresadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("contadoresedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("contadoresadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("contadoresdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=contadores" : "";
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
		$this->id->setDbValue($rs->fields('id'));
		$this->op->setDbValue($rs->fields('op'));
		$this->zona->setDbValue($rs->fields('zona'));
		$this->descripcion->setDbValue($rs->fields('descripcion'));
		$this->programa->setDbValue($rs->fields('programa'));
		$this->diahasta->setDbValue($rs->fields('diahasta'));
		$this->objetivo->setDbValue($rs->fields('objetivo'));
		$this->op2->setDbValue($rs->fields('op2'));
		$this->horahasta->setDbValue($rs->fields('horahasta'));
		$this->material->setDbValue($rs->fields('material'));
		$this->orden->setDbValue($rs->fields('orden'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id

		$this->id->CellCssStyle = ""; $this->id->CellCssClass = "";
		$this->id->CellAttrs = array(); $this->id->ViewAttrs = array(); $this->id->EditAttrs = array();

		// op
		$this->op->CellCssStyle = ""; $this->op->CellCssClass = "";
		$this->op->CellAttrs = array(); $this->op->ViewAttrs = array(); $this->op->EditAttrs = array();

		// zona
		$this->zona->CellCssStyle = ""; $this->zona->CellCssClass = "";
		$this->zona->CellAttrs = array(); $this->zona->ViewAttrs = array(); $this->zona->EditAttrs = array();

		// descripcion
		$this->descripcion->CellCssStyle = ""; $this->descripcion->CellCssClass = "";
		$this->descripcion->CellAttrs = array(); $this->descripcion->ViewAttrs = array(); $this->descripcion->EditAttrs = array();

		// programa
		$this->programa->CellCssStyle = ""; $this->programa->CellCssClass = "";
		$this->programa->CellAttrs = array(); $this->programa->ViewAttrs = array(); $this->programa->EditAttrs = array();

		// diahasta
		$this->diahasta->CellCssStyle = ""; $this->diahasta->CellCssClass = "";
		$this->diahasta->CellAttrs = array(); $this->diahasta->ViewAttrs = array(); $this->diahasta->EditAttrs = array();

		// objetivo
		$this->objetivo->CellCssStyle = ""; $this->objetivo->CellCssClass = "";
		$this->objetivo->CellAttrs = array(); $this->objetivo->ViewAttrs = array(); $this->objetivo->EditAttrs = array();

		// op2
		$this->op2->CellCssStyle = ""; $this->op2->CellCssClass = "";
		$this->op2->CellAttrs = array(); $this->op2->ViewAttrs = array(); $this->op2->EditAttrs = array();

		// horahasta
		$this->horahasta->CellCssStyle = ""; $this->horahasta->CellCssClass = "";
		$this->horahasta->CellAttrs = array(); $this->horahasta->ViewAttrs = array(); $this->horahasta->EditAttrs = array();

		// material
		$this->material->CellCssStyle = ""; $this->material->CellCssClass = "";
		$this->material->CellAttrs = array(); $this->material->ViewAttrs = array(); $this->material->EditAttrs = array();

		// orden
		$this->orden->CellCssStyle = ""; $this->orden->CellCssClass = "";
		$this->orden->CellAttrs = array(); $this->orden->ViewAttrs = array(); $this->orden->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// op
		$this->op->ViewValue = $this->op->CurrentValue;
		$this->op->CssStyle = "";
		$this->op->CssClass = "";
		$this->op->ViewCustomAttributes = "";

		// zona
		$this->zona->ViewValue = $this->zona->CurrentValue;
		$this->zona->CssStyle = "";
		$this->zona->CssClass = "";
		$this->zona->ViewCustomAttributes = "";

		// descripcion
		$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
		$this->descripcion->CssStyle = "";
		$this->descripcion->CssClass = "";
		$this->descripcion->ViewCustomAttributes = "";

		// programa
		$this->programa->ViewValue = $this->programa->CurrentValue;
		$this->programa->CssStyle = "";
		$this->programa->CssClass = "";
		$this->programa->ViewCustomAttributes = "";

		// diahasta
		if (strval($this->diahasta->CurrentValue) <> "") {
			switch ($this->diahasta->CurrentValue) {
				case "Lunes":
					$this->diahasta->ViewValue = "Lunes";
					break;
				case "Martes":
					$this->diahasta->ViewValue = "Martes";
					break;
				case "Miercoles":
					$this->diahasta->ViewValue = "Miercoles";
					break;
				case "Jueves":
					$this->diahasta->ViewValue = "Jueves";
					break;
				case "Viernes":
					$this->diahasta->ViewValue = "Viernes";
					break;
				case "Sabado":
					$this->diahasta->ViewValue = "Sabado";
					break;
				case "Domingo":
					$this->diahasta->ViewValue = "Domingo";
					break;
				default:
					$this->diahasta->ViewValue = $this->diahasta->CurrentValue;
			}
		} else {
			$this->diahasta->ViewValue = NULL;
		}
		$this->diahasta->CssStyle = "";
		$this->diahasta->CssClass = "";
		$this->diahasta->ViewCustomAttributes = "";

		// objetivo
		$this->objetivo->ViewValue = $this->objetivo->CurrentValue;
		$this->objetivo->CssStyle = "";
		$this->objetivo->CssClass = "";
		$this->objetivo->ViewCustomAttributes = "";

		// op2
		$this->op2->ViewValue = $this->op2->CurrentValue;
		$this->op2->CssStyle = "";
		$this->op2->CssClass = "";
		$this->op2->ViewCustomAttributes = "";

		// horahasta
		$this->horahasta->ViewValue = $this->horahasta->CurrentValue;
		$this->horahasta->CssStyle = "";
		$this->horahasta->CssClass = "";
		$this->horahasta->ViewCustomAttributes = "";

		// material
		$this->material->ViewValue = $this->material->CurrentValue;
		$this->material->CssStyle = "";
		$this->material->CssClass = "";
		$this->material->ViewCustomAttributes = "";

		// orden
		$this->orden->ViewValue = $this->orden->CurrentValue;
		$this->orden->CssStyle = "";
		$this->orden->CssClass = "";
		$this->orden->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// op
		$this->op->HrefValue = "";
		$this->op->TooltipValue = "";

		// zona
		$this->zona->HrefValue = "";
		$this->zona->TooltipValue = "";

		// descripcion
		$this->descripcion->HrefValue = "";
		$this->descripcion->TooltipValue = "";

		// programa
		$this->programa->HrefValue = "";
		$this->programa->TooltipValue = "";

		// diahasta
		$this->diahasta->HrefValue = "";
		$this->diahasta->TooltipValue = "";

		// objetivo
		$this->objetivo->HrefValue = "";
		$this->objetivo->TooltipValue = "";

		// op2
		$this->op2->HrefValue = "";
		$this->op2->TooltipValue = "";

		// horahasta
		$this->horahasta->HrefValue = "";
		$this->horahasta->TooltipValue = "";

		// material
		$this->material->HrefValue = "";
		$this->material->TooltipValue = "";

		// orden
		$this->orden->HrefValue = "";
		$this->orden->TooltipValue = "";

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

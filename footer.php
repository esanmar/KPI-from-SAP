<?php if (@$gsExport == "") { ?>
				<p>&nbsp;</p>			
			<!-- right column (end) -->
			<?php if (isset($gsTimer)) $gsTimer->Stop() ?>
	    </td>	
		</tr>
	</table>
	<!-- content (end) -->	
	<!-- footer (begin) --><!-- *** Note: Only licensed users are allowed to remove or change the following copyright statement. *** -->
	<div class="ewFooterRow">	
		<div class="ewFooterText">&nbsp;<?php echo $Language->ProjectPhrase("FooterText") ?></div>
		<!-- Place other links, for example, disclaimer, here -->		
	</div>
	<!-- footer (end) -->	
</div>
<div class="yui-tt" id="ewTooltipDiv" style="visibility: hidden; border: 0px;" name="ewTooltipDivDiv"></div>
<?php } ?>
<script type="text/javascript">
<!--
<?php if (@$gsExport == "" || @$gsExport == "print") { ?>
ewDom.getElementsByClassName(EW_TABLE_CLASS, "TABLE", null, ew_SetupTable); // init the table
<?php } ?>
<?php if (@$gsExport == "") { ?>
<?php } ?>

//-->
</script>
<?php if (@$gsExport == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your global startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
</body>
</html>

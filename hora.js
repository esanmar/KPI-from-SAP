<script type="text/javascript">
var d = new Date();
var hours=d.getHours();
if ((hours > 4) && (hours < 13)) {
	document.write("Actualizado a las 5:00");
} else if ((hours > 12) && (hours < 21)) {
	document.write("Actualizado a las 13:00");
} else  if (hours > 20 && (hours < 5)) {
	document.write("Actualizado a las 21:00");
}
</script>
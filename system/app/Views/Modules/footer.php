<script>
const base_url = "<?= base_url()?>";
var page_link = "<?= $data['page_link']?>";
if (document.querySelector("." + page_link)) {
	var activar = document.querySelector("." + page_link);
	var page_menu_open = "<?= $data['page_menu_open']?>";
	activar.classList.add('activo');

}
if (document.querySelector("." + page_menu_open)) {
	var page_link_acitvo = "<?= $data['page_link_acitvo']?>";
	var activarMenu = document.querySelector("." + page_menu_open);
	var activarLink = document.querySelector("." + page_link_acitvo);
	activarMenu.classList.add('menu-is-opening');
	activarMenu.classList.add('menu-open');
	activarLink.classList.add('activo');
}
</script>
<script src="<?= PLUGINS ?>js/jquery.min.js"></script>
<script src="<?= PLUGINS?>js/sweetalert2@10.js"></script>
<script src="<?= PLUGINS ?>js/bootstrap.bundle.min.js"></script>
<script src="<?= PLUGINS ?>js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= PLUGINS ?>js/bootstrap-select.min.js"></script>
<script src="<?= PLUGINS ?>js/jquery.dataTables.min.js"></script>
<script src="<?= PLUGINS ?>js/dataTables.bootstrap4.min.js"></script>
<script src="<?= PLUGINS ?>js/dataTables.responsive.min.js"></script>
<script src="<?= PLUGINS ?>js/responsive.bootstrap4.min.js"></script>
<script src="<?= PLUGINS ?>js/dataTables.buttons.min.js"></script>
<script src="<?= PLUGINS ?>js/buttons.bootstrap4.min.js"></script>
<script src="<?= PLUGINS ?>js/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.10/pdfmake.min.js"></script>
<script src="<?= PLUGINS ?>js/vfs_fonts.js"></script>
<script src="<?= PLUGINS ?>js/buttons.html5.min.js"></script>
<script src="<?= PLUGINS ?>js/buttons.print.min.js"></script>
<script src="<?= PLUGINS ?>js/buttons.colVis.min.js"></script>s
<script src="<?= PLUGINS ?>js/adminlte.js"></script>
<script src="<?= JS ?>function.main.js"></script>
<script src="<?= JS.$data['page_functions']?>"></script>

</body>

</html>
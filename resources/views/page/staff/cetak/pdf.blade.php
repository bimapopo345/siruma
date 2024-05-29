@foreach($data as $dt)
<?php  
$path_template_print = 'page/desa/template/'.$dt->singkatan_template.'/'.$dt->urutan_template.'/print';
?>
@include($path_template_print)
@endforeach
<!-- Page Cetak Surat PDF Stream -->

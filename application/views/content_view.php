<div class="container-fluid ajaxload">
	<div class="row">
		<?php 
		if ($this->session->userdata('logado')!==true) {
			echo 'nao logado';
		} else {
			echo 'logado';
		}
		?>
	</div>
</div><!-- /.container -->
<div class="container ajaxload">
	<div class="row">
		<div class="col-lg-12">
			<p>
				<?php 
					if ($this->session->userdata('logado')!==true) {
						echo 'nao logado';
					} else {
						echo 'logado';
					}
				?>
			</p>
		</div>
	</div>
</div><!-- /.container -->
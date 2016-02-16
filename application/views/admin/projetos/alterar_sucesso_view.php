<div class="container ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<!-- <div class="col-lg-4"></div> -->
	<div class="col-lg-12 col-md-12">
		<div class="well">
			<p class="projetos-sucesso">
				O projeto <strong><?php echo $projeto['titulo']; ?></strong> foi alterado com sucesso.
			</p>
		</div>
	</div>
	<!-- <div class="col-lg-4"></div> -->
</div>
<?php } ?>
</div><!-- /.container -->
<div class="container ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<!-- <div class="col-lg-4"></div> -->
	<div class="col-lg-12 col-md-12">
		<div class="well">
			<p class="tarefas-sucesso bg-success">
				A tarefa <strong><?php echo $tarefa['titulo']; ?></strong> foi criada com sucesso.
			</p>
		</div>
		<a href="<?php echo base_url() . 'tarefa/adicionar/' . $tarefa['codigo_projeto']; ?>" class="btn btn-primary btn-medium" role="button">Adicionar mais tarefas ao projeto</a>
	</div>
	<!-- <div class="col-lg-4"></div> -->
</div>
<?php } ?>
</div><!-- /.container -->
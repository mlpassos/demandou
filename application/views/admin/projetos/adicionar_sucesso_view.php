<div class="container ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<!-- <div class="col-lg-4"></div> -->
	<div class="col-lg-12 col-md-12">
		<div class="well">
			<p class="projetos-sucesso bg-success">
				O projeto <strong><?php echo $projeto['titulo']; ?></strong> foi criado com sucesso.
			</p>
		</div>
<<<<<<< HEAD
		<?php 
		// $hidden = array("adicionar_ao_projeto"=>$codigo_projeto);
		// echo form_open('tarefa/adicionar', ["id" => "frmTarefa-AdicionarAoProjeto", "class" => "tarefa-adicionar-ao-projeto", "role" => "form"], $hidden); 
		$data = array('codigo_projeto'=>$codigo_projeto);
		// i store data to flashdata
		$this->session->set_flashdata('adicionar_ao_projeto',$data);
		// after storing i redirect it to the controller
		//redirect(base_url() . 'tarefa/adicionar/');
		?>
		<!-- . $codigo_projeto; -->
		<a href="<?php echo base_url() . 'tarefa/adicionar'; ?>" class="btn btn-primary btn-medium" role="button">Adicionar tarefas ao projeto</a>
		<!-- <button type="submit" class="btn btn-default">Adicionar tarefas ao projeto</button> -->
		<?php //echo form_close(); ?>
=======
		<a href="<?php echo base_url() . 'tarefa/adicionar/' . $codigo_projeto; ?>" class="btn btn-primary btn-medium" role="button">Adicionar tarefas ao projeto</a>
>>>>>>> origin/master
	</div>
	<!-- <div class="col-lg-4"></div> -->
</div>
<?php } ?>
</div><!-- /.container -->
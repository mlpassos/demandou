<div class="container ajaxload">

<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<div class="col-lg-12 text-right">
		<a href="<?php echo base_url(); ?>usuario/adicionar" class="btn btn-primary btn-large" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar usuário</a>
		<hr>
	</div>
</div>
<div class="row tarefas-grid">
	<?php foreach($usuarios as $usuario) { ?>
	<div class="cor-coluna col-lg-4 col-md-3 col-sm-4 col-xs-12">
		<div class="tarefas-box thumbnail">
			<img class="img-circle" src="<?php echo base_url() . '/uploads/' . $usuario["arquivo_avatar"] ; ?>" alt="..." >
			<div class="caption text-center">
		        <h4><?php echo $usuario['nome'] . ' ' . $usuario['sobrenome']; ?></h4>
		        <!-- <hr> -->
		        <p id="tarefas-descricao-1" class="teste">
		        	<?php echo $usuario['titulo']; ?>
		        </p>
		    	<p>
		    		<a href="#" class="btn btn-primary btn-xs" role="button" data-codigotarefa="<?php echo $usuario['nome']; ?>" data-toggle="modal" data-target="#myModalTarefaVer">
  						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
		    		</a> 
		    		<a href="#" class="btn btn-primary btn-xs" role="button" data-codigotarefa="<?php echo $usuario['nome']; ?>" data-toggle="modal" data-target="#myModalTarefaAdicionar">
  						<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
		    		</a> 
		    		<button type="button" class="close tarefas-remover" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    	</p>
		    </div>
		</div>
	</div>
	<?php } ?>
</div>
<?php } ?>
</div><!-- /.container -->
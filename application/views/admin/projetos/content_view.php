<div class="container-fluid ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<div class="col-lg-12 text-right">
		<a href="<?php echo base_url(); ?>projeto/adicionar" class="btn btn-primary btn-large" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar projeto</a>
		<hr>
	</div>
</div>
<div class="row tarefas-grid">
<<<<<<< HEAD
	<!-- <pre> -->
	<?php //var_dump($projetos); ?>
	<!-- </pre> -->
	<?php 
	// echo "user: " . $this->session->userdata('codigo_ususario');
	foreach($projetos as $p) { ?>
=======
	<!-- <pre>
	<?php var_dump($projetos); ?>
	</pre> -->
	<?php foreach($projetos as $p) { ?>
>>>>>>> origin/master
	<div class="cor-coluna col-lg-2 col-md-3 col-sm-4 col-xs-12">
		<!-- <div class="tarefas-box <?php //if ( strtotime($p['data_prazo']) < strtotime('now') ) { echo 'bg-danger'; } else { echo 'bg-info'; } ?>"> -->
			<?php 
				switch ($p['prioridade']) {
	        		case '3':
	        			$prioridadesClass = 'bg-danger';
	        			break;
	        		case '2':
	        			$prioridadesClass = 'bg-warning';
	        			break;
	        		case '1':
	        			$prioridadesClass = 'bg-success';
	        			break;
	        		default:
	        			$prioridadesClass = 'bg-info';
	        			break;
	        	}
			?>
			<div class="tarefas-box <?php echo $prioridadesClass; ?>">
			<!-- <img src="http://placehold.it/60x60" alt="..." class="img-circle"> -->
			<div class="caption">
		        <h3><?php echo $p['titulo'];?></h3>
		        <hr>
		        <p id="tarefas-descricao-1" class="teste">
		        	<?php 
		        	$this->load->helper('text');
		        	echo word_limiter($p['descricao'],20);
<<<<<<< HEAD
		        	// echo $p['descricao'];
=======
>>>>>>> origin/master
		        	?> 
		        </p>
		        <p id="tarefas-descricao-1" class="teste">
		        	<?php 
		        	$this->load->helper('date');
<<<<<<< HEAD
		        	$timestamp = strtotime($p['data_inicio']);
					$now = time();
					if( strtotime($p['data_inicio']) < strtotime('now') ) {
						echo 'Começou há: ' . timespan($timestamp, $now);
					} else {
						echo 'Começa em: ' . timespan($now, $timestamp);
					}
					echo "<br>";
					$timestamp = strtotime($p['data_prazo']);
=======
		        	$timestamp = strtotime($p['data_prazo']);
>>>>>>> origin/master
					$now = time();
					if( strtotime($p['data_prazo']) < strtotime('now') ) {
						echo 'atrasado';
					} else {
<<<<<<< HEAD
						echo 'Termina em: ' . timespan($now, $timestamp);
=======
						echo timespan($now, $timestamp);
>>>>>>> origin/master
					}
		        	?> 
		        </p>
		    	<p>
		    		
		    		<a href="#" class="btn btn-primary btn-xs" role="button" data-codigotarefa="<?php echo $p['titulo']; ?>" data-toggle="modal" data-target="#myModalTarefaVer">
  						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 
		    		</a> 
		    		<a href="#" class="btn btn-primary btn-xs" role="button" data-codigotarefa="<?php echo $p['titulo']; ?>" data-toggle="modal" data-target="#myModalTarefaAdicionar">
  						<span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>
		    		</a> 
		    		 
		    	</p>
		    </div>
		</div>
	</div>
	<?php }; ?>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalTarefaVer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal Ver</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Gravar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalTarefaAdicionar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal Adicionar</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Gravar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalAdicionarProjeto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adicionar Projeto</h4>
      </div>
      <div class="modal-body">
        <form>
        	<div class="form-head">
			  <div class="form-group">
			    <label for="projeto-titulo">Título</label>
			    <input type="text" class="form-control" id="projeto-titulo" placeholder="Email">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Prazo</label>
			    <input type="date" class="form-control" id="exampleInputPassword1" placeholder="Prazo">
			  </div>
			  <div class="radios">
			  	  <label for="inlineRadioOptions">Prioridade</label><br>
				  <label class="radio-inline">
					  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Baixa
				  </label>
				  <label class="radio-inline">
				    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Média
				  </label>
				  <label class="radio-inline">
				    <input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> Alta
				  </label>
			  </div>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Descrição</label>
			    <textarea class="form-control" id="exampleInputEmail1"></textarea>
			  </div>
			</div>
			<div class="form-head-next">
			  	<div class="tarefas-container">
					<ul class="tarefas-menu">
						<li class="tarefas-item">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit.
							<span class="tarefas-remover glyphicon glyphicon-remove"></span>
						</li>
						<li class="tarefas-item">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit.
							<span class="tarefas-remover glyphicon glyphicon-remove"></span>
						</li>
						<li class="tarefas-item">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit.
							<span class="tarefas-remover glyphicon glyphicon-remove"></span>
						</li>
						<li class="tarefas-item">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit.
							<span class="tarefas-remover glyphicon glyphicon-remove"></span>
						</li>
					</ul>
					<form action="">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Descrição tarefa</label>
					    <textarea class="form-control" id="exampleInputEmail1"></textarea>
					  </div>
					  <button type="submit" class="btn btn-default">Adicionar</button>				
					</form>
				</div>
			</div>
		  <button id="projeto-gravar" type="button" class="btn btn-primary">
		  	<span class="glyphicon glyphicon-floppy-disk"></span> Gravar
		  </button>
		  <button id="projeto-add-tarefa" type="button" class="btn btn-default">
		  	<span class="glyphicon glyphicon-tasks"></span> Tarefas
		  </button>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <!-- <button type="button" class="btn btn-primary">Gravar</button> -->
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div><!-- /.container -->
<div class="container ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<div class="tarefas-add-box col-lg-9 col-md-9">
		
		<div class="col-lg-12 col-md-12">
			<?php 
			 // echo "<pre>";
			 //   var_dump($this->session->flashdata('adicionar_ao_projeto'));
			 // echo "</pre>";
			 //  echo "<pre>";
			 //   var_dump($usuarios);
			 // echo "</pre>";
			$hidden = array("codigo_projeto"=>$codigo_projeto);
			echo form_open('tarefa/adicionar', ["id" => "frmTarefa-Adicionar", "class" => "tarefa-adicionar", "role" => "form"], $hidden); ?>
			  <div class="form-group">
			    <label for="titulo">Título</label>
			    <?php 
			    	echo form_error('titulo'); 	
			    ?>
			    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo set_value('titulo'); ?>" placeholder="Título">
			  </div>
			  <div class="form-group">
			    <label for="descricao">Descrição</label>
			    <?php 
			    	echo form_error('descricao'); 
				$props = array(
					"class" => "form-control",
					"id" => "descricao",
					"name" => "descricao",
					"value" => set_value('descricao'),
					"placeholder" => "descricao",
					"rows" => "3"
				);
			    echo form_textarea($props);
			    ?>
			  </div>
		</div>
		<div class="col-lg-6 col-md-6">
			  <div class="form-group">
			    <label for="data_inicio">Início</label>
			    <?php 
			    	echo form_error('data_inicio'); 
			    ?>
			    <input type="date" class="form-control" min="<?php echo $usuarios[0]['data_inicio']; ?>" max="<?php echo $usuarios[0]['data_prazo']; ?>" id="data_inicio" name="data_inicio">
			  </div>
		</div>
		<div class="col-lg-6 col-md-6">
			  <div class="form-group">
			    <label for="data_prazo">Prazo</label>
			    <?php 
			    	echo form_error('data_prazo'); 
			    ?>
			    <input type="date" class="form-control" min="" max="<?php echo $usuarios[0]['data_prazo']; ?>" id="data_prazo" name="data_prazo">
			  </div>
		</div>
		<div class="col-lg-12 col-md-12">
			<hr>
		</div>
		
		<div class="col-lg-6 col-md-6">
			  <div class="form-group">
			    <label for="lider">Líder</label>
			    <?php 
			    	echo form_error('lider');
			    ?>
			    <!-- <input type="text" class="form-control" id="lider" name="lider" placeholder="Líder do projeto..."> -->
			    <select id="lider" name="lider" multiple="multiple" class="form-control">
				  <?php 
				    // var_dump($usuarios);
				  	foreach($usuarios as $u) {
				  		echo "<option value='" . $u['codigo'] . "'>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";
				  	}
				  ?>
				</select>
			  </div>
		</div>
		<div class="col-lg-6 col-md-6">
			  <div class="form-group">
			    <label for="participantes">Participantes</label>
			    <?php 
		    		echo form_error('participantes[]');
			    ?>
			    <select id="participantes" name="participantes[]" multiple="multiple" class="form-control">
				  <?php 
				    // var_dump($usuarios);
				  	foreach($usuarios as $u) {
				  		echo "<option value='" . $u['codigo'] . "'>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";
				  	}
				  ?>
				</select>
			    <!-- <input type="text" class="form-control" id="participantes" name="participantes" placeholder="Nome"> -->
			  </div>
		</div>
		<div class="col-lg-12 col-md-12">
			<button type="submit" class="btn btn-default">Adicionar</button>
		</div>
		<?php echo form_close(); ?>
	</div>
<!-- </div> -->
<!-- <div class="row"> -->
	<div class="tarefas-added-box bg-info col-lg-3 col-md-3">
		<h3>Tarefas do Projeto</h3>
		<?php 
		
		if ( sizeof($tarefas) !== 0) {
			foreach ($tarefas as $t) {?>
			<hr>
			<div class="media">
			  <div class="media-left">
			   <!--  <a href="#">
			      <img class="media-object" src="http://placehold.it/80x80" alt="...">
			    </a> -->
			    <p class="tarefa-dia">
			    	<?php 
					    $timestamp = strtotime($t['data_prazo']);
						echo date("d", $timestamp);
				    ?>
				</p>
			    <p class="tarefa-mes">
			    	<?php 
			    		echo date("M", $timestamp);?>|<?php echo date("Y", $timestamp);
			    	?>
			    </p>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading"><?php echo $t['titulo']; ?></h4>
			    <p>
			    <?php 
			    $this->load->helper('text');
		        echo word_limiter($t['descricao'],10);
			    // echo $t['descricao']; 
			    ?>
			    </p>
			    
			  </div>
			 <!--  <div class="media-footer">
			  	<p>
			    	<span class="glyphicon glyphicon-user"></span> Márcio Passos
			    </p>
			  </div> -->
			</div>
		<?php 
			}
		} else {
			echo "Ainda sem tarefas.";
		}
		?>
	</div>
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
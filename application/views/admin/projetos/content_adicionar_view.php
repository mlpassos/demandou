<div class="container ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<?php echo form_open('projeto/adicionar', ["id" => "frmProjeto-Adicionar", "class" => "projeto-adicionar", "role" => "form"]); ?>
		  <div class="form-group">
		    <label for="titulo">Título</label>
		    <?php echo form_error('titulo'); ?>
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
	<div class="col-lg-12 col-md-12">
		<div class="form-group">
			<label class="radio-inline">
			  <input type="radio" name="prioridade" id="prioridade1" value="3"> <span class="prioridades-radio bg-danger">ALTA</span>
			</label>
			<label class="radio-inline">
			  <input type="radio" name="prioridade" id="prioridade2" value="2"> <span class="prioridades-radio bg-warning">MÉDIA</span>
			</label>
			<label class="radio-inline">
			  <input type="radio" name="prioridade" id="prioridade3" value="1"> <span class="prioridades-radio bg-success">BAIXA</span>
			</label>
		</div>
	</div>
	<div class="col-lg-6 col-md-6">
		  <div class="form-group">
		    <label for="data_nascimento">Início</label>
		    <?php echo form_error('data_inicio'); ?>
		    <input type="date" class="form-control" id="data_inicio" name="data_inicio" placeholder="Nome">
		  </div>
	</div>
	<div class="col-lg-6 col-md-6">
		  <div class="form-group">
		    <label for="data_nascimento">Prazo</label>
		    <?php echo form_error('data_prazo'); ?>
		    <input type="date" class="form-control" id="data_prazo" name="data_prazo" placeholder="Nome">
		  </div>
	</div>
	<div class="col-lg-12 col-md-12">
		<hr>
	</div>
	
	<div class="col-lg-6 col-md-6">
		  <div class="form-group">
		    <label for="lider">Líder</label>
		    <?php echo form_error('lider'); ?>
		    <!-- <input type="text" class="form-control" id="lider" name="lider" placeholder="Líder do projeto..."> -->
		    <select id="lider" name="lider" multiple="multiple" class="form-control">
			  <?php 
			    // var_dump($usuarios);
			  	foreach($usuarios as $u) {
			  		if ($u['codigo']==6) {
			  			echo "<option value='" . $u['codigo'] . "' selected>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";	
			  		} else {
			  			echo "<option value='" . $u['codigo'] . "'>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";
			  		}
			  		
			  	}
			  ?>
			</select>
		  </div>
	</div>
	<div class="col-lg-6 col-md-6">
		  <div class="form-group">
		    <label for="participantes">Participantes</label>
		    <?php echo form_error('participantes'); ?>
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
		<button type="submit" class="btn btn-default">Gravar</button>
	</div>

		<?php echo form_close(); ?>
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
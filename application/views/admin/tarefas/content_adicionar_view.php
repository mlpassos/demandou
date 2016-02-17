<div class="container ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<!-- <div class="row">
	<div class="tarefas-add-box col-lg-9 col-md-9">
		
		<div class="col-lg-12 col-md-12">
			<?php 
			 // echo "<pre>";
			 //   var_dump($this->session->flashdata('adicionar_ao_projeto'));
			 // echo "</pre>";
			 //  echo "<pre>";
			 //   var_dump($usuarios);
			 // echo "</pre>";
			?>
		</div> -->
<div class="row">
	<div class="tarefas-add-box col-lg-9 col-md-9">
			<?php 
				$hidden = array("codigo_projeto"=>$codigo_projeto);
				echo form_open('tarefa/adicionar', ["id" => "frmTarefa-Adicionar", "class" => "tarefa-adicionar", "role" => "form"], $hidden); ?>
		<div class="col-lg-12 col-md-12">
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
		<div class="col-lg-12 col-md-6">
			  <div class="form-group">
			    <label for="lider">Líder</label>
			    <?php echo form_error('lider'); ?>
			    <select id="lider" name="lider" multiple="multiple" class="form-control">
				  <?php 
				  	foreach($usuarios as $u) {
				  		echo "<option value='" . $u['codigo'] . "'>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";
				  	}
				  ?>
				</select>
			  </div>
		</div>
		<div class="col-lg-12 col-md-12">
			<div class="form-group">
				<label for="codigo_status">Status</label><br>
				<label class="radio-inline">
					<input type="radio" name="codigo_status" id="codigo_status" value="1" checked="checked"> Ativado
				</label>
				<label class="radio-inline">
					<input type="radio" name="codigo_status" id="codigo_status" value="0"> Desativado
				</label>
			</div>
		</div>
		<div class="col-lg-12 col-md-12">
			<button type="submit" class="btn btn-default">Adicionar</button>
		</div>
		<?php echo form_close(); ?>
	</div>
	<div class="tarefas-added-box col-lg-3 col-md-3">
		<h3>Tarefas do Projeto</h3>
		<?php 
		if ( sizeof($tarefas) !== 0) {
     		foreach ($tarefas as $t) {?>
			<!-- <hr> -->
			<?php 
				switch ($t['prioridade']) {
	    		case '3':
	    			$prioridadesClass = 'prioridade-alta';
	    			break;
	    		case '2':
	    			$prioridadesClass = 'prioridade-media';
	    			break;
	    		case '1':
	    			$prioridadesClass = 'prioridade-baixa';
	    			break;
	    		default:
	    			$prioridadesClass = 'bg-info';
	    			break;
	    	}
		  ?>
			<div class="tarefas-added-box-postit media">
			  <div class="media-left">
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
			    <h4 class="media-heading <?php echo $prioridadesClass; ?>"><?php echo $t['titulo']; ?></h4>
			    <p>
			    <?php 
			    $this->load->helper('text');
		        echo word_limiter($t['descricao'],10);
			    // echo $t['descricao']; 
			    ?>
			    </p>
			  <!-- </div> -->
			  <!-- <div class="media-right"> -->
			  	<img class="tarefas-box-lider-img lider-thumbs img-circle" src="<?php echo base_url() . 'uploads/' . $t['arquivo_avatar'] ?>" alt="imagem do avatar do líder da tarefa">
			  	<!-- <br>
			  	<small><?php echo $t['nome']; ?></small> -->
			  </div>
			</div>
		<?php 
			}
		} else {
			echo "Ainda sem tarefas.";
		}
		?>
	</div>
</div>
<?php } ?>
</div><!-- /.container -->
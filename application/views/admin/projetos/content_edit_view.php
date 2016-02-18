<div class="container ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<div class="col-lg-12 col-md-12">
		<?php 
			 // var_dump($projeto[0]['titulo']);
			 // echo "<pre>";
			 // 	var_dump($lider);
			 // echo "</pre>";
			 // echo "<pre>";
			 // 	var_dump($usuarios);
			 // echo "</pre>";
			// foreach ($projeto as $p) {
			// 	# code...
			// 	echo $p['titulo'];
			// }
		?>
		<?php 
	  $hidden = array("codigo" => $projeto[0]['codigo']);
		echo form_open('projeto/alterar', ["id" => "frmProjeto-Adicionar", "class" => "projeto-adicionar", "role" => "form"], $hidden); ?>
		  <div class="form-group">
		    <label for="titulo">Título</label>
		    <?php echo form_error('titulo'); ?>
		    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $projeto[0]['titulo']; ?>" placeholder="Título">
		  </div>
		  <div class="form-group">
		    <label for="descricao">Descrição</label>
		    <?php 
		    echo form_error('descricao'); 
			$props = array(
				"class" => "form-control",
				"id" => "descricao",
				"name" => "descricao",
				"value" => $projeto[0]['descricao'],
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
			  <input type="radio" name="prioridade" id="prioridade1" value="3" <?php if ($projeto[0]['prioridade']==3) { echo " checked"; } ?> > <span class="prioridades-radio bg-danger">ALTA</span>
			</label>
			<label class="radio-inline">
			  <input type="radio" name="prioridade" id="prioridade2" value="2" <?php if ($projeto[0]['prioridade']==2) { echo " checked"; } ?>> <span class="prioridades-radio bg-warning">MÉDIA</span>
			</label>
			<label class="radio-inline">
			  <input type="radio" name="prioridade" id="prioridade3" value="1" <?php if ($projeto[0]['prioridade']==1) { echo " checked" ; } ?>> <span class="prioridades-radio bg-success">BAIXA</span>
			</label>
		</div>
	</div>
	<div class="col-lg-6 col-md-6">
		  <div class="form-group">
		    <label for="data_nascimento">Início</label>
		    <?php echo form_error('data_inicio'); ?>
		    <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo $projeto[0]['data_inicio'] ?>">
		  </div>
	</div>
	<div class="col-lg-6 col-md-6">
		  <div class="form-group">
		    <label for="data_nascimento">Prazo</label>
		    <?php echo form_error('data_prazo'); ?>
		    <input type="date" class="form-control" id="data_prazo" name="data_prazo" value="<?php echo $projeto[0]['data_prazo'] ?>">
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
			  		if ($u['codigo']==$this->session->userdata('codigo_usuario')) {
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
			  	$ray = array();
			  	$rayLider = array();
		  		foreach($participantes as $par) {
		  			array_push($ray,$par['codigo']);
		  		}
		  		foreach($lider as $l) {
		  			array_push($rayLider,$l['codigo']);
		  		}
		  		foreach($usuarios as $u) {
			  		if (in_array($u['codigo'], $ray)) {
			  			echo "<option value='" . $u['codigo'] . "' selected>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";
			  		} else {
			  			if (!in_array($u['codigo'], $rayLider)) {
			  				echo "<option value='" . $u['codigo'] . "'>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";
			  			}
			  		}
		  		}
			  ?>
			</select>
		    <!-- <input type="text" class="form-control" id="participantes" name="participantes" placeholder="Nome"> -->
		  </div>
	</div>
	<div class="col-lg-12">
		<hr>
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
		<button type="submit" class="btn btn-default">Gravar</button>
	</div>
		<?php echo form_close(); ?>
</div>
<?php } ?>
</div><!-- /.container -->
<div class="container ajaxload">
<?php if ($usuario['logado']==true) { ?>
<div class="row">
	<!-- <div class="col-lg-4"></div> -->
	<div class="col-lg-12 col-md-12">
		<?php echo form_open_multipart('usuario/adicionar', ["id" => "frmUsuario-Adicionar", "class" => "usuario-adicionar", "role" => "form"]); ?>
		  <div class="form-group">
		    <label for="nome">Nome</label>
		    <?php echo form_error('nome'); ?>
		    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo set_value('nome'); ?>" placeholder="Nome">
		  </div>
		  <div class="form-group">
		    <label for="sobrenome">Sobrenome</label>
		    <?php echo form_error('sobrenome'); ?>
		    <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Sobrenome">
		  </div>
		  <div class="form-group">
		    <label for="codigo_funcao">Função</label>
		    <?php 
		    // $arrRes = array("escolha"=>"escolha");
		    foreach ($funcao as $f) {
		    	$arrRes[$f['codigo']] = $f['titulo'];
		    }
		    echo form_dropdown('codigo_funcao', $arrRes, set_value('codigo_funcao'), array('id'=>'codigo_funcao','class'=>'form-control')); 
		    ?>
		  </div>
		  <div class="form-group">
		    <label for="data_nascimento">Data de nascimento</label>
		    <?php echo form_error('data_nascimento'); ?>
		    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="Nome">
		  </div>
		  <div class="form-group">
		    <label for="email">E-mail</label>
		    <?php echo form_error('email'); ?>
		    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
		  </div>
		  <div class="form-group">
		    <label for="login">Apelido (Login)</label>
		    <?php echo form_error('login'); ?>
		    <input type="text" class="form-control" id="login" name="login" placeholder="Apelido">
		  </div>
		  <div class="form-group">
		    <label for="codigo_perfil">Perfil</label>
		    <?php 
		    $arrRes = array();
		    foreach ($perfil as $p) {
		    	$arrRes[$p['codigo']] = $p['nome'];
		    }
		    echo form_dropdown('codigo_perfil', $arrRes, set_value('codigo_perfil'), array('class'=>'form-control')); 
		    ?>
		  </div>
		  <div class="form-group avatar">
		  		<label for="arquivo_avatar">Avatar</label>
		  		<div id="imagens_avatar" class="imagens_avatar">
		  			<img src="<?php echo base_url(); ?>assets/images/avatar.gif" alt="avatar do usuário" class="img-circle" id="imagem_avatar">
			    </div>
			    <!-- <input type="file" id="exampleInputFile"> -->
			    <?php 
				    echo form_upload(array(
				    	"id" => "userfile",
				    	"name" => "userfile",
				    	"value" => set_value('userfile')
				    )); 
			    ?>
			    <p class="help-block">Escolha seu avatar. Arquivo imagem png, jpg, gif.</p>
		  </div>
		  <div class="form-group">
		    <label for="senha">Senha</label>
		    <?php echo form_error('senha'); ?>
		    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
		  </div>
		  <div class="form-group">
		    <label for="confirmar_senha">Confirmar senha</label>
		    <?php echo form_error('confirmar_senha'); ?>
		    <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" placeholder="Senha">
		  </div>
		  <button type="submit" class="btn btn-default">Gravar</button>
		<?php echo form_close(); ?>
	</div>
	<!-- <div class="col-lg-4"></div> -->
</div>
<?php } ?>
</div><!-- /.container -->
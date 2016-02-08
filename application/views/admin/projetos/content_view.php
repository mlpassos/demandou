<div class="container-fluid ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
<div class="row">
	<div class="col-lg-12 text-right">
		<a href="<?php echo base_url(); ?>projeto/adicionar" class="btn btn-primary btn-large" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar projeto</a>
		<hr>
	</div>
</div>
<div class="row tarefas-grid">
	<?php foreach($projetos as $p) { ?>
		<div class="cor-coluna col-lg-2 col-md-3 col-sm-4 col-xs-12">
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
					<i class="pin animated fadeInDownBig"></i>
					<div class="caption">
				        <h3><?php echo $p['titulo'];?></h3>
				        	<?php 
				        	$lider = false;
				        	if ($p['papel']=="Líder") {
				        		$lider = true;
								echo '<i class="fa fa-star"> ' . $p['papel'] . '</i>';
				        	}?>
				        <hr>
				        <div class="body">
					        <p id="tarefas-descricao-1" class="teste">
					        	<?php 
					        	$this->load->helper('text');
					        	echo word_limiter($p['descricao'],20);
					        	//echo $p['descricao'];
					        	?> 
					        </p>
					        <p id="tarefas-descricao-1" class="teste">
					        	<?php 
					        	$this->load->helper('date');

								// INíCIO
					        	// $data_inicio = date("l",strtotime($p['data_inicio'])) . ', ' . date("d",strtotime($p['data_inicio']))  . ' de ' . date("F",strtotime($p['data_inicio'])) . ' de ' . date("Y",strtotime($p['data_inicio']));
								echo (strtotime($p['data_inicio']) < strtotime('now')) ? '<span class="fa fa-play-circle"></span> ' : '<span class="fa fa-pause-circle"></span> ' ;
								//echo strftime('%A, %d de %B de %Y', strtotime($p['data_inicio']));
								// echo '<span class="fa fa-calendar"></span> ' . $data_inicio;

					   			// PRAZO
					   			$timestamp = strtotime($p['data_prazo']);
								$now = time();
								if( strtotime($p['data_prazo']) < strtotime('now') ) {
									echo '<br><span class="glyphicon glyphicon-warning-sign"></span> ATRASADO ';
								} 
								// else {
								// 	echo "<br><span class='glyphicon glyphicon-time'></span> ";
								// 	echo timespan($now, $timestamp);
								// }
					        	?> 
					        </p>
					    </div>
				    </div>
			    	<!-- FOOTER  -->
		        	<div class="tarefas-acoes btn-group btn-group-xs" role="group" aria-label="...">
			    		<a href="#" class="btn btn-default btn-sm" role="button" data-codigoprojeto="<?php echo $p['codigo'];?>" data-prioridade="<?php echo $p['prioridade']; ?>" data-prazo="<?php echo $p['data_prazo']; ?>" data-inicio="<?php echo $p['data_inicio']; ?>" data-descricao="<?php echo $p['descricao']; ?>" data-titulo="<?php echo $p['titulo']; ?>" data-toggle="modal" data-target="#myModalProjetoVer">
	  						<span data-toggle="tooltip" data-placement="top" title="Ver"  class="projetos-acoes-btn glyphicon glyphicon-sunglasses" aria-hidden="true"></span>
			    		</a> 

			    		<?php 
			    		if ($lider) { 
			    			$data_lider = array('codigo_projeto'=>$p['codigo']);
								// i store data to flashdata
							  $this->session->set_userdata('gerenciar_projeto-' . $p['codigo'], $data_lider);
			    		?>
			    			<a href="<?php echo base_url() . 'projeto/alterar/' . $p['codigo'];?>" class="btn btn-default btn-sm" role="button">
		  						<span data-toggle="tooltip" data-placement="top" title="Alterar"  class="projetos-acoes-btn glyphicon glyphicon-edit" aria-hidden="true"></span>
				    		</a>
			    		<? } ?>

			    		<?php 
			    		if ($lider) { 
			    			$data = array('codigo_projeto'=>$p['codigo']);
								// i store data to flashdata
							  $this->session->set_userdata('gerenciar_tarefas-' . $p['codigo'],$data);
			    		?>
			    			<a href="<?php echo base_url() . 'tarefa/adicionar/' . $p['codigo'];?>" id="tarefasGerenciar" class="btn btn-default btn-sm" role="button" data-codigoprojeto="<?php echo $p['codigo'];?>">
	  							<span data-toggle="tooltip" data-placement="top" title="Gerenciar tarefas"  class="projetos-acoes-btn glyphicon glyphicon-tasks" aria-hidden="true"></span>
			    			</a>	
			    		<? } ?>
			    		
			    		<a href="#" class="btn btn-default btn-sm" role="button" data-codigousuario="<?php echo $this->session->userdata('codigo_usuario'); ?>" data-lider="<?php if ($lider) { echo "1";} else {echo "0";}; ?>" data-codigoprojeto="<?php echo $p['codigo'];?>" data-prioridade="<?php echo $p['prioridade']; ?>" data-prazo="<?php echo $p['data_prazo']; ?>" data-inicio="<?php echo $p['data_inicio']; ?>" data-descricao="<?php echo $p['descricao']; ?>" data-titulo="<?php echo $p['titulo']; ?>" data-toggle="modal" data-target="#myModalTarefaVer">
	  						<!-- <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>  -->
	  						<?php 
	  						if ($lider) {
	  							echo "Tarefas do Projeto ";
	  						} else {
	  							echo "Suas Tarefas ";
	  						} ?>
	  						<span class="projetos-acoes-btn badge">
	  							<?php 
	  								$res = array();
	  								$achou = false;
	  								if ($lider) {
	  									$tasks = $tarefas_projeto;
	  									$res['tarefa_total'] = 0;
	  									$res['tarefa_completadas'] = 0;
	  									$aux = "";
	  									foreach($tasks as $t) {

		  								 	if ($t['codigo_projeto']==$p['codigo']) {
		  								 		if ($aux !== $t['codigo_tarefa']) {
		  								 			// diferente
		  								 			if ( ($t['data_fim']!==null) AND ($t['encerrada']==1) ) {
		  								 				// $andamento = true;
		  								 				$res['tarefa_completadas']++;
		  								 			}
		  								 			$res['tarefa_total']++;
		  								 			$aux = $t['codigo_tarefa'];
		  								 			$achou = true;
		  								 		} else {
		  								 			// igual
		  								 		}
		  								 		//break;
		  								 	}
	  									}
	  								} else {
	  									// participante, retornar tarefas por usuário
	  									$achou = false;
	  									$tasks = $tarefas_projeto;
	  									$res['tarefa_total'] = 0;
	  									$res['tarefa_total_projeto'] = 0;
	  									$res['tarefa_completadas'] = 0;
	  									$res['tarefa_completadas_usuario']=0;
	  									$aux = "";
	  									foreach($tasks as $t) {
	  										if ($t['codigo_projeto']==$p['codigo']) {
	  											if ( $t['codigo_usuario'] == $this->session->userdata('codigo_usuario') )  {
			  								 		// tarefas totais do usuário
			  								 		$res['tarefa_total']++;
			  								 		$achou = true;
		  										}
		  										if ($aux !== $t['codigo_tarefa']) {
			  										if ( $t['codigo_usuario'] == $this->session->userdata('codigo_usuario') )  {
				  										if ( ($t['data_fim']!==null) AND ($t['encerrada']==1) )  {
			  								 				// geral do projeto
			  								 				$res['tarefa_completadas_usuario']++;
			  								 			}
			  								 		}

			  								 		if ( ($t['data_fim']!==null) AND ($t['encerrada']==1) )  {
		  								 				// geral do projeto
		  								 				$res['tarefa_completadas']++;
		  								 			}
													$res['tarefa_total_projeto']++;
				  								 	$aux = $t['codigo_tarefa'];
			  									} 
			  								}
	  									}
	  								}
	  								if ($achou===true) {
	  									if ($lider) {
	  										echo $res['tarefa_total'] . ' <span class="badge" style="background-color:green;"> ' . $res['tarefa_completadas'] . '</span>';
	  									} else {
	  										echo $res['tarefa_total'] . ' <span class="badge" style="background-color:blue;"> ' . $res['tarefa_completadas_usuario'] . '</span>';	
	  									}
	  								} else {
	  									echo "0";// . ' / ' . $res['tarefa_completadas'];
	  								}
	  							;?>
	  						</span>
			    		</a>
			    	</div> 
			    	<div class="projeto-andamento">
			    		<?php 
			    		// if ($lider) {
				    		if ($lider) {
				    			$tarefa_total = $res['tarefa_total'];
				    		} else {
				    			$tarefa_total = $res['tarefa_total_projeto'];
				    		}
				    		$tarefa_completadas = $res['tarefa_completadas'];
				    		if ($tarefa_completadas>0 AND $tarefa_total>0) {
				    			$andamentoValor = number_format(($tarefa_completadas/$tarefa_total) * 100,2);
				    	?>	<div class="progress">
		  						<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $andamentoValor . '%'; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $andamentoValor .'%'; ?>;min-width: 2em;">
								<?php echo $andamentoValor . '%'; ?>
		  						</div>
							</div>
						<?php 
							} else {
								echo "<i class='fa fa-exclamation-circle'></i> Ainda sem andamento.";
							}
						// } else {
						// 	echo "sem acesso";
						// }
			    		?>
			    	</div>
				</div>
		</div>
	<?php }; ?>
</div>
<!-- <div class="row">
	<div class="col-lg-12 col-md-12">
		<section class="cd-horizontal-timeline">
				<div class="timeline">
					<div class="events-wrapper">
						<div class="events">
							<ol>
								<li><a href="#0" data-date="16/01/2014" class="selected">16 Jan</a></li>
								<li><a href="#0" data-date="28/02/2014">28 Feb</a></li>
							</ol>
							<span class="filling-line" aria-hidden="true"></span>
						</div> 
					</div> 
     				<ul class="cd-timeline-navigation">
						<li><a href="#0" class="prev inactive">Prev</a></li>
						<li><a href="#0" class="next">Next</a></li>
					</ul>
				</div>
				<div class="events-content">
					<ol>
						<li data-date="16/01/2014" class="selected">
							<h2>Horizontal Timeline</h2>
							<em>January 16th, 2014</em>
							<p>	
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
							</p>
						</li>
			 
						<li data-date="28/02/2014">
							<h2>Horizontal Timeline</h2>
							<em>January 16th, 2014</em>
							<p>	
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus.
							</p>
						</li>
					</ol>
				</div> 
		</section>
	</div>
</div> -->
<!-- Modal -->
<div class="modal fade" id="myModalProjetoVer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal Ver</h4>
      </div>
      <div class="modal-body">
        <p class="descricao"></p>
        <p class="data-inicio"></p>
        <p class="data-prazo"></p>
        <p class="data-faltam"></p>
        Tempo consumido (%)
        <div class="progress">
		  <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">
		    
		  </div>
		</div>
		
		<!-- <div class="modal-tarefas-timeline"> -->
			
		<!-- </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Gravar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalTarefaVer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal Adicionar</h4>
      </div>
      <div class="modal-body">
        <div class="modal-tarefas-lista">		
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Gravar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModalTarefaAlterar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alterar tarefa</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
					<div class="tarefas-add-box col-lg-12 col-md-12">
						<div class="col-lg-12 col-md-12">
							<?php 
							$this->load->helper('form');
							$hidden = array("codigo_projeto"=>1);
							$hidden = array("codigo_tarefa"=>1);
							echo form_open('tarefa/alterar', ["id" => "frmTarefa-Alterar", "class" => "tarefa-adicionar", "role" => "form"], $hidden); ?>
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
							    <input type="date" class="form-control"  id="data_inicio" name="data_inicio">
							  </div>
						</div>
						<div class="col-lg-6 col-md-6">
							  <div class="form-group">
							    <label for="data_prazo">Prazo</label>
							    <?php 
							    	echo form_error('data_prazo'); 
							    ?>
							    <input type="date" class="form-control"  id="data_prazo" name="data_prazo">
							  </div>
						</div>
						<div class="col-lg-12 col-md-12">
							<hr>
						</div>
						<div class="col-lg-12 col-md-12">
							  <div class="form-group">
							    <label for="lider">Líder</label>
							    <?php echo form_error('lider'); ?>
							    <select style="width:100%;" id="lider" name="lider" multiple="multiple" class="form-control">
								  <?php 
								  	// foreach($usuarios as $u) {
								  	// 	echo "<option value='" . $u['codigo'] . "'>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";
								  	// }
								  ?>
								</select>
							  </div>
						</div>
						<div class="col-lg-12 col-md-12">
							<button type="submit" class="btn btn-default">Gravar</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Gravar</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div><!-- /.container -->
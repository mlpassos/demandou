<div id="ajaxload" class="container-fluid ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
		<!-- <div class="row">
			<div class="col-lg-12 text-right">
				<a href="<?php echo base_url(); ?>projeto/adicionar" class="btn btn-primary btn-large" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar projeto</a>
				<hr>
			</div>
		</div> -->
		<div class="row">
			<div class="col-lg-12 filtro">
				<div class="btn-group" role="group" aria-label="...">
				  <button type="button" class="btn btn-default filter filter-all" data-filter-by="*">
				  	<!-- <i class="fa fa-sort"></i> -->
				  	Mostrar todos
				  </button>
				  <button type="button" class="btn btn-default sort" data-sort-by="prioridade" data-order-by="true">
				  	<i class="fa fa-sort-asc"></i>
				  	Prioridade
				  </button>
				  <button type="button" class="btn btn-default sort" data-sort-by="titulo" data-order-by="true">
				  	<i class="fa fa-sort-asc"></i>
				  	Titulo
				  </button>
				  <!-- <button type="button" class="btn btn-default sort" data-sort-by="total_tarefas" data-order-by="true">
				  	<i class="fa fa-sort-asc"></i>
				  	Total de tarefas
				  </button> -->
				  <button type="button" class="btn btn-default sort" data-sort-by="data_prazo" data-order-by="true">
				  	<i class="fa fa-sort-asc"></i>
				  	Prazo
				  </button>
				</div>
				<div class="input-group input-procurar">
				  <span class="input-group-addon" id="procurar-addon"><i class="fa fa-search"></i></span>
				  <input type="text" id="search-term" class="form-control" placeholder="Procurar em <?php echo sizeof($tarefas);?> demandas..." aria-describedby="procurar-addon">
				</div>
				<hr>
			</div>
		</div>
<div class="row tarefas-grid">
	<?php 
	$andamentoValor = 0;
	if ($this->session->userdata('codigo_usuario')==6) {
		$lider = true;
	} else {
		$lider = false;
	}
	foreach($tarefas as $t) { 
?>
		<div class="cor-coluna col-lg-2 col-md-3 col-sm-4 col-xs-12 <?php echo "usuario-" . $t["codigo_usuario"]; ?>" data-filter-by="<?php echo "usuario-" . $t["codigo_usuario"]; ?>">
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
				<div style="background-color:white;" class="tarefas-box hvr-curl-bottom-right projeto-<?php echo $t['codigo_tarefa']; ?>">
					<!-- <i class="pin animated fadeInDownBig"></i> -->
					<!-- tarefas -->
					<div class="caption">
						<header class="tarefas-box-header <?php echo $prioridadesClass; ?>">
				        <span style="display:none;" class="tarefa-prioridade"><?php echo $t['prioridade']; ?></span>
				        <h3 class="tarefa-titulo">
				        	<?php echo  $t['titulo'] . '<br><small>' . $t['projeto_titulo'];?></small></h3>
				        	<?php 
							 			echo '<div class="tarefas-box-lider">';
							 			  echo '<img data-filter="lider" data-filter-by=".usuario-' . $t['codigo_usuario'] . '" class="filter img-circle lider-thumbs" src="' . base_url() . 'uploads/' . $t['arquivo_avatar'] . '" alt="avatar do líder do projeto">';
							 			  echo '<p><small> '. $t['nome'] .  '</small></p>';
							 			echo '</div>';
				        	?>
				       </header>
				        <!-- <div class="clearfix"></div> -->
				        <!-- FOOTER  -->
		        	<div class="tarefas-acoes btn-group btn-group-xs" role="group" aria-label="...">
				    		<a href="#" class="btn btn-sm" role="button" data-codigotarefa="<?php echo $t['codigo_tarefa'];?>" data-prioridade="<?php echo $t['prioridade']; ?>" data-prazo="<?php echo $t['data_prazo']; ?>" data-inicio="<?php echo $t['data_inicio']; ?>" data-descricao='<?php echo $t['descricao']; ?>' data-titulo="<?php echo $t['titulo']; ?>" data-toggle="modal" data-target="#myModalTarefaVer">
		  						<span data-toggle="tooltip" data-placement="top" title="Ver"  class="projetos-acoes-btn fa fa-eye" aria-hidden="true"></span>
				    		</a> 
			    			<a 
			    			data-codigo="<?php echo $t['codigo_tarefa'];?>" 
			    			data-codigoprojeto="<?php echo $t['codigo_projeto'];?>" 
			    			data-codigostatus="<?php echo $t['codigo_status'];?>"
			    			data-prioridade="<?php echo $t['prioridade']; ?>" 
			    			data-prazo="<?php echo $t['data_prazo']; ?>" 
			    			data-inicio="<?php echo $t['data_inicio']; ?>" 
			    			data-descricao='<?php echo $t['descricao']; ?>' 
			    			data-titulo="<?php echo $t['titulo']; ?>" 
			    			data-lider="<?php echo $t['codigo_usuario']; ?>"
			    			href="#" data-toggle="modal" data-target="#myModalTarefaAlterar" class="btn btn-sm" role="button">
		  						<span data-toggle="tooltip" data-placement="top" title="Alterar"  class="projetos-acoes-btn fa fa-pencil" aria-hidden="true"></span>
				    		</a>
				    		<?php 
				    		// 	if ($t['encerrada']==1 AND $t['data_fim']!==null) {
				    		// 		if ($lider OR $t['codigo_usuario'] == $this->session->userdata('codigo_usuario')) { 
					    	// 		echo '<a href="#" class="tarefa-stats projeto-finaliza" data-toggle="modal" data-target="#myModalConfirmar" data-alvo="tarefa" data-tipo="finalizar" data-texto="Você tem certeza que deseja finalizar o projeto" data-titulo="' . $t["titulo"] . '" data-codigotarefa="'. $t["codigo_tarefa"] . '" data-codigoprojeto="'. $t["codigo_projeto"] . '">'
										// 	echo '<span class="fa-stack">'
										// 		. '<i class="fa fa-circle fa-stack-2x"></i>'
										// 	  . '<i style="color:rgb(100,240,100);" class="tarefa-desativar fa fa-flag fa-stack-1x fa-inverse" data-toggle="tooltip" data-placement="top" title=Finalizada"></i>'
										// 	  . '</span>';
										//  . '</a>';
										// }
				    		// 	}
				    		?>
			    </div> 
	        <div class="body tarefas-box-descricao">
		        <!-- <p class="tarefas-box-descricao"> -->
		        	<?php 
		        	$this->load->helper('text');
		        	echo word_limiter($t['descricao'],10);
		        	//echo $p['descricao'];
		        	?> 
		        <!-- </p> -->

						<p class="tarefas-box-datas">
			        <?php 
			        	if ($t['encerrada']==1 AND $t['data_fim']!==null) {
			        		// Encerrada
			        		// $andamentoValor = 100;
			        		// $andamentoClass = "progress-bar-success";
			        	// 	echo '<span class="fa-stack">'
												// . '<i class="fa fa-circle fa-stack-2x"></i>'
											 //  . '<i style="color:#3b5998;" class="tarefa-desativar fa fa-thumbs-up fa-stack-1x fa-inverse" data-toggle="tooltip" data-placement="top" title=Finalizada"></i>'
											 //  . '</span>';
			        		echo "<i class='fa fa-thumbs-o-up tarefa-finalizada' data-toggle='tooltip' data-placement='top' title='Tarefa entregue'></i>";
			        	} else {
				        	$this->load->helper('date');

									// INíCIO
						      // $data_inicio = date("l",strtotime($p['data_inicio'])) . ', ' . date("d",strtotime($p['data_inicio']))  . ' de ' . date("F",strtotime($p['data_inicio'])) . ' de ' . date("Y",strtotime($p['data_inicio']));
									// echo (strtotime($p['data_inicio']) < strtotime('now')) ? 'Iniciou' : 'Aguardando' ;
									//echo (strtotime($p['data_inicio']) < strtotime('now')) ? '<a href="#" class="btn btn-sm" role="button" data-codigoprojeto="' . $p['codigo'] . '"  data-toggle="modal" data-target="#myModalProjetoDesativar"><span data-toggle="tooltip" data-placement="top" title="Desativar"  class="projetos-acoes-btn fa fa-toggle-on" aria-hidden="true"></span></a>' : '<a href="#" class="btn btn-sm" role="button" data-codigoprojeto="' . $p['codigo'] . '"  data-toggle="modal" data-target="#myModalProjetoDesativar"><span data-toggle="tooltip" data-placement="top" title="Ativar"  class="projetos-acoes-btn fa fa-toggle-off" aria-hidden="true"></span></a>' ;
									//echo strftime('%A, %d de %B de %Y', strtotime($p['data_inicio']));
									// echo '<span class="fa fa-calendar"></span> ' . $data_inicio;

						   		// PRAZO
						   		$timestamp = strtotime($t['data_prazo']);
						   		?>
									<span style="display:none;" class="data_prazo"><?php echo $t['data_prazo']; ?></span>
						   		<?php
									$now = time();
									// $str = strtotime('now') - strtotime($t['data_prazo']);
									// $dif = ceil($str/3600/24);
									// echo 'dif: ' . $dif;
									if( strtotime($t['data_prazo']) < strtotime('now') ) {
										$str = strtotime('now') - strtotime($t['data_prazo']);
										$dif = ceil($str/3600/24);
										// echo 'dif: ' . $dif;
										if ($dif>1) {
											echo '<br><span class="fa fa-exclamation-circle"></span> Atrasado ' . $dif . ' dias';	
										} else if ($dif == -1) {
											echo '<br><span class="fa fa-exclamation-circle"></span> Termina hoje!';	
										} else {
											echo '<br><span class="fa fa-exclamation-circle"></span> Atrasado ' . $dif . ' dia';	
										}
										// $andamentoValor = 100;
										// $andamentoClass = "progress-bar-danger";
										// echo "v: " . $andamentoValor;
									} else {
										echo "<br><span class='fa fa-calendar'></span> ";
										echo timespan($now, $timestamp);

										// $str = strtotime('now') - strtotime($t['data_prazo']);
										// $dif = ceil($str/3600/24);
										// if ($dif==-1) {
										// 	echo '<br><span class="fa fa-exclamation-circle"></span> Termina hoje!';	
										// }
										// $total = strtotime($t['data_prazo']) - strtotime($t['data_inicio']);
				    		// 		$faltam = strtotime($t['data_prazo']) - strtotime('now');
										// $difTotal = ceil($total/3600/24);
										// $difFaltam = ceil($faltam/3600/24);
										// // echo 'total: ' . $difTotal;
					    	// 		// $andamentoValor = "50"; //($difTotal - $difFaltam) * 100 / $difTotal;
					    	// 		$andamentoValor = number_format((100 * ($difTotal - $difFaltam))/$difTotal,2);
					    	// 		if ($andamentoValor==0.00 AND $difTotal >=1) {
					    	// 			$andamentoClass = "progress-bar-danger";
					    	// 			$andamentoValor = 100;
					    	// 		} else {
						    // 			$andamentoClass = "progress-bar-info";
					    	// 		}
									}
								}
			        ?> 
		        </p>
		        
			    </div>
	    		</div>
	    	
	    	<div class="projeto-andamento">
	    		<?php 
	    		// if ($lider) {
	    		// 		$total = strtotime($t['data_prazo']) - strtotime($t['data_inicio']);
	    		// 		$faltam = strtotime($t['data_prazo']) - strtotime('now');
							// $difTotal = ceil($total/3600/24);
							// $difFaltam = ceil($faltam/3600/24);
		    	// 		$andamentoValor = $difFaltam;//($difTotal-$difFaltam) * 100 / $difTotal;//number_format(($tarefa_completadas/$tarefa_total) * 100,2);
		    	// $andamentoValor = 10;
		    	// echo "v: " . $andamentoValor;
		    	?>
<!-- 
		    	<div class="progress">
  					<div class="progress-bar progress-bar-striped <?php echo $andamentoClass; ?>" role="progressbar" aria-valuenow="<?php echo $andamentoValor . '%'; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $andamentoValor .'%'; ?>;min-width: 2em;">
							<?php echo $andamentoValor . '%'; ?>
  					</div>
					</div> -->
					<?php 
						// } else {
						// 	echo "<p class='sem-andamento'>";
						// 		echo "Sem andamento";
						// 	echo "</p>";
						// }
		    		?>
	    	</div>
	    	<?php 
	    		
	    		if ($lider) { 
	    	?>
	    	<div class="projeto-trash">
	    		<a data-toggle="modal" data-target="#myModalConfirmar" data-tipo="excluir" data-texto="Você tem certeza que deseja excluir o projeto" data-titulo="<?php echo $t['titulo']; ?>" href="#" class="projeto-excluir" data-codigotarefa="<?php echo $t['codigo_tarefa']; ?>">
	    			<i class="fa fa-trash-o pull-right hvr-icon-trash-o" data-toggle="tooltip" data-placement="top" title="Excluir"></i>
	    		</a>
	    	</div>
	    	<?php } ?>
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
<div class="modal-container">
	<!-- Modal -->
	<div class="modal fade" id="myModalConfirmar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Aviso</h4>
	      </div>
	      <div class="modal-body">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default confirma-sim" data-dismiss="modal" data-codigoprojeto="" data-tipo="" data-elemento="">Sim</button>
	        <button type="button" class="btn btn-default confirma-nao" data-dismiss="modal">Não</button>
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
	        <h4 class="modal-title" id="myModalLabel">Visualizar Tarefa</h4>
	      </div>
	      <div class="modal-body">
	        <p class="descricao"></p>
	        <p class="data-inicio"></p>
	        <p class="data-prazo"></p>
	        <p class="data-faltam alert alert-info"></p>
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
	      	<form method="post" id="frmTarefa-Alterar" class="tarefa-adicionar" role="form" name="frmTarefa-Alterar" action="tarefa/alterar">
		      	<div class="row">
							<div class="tarefas-add-box col-lg-12 col-md-12">
								<div class="col-lg-12 col-md-12">
									<?php 
									$this->load->helper('form');
									$hidden = array("codigo_projeto"=>1,
										"codigo_tarefa" =>1
									);
									// $hidden = array("codigo_tarefa"=>1);
									//echo form_open('tarefa/alterar', ["id" => "frmTarefa-Alterar", "class" => "tarefa-adicionar", "role" => "form"], $hidden); ?>
									<!-- <form method="post" id="frmTarefa-Alterar" class="tarefa-adicionar" role="form" name="frmTarefa-Alterar" action="tarefa/alterar"> -->
										<input type="hidden" name="codigo_projeto" id="codigo_projeto" value="1">
										<input type="hidden" name="codigo_tarefa" id="codigo_tarefa" value="1">
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
									    <select style="width:100%;" id="lider" name="lider[]" multiple="multiple" class="form-control">
										  <?php 
										  	// foreach($usuarios as $u) {
										  	// 	echo "<option value='" . $u['codigo'] . "'>" . $u['nome'] . " " . $u['sobrenome'] . "</option>";
										  	// }
										  ?>
										</select>
									  </div>
								</div>
								<div class="col-lg-12 col-md-12">
									<div class="form-group">
										<label for="codigo_status">Status</label><br>
										<label class="radio-inline">
											<input type="radio" name="codigo_status" id="codigo_status" value="1"> Ativado
										</label>
										<label class="radio-inline">
											<input type="radio" name="codigo_status" id="codigo_status" value="0"> Desativado
										</label>
									</div>
								</div>
								<div class="col-lg-12 col-md-12">
									<!-- <button type="submit" class="btn btn-default">Gravar</button> -->
									<p class="form-message"></p>
								</div>
								<?php //echo form_close(); ?>
							</div>
						</div>
				</div>
	      <div class="modal-footer">
	        <button type="button" class="fechar btn btn-default" data-dismiss="modal">Fechar</button>
	        <button type="submit" class="btn btn-primary">Gravar</button>
	      </div>
	    </div>
	    </form>
	  </div>
	</div>
</div>
<?php } ?>
</div><!-- /.container -->
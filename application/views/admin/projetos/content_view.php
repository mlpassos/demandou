<div id="ajaxload" class="container-fluid ajaxload">
<?php if ($this->session->userdata('logado')==true) { ?>
	<?php if ($this->session->userdata('codigo_perfil') == 2 ) { ?>
		<div class="row">
			<div class="col-lg-12 text-right">
				<a href="<?php echo base_url(); ?>projeto/adicionar" class="btn btn-primary btn-large" role="button"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar projeto</a>
				<hr>
			</div>
		</div>
	<?php } ?>
<div class="row tarefas-grid">
	<?php foreach($projetos as $p) { ?>
		<div class="cor-coluna col-lg-2 col-md-3 col-sm-4 col-xs-12">
				<?php 
					switch ($p['prioridade']) {
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
				<div class="tarefas-box">
					<!-- <i class="pin animated fadeInDownBig"></i> -->
					<!-- tarefas -->
					<div class="caption">
						<header class="tarefas-box-header <?php echo $prioridadesClass; ?>">
				        <h3>
				        	<?php echo $p['titulo'];?></h3>
				        	<?php 
				        	$lider = false;
				        	$usuariosProjeto = $projetos_usuarios;
				        	if ($p['papel']=="Líder") {
				        		$lider = true;
										//echo '<i class="fa fa-star"> ' . $p['papel'] . '</i>';
										echo '<img class="tarefas-box-lider-img img-circle lider-thumbs" src="' . base_url() . 'uploads/' . $this->session->userdata('arquivo_avatar') . '" alt="avatar do líder do projeto">';
									} else {
										foreach($usuariosProjeto as $t) {
	  								 	if ($t['codigo_projeto']==$p['codigo'] AND $t['codigo_papel']==1) {
	  								 			echo '<div class="tarefas-box-lider">';
	  								 			  echo '<img class="img-circle lider-thumbs" src="' . base_url() . 'uploads/' . $t['arquivo_avatar'] . '" alt="avatar do líder do projeto">';
	  								 			  // echo '<small> '. $t['nome'] . '</small>';
	  								 			echo '</div>';
	  								 	}
	  								}
				        	}?>
				       </header>
				        <!-- <div class="clearfix"></div> -->
				        <!-- FOOTER  -->
		        	<div class="tarefas-acoes btn-group btn-group-xs" role="group" aria-label="...">
				    		<a href="#" class="btn btn-sm" role="button" data-codigoprojeto="<?php echo $p['codigo'];?>" data-prioridade="<?php echo $p['prioridade']; ?>" data-prazo="<?php echo $p['data_prazo']; ?>" data-inicio="<?php echo $p['data_inicio']; ?>" data-descricao="<?php echo $p['descricao']; ?>" data-titulo="<?php echo $p['titulo']; ?>" data-toggle="modal" data-target="#myModalProjetoVer">
		  						<span data-toggle="tooltip" data-placement="top" title="Ver"  class="projetos-acoes-btn fa fa-eye" aria-hidden="true"></span>
				    		</a> 
				    		<?php 
					    		if ($lider) { 
				    			$data_lider = array('codigo_projeto'=>$p['codigo']);
								  $this->session->set_userdata('gerenciar_projeto-' . $p['codigo'], $data_lider);
				    		?>
				    			<a href="<?php echo base_url() . 'projeto/alterar/' . $p['codigo'];?>" class="btn btn-sm" role="button">
			  						<span data-toggle="tooltip" data-placement="top" title="Alterar"  class="projetos-acoes-btn fa fa-pencil" aria-hidden="true"></span>
					    		</a>
				    		<? } ?>
			    			<?php 
			    				if ($lider) { 
					    			$data = array('codigo_projeto'=>$p['codigo']);
										// i store data to flashdata
									  $this->session->set_userdata('gerenciar_tarefas-' . $p['codigo'],$data);
					    		?>
				    			<a href="<?php echo base_url() . 'tarefa/adicionar/' . $p['codigo'];?>" id="tarefasGerenciar" class="btn btn-sm" role="button" data-codigoprojeto="<?php echo $p['codigo'];?>">
		  							<span data-toggle="tooltip" data-placement="top" title="Gerenciar tarefas"  class="projetos-acoes-btn fa fa-tasks" aria-hidden="true"></span>
				    			</a>	
				    		<?php } ?>
				    		<a href="#" class="btn btn-sm" role="button" data-codigousuario="<?php echo $this->session->userdata('codigo_usuario'); ?>" data-lider="<?php if ($lider) { echo "1";} else {echo "0";}; ?>" data-codigoprojeto="<?php echo $p['codigo'];?>" data-prioridade="<?php echo $p['prioridade']; ?>" data-prazo="<?php echo $p['data_prazo']; ?>" data-inicio="<?php echo $p['data_inicio']; ?>" data-descricao="<?php echo $p['descricao']; ?>" data-titulo="<?php echo $p['titulo']; ?>" data-toggle="modal" data-target="#myModalTarefaVer">
		  						<!-- <span class="glyphicon glyphicon-tasks" aria-hidden="true"></span>  -->
	  							<?php 
	  								// if ($lider) {
			  						// 	echo "Tarefas do Projeto ";
			  						// } else {
			  						// 	echo "Suas Tarefas ";
			  						// } 
			  					?>
			  						<span data-toggle="tooltip" data-placement="top" title="Total de tarefas do projeto" class="tarefa-stats badge">
		  								<?php 
			  								$res = array();
			  								$achou = false;
			  								if ($lider) {
			  									$tasks = $tarefas_projeto;
			  									$res['tarefa_total'] = 0;
			  									$res['tarefa_completadas'] = 0;
			  									$res['tarefa_aguardando'] = 0;
			  									$aux = "";
			  									foreach($tasks as $t) {
				  								 	if ($t['codigo_projeto']==$p['codigo']) {
				  								 		if ($aux !== $t['codigo_tarefa']) {
				  								 			// diferente
				  								 			if ($t['data_fim']!==null) {
					  								 				if ($t['encerrada']==1)  {
						  								 				// $andamento = true;
						  								 				$res['tarefa_completadas']++;
						  								 			} else {
						  								 				$res['tarefa_aguardando']++;
						  								 			}
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
			  									$res['tarefa_aguardando_usuario']=0;
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
						  										if ($t['data_fim']!==null) {
						  											if ($t['encerrada']==1)  {
						  								 				// $andamento = true;
						  								 				$res['tarefa_completadas_usuario']++;
						  								 			} else {
						  								 				$res['tarefa_aguardando_usuario']++;
						  								 			}
					  								 			}
					  								 		}

					  								 		if ($t['data_fim']!==null) {
					  								 			if ($t['encerrada']==1)  {
						  								 			$res['tarefa_completadas']++;
						  								 		} else {
						  								 			// $res['tarefa_aguardando_usuario']++;
						  								 		}
				  								 			}
																$res['tarefa_total_projeto']++;
						  								 	$aux = $t['codigo_tarefa'];
					  									} 
					  								}
			  									}
			  								}
			  								if ($achou===true) {
			  									if ($lider) {
			  										echo $res['tarefa_total'] . '</span> <span data-toggle="tooltip" data-placement="top" title="Aguardando avaliação" class="tarefa-stats badge" style="background-color:red;"> ' . $res['tarefa_aguardando'] . '</span>';
			  										echo ' <span data-toggle="tooltip" data-placement="top" title="Tarefas finalizadas" class="tarefa-stats badge" style="background-color:green;"> ' . $res['tarefa_completadas'] . '</span>';
			  										//echo $res['tarefa_total']-$res['tarefa_completadas'] . ' <span class="badge" style="background-color:green;"> ' . $res['tarefa_completadas'] . '</span>';
			  									} else {
			  										echo $res['tarefa_total'] . '</span> <span data-toggle="tooltip" data-placement="top" title="Finalizadas" class="tarefa-stats badge" style="background-color:green;"> ' . $res['tarefa_completadas_usuario'] . '</span>';	
			  										echo ' <span data-toggle="tooltip" data-placement="top" title="Aguardando avaliação" class="tarefa-stats badge" style="background-color:red;"> ' . $res['tarefa_aguardando_usuario'] . '</span>';
			  									}
			  								} else {
			  									echo "0";// . ' / ' . $res['tarefa_completadas'];
			  								}
			  							;?>
	  								<!-- </span> -->
			    			</a>
			    			
			    </div> 
	        <div class="body">
		        <p class="tarefas-box-descricao">
		        	<?php 
		        	$this->load->helper('text');
		        	echo word_limiter($p['descricao'],20);
		        	//echo $p['descricao'];
		        	?> 
		        </p>

						<p class="tarefas-box-datas">
			        <?php 
			        	$this->load->helper('date');

								// INíCIO
					        	// $data_inicio = date("l",strtotime($p['data_inicio'])) . ', ' . date("d",strtotime($p['data_inicio']))  . ' de ' . date("F",strtotime($p['data_inicio'])) . ' de ' . date("Y",strtotime($p['data_inicio']));
								echo (strtotime($p['data_inicio']) < strtotime('now')) ? 'Iniciou' : 'Aguardando' ;
								//echo (strtotime($p['data_inicio']) < strtotime('now')) ? '<a href="#" class="btn btn-sm" role="button" data-codigoprojeto="' . $p['codigo'] . '"  data-toggle="modal" data-target="#myModalProjetoDesativar"><span data-toggle="tooltip" data-placement="top" title="Desativar"  class="projetos-acoes-btn fa fa-toggle-on" aria-hidden="true"></span></a>' : '<a href="#" class="btn btn-sm" role="button" data-codigoprojeto="' . $p['codigo'] . '"  data-toggle="modal" data-target="#myModalProjetoDesativar"><span data-toggle="tooltip" data-placement="top" title="Ativar"  class="projetos-acoes-btn fa fa-toggle-off" aria-hidden="true"></span></a>' ;
								//echo strftime('%A, %d de %B de %Y', strtotime($p['data_inicio']));
								// echo '<span class="fa fa-calendar"></span> ' . $data_inicio;

					   			// PRAZO
					   			$timestamp = strtotime($p['data_prazo']);
								$now = time();
								if( strtotime($p['data_prazo']) < strtotime('now') ) {
									echo '<br><span class="glyphicon glyphicon-warning-sign"></span> Atrasado ';
								} 
								// else {
								// 	echo "<br><span class='glyphicon glyphicon-time'></span> ";
								// 	echo timespan($now, $timestamp);
								// }
			        ?> 
		        </p>
		        <ul class="participantes-lista">
	        		<?php
	        			$tasks = $tarefas_projeto;
	        			$cont = 0;
	        			$conti = 1;
	        			$k=0;
	        			$tc=0;
	        			$ut = array();
	        			$utres = array();
	        			$auxi = "";
	        			foreach($usuariosProjeto as $t) {
								 	if ($t['codigo_projeto']==$p['codigo']) { // AND $t['codigo_papel']==2) {
								 		foreach($tasks as $ta) {
				  					 	if ($ta['codigo_projeto']==$p['codigo'] AND $ta['codigo_usuario']==$t['codigo_usuario']) {
				  							if ($ta['codigo_usuario']!==$auxi) {
				  								$ut['codigo_usuario']=$ta['codigo_usuario'];
				  								if ($ta['data_fim']===NULL) {
					  									// faz nada
					  									$ut['num_tarefas_completas'] = 0;
				  								} else {
				  									if ($ta['encerrada']==1) {
					  									$ut['num_tarefas_completas'] = 1;
					  								} else {
					  									$ut['num_tarefas_completas'] = 0;
					  								}
					  								$tc=$tc+1;
				  								}
				  								$ut['num_tarefas']=1;
				  								
				  								$auxi = $ta['codigo_usuario'];
				  								$conti = 1;
				  								$k++;
				  								array_push($utres,$ut);
				  							} else {
				  								$conti=$conti+1;
				  								$utres[$k-1]['num_tarefas']+=1;//$conti;
				  								if ($ta['data_fim']===NULL) {
				  									// faz nada
				  									// $utres[$k-1]['num_tarefas_completas'] = 0;
				  								} else {
				  									if ($ta['encerrada']==1) {
				  										$utres[$k-1]['num_tarefas_completas'] +=1;	
				  									}
				  									
				  									// $tc=$tc+1;
				  								}
				  							}
				  					 	}
				  					}
				  					// if ($lider) {
				  						// if ($t['codigo_papel']==2) {
										 		echo "<li class='participantes-lista-item'>";
										 			echo '<img class="img-circle participantes-thumbs" src="' . base_url() . 'uploads/' . $t['arquivo_avatar'] . '" alt="avatar do participante do projeto">';
										 			foreach($utres as $r) {
										 				if ($r['codigo_usuario']==$t['codigo_usuario']) {
										 					if ($r['num_tarefas'] - $r['num_tarefas_completas']==0) {
										 					// if ($r['num_tarefas_completas']>=0) {
										 						echo '<small class="participantes-lista-nome badge" style="background-color:green;background-image:none;">'. $r['num_tarefas_completas'] . '</small>';	
										 					} else {
										 						if ($t['codigo_usuario']!==$this->session->userdata('codigo_usuario')) {
										 							echo '<small class="participantes-lista-nome badge">'. ($r['num_tarefas'] - $r['num_tarefas_completas']) . '</small>';		
										 							//echo '<small class="participantes-lista-nome badge">'. $r['num_tarefas'] . '</small>';		
										 						} else {
										 							echo '<small class="participantes-lista-nome badge destaque-user">'. ($r['num_tarefas'] - $r['num_tarefas_completas']) . '</small>';		
										 						}
										 					}	
										 				}	// 	// echo '<small class="participantes-lista-nome2 badge">'. $r['num_tarefas_completas'] . '</small>';	
										 			}
										 					
										 				// }
										 			// }
										 		echo "</li>";
									 		// }
				  					// } else {
										 // 		echo "<li class='participantes-lista-item'>";
										 // 			echo '<a class="participantes-lista-link" href="#"><img class="img-square participantes-thumbs" src="' . base_url() . 'uploads/' . $t['arquivo_avatar'] . '" alt="avatar do participante do projeto">';
										 // 			foreach($utres as $r) {
										 // 				if ($r['codigo_usuario']==$t['codigo_usuario']) {
										 // 					echo '<small class="participantes-lista-nome badge">'. $r['num_tarefas'] . '</small></a>';
										 // 				}
										 // 			}
										 // 		echo "</li>";
				  					// }
								 	}
								}
								// echo "<pre>";
		  				// 		var_dump($utres);
		  				// 	echo "</pre>";
	        		?>
	        	</ul>
			    </div>
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
		    	?>	
		    	<div class="progress">
  					<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $andamentoValor . '%'; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $andamentoValor .'%'; ?>;min-width: 2em;">
							<?php echo $andamentoValor . '%'; ?>
  					</div>
					</div>
					<?php 
						} else {
							echo "<p class='sem-andamento'>";
								echo "Sem andamento";
							echo "</p>";
						}
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
<div class="modal-container">
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
	        <!-- <button type="button" class="btn btn-primary">Gravar</button> -->
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
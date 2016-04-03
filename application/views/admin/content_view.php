<div class="container-fluid ajaxload">
	<!-- Apply any bg-* class to to the info-box to color it -->
	<?php 
	if ($this->session->userdata('logado')==true) { ?>
		<p>Bem vindo, <strong><?php echo $this->session->userdata('nome') . ' ' . $this->session->userdata('sobrenome'); ?></strong></p>
	<?php } ?>
	<div class="row">
		<div class="col-md-2">
			<div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-thumb-tack"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Projetos</span>
					<span class="info-box-number"><?php echo $projetos[0]['total']; ?></span>
					<!-- The progress section is optional -->
					<div class="progress">
					  <div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
					  70% Increase in 30 Days
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-md-2">
			<div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-tasks"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Demandas</span>
					<span class="info-box-number"><?php echo $tarefas[0]['total']; ?></span>
					<!-- The progress section is optional -->
					<div class="progress">
					  <div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
					  70% Increase in 30 Days
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-md-2">
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="fa fa-thumb-tack"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Projetos encerrados</span>
					<span class="info-box-number"><?php echo $projetos_encerrados[0]['total']; ?></span>
					<!-- The progress section is optional -->
					<div class="progress">
					  <div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
					  70% Increase in 30 Days
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-md-2">
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="fa fa-send"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Demandas encerradas</span>
					<span class="info-box-number"><?php echo $tarefas_encerradas[0]['total']; ?></span>
					<!-- The progress section is optional -->
					<div class="progress">
					  <div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
					  70% Increase in 30 Days
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-md-2">
			<div class="info-box bg-aqua">
				<span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Demandas entregues</span>
					<span class="info-box-number tarefas-entregues-total"><?php echo $tarefas_entregues[0]['total']; ?></span>
					<!-- The progress section is optional -->
					<div class="progress">
					  <div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
					  70% Increase in 30 Days
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
		<div class="col-md-2">
			<div class="info-box bg-red">
				<span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Demandas aguardando avaliação</span>
					<span class="info-box-number tarefas-aguardando-total"><?php echo $tarefas_aguardando[0]['total']; ?></span>
					<!-- The progress section is optional -->
					<div class="progress">
					  <div class="progress-bar" style="width: 70%"></div>
					</div>
					<span class="progress-description">
					  70% Increase in 30 Days
					</span>
				</div><!-- /.info-box-content -->
			</div><!-- /.info-box -->
		</div>
	</div>
	<div class="row">
		<!-- Demandas Vencendo esta semana -->
		<div class="col-lg-12">
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Demandas vencendo esta semana</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#info_vencendo" aria-expanded="false" aria-controls="#info_vencendo"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="info_vencendo">
              <div class="table-responsive">
                <table id="table_vencendo" class="table table-striped table-bordered no-margin" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Projeto</th>
                      <th>Tarefa</th>
                      <th>Líder</th>
                      <th>Prazo</th>
                      <th>Tempo restante</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Projeto</th>
                      <th>Tarefa</th>
                      <th>Líder</th>
                      <th>Prazo</th>
                      <th>Tempo restante</th>
                      <th>#</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                  $this->load->helper('date');
                  $now = time();
                  foreach($tarefas_semana as $t) { 
                  	$timestamp = strtotime($t['tarefa_prazo']);
                  	$ano = date("Y",strtotime($t['tarefa_prazo']));
                		$mes = date("m",strtotime($t['tarefa_prazo']));
                		$dia = date("d",strtotime($t['tarefa_prazo']));
                  ?>
                  <tr>
                    <td><?php echo $t['titulo_projeto']; ?></td>
                    <td><?php echo $t['titulo_tarefa']; ?></td>
                    <td><?php echo '<img src="' . base_url() . 'uploads/' . $t['arquivo_avatar'] . '" class="img-circle user-thumbs">' . $t['nome'] . ' ' . $t['sobrenome']; ?></td>
                    <td><?php echo $dia . '/' . $mes . '/' . $ano; ?></td>
                    <td><span class="label label-danger"><?php echo timespan($now, $timestamp); ?></span></td>
                    <td>
                    	<a href="#" class="tarefa-notificar">
                    		<i class="fa fa-bell-o"></i>
                    	</a>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
            </div>
            <!-- /.box-footer -->
      </div>
		</div>
		<!-- <div class="col-lg-6">
			box
		</div> -->
	</div>
	<div class="row">
		<!-- Demandas aguardando avaliação -->
		<div class="col-lg-6">
			<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Demandas aguardando avaliação</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#info_aguardando" aria-expanded="false" aria-controls="#info_aguardando"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" id="info_aguardando">
          <div class="table-responsive">
            <table id="table_aguardando" class="table table-striped table-bordered no-margin" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th>Projeto</th>
                <th>Tarefa</th>
                <th>Líder</th>
                <th>Prazo</th>
                <th>Entrega</th>
                <th>#</th>
              </tr>
              </thead>
              <tfoot>
              <tr>
                <th>Projeto</th>
                <th>Tarefa</th>
                <th>Líder</th>
                <th>Prazo</th>
                <th>Entrega</th>
                <th>#</th>
              </tr>
              </tfoot>
              <tbody>
              <?php 
              // $this->load->helper('date');
              $now = time();
              foreach($tarefas_aguardam as $ta) { 
              	$timestamp = strtotime($ta['tarefa_prazo']);
              	$ano = date("Y",strtotime($ta['tarefa_prazo']));
            		$mes = date("m",strtotime($ta['tarefa_prazo']));
            		$dia = date("d",strtotime($ta['tarefa_prazo']));

            		$ano2 = date("Y",strtotime($ta['data_fim']));
            		$mes2 = date("m",strtotime($ta['data_fim']));
            		$dia2 = date("d",strtotime($ta['data_fim']));
              ?>
              <tr class="tarefa-aguardando-<?php echo $ta['codigo_tarefa']; ?>">
                <td><?php echo $ta['titulo_projeto']; ?></td>
                <td><?php echo $ta['titulo_tarefa']; ?></td>
                <td><?php echo '<img src="' . base_url() . 'uploads/' . $ta['arquivo_avatar'] . '" class="img-circle user-thumbs">' . $ta['nome'] . ' ' . $ta['sobrenome']; ?></td>
                <td><?php echo $dia . '/' . $mes . '/' . $ano; ?></td>
                <td>
                	<!-- <span class="label label-danger"> -->
                		<?php 
                		if (strtotime($ta['data_fim']) <= strtotime($ta['tarefa_prazo'])) {
                			echo '<span data-toggle="tooltip" data-title="Entrega no prazo" class="label-entrega label label-success">';
                		} else {
                			echo '<span data-toggle="tooltip" data-title="Entrega atrasada" class="label-entrega label label-danger">';
                		}
                		echo $dia2 . '/' . $mes2 . '/' . $ano2;//timespan($timestamp, $now); ?>
                	</span>
                </td>
                <td>
                	<!-- <ul class="list-inline">
	                	<li> -->
		                	<!-- <a href="#" class="tarefa-aceitar">
		                		<i class="fa fa-thumbs-o-up"></i>
		                	</a> -->
		               <!--  </li>
	                	<li> -->
	                		<?php 
	                			$this->load->helper('string');
	                		?>
		                	<a tabindex="0" class="tarefa-historico" role="button" 
		                		data-toggle="popover" 
		                		data-trigger="focus" 
		                		title="&nbsp;&nbsp;&nbsp;Ações&nbsp;&nbsp;&nbsp;"
												data-codigotarefa="<?php echo $ta['codigo_tarefa']; ?>"
												data-titulo="<?php echo strip_quotes($ta['titulo_tarefa']); ?>"
	                		>
		                			<i class="fa fa-2x fa-ellipsis-v"></i>
		                	</a>
		                	
		               <!--  </li>
                	</ul> -->
                </td>
              </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
        </div>
        <!-- /.box-footer -->
      </div>
		</div>
		<!-- Demandas atrasadas -->
		<div class="col-lg-6">
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Demandas atrasadas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#info_atrasadas" aria-expanded="false" aria-controls="#info_atrasadas"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="info_atrasadas">
              <div class="table-responsive">
                <table id="table_atrasadas" class="table table-striped table-bordered no-margin" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Projeto</th>
                      <th>Tarefa</th>
                      <th>Líder</th>
                      <th>Prazo</th>
                      <th>Tempo de atraso</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Projeto</th>
                      <th>Tarefa</th>
                      <th>Líder</th>
                      <th>Prazo</th>
                      <th>Tempo de atraso</th>
                      <th>#</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                  // $this->load->helper('date');
                  $agora = time();
                  foreach($tarefas_vencidas as $tv) { 
                  	$timestampa = strtotime($tv['tarefa_prazo']);
                  	$ano = date("Y",strtotime($tv['tarefa_prazo']));
                		$mes = date("m",strtotime($tv['tarefa_prazo']));
                		$dia = date("d",strtotime($tv['tarefa_prazo']));
                  ?>
                  <tr>
                    <td><?php echo $tv['titulo_projeto']; ?></td>
                    <td><?php echo $tv['titulo_tarefa']; ?></td>
                    <td><?php echo '<img src="' . base_url() . 'uploads/' . $tv['arquivo_avatar'] . '" class="img-circle user-thumbs">' .  $tv['nome'] . ' ' . $tv['sobrenome']; ?></td>
                    <td><?php echo $dia . '/' . $mes . '/' . $ano; ?></td>
                    <td><span class="label label-danger"><?php echo timespan($timestampa, $agora); ?></span></td>
                    <td>
                    	<a href="#" class="tarefa-notificar">
                    		<i class="fa fa-bell-o"></i>
                    	</a>
                    </td>
                  </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
            </div>
            <!-- /.box-footer -->
      </div>
		</div>
	</div>
</div><!-- /.container -->
<div class="modal fade" id="myModalObsVer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Observações da Demanda</h4>
	      </div>
	      <div class="modal-body">
	        Exibir histórico da demanda
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
	      </div>
	    </div>
	  </div>
	</div>
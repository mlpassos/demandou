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
					<span class="info-box-number"><?php echo $tarefas_entregues[0]['total']; ?></span>
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
					<span class="info-box-number"><?php echo $tarefas_aguardando[0]['total']; ?></span>
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
		<div class="col-lg-6">
			<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Demandas atrasadas</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#info_vencidas" aria-expanded="false" aria-controls="#info_vencidas"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="info_vencidas">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Projeto</th>
                    <th>Tarefa</th>
                    <th>Líder</th>
                    <th>Prazo</th>
                    <th>Tempo de atraso</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $this->load->helper('date');
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
		<div class="col-lg-6">
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
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Projeto</th>
                    <th>Tarefa</th>
                    <th>Líder</th>
                    <th>Prazo</th>
                    <th>Tempo restante</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  // $this->load->helper('date');
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
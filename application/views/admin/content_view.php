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
</div><!-- /.container -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <?php 
    foreach($meta as $m) {
      // echo $c['file'];
      echo  "<meta name='" . $m['name'] . "' content='" . $m['content'] . "'>\n";
    }
    ?>
    <meta name="author" content="Márcio Passos">
    <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico">

    <title>SECOM/DCI - Demandou 1.0 - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <?php 
    foreach($css as $c) {
      // echo $c['file'];
      echo  "<link href='" . base_url() . "assets/estilos/" . $c['file'] . "' rel='stylesheet'>";
    }
    ?>
    
   
        
    
     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Demandou</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse pull-right">
          <!-- SE USUÁRIO LOGADO MOSTRAR MENU -->
          <?php if ($this->session->userdata('logado')==true) { ?>
            <input type="hidden" name="session-usuario" id="session-usuario" class="session-usuario" value="<?php echo $this->session->userdata('login'); ?>">
            <ul class="nav navbar-nav">
              <!-- <li><a href="#" data-toggle="modal" data-target="#myModalAdicionarProjeto">Projetos</a></li> -->
              <li class="active"><a href="<?php echo base_url(); ?>projetos">Projetos</a></li>  
              <li><a href="<?php echo base_url(); ?>usuarios">Usuários</a></li>
              <li><a href="<?php echo base_url(); ?>relatorios">Relatórios</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <span class="icone-usuario glyphicon glyphicon-user"></span> 
                  <?php echo $this->session->userdata('login'); ?> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="#">Perfil</a></li>
                  <li><a href="#">Configurações</a></li>
                  <li role="separator" class="divider"></li>
                  <!-- <li class="dropdown-header">Nav header</li> -->
                  <!-- <li><a href="#">Separated link</a></li> -->
                  <li><a id="logout" href="#">Sair</a></li>
                </ul>
              </li>
              <!-- <li><a href="#contato">Contato</a></li> -->
            </ul>
            <!-- <div class="user-box ">
              <span class="icone-usuario glyphicon glyphicon-user"></span>
              <span class="nome-usuario">Nome do Usuário</span>
            </div>
 -->          <!-- SE USUÁRIO NÃO LOGADO MOSTRAR CAIXA DE LOGIN -->
          <?php } else {  ?>
          <form id="formLogin" class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" name="usuario" id="usuario" placeholder="Usuário" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="senha" id="senha" placeholder="Senha" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Entrar</button>
          </form>
        <?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
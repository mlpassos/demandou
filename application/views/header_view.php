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
    <link rel="icon" href="<?php echo base_url(); ?>/assets/favicon.ico">

    <title>Demandou v1.0a - <?php echo $meta[0]['content']; ?></title>

    <?php 

    if ($this->uri->segment(1)=="projetos" OR $this->uri->segment(1)=="tarefa") {
      echo '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">';
    }

    ?>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
    <?php  //var_dump($meta); ?>
    <?php if ($this->session->userdata('logado')==true) { ?>
      <input type="hidden" id="usuario_codigo" value="<?php echo $this->session->userdata('codigo_usuario') ?>">
      <input type="hidden" id="nome_usuario" value="<?php echo $this->session->userdata('nome') . $this->session->userdata('sobrenome'); ?>">
      <input type="hidden" id="avatar_usuario" value="<?php echo $this->session->userdata('arquivo_avatar') ?>">
    <?php } ?>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <img src="http://www.finer.com.br/wp-content/uploads/2015/06/demanda-e1433765779365.png"> -->
          <a class="navbar-brand" href="<?php echo base_url(); ?>">Demandou</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse pull-right">
          <!-- SE USUÁRIO LOGADO MOSTRAR MENU -->
          <?php if ($this->session->userdata('logado')==true) { ?>
            <input type="hidden" name="session-usuario" id="session-usuario" class="session-usuario" value="<?php echo $this->session->userdata('login'); ?>">
            
            <ul class="nav navbar-nav">
              <?php 
                foreach($menu as $m) {
                  echo  "<li class='" . $m['class'] . "'><a href='" . $m['link'] . "'>" . $m['name'] . "</a></li>";
                }
              ?>  
              <!-- PADRÃO -->
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
              <!-- PADRÃO -->

            </ul>
          <!-- SE USUÁRIO NÃO LOGADO MOSTRAR CAIXA DE LOGIN -->
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
<div class="container-fluid ajaxload">

<?php if ($this->session->userdata('logado')==true) { ?>
<p>Bem vindo, <strong><?php echo $this->session->userdata('nome') . ' ' . $this->session->userdata('sobrenome'); ?></strong></p>
<?php } ?>

</div><!-- /.container -->
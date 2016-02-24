
<?php 

$config = array(
        'usuario_controller/adicionar' => array(
                array(
                        'field' => 'login',
                        'label' => 'Login',
                        'rules' => 'trim|required|callback_checar_login', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(
                        'field' => 'nome',
                        'label' => 'Nome',
                        'rules' => 'trim|required|min_length[5]|max_length[12]', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(
                        'field' => 'sobrenome',
                        'label' => 'Sobrenome',
                        'rules' => 'trim|required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(
                        'field' => 'data_nascimento',
                        'label' => 'Data de nascimento',
                        'rules' => 'trim|required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(
                        'field' => 'codigo_perfil',
                        'label' => 'Perfil',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(
                        'field' => 'codigo_funcao',
                        'label' => 'Função',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                                // ,
                                // "check_default" => "Você precisa escolher uma função."
                        )
                ),
                array(
                        'field' => 'senha',
                        'label' => 'Senha',
                        'rules' => 'trim|required|matches[confirmar_senha]|md5',
                        'errors' => array(
                                "required" => "O campo %s é necessário.",
                                "matches" => "As senhas não são iguais."
                        )
                ),
                array(
                        'field' => 'confirmar_senha',
                        'label' => 'Confirmar Senha',
                        'rules' => 'trim|required|md5',
                        'errors' => array(
                                "required" => "O campo %s é necessário.",
                        )
                ),
                array(
                        'field' => 'email',
                        'label' => 'E-mail',
                        'rules' => 'trim|required|valid_email|is_unique[usuario.email]',
                        'errors' => array(
                                "required" => "O campo %s é necessário.",
                                "valid_mail" => "O campo %s deve conter um endereço válido.",
                                "is_unique" => "O %s já está associado a outro usuário."
                                )
                )
        ),
        'projeto_controller/adicionar' => array(
                array(  
                        'field' => 'titulo',
                        'label' => 'Titulo',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'descricao',
                        'label' => 'Descrição',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'data_inicio',
                        'label' => 'Início',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                 array(  
                        'field' => 'data_prazo',
                        'label' => 'Prazo',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                  array(  
                        'field' => 'lider',
                        'label' => 'Líder',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'participantes[]',
                        'label' => 'Participantes',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'prioridade',
                        'label' => 'Prioridade',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                )
        ),
        'projeto_controller/alterar' => array(
                array(  
                        'field' => 'titulo',
                        'label' => 'Titulo',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'descricao',
                        'label' => 'Descrição',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'data_inicio',
                        'label' => 'Início',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                 array(  
                        'field' => 'data_prazo',
                        'label' => 'Prazo',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'participantes[]',
                        'label' => 'Participantes',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'prioridade',
                        'label' => 'Prioridade',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                )
        ),
        'tarefa_controller/adicionar' => array(
                array(  
                        'field' => 'titulo',
                        'label' => 'Titulo',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'descricao',
                        'label' => 'Descrição',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'prioridade',
                        'label' => 'Prioridade',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'data_inicio',
                        'label' => 'Início',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                 array(  
                        'field' => 'data_prazo',
                        'label' => 'Prazo',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                  array(  
                        'field' => 'lider[]',
                        'label' => 'Líder',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                )
        ),
        'tarefa_controller/alterar' => array(
                array(  
                        'field' => 'titulo',
                        'label' => 'Titulo',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'descricao',
                        'label' => 'Descrição',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'prioridade',
                        'label' => 'Prioridade',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                array(  
                        'field' => 'data_inicio',
                        'label' => 'Início',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                 array(  
                        'field' => 'data_prazo',
                        'label' => 'Prazo',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                ),
                  array(  
                        'field' => 'lider[]',
                        'label' => 'Líder',
                        'rules' => 'required', 
                        'errors' => array(
                                "required" => "O campo %s é necessário."
                        )
                )
        )
);

$config['error_prefix'] = '<div><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span class="sr-only">Error:</span>';
$config['error_suffix'] = '</div>';
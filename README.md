# Desafio Técnico: Sistema de Agendamento Médico - Mindtec :green_heart:

## Objetivos
O objetivo desse desafio técnico é desenvolver módulo de cadastro e agendamento médico de uma plataforma.
* 1 - Cadastrar um paciente vinculando 2 responsáveis obrigatoriamente
* 2 - Listar pacientes cadastrados
* 3 - Atualizar campos e responsáveis do paciente
* 4 - Deletar o paciente e seus responsáveis
* 5 - Cadastrar agendamento vinculando paciente e médico consultado via json mock
* 6 - Atualizar status de um agendamento para: Agendado(1), em Cancelado(2) ou Realizado(3)

## Linguagens, frameworks, libs e softwares utilizados 
* Laravel 12
* Composer 2.8
* PHP 8.2
* MySQL 8.4
* Npm 9.2
* iMask.js
* Toastify

## Instruções para execução local
1º Instale o <a href="https://www.php.net/">PHP</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
2º Instale o <a href="https://git-scm.com/">Git</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
3º Instale o <a href="https://getcomposer.org/">Composer</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
4º Instale o <a href="https://www.mysql.com/">MySQL</a> de acordo com seu sistema operacional e a versão descrita acima
<br>
5º Instale o <a href="https://docs.npmjs.com/downloading-and-installing-node-js-and-npm">Npm</a> de acordo com seu sistema operacional e a versão descrita acima
<br>

6º No terminal do seu sistema operacional, execute o comando abaixo para clonar o projeto
```
git clone https://github.com/icaro-nog/teste-tecnico-mindtec.git (HTTPS)
ou
git clone git@github.com:icaro-nog/teste-tecnico-mindtec.git (SSH)
```
7º Na pasta raiz do projeto clonado, para atualizar e instalar as dependências do <b>Npm</b>, execute os comandos abaixo
```
npm install && npm run build
```

8º Vá até o arquivo <b>teste-tecnico-mindtec/.env.example</b>, renomeie para <b>.env</b> e atualize as credenciais de conexão com o banco de dados, de acordo com o que foi definido na instalação do MySQL
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mindtec
DB_USERNAME= # USUARIO DEFINIDO
DB_PASSWORD= # SENHA DEFINIDA
```
9º Agora, execute o comando abaixo para criação da <b>base de dados e tabelas</b> no banco de dados
```
php artisan migrate
```
10º Para servir a aplicação, execute o seguinte comando
```
composer run dev
```
Após isso, a aplicação estará pronta para testagens!

### Rota para Cadastro de Paciente vinculando Responsáveis
```
/cadastro-paciente
```
Preencha os campos necessários e clique em <b>Cadastrar</b>
<br>
![image](https://github.com/user-attachments/assets/2696437a-3f9e-4225-9581-a0815c115c7f)
<br>
Ao cadastrar corretamente, você será direcionado para a <b>listagem</b> de pacientes
<br>
![image](https://github.com/user-attachments/assets/49cc19c6-029f-43e3-9c51-1b7de3f63b5b)

### Rota para Cadastro de Agendamento vinculando Paciente
```
/cadastro-agendamento
```
Ao selecionar o paciente, serão preenchidos os campos readonly. 
<br>
O campo <b>Médico</b> só é liberado para preenchimento ao selecionar o paciente.
<br>
Caso o médico não seja da mesma cidade em que o paciente, será apresentado um toast informando e <b>não permitindo</b> prosseguir com o agendamento.
<br>
Caso o paciente já tiver 3 agendamentos, não será permitido a criação de um novo.
<br>
![image](https://github.com/user-attachments/assets/e4860480-9dcb-455a-81eb-f7c03ea0205b)
<br>
Ao cadastrar corretamente, você será direcionado para a <b>listagem</b> de agendamentos
<br>
![image](https://github.com/user-attachments/assets/158ebf54-55ab-4ee7-8b88-2b0d66c48fa2)


## Diagrama de Entidades
![image](https://github.com/user-attachments/assets/32800005-010a-4cc6-8ac8-754161550834)

## Decisões Técnicas
* Armazenamento do cep do paciente pra comparação de cidades na tela de agendamento utilizando cep do médico
* Centralização da api ViaCEP e api simulada dos médicos em controllers para facilitar reutilização e gravação de logs
* Armazenamento de dados do médico na tabela de agendamentos para futuras consultas
* Não uso de componentes blade para agilizar a entrega, mas a custo de código acoplado nas views
* Uso da lib Toastify para evitar alerts

## Possíveis melhorias ou pontos não esclarecidos no escopo do teste
* Agendamento pode ser feito com data retroativa? Se não, é necessário correção no datepicker
    - se agendado, data futura
    - se realizado, data retroativa
    - se cancelado, data retroativa
* Ao atualizar o cep do paciente com agendamento vinculado, o que deve ser realizado com o agendamento? E ao deletar o paciente?
* Opcional o preenchimento do CPF do paciente, visto que o mesmo pode não possuir
* Validação para responsáveis serem maior de 18 anos
* Vinculação de mais responsáveis ao paciente
* Paginação da listagem de registros

## Tarefas extras
Código fonte de Feature Test de cadastro de um paciente com 2 responsáveis está no arquivo: ```teste-tecnico-mindtec/tests/Feature/PacienteControllerTest.php```
```
php artisan test
```

Para exportação de agendamentos por paciente para CSV, acesse:
```
paciente/{id do paciente}/edit
```
Clique em <b>Agendamentos CSV</b>
<br>
![image](https://github.com/user-attachments/assets/510d42c9-50af-4999-aeae-5b78ea29435f)
<br>




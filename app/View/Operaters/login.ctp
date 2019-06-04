<h1>Login</h1>
<?php
echo $this->Form->create('Operater');
echo __('Please enter your username and password');
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->end('Login');
?>
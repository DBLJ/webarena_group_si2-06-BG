<?php $this->assign('title', 'connexion');?>
<?php echo $this->Html->link('Vision', '/'); ?>


<form name="login" action="login" method="post" accept-charset="utf-8">

		<ul>
                        
			<input type="hidden" name="process" value="login">
			
			<li>
				<label for="usermail">Email</label>
				<input type="email" name="usermail" placeholder="yourname@email.com" required>
			</li>
			<li>
				<label for="password">Password</label>
				<input type="password" name="password" placeholder="password" required></li>
			<li>
				<input type="submit" value="Login">
			</li>
		</ul>
</form>

<?php echo $this->form->create('Sign-in',array(
    'id'=>'UserSignupForm',
    'url'=> array(
        'controller'=>'Arena',
        'action'=>'login'
    )
)); ?>
<?php echo $this->form->input('process', ['type'=>'hidden']); ?>
<?php echo $this->form->input('email', array('label'=>"Your email address : ",'size'=>50)); ?>
<?php echo $this->form->input('password', array('label'=>"Your password : ")); ?>
<?php echo $this->form->submit('Submit'); ?>
<?php echo $this->form->end(); ?>


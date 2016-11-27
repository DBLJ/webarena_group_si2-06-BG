<?php $this->assign('title', 'connexion');?>
<div id="backButton">
	<p class="clickable" onclick="redirect('back')">back</p>
</div>
<div id="choiceDiv">
<p class="clickable" id="goToLoginDiv" onclick="redirect('login')"> se connecter </p>
<p class="clickable" id="goToSignInDiv" onclick="redirect('signIn')"> créer un compte</p>
</div>
<div id="loginDiv">
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
</div>

<div id="signInDiv">
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
</div>

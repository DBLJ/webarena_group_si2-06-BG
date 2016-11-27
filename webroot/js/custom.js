function test(arg1,arg2)
{
  document.location.href="/testrename/arena/sight/"+arg1+"/"+arg2;
}

function redirect(arg1){
choicediv = document.getElementById('choiceDiv'),
logindiv = document.getElementById('loginDiv'),
signindiv = document.getElementById('signInDiv');

if (arg1=="login") {
	choicediv.style.display = "none";
	logindiv.style.display = "flex";
}

if (arg1=="signIn") {
	choicediv.style.display = "none";
	signindiv.style.display = "flex";
}
}
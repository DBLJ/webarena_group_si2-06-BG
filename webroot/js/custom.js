function test(arg1,arg2)
{
  document.location.href="/testrename/arena/sight/"+arg1+"/"+arg2;
}

function redirect(arg1){
choicediv = document.getElementById('choiceDiv'),
logindiv = document.getElementById('loginDiv'),
signindiv = document.getElementById('signInDiv'),
backbutton = document.getElementById('backButton');


if (arg1=="login") {
	choicediv.style.display = "none";
	logindiv.style.display = "flex";
	backbutton.style.display = "inline-block";
}

if (arg1=="signIn") {
	choicediv.style.display = "none";
	signindiv.style.display = "flex";
	backbutton.style.display = "inline-block";
}
if (arg1=="back") {
	choicediv.style.display = "flex";
	signindiv.style.display = "none";
	logindiv.style.display = "none";
	backbutton.style.display = "none";
}
}
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  var getEmail = profile.getEmail();
  document.getElementById('getLogin').value = getEmail;
  document.getElementById('getLoginSubmit').click();
  console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
  console.log('Name: ' + profile.getName());
  console.log('Image URL: ' + profile.getImageUrl());
  console.log('Email: ' + profile.getEmail());
  console.log(profile);
}

function add_message(id1, id2){

	var parent = document.getElementById(id1);
	var child = document.getElementById(id2);
	var node = createElement("P");
	var text = child.value;
	var text_node = document.createTextNode(text);
	node.appendchild(text_node);
	parent.appendchild(node);
}

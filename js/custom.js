function send_message(){
	var name=jQuery("#name").val();
	var email=jQuery("#email").val();
	var mobile=jQuery("#mobile").val();
	var message=jQuery("#message").val();
	
	if(name==""){
		alert('Please enter name');
	}else if(email==""){
		alert('Please enter email');
	}else if(mobile==""){
		alert('Please enter mobile');
	}else if(message==""){
		alert('Please enter message');
	}else{
		jQuery.ajax({
			url:'send_message.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
			success:function(result){
				alert(result);
			}	
		});
	}
}
/* registrovanje korisnika i provjera preko jQuery-a*/
function user_register(){
	jQuery('.field_error').html('');
	var name=jQuery("#name").val();
	var nameReg = /^[a-zA-Z\s]*$/; 
	var email=jQuery("#email").val();
	var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	var mobile=jQuery("#mobile").val();
	var password=jQuery("#password").val();
	var passwordReg = /^[A-Za-z0-9_-]*$/; 
	var is_error='';
	if(name==""){
		jQuery('#name_error').html('Unesite ime');
		is_error='yes';
	}if(!name.match(nameReg)){
		jQuery('#name_error').html('Mozete unijeti samo slova i razmak');
		is_error='yes';
	}
	if(email==""){
		jQuery('#email_error').html('Unesite email');
		is_error='yes';
	}if(!email.match(emailReg)){
		jQuery('#email_error').html('Nije prafilno unesen format fajla');
		is_error='yes';
	}if(mobile==""){
		jQuery('#mobile_error').html('Please broj telefona');
		is_error='yes';
	}if(password==""){
		jQuery('#password_error').html('Unesite lozinku');
		is_error='yes';
	}
	if(!password.match(passwordReg)){
		jQuery('#password_error').html('Lozinka samo moze da ima slova i brojeve');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'register_submit.php',
			type:'post',
			data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
			success:function(result){
				if(result=='email_present'){
					jQuery('#email_error').html('Email se vec koristi');
				}
				if(result=='insert'){
					jQuery('.register_msg p').html('Hvala na registraciji');
				}
			}	
		});
	}
	
}


/* Logovanje usera */
function user_login(){
	jQuery('.field_error').html('');
	var email=jQuery("#login_email").val();
	var password=jQuery("#login_password").val();
	var is_error='';
	if(email==""){
		jQuery('#login_email_error').html('Unesite email adresu');
		is_error='yes';
	}if(password==""){
		jQuery('#login_password_error').html('Uneiste lozinku');
		is_error='yes';
	}
	if(is_error==''){
		jQuery.ajax({
			url:'login_submit.php',
			type:'post',
			data:'email='+email+'&password='+password,
			success:function(result){
				if(result=='wrong'){
					jQuery('.login_msg p').html('Unesite validne inpute');
				}
				if(result=='valid'){
					window.location.href=window.location.href;
				}
			}	
		});
	}	
}

/* izvrsava izmjene korpe (update,remove,select) */
function manage_cart(pid,type){
	if(type=='update'){
		var qty=jQuery("#"+pid+"qty").val();
	}else{
		var qty=jQuery("#qty").val();
	}
	jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type,
		success:function(result){
			if(type=='update' || type=='remove'){
				window.location.href=window.location.href;
			}
			jQuery('.htc__qua').html(result);
		}	
	});	
}

function sort_product_drop(cat_id,site_path){
	var sort_product_id=jQuery('#sort_product_id').val();
	window.location.href=site_path+"categories.php?id="+cat_id+"&sort="+sort_product_id;
}
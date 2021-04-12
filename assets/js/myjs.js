
$(function() {

	$(document).on('click', '.connect_btn', function() {
		var reg_no = $(this).data('no');
		var name = $(this).data('name');
		var reg_no_from = $(this).data('reg_no_from');
		var action = 'send_request';
		//var no_cache = Math.random() * 1000000;
		if (reg_no != "") {
			alert(reg_no+' '+name);
			$.ajax({
				type: "POST",
				url: "includes/connect.php",
				data: {reg_no:reg_no, action:action, reg_no_from:reg_no_from},
				beforeSend: function() {
					$('#connect_btn_'+name).attr('disabled', 'disabled');
					$('#connect_btn_'+name).html('<i class="fa fa-circle-o-notch fa-spin"></i> Sending...');
				},
				success: function(data) {
					$('#connect_btn_'+name).html('<i class="fa fa-clock-o" aria-hidden="true"></i> Request Sent');
				},

				dataType: 'html'

			});
		}
	});

	$(document).on('click', '#process_image', function(){
		const file = document.querySelector("#upload").files[0];
		if (!file) return;

		const reader = new FileReader();
		reader.readAsDataURL(file);

		reader.onload = function(event) {
			const imgElement = document.createElement("img");
			imgElement.src = event.target.result;
			//document.querySelector("#input").src = event.target.result;

			imgElement.onload = function(e) {
				const canvas = document.createElement("canvas");
				const MAX_WIDTH = 200;
				if (e.target.width > e.target.height) {

				}

				const scaleSize = MAX_WIDTH / e.target.width;
				canvas.width = MAX_WIDTH;
				canvas.height = e.target.height * scaleSize;

				const ctx = canvas.getContext("2d");
				ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);

				const srcEncoded = ctx.canvas.toDataURL(e.target, "image/jpeg");

				document.querySelector("#output").src = srcEncoded;
			}
		}
	});

	function load_connection_request_list_data(no) {
		var action = 'load_connection_request_list';
		var user_reg_no = no; 
		$.ajax({
			url:"includes/connect.php",
			method:"POST",
			data:{action: action, user_reg_no: user_reg_no},
			// beforeSend:function() {
			// 	$('#connection_request_list').html('<li align="center"><i class="fa fa-circle-o-notch fa-spin"></i></li>');

			// },
			success:function(data) {
				$('#connection_request_list').html(data);
				//remove_friend_request_number();
			}
		});
	}

	$('.dropdown_click').click(function(event){
		event.preventDefault();

		var user_reg_no = event.target.getAttribute('data-user_reg_no');
		var id = event.target.getAttribute('data-id');
		//alert('clicked');
		if(id > 0){
			$.ajax({
				url:"includes/connect.php",
				method:"POST",
				data:{id:id, action:'accept_connection'},
				beforeSend:function() {
					$('#accept_connection_btn_'+id).attr('disabled', 'disabled');
					$('#accept_connection_btn_'+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>Wait...');
				},
				success: function(data) {
					$('#accept_connection_btn_'+id).html('<i class="fa fa-circle-o-notch"></i>'+data);
				}
			});
		}
		load_connection_request_list_data(user_reg_no);
	});

	// $('.dropdown_menu_connection_request_list').click(function(event) {
	// 	event.preventDefault();
	// 	//var requested_reg_no = event.target.getAttribute('data-requested_reg_no');
	// 	var user_reg_no = event.target.getAttribute('data-user_reg_no');
	// 	var action = 'load_connection_request_list';

	// 	$.ajax({
	// 		url:"includes/connect.php",
	// 		method:"POST",
	// 		data:{action: action, user_reg_no: user_reg_no},
	// 		beforeSend:function() {
	// 			$('#connection_request_list').html('<li align="center"><i class="fa fa-circle-o-notch fa-spin"></i></li>');

	// 		},
	// 		success:function(data) {
	// 			$('#connection_request_list').html(data);
	// 			//remove_friend_request_number();
	// 		},
	// 		dataType: 'html'
	// 	});

	// });


	// $(document).on('click', '.accept_connection_btn', function() {
	// 	var requested_reg_no = $(this).data('requested_reg_no');
	// 	var action = 'accept_connection';
	// 	if (requested_reg_no != '') {
	// 		$.ajax({
	// 			url:"includes/connect.php",
	// 			method:"POST",
	// 			data:{requested_reg_no: requested_reg_no, action:action},
	// 			beforeSend: function() {
	// 				$('#accept_connection_btn'+requested_reg_no).attr('disabled', 'disabled');
	// 				$('#accept_connection_btn'+requested_reg_no).html('<i class="fa fa-circle-o-notch fa-spin"></i>Wait...');
	// 			},
	// 			success: function() {
	// 				load_connection_request_list_data(user_reg_no);
	// 				//$('#accept_connection_btn'+requested_reg_no).html('<i class=""></i>accepted');

	// 			}
	// 		});
	// 	}

	// });


	

	$('.accept_connection_btn').click(function(event) {
		//alert('clicked');
		//event.preventDefault();
		var id = event.target.getAttribute('data-id');
		var user_reg_no = event.target.getAttribute('data-user_reg_no');

		if(id > 0){
			$.ajax({
				url:"includes/connect.php",
				method:"POST",
				data:{id:id, action:'accept_connection'},
				beforeSend:function() {
					$('#accept_connection_btn_'+id).attr('disabled', 'disabled');
					$('#accept_connection_btn_'+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>Wait...');
				},
				success: function(data) {
					$('#accept_connection_btn_'+id).html('<i class="fa fa-circle-o-notch"></i>'+ data);
				}
			});
		}

		//load_connection_request_list_data(user_reg_no);

	});


	$('.social').click(function() {
		location.replace('campus_connect.php');
	});

	$('.love').click(function() {
		location.replace('relationship_connect.php');
	});

	$('.sports').click(function() {
		location.replace('sports_connect.php');
	});

	$('.academics').click(function() {
		location.replace('course_connect.php');
	});

	$('.percent_status').click(function() {
		location.replace('create_profile.php');
	})


	$('.btn_buy').click(function(event) {
		//alert('clicked');
		var buyer_reg_no = event.target.getAttribute('data-buyer_reg_no');
		var ads_id = event.target.getAttribute('data-ads_id');
		if ( buyer_reg_no = '') {
			location.replace('index.php');
		}
		$.ajax({
			url:"includes/interested_buyer.php",
			method: "POST",
			data: {buyer_reg_no:buyer_reg_no, ads_id:ads_id},
			beforeSend: function() {
				$('.btn_buy_'+ads_id).attr('disabled', 'disabled');
				$('.btn_buy_'+ads_id).html('<i class="fa fa-circle-o-notch fa-spin"></i>Wait...');
			},
			success: function(data) {
				$('.btn_buy_'+ads_id).html('Request sent');
			}
		});

	});


});

function accept_connection(id) {
	//alert('hi');
	//event.preventDefault();
	var connection_id = id;
	// event.target.getAttribute('data-id');
	//var user_reg_no = $(this).data('user_reg_no');
	// event.target.getAttribute('data-user_reg_no');

	if(id > 0){
		$.ajax({
			url:"includes/connect.php",
			method:"POST",
			data:{id:connection_id, action:'accept_connection'},
			beforeSend:function() {
				$('#accept_connection_btn_'+id).attr('disabled', 'disabled');
				$('#accept_connection_btn_'+id).html('<i class="fa fa-circle-o-notch fa-spin"></i>Wait...');
			},

			success: function(data) {
				$('#accept_connection_btn_'+id).html('<i class="fa fa-circle-o-notch"></i>'+data);
				//load_connection_request_list_data(user_reg_no);
			}
		});
	}
}

function replaceSlashes(reg_no) {
	let orig_string = reg_no;
	let replacement_string = '_';
	let replaced_string = orig_string.replace(/\//g, replacement_string);
	return replaced_string;
}

// function ajaxRequest() {
// 	try {
// 		var request = new XMLHttpRequest()
// 	} catch( e1 ) {
// 		try {
// 			request = new ActiveXObject( "Msxml2.XMLHTTP" )
// 		} catch( e2 ) {
// 			try {
// 				request = new ActiveXObject( "Miscrosoft.XMLHTTP" )
// 			} catch( e3 ) {
// 				request = false
// 			}
// 		}
// 	}

// 	return request
// }

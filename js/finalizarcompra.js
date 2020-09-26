$(function(){
	

	$('a.btn-pagamento').click(function(e){
		e.preventDefault();
		$.ajax({
			url:include_path+'ajax/finalizarPagamento.php'
		}).done(function(data){
				
				
				
				var isOpenLightBox = PagSeguroLightbox({
					code:data
				},{
					success: function(transactionCode){
						location.href=include_path;
					},
					abort:function(){
						location.href=include_path;
					}
				});

				console.log(isOpenLightBox);
				
		})

		
	})	
})
$(document).ready(function(){
	// untuk melakukan delete pada link
	$(".delete").click(function(){
		return confirm("Apakah anda yakin akan menghapus data ini?");
	})

	//untuk melakukan filter data table
	$(".filter").keyup(function(){
		var input = $(this).val().toLowerCase();

		for(i = 0; i <= $(".filter_data tr").length; i++){
			if($(".filter_data tr").eq(i).text().toLowerCase().indexOf(input) > -1){
				$(".filter_data tr").eq(i).show();
			}else{
				$(".filter_data tr").eq(i).hide();
				$(".filter_data tr").eq(0).show();
			}
		}
	})

	//untuk menampilkan tanggal dengan datepicker
	$(".datepicker").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "-60y:c"
	});
	
	//untuk membuat input menjadi huruf capitalize
	$(".capitalize").keyup(function(){
		$(this).css("text-transform", "capitalize");
	})
})
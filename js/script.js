$(document).ready(function() {
	$(".tanggal_awal, .tanggal_akhir").datepicker({
		dateFormat: "DD, dd MM yy",
		showMonth: true,
		showYear: true,
		yearRange: "-60y:c",
		dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"]
	})
	
	$(".timepicker").timepicker({
		timeFormat: "HH:mm:ss",
		stepHour: 1,
		stepMinute: 1,
		stepSecond:1
	})

});
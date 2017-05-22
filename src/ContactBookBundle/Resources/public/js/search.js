$(document).ready(function(){
	var search_count ;
	$("div.div_name").show();

	$("input#search").keyup(function(){

		$(".div_name").hide();
		$(".no_search_result" ).hide();

		var search_key = $("#search").val();
		var result_boxes = $(".div_name[name ^='"+search_key+"']");
		var search_count = result_boxes.length;


		if(search_count >=1) {
			$(".no_search_result" ).hide();
			result_boxes.show();
		}else{
			$(".no_search_result" ).show();
			result_boxes.hide();
		}
		if(!this.value){
			$("div.div_name").show();
			$(".no_search_result").hide();
		}
	});
});

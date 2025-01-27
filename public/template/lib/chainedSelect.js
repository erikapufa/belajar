$(document).ready(function () {
	$(".chainedSelect").each(function () {
		let $element = $(this); 
		let parentId = $element.data("parent"); 
		let target = $element.data("target");
		
		if (parentId) {
			$("#" + parentId).change(function () {
				let parentValue = $(this).val(); 
				if (parentValue) {
					let url = baseClass + "/option_" + target + "/" + parentValue;

					$element.load(url, function () {
						$element.trigger("change"); 
					});
				} else {
					$element.html('<option value="">-Pilih Jurusan</option>');
				}
			});
		} else {
			if (target) {
				let url = baseClass + "/option_" + target;
				$element.load(url, function () {
					$element.trigger("change"); // Trigger event change setelah opsi dimuat
				});
			}
		}
	});
});

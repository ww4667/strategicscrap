<script src="https://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<style type="text/css">
	#register_now{display:none;}
	.brokerPricing label{font-weight:700}
	.brokerPricing .materials .w1 input{width:50px}
	.brokerPricing .materials .w2 input{width:110px}
	.brokerPricing .materials .w3 input{width:150px}
	.brokerPricing .materials .w1{width:70px}
	.brokerPricing .materials .w2{width:130px}
	.brokerPricing .materials .w3{width:160px}
	.brokerPricing li{float:left;display:block}
	.brokerPricing li label{width:100px}
	.content {display:block;}
	/*
.brokerPricing li input,
	.brokerPricing li select{clear:left}
*/
	.brokerPricing a{text-decoration:underline;}
	.brokerPricing .submitButton{text-align:left;}
	.brokerPricing .form.user li{margin-right:20px;}
	.brokerPricing label.error{clear:left; color:#F00}
	.brokerPricing input.required,
	.brokerPricing select.required{color:#000}
	.brokerPricing .message{padding:10px;width:100%;color:#0C0;font-weight:bold;font-size:15px;}
	.brokerPricing .message.error{color:#F00}
</style>
<div class="brokerPricing">
<?php if (isset($message)) { ?>
	<div class="message<?=isset($error)?' error':''?>"><?=$message;?></div>
<?php } ?>
	<p>All pricing contributions shall remain strictly confidential.</p>
	<form action="" method="post" id="price_form">
		<ul class="form user">
			<li><strong><?= $broker->first_name ?> <?= $broker->last_name ?></strong><input type="hidden" name="broker[id]" value="<?= $broker->id ?>" /> :: <a href="/broker-pricing-form?logout" title="logout">logout</a><br /><?= $broker->company ?></li>
		</ul>
		<hr />
		<ul class="form user">
			<li class="w3">
				<select name="facility[id]" id="facility_select" class="required">
					<option value="" selected="selected">Select a Facility</option>
					<? foreach ($facilities as $facility) { ?>
					<option value="<?= $facility->id ?>"><?= $facility->name ?> - <?= $facility->city ?>, <?= $facility->state ?></option>	
					<? } ?>
				</select>
			</li>
		</ul>
		<br />
		<ul class="form user">
			<li>Leave price blank if there is nothing to report.</li>
		</ul>
		<br />
<? // Let's make some material lists per facility!!! ?>
		<? foreach ($facilities as $f) { ?>
		<ul id="facility_<?= $f->id  ?>" class="form materials" style="display:none;height:auto">
		<? foreach ($f->materials as $m) { ?>
			<li id="facility_<?= $f->id ?>_<?= $m->id ?>"><label><?= $m->name ?>:</label><input class="w1" type="text" name="entry[facility_<?= $f->id ?>][<?= $m->id ?>]" /></li>
		<? } ?>
		</ul>
		<? } ?>
<? // Let's be done making material lists... ?>
		<br />
		<ul class="new_material form user" style="display:none">
			<li class="w3">
				<select name="new_material" id="new_material">
					<option value="" selected="selected">++Add a Material++</option>
					<? foreach ($materials as $material) { ?>
					<option value="<?= $material->id ?>"><?= $material->name ?></option>	
					<? } ?>
				</select>
			</li>
		</ul>
		<hr />
		<ul class="form">
			<li>By contributing pricing to StrategicScrap.com, I agree that the pricing information I am providing on this form is accurate and representative of market conditions at the time of my reporting.</li>
			<li><input id="agree" style="width: 20px;" name="agree" type="checkbox" class="required" /><strong>*</strong>  I agree</li>
		</ul>
		<div class="submitButton">
			<input id="submitPrice" alt="Submit Pricing o" name="submitPrice" src="resources/images/buttons/submit_pricing.png" type="image" />
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $("#price_form").validate();
		
		$("#facility_select").change(function(){
			var num = $(this).val();
			var active = $("#facility_"+num);
			var lists = $("ul.materials").not(active);
			var counter = lists.length;
			lists.slideUp("fast",function(){
				counter--;
				if ( !counter ){
					// Do your stuff
					active.slideDown("fast");
					$("ul.new_material").show();
				}
			});
		});
		
		$("#new_material").change(function(){
			var selected     = $(this).find("option:selected");
			var current_list = $("ul.materials").not(":hidden").find("li");
			var num          = current_list.length;
			var facility_id  = $("ul.materials").not(":hidden").attr("id");
			var newEntry     = $("ul.materials").not(":hidden").find("li:first").clone().attr("id",facility_id + "_" + selected.val());
			
			var exist        = $("li#" + facility_id + "_" + selected.val()).length;
			// make sure this one hasn't been added yet
			if(exist == 0){
				// add the new field and set attributes/value
				$("ul.materials").not(":hidden").find("li:last").after(newEntry);
				$("li#" + facility_id + "_" + selected.val()).find("input").attr("name","entry[" + facility_id + "][" + selected.val() + "]")
				.val("").focus().parent().find("label").text(selected.text() + ":");
				// reset the new material drop-down
				$(this).val($("option:first",this).val());
			} else {
				alert("material already listed");
				// reset the new material drop-down
				$(this).val($("option:first",this).val());
			}
		});
	});
</script>

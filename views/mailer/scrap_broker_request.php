
		<h2><strong>You have a bid request.</strong><br></h2>
          <table width="95%" border="0" cellspacing="0" cellpadding="10">
            <tr>
              <td bgcolor="#F5F5F5" style="background-color:#F5F5F5;font-size:12px;font-family:Arial, Helvetica, sans-serif;line-height:20px;color:#666">
				<!--BODY CONTENT START-->
				 <p>The details of your bid request are below. Contact the requester directly with your bid for this request.</p>
				 <h3>Request Details:</h3>
				 <p><strong>Contact:</strong> <? echo $object->request_snapshot['scrapper']['first_name'] ?> <? echo $object->request_snapshot['scrapper']['last_name'] ?></p>
				 <p><strong>Phone:</strong> <? echo isset($object->request_snapshot['from']) ? $object->request_snapshot['from']['from_work_phone'] : $object->request_snapshot['scrapper']['work_phone'] ?><br />
				 <strong>Email:</strong> <? echo $object->user['email'] ?></p>
				 <p><strong>Material:</strong> <? echo $object->request_snapshot['material']['name'] ?><br />
				 <strong>Volume:</strong> <? echo $object->volume ?></p>
<?php
/*
				 <hr />
				 <p><strong>Ship From:</strong><br />
				 <?php // from company ?><br />
				 <?php // from ?></p>
				 <p><strong>Ship To:</strong><br />
				 <?php // to company ?><br />
				 <?php // to ?></p>
				 <hr />
				 <p><strong>Transportation Type:</strong> <?php // transportation type ?></p>
				 <p><strong>Ship on or before:</strong> <?php // material name ?></p>
				 <p><strong>Deliver on or before:</strong> <?php // material name ?></p>
 */
?>
				 <hr />
				 <p><strong>Special Instructions:</strong> <? echo $object->special_instructions ?></p>
				<!--BODY CONTENT END-->
              </td>
			</tr>
          </table>
          <img src="http://www.speechbuddy.com/assets/images/hordivider.gif" />
          <p>Questions? <a href="mailto:StrategicInfo@StrategicScrap.com">StrategicInfo@StrategicScrap.com</a>.</p>

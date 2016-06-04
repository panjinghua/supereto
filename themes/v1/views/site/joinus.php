<?php 
UTool::setCsrfValidator ();
$this->pageTitle = '加盟';
?>
<br>
<div class="container">
     <div class="row">
     
     
       <div class="col-sm-8 ">
	        <div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title text-yellow">加盟申请</h3>
				</div>
				<div class="box-body">
	<?php
$form = $this->beginWidget ( 'CActiveForm', array (
		'id' => 'join-form',
		'focus' => array (
				$model,
				'pid' 
		),
		'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		'clientOptions' => array (
				'validateOnSubmit' => true,
				'validateOnChange' => true,
				'afterValidate' => 'js:function(form, data, hasError){
if(hasError){
return false;
}else{
layer.load("提交中...");
return true;
}

}',
		),
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data',
				'class' => 'form-horizontal' 
		) 
) );
?>		
<div class="form-group">
<div class="col-sm-12">
<div class="col-sm-offset-3 col-xs-12 col-sm-3">

							 <?php
							 $critetia_p = new CDbCriteria();
							 $critetia_p->addCondition('p_state>=0');
							 $critetia_p->order = 	'p_spell ASC';							 
							 //add the province dropdownlist
// 							 $provinceItems = CHtml::listData(Province::model()->findAll($critetia_p), 'id', 'p_name');
// 							 echo CHtml::activeDropDownList($model, 'pid', $provinceItems, array (
// 		'prompt' => '选择省份',
// // 		'class'=>'form-control ',
// ));
							 
							 //add the cities dropdownlist, show only the items of the current province
// 							 $cityItems = CHtml::listData(City::model()->findAll('c_province_id=:province AND c_state>=0', array(':province'=>$model->pid)), 'id', 'c_name');
// 							 echo CHtml::activeDropDownList($model, 'cid', $cityItems, array(	'prompt' => '选择城市',
// // 'class'=>'form-control',
							     
// 							 ));							 
							 
					 
echo $form->dropDownList ( $model,'pid', CHtml::listData ( Province::model ()->findAll ($critetia_p), 'id', 'p_name' ), array (
		'prompt' => '选择省份',
		'class'=>'form-control ',
		'ajax' => array (
				'type' => 'POST',
				'url' => $this->createUrl ( 'city/updateCities' ),
'async'=> false,
				'dataType' => 'json',
				'data' => array (
						'idProvince' => 'js:this.value' 
				),
				'success' => 'function(data) { 

$("#JoinForm_cid").html(data.dropDownCities); 
$("#JoinForm_cid").chosen().trigger("chosen:updated");
$("#JoinForm_aid").html(data.dropDownAreas); 
$("#JoinForm_aid").chosen().trigger("chosen:updated");
wsupdataAjax();

}' 
		) 
) );
?> 
<?php

echo $form->error ( $model, 'pid' );
?>	
</div>
<div class=" col-xs-12 col-sm-3">
								 <?php

echo $form->dropDownList ($model, 'cid', array (), array(
		'prompt' => '选择城市',
'class'=>'form-control',
		'ajax' => array(
				'type' => 'POST',
				'url' => $this->createUrl('area/updateAreas'),
				'async'=> false,
				'data' => array('idCity' => 'js:this.value'),
// 				'update' => '#idArea',
				'success'=>'function(data){
$("#JoinForm_aid").html(data); 
$("#JoinForm_aid").chosen().trigger("chosen:updated");

}'
		)));
?> 
<?php

echo $form->error ( $model, 'cid' );
?>	
	</div>
	<div class=" col-xs-12 col-sm-3">			
		       <?php

echo $form->dropDownList ($model, 'aid', array (), array (
		'prompt' => '选择区域' ,
'class'=>'form-control',
) );
?> 
<?php

echo $form->error ( $model, 'aid' );
?>	
	</div>		
	
</div>

</div>
<div class="form-group">
<?php
echo $form->labelEx ( $model, 'address', array (
		'class' => 'col-sm-3 control-label' 
) );
?>
	<div class="col-sm-9">
<?php
echo $form->textField ( $model, 'address', array (
		'placeholder' => '请输入加盟店地址',
		'class' => 'form-control' 
) );
?>
<?php

echo $form->error ( $model, 'address' );
?>	
    </div>
				</div>

				<div class="form-group">
<?php
echo $form->labelEx ( $model, 'name', array (
		'class' => 'col-sm-3 control-label' 
) );
?>
 <div class="col-sm-9">
 <?php
	echo $form->textField ( $model, 'name', array (
			'placeholder' => '加盟店名称',
			'class' => 'form-control' 
	) );
	?>
<?php

	echo $form->error ( $model, 'name' );
	?>
</div>
				</div>

				<div class="form-group">
<?php

echo $form->labelEx ( $model, 'contactor', array (
		'class' => 'col-sm-3 control-label' 
) );
?>
<div class="col-sm-9">
<?php
echo $form->textField ( $model, 'contactor', array (
		'placeholder' => '联系人姓名',
		'class' => 'form-control' 
) );
?>
<?php

echo $form->error ( $model, 'contactor' );
?>
    </div>
				</div>
	<div class="form-group">
<?php
echo $form->labelEx ( $model, 'tel', array (
		'class' => 'col-sm-3 control-label' 
) );
?>
	<div class="col-sm-9">
<?php
echo $form->textField ( $model, 'tel', array (
		'placeholder' => '请输入11位手机号',
		'class' => 'form-control' 
) );
?>
<?php

echo $form->error ( $model, 'tel' );
?>	
    </div>
				</div>

				<div class="form-group">
<?php

echo $form->labelEx ( $model, 'smsCode', array (
		'class' => 'col-sm-3 control-label' 
) );
?>
<div class="col-sm-5">
<?php

echo $form->textField ( $model, 'smsCode', array (
		'placeholder' => '请输入短信验证码',
		'class' => 'form-control' 
) );
?>
<?php

echo $form->error ( $model, 'smsCode' );
?>			  
</div>
					<div class="col-sm-4">
						<input type="button" class="btn btn-primary col-xs-12"
							name="btnSMS" id="btn_sms" onclick="sendMessage()"
							value="免费获取验证码" />
					</div>
				</div>
<?php
if (Yii::app ()->user->hasFlash ( 'joinError' )) :
	?>
<div class="alert alert-danger" role="alert"><?php echo Yii::app()->user->getFlash('joinError');?></div>
<?php endif;?>
			
				<div class="form-group">
					<div class="col-sm-12">
<?php

echo CHtml::submitButton ( '提交申请', array (
		'class' => 'btn btn-warning col-sm-offset-3 col-sm-9 col-xs-12',
		'id' => 'btn_submit' 
) );
?>
</div>
				</div>
<?php $this->endWidget(); ?>				
				

				</div><!-- /.box-body -->
			</div><!-- /.box -->
	   </div>
	   <div class="col-sm-4">
	         <ul class="timeline">
				<!-- timeline time label -->
				<li class="time-label">
					<span class="bg-yellow">
						加盟流程
					</span>
				</li>
				<li>
					<i class="fa bg-blue"> 1 </i>
					<div class="timeline-item">
						<h3 class="timeline-header no-border"> 填写加盟信息 </h3>
					</div>
				</li>
				<li>
					<i class="fa bg-blue"> 2 </i>
					<div class="timeline-item">
						<h3 class="timeline-header no-border"> 提交申请 </h3>
					</div>
				</li>
			    <li>
					<i class="fa bg-blue"> 3 </i>
					<div class="timeline-item">
						<h3 class="timeline-header no-border"> 业务员上门审核 </h3>
					</div>
				</li>
				<li>
					<i class="fa bg-blue"> 4 </i>
					<div class="timeline-item">
						<h3 class="timeline-header no-border"> 签订加盟协议 </h3>
					</div>
				</li>
				<li>
					<i class="fa bg-blue"> 5 </i>
					<div class="timeline-item">
						<h3 class="timeline-header no-border"> 登录账户 </h3>
					</div>
				</li>
				<li>
					<i class="fa bg-blue"> 6 </i>
					<div class="timeline-item">
						<h3 class="timeline-header no-border"> 修改店面信息 </h3>
					</div>
				</li>
				<li>
					<i class="fa bg-blue"> 7 </i>
					<div class="timeline-item">
						<h3 class="timeline-header no-border"> 上线 </h3>
					</div>
				</li>
			
				<li>
					<i class="fa fa-clock-o bg-green"></i>
				</li>
			</ul>		
	   </div>
   </div>
   
  </div>
   <?php 
Yii::app()->clientScript->registerScript('changeMenuStyle',
"
   $('#mjoinus').addClass('active');

		",CClientScript::POS_READY);


?>

 <?php 

   Yii::app ()->session ['send_code'] = UTool::randomkeys ( 6 );

Yii::app()->clientScript->registerScript('regsms',
"
var InterValObj; 
var count = 60; 
var curCount;

function sendMessage() {
	curCount = count;

	InterValObj = window.setInterval(SetRemainTime, 1000); 
	$.ajax({
		type: \"POST\", 
		dataType:'json',
		url: '".Yii::app()->createUrl('site/sms')."', 
		data: {
			'send_code':'".Yii::app()->session['send_code']."',
			'tel':$('#JoinForm_tel').val(),
			'oi':'".Yii::app ()->request->cookies ['_oi']."',
 	    },
		error: function (XMLHttpRequest, textStatus, errorThrown) {layer.msg('提交失败'); },
		success: function (rlt){
			$('#btn_sms').attr('disabled', 'true');
			$('#btn_sms').val('请输入验证码( '+ curCount + ')');
			if(rlt['status']){
				layer.msg(rlt['msg'],2,1);
			}else{
				layer.msg(rlt['msg']);
				curCount = 0;
				SetRemainTime();
            }
		}
     });
}

function SetRemainTime() {
            if (curCount <= 1) {                
                window.clearInterval(InterValObj);
                $('#btn_sms').removeAttr('disabled');
                $('#btn_sms').val('重新发送验证码');
            }
            else {
                curCount--;
                $('#btn_sms').val('请输入验证码(' + curCount + ')');
            }
        }
		

		",CClientScript::POS_END);


?>

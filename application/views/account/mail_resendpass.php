<p>Здравствуйте, <?=$userfirstname?>!</p>
<p>Для востановления пароля перейдите по следующей ссылке:<br/>
<a href='http://<?=$_SERVER['HTTP_HOST']?>/resendpassword/reset?id=<?=$userid?>&token=<?=$token?>'>http://<?=$_SERVER['HTTP_HOST']?>/cauth/resendpassword?id=<?=$userid?>&token=<?=$token?></a></p>
<p>Если Вы не отправляли заявку на востановление пароля, проигнорируйте данное письмо!</p>
<p>С уважением, администрация сайта <a href="http://<?=$_SERVER['HTTP_HOST']?>" title="SOS навигатор">http://<?=$_SERVER['HTTP_HOST']?></a></p>

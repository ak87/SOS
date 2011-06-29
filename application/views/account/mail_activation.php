<p>Здравствуйте, <?=$first_name?>!</p>
<p>Вы зарегистрированы на сайте <a href="http://<?=$_SERVER['HTTP_HOST']?>" title="SOS навигатор">«SOS навигатор»</a>. Чтобы подтвердить свою регистрацию, перейдите по следующей ссылке:<br/>

<a href='http://<?=$_SERVER['HTTP_HOST']?>/signin/activation?id=<?=$user_id?>&token=<?=$token?>'>http://<?=$_SERVER['HTTP_HOST']?>/signin/activation?id=<?=$user_id?>&token=<?=$token?></a></p>

<p>С уважением, администрация сайта <a href="http://<?=$_SERVER['HTTP_HOST']?>" title="SOS навигатор">http://<?=$_SERVER['HTTP_HOST']?></a></p>

